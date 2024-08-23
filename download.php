<?php
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include_once "_head.php";

	if(strpos(strtolower($HTTP_REFERER),strtolower($HTTP_HOST)) === false) die();

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

// 사용권한 체크
	if($setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

// 현재글의 Download 수를 올림;;
    if($filenum==1) {
        zb_query("update `$t_board"."_$id` set download1=download1+1 where no='$no'");
    } else {
        zb_query("update `$t_board"."_$id` set download2=download2+1 where no='$no'");
    }

	$data=mysql_fetch_array(zb_query("select * from  `$t_board"."_$id` where no='$no'"));
  
// 다운로드;;
	$filename="file_name".$filenum;
	$sfilename="s_file_name".$filenum;
	download_file($data[$filename], $data[$sfilename]);
	
	if($connect) {
		mysql_close($connect);
		unset($connect);
	}
?>
