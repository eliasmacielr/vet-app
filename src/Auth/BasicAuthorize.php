<?php
namespace App\Auth;

use Cake\Auth\BaseAuthorize;
use Cake\Network\Request;

/**
 *
 */
class BasicAuthorize extends BaseAuthorize
{

    /**
     * Authorize user
     *
     * @param array $user
     * @param \Cake\Network\Request $request
     */
    public function authorize($user, Request $request)
    {
        $controller = $request->params['controller'];
        $action = $request->params['action'];
        $prefix = isset($request->params['prefix']) ? $request->params['prefix'] : '';
        // if request to system section
        if ($prefix === 'system') {
            // If request to Users controller
            if (strcmp($controller, 'Users') === 0 && in_array($action, ['index', 'view', 'add', 'edit', 'delete'])) {
                if (!in_array($user['group_name'], ['super-admin', 'admin'])) {
                    return false;
                }
            }
        }
        return true;
    }
}
