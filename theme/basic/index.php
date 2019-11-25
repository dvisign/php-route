<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<?php 
$request = $_SERVER['REQUEST_URI'];
$requestSplit = explode("/", $request);
$requestArr = array(
  "root" => $requestSplit[1],
  "page" => $requestSplit[2]
);
switch ($requestArr["page"]) {
  case '' :
    require __DIR__ . '/views/index.php';
    break;
  case 'index' :
    require __DIR__ . '/views/index.php';
    break;
  case 'about' :
    require __DIR__ . '/views/about.php';
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/views/error.php';
    break;
}
?>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>