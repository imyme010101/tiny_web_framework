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

  public function config_media() {
    $this->responseApi(200, "사용중인 미디어 메체", $this->_config['store']['media']);
  }
}