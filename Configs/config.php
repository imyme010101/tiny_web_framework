<?php
global $_config;

$_config['ROOT_PATH'] = $_SERVER['DOCUMENT_ROOT'];
$_config['LIB_PATH'] = $_config['ROOT_PATH'] . '/lib';

$hUrl = "";
$sessdir = $_config['ROOT_PATH'] . "/sessions";
$POPATH = $_config['ROOT_PATH'] . $hUrl . "/admin";
@ini_set("session.use_trans_sid", 0);
@ini_set("url_rewriter.tags", "");

session_save_path($sessdir);
chmod($sessdir, 0775);

if (isset($SESSION_CACHE_LIMITER))
    @session_cache_limiter($SESSION_CACHE_LIMITER);
else
    @session_cache_limiter("no-cache, must-revalidate");

ini_set("session.cache_expire", 180);

$maxlife = 86400;

ini_set("session.gc_maxlifetime", $maxlife);
ini_set("session.gc_probability", 1);
ini_set("session.gc_divisor", 1);

session_set_cookie_params(0, '/');
$hostname = preg_replace("/www.|dev./", "", $_SERVER['HTTP_HOST']);
ini_set("session.cookie_domain", "." . $hostname);

@session_start();

$_config['JWT_SECRET_KEY'] = "abcd12341234abcd12341234";

//naver map api
$naver_api_id = "";
$naver_api_key = "";

$_config['KAKAO_CLIENT_ID_KEY'] = "";
$_config['KAKAO_JAVASCRIPT_API_KEY'] = "";
$_config['KAKAO_CALLBACK_URI'] = "";

$_config['GOOGLE_CLIENT_ID_KEY'] = "";
$_config['GOOGLE_SECRET_KEY'] = "";

$_config['NAVER_CLIENT_ID_KEY'] = "";
$_config['NAVER_SECRET_KEY'] = "";


define("DISPLAY_SQL_ERROR", false);
define("MYSQLI_USE", true);

$_config['store']['media'] = array(
    "instagram" => Array("https://www.instagram.com", "인스타그램"),
    "naver" => Array("https://blog.naver.com", "네이버 블로그"),
    "receipt" => Array("#", "영수증 리뷰")
);

$_config['store']['area'] = array(
    '강원도',
    '서울특별시',
    '인천광역시',
    '경기도',
    '부산광역시',
    '대구광역시',
    '광주광역시',
    '대전광역시',
    '울산광역시',
    '충청도',
    '전라도',
    '경상도',
    '제주'
);


include_once $_SERVER['DOCUMENT_ROOT'] . "/Configs/config.db.php";
?>