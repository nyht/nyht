<?php

$container = $app->getContainer();

$container['renderer'] = function ($c) {
    return new Slim\Views\PhpRenderer(__DIR__.'/view/');
};

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
