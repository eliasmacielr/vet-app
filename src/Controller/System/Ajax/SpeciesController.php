<?php
namespace App\Controller\System\Ajax;

use App\Controller\AppController;

/**
 * Species Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\SpeciesTable $Species
 */
class SpeciesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ErrorAdapter');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['ajax']);
        $species = $this->Species->find();
        $status = true;
        $this->set(compact(['species', 'status']));
        $this->set('_serialize', ['species', 'status']);
    }
}
