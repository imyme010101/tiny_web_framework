<?php
namespace App\Libs;

class Common
{
  // constructor
  public function __construct()
  {
    global $_config;
    
    $this->_config = $_config;

    header('Content-type: application/json');
  }

  public function responseApi($code, $message, $result) {
    echo json_encode(Array(
      'code' => $code,
      'message' => $message,
      'result' => $result
    ), JSON_UNESCAPED_UNICODE);
    exit;
  }

  public function responseError($code, $message) {
    echo json_encode(Array(
      'code' => $code,
      'message' => $message
    ), JSON_UNESCAPED_UNICODE);
    exit;
  }
}
