<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/login', ['MemberController::tokenChk//MemberController::get_login']);
});