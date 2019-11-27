<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<div class="wrapper">
  <div class="container">
    <div class="mainSection clear">
      <router-view id="routerSection"></router-view>
      <div id="logins"><login></login></div>
    </div>
  </div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>