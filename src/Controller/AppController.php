<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org).
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller.
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if (!empty($this->request->data())) {
            array_walk_recursive($this->request->data,
                function (&$item, $key) {
                    if (is_string($item)) {
                        $item = trim($item);
                    }
                }
            );
        }
    }

    /**
     * Initialization hook method.
     * Use this method to add common initialization code like loading components.
     * e.g. `$this->loadComponent('Security');`
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $prefix = isset($this->request->params['prefix']) ? $this->request->params['prefix'] : '';
        if ($prefix === 'system' || $prefix === 'system/ajax') {
            $this->loadComponent('Auth', [
                'authorize' => 'Basic',
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'email', 'password' => 'password'],
                        'finder' => 'auth',
                    ],
                ],
                'loginAction' => ['controller' => 'Auth', 'action' => 'login', 'prefix' => 'system'],
                'loginRedirect' => ['controller' => 'Home', 'action' => 'index', 'prefix' => 'system'],
                'logoutRedirect' => ['controller' => 'Auth', 'action' => 'login', 'prefix' => 'system'],
                'flash' => [
                    'element' => 'auth',
                ],
            ]);
        }
    }

    /**
     * Before render callback.
     * @param \Cake\Event\Event $event The beforeRender event.
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
