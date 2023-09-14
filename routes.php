<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  
  $r->addRoute('GET', '/', ['MainController::index']);
  
  $r->addGroup('/member', function($r) {
    $r->addRoute('GET', '/{func}', ["MemberController::get"]);
    $r->addRoute('POST', '/{func}', ["MemberController::post"]);
  });

  $r->addGroup('/campaign', function($r) {
    $r->addRoute('GET', '/{func}', ["CampaignController::get"]);
    $r->addRoute('POST', '/{func}', ["CampaignController::post"]);
  });

  $r->addGroup('/admin', function($r) {
    $r->addRoute('GET', '/{clazz}/{func}', ["AdminController::index"]);
    $r->addRoute('POST', '/{clazz}/{func}', ["AdminController::index"]);
  });
  
  $r->addGroup('/oauth', function($r) {
    $r->addRoute('GET', '/{func}', ["OAuthController::get"]);
    $r->addRoute('POST', '/{func}', ["OAuthController::post"]);
  });

});