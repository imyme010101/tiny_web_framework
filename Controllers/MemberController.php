<?php

class MemberController extends \App\Libs\Controller
{
  public $db = null;

  public function __construct()
  {
    $this->db = new \App\Libs\Database();

    parent::__construct();
  }

  public function index($func)
  {
    $this->{$func}();
  }

  public function chk()
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

  public function login()
  {
    $id = $_REQUEST['id'];
    $password = $_REQUEST['password'];

    $this->model('Member');

    $member = $this->memberModel->get_member($id, "password('" . $password . "')");

    if (!@$_SESSION['login']) {
      if (@$member['id']) {

        $_SESSION['login'] = $member['id'];
        $_SESSION['login_name'] = $member['name'];
        $_SESSION['login_nick'] = $member['nick'];
        $_SESSION['login_email'] = $member['email'];


        $this->responseApi(200, '로그인이 완료 되었습니다.', array(
          'id' => $member['id'],
          'email' => $member['email'],
          'name' => $member['name'],
          'nick' => $member['nick']
        )
        );
      } else {
        $this->responseError(201, '로그인에 실패 했습니다.');
      }
    } else {
      $this->responseError(201, '이미 로그인중 입니다.');
    }
  }

  public function login_check()
  {
    if (@$_SESSION['login']) {
      $this->responseApi(200, '로그인중 입니다.', array(
        'id' => $_SESSION['login'],
        'name' => $_SESSION['login_name'],
        'nick' => $_SESSION['login_nick'],
        'email' => $_SESSION['login_email']
      )
      );
    } else {
      $this->responseError(201, '로그인 상태가 아닙니다.');
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