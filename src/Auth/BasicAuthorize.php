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

        if (strcmp($controller, 'Users') === 0) {
            if (strcmp($user['group_name'], 'admin') !== 0) {
                return false;
            }
        }

        return true;
    }
}
