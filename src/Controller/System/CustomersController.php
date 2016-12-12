<?php
namespace App\Controller\System;

use PDOException;
use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends AppController
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
            'direction' => $this->request->query('direction') ?: 'asc',
        ];

        $query = $this->Customers->find('search', $this->Customers->filterParams($this->request->query));
        if (is_numeric($this->request->query('q'))) {
            $query->orWhere([$this->Customers->aliasField('id') => $this->request->query('q')]);
        }
        $customers = $this->paginate($query);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Locations']
        ]);

        $this->paginate = [
            'Patients' => [
                'limit' => $this->request->query('limit') ?: 10,
                'sort' => $this->request->query('sort') ?: 'id',
                'sortWhitelist' => ['id', 'name', 'sex', 'Customers.id',
                    'Customers.name', 'Customers.last_name', 'Breeds.name'],
                'direction' => $this->request->query('direction') ?: 'asc',
            ]
        ];

        $query = $this->Customers->Patients->find('search', $this->Customers->Patients->filterParams($this->request->query))
            ->where(['Patients.customer_id' => $id])->contain(['Breeds', 'Customers']);
        if (is_numeric($this->request->query('q'))) {
            $query->orWhere([$this->Customers->Patients->aliasField('id') => $this->request->query('q')]);
        }

        $patients = $this->paginate($query);
        $this->set(compact('customer', 'patients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success('El cliente ha sido guardado');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('El cliente no ha sido guardado, intente de nuevo');
            }
        }
        $locations = $this->Customers->Locations->find('list');
        $this->set(compact('customer', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success('El cliente ha sido modificado');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No se pudo modificar el cliente, intente de nuevo');
            }
        }
        $locations = $this->Customers->Locations->find('list');
        $this->set(compact('customer', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        try {
            if ($this->Customers->delete($customer)) {
                $this->Flash->success('Se ha eliminado el cliente');
            } else {
                $this->Flash->error('No se ha podido eliminar el cliente, intente de nuevo');
            }
        } catch (PDOException $e) {
            $this->Flash->error('No se puede eliminar, existen pacientes que pertenecen al cliente');
        }
        return $this->redirect(['action' => 'index']);
    }
}
