<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'outputBuffering' => false,
        // 'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // 'determineRouteBeforeAppMiddleware' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        // 'logger' => [
        //     'name' => 'slim-app',
        //     'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
        //     'level' => \Monolog\Logger::DEBUG,
        // ],
        // 'db' => [
        //     'driver' => 'mysql',
        //     'host' => env('DB_HOST'),
        //     'database' => env('DB_DATABASE'),
        //     'username' => env('DB_USERNAME'),
        //     'password' => env('DB_PASSWORD'),
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_unicode_ci',
        //     'prefix'    => '',
        // ],
        // 'mongo' => [
        //     'host' => env('MONGO_HOST'),
        //     'database' => env('MONGO_DATABASE'),
        //     'username' => env('MONGO_USERNAME'),
        //     'password' => env('MONGO_PASSWORD'),
        //     'port' => env('MONGO_PORT')
        // ]
    ],
];
