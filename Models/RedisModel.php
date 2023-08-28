<?php
class RedisModel extends \App\Libs\Database {
  
  // constructor
  public function __construct() {
    parent::__construct();
  }

  public function get($key) {
    $result = $this->query("
      SELECT data
      FROM {$this->_config['table']['redis']}
      WHERE name = '{$key}'
    ");

    return $this->fetch_array($result)['data'];
  }

  public function set($key, $value) {
    $value = addslashes($value);
    
    $this->query("DELETE FROM {$this->_config['table']['redis']} WHERE name = '{$key}'");

    return $this->query("
      INSERT INTO {$this->_config['table']['redis']}
      (name, data)
      VALUES ('{$key}', '{$value}')
    ");
  }
}
