<?php
namespace App\Controller\System;

use App\Controller\AppController;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 */
class PatientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'id',
            'sortWhitelist' => ['id', 'name', 'sex', 'Customers.id',
                'Customers.name', 'Customers.last_name', 'Breeds.name'],
            'direction' => $this->request->query('direction') ?: 'asc',
        ];

        $query = $this->Patients->find('search', $this->Patients->filterParams($this->request->query))
            ->contain(['Customers', 'Breeds']);
        if (is_numeric($this->request->query('q'))) {
            $query->orWhere([$this->Patients->aliasField('id') => $this->request->query('q')]);
            $query->orWhere([$this->Patients->Customers->aliasField('id') => $this->request->query('q')]);
        }
        $patients = $this->paginate($query);

        $this->set(compact('patients'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => ['Breeds', 'Customers']
        ]);

        $this->paginate = [
            'Vaccinations' => [
                'sortWhitelist' => ['Vaccines.name', 'annotations',
                    'vaccination_date', 'revaccinated'],
                'limit' => $this->request->query('limit') ?: 10,
                'sort' => $this->request->query('sort') ?: 'vaccination_date',
                'direction' => $this->request->query('direction') ?: 'desc',
                'contain' => ['Vaccines'],
            ]
        ];

        $vaccinations = $this->paginate($this->Patients->Vaccinations->find('search', $this->Patients->Vaccinations->filterParams($this->request->query))->where(['Vaccinations.patient_id' => $id]));

        $this->set(compact('patient', 'vaccinations'));
    }

    /**
     * Add method
     *
     * @param string|null $customer_id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($customer_id = null)
    {
        $patient = $this->Patients->newEntity();
        if ($this->request->is('post')) {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) {
                $this->Flash->success('El paciente ha sido guardado');
                if ($customer_id === null) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    return $this->redirect(['controller' => 'Customers', 'action' => 'view', 'id' => $customer_id]);
                }
            } else {
                $this->Flash->error('El paciente no ha sido guardado, intente de nuevo');
            }
        }

        $breeds = $this->Patients->Breeds->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'groupField' => 'species.name',
        ])->contain(['Species']);

        $customers = $this->Patients->Customers->find('list', [
            'valueField' => function ($e) {
                return $e->full_name_list;
            },
        ]);
        $this->set(compact('patient', 'breeds', 'customers', 'customer_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @param string|null $customer_id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $customer_id = null)
    {
        $patient = $this->Patients->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) {
                $this->Flash->success('El paciente ha sido modificado');
                if ($customer_id === null) {
                    return $this->redirect(['action' => 'index']);
                } else {
                    return $this->redirect(['controller' => 'Customers', 'action' => 'view', 'id' => $customer_id]);
                }
            } else {
                $this->Flash->error('No se pudo modificar el paciente, intente de nuevo');
            }
        }

        $breeds = $this->Patients->Breeds->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'groupField' => 'species.name',
        ])->contain(['Species']);

        $customers = $this->Patients->Customers->find('list', [
            'valueField' => function ($e) {
                return $e->full_name_list;
            },
        ]);

        $this->set(compact('patient', 'breeds', 'customers', 'customer_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
     * @param string|null $customer_id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $customer_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patient = $this->Patients->get($id);
        if ($this->Patients->delete($patient)) {
            $this->Flash->success('El paciente ha sido eliminado');
        } else {
            $this->Flash->error('El paciente no ha sido eliminado, intente de nuevo');
        }
        if ($customer_id === null) {
            return $this->redirect(['action' => 'index']);
        } else {
            return $this->redirect(['controller' => 'Customers', 'action' => 'view', 'id' => $customer_id]);
        }
    }
}
