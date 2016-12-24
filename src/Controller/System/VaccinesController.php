<?php
namespace App\Controller\System;

use PDOException;
use App\Controller\AppController;

/**
 * Vaccines Controller
 *
 * @property \App\Model\Table\VaccinesTable $Vaccines
 */
class VaccinesController extends AppController
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
                'search' => $this->Vaccines->filterParams($this->request->query),
            ],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'name',
            'direction' => $this->request->query('direction') ?: 'asc',
        ];

        $vaccines = $this->paginate($this->Vaccines);

        $this->set(compact('vaccines'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vaccine = $this->Vaccines->newEntity();
        if ($this->request->is('post')) {
            $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->data);
            if ($this->Vaccines->save($vaccine)) {
                $this->Flash->success('La vacuna ha sido guardada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La vacuna no ha sido guardada');
            }
        }
        $this->set(compact('vaccine'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vaccine id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vaccine = $this->Vaccines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->data);
            if ($this->Vaccines->save($vaccine)) {
                $this->Flash->success('La vacuna ha sido actualizada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La vacuna no ha sido actualizada, intente de nuevo');
            }
        }
        $this->set(compact('vaccine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vaccine id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vaccine = $this->Vaccines->get($id);
        try {
            if ($this->Vaccines->delete($vaccine)) {
                $this->Flash->success('La vacuna ha sido eliminada');
            } else {
                $this->Flash->error('La vacuna no ha sido eliminada, intente de nuevo');
            }
        } catch (PDOException $e) {
            $this->Flash->error('No se puede eliminar el registro, existen registros que dependen de el');
        }


        return $this->redirect(['action' => 'index']);
    }
}
