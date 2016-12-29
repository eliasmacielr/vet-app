<?php
namespace App\Controller\Api;

use PDOException;
use App\Controller\ApiController;

/**
 * Breeds Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\BreedsTable $Breeds
 */
class BreedsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Species'],
            'finder' => [
                'search' => $this->Breeds->filterParams($this->request->query)
            ],
        ];
        $breeds = $this->paginate($this->Breeds);
        $status = true;
        $this->set(compact(['breeds', 'status']));
        $this->set('_serialize', ['breeds', 'status']);
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
        $breed = $this->Breeds->get($id, [
            'contain' => ['Species']
        ]);
        $status = true;
        $this->set(compact(['breed', 'status']));
        $this->set('_serialize', ['breed', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $breed = $this->Breeds->newEntity();
        $breed = $this->Breeds->patchEntity($breed, $this->request->data);
        if ($this->Breeds->save($breed)) {
            $status = true;
            $message = "Se ha guardado la raza";
        } else {
            $status = false;
            $message = "No se ha guardado la raza";
            $errors = $this->ErrorAdapter->reduce($breed->errors());
        }

        $this->set(compact(['breed', 'message', 'status', 'errors']));
        $this->set('_serialize', ['breed', 'status', 'message', 'errors']);
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
        $breed = $this->Breeds->get($id);
        $breed = $this->Breeds->patchEntity($breed, $this->request->data);

        if ($this->Breeds->save($breed)) {
            $status = true;
            $message = "Se ha editado la raza";
        } else {
            $status = false;
            $message = "No se ha editado la raza";
            $errors = $this->ErrorAdapter->reduce($breed->errors());
        }

        $this->set(compact(['breed', 'status', 'message', 'errors']));
        $this->set('_serialize', ['breed', 'status', 'message', 'errors']);
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
        $breed = $this->Breeds->get($id);
        try {
            if ($this->Breeds->delete($breed)) {
                $status = true;
                $message = "Se ha borrado la raza";
            } else {
                $status = false;
                $message = "No se ha borrado la raza";
            }
        } catch (PDOException $e) {
            $status = false;
            $message = "No se ha borrado la raza, existen pacientes que pertenecen al registro";
        }

        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
