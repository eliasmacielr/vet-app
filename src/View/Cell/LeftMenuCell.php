<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * LeftMenu cell.
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @property \App\Model\Table\PatientsTable $Patients
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\VaccinationsTable $Vaccinations
 */
class LeftMenuCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     */
    public function display()
    {
        $this->loadModel('Customers');
        $this->loadModel('Patients');
        $this->loadModel('Users');
        $this->loadModel('Vaccinations');

        // Logged user
        $user = $this->request->session()->read('Auth.User');

        // Count registers
        $customers_count = $this->Customers->find()->count();
        $patients_count = $this->Patients->find()->count();
        $users_count = $this->Users->find()->count();
        $expired_count = $this->Vaccinations->find('totalExpired')->count();

        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];

        $this->set(compact('controller', 'action', 'customers_count', 'patients_count', 'users_count', 'expired_count', 'user'));
    }
}
