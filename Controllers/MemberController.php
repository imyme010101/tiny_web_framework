<?php

class MemberController extends \App\Libs\Controller
{
  public function get_login()
  {
    $this->model('Member');

    $token_info = AuthHook::$token_info;

    if($token_info['id']) {
      $this->responseError(202, "이미 로그인 중입니다.");
    } else {
      $member = $this->memberModel->get_member("test", "password('test')");

      $jwt = new \App\Libs\Jwt();
      
      if ($member) {
        $this->model('Redis');

        $access_token = $jwt->encode(
          array(
            'exp' => time() + (360 * 30),
            // 만료기간
            'iat' => time(),
            // 생성일
            'id' => $member['id'],
            'email' => $member['email'],
            'password' => $member['password'],
            'rules' => explode(',', $member['roles'])
          )
        );
        $this->redisModel->set($member['id'] . "_access_token", $access_token);

        $refresh_token = $jwt->encode(
          array(
            'exp' => 0,
            'iat' => time(),
            'id' => $member['id'],
            'email' => $member['email'],
            'password' => $member['password'],
            'rules' => explode(',', $member['roles'])
          )
        );
        $refresh_token_idx = $this->redisModel->set($member['id'] . "_refresh_token", $refresh_token);

        $this->responseApi(200, "토큰 생성이 완료 되어니다.", Array('access_token' => $access_token, 'refresh_token_idx' => $refresh_token_idx));
      } else {
        $this->responseError(201, "회원 정보가 없습니다.");
      }
    }
  }
}