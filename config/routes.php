<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->prefix('system', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Home', 'action' => 'index']);

        $routes->connect('/login', ['controller' => 'Auth', 'action' => 'login']);
        $routes->connect('/logout', ['controller' => 'Auth', 'action' => 'logout']);
        /**
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        // $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

        $routes->scope('/locations', ['controller' => 'Locations'], function (RouteBuilder $routes) {
            // $routes->extensions(['json', 'xml']);
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/customers', ['controller' => 'Customers'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/species', ['controller' => 'Species'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/breeds', ['controller' => 'Breeds'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/patients', ['controller' => 'Patients'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add/:customer_id', ['action' => 'add'], ['pass' => ['customer_id'], 'customer_id' => '[0-9]+']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/view/:id', ['action' => 'view'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/edit/:id/:customer_id', ['action' => 'edit'], ['pass' => ['id', 'customer_id'], 'id' => '[0-9]+', 'customer_id' => '[0-9]+']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id/:customer_id', ['action' => 'delete'], ['pass' => ['id', 'customer_id'], 'id' => '[0-9]+', 'customer_id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/vaccines', ['controller' => 'Vaccines'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
        });

        $routes->scope('/vaccinations', ['controller' => 'Vaccinations'], function (RouteBuilder $routes) {
            $routes->connect('/add/:patient_id', ['action' => 'add'], ['pass' => ['patient_id'], 'patient_id' => '[0-9]+']);
            $routes->connect('/edit/:id/:patient_id', ['action' => 'edit'], ['pass' => ['id', 'patient_id'], 'id' => '[0-9]+', 'patient_id' => '[0-9]+']);
            $routes->connect('/delete/:id/:patient_id', ['action' => 'delete'], ['pass' => ['id', 'patient_id'], 'id' => '[0-9]+', 'patient_id' => '[0-9]+']);
            $routes->connect('/expired', ['action' => 'showExpired']);
        });

        $routes->scope('/observations', ['controller' => 'Observations'], function (RouteBuilder $routes) {
            $routes->connect('/:patient_id', ['action' => 'index'], ['pass' => ['patient_id'], 'patient_id' => '[0-9]+']);
            $routes->connect('/add/:patient_id', ['action' => 'add'], ['pass' => ['patient_id'], 'patient_id' => '[0-9]+']);
            $routes->connect('/edit/:id/:patient_id', ['action' => 'edit'], ['pass' => ['id', 'patient_id'], 'id' => '[0-9]+', 'patient_id' => '[0-9]+']);
            $routes->connect('/delete/:id/:patient_id', ['action' => 'delete'], ['pass' => ['id', 'patient_id'], 'id' => '[0-9]+', 'patient_id' => '[0-9]+']);
        });

        $routes->scope('/movements', ['controller' => 'Movements'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/resume', ['action' => 'resume']);
            $routes->connect('/show-chart', ['action' => 'showChart']);
        });

        $routes->scope('/users', ['controller' => 'Users'], function (RouteBuilder $routes) {
            $routes->connect('/', ['action' => 'index']);
            $routes->connect('/add', ['action' => 'add']);
            $routes->connect('/edit/:id', ['action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/delete/:id', ['action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
            $routes->connect('/change-password', ['action' => 'changePassword']);
            $routes->connect('/edit-profile', ['action' => 'editProfile']);
        });

        $routes->prefix('ajax', function (RouteBuilder $routes) {
            $routes->scope('/locations', ['controller' => 'Locations'], function (RouteBuilder $routes) {
                $routes->connect('/add', ['action' => 'add']);
            });

            $routes->scope('/species', ['controller' => 'Species'], function (RouteBuilder $routes) {
                $routes->connect('/', ['action' => 'index']);
            });

            $routes->scope('/breeds', ['controller' => 'Breeds'], function (RouteBuilder $routes) {
                $routes->connect('/add', ['action' => 'add']);
            });

            $routes->scope('/vaccines', ['controller' => 'Vaccines'], function (RouteBuilder $routes) {
                $routes->connect('/add', ['action' => 'add']);
            });
        });
        $routes->fallbacks(DashedRoute::class);
    });

    $routes->prefix('api', function (RouteBuilder $routes) {
        $routes->resources('Breeds');
        $routes->resources('Customers');
        $routes->resources('Locations');
        $routes->resources('Movements');
        $routes->resources('Observations');
        $routes->resources('Patients');
        $routes->resources('Species');
        $routes->resources('Users');
        $routes->resources('Vaccinations');
        $routes->resources('Vaccines');
    });

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
