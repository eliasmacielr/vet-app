<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class ApiController extends Controller
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
        $this->loadComponent('ErrorAdapter');
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    /**
     * Before render callback.
     * @param \Cake\Event\Event $event The beforeRender event.
     */
    public function beforeRender(Event $event)
    {
        $this->response->cors($this->request)
            ->allowOrigin(['*'])
            ->allowMethods(['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'])
            ->allowHeaders(['X-CSRF-Token', 'Content-type'])
            ->allowCredentials()
            ->maxAge(300)
            ->build();

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
