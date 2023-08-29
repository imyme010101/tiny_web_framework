<?php

class AdminController extends \App\Libs\Controller
{
  public function index()
  {
    $this->view('admin/index', Array(

      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
    ));
  }

  public function member_list()
  {
    $this->view('admin/index', Array(
      
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
    ));
  }
}