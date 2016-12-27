<?php
namespace App\Controller\Api;

use PDOException;
use App\Controller\ApiController;

/**
 * Customers Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations']
        ];
        $customers = $this->paginate($this->Customers);
        $status = true;

        $this->set(compact(['customers', 'status']));
        $this->set('_serialize', ['customers', 'status']);
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
            'contain' => ['Locations', 'Patients']
        ]);
        $status = true;
        $this->set(compact['customers', 'status']);
        $this->set('_serialize', ['customer', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $customer = $this->Customers->newEntity();
        $customer = $this->Customers->patchEntity($customer, $this->request->data);
        if ($this->Customers->save($customer)) {
            $status = true;
            $message = "Se ha guardado el cliente";
        } else {
            $status = false;
            $message = "No se ha guardado el cliente";
            $errors = $this->ErrorAdapter->reduce($customer->errors());
        }

        $this->set(compact(['customer', 'message', 'status', 'errors']));
        $this->set('_serialize', ['customer', 'status', 'message', 'errors']);
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
        $customer = $this->Customers->get($id);
        $customer = $this->Customers->patchEntity($customer, $this->request->data);
        if ($this->Customers->save($customer)) {
            $status = true;
            $message = "Se ha editado el cliente";
        } else {
            $status = false;
            $message = "No se ha editado el cliente";
            $errors = $this->ErrorAdapter->reduce($customer->errors());
        }

        $this->set(compact(['customer', 'status', 'message', 'errors']));
        $this->set('_serialize', ['customer', 'status', 'message', 'errors']);
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
        $customer = $this->Customers->get($id);
        try {
            if ($this->Customers->delete($customer)) {
                $status = true;
                $message = "Se ha borrado el cliente";
            } else {
                $status = false;
                $message = "No se ha borrado el cliente";
            }
        } catch (PDOException $e) {
            $status = false;
            $message = "No se ha borrado el cliente, existen pacientes que pertenecen al registro";
        }

        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
