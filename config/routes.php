<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
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
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        $builder->connect('/catalogue', ['controller'=>'Pages', 'action' => 'catalogue']);

        $builder->connect('/domains/:id/resources', ['controller' => 'Domains', 'action' => 'resources'])
        ->setPass(['id']);


         $builder->connect('/resources/:id/reservations/dates/:id_reservation', ['controller' => 'Resources', 'action' => 'getCurrentReservationsDates'])
        ->setPass(['id','id_reservation']);

        $builder->connect('/resources/:id/reservations/dates', ['controller' => 'Resources', 'action' => 'getCurrentReservationsDates'])
        ->setPass(['id']);

         $builder->connect('/resources/:id/max_duration', ['controller' => 'Resources', 'action' => 'getMaxDuration'])
        ->setPass(['id']);


        $builder->connect('/error/denied', ['controller'=>'Error', 'action' => 'denied']);

         $builder->connect('reservations/upcoming-reservations/week/:d1/:d2', ['controller' => 'Reservations', 'action' => 'getWeekReservationsBetween'])
        ->setPass(['d1','d2']);

        $builder->connect('reservations/upcoming-reservations/month/:d1/:d2', ['controller' => 'Reservations', 'action' => 'getMonthReservationsBetween'])
        ->setPass(['d1','d2']);

         $builder->connect('closing-dates/dates/:d1/:d2', ['controller' => 'ClosingDates', 'action' => 'getAllClosingsDatesBeetween'])
        ->setPass(['d1','d2']);

        $builder->connect('closing-dates/dates/', ['controller' => 'ClosingDates', 'action' => 'getAllClosingsDatesAfterToday']);

        $builder->connect('reservations/stats/reservations_count/', ['controller' => 'Reservations', 'action' => 'getResourcesStats']);

        $builder->connect('reservations/stats/reservations_count/:d1/:d2', ['controller' => 'Reservations', 'action' => 'getResourcesStats'])
        ->setPass(['d1','d2']);

        
        // $builder->connect('reservations/upcoming-reservations/reservations_between/:d1/:d2', ['controller' => 'Reservations', 'action' => 'getReservationsBetween'])
        // ->setPass(['d1','d2']);

        $builder->connect('reservations/upcoming-reservations/reservations_between', ['controller' => 'Reservations', 'action' => 'getReservationsBetween']);
        $builder->connect('reservations/index-user/upcoming-reservations/reservations_between', ['controller' => 'Reservations', 'action' => 'getUserReservationsBetween']);

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
