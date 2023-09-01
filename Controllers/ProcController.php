<?php
class ProcController extends \App\Libs\Controller
{
  public $db = null;

  public function __construct()
  {
    parent::__construct();

    $this->db = new \App\Libs\Database();
  }

  public function index($clazz, $func)
  {
    $this->{$clazz . "_" . $func}();
  }

  public function member_join()
  {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $nick = $_REQUEST['nick'];
    $password = $_REQUEST['password'];
    $password_re = $_REQUEST['password_re'];
    $phone_number = $_REQUEST['phone_number'];
    $address = $_REQUEST['address'];
    $address_detail = $_REQUEST['address_detail'];
    $zip_code = $_REQUEST['zip_code'];

    $email = $_REQUEST['email_1'] . '@' . $_REQUEST['email_2'];

    $all_agree = $_REQUEST['all_agree'] ? 'Y' : 'N';
    $email_agree = $_REQUEST['email_agree'] ? 'Y' : 'N';
    $sms_agree = $_REQUEST['sms_agree'] ? 'Y' : 'N';

    if ($all_agree == 'Y') {
      $email_agree = 'Y';
      $sms_agree = 'Y';
    }

    if ($password != $password_re) {
      $this->responseError(201, '비밀번호를 확인해 주세요.');
    }

    if (!$id) {
      $this->responseError(201, '아이디를 입력해 주세요.');
    }

    if (!preg_match('/^[a-z0-9-_]{3,15}$/', $id)) {
      $this->responseError(201, '아이디 형식이 틀렵습니다.');
    }

    if (!$name) {
      $this->responseError(201, '이름을 입력해 주세요.');
    }
    
    if (!$name) {
      $this->responseError(201, '닉네임 입력해 주세요.');
    }


    // $email 이메일 형식 맞는지 체크해줘
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->responseError(201, '이메일 형식이 틀렵습니다.');
    }

    // if (!$phone_number) {
    //   $this->responseError(201, '헨드폰 번호를 입력해 주세요.');
    // }

    $result = $this->db->fetch_array("select id, status from {$this->_config['table']['member']} where id = '{$id}' ");

    if ($result['status'] == 0) {
      if (!$_SESSION['sns_login_wait_chk']) {
        $query = "INSERT INTO {$_tn['rk_member']} (cu_idx, team, status, id, pw, name, hp, zip_code, address, address_detail, email, email_agree, sms_agree, regdate) VALUES ('{$_SESSION['auth_no_cu_idx_chk']}', '$team', 1, '$id', md5('$pw'), '$name', '$phone_number', '$zip_code', '$address', '$address_detail', '$email', '$email_agree', '$sms_agree', unix_timestamp())";
        $result = sql_query($query);
      } else {
        $query = "UPDATE {$_tn['rk_member']} SET cu_idx = '{$_SESSION['auth_no_cu_idx_chk']}', team = '{$team}', status = 1, pw = md5('$pw'), name = '$name', hp = '$phone_number', zip_code = '$zip_code', address = '$address', address_detail = '$address_detail', email = '$email', email_agree = '$email_agree', sms_agree = '$sms_agree' WHERE id = '$id' ";
        $result = sql_query($query);
      }

      if ($result) {
        unset($_SESSION['sns_login_wait_chk']);
        unset($_SESSION['sns_login_wait_id']);
        unset($_SESSION['auth_no_chk']);

        $_SESSION['login_chk'] = $id;
        $_SESSION['login_id'] = $id;

        json_return(
          array(
            'msg' => "회원가입가 완료되었습니다.",
            'result' => true
          )
        );
      } else {
        json_return(
          array(
            'msg' => "회원가입가 완료되지 않았습니다.",
            'result' => false
          )
        );
      }
    } else {
      json_return(
        array(
          'msg' => "이미 가입된 아이디가 있습니다.",
          'result' => false
        )
      );
    }
  }
}
?>