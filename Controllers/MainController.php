<?php

class MainController extends \App\Libs\Controller
{
  public function index()
  {
    $this->responseApi(200, 'Hello World', Array());
  }

  public function get_list()
  {
    $this->model('Common');

    if (rand(0, 1)) {
      $this->commonModel->test();
    }
  }
}