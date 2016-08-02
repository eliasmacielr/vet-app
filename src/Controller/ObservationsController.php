<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Observations Controller
 *
 * @property \App\Model\Table\ObservationsTable $Observations
 */
class ObservationsController extends AppController
{

    /**
     * Index method
     *
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|null
     */
    public function index($patient_id)
    {
        $this->paginate = [
            'finder' => [
                'search' => $this->Observations->filterParams($this->request->query),
            ],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'created',
            'direction' => $this->request->query('direction') ?: 'desc',
        ];
        $observations = $this->paginate($this->Observations);
        $patient = $this->Observations->Patients->get($patient_id);

        $this->set(compact('observations', 'patient'));
    }

    /**
     * Add method
     *
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($patient_id = null)
    {
        $observation = $this->Observations->newEntity();
        $patient = $this->Observations->Patients->get($patient_id);
        if ($this->request->is('post')) {
            $observation = $this->Observations->patchEntity($observation, $this->request->data);
            $observation->patient = $patient;
            if ($this->Observations->save($observation)) {
                $this->Flash->success('La observación ha sido guardada');
                return $this->redirect(['action' => 'index', 'patient_id' => $patient_id]);
            } else {
                $this->Flash->error('La observación no ha sido guardada, intente de nuevo');
            }
        }

        $this->set(compact('observation', 'patient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Observation id.
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $patient_id = null)
    {
        $observation = $this->Observations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $observation = $this->Observations->patchEntity($observation, $this->request->data);
            if ($this->Observations->save($observation)) {
                $this->Flash->success('La observación ha sido actualizada');
                return $this->redirect(['action' => 'index', 'patient_id' => $patient_id]);
            } else {
                $this->Flash->error('La observación no ha sido actualizada, intente de nuevo');
            }
        }
        $patient = $this->Observations->Patients->get($patient_id);
        $this->set(compact('observation', 'patient'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Observation id.
     * @param string|null $patient_id Patient id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $patient_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $observation = $this->Observations->get($id);
        if ($this->Observations->delete($observation)) {
            $this->Flash->success('La observación ha sido eliminada');
        } else {
            $this->Flash->error('La observación no ha sido eliminada, intente de nuevo');
        }
        return $this->redirect(['action' => 'index', 'patient_id' => $patient_id]);
    }
}
