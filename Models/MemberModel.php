<?php
class MemberModel extends \App\Libs\Database {
  
  // constructor
  public function __construct() {
    parent::__construct();
  }

  public function get_member($id, $password) {
    $result = $this->query("
      SELECT *
      FROM {$this->_config['table']['member']}
      WHERE id = '{$id}' AND password = password('{$password}') AND status = 'ENABLE'
    ");

    return $this->fetch_array($result);
  }

  public function get_list($start = 0, $limit = 10) {
    $result = $this->query("
      SELECT m.*
      FROM {$this->_tn['rk_member']} AS m
      ORDER BY m.regdate DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = array();
    while($row = $this->fetch_array($result)){
        $lists[] = $row;
    }

    $result2= $this->query("
      SELECT COUNT(*)
      FROM {$this->_tn['rk_member']} AS w
      "
    );
    //WHERE rd.regdate = '" . strtotime(date("Y-m-d"." 00:00:00")) . "'
    $ret2 = $this->fetch_array_row($result2);
    $total = $ret2[0];

    return Array(
      'total_row' => $total,
      'lists' => $lists
    );
  }
}
