<?php

namespace Config;

use App\Controllers\FilmsDb;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// login
$routes->get('/', 'Login::index', ['filter' => 'loginStatus']);
$routes->post('login-auth', 'Login::auth');
$routes->get('register','Register::index');
$routes->post('register', 'Register::register');
$routes->get('log-out', 'Logout::index');


$routes->group('', ['filter' => 'authCheck'], static function ($routes) {


    // users
    $routes->get('users', 'Users::getUsers');
    $routes->post('users', 'Users::editUsers');
    $routes->get('add-users', 'Users::addUsersView');
    $routes->post('add-users', 'Users::addUsers');
    $routes->put('update-users', 'Users::updateUsers');



    // log
    $routes->get('log', 'Log::getAllLog');
    $routes->get('log-view', 'Log::getAllLogView');

    
    
    $routes->group('admin', static function ($routes) {
        $routes->get('', 'FilmsDb::films');
        $routes->get('post-add', 'FilmsDb::postAdd');
        $routes->get('post-data', 'FilmsDb::postView');
        $routes->post('post-add', 'FilmsDb::filmsInsert');
        $routes->delete('post-delete/(:num)', 'FilmsDb::filmsDelete/$1');

        // post edit
        $routes->post('edit', 'FilmsDb::filmsEdit');
        $routes->put('post-edit', 'FilmsDb::edit');

        // episode
        $routes->post('episode', 'FilmsDb::episode');
        $routes->post('episode-add', 'FilmsDb::addEpisode');

        // link
        $routes->post('link', 'FilmsDb::link');
        $routes->post('link-edit', 'FilmsDb::linkEdit');

        //movie
        $routes->get('post-movie', 'FilmsDB::FilmsByMovie');
        $routes->get('post-series', 'FilmsDB::FilmsBySeries');

        // edit status
        $routes->post('update-status', 'FilmsDb::updateStatus');

        //genre
        $routes->get('genre-add','Genre::index');
        $routes->post('genre-add','Genre::addGenre');
        $routes->get('genre-data','Genre::genreView');
        $routes->delete('genre-delete/(:num)','Genre::deleteGenre/$1');
        $routes->post('genre-edit','Genre::editGenre');
        $routes->post('genre-update','Genre::updateGenre');
    });
});

$routes->group('api', ['filter' => 'jwtCheck'], static function ($routes) {
    $routes->get('filmsAll/(:num)/(:num)', 'Films::films/$1/$2');
    $routes->get('filmscount', 'Films::countFilms');
    $routes->get('genrecount/(:alpha)', 'Films::countgenre/$1');
    $routes->get('films/(:num)', 'Films::filmsById/$1');
    $routes->get('filmsrandom', 'Films::filmsRandom');
    $routes->get('link/(:segment)', 'Films::filmsLink/$1');
    $routes->get('films/(:alpha)/(:num)/(:num)', 'Films::filmsByGenre/$1/$2/$3');
    $routes->get('films/type/(:alpha)/(:num)/(:num)', 'Films::filmsByType/$1/$2/$3');
    $routes->get('counttipe/(:alpha)', 'Films::countType/$1');
    $routes->post('films', 'Films::filmsInsert');
    $routes->delete('films/delete/(:segment)', 'Films::deleteFilms/$1');

    // image for cache
    $routes->get('image-cache/', 'Films::getImageCache');

    $routes->get('views/(:num)', 'Films::getViews/$1');
    $routes->get('views-update/(:num)', 'Films::updateViews/$1');
    $routes->get('views-all/', 'Films::getAllViews');

    // insert log
    $routes->post('log', 'Log::logInsert');
    $routes->get('getlog', 'Log::getlog');

    // search
    $routes->get('search/(:segment)', 'Films::filmsSearch/$1');
    
    // genre
    
    
    // jwt
});
$routes->get('genre/', 'Films::getGenre');
$routes->post('jwttoken', 'JwtAuth::index');

// $routes->group('apii',['filter'=>'jwtCheck'],static function($routes){
//     $routes->get('filmsAll/(:num)/(:num)', 'Films::films/$1/$2');
// });

$routes->post('new-access-token/', 'JwtAuth::getNewAccessToken');

$routes->get('images/(:segment)', 'Films::showImage/$1');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
