<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<div id="root"></div>
<script type="text/babel">
  var Router = ReactRouter.Router;
  var Route = ReactRouter.Route;
  var IndexRoute = ReactRouter.IndexRoute;
  var Link = ReactRouter.Link;
  var browserHistory = ReactRouter.browserHistory;
  var BrowserRouter = ReactRouterDOM.BrowserRouter;
  class Nav extends React.Component { 
    render() {
      return (
        <div class="gnb_wrap">
          <ul id="gnb_1dul">
            <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>
            <?php
            $sql = " select *
                     from {$g5['menu_table']}
                     where me_use = '1'
                     and length(me_code) = '2'
                     order by me_order, me_id ";
            $result = sql_query($sql, false);
            $menu_datas = array();
            for ($i=0; $row=sql_fetch_array($result); $i++) {
              $menu_datas[$i] = $row;
              $sql2 = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                        and length(me_code) = '4'
                        and substring(me_code, 1, 2) = '{$row['me_code']}'
                        order by me_order, me_id ";
              $result2 = sql_query($sql2);
              for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                $menu_datas[$i]['sub'][$k] = $row2;
              }
            }
            $i = 0;
            foreach( $menu_datas as $row ){
              if( empty($row) ) continue; ?>
                <li class="gnb_1dli">
                  <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                  <?php
                  $k = 0;
                  foreach( (array) $row['sub'] as $row2 ){
                    if( empty($row2) ) continue; 
                      if($k == 0)
                        echo '<span class="bg">하위분류</span><ul class="gnb_2dul">'.PHP_EOL;
                    ?>
                    <li class="gnb_2dli"><Link to="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></Link></li>
                    <?php
                    $k++;
                  }   //end foreach $row2
                  if($k > 0)
                    echo '</ul>'.PHP_EOL;
                  ?>
                </li>
              <?php
              $i++;
            }   //end foreach $row
            if ($i == 0) {  ?>
              <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
          </ul>
          <div id="gnb_all">
            <ul class="gnb_al_ul">
            <?php
            $i = 0;
            foreach( $menu_datas as $row ) { ?>
              <li class="gnb_al_li">
                <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a>
                <?php
                $k = 0;
                foreach( (array) $row['sub'] as $row2 ){
                  if($k == 0)
                    echo '<ul>'.PHP_EOL;
                ?>
                  <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $row2['me_name'] ?></a></li>
                  <?php
                  $k++;
                  }   //end foreach $row2
                  if($k > 0)
                    echo '</ul>'.PHP_EOL;
                  ?>
                  </li>
                <?php
                $i++;
                }   //end foreach $row ?>
            </ul>
            <button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>
        </div>
      );
    }
  }
  console.log(window.ReactRouterDOM);
  class App extends React.Component { 
    render() {
      return (
        <BrowserRouter>
          <Nav />
          <div>
            <Route path="/" component={Main}></Route>
            <Route path="/About" component={About}></Route>
          </div>
        </BrowserRouter>
      );
    }
  }
  class Main extends React.Component {
    render() {
      return (
        <div>
          main
        </div>
      )
    }
  }
  class About extends React.Component {
    render() {
      return (
        <div>
          About
        </div>
      )
    }
  }
  ReactDOM.render(<App />, document.getElementById('root'));
</script>
<script>    
  $(function(){
    $(document).on("click", ".gnb_menu_btn", function(){
      $("#gnb_all").show();
    });
    $(document).on("click", ".gnb_close_btn", function(){
      $("#gnb_all").hide();
    });
  });
</script>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>