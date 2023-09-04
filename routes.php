<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  
  $r->addRoute('GET', '/', ['MainController::index']);
  
  $r->addGroup('/member', function($r) {
    $r->addRoute('GET', '/{func}', ["MemberController::index"]);
  });

  $r->addGroup('/cp', function($r) {
    $r->addRoute('GET', '/config/media', ["CpController::config_media"]);
  });

  $r->addGroup('/admin', function($r) {
    $r->addRoute('GET', '/{clazz}/{func}', ["AdminController::index"]);
  });

  $r->addGroup('/procs', function($r) {
    $r->addRoute('POST', '/{clazz}/{func}', ["ProcController::index"]);
  });
});