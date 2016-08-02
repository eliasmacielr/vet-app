<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Home Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @property \App\Model\Table\PatientsTable $Patients
 * @property \App\Model\Table\VaccinationsTable $Vaccinations
 */
class HomeController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Customers');
        $this->loadModel('Patients');
        $this->loadModel('Vaccinations');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $countCustomers = $this->Customers->find()->count();
        $countPatients = $this->Patients->find()->count();
        $countExpiredToday = $this->Vaccinations->find('expiredToday')->count();
        $countTotalExpired = $this->Vaccinations->find('totalExpired')->count();

        $this->set(compact('countCustomers', 'countPatients', 'countExpiredToday', 'countTotalExpired'));
    }
}
