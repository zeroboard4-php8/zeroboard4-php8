<?php 
global $_MAKING_THUMBNAIL;
if(empty($id)) global $id;

if(!empty($_GET['config'])) {
    header("content-type: text/plan; charset=UTF-8");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
    header("Cache-Control: no-store, no-cache, must-revalidate"); 
    header("Cache-Control: post-check=0, pre-check=0", false); 
    header("Pragma: no-cache"); 
    chdir ('../../');
    require 'lib.php';
    $conn   = dbconn();
    $member = member_info();
    $setup  = get_table_attrib($id);
    if($member['is_admin']==1||($member['is_admin']==2&&$member['group_no']==$setup['group_no'])||check_board_master($member, $setup['no'])) $is_admin=1; else $is_admin="";
}

if(empty($_SS)) {

	//제로보드 경로
		if(!isset($_zb_path) || !@file_exists($_zb_path.'zboard.php')) {
			if(@is_file('./zboard.php')) $_zb_path = realpath('./');
			elseif(@is_file('../zboard.php')) $_zb_path = realpath('../');
			elseif(@is_file('../../zboard.php')) $_zb_path = realpath('../../');
			elseif(@is_file('../../../zboard.php')) $_zb_path = realpath('../../../');
			else die('<br><br>제로보드 경로를 찾지못했습니다.<br><br>');

			$_zb_path .= '/';
		}

		if(!empty($_GET['dir']) || empty($dir)) $dir = realpath(dirname(__FILE__));

	// 엔진 가져오기
		if(!function_exists('make_thumb')) {
			$_inclib_01 = $dir."/include/dq_thumb_engine2.";
			if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) require_once $_inclib_01.'php';
			else require_once $_inclib_01.'zend';
		}

		require dirname(__FILE__).'/skin_version.php';
		require_once $dir."/include/dq_lib.php";

	//경로설정
		$_LIBS_dir         = $_zb_path.'DQ_LIBS/';
		$_LIBS_include_dir = $_LIBS_dir.'include/';
		if($dqrevolutionType == "Gallery") $_SKIN_config_dir  = $_LIBS_dir.'skin_config/';
		else $_SKIN_config_dir  = $_LIBS_dir.'bbs_skin_config/';
		$_SKIN_config_file = $_SKIN_config_dir.'cfg_'.$id.'.php';
		if(!isset($skinConfigMode)) $skinConfigMode=null;
		if($skinConfigMode != 'write') {
			if(!$id) require $_SKIN_config_dir.'cfg_설정초기화.php';
			elseif(file_exists($_SKIN_config_file)) include $_SKIN_config_file;
            $mbPicFile = $_LIBS_include_dir.'member_picture_config_'.$setup['group_no'].'.php';
			if($setup['group_no'] && file_exists($mbPicFile)) require $_LIBS_include_dir.'member_picture_config_'.$setup['group_no'].'.php';
		}

		$_SS = &$skin_setup;

		$_SS['libs_dir'] = $_LIBS_dir;
		if(isset($_SS['css_dir']) && $_SS['css_dir']) $_css_dir = $dir.'/'.$_SS['css_dir']; else $_css_dir='';

		if(file_exists($_css_dir.'css_value.php')) require $_css_dir.'css_value.php';
		if(!isset($_put_css) && empty($_GET['config'])) {
			echo "\n".'<link rel="StyleSheet" HREF="'.$_css_dir.'style.css" type="text/css" title="style">'."\n";
			$_put_css = 1;
		}

	// 내부설정 & 기본설정
		$dqEngine['thumb_color_grey'] = isset($_SS['thumb_color_grey'])? $_SS['thumb_color_grey'] : false;
		$dqEngine['using_urlImg']	  = isset($_SS['using_urlImg'])	   ? $_SS['using_urlImg']	  : true;
		$dqEngine['using_usm']		  = isset($_SS['using_usm'])	   ? $_SS['using_usm']        : true;
		$dqEngine['usm_option1']	  = isset($_SS['usm_option1'])	   ? $_SS['usm_option1']	  : 60;
		$dqEngine['usm_option2']	  = isset($_SS['usm_option2'])	   ? $_SS['usm_option2']	  : 0.5;
		$dqEngine['usm_option3']	  = isset($_SS['usm_option3'])	   ? $_SS['usm_option3']	  : 1;
		$dqEngine['thumb_cutpixel']	  = isset($_SS['thumb_cutpixel'])  ? $_SS['thumb_cutpixel']   : 5;
		$dqEngine['using_secretImg']  = isset($_SS['viewSecretImg'])   ? false : true;

		if(empty($_SS['cmtTimeAlertValue'])) $_SS['cmtTimeAlertValue']     = '360';
		if($dqrevolutionType == 'Gallery') $_SS['using_thumbnail']   = true;
		if(empty($_SS['language_dir'])) $_SS['language_dir'] = "language/kor_image_white/";
        $_lang_dir = $dir.'/'.$_SS['language_dir'];

		$c_replyMode = !empty($_SS['using_cReplyMode']) ? true : false;
		$dqEngine['using_urlenc'] = true;

		if(!isset($_SS['disable_login']))   $_SS['disable_login'] = false;
		if(!isset($_SS['upload_number']))   $_SS['upload_number'] = 0;
		if(!isset($_SS['namedsp_width']))          $_SS['namedsp_width'] = 90; // BBS 전용 설정
		if(!isset($_SS['comment_nopoint2']))       $_SS['comment_nopoint2']  = 8;
		if(!isset($_SS['writePointValue']))        $_SS['writePointValue']   = 1;
		if(!isset($_SS['commentPointValue']))      $_SS['commentPointValue'] = 1;
		if(!isset($_SS['memo_bMargin']))           $_SS['memo_bMargin']      = 30;
		if(!isset($_SS['mrbt_pixelValue']))        $_SS['mrbt_pixelValue']   = 300;
		$_SS['using_upload2']   = true;

        $_SS['using_weDefault']   = false;  // 위지윅 에디터를 기본 에디터로 사용 [true: 사용함, false: 사용하지 않음]
        $_SS['delete_oldSession'] = false;  // 글쓰기 완료시 오래된 세션 파일을 찾아 삭제 [true: 사용함, false: 사용하지 않음]

        if(!isset($_SS['slide_album_mode_value0'])) $_SS['slide_album_mode_value0'] = 4;
        if(!isset($_SS['slide_album_mode_value1'])) $_SS['slide_album_mode_value1'] = 4;
        if(!isset($_SS['slide_album_mode_value2'])) $_SS['slide_album_mode_value2'] = 90;

		if(!eregi("msie",getenv("HTTP_USER_AGENT"))) $_SS['using_bgmPlayer'] = false;
}

if(!empty($_GET['config']) && $_GET['config'] == 'SS') 
{
    $_SS['id']           = $id;
    $_SS['no']           = $no;
    $_SS['member_no']    = $member['no'];
    $_SS['member_level'] = $member['no'];
    $_SS['member_admin'] = $is_admin;
    $_SS['grant_view']   = $setup['grant_view'];
    $_SS['CopyrightMSG'] = '게시판 하단의 스킨제작자 표기가 훼손되었거나 출력되지 않았습니다.';
    if(empty($a_prev)) $a_prev='';
    if(empty($a_next)) $a_next='';
    if(empty($a_del)) $a_del='';
	if(empty($a_subj)) $a_subj='';
	if(empty($a_cate)) $a_cate='';
	if(empty($view_once)) $view_once='';

    $_lang_dir = @str_replace(getcwd().'/','',$_lang_dir);
    require $_lang_dir.'view.php';
    require $_lang_dir.'comment.php';
    require $_lang_dir.'list.php';
    $_SS['strLanguage'] = $_strSkin;

	echo json_encode(array_iconv($_SS, "CP949","UTF-8"));
}
?>
