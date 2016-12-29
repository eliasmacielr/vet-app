<?php
namespace App\Controller\Api;

use App\Controller\ApiController;

/**
 * Movements Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\MovementsTable $Movements
 */
class MovementsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $movements = $this->paginate($this->Movements);
        $status = true;
        $this->set(compact(['movements', 'status']));
        $this->set('_serialize', ['movements', 'status']);
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
        $movement = $this->Movements->get($id);
        $status = true;
        $this->set(compact(['movement', 'status']));
        $this->set('_serialize', ['movement', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $movement = $this->Movements->newEntity();
        $movement = $this->Movements->patchEntity($movement, $this->request->data);
        if ($this->Movements->save($movement)) {
            $status = true;
            $message = "Se ha guardado el registro";
        } else {
            $status = false;
            $message = "No se ha guardado el registro";
            $errors = $this->ErrorAdapter->reduce($movement->errors());
        }

        $this->set(compact(['movement', 'message', 'status', 'errors']));
        $this->set('_serialize', ['movement', 'status', 'message', 'errors']);
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
        $movement = $this->Movements->get($id);
        $movement = $this->Movements->patchEntity($movement, $this->request->data);

        if ($this->Movements->save($movement)) {
            $status = true;
            $message = "Se ha editado el registro";
        } else {
            $status = false;
            $message = "No se ha editado el registro";
            $errors = $this->ErrorAdapter->reduce($movement->errors());
        }

        $this->set(compact(['movement', 'status', 'message', 'errors']));
        $this->set('_serialize', ['movement', 'status', 'message', 'errors']);
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
        $movement = $this->Movements->get($id);
        if ($this->Movements->delete($movement)) {
            $status = true;
            $message = "Se ha borrado el registro";
        } else {
            $status = false;
            $message = "No se ha borrado el registro";
        }
        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
