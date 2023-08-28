<?php

class MainController extends \App\Libs\Controller
{
  public function get_index()
  {
    return "index called";
  }

  public function get_list()
  {
    $this->model('Common');

    if (rand(0, 1)) {
      $this->commonModel->test();
    }
  }
}