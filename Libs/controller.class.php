<?php
namespace App\Libs;

class Controller extends Common
{
  public function __construct() {
    global $_config;

    $this->_config = $_config;
    $this->dice = new \App\Libs\Dice;
    
    parent::__construct();
  }

  public function compo($path, $parameters) {
    ob_start();
      extract($parameters);
      include($this->_config['ROOT_PATH'] . '/components/'.$path);
      $result = ob_get_contents();
    ob_end_clean();

    return $result;
  }

  public function model($model_name)
  {
    require_once $this->_config['ROOT_PATH'] . '/Models/' . $model_name . 'Model.php';
    
    $model = $this->dice->create($model_name . 'Model'); // UserController instance

    $var_name = strtolower($model_name) . 'Model';
    $this->{$var_name} = $model;
  }
}