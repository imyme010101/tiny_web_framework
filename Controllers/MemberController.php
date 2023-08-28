<?php

class MemberController extends \App\Libs\Controller
{
  public function tokenChk() {
    $token = "eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImV4cCI6MTY5MzIzNTcxNiwiaWF0IjoxNjkzMjI0OTE2LCJpZCI6InRlc3QiLCJlbWFpbCI6InRlc3QiLCJydWxlcyI6WyJVIl19LjQwMGQxYmZhNGU4ZDdlZTRjM2MzYTE4NDVkYmYzNzU4ZTk1ZDQyZTNiZjE3NmY3YTY2ZGMwYTRjNzIyZTYyNDM";
    
    $jwt = new \App\Libs\Jwt();

    $data = $jwt->decode($token);

    $parted = explode('.', base64_decode($token));

    $payload = json_decode($parted[1], true);

    var_dump($payload);

  }
  public function get_login()
  {
    $this->model('Member');

    $member = $this->memberModel->get_member("test", "test");

    $jwt = new \App\Libs\Jwt();
    
    if ($member) {
      $account_token = $jwt->encode(
        array(
          'exp' => time() + (360 * 30),
          // 만료기간
          'iat' => time(),
          // 생성일
          'id' => $member['id'],
          'email' => $member['email'],
          'rules' => explode(',', $member['roles'])
        )
      );

      $this->responseApi(
        array(
          'code' => 200,
          'token' => $account_token
        )
      );
    } else {
      $this->responseError(201, "회원 정보가 없습니다.");
    }
  }
}