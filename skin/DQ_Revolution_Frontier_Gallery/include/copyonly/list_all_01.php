<?php 
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
    if(!$dqEngine['defult_ext']) {
      $setup = get_table_attrib($id);
      $config_file = 'skin/'.$setup['skinname'].'/get_config.php';
      $_inclib_01 = 'skin/'.$setup['skinname'].'/include/dq_thumb_engine2.';
      if(file_exists($_inclib_01.php) && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
      else include_once $_inclib_01.'zend';
      $ext = $dqEngine['defult_ext'];
	}
	if(empty($i)) $i = 0;
	if(empty($temp['reg_date'])) $temp['reg_date'] = '';
	if(empty($selected)) $selected = array();
    if(!empty($temp['file_name1'])) {
      $fnum = 0;
      $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$temp['reg_date']).'_sThumb_'.$selected[$i].'_'.$fnum.$ext;
      @z_unlink($t);
    }
    if(!empty($temp['file_name2'])) {
      $fnum++;
      $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$temp['reg_date']).'_sThumb_'.$selected[$i].'_'.$fnum.$ext;
      @z_unlink($t);
    }

    //레볼루션 데이터를 가져옴
	if(!empty($selected[$i])) $m_data=mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$selected[$i]'"));

	if(!empty($m_data['no'])) {
	  $tmp_files  = explode(",",$m_data['file_names']);
	  $tmp_sfiles = explode(",",$m_data['s_file_names']);

	  //레볼루션 파일삭제
	  if(!empty($tmp_files)) {
		for($mImg_count=0; $mImg_count<999; $mImg_count++) {
		  if($tmp_files[$mImg_count]) @z_unlink("./".$tmp_files[$mImg_count]);
		  if(!isset($fnum)) $fnum=0;
          $fnum++;
          $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$temp['reg_date']).'_sThumb_'.$selected[$i].'_'.$fnum.$ext;
          @z_unlink($t);
        }

	    //레볼루션 게시물 데이터 삭제
		zb_query("DELETE FROM dq_revolution WHERE no='{$m_data['no']}' LIMIT 1"); 
	  }
	}

	if(!empty($temp['reg_date'])){
        $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$temp['reg_date']).'small_'.$selected[$i].$ext;
        @z_unlink($t);
	}
?>
