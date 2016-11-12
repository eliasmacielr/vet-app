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
        $customers_count = $this->Customers->find()->count();
        $patients_count = $this->Patients->find()->count();
        $expired_today_count = $this->Vaccinations->find('expiredToday')->count();
        $total_expired_count = $this->Vaccinations->find('totalExpired')->count();

        $this->set(compact('customers_count', 'patients_count', 'expired_today_count', 'total_expired_count'));
    }
}
