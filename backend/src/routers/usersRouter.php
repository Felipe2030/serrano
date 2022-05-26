<?php

require __DIR__ . "/../controllers/usersController.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/users',function(Request $request, Response $response, $args){
    $request_data = $request->getQueryParams();
    $users = UsersControllers::getUsers($request_data);
    $response->getBody()->write(json_encode($users));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/users/{id}',function(Request $request, Response $response, $args){
    $users = UsersControllers::getUsersById($args['id']);
    $response->getBody()->write(json_encode($users));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/users',function(Request $request, Response $response, $args){
    $request_data   = $request->getParsedBody();
    $nome           = isset($request_data['nome']) ? $request_data['nome'] : false;
    $sexo           = isset($request_data['sexo']) ? $request_data['sexo'] : false;
    $datanascimento = isset($request_data['datanascimento']) ? $request_data['datanascimento'] : false;
    $idade          = isset($request_data['idade']) ? $request_data['idade'] : false;
   
    if(!$nome && !$sexo && !$datanascimento && !$idate):
        $data = array('ok' => false);
        $response->getBody()->write(json_encode($data));
        $response->withHeader('Content-Type', 'application/json');
        exit();
    endif;
    
    $user = UsersControllers::postUsers($nome, $sexo, $datanascimento, intval($idade));
    $data = array('ok' => true);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/users/{id}',function(Request $request, Response $response, $args){
    $request_data   = $request->getParsedBody();
    $nome           = isset($request_data['nome']) ? $request_data['nome'] : false;
    $sexo           = isset($request_data['sexo']) ? $request_data['sexo'] : false;
    $datanascimento = isset($request_data['datanascimento']) ? $request_data['datanascimento'] : false;
    $idade          = isset($request_data['idade']) ? $request_data['idade'] : false;
   
    if(!$nome && !$sexo && !$datanascimento && !$idate):
        $data = array('ok' => false);
        $response->getBody()->write(json_encode($data));
        $response->withHeader('Content-Type', 'application/json');
        exit();
    endif;
    
    $user = UsersControllers::putUsers($args['id'], $nome, $sexo, $datanascimento, intval($idade));
    $data = array('ok' => true);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/users/{id}',function(Request $request, Response $response, $args){
    UsersControllers::deleteUsers($args['id']);
    $data = array('ok' => true);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});