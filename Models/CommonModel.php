<?php
class CommonModel extends \App\Libs\Database {
  
  // constructor
  public function __construct() {
    parent::__construct();
  }

  public function test() {
    echo 'test';
  }

  public function get_area($sido = '', $gugun = '') {
    if(!$sido && !$gugun) {
      $area_zone = 'sido';
      $area_zone_where = '';
      $area_zone_groupby = 'sido';
    } else if($sido && !$gugun) {
      $area_zone = 'gugun';
      $area_zone_where = "sido = '{$sido}'";
      $area_zone_groupby = 'gugun';
    } else if($sido && $gugun) {
      $area_zone = 'dong';
      $area_zone_where = "sido = '{$sido}' AND gugun = '{$gugun}'";
      $area_zone_groupby = 'dong';
    }

    $result = $this->query("
      SELECT {$area_zone}
      FROM {$this->_tn['rk_reward_day_log']}
      ".($area_zone_where ? ' WHERE '.$area_zone_where : '') . "
      GROUP BY {$area_zone_groupby}
    ");
    
    $lists = array();
    while($row = $this->fetch_array($result)) {
      $lists[] = $row[$area_zone];
    }

    return $lists;
  }
}
