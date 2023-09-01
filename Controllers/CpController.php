<?php

class CpController extends \App\Libs\Controller
{
  public $category_lv1 = Array();
  public $category_detail = Array();

  public function __construct() {
    parent::__construct();

    $this->model('Cp');
  }

  public function index($clazz, $func)
  {
    $this->{$clazz."_".$func}();
  }


}