<?php
namespace App\Controller\Api;

use App\Controller\ApiController;

/**
 * Observations Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\ObservationsTable $Observations
 */
class ObservationsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            "finder" => [
                "search" => $this->Observations->filterParams($this->request->params),
            ],
        ];
        $observations = $this->paginate($this->Observations);
        $status = true;
        $this->set(compact(['observations', 'status']));
        $this->set('_serialize', ['observations', 'status']);
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
        $observation = $this->Observations->get($id);
        $status = true;
        $this->set(compact(['observation', 'status']));
        $this->set('_serialize', ['observation', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $observation = $this->Observations->newEntity();
        $observation = $this->Observations->patchEntity($observation, $this->request->data);
        if ($this->Observations->save($observation)) {
            $status = true;
            $message = "Se ha guardado la observación";
        } else {
            $status = false;
            $message = "No se ha guardado la observación";
            $errors = $this->ErrorAdapter->reduce($observation->errors());
        }

        $this->set(compact(['observation', 'message', 'status', 'errors']));
        $this->set('_serialize', ['observation', 'status', 'message', 'errors']);
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
        $observation = $this->Observations->get($id);
        $observation = $this->Observations->patchEntity($observation, $this->request->data);

        if ($this->Observations->save($observation)) {
            $status = true;
            $message = "Se ha editado la observación";
        } else {
            $status = false;
            $message = "No se ha editado la observación";
            $errors = $this->ErrorAdapter->reduce($observation->errors());
        }

        $this->set(compact(['observation', 'status', 'message', 'errors']));
        $this->set('_serialize', ['observation', 'status', 'message', 'errors']);
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
        $observation = $this->Observations->get($id);
        if ($this->Observations->delete($observation)) {
            $status = true;
            $message = "Se ha borrado la observación";
        } else {
            $status = false;
            $message = "No se ha borrado la observación";
        }
        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
