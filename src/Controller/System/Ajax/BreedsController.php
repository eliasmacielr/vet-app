<?php
namespace App\Controller\System\Ajax;

use App\Controller\AppController;

/**
 * Breeds Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\BreedsTable $Breeds
 */
class BreedsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ErrorAdapter');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['ajax', 'post']);
        $breed = $this->Breeds->newEntity();
        $breed = $this->Breeds->patchEntity($breed, $this->request->data);
        if ($this->Breeds->save($breed)) {
            $status = true;
            $message = 'La raza ha sido guardada';
        } else {
            $status = false;
            $message = 'La raza no ha sido guardada, intente de nuevo';
            $errors = $this->ErrorAdapter->reduce($breed->errors());
        }
        $this->set(compact(['breed', 'status', 'message', 'errors']));
        $this->set('_serialize', ['breed', 'status', 'message', 'errors']);
    }
}
