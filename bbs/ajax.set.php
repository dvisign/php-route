<?php
include_once("../common.php");
include_once(G5_LIB_PATH."/thumbnail.lib.php");
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$status = $_REQUEST["status"];
switch ($method) {
  case 'GET':
    switch ($status) {
      case "latest" : 
        $sql = " select bo_table
         from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
         where a.bo_device <> 'mobile' ";
        if(!$is_admin)
        $sql .= " and a.bo_use_cert = '' ";
        $sql .= " and a.bo_table not in ('notice', 'gallery') ";     //공지사항과 갤러리 게시판은 제외
        $sql .= " order by b.gr_order, a.bo_order ";
        $query = mysqli_query($connect_db, $sql);
        $count = mysqli_num_rows($query);
        $data = "";
        echo "[";
        for ($i=0; $i<$count;$i++) {
          $res[$i] = mysqli_fetch_assoc($query);
          $thumbs = get_list_thumbnail($bo_table, $res[$i]['wr_id'], 700, 700, false, true);
          $data = array(
            "bo_table" => $res[$i]["bo_table"]
          );
          echo ($i>0?',':'').json_encode($data);
        }
        echo "]";
        break;
      case "main" :
        $sql = "SELECT * FROM g5_write_".$bo_table." WHERE wr_is_comment='0' ORDER BY wr_2 ASC";
        $query = mysqli_query($connect_db,$sql);      
        $count = mysqli_num_rows($query);
        $data = "";
        echo '[';
        for ($i=0; $i < $count; $i++) {
          $res[$i] = mysqli_fetch_assoc($query);
          $thumbs = get_list_thumbnail($bo_table, $res[$i]['wr_id'], 700, 700, false, true);
          $fileSql = "SELECT * FROM g5_board_file WHERE bo_table='".$bo_table."' AND wr_id='".$res[$i]['wr_id']."'";
          $fileQuery = mysqli_query($connect_db, $fileSql);
          $fileRes[$i] = mysqli_fetch_assoc($fileQuery);
          $data = array(
            "wr_subject" => $res[$i]["wr_subject"],
            "wr_text" => $res[$i]["wr_content"],
            "wr_aligin" => $res[$i]["wr_1"],
            "wr_img" => $thumbs["ori"],
            "wr_link" => $res[$i]["wr_link1"],
            "titleColor" => $res[$i]["wr_3"],
            "textColor" => $res[$i]["wr_4"],
            "wr_file" => G5_DATA_URL."/file/".$bo_table."/".$fileRes[$i]["bf_file"]
          );
          echo ($i>0?',':'').json_encode($data);
        }
        echo ']';
        break;
  }
}
