<?php

namespace Controller;
use Silex\Application;

class FirstController
{
    /**
     * Il suffit de demander une instance de Silex\Application
     * en paramètre de la méthode pour y avoir accès
     *
     * @param Application $app
     */
    public function testAction(Application $app)
    {
        return $app['twig']->render('hello.html.twig');
    }

    /**
     * @param Application $app
     * @param string $name Variable passé par le routeur venant de l'URL
     */
    public function testParamAction(Application $app, $name)
    {
        return $app['twig']->render(
            'hello_world.html.twig',
            ['name' => $name]
        );
    }

    public function usersAction(Application $app)
    {
        /**
         * @var Doctrine\DBAL
         */
        $db = $app['db'];

        /**
         * équivaut à faire query puis fetchAll() avec PDO
         */
        $users = $db->fetchAll('SELECT * FROM user');

        return $app['twig']->render(
            'users.html.twig',
            ['users' => $users]
        );

    }

    /**
     * affiche les infos d''un utilisateur par son id passé dans l'URL
     * @param Application $app
     * @param int $userID
     */
    public function userAction(Application $app, $id)
    {
        /**
         * @var Doctrine\DBAL
         */
        $db = $app['db'];

        $user = $db->fetchAssoc("SELECT * FROM user WHERE id = $id");

        return $app['twig']->render(
          'user.html.twig',
          ['user' => $user]
        );
    }
}
