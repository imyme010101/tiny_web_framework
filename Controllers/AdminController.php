<?php

class AdminController extends \App\Libs\Controller
{
  public $category_lv1 = Array();

  public function __construct() {
    parent::__construct();

    $this->model('Cp');
    
    $this->category_lv1 = $this->cpModel->category(0);

  }

  public function index($clazz, $func)
  {
    $this->{$clazz."_".$func}();
  }

  public function member_list()
  {
    $this->view('admin/index', Array(
      
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
    ));
  }

  public function cp_list()
  {
    $pagination_html = $this->compo('paging', Array(
      'page' => 10,
      'total_row' => 100,
      'total_page' => 10,
      'start' => 0,
      'limit' => 10,
      'paging_limit' => 5,
      'paging_base_url' => "/admin/cp/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    ));

    $this->view('admin/cp/list', Array(
      'title' => '캠페인 관리',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => Array(
        'media' => $this->_config['store']['media'],
        'category_lv1' => $this->category_lv1,
        'pagination_html' => $pagination_html
      )
    ));
  }
}