<?php
namespace App\Controller\System;

use App\Controller\AppController;

/**
 * Users Controller
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->Users->find('admin', ['user' => $this->Auth->user()]);
        $users = $this->paginate($query);
        $this->set(compact('users'));
    }

    /**
     * Add method
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido guardado');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('El usuario no ha sido guardado, intente de nuevo');
            }
        }

        $groupOptions = $this->Auth->user('group_name') === 'super-admin' ? ['super-admin' => 'Super Administrador', 'admin' => 'Administrador', 'staff' => 'Miembro Staff'] : ['admin' => 'Administrador', 'staff' => 'Miembro Staff'];

        $this->set(compact(['user', 'groupOptions']));
    }

    /**
     * Edit method
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->find('admin', ['user' => $this->Auth->user()])->where([$this->Users->primaryKey() => $id])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (empty($this->request->data['password'])) {
                unset($this->request->data['password']);
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido modificado');

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('No se pudo modificar el usuario, intente de nuevo');
            }
        }

        $groupOptions = $this->Auth->user('group_name') === 'super-admin' ? ['super-admin' => 'Super Administrador', 'admin' => 'Administrador', 'staff' => 'Miembro Staff'] : ['admin' => 'Administrador', 'staff' => 'Miembro Staff'];

        $this->set(compact(['user', 'groupOptions']));
    }

    /**
     * Delete method
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->find('admin', ['user' => $this->Auth->user()])->where([$this->Users->primaryKey() => $id])->firstOrFail();
        if ($this->Users->delete($user)) {
            $this->Flash->success('Se ha eliminado el usuario');
        } else {
            $this->Flash->error('No se ha podido eliminar el cliente, intente de nuevo');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function changePassword()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['post', 'put'])) {
            $this->Users->validator('changePassword')->provider('passed', [
                'userPassword' => $user->password,
            ]);
            $this->Users->patchEntity($user, $this->request->data, ['validate' => 'changePassword']);
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user->toArray());
                $this->Flash->success('Contraseña actualizada');

                return $this->redirect($this->request->referer());
            } else {
                $this->Flash->error('La contraseña no ha sido actualizada, intente de nuevo');
            }
        }
        $this->set('user', $user);
    }

    public function editProfile()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['post', 'put'])) {
            $this->Users->validator('profile')->provider('passed', [
                'userPassword' => $user->password,
            ]);
            $this->Users->patchEntity($user, $this->request->data, ['validate' => 'profile']);
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user->toArray());
                $this->Flash->success('Perfil actualizado');

                return $this->redirect($this->request->referer());
            } else {
                $this->Flash->error('El perfil no ha sido actualizado, intente de nuevo');
            }
        }
        $this->set('user', $user);
    }
}
