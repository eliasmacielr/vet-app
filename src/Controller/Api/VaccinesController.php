<?php
namespace App\Controller\Api;

use PDOException;
use App\Controller\ApiController;

/**
 * Vaccines Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\VaccinesTable $Vaccines
 */
class VaccinesController extends ApiController
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
                'search' => $this->Vaccines->filterParams($this->request->query)
            ],
        ];
        $vaccines = $this->paginate($this->Vaccines);
        $status = true;
        $this->set(compact(['vaccines', 'status']));
        $this->set('_serialize', ['vaccines', 'status']);
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
        $vaccine = $this->Vaccines->get($id);
        $status = true;
        $this->set(compact(['vaccine', 'status']));
        $this->set('_serialize', ['vaccine', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $vaccine = $this->Vaccines->newEntity();
        $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->data);
        if ($this->Vaccines->save($vaccine)) {
            $status = true;
            $message = "Se ha guardado la vacuna";
        } else {
            $status = false;
            $message = "No se ha guardado la vacuna";
            $errors = $this->ErrorAdapter->reduce($vaccine->errors());
        }

        $this->set(compact(['vaccine', 'message', 'status', 'errors']));
        $this->set('_serialize', ['vaccine', 'status', 'message', 'errors']);
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
        $vaccine = $this->Vaccines->get($id);
        $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->data);
        if ($this->Vaccines->save($vaccine)) {
            $status = true;
            $message = "Se ha editado la vacuna";
        } else {
            $status = false;
            $message = "No se ha editado la vacuna";
            $errors = $this->ErrorAdapter->reduce($vaccine->errors());
        }

        $this->set(compact(['vaccine', 'status', 'message', 'errors']));
        $this->set('_serialize', ['vaccine', 'status', 'message', 'errors']);
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
        $vaccine = $this->Vaccines->get($id);
        try {
            if ($this->Vaccines->delete($vaccine)) {
                $status = true;
                $message = "Se ha borrado la vacuna";
            } else {
                $status = false;
                $message = "No se ha borrado la vacuna";
            }
        } catch (PDOException $e) {
            $status = false;
            $message = "No se ha borrado la vacuna, existen pacientes que pertenecen al registro";
        }

        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
