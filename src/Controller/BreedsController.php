<?php
namespace App\Controller;

use PDOException;
use App\Controller\AppController;

/**
 * Breeds Controller
 *
 * @property \App\Model\Table\BreedsTable $Breeds
 */
class BreedsController extends AppController
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
                'search' => $this->Breeds->filterParams($this->request->query),
            ],
            'contain' => ['Species'],
            'sortWhitelist' => ['name', 'Species.name'],
            'limit' => $this->request->query('limit') ?: 10,
            'sort' => $this->request->query('sort') ?: 'name',
            'direction' => $this->request->query('direction') ?: 'asc',
        ];
        $breeds = $this->paginate($this->Breeds);

        $this->set(compact('breeds'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $breed = $this->Breeds->newEntity();
        if ($this->request->is('post')) {
            $breed = $this->Breeds->patchEntity($breed, $this->request->data);
            if ($this->Breeds->save($breed)) {
                $this->Flash->success('La raza ha sido guardada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La raza no ha sido guardada, intente de nuevo');
            }
        }
        $species = $this->Breeds->Species->find('list');
        $this->set(compact('breed', 'species'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Breed id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $breed = $this->Breeds->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $breed = $this->Breeds->patchEntity($breed, $this->request->data);
            if ($this->Breeds->save($breed)) {
                $this->Flash->success('La raza ha sido actualizada');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La raza no ha sido actualizada, intente de nuevo');
            }
        }
        $species = $this->Breeds->Species->find('list');
        $this->set(compact('breed', 'species'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Breed id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $breed = $this->Breeds->get($id);
        try {
            if ($this->Breeds->delete($breed)) {
                $this->Flash->success('La raza ha sido eliminada');
            } else {
                $this->Flash->error('La raza no ha sido eliminada, intente de nuevo');
            }
        } catch (PDOException $e) {
            $this->Flash->error('Existen pacientes que dependen de la raza');
        }

        return $this->redirect(['action' => 'index']);
    }
}
