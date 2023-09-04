<?php
namespace App\Libs;

class Common
{
  // constructor
  public function __construct()
  {
    global $_config;
    
    $this->_config = $_config;
  }

  public function responseApi($code, $message, $result) {
    header('Content-type: application/json');

    echo json_encode(Array(
      'code' => $code,
      'message' => $message,
      'result' => $result
    ), JSON_UNESCAPED_UNICODE);
    exit;
  }

  public function responseError($code, $message) {
    header('Content-type: application/json');
    http_response_code($code);
    
    echo json_encode(Array(
      'code' => $code,
      'message' => $message
    ), JSON_UNESCAPED_UNICODE);
    exit;
  }
}
