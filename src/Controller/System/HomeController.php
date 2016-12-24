<?php
namespace App\Controller\System;

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
        $customersCount = $this->Customers->find()->count();
        $patientsCount = $this->Patients->find()->count();
        $expiredTodayCount = $this->Vaccinations->find('expiredToday')->count();
        $totalExpiredCount = $this->Vaccinations->find('totalExpired')->count();

        $this->set(compact('customersCount', 'patientsCount', 'expiredTodayCount', 'totalExpiredCount'));
    }
}
