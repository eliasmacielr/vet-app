<?php
namespace App\Controller\Api;

use App\Controller\ApiController;

/**
 * Patients Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\PatientsTable $Patients
 */
class PatientsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Breeds', 'Customers'],
            'finder' => [
                'search' => $this->Patients->filterParams($this->request->query)
            ],
        ];
        $patients = $this->paginate($this->Patients);
        $status = true;
        $this->set(compact(['patients', 'status']));
        $this->set('_serialize', ['patients', 'status']);
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
        $patient = $this->Patients->get($id, [
            'contain' => ['Breeds', 'Customers']
        ]);
        $status = true;
        $this->set(compact(['patient', 'status']));
        $this->set('_serialize', ['patient', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $patient = $this->Patients->newEntity();
        $patient = $this->Patients->patchEntity($patient, $this->request->data);
        if ($this->Patients->save($patient)) {
            $status = true;
            $message = "Se ha guardado el paciente";
        } else {
            $status = false;
            $message = "No se ha guardado el paciente";
            $errors = $this->ErrorAdapter->reduce($patient->errors());
        }

        $this->set(compact(['patient', 'message', 'status', 'errors']));
        $this->set('_serialize', ['patient', 'status', 'message', 'errors']);
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
        $this->request->allowMethod(['put']);
        $patient = $this->Patients->get($id);
        $patient = $this->Patients->patchEntity($patient, $this->request->data);
        if ($this->Patients->save($patient)) {
            $status = true;
            $message = "Se ha editado el paciente";
        } else {
            $status = false;
            $message = "No se ha editado el paciente";
            $errors = $this->ErrorAdapter->reduce($patient->errors());
        }

        $this->set(compact(['patient', 'status', 'message', 'errors']));
        $this->set('_serialize', ['patient', 'status', 'message', 'errors']);
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
        $this->request->allowMethod(['delete']);
        $patient = $this->Patients->get($id);
        if ($this->Patients->delete($patient)) {
            $status = true;
            $message = "Se ha borrado el paciente";
        } else {
            $status = false;
            $message = "No se ha borrado el paciente";
        }
        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
