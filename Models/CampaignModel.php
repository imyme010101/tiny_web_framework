<?php
class CampaignModel extends \App\Libs\Database
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

  public function get_view($idx)
  {
    $result = $this->query("
      SELECT *
      FROM {$this->_config['table']['campaign_list']}
      WHERE idx = '{$idx}'
    ");

    return $this->fetch_array($result);
  }

  public function get_list($start = 0, $limit = 10, $md = false, $category = '', $area = '', $sns = '', $sort = '', $date_start = '', $date_end = '', $status = '')
  {
    $result = $this->query("
      SELECT c.*
      FROM {$this->_config['table']['campaign_list']} AS c
      WHERE 
      1
      " . ($md ? "AND c.md = 'Y'" : "") . "
      " . ($category != '' ? "AND c.category_depth LIKE '{$category}%'" : "") . "
      " . ($area != '' ? "AND c.area = '{$area}'" : "") . "
      " . ($sns != '' ? "AND c.sns = '{$sns}'" : "") . "
      " . ($date_start != '' ? "AND c.created_at >= '{$date_start}'" : "") . "
      " . ($date_end != '' ? "AND c.created_at <= '{$date_end}'" : "") . "
      " . ($status == 'END' ? "AND c.write_end_date < CURDATE()" : "") . "
      " . ($status == 'ING' ? "AND c.write_end_date >= CURDATE()" : "") . "      
      ORDER BY c.{$sort} DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query("
    SELECT COUNT(*) AS cnt
    FROM {$this->_config['table']['campaign_list']}
    WHERE
    1
    " . ($md ? "AND md = 'Y'" : "") . "
    " . ($category != '' ? "AND category_depth LIKE '{$category}%'" : "") . "
    " . ($area != '' ? "AND area = '{$area}'" : "") . "
    " . ($sns != '' ? "AND sns = '{$sns}'" : "") . "
    " . ($date_start != '' ? "AND created_at >= '{$date_start}'" : "") . "
    " . ($date_end != '' ? "AND created_at <= '{$date_end}'" : "") . "
    " . ($status == 'END' ? "AND write_end_date < CURDATE()" : "") . "
    " . ($status == 'ING' ? "AND write_end_date >= CURDATE()" : "")
    );
    //WHERE rd.regdate = '" . strtotime(date("Y-m-d"." 00:00:00")) . "'
    $row = $this->fetch_array($result2);
    $total = $row['cnt'];

    return array(
      'total_row' => $total,
      'lists' => $lists
    );
  }

  public function get_apply_list($start = 0, $limit = 10)
  {
    $result = $this->query("
      SELECT a.idx as apply_idx, r.idx as review_idx, a.campaign_idx, a.campaign_reward, a.status, a.member_id, m.roles, a.write, a.created_at, r.created_at as write_created_at, m.name, m.phone_number, m.email
      FROM {$this->_config['table']['campaign_apply']} AS a
      LEFT OUTER JOIN {$this->_config['table']['member']} AS m ON a.member_id = m.id
      LEFT OUTER JOIN {$this->_config['table']['campaign_review']} AS r ON a.member_id = r.member_id AND a.campaign_idx = r.campaign_idx
      ORDER BY a.created_at DESC
      LIMIT {$limit} OFFSET {$start}
    ");

    $lists = $this->fetch_array_rows($result);

    $result2 = $this->query("
      SELECT COUNT(*) AS cnt
      FROM {$this->_config['table']['campaign_apply']}
    ");
    //WHERE rd.regdate = '" . strtotime(date("Y-m-d"." 00:00:00")) . "'
    $row = $this->fetch_array($result2);
    $total = $row['cnt'];

    return array(
      'total_row' => $total,
      'lists' => $lists
    );
  }

  // public function get_apply_review($apply_idx) {
  //   $result = $this->query("
  //     SELECT a.idx as apply_idx, r.idx as review_idx, a.status, a.member_id, m.roles, a.write, a.created_at, r.created_at as write_created_at, m.name, m.phone_number, m.email
  //     FROM {$this->_config['table']['campaign_apply']} AS a
  //     LEFT OUTER JOIN {$this->_config['table']['member']} AS m ON a.member_id = m.id
  //     LEFT OUTER JOIN {$this->_config['table']['campaign_review']} AS r ON a.member_id = r.member_id AND a.campaign_idx = r.campaign_idx
  //     WHERE a.idx = '{$apply_idx}'
  //   ");
  // }
}