<?php
class MemberModel extends \App\Libs\Database
{

  // constructor
  public function __construct()
  {
    parent::__construct();
  }

  public function get_roles($type)
  {
    $result = $this->query("
      SELECT *
      FROM {$this->_config['table']['member_role']}
      WHERE type = '{$type}' order by sort ASC
    ");

    return $this->fetch_array_rows($result);
  }

  public function get_member($id, $password)
  {
    if (strpos($password, 'password') === false) {
      $password = "'" . $password . "'";
    }

    $result = $this->query("
      SELECT *
      FROM {$this->_config['table']['member']}
      WHERE id = '{$id}' AND password = {$password} AND status = 'ENABLE'
    ");

    return $this->fetch_array($result);
  }

  public function get_member_by_id($id)
  {
    $result = $this->query("
      SELECT *
      FROM {$this->_config['table']['member']}
      WHERE id = '{$id}'
    ");

    return $this->fetch_array($result);
  }

  public function get_list($start = 0, $limit = 10)
  {
    $result = $this->query("
      SELECT m.*
      FROM {$this->_config['table']['member']} AS m
      ORDER BY m.created_at DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query(
      "
      SELECT COUNT(*) AS cnt
      FROM {$this->_config['table']['member']} AS m
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