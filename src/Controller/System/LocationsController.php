<?php
namespace App\Controller\System;

use PDOException;
use App\Controller\AppController;

/**
 * Locations Controller
 *
 * @property \App\Model\Table\LocationsTable $Locations
 */
class LocationsController extends AppController
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
                'search' => $this->Locations->filterParams($this->request->query),
            ],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'name',
            'direction' => $this->request->query('direction') ?: 'asc',
        ];


        $locations = $this->paginate($this->Locations);

        $this->set(compact('locations'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $location = $this->Locations->newEntity();
        if ($this->request->is('post')) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success('La ciudad ha sido guardada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La ciudad no ha sido guardada, intente de nuevo');
            }
        }
        $this->set(compact('location'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Location id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $location = $this->Locations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success('La ciudad ha sido actualizada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La ciudad no ha sido actualizada, intente de nuevo');
            }
        }
        $this->set(compact('location'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Location id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $location = $this->Locations->get($id);
        try {
            if ($this->Locations->delete($location)) {
                $this->Flash->success('Se ha eliminada la ciudad');
            } else {
                $this->Flash->error('La ciudad no ha sido eliminada, intente de nuevo');
            }
        } catch (PDOException $e) {
            $this->Flash->error('Existen registros que dependen de la ciudad');
        }
        return $this->redirect(['action' => 'index']);
    }
}
