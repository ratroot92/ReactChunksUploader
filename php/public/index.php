<?php
require __DIR__ . '/../vendor/autoload.php';



$app = new \Slim\App(array('settings' => [
    'displayErrorDetails' => true, // set to false in production
    // 'outputBuffering' => true,
]));
// $container = $app->getContainer();
// $container['upload_directory'] = '/home/maliksblr92/Desktop/development/clipbucket/php/uploads';



// Middlewares routes

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization ,Cache-Control')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


// Register routes
require __DIR__ . './../src/routes.php';








// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});




//Start server
$app->run();