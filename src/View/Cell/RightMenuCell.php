<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * RightMenu cell
 */
class RightMenuCell extends Cell
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
     *
     * @return void
     */
    public function display()
    {
        // Logged user
        $user = $this->request->session()->read('Auth.User');

        $this->set(compact('user'));
    }
}
