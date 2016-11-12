<?php

namespace App\Controller;

use DateTime;

/**
 * Movements Controller.
 *
 * @property \App\Model\Table\MovementsTable $Movements
 */
class MovementsController extends AppController
{
    /**
     * Index method.
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $date = $this->request->query('date');

        $date = is_array($date) ? new DateTime($date['year'].'-'.$date['month'].'-'.$date['day']) : new DateTime(date('Y-m-d'));

        $query = $this->Movements->findByMovementDate($date);
        $movements = $this->paginate($query);
        $sum_result = $this->Movements->find('totalSumByDate', ['date' => $date])->first();

        $this->set(compact('movements', 'date', 'sum_result', 'resume'));
    }

    /**
     * View method.
     *
     * @param string|null $id Movement id
     *
     * @return \Cake\Network\Response|null
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found
     */
    public function view($id = null)
    {
        $movement = $this->Movements->get($id);

        $this->set('movement', $movement);
    }

    /**
     * Add method.
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise
     */
    public function add()
    {
        $movement = $this->Movements->newEntity();
        if ($this->request->is('post')) {
            $movement = $this->Movements->patchEntity($movement, $this->request->data);
            if ($this->Movements->save($movement)) {
                $this->Flash->success('El registro ha sido guardado');

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('El registro no ha sido guardado, intente de nuevo');
            }
        }

        $this->set(compact('movement'));
    }

    /**
     * Edit method.
     *
     * @param string|null $id Movement id
     *
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found
     */
    public function edit($id = null)
    {
        $movement = $this->Movements->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movement = $this->Movements->patchEntity($movement, $this->request->data);
            if ($this->Movements->save($movement)) {
                $this->Flash->success('El registro ha sido actualizado');

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('El registro no ha sido actualizado, intente de nuevo');
            }
        }
        $this->set(compact('movement'));
    }

    /**
     * Delete method.
     *
     * @param string|null $id Movement id
     *
     * @return \Cake\Network\Response|null Redirects to index
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movement = $this->Movements->get($id);
        if ($this->Movements->delete($movement)) {
            $this->Flash->success('El registro ha sido eliminado');
        } else {
            $this->Flash->error('El registro no ha sido eliminado, intente de nuevo');
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Show year movement resume.
     *
     * @return \Cake\Network\Response|null
     */
    public function resume()
    {
        $date = new DateTime($this->request->query('date')['year'].'-1-1');
        $resume = $this->Movements->find('yearResume', ['date' => $date])->first();
        $this->set(compact('date', 'resume'));
    }

    /**
     * Show a year resume chart.
     */
    public function showChart()
    {
        $date = new DateTime($this->request->query('date')['year'].'-1-1');
        $resume = $this->Movements->find('yearResume', ['date' => $date])->first();
        $income = [
            $resume->jan_income,
            $resume->feb_income,
            $resume->mar_income,
            $resume->apr_income,
            $resume->may_income,
            $resume->june_income,
            $resume->july_income,
            $resume->aug_income,
            $resume->sept_income,
            $resume->oct_income,
            $resume->nov_income,
            $resume->dec_income,
        ];

        $outcome = [
            $resume->jan_outcome,
            $resume->feb_outcome,
            $resume->mar_outcome,
            $resume->apr_outcome,
            $resume->may_outcome,
            $resume->june_outcome,
            $resume->july_outcome,
            $resume->aug_outcome,
            $resume->sept_outcome,
            $resume->oct_outcome,
            $resume->nov_outcome,
            $resume->dec_outcome,
        ];
        $this->set(compact('date', 'resume'));
    }
}
