<?php
namespace App\Controller\System\Ajax;

use App\Controller\AppController;
use Cake\Network\Exception\MethodNotAllowedException;

/**
 * Ajax Locations Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\LocationsTable $Locations
 */
class LocationsController extends AppController
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
        $location = $this->Locations->patchEntity($this->Locations->newEntity(), $this->request->data);
        if ($this->Locations->save($location)) {
            $status = true;
            $message = 'La ciudad ha sido guardada';
            $location = $location;
        } else {
            $status = false;
            $message = 'La ciudad no ha sido guardada, intente de nuevo';
            $errors = $this->ErrorAdapter->reduce($location->errors());
        }
        $this->set(compact(['location', 'status', 'message', 'errors']));
        $this->set('_serialize', ['location', 'status', 'message', 'errors']);
    }
}
