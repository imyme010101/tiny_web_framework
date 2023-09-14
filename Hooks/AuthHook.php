<?php
use App\Libs\Common;


class AuthHook
{
  public static $member_info = Array();

  public function chk() {
    if($_SESSION['login']) {
      $id = $_SESSION['login'];

      $this->model('Member');

      $this->member_info = $this->memberModel->get_member_by_id($id);
    }
    return false;
  }
  // public function chk() {
  //   $headers = apache_request_headers();

  //   $access_token = $headers['access_token'];
  //   //$refresh_token = "eyJhbGciOiJzaGEyNTYiLCJ0eXAiOiJKV1QifS57ImlhdCI6MTY5MzI1NDAzMSwiaWQiOiJ0ZXN0IiwiZW1haWwiOiJ0ZXN0IiwicGFzc3dvcmQiOiIqOTRCRENFQkUxOTA4M0NFMkExRjk1OUZEMDJGOTY0QzdBRjRDRkMyOSIsInJ1bGVzIjpbIlUiXX0uN2IwYTBjMDhlNDVhYTU3NDg5ZmQzY2FjNDI4MDczNjY1YzU3YmM4OWVjMTFkYTdmNmE2ZDllM2ExZTdmMTkyNA==";
  //   $refresh_token_idx = @$headers['refresh_token_idx'] ? @$headers['refresh_token_idx'] : 0;

  //   $jwt = new App\Libs\Jwt();
  //   $common = new App\Libs\Common();

  //   $access_token_parted = explode('.', base64_decode($access_token));
  //   $access_token_info = json_decode($access_token_parted[1], true);

  //   $redisModel = new RedisModel();

    

  //   if($refresh_token_idx) {
  //     if(time() > $access_token_info['exp']) {
  //       $refresh_token = $redisModel->idx($refresh_token_idx);

  //       $refresh_token_parted = explode('.', base64_decode($refresh_token));    
  //       $refresh_token_info = json_decode($refresh_token_parted[1], true);
        
  //       $memberModel = new MemberModel();

  //       $member1 = $memberModel->get_member($access_token_info['id'], "{$access_token_info['password']}");
  //       $member2 = $memberModel->get_member($refresh_token_info['id'], "{$refresh_token_info['password']}");
        
  //       if(empty(array_diff($member1, $member2))) {
  //         $access_token = $jwt->encode(
  //           array(
  //             'exp' => time() + (360 * 30),
  //             // 만료기간
  //             'iat' => time(),
  //             // 생성일
  //             'id' => $member1['id'],
  //             'email' => $member1['email'],
  //             'password' => $member1['password'],
  //             'rules' => explode(',', $member1['roles'])
  //           )
  //         );
  //         $redisModel->set($member1['id'] . "_access_token", $access_token);

  //         $refresh_token = $jwt->encode(
  //           array(
  //             'iat' => time(),
  //             'id' => $member1['id'],
  //             'email' => $member1['email'],
  //             'password' => $member1['password'],
  //             'rules' => explode(',', $member1['roles'])
  //           )
  //         );
  //         $refresh_token_idx = $redisModel->set($member1['id'] . "_refresh_token", $refresh_token);
            
  //         $common->responseApi(200, "토큰 재 생성이 완료 되어니다.", Array('access_token' => $access_token, 'refresh_token_idx' => $refresh_token_idx));
  //       }
  //     } else {
  //       $common->responseApi(200, "토큰 시간이 남았습니다.", Array('access_token' => $access_token, 'refresh_token_idx' => $refresh_token_idx));
  //     }
  //   } else {
  //     $token = $redisModel->get($access_token_info['id'] . "_access_token");

  //     if(!$token || $token != $access_token) {
  //       $common->responseError(301, "유효하지 않은 토큰입니다.");
  //     } else {
  //       if(time() > $access_token_info['exp']) {
  //         $common->responseError(302, "토큰 시간이 만료 되었습니다.");
  //       }
        
  //       self::$token_info = Array(
  //         'id' => $access_token_info['id'],
  //         'email' => $access_token_info['email'],
  //         'rules' => $access_token_info['rules']
  //       );
  //     }
  //   }
  // }
}