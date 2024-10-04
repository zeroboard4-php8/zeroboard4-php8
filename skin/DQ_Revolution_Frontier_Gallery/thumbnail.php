<?php 
    $image_id = isset($_GET['num']) ? $_GET['num'] : false;
	$num = isset($_GET['num']) ? $_GET['num'] : false;
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$no = isset($_GET['no']) ? $_GET['no'] : '';
	$s = isset($_GET['s']) ? $_GET['s'] : 90;

    //라이브러리 인클루드
    $current_dir = getcwd();
    chdir('../../');
    require 'lib.php';
    $connect = dbconn();
	$setup = get_table_attrib($id);
    $dir   = 'skin/'.$setup['skinname'];

    $_inclib_01 = $dir.'/include/dq_thumb_engine2.';
    if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) require $_inclib_01.'php';
    else require $_inclib_01.'zend';

    if ($image_id === false || intval($no) < 1) {
		header("HTTP/1.1 500 Internal Server Error");
		exit(0);
	} 

    $result = zb_query("select * from $t_board"."_$id where no=$no") or die(zb_error());
    $data   = mysql_fetch_array($result);

    //업로드된 파일 목록을 배열로 저장
    $tmp       = @get_uploadImages($data,999,1,0);
    $images	   = $tmp[0];
    $image_id  = $images[$num];

    if (!file_exists($image_id)) {
        header("HTTP/1.1 404 Not found");
		exit(0);
	}

    //$dqEngine['screen_only']  = true;
    $dqEngine['thumb_resize'] = 2;
    //$dqEngine['using_usm']    = false;
    if(intval($s) < 10) $s = 90;

    $target = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$data['reg_date']).'_sThumb_'.$no.'_'.$num.$dqEngine['defult_ext'];
    $new_img = make_thumb($s,$s,$images[$num],$target);

    if($new_img != $target) {
      echo 'thumbnail file make faild';
      exit();
    }

    $fp = fopen($new_img,'rb');
    header("Content-Type: image/jpeg");
    header("Content-Length: " . filesize($new_img));
    fpassthru($fp);
?>
