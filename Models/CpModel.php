<?php
class CpModel extends \App\Libs\Database
{

  // constructor
  public function __construct()
  {
    parent::__construct();
  }

  public function category($parent = 0)
  {
    $result = $this->query("
      SELECT idx, name
      FROM {$this->_config['table']['campaign_category']}
      WHERE parent_idx = '{$parent}' order by idx ASC
    ");

    return $this->fetch_array_rows($result);
  }


  public function get($key)
  {
    $result = $this->query("
      SELECT data
      FROM {$this->_config['table']['redis']}
      WHERE name = '{$key}'
    ");

    return $this->fetch_array($result)['data'];
  }

  public function idx($idx)
  {
    $result = $this->query("
      SELECT data
      FROM {$this->_config['table']['redis']}
      WHERE idx = '{$idx}'
    ");

    return $this->fetch_array($result)['data'];
  }

  public function set($key, $value)
  {
    $value = addslashes($value);

    $this->query("DELETE FROM {$this->_config['table']['redis']} WHERE name = '{$key}'");

    $this->query("
      INSERT INTO {$this->_config['table']['redis']}
      (name, data)
      VALUES ('{$key}', '{$value}')
    ");

    return $this->last_id();
  }

  public function get_list($start = 0, $limit = 10)
  {
    $result = $this->query("
    SELECT c.*
    FROM {$this->_config['table']['campaign_list']} AS c
    ORDER BY c.created_at DESC
    LIMIT {$limit} OFFSET {$start}
  ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query(
      "
    SELECT COUNT(*) AS cnt
    FROM {$this->_config['table']['campaign_list']}
    "
    );
    //WHERE rd.regdate = '" . strtotime(date("Y-m-d"." 00:00:00")) . "'
    $row = $this->fetch_array($result2);
    $total = $row['cnt'];

    return array(
      'total_row' => $total,
      'lists' => $lists
    );
  }
}