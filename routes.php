<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/login', ['AuthHook::token_chk//MemberController::get_login']);
});