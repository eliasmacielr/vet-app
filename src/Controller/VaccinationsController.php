<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vaccinations Controller
 *
 * @property \App\Model\Table\VaccinationsTable $Vaccinations
 */
class VaccinationsController extends AppController
{
    /**
     * Add method
     *
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($patient_id = null)
    {
        $vaccination = $this->Vaccinations->newEntity();
        $patient = $this->Vaccinations->Patients->get($patient_id);
        if ($this->request->is('post')) {
            $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->data);
            $vaccination->patient = $patient;
            if ($this->Vaccinations->save($vaccination)) {
                $this->Flash->success('El registro ha sido guardado');
                return $this->redirect(['controller' => 'Patients', 'action' => 'view', 'id' => $patient_id]);
            } else {
                $this->Flash->error('El registro no ha sido guardado, intente de nuevo');
            }
        }
        $vaccines = $this->Vaccinations->Vaccines->find('list');
        $this->set(compact('vaccination', 'vaccines', 'patient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vaccination id.
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $patient_id = null)
    {
        $vaccination = $this->Vaccinations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->data);
            if ($this->Vaccinations->save($vaccination)) {
                $this->Flash->success('El registro ha sido actualizado');
                return $this->redirect(['controller' => 'Patients', 'action' => 'view', 'id' => $patient_id]);
            } else {
                $this->Flash->error('El registro no ha sido actualizado');
            }
        }
        $vaccines = $this->Vaccinations->Vaccines->find('list');
        $patient = $this->Vaccinations->Patients->get($patient_id);
        $this->set(compact('vaccination', 'vaccines', 'patient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vaccination id.
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $patient_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vaccination = $this->Vaccinations->get($id);
        if ($this->Vaccinations->delete($vaccination)) {
            $this->Flash->success('El registro ha sido eliminado');
        } else {
            $this->Flash->error('El registro no ha sido eliminado');
        }
        return $this->redirect(['controller' => 'Patients', 'action' => 'view', 'id' => $patient_id]);
    }

    public function showExpired()
    {
        $this->paginate = [
            'finder' => [
                'search' => $this->Vaccinations->filterParams($this->request->query),
            ],
            'sortWhitelist' => ['revaccination', 'Patients.name', 'Vaccines.name'],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'revaccination',
            'direction' => $this->request->query('direction') ?: 'desc',
        ];
        $query = $this->Vaccinations->find('totalExpired')->contain(['Patients', 'Vaccines']);
        $vaccinations = $this->paginate($query);

        $this->set(compact('vaccinations'));
    }
}
