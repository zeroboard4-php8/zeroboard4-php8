<?php 
// if(!eregi($HTTP_HOST,$HTTP_REFERER)) die();

// 라이브러리 인클루드
	$_inclib_01 = "skin/".$setup['skinname']."/include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) require_once $_inclib_01.'php';
	else require_once $_inclib_01.'zend';

    $_put_css = 1;
    require 'skin/'.$setup['skinname'].'/get_config.php';

	$data=mysql_fetch_array(zb_query("select * from  `$t_board"."_$id` where no='$no'"));

// 링크 사이트 허용
    $ret = chk_grantImageLinkSite();

// 지금 업로드하는 파일 가져오기
    if(!empty($file_id)) {
      $uploadDir = './data/__DQ_Revolution_MultiUpload_TempDir__/';
      $_ufile_session = get_uploadFileSession($uploadDir);
      $file_id = $_ufile_session[$file_id];
      $access_file = $uploadDir.$file_id;
      fileDownload($access_file,'revolutionTempImage',1,64,false);
    }

// 업로드된 이미지 목록을 배열로 저장
    if(!empty($ret)) {
      $chkthumb = isset($chkthumb) ? $chkthumb : 1;
      $tmp = get_uploadImages($data,999,1,$chkthumb);
      $is_vdel = $tmp['is_vdel'];
      $images		= $tmp[0];
      $s_images		= $tmp[1];
      $images_size	= $tmp[2];
      $images_count	= $tmp[3];
      $access_file  = $images[$num];
      $access_name  = $s_images[$num];
    } else {
      $access_file  = 'skin/'.$setup['skinname'].'/images/'.$ret;
      $access_name  = $ret;
    }
  
	fileDownload($access_file,$s_images[$num],0,64,false);
?>
