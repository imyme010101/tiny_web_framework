<?php

class MemberController extends \App\Libs\Controller
{
  public $db = null;

  public function __construct()
  {
    $this->db = new \App\Libs\Database();

    parent::__construct();
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

  public function get_chk()
  {
    $type = $_REQUEST['type'];

    if ($type == 'id') {
      $id = $_REQUEST['id'];

      $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where id = '{$id}' ");

      if (!$result['cnt']) {
        $this->responseApi(200, '아이디를 사용할수 있습니다.', array('id' => $id));
      } else {
        $this->responseApi(201, '이미 사용중인 아이디 입니다.', array('id' => $id));
      }
    } else if ($type == 'email') {
      $email = $_REQUEST['email'];

      $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where email = '{$email}' ");

      if (!$result['cnt']) {
        $this->responseApi(200, '메일을 사용할수 있습니다.', array('email' => $email));
      } else {
        $this->responseApi(201, '이미 사용중인 이메일 입니다.', array('email' => $email));
      }
    } else if ($type == 'nick') {
      $nick = $_REQUEST['nick'];

      $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where nick = '{$nick}' ");

      if (!$result['cnt']) {
        $this->responseApi(200, '닉네임을 사용할수 있습니다.', array('nick' => $nick));
      } else {
        $this->responseApi(201, '이미 사용중인 닉네임 입니다.', array('nick' => $nick));
      }
    }
  }

  public function get_login()
  {
    $id = $_REQUEST['id'];
    $password = $_REQUEST['password'];

    $this->model('Member');

    $member = $this->memberModel->get_member($id, "password('" . $password . "')");

    if (!@$_SESSION['login']) {
      if (@$member['id']) {

        $_SESSION['login'] = $member['id'];
        $_SESSION['login_date'] = time();

        $this->responseApi(200, '로그인이 완료 되었습니다.', array(
          'login' => $member['id'],
          'login_date' => $_SESSION['login_date']
        )
        );
      } else {
        $this->responseError(201, '로그인에 실패 했습니다.');
      }
    } else {
      $this->responseError(201, '이미 로그인중 입니다.');
    }
  }

  public function get_login_check()
  {
    if (@$_SESSION['login']) {
      $this->responseApi(200, '로그인중 입니다.', array(
        'login' => $_SESSION['login'],
        'login_date' => @$_SESSION['login_date']
      )
      );
    } else {
      $this->responseError(201, '로그인 상태가 아닙니다.');
    }
  }

  public function get_point() {
    $member_id = $_REQUEST['member_id'];

    $page = @$_GET['page'] ? @$_GET['page'] : 1;
    $total_row = 0;
    $lists = array();
    $limit = @$_GET['limit'] ? @$_GET['limit'] : 10;
    $start = ($page - 1) * $limit;

    $this->model('Member');

    $point_result = $this->memberModel->get_point_list($member_id, $start, $limit);

    $this->responseApi(200, 'success', $point_result);
    
  }

  public function post_join()
  {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $nick = $_REQUEST['nick'];
    if (!$name)
      $name = $_REQUEST['nick'];

    $password = $_REQUEST['password'];
    $password_re = $_REQUEST['password_re'];
    $phone_number = $_REQUEST['phone_number'];
    $address = $_REQUEST['address'];
    $address_detail = $_REQUEST['address_detail'];
    $zip_code = $_REQUEST['zip_code'];
    $gender = $_REQUEST['gender'];

    $sns_array = $_REQUEST['sns'];
    $use_sns_array = array();
    foreach ($sns_array as $key => $value) {
      $use_sns_array[] = $key;
    }

    $sns = json_encode($sns_array);
    $use_sns = implode(',', $use_sns_array);

    $email = $_REQUEST['email'];

    $marketing = $_REQUEST['marketing'] ? 'Y' : 'N';

    if ($password != $password_re) {
      $this->responseError(201, '비밀번호를 확인해 주세요.');
    }

    if (!$id) {
      $this->responseError(201, '아이디를 입력해 주세요.');
    }

    if (!preg_match('/^[a-z0-9-_]{3,15}$/', $id)) {
      $this->responseError(201, '^[a-z0-9-_]{3,15} 아이디 형식이 틀렵습니다.');
    }

    if (!$name) {
      $this->responseError(201, '이름을 입력해 주세요.');
    }

    if (!$nick) {
      $this->responseError(201, '닉네임 입력해 주세요.');
    }


    $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where phone_number = '{$phone_number}' ");

    if ($result['cnt']) {
      $this->responseError(201, '헨드폰 번호 사용중입니다.\n헨드폰 번호를 확인해 주세요.');
    }

    // $email 이메일 형식 맞는지 체크해줘
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->responseError(201, '이메일 형식이 틀렵습니다.');
    }

    // if (!$phone_number) {
    //   $this->responseError(201, '헨드폰 번호를 입력해 주세요.');
    // }

    $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where id = '{$id}' ");

    if (!$result['cnt']) {
      $insert_result = $this->db->query("
        INSERT INTO {$this->_config['table']['member']}
        SET
          id = '{$id}',
          name = '{$name}',
          nick = '{$nick}',
          password = password('{$password}'),
          email = '{$email}',
          phone_number = '{$phone_number}',
          address = '{$address}',
          address_detail = '{$address_detail}',
          zip_code = '{$zip_code}',
          gender = '{$gender}',
          sns = '{$sns}',
          use_sns = '{$use_sns}',
          marketing = '{$marketing}'
      ");

      if ($insert_result) {
        $this->responseApi(
          200,
          "회원가입이 완료되었습니다.",
          array(
            'id' => $id
          )
        );
      }
    } else {
      $this->responseApi(
        201,
        "아이디가 사용중인 아이디입니다.",
        array(
          'id' => $id
        )
      );
    }
  }

  public function post_delete()
  {
    $id = $_REQUEST['id'];
    $password = $_REQUEST['password'];

    if (!$id) {
      $this->responseError(201, '아이디를 입력해 주세요.');
    }

    $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where id = '{$id}' AND password = password('{$password}') ");

    if (!$result['cnt']) {
      $this->responseError(202, '회원 삭제 처리중 오류 발생 하였습니다.');
    } else {
      if ($this->db->query("UPDAte {$this->_config['table']['member']} SET status = 'DISABLE', delete_at = now() where id = '{$id}' ")) {
        $this->responseApi(
          200,
          "회원 삭제가 완료되었습니다.",
          array(
            'id' => $id
          )
        );
      } else {
        $this->responseError(202, "회원 삭제 처리중 오류 발생 하였습니다.");
      }
    }
  }

  public function post_profile()
  {
    $id = $_REQUEST['id'];

    if (!$id) {
      $this->responseError(201, '아이디를 입력해 주세요.');
    }
    $ext = substr(strrchr($_FILES['profile_image']['name'], "."), 1);
    $ext = strtolower($ext);

    if ($ext != "jpg" and $ext != "png" and $ext != "jpeg" and $ext != "gif") {
      $this->responseError(201, '이미지 형식만 작성 가능합니다.');
    }

    $name = $id;
    $filename = $name . '.jpg';
    $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/member/' . $filename;
    $location = $_FILES["profile_image"]["tmp_name"];

    move_uploaded_file($location, $destination);

    $this->responseApi(
      200,
      "파일이 업로드되었습니다.",
      array(
        'path' => '/uploads/member/' . $filename
      )
    );
  }

  public function post_penalty() {
    $member_id = $_REQUEST['member_id'];
    $penalty = $_REQUEST['penalty'];
    $comment = $_REQUEST['comment'];

    $this->model('Member');

    $member = $this->memberModel->get_member_by_id($member_id);

    if($member['id']) {
      $roles = explode(',', $member['roles']);
      unset($roles[2]);
      $roles[2] = $penalty;
      $roles_txt = implode(',', $roles);

      $up_result = $this->db->query("UPDATE {$this->_config['table']['member']} SET roles = '{$roles_txt}' WHERE id = '{$member_id}'");

      if($up_result) {
        $in_result = $this->db->query("INSERT INTO {$this->_config['table']['member_penalty_log']} SET member_id = '{$member_id}', penalty = '{$penalty}', comment = '{$comment}'");
        
        if($in_result) {
          $this->responseApi(
            200,
            "패널티 적용이 되었습니다.",
            array()
          );
        } else {
          $this->db->query("UPDATE {$this->_config['table']['member']} SET roles = '{$member['roles']}' WHERE id = '{$member_id}'");

          $this->responseError(202, "패널티 적용이 실패 하였습니다.");
        }
      } else {
        $this->responseError(202, "패널티 적용이 실패 하였습니다.");
      }
    } else {
      $this->responseError(201, '아이디를 다시 확인해주세요.');
    }
    
  }

  // public function login()
  // {
  //   $id = $_REQUEST['id'];
  //   $password = $_REQUEST['password'];

  //   if(!$id || !$password) {
  //     $this->responseError(201, '아이디 및 비밀번호를 입력해 주세요.');
  //   }

  //   $this->model('Member');


  //   $member = $this->memberModel->get_member("{$id}", "password('{$password}')");

  //   $jwt = new \App\Libs\Jwt();

  //   if ($member) {
  //     $this->model('Redis');

  //     $access_token = $jwt->encode(
  //       array(
  //         'exp' => time() + (360 * 30),
  //         // 만료기간
  //         'iat' => time(),
  //         // 생성일
  //         'id' => $member['id'],
  //         'email' => $member['email'],
  //         'password' => $member['password'],
  //         'rules' => explode(',', $member['roles'])
  //       )
  //     );
  //     $this->redisModel->set($member['id'] . "_access_token", $access_token);

  //     $refresh_token = $jwt->encode(
  //       array(
  //         'exp' => 0,
  //         'iat' => time(),
  //         'id' => $member['id'],
  //         'email' => $member['email'],
  //         'password' => $member['password'],
  //         'rules' => explode(',', $member['roles'])
  //       )
  //     );
  //     $refresh_token_idx = $this->redisModel->set($member['id'] . "_refresh_token", $refresh_token);

  //     $this->responseApi(200, "토큰 생성이 완료 되어니다.", Array('access_token' => $access_token, 'refresh_token_idx' => $refresh_token_idx));
  //   } else {
  //     $this->responseError(202, "회원 정보를 확인후 다시 입력해 주세요.");
  //   }
  // }
}