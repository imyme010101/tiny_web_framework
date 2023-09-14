<?php

class CampaignController extends \App\Libs\Controller
{
  public $category_lv1 = array();
  public $category_detail = array();
  public $db = null;

  public function __construct()
  {
    parent::__construct();

    $this->model('Campaign');
  }

  public function get($func)
  {
    if (method_exists($this, 'get_' . $func)) {
      $this->{'get_' . $func}();
    } else {
      $this->responseError(404, '해당 경로를 찾을 수 없습니다.');
    }
  }

  public function post($func)
  {
    if (method_exists($this, 'post_' . $func)) {
      $this->{'post_' . $func}();
    } else {
      $this->responseError(404, '해당 경로를 찾을 수 없습니다.');
    }
  }


  public function get_list()
  {
    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = @$_GET['limit'] ? @$_GET['limit'] : 10;
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

    $this->responseApi(
      200,
      "캠페인 리스트 Page : {$page}",
      array(
        "current_page" => $page,
        "total_row" => $total_row,
        "total_page" => $total_page,
        "lists" => $campaign_result['lists']
      )
    );
  }

  public function post_wish()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];

    $this->db = new \App\Libs\Database();

    $chk = $this->db->fetch_array_row("select COUNT(*) as cnt from {$this->_config['table']['wish']} where member_id = '{$member_id}' and campaign_idx = '{$campaign_idx}'");

    if ($chk['cnt'] > 0) {
      $this->responseError(201, '이미 찜한 상품 입니다.');
    } else {
      $result = $this->db->query("insert into {$this->_config['table']['wish']} (member_id, campaign_idx) values ('{$member_id}', '{$campaign_idx}')");

      if ($result) {
        $this->responseApi(200, '성공적으로 등록되었습니다.', array(
          'idx' => $this->db->insert_id()
        )
        );
      } else {
        $this->responseError(202, '실패하였습니다.');
      }
    }
  }

  public function get_wish()
  {
    $member_id = $_REQUEST['member_id'];

    $this->db = new \App\Libs\Database();

    $result = $this->db->query("
      select w.idx AS wish_idx, c.* from {$this->_config['table']['wish']} AS w
      LEFT OUTER JOIN {$this->_config['table']['campaign_list']} AS c ON w.campaign_idx = c.idx
      where 
        w.member_id = '{$member_id}'
    ");
    $wish_list = $this->db->fetch_array_rows($result);

    $this->responseApi(200, $member_id . ' 님의 찜 목록 입니다.', $wish_list);
  }

  public function get_apply()
  {
    $member_id = $_REQUEST['member_id'];
    $type = $_REQUEST['type'];

    $where = "";
    if ($type == 'write') {
      $where .= " AND a.status = 'Y' AND a.write = 'Y'";
    } else if ($type == 'apply') {
      $where .= " AND a.status = 'Y' AND a.write = 'N'";
    } else if ($type == 'noaplly') {
      $where .= " AND a.status = 'N' AND c.write_end_date < CURDATE() ";
    }

    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = @$_GET['limit'] ? @$_GET['limit'] : 10;
    $start = ($page - 1) * $limit;

    $this->db = new \App\Libs\Database();

    try {
      $result = $this->db->query("
        select c.* from {$this->_config['table']['campaign_apply']} AS a
        LEFT OUTER JOIN {$this->_config['table']['campaign_list']} AS c ON a.campaign_idx = c.idx
        where
          a.member_id = '{$member_id}'
          {$where}
        ORDER BY a.created_at DESC
        LIMIT {$limit} OFFSET {$start}
      ");
    } catch (Exception $e) {
      $this->responseError(202, $e->getMessage());
    }
    $list = $this->db->fetch_array_rows(@$result);

    if (count($list) > 0) {
      $this->responseApi(200, $member_id . ' 님의 캠페인 신청 목록 입니다.', $list);
    } else {
      $this->responseError(202, '실패하였습니다.');
    }
  }

  public function post_apply()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];

    $this->db = new \App\Libs\Database();

    $campaign = $this->db->fetch_array_row("select * from {$this->_config['table']['campaign_list']} where idx = '{$campaign_idx}'");

    if ($campaign['apply'] >= $campaign['stock']) {
      $this->responseError(202, '모든 인원이 모집된 캠페인입니다.');
    }

    $chk = $this->db->fetch_array_row("select COUNT(*) as cnt from {$this->_config['table']['campaign_apply']} where member_id = '{$member_id}' and campaign_idx = '{$campaign_idx}'");

    if ($chk['cnt'] > 0) {
      $this->responseError(202, '이미 신청한 캠페인 입니다.');
    } else {
      $this->db->query("update {$this->_config['table']['campaign_list']} set apply = apply + 1 where idx = '{$campaign_idx}' ");

      $result = $this->db->query("insert into {$this->_config['table']['campaign_apply']} (member_id, campaign_idx) values ('{$member_id}', '{$campaign_idx}')");

      if ($result) {
        $this->responseApi(200, '성공적으로 등록되었습니다.', array(
          'idx' => $this->db->insert_id()
        )
        );
      }
    }
  }

  public function post_delete_apply()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];

    $this->db = new \App\Libs\Database();

    $result = $this->db->query("delete from {$this->_config['table']['campaign_apply']} where member_id = '{$member_id}' AND campaign_idx = '{$campaign_idx}' ");

    if ($result) {
      $this->db->query("update {$this->_config['table']['campaign_list']} set apply = apply - 1 where idx = '{$campaign_idx}' ");

      $this->responseApi(200, '성공적으로 취소 되었습니다.', array());
    } else {
      $this->responseError(202, '실패하였습니다.');
    }
  }

  public function get_test()
  {
    $member_id = 'imyme';

    $this->model('Member');
    $member = $this->memberModel->get_member_by_id($member_id);

    $roles = $this->memberModel->get_roles(1);
    $role = array_column($roles, 'role', array('sort', 'point'));

    print_r($role);
  }

  public function post_review()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];
    $url = $_REQUEST['url'];

    $this->db = new \App\Libs\Database();

    $chk = $this->db->fetch_array_row("select COUNT(*) as cnt from {$this->_config['table']['campaign_review']} where member_id = '{$member_id}' and campaign_idx = '{$campaign_idx}'");

    if ($chk['cnt'] > 0) {
      $this->responseError(202, '이미 리뷰한 캠페인 입니다.');
    } else {
      $result = $this->db->query("insert into {$this->_config['table']['campaign_review']} (member_id, campaign_idx, url) values ('{$member_id}', '{$campaign_idx}', '{$url}')");

      if ($result) {
        // 등급별 포인트 등급별 지급
        $this->model('Member');
        $member = $this->memberModel->get_member_by_id($member_id);

        $review_count = $this->db->fetch_array_row("select COUNT(*) as cnt from {$this->_config['table']['campaign_review']} where member_id = '{$member_id}'")['cnt'];

        // 등급별 포인트 등급별 지급
        $member = $this->memberModel->get_member_by_id($member_id);
        $role_arr = explode(',', $member['roles']);

        $next_role = $this->memberModel->get_next_role(1, $role_arr[1]);

        if ($next_role['cnt'] <= $review_count && $next_role['cnt'] != 999) {
          $point_result = $this->db->query("update {$this->_config['table']['member']} set point = point + {$next_role['point']} where id = '{$member_id}'");

          if ($point_result) {
            $point_log_result = $this->db->query("insert into {$this->_config['table']['member_point_log']} (member_id, point, comment) values ('{$member_id}', {$next_role['point']}, '{$next_role['role']} 등급 달성 {$next_role['point']} 지급')");

            if ($point_log_result) {
              $this->responseApi(200, "{$next_role['role']} 등급 달성 {$next_role['point']} 지급", array());
            } else {
              $this->responseError(202, '포인트  지급이 실패 하였습니다.');
            }
          }
        }
        // 등급별 포인트 등급별 지급 끝

        $this->responseApi(200, '성공적으로 등록되었습니다.', array());
      } else {
        $this->responseError(202, '실패하였습니다.');
      }
    }
  }

  public function post_delete_review()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];

    $this->db = new \App\Libs\Database();

    $result = $this->db->query("delete from {$this->_config['table']['campaign_review']} where member_id = '{$member_id}' AND campaign_idx = '{$campaign_idx}' ");

    if ($result) {
      $this->responseApi(200, '성공적으로 취소 되었습니다.', array());
    } else {
      $this->responseError(202, '실패하였습니다.');
    }
  }

  public function post_write()
  {
    $idx = $_REQUEST['idx'];
    $title = $_REQUEST['title'];
    $memo = $_REQUEST['memo'];
    $stock = $_REQUEST['stock'];
    $point = $_REQUEST['point'];
    $parent_category_idx = $_REQUEST['parent_category_idx'];
    $category_idx = $_REQUEST['category_idx'];
    $category_depth = str_pad($parent_category_idx, 3, '0', STR_PAD_LEFT) . str_pad($category_idx, 3, '0', STR_PAD_LEFT);
    $media = $_REQUEST['media'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];
    $pick_date = $_REQUEST['pick_date'];
    $write_start_date = $_REQUEST['write_start_date'];
    $write_end_date = $_REQUEST['write_end_date'];
    $detail_contents = $_REQUEST['detail_contents'];
    $info = $_REQUEST['info'];
    $mission = $_REQUEST['mission'];
    $title_tags = $_REQUEST['title_tags'];
    $contents_tags = $_REQUEST['contents_tags'];
    $guide = $_REQUEST['guide'];
    $caution = $_REQUEST['caution'];
    $zip_code = $_REQUEST['zip_code'];
    $address = $_REQUEST['address'];
    $address_detail = $_REQUEST['address_detail'];

    $md = $_REQUEST['md'] == 'Y' ? 'Y' : 'N';
    $area = $_REQUEST['area'];

    $old_main_img = $_REQUEST['old_main_img'];
    $old_m_main_img = $_REQUEST['old_m_main_img'];
    $old_thumb_img = $_REQUEST['old_thumb_img'];
    $old_m_thumb_img = $_REQUEST['old_m_thumb_img'];

    $this->db = new \App\Libs\Database();

    $errors = "";
    foreach ($_FILES as $file_key => $file) {
      if (!$file['name'])
        continue;


      // ${$file_key} = $file_key;
      $ext = substr(strrchr($file['name'], "."), 1);
      $ext = strtolower($ext);

      if ($ext != "jpg" and $ext != "png" and $ext != "jpeg" and $ext != "gif") {
        $errors .= $file_key . ' 이미지 형식만 작성 가능합니다.';

        continue;
      }

      $name = uniqid();
      $filename = $name . '.' . $ext;
      $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/campaign/' . $filename;
      $location = $file["tmp_name"];

      move_uploaded_file($location, $destination);

      unlink($_SERVER['DOCUMENT_ROOT'] . ${'old_' . $file_key});

      ${$file_key} = '/uploads/campaign/' . $filename;
    }

    if ($errors) {
      $this->responseError(201, $errors);
    }

    if (!$idx) {
      $images = "";
      if ($main_img)
        $images .= "main_img = '" . $main_img . "',";
      if ($m_main_img)
        $images .= "m_main_img = '" . $m_main_img . "',";
      if ($thumb_img)
        $images .= "thumb_img = '" . $thumb_img . "',";
      if ($m_thumb_img)
        $images .= "m_thumb_img = '" . $m_thumb_img . "',";

      $this->db->query("
        INSERT INTO {$this->_config['table']['campaign_list']}
        SET
          title = '{$title}',
          memo = '{$memo}',
          stock = '{$stock}',
          point = '{$point}',
          category_depth = '{$category_depth}',
          media = '{$media}',
          start_date = '{$start_date}',
          end_date = '{$end_date}',
          pick_date = '{$pick_date}',
          write_start_date = '{$write_start_date}',
          write_end_date = '{$write_end_date}',

          {$images}

          detail_contents = '{$detail_contents}',
          info = '{$info}',
          mission = '{$mission}',
          title_tags = '{$title_tags}',
          contents_tags = '{$contents_tags}',
          guide = '{$guide}',
          caution = '{$caution}',
          zip_code = '{$zip_code}',
          address = '{$address}',
          address_detail = '{$address_detail}',
          area = '{$area}',
          md = '{$md}'
      ");

      $this->responseApi(
        200,
        '캠페인 추가가 완료 되었습니다.',
        array(
          "idx" => $this->db->insert_id()
        )
      );
    } else {
      $images = "";
      if (@$main_img)
        $images .= "main_img = '" . @$main_img . "',";
      if (@$m_main_img)
        $images .= "m_main_img = '" . @$m_main_img . "',";
      if (@$thumb_img)
        $images .= "thumb_img = '" . @$thumb_img . "',";
      if (@$m_thumb_img)
        $images .= "m_thumb_img = '" . @$m_thumb_img . "',";

      $result = $this->db->query("
        UPDATE {$this->_config['table']['campaign_list']}
        SET
          title = '{$title}',
          memo = '{$memo}',
          stock = '{$stock}',
          point = '{$point}',
          category_depth = '{$category_depth}',
          media = '{$media}',
          start_date = '{$start_date}',
          end_date = '{$end_date}',
          pick_date = '{$pick_date}',
          write_start_date = '{$write_start_date}',
          write_end_date = '{$write_end_date}',

          {$images}

          detail_contents = '{$detail_contents}',
          info = '{$info}',
          mission = '{$mission}',
          title_tags = '{$title_tags}',
          contents_tags = '{$contents_tags}',
          guide = '{$guide}',
          caution = '{$caution}',
          zip_code = '{$zip_code}',
          address = '{$address}',
          address_detail = '{$address_detail}',
          area = '{$area}',
          md = '{$md}'
        WHERE idx = '{$idx}'
      ");

      if ($result) {
        $this->responseApi(
          200,
          '캠페인 정보가 수정 되었습니다.',
          array(
            "idx" => $idx
          )
        );
      } else {
        $this->responseError(202, '캠페인 정보가 수정 실패 하였습니다.');
      }
    }
  }

  public function post_campaign_point()
  {
    $member_id = $_REQUEST['member_id'];
    $campaign_idx = $_REQUEST['campaign_idx'];

    $this->db = new \App\Libs\Database();

    $campaign_point = $this->db->fetch_array_row("
      SELECT point FROM {$this->_config['table']['campaign_list']} WHERE idx = '{$campaign_idx}' 
    ")['point'];

    $up_result = $this->db->query("
      UPDATE {$this->_config['table']['member']}
      SET point = point + '{$campaign_point}'
      WHERE id = '{$member_id}'
    ");

    if ($up_result) {
      $this->db->query("
        UPDATE {$this->_config['table']['campaign_apply']}
        SET campaign_reward = '{$campaign_point}'
        WHERE member_id = '{$member_id}' AND campaign_idx = '{$campaign_idx}'
      ");

      $this->db->query(
        "INSERT INTO {$this->_config['table']['member_point_log']} SET point = '{$campaign_point}', member_id = '{$member_id}', comment = '캠페인 포인트 지급.'"
      );

      $this->responseApi(200, '포인트가 정상적으로 지급 되었습니다.', array());
    } else {
      $this->responseError(202, '포인트가 지급 실패하였습니다.');
    }
  }

  public function get_config_media()
  {
    $this->responseApi(200, "사용중인 미디어 메체", $this->_config['store']['media']);
  }
}