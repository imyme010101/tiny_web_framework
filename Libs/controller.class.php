<?php
namespace App\Libs;

class Controller extends Common
{
  public $_config;
  public $dice;

  public function __construct() {
    global $_config;

    $this->_config = $_config;
    $this->dice = new \App\Libs\Dice;
    
    parent::__construct();
  }

  public function compo($path, $parameters=Array()) {
    ob_start();
      extract(@$parameters);
      include($this->_config['ROOT_PATH'] . '/components/'.$path.'.php');
      $result = ob_get_contents();
    ob_end_clean();

    return $result;
  }

  public function view($path, $parameters=Array()) {
    ob_start();
      extract(@$parameters);

      if(@$head) {
        include($this->_config['ROOT_PATH'] . '/views/'.$head.'_view.php');
      }

      include($this->_config['ROOT_PATH'] . '/views/'.$path.'_view.php');
      
      if(@$tail) {
        include($this->_config['ROOT_PATH'] . '/views/'.$tail.'_view.php');
      }

      $result = ob_get_contents();
    ob_end_clean();

    echo $result;
  }

  public function model($model_name)
  { 
    $model = $this->dice->create($model_name . 'Model'); // UserController instance

    $var_name = strtolower($model_name) . 'Model';
    $this->{$var_name} = $model;
  }
}