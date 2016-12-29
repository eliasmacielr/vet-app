<?php
namespace App\Controller\Api;

use PDOException;
use App\Controller\ApiController;

/**
 * Locations Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\LocationsTable $Locations
 */
class LocationsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'finder' => [
                'search' => $this->Locations->filterParams($this->request->query)
            ],
        ];

        $locations = $this->paginate($this->Locations);
        $status = true;
        $this->set(compact(['locations', 'status']));
        $this->set('_serialize', ['locations', 'status']);
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
        $location = $this->Locations->get($id);
        $status = true;
        $this->set(compact(['location', 'status']));
        $this->set('_serialize', ['location', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $location = $this->Locations->newEntity();
        $location = $this->Locations->patchEntity($location, $this->request->data);
        if ($this->Locations->save($location)) {
            $status = true;
            $message = "Se ha guardado la ciudad";
        } else {
            $status = false;
            $message = "No se ha guardado la ciudad";
            $errors = $this->ErrorAdapter->reduce($location->errors());
        }

        $this->set(compact(['location', 'message', 'status', 'errors']));
        $this->set('_serialize', ['location', 'status', 'message', 'errors']);
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
        $location = $this->Locations->get($id);
        $location = $this->Locations->patchEntity($location, $this->request->data);

        if ($this->Locations->save($location)) {
            $status = true;
            $message = "Se ha editado la ciudad";
        } else {
            $status = false;
            $message = "No se ha editado la ciudad";
            $errors = $this->ErrorAdapter->reduce($location->errors());
        }

        $this->set(compact(['location', 'status', 'message', 'errors']));
        $this->set('_serialize', ['location', 'status', 'message', 'errors']);
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
        $location = $this->Locations->get($id);
        try {
            if ($this->Locations->delete($location)) {
                $status = true;
                $message = "Se ha borrado la ciudad";
            } else {
                $status = false;
                $message = "No se ha borrado la ciudad";
            }
        } catch (PDOException $e) {
            $status = false;
            $message = "No se ha borrado la ciudad, existen clientes que pertenecen al registro";
        }

        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
