<?php
namespace App\Controller\System\Ajax;

use App\Controller\AppController;
use Cake\Network\Exception\MethodNotAllowedException;

/**
 * Ajax Vaccines Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\VaccinesTable $Vaccines
 */
class VaccinesController extends AppController
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
        $vaccine = $this->Vaccines->patchEntity($this->Vaccines->newEntity(), $this->request->data);
        if ($this->Vaccines->save($vaccine)) {
            $status = true;
            $message = 'La vacuna ha sido guardada';
            $vaccine = $vaccine;
        } else {
            $status = false;
            $message = 'La vacuna no ha sido guardada, intente de nuevo';
            $errors = $this->ErrorAdapter->reduce($vaccine->errors());
        }
        $this->set(compact(['vaccine', 'status', 'message', 'errors']));
        $this->set('_serialize', ['vaccine', 'status', 'message', 'errors']);
    }
}
