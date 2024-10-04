<?php 
	//if(!eregi($HTTP_HOST,$HTTP_REFERER)) die('정상적인 접근이 아닙니다.');

// 사용권한 체크
	if($setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&file=zboard.php");

// 라이브러리 인클루드
	$_inclib_01 = "skin/".$setup['skinname']."/include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
	else include_once $_inclib_01.'zend';
	
	$filenum = !empty($_GET['filenum']) ? $_GET['filenum'] : null;
    if($_GET['file'] && $_GET['name']) 
    {
        fileDownload($_GET['file'],$_GET['name'],1,8,false);
    } 
    else 
    {
        $data=mysql_fetch_array(zb_query("select * from  `$t_board"."_$id` where no='$no'"));

        // 현재글의 Download 수를 올림;;
        if($filenum==1) {
            zb_query("update `$t_board"."_$id` set download1=download1+1 where no='$no'") or die(zb_error());
        } elseif($filenum==2) {
            zb_query("update `$t_board"."_$id` set download2=download2+1 where no='$no'");
        } 
        if($filenum) {
            $tmp       = @get_uploadImages($data,999,1,0);
            $file	   = $tmp[0];
            $name	   = $tmp[1];
            $tFilename = $file[$filenum-1];
            $sFilename = $name[$filenum-1];
        }

        fileDownload($tFilename,$sFilename,1,8,false);
    }

?>
