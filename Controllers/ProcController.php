<?php
class ProcController extends \App\Libs\Controller
{
  public $db = null;

  public function __construct()
  {
    $this->db = new \App\Libs\Database();

    parent::__construct();
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
    if(!$name)
      $name = $_REQUEST['nick'];

    $password = $_REQUEST['password'];
    $password_re = $_REQUEST['password_re'];
    $phone_number = $_REQUEST['phone_number'];
    $address = $_REQUEST['address'];
    $address_detail = $_REQUEST['address_detail'];
    $zip_code = $_REQUEST['zip_code'];
    $gender = $_REQUEST['gender'];

    $sns_array = $_REQUEST['sns'];
    $use_sns_array = Array();
    foreach($sns_array as $key => $value) {
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
        $this->responseApi(200, "회원가입이 완료되었습니다.", Array(
          'id' => $id
        ));
      }
    } else {
      $this->responseApi(201, "아이디가 사용중인 아이디입니다.", Array(
        'id' => $id
      ));
    }
  }

  public function member_delete() {
    $id = $_REQUEST['id'];
    $password = $_REQUEST['password'];

    if (!$id) {
      $this->responseError(201, '아이디를 입력해 주세요.');
    }

    $result = $this->db->fetch("select count(*) as cnt from {$this->_config['table']['member']} where id = '{$id}' AND password = password('{$password}') ");

    if (!$result['cnt']) {
      $this->responseError(202, '회원 삭제 처리중 오류 발생 하였습니다.');
    } else {
      if($this->db->query("UPDAte {$this->_config['table']['member']} SET status = 'DISABLE', delete_at = now() where id = '{$id}' ")) {
        $this->responseApi(200, "회원 삭제가 완료되었습니다.", Array(
          'id' => $id
        ));
      } else {
        $this->responseError(202, "회원 삭제 처리중 오류 발생 하였습니다.");
      }
    }
  }

  public function member_profile() {
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
    $location =  $_FILES["profile_image"]["tmp_name"];
  
    move_uploaded_file($location, $destination);

    $this->responseApi(200, "파일이 업로드되었습니다.", Array(
      'path' => '/uploads/member/' . $filename
    ));
  }
}
?>