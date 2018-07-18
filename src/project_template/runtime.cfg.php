<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../app/view/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'nyht-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/log/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];