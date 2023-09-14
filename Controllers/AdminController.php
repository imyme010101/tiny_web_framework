<?php

class AdminController extends \App\Libs\Controller
{
  public $category_lv1 = array();
  public $category_lv2 = array();

  public function __construct()
  {
    parent::__construct();

    $this->model('Campaign');

    $category_lv1 = $this->campaignModel->category(0);
    foreach ($category_lv1 as $lv1) {
      $this->category_lv1[$lv1['idx']] = $lv1['name'];
      $category_lv2 = $this->campaignModel->category($lv1['idx']);
      foreach ($category_lv2 as $lv2) {
        $this->category_lv2[$lv1['idx']][$lv2['idx']] = $lv2['name'];
      }
    }
  }

  public function index($clazz, $func)
  {
    $this->{$clazz . "_" . $func}();
  }

  public function member_list()
  {
    $this->model('Member');

    $ratings = $this->memberModel->get_roles(1);
    $ratings_txt = array();
    foreach ($ratings as $rating) {
      $ratings_txt[$rating['role']] = $rating['name'];
    }
    $penaltys = $this->memberModel->get_roles(2);
    $penaltys_txt = array();
    foreach ($penaltys as $penalty) {
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

    $pagination_html = $this->compo('paging', array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'paging_limit' => 10,
      'paging_base_url' => "/admin/member/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    )
    );

    $this->view('admin/member/list', array(
      'title' => '회원 관리',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => array(
        'media' => $this->_config['store']['media'],
        'ratings' => $ratings,
        'ratings_txt' => $ratings_txt,
        'penaltys' => $penaltys,
        'penaltys_txt' => $penaltys_txt,
        'lists' => $member_result['lists'],
        'pagination_html' => $pagination_html
      )
    )
    );
  }

  public function member_view()
  {
    $this->model('Member');

    $view = $this->memberModel->get_member_by_id(@$_GET['id']);

    $penaltys = $this->memberModel->get_roles(2);
    $penaltys_txt = array();
    foreach ($penaltys as $penalty) {
      $penaltys_txt[$penalty['role']] = $penalty['name'];
    }

    $penalty_list = $this->memberModel->get_pelalty_list($_GET['id'], 0, 100);

    $this->view('admin/member/detail', array(
      'title' => '회원 정보',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => array(
        'view' => $view,
        'penalty_list' => $penalty_list,
        'media' => $this->_config['store']['media'],
        'penaltys' => $penaltys,
        'penaltys_txt' => $penaltys_txt,
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    )
    );
  }

  public function member_write()
  {
    $this->model('Member');

    if ($_GET['id']) {
      $view = $this->memberModel->get_member_by_id(@$_GET['id']);
    } else {
      $view = array();
    }

    $address_html = $this->compo('address', array());

    $this->view('admin/member/write', array(
      'title' => '회원 추가',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => array(
        'view' => $view,
        'address_html' => $address_html,
        'media' => $this->_config['store']['media'],
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    )
    );
  }

  public function wallet_list()
  {
    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = 10;
    $start = ($page - 1) * $limit;

    $wallet_result = $this->memberModel->get_wallet_list($start, $limit);

    $total_row = $wallet_result['total_row'];
    $total_page = ceil(($total_row / $limit));

    $pagination_html = $this->compo('paging', array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'paging_limit' => 10,
      'paging_base_url' => "/admin/wallet/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    )
    );

    $this->view('admin/wallet/list', array(
      'title' => '포인트 관리',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => array(
        'media' => $this->_config['store']['media'],
        'lists' => $wallet_result['lists'],
        'pagination_html' => $pagination_html
      )
    )
    );
  }

  public function campaign_list()
  {
    $this->model('campaign');

    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = 10;
    $start = ($page - 1) * $limit;

    $sns = @$_GET['sns'];

    $md = @$_GET['md'];
    $category = @$_GET['category'];
    $area = @$_GET['area'];
    $sort = @$_GET['sort'] ? @$_GET['sort'] : 'created_at';

    $date_start = @$_GET['date_start'];
    $date_end = @$_GET['date_end'];

    $status = @$_GET['status'];

    $campaign_result = $this->campaignModel->get_list($start, $limit, $md, $category, $area, $sns, $sort, $date_start, $date_end, $status);

    $total_row = $campaign_result['total_row'];
    $total_page = ceil(($total_row / $limit));

    $pagination_html = $this->compo('paging', array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'paging_limit' => $limit,
      'paging_base_url' => "/admin/campaign/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    )
    );

    $this->view('admin/campaign/list', array(
      'title' => '캠페인 관리',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => array(
        'media' => $this->_config['store']['media'],
        'lists' => $campaign_result['lists'],
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2,
        'pagination_html' => $pagination_html
      )
    )
    );
  }

  public function campaign_write()
  {
    $address_html = $this->compo('address', array());

    if (@$_GET['idx']) {
      $write = $this->campaignModel->get_view(@$_GET['idx']);
    } else {
      $write = array();
    }

    $category_depth = str_split(@$write['category_depth'], 3);
    foreach ($category_depth as &$depth) {
      $depth = (int) $depth;
    }

    $this->view('admin/campaign/write', array(
      'title' => '캠페인 ' . (@$_GET['idx'] ? '수정' : '작성'),
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => array(
        'address_html' => $address_html,
        'write' => $write,
        'media' => $this->_config['store']['media'],
        'area' => $this->_config['store']['area'],
        'category_depth' => @$category_depth,
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2
      )
    )
    );
  }


  public function campaign_apply_view()
  {
    $idx = $_REQUEST['idx'];
    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = @$_GET['limit'] ? @$_GET['limit'] : 10;
    $start = ($page - 1) * $limit;


    $campaign_result = $this->campaignModel->get_apply_list($start, $limit);

    $total_row = $campaign_result['total_row'];
    $total_page = ceil(($total_row / $limit));

    $view = $this->campaignModel->get_view($idx);

    $this->model('member');

    $ratings = $this->memberModel->get_roles(1);
    $ratings_txt = array();
    foreach ($ratings as $rating) {
      $ratings_txt[$rating['role']] = $rating['name'];
    }
    $penaltys = $this->memberModel->get_roles(2);
    $penaltys_txt = array();
    foreach ($penaltys as $penalty) {
      $penaltys_txt[$penalty['role']] = $penalty['name'];
    }


    $pagination_html = $this->compo('paging', array(
      'page' => $page,
      'total_row' => $total_row,
      'total_page' => $total_page,
      'start' => $start,
      'limit' => $limit,
      'paging_limit' => $limit,
      'paging_base_url' => "/admin/campaign/list",
      'paging_url' => $_SERVER["QUERY_STRING"]
    )
    );

    $this->view('admin/campaign/apply_list', array(
      'title' => "{$view['title']} 캠페인 신청자 관리 ({$total_row}명)",
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',

      'data' => array(
        'view' => $view,
        'lists' => $campaign_result['lists'],
        'ratings' => $ratings,
        'ratings_txt' => $ratings_txt,
        'penaltys' => $penaltys,
        'penaltys_txt' => $penaltys_txt,
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2,
        'pagination_html' => $pagination_html
      )
    )
    );
  }

  public function campaign_view()
  {
    $this->model('campaign');
    $view = $this->campaignModel->get_view(@$_GET['idx']);

    $category_depth = str_split(@$write['category_depth'], 3);
    foreach ($category_depth as &$depth) {
      $depth = (int) $depth;
    }

    $this->view('admin/campaign/detail', array(
      'title' => '캠페인 정보',
      'head' => 'admin/common/head',
      'tail' => 'admin/common/tail',
      'data' => array(
        'area' => $this->_config['store']['area'],
        'view' => $view,
        'category_depth' => @$category_depth,
        'category_lv1' => $this->category_lv1,
        'category_lv2' => $this->category_lv2,
        'media' => $this->_config['store']['media']
      )
    )
    );
  }
}