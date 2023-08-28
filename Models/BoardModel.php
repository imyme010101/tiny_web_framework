<?php
class BoardModel extends \App\Libs\Database {

  // constructor
  public function __construct() {
    parent::__construct();
  }

  public function get_view($b_id, $idx) {
    $result = $this->query("
      SELECT *
      FROM {$this->_tn['rk_board_write']} AS w
      WHERE w.b_id = '{$b_id}' AND w.idx = '{$idx}'
    ");

    return $this->fetch_array($result);
  }

  public function get_list($b_id = '', $start = 0, $limit = 10) {
    if($b_id) {
      $where = " w.b_id = '{$b_id}'";
    } else {
      $where = "";
    }
    
    $result = $this->query("
      SELECT w.*, (
        SELECT file FROM rk_board_file AS f WHERE f.b_id = w.b_id AND f.w_idx = w.idx AND f.order = 0
        ) AS file
      FROM {$this->_tn['rk_board_write']} AS w
      ".($where ? ' WHERE '.$where : '') . "
      ORDER BY w.regdate DESC
      LIMIT {$limit} OFFSET {$start}
      
    ");

    $lists = array();
    while($row = $this->fetch_array($result)){
        $lists[] = $row;
    }

    $result2= $this->query("
      SELECT COUNT(*)
      FROM {$this->_tn['rk_board_write']} AS w
      " . ($where ? " WHERE {$where}" : "")
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
