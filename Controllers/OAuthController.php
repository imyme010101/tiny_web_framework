<?php
class OAuthController extends \App\Libs\Controller
{
  public function kakao() {
    $callbacURI = urlencode($this->_config['KAKAO_CALLBACK_URI']);

    // API 요청 URL
    $returnUrl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={$this->_config['KAKAO_CLIENT_ID_KEY']}&redirect_uri={$callbacURI}&code=".$_REQUEST['code'];

    $isPost = false;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $returnUrl);
    curl_setopt($ch, CURLOPT_POST, $isPost);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = array();
    $loginResponse = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);

    $accessToken = json_decode($loginResponse)->access_token; // access token 가져옴

    $curl = 'curl -v -X GET https://kapi.kakao.com/v2/user/me -H "Authorization: Bearer '.$accessToken.'"';
    $info = shell_exec($curl);
    $info_arr = json_decode($info, true);

    $sns_id = $info_arr['id'];
    $id = 'kakao_'.$sns_id;
    $pw = $info_arr['id'];

    if(!$sns_id) {
      $this->responseError(201, "Kakao ID가 없습니다.");
    }

    // $result = sql_fetch("select id, status from {$this->_config['table']['member']} where id = '{$id}' ");

    // if(!$result['id']) {
    //   $query = "INSERT INTO {$this->_config['table']['member']} (id, pw, regdate) VALUES ('$id', md5('$pw'), unix_timestamp())";
    //   $result2 = sql_query($query);
    // }
  }
}