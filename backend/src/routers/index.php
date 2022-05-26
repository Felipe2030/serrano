<?php

use Slim\Factory\AppFactory;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

$app = AppFactory::create();
   require __DIR__ . "/usersRouter.php"; # Rotas de usuarios
$app->run();