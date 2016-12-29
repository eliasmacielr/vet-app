<?php
namespace App\Controller\Api;

use App\Controller\ApiController;

/**
 * Users Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends ApiController
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
                "search" => $this->Users->filterParams($this->request->params),
            ],
        ];
        $users = $this->paginate($this->Users);
        $status = true;
        $this->set(compact(['users', 'status']));
        $this->set('_serialize', ['users', 'status']);
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
        $user = $this->Users->get($id);
        $status = true;
        $this->set(compact(['user', 'status']));
        $this->set('_serialize', ['user', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $this->request->data);
        if ($this->Users->save($user)) {
            $status = true;
            $message = "Se ha guardado el usuario";
        } else {
            $status = false;
            $message = "No se ha guardado el usuario";
            $errors = $this->ErrorAdapter->reduce($user->errors());
        }

        $this->set(compact(['user', 'message', 'status', 'errors']));
        $this->set('_serialize', ['user', 'status', 'message', 'errors']);
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
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $this->request->data);

        if ($this->Users->save($user)) {
            $status = true;
            $message = "Se ha editado el usuario";
        } else {
            $status = false;
            $message = "No se ha editado el usuario";
            $errors = $this->ErrorAdapter->reduce($user->errors());
        }

        $this->set(compact(['user', 'status', 'message', 'errors']));
        $this->set('_serialize', ['user', 'status', 'message', 'errors']);
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $status = true;
            $message = "Se ha borrado el usuario";
        } else {
            $status = false;
            $message = "No se ha borrado el usuario";
        }
        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
