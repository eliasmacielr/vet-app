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
        $customersCount = $this->Customers->find()->count();
        $patientsCount = $this->Patients->find()->count();
        $usersCount = $this->Users->find('admin', ['user' => $user])->count();
        $expiredCount = $this->Vaccinations->find('totalExpired')->count();

        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];

        $this->set(compact('controller', 'action', 'customersCount', 'patientsCount', 'usersCount', 'expiredCount', 'user'));
    }
}
