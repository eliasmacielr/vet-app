<?php
namespace App\Controller\Api;

use PDOException;
use App\Controller\ApiController;

/**
 * Species Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\SpeciesTable $Species
 */
class SpeciesController extends ApiController
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
                'search' => $this->Species->filterParams($this->request->query)
            ],
        ];
        $species = $this->paginate($this->Species);
        $status = true;
        $this->set(compact(['species', 'status']));
        $this->set('_serialize', ['species', 'status']);
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
        $species = $this->Species->get($id);
        $status = true;
        $this->set(compact(['species', 'status']));
        $this->set('_serialize', ['species', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $species = $this->Species->newEntity();
        $species = $this->Species->patchEntity($species, $this->request->data);
        if ($this->Species->save($species)) {
            $status = true;
            $message = "Se ha guardado la especie";
        } else {
            $status = false;
            $message = "No se ha guardado la especie";
            $errors = $this->ErrorAdapter->reduce($species->errors());
        }

        $this->set(compact(['species', 'message', 'status', 'errors']));
        $this->set('_serialize', ['species', 'status', 'message', 'errors']);
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
        $species = $this->Species->get($id);
        $species = $this->Species->patchEntity($species, $this->request->data);
        if ($this->Species->save($species)) {
            $status = true;
            $message = "Se ha editado la especie";
        } else {
            $status = false;
            $message = "No se ha editado la especie";
            $errors = $this->ErrorAdapter->reduce($species->errors());
        }

        $this->set(compact(['species', 'status', 'message', 'errors']));
        $this->set('_serialize', ['species', 'status', 'message', 'errors']);
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
        $species = $this->Species->get($id);
        try {
            if ($this->Species->delete($species)) {
                $status = true;
                $message = "Se ha borrado la especie";
            } else {
                $status = false;
                $message = "No se ha borrado la especie";
            }
        } catch (PDOException $e) {
            $status = false;
            $message = "No se ha borrado la especie, existen pacientes que pertenecen al registro";
        }

        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
