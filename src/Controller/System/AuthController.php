<?php

namespace App\Controller\System;

use App\Controller\AppController;
use App\Form\LoginForm;

/**
 * Auth Controller.
 */
class AuthController extends AppController
{
    public function login()
    {
        $login = new LoginForm();
        if ($this->request->is('post')) {
            if ($login->execute($this->request->data)) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $this->Flash->success('Bienvenido '.$this->Auth->user('name').' '.$this->Auth->user('last_name'), ['key' => 'auth']);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error('Email o contraseña inválido', ['key' => 'auth']);
                }
            }
        }

        $this->set(compact('login'));
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
