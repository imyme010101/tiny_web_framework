<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Configs/config.php";
include_once $_config['ROOT_PATH'] . '/vendor/autoload.php';

$folder = $_config['ROOT_PATH'] . '/Libs';
$files = glob($folder . '/*.class.php');
foreach ($files as $file) {
  require_once $file;
}

$folder = $_config['ROOT_PATH'] . '/Controllers';
$files = glob($folder . '/*.php');
foreach ($files as $file) {
    require_once $file;
}
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
require_once $_config['ROOT_PATH'] . '/routes.php';

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:

      break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    echo "Method not allowed";
      $allowedMethods = $routeInfo[1];
      // ... 405 Method Not Allowed
      break;
  case FastRoute\Dispatcher::FOUND:
    $dice = new \App\Libs\Dice;

    $routeRules = explode('//', $routeInfo[1][0]);
    
    foreach($routeRules as $rule) {
      $rule_call = explode('::', $rule);

      $controllerName = $rule_call[0]; // "UserController"
      $action = $rule_call[1]; // "list" action
      $parameters = $routeInfo[2]; // Action parameters list (e.g. route parameters list)
      
      $controller = $dice->create($controllerName); // UserController instance
      call_user_func_array(
        [$controller, $action] // callable
        , $parameters
      );
    }
    

      break;
}