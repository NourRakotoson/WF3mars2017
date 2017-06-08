<?php

use Repository\CategoryRepository;
use Repository\ArticleRepository;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

// Ajout doctrine DBAL
// on doit ensuite exécuter
// composer require "doctrine/dbal:~2.2"
// en ligne de commande dans le répertoire de l'application
$app->register( 
        new DoctrineServiceProvider(),
        [
            'db.options' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'dbname' => 'silex-blog',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ]
        ]
);

$app->register( new SessionServiceProvider());


$app['category.repository'] = function () use ($app){
    return new CategoryRepository($app['db']);
};


$app['article.repository'] = function () use ($app){
    return new ArticleRepository($app['db']);
};
return $app;

