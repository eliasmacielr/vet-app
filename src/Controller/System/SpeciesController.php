<?php
namespace App\Controller\System;

use PDOException;
use App\Controller\AppController;

/**
 * Species Controller
 *
 * @property \App\Model\Table\SpeciesTable $Species
 */
class SpeciesController extends AppController
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
                'search' => $this->Species->filterParams($this->request->query),
            ],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'name',
            'direction' => $this->request->query('direction') ?: 'asc',
        ];

        $species = $this->paginate($this->Species);

        $this->set(compact('species'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $species = $this->Species->newEntity();
        if ($this->request->is('post')) {
            $species = $this->Species->patchEntity($species, $this->request->data);
            if ($this->Species->save($species)) {
                $this->Flash->success('La especie ha sido guardada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La especie no ha sido guardada, intente de nuevo');
            }
        }
        $this->set(compact('species'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Species id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $species = $this->Species->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $species = $this->Species->patchEntity($species, $this->request->data);
            if ($this->Species->save($species)) {
                $this->Flash->success('La especie ha sido actualizada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La especie no ha sido actualizada, intente de nuevo');
            }
        }
        $this->set(compact('species'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Species id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $species = $this->Species->get($id);
        try {
            if ($this->Species->delete($species)) {
                $this->Flash->success('La especie ha sido eliminada');
            } else {
                $this->Flash->error('La especie no ha sido eliminada, intente de nuevo');
            }
        } catch (PDOException $e) {
            $this->Flash->error('Existen registros que dependen de la especie');
        }

        return $this->redirect(['action' => 'index']);
    }
}
