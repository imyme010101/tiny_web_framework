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

  public function get_next_role($type, $role)
  {
    return $this->fetch_array_row("
      SELECT *
      FROM {$this->_config['table']['member_role']}
      WHERE type = '{$type}' AND sort = (SELECT sort FROM member_role WHERE role = '{$role}') + 1
    ");
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

  public function get_point_list($member_id='', $start = 0, $limit = 10)
  {
    $result = $this->query("
      SELECT mp.*
      FROM {$this->_config['table']['member_point_log']} AS mp
      WHERE
        mp.member_id = '{$member_id}'
      ORDER BY mp.created_at DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query(
      "
      SELECT COUNT(*) AS cnt
      FROM {$this->_config['table']['member_point_log']} AS mp
      WHERE
        mp.member_id = '{$member_id}'
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

  public function get_wallet_list($member_id='', $start = 0, $limit = 10)
  {
    $result = $this->query("
      SELECT w.*, m.id, m.name
      FROM {$this->_config['table']['member_wallet']} AS w
      LEFT OUTER JOIN {$this->_config['table']['member']} AS m ON m.id = w.member_id
      WHERE
        1
        " . ( $member_id ? "AND w.member_id = '{$member_id}'" : '' ) . "
      ORDER BY w.created_at DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query(
      "
      SELECT COUNT(*) AS cnt
      FROM {$this->_config['table']['member_wallet']} AS w
      WHERE
      1
      " . ( $member_id ? "AND w.member_id = '{$member_id}'" : '' ) . "
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

  public function get_pelalty_list($member_id = '', $start = 0, $limit = 10)
  {
    $result = $this->query("
      SELECT m.*
      FROM {$this->_config['table']['member_penalty_log']} AS m
      WHERE
        1
        " . ($member_id != '' ? "AND m.member_id = '{$member_id}'" : "") . "
      ORDER BY m.created_at DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query(
      "
      SELECT COUNT(*) AS cnt
      FROM {$this->_config['table']['member_penalty_log']} AS m
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

  public function set_point($member_id = '', $point = 0, $comment = '')
  {
    $result = $this->query("
      UPDATE {$this->_config['table']['member']} SET point = point + {$point} WHERE id = '{$member_id}'
    ");

    if ($result) {
      $ins_result = $this->query("
        INSERT INTO {$this->_config['table']['member_penalty_log']} (member_id, point, comment) VALUES ('{$member_id}', {$point}, {$comment})
      ");

      return true;
    } else {
      return false;
    }
  }
}