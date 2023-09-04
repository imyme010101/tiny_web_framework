<?php

class AdminController extends \App\Libs\Controller
{
  public $category_lv1 = Array();
  public $category_lv2 = Array();

  public function __construct() {
    parent::__construct();

    $this->model('Cp');
    
    $this->category_lv1 = $this->cpModel->category(0);

    foreach($this->category_lv1 as $category) {
      $this->category_lv2[$category['idx']] = $this->cpModel->category($category['idx']);
    }
  }

  public function index($clazz, $func)
  {
    $this->{$clazz."_".$func}();
  }

  public function member_list()
  {
    $this->model('Member');

    $ratings = $this->memberModel->get_roles(1);
    $ratings_txt = Array();
    foreach($ratings as $rating) {
      $ratings_txt[$rating['role']] = $rating['name'];
    }
    $penaltys = $this->memberModel->get_roles(2);
    $penaltys_txt = Array();
    foreach($penaltys as $penalty) {
      $penaltys_txt[$penalty['role']] = $penalty['name'];
    }

    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = 10;
    $start = ($page - 1) * $limit;

    $member_result = $this->memberModel->get_list($start, $limit);

    $total_row = $member_result['total_row'];
    $total_page = ceil(($total_row / $limit));

    $pagination_html = $this->compo('paging', Array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'paging_limit' => 10,
      'paging_base_url' => "/admin/member/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    ));

    $this->view('admin/member/list', Array(
      'title' => '회원 관리',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => Array(
        'media' => $this->_config['store']['media'],
        'ratings' => $ratings,
        'ratings_txt' => $ratings_txt,
        'penaltys' => $penaltys,
        'penaltys_txt' => $penaltys_txt,
        'lists' => $member_result['lists'],
        'pagination_html' => $pagination_html
      )
    ));
  }

  public function member_view() {
    $this->model('Member');

    $view = $this->memberModel->get_member_by_id(@$_GET['id']);

    $penaltys = $this->memberModel->get_roles(2);
    $penaltys_txt = Array();
    foreach($penaltys as $penalty) {
      $penaltys_txt[$penalty['role']] = $penalty['name'];
    }

    $this->view('admin/member/detail', Array(
      'title' => '회원 정보',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => Array(
        'view' => $view,
        'media' => $this->_config['store']['media'],
        'penaltys' => $penaltys,
        'penaltys_txt' => $penaltys_txt,
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    ));
  }

  public function member_write() {
    $this->model('Member');

    if($_GET['id']) {
      $view = $this->memberModel->get_member_by_id(@$_GET['id']);
    } else {
      $view = Array();
    }

    $address_html = $this->compo('address', Array());

    $this->view('admin/member/write', Array(
      'title' => '회원 추가',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => Array(
        'view' => $view,
        'address_html' => $address_html,
        'media' => $this->_config['store']['media'],
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    ));
  }

  public function cp_list()
  {
    $this->model('Cp');

    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = 10;
    $start = ($page - 1) * $limit;

    $campaign_result = $this->cpModel->get_list($start, $limit);

    $total_row = $campaign_result['total_row'];
    $total_page = ceil(($total_row / $limit));

    $pagination_html = $this->compo('paging', Array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'lists' => $campaign_result['lists'],
      'paging_limit' => 10,
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

  public function cp_write() {
    $this->view('admin/cp/write', Array(
      'title' => '캠페인 작성',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => Array(
        'media' => $this->_config['store']['media'],
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    ));
  }
}