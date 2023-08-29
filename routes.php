<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  
  $r->addRoute('GET', '/', ['MainController::index']);
  
  $r->addRoute('GET', '/login', ["AuthHook::token_chk//MemberController::get_login"]);




  $r->addGroup('/admin', function($r) {
    $r->addRoute('GET', '', ["AdminController::index"]);
  
    $r->addRoute('GET', '/member/list', ["AdminController::member_list"]);
  });
});