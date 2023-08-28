<?php
namespace App\Libs;

class Database
{
  public $is_debug;
  public $connect_db;

  public $MYSQL_HOST;
  public $MYSQL_USER;
  public $MYSQL_PASSWORD;
  public $MYSQL_DB;

  public $_tn;
  public $_config;

  public $link;

  // constructor
  public function __construct()
  {
    global $_config;
    $this->_config = $_config;

    $this->MYSQL_HOST = $_config['MYSQL_HOST'];
    $this->MYSQL_USER = $_config['MYSQL_USER'];
    $this->MYSQL_PASSWORD = $_config['MYSQL_PASSWORD'];
    $this->MYSQL_DB = $_config['MYSQL_DB'];

    $this->init();
  }

  public function init()
  {
    if (function_exists('mysqli_connect') && MYSQLI_USE) {
      $this->link = mysqli_connect($this->MYSQL_HOST, $this->MYSQL_USER, $this->MYSQL_PASSWORD, $this->MYSQL_DB);

      if (mysqli_connect_errno()) {
        die('Connect Error: ' . mysqli_connect_error());
      }
    } else {
      $this->link = mysql_connect($this->MYSQL_HOST, $this->MYSQL_USER, $this->MYSQL_PASSWORD);
    }

    return $this->link;
  }

  // public function select_db($db, $connect)
  // {
  //     global $po;

  //     if(function_exists('mysqli_select_db') && MYSQLI_USE)
  //         return @mysqli_select_db($connect, $db);
  //     else
  //         return @mysql_select_db($db, $connect);
  // }


  public function set_charset($charset)
  {
    if (function_exists('mysqli_set_charset') && MYSQLI_USE)
      mysqli_set_charset($this->link, $charset);
    else
      mysql_query(" set names {$charset} ", $this->link);
  }

  public function data_seek($result, $offset = 0)
  {
    if (!$result) return;

    if (function_exists('mysqli_set_charset') && MYSQLI_USE)
      mysqli_data_seek($result, $offset);
    else
      mysql_data_seek($result, $offset);
  }

  public function query($sql, $error = DISPLAY_SQL_ERROR)
  {
    global $po, $debug;

    if (!$this->link)
      $link = $po['connect_db'];

    $sql = trim($sql);

    //$sql = preg_replace("#^select.*from.*[\s\(]+union[\s\)]+.*#i ", "select 1", $sql);

    $sql = preg_replace("#^select.*from.*where.*`?information_schema`?.*#i", "select 1", $sql);

    $start_time = $this->is_debug ? get_microtime() : 0;

    if (function_exists('mysqli_query') && MYSQLI_USE) {
      if ($error) {
        $result = @mysqli_query($this->link, $sql) or die("<p>$sql<p>" . mysqli_errno($this->link) . " : " .  mysqli_error($this->link) . "<p>error file : {$_SERVER['SCRIPT_NAME']}");
      } else {
        $result = @mysqli_query($this->link, $sql);
      }
    } else {
      if ($error) {
        $result = @mysql_query($sql, $this->link) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : {$_SERVER['SCRIPT_NAME']}");
      } else {
        $result = @mysql_query($sql, $this->link);
      }
    }

    if ($result && $this->is_debug) {

      $debug['sql'][] = array(
        'sql' => $sql,
        'start_time' => $start_time,
        'end_time' => get_microtime(),
      );
    }

    return $result;
  }

  public function fetch($sql, $error = DISPLAY_SQL_ERROR)
  {
    $result = sql_query($sql, $error, $this->link);
    $row = sql_fetch_array($result);

    return $row;
  }

  public function fetch_array($result)
  {
    if (function_exists('mysqli_fetch_assoc') && MYSQLI_USE)
      $row = @mysqli_fetch_assoc($result);
    else
      $row = @mysql_fetch_assoc($result);

    return $row;
  }

  function fetch_array_row($sql)
  {
    $result = sql_query($sql);
    $ret = mysqli_fetch_row($result);
    return $ret[0];
  }

  public function free_result($result)
  {
    if (function_exists('mysqli_free_result') && MYSQLI_USE)
      return mysqli_free_result($result);
    else
      return mysql_free_result($result);
  }


  public function last_id()
  {
    if (function_exists('mysqli_insert_id') && MYSQLI_USE)
      return mysqli_insert_id($this->link);
    else
      return mysql_insert_id($this->link);
  }


  public function num_rows($result)
  {
    if (function_exists('mysqli_num_rows') && MYSQLI_USE)
      return mysqli_num_rows($result);
    else
      return mysql_num_rows($result);
  }
}
