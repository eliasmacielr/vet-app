<?php
namespace App\Controller\Api;

use App\Controller\ApiController;

/**
 * Vaccinations Controller
 *
 * @property \App\Controller\Component\ErrorAdapterComponent $ErrorAdapter
 * @property \App\Model\Table\VaccinationsTable $Vaccinations
 */
class VaccinationsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            "finder" => [
                "search" => $this->Vaccinations->filterParams($this->request->params),
            ],
        ];
        $vaccinations = $this->paginate($this->Vaccinations);
        $status = true;
        $this->set(compact(['vaccinations', 'status']));
        $this->set('_serialize', ['vaccinations', 'status']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vaccination = $this->Vaccinations->get($id);
        $status = true;
        $this->set(compact(['vaccination', 'status']));
        $this->set('_serialize', ['vaccination', 'status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $vaccination = $this->Vaccinations->newEntity();
        $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->data);
        if ($this->Vaccinations->save($vaccination)) {
            $status = true;
            $message = "Se ha guardado el registro";
        } else {
            $status = false;
            $message = "No se ha guardado el registro";
            $errors = $this->ErrorAdapter->reduce($vaccination->errors());
        }

        $this->set(compact(['vaccination', 'message', 'status', 'errors']));
        $this->set('_serialize', ['vaccination', 'status', 'message', 'errors']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['put']);
        $vaccination = $this->Vaccinations->get($id);
        $vaccination = $this->Vaccinations->patchEntity($vaccination, $this->request->data);

        if ($this->Vaccinations->save($vaccination)) {
            $status = true;
            $message = "Se ha editado el registro";
        } else {
            $status = false;
            $message = "No se ha editado el registro";
            $errors = $this->ErrorAdapter->reduce($vaccination->errors());
        }

        $this->set(compact(['vaccination', 'status', 'message', 'errors']));
        $this->set('_serialize', ['vaccination', 'status', 'message', 'errors']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $vaccination = $this->Vaccinations->get($id);
        if ($this->Vaccinations->delete($vaccination)) {
            $status = true;
            $message = "Se ha borrado el registro";
        } else {
            $status = false;
            $message = "No se ha borrado el registro";
        }
        $this->set(compact(['status', 'message']));
        $this->set('_serialize', ['status', 'message']);
    }
}
