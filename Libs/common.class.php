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

  public function responseApi($result) {
    echo json_encode($result);
    exit;
  }

  public function responseError($code, $message) {
    echo json_encode(Array(
      'code' => $code,
      'message' => $message
    ));
    exit;
  }
}
