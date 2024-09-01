<?php
/******************************************************************************
 * Zeroboard library 
 *
 * 마지막 수정일자 : 2006. 3. 15
 * 이 파일내의 모든 함수는 원하시는대로 사용하셔도 됩니다.
 *
 * by zero (zero@nzeo.com)
 *
 ******************************************************************************/
	if(realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) exit;

	// 에러 표시 설정    
	ini_set('display_errors', '0');
	require "fixcloudflare.php";

	// W3C P3P 규약설정
	header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

	// 현재 버젼
	$zb_version = "4.1 pl8";
	$zb_php8_version = 'php8-0.5';

	/*******************************************************************************
 	 * 에러 리포팅 설정과 register_globals_on일때 변수 재 정의
 	 ******************************************************************************/
 	@error_reporting(E_ALL & ~E_NOTICE);
	
 	$ext_arr = array('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
                  	'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
               	    'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
	$filterxssval = array('name', 'email', 'homepage', 'subject', 'memo', 'keyword', 'user_id', 'jumin1', 'jumin2',
					'birth_1', 'birth_2', 'birth_3', 'sitelink1', 'sitelink2', 'icq', 'aol', 'msn', 'hobby', 'job',
					'home_address', 'home_tel', 'office_address', 'office_tel', 'handphone', 'comment');
 	$ext_cnt = count($ext_arr);
 	for($i=0; $i<$ext_cnt; $i++) {
 	 	if (isset($_GET[$ext_arr[$i]]))  unset($_GET[$ext_arr[$i]]);
     	 	if (isset($_POST[$ext_arr[$i]])) unset($_POST[$ext_arr[$i]]);
 	}
	foreach($filterxssval as $val) {
		if(in_array($val, array_keys($_GET))) $_GET[$val] = xss2($_GET[$val]);
		if(in_array($val, array_keys($_POST))) $_POST[$val] = xss2($_POST[$val]);
	}
	
 	$_GET = array_map('Request_Var', $_GET);
 	zb_gpc_extract($_GET);
 	zb_gpc_extract($_POST);
 	zb_gpc_extract($_COOKIE);
 	$PHP_SELF = $_SERVER['PHP_SELF'];
 	$HTTP_HOST = $_SERVER['HTTP_HOST'];
 	if(isset($_SERVER['HTTP_REFERER'])) $HTTP_REFERER = $_SERVER['HTTP_REFERER']; else $HTTP_REFERER = "";
 	$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
 	$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
 	$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
 	$REQUEST_URI = $_SERVER['REQUEST_URI'];

 	if(isset($page)) $page = (int)$page;

	$temp_filename=realpath(__FILE__);
	if($temp_filename) $config_dir=str_replace("lib.php","",$temp_filename);
	else $config_dir="";
	$now_time = time();

	/*******************************************************************************
 	 * 기본 변수 초기화. (php의 오류같지 않은 오류 때문에;; ㅡㅡ+)
 	 ******************************************************************************/
	unset($member);
	unset($group);
	unset($setup);
	unset($s_que);
	unset($que);
	unset($now_data);
	if(isset($select_arrange)) {
		$select_arrange = str_replace(array("'",'"','\\'),'',$select_arrange);
		if(!in_array($select_arrange,array('headnum','subject','name','hit','vote','reg_date','download1','download2'))) unset($select_arrange);
	}
	if(isset($desc)) if(!in_array($desc,array('desc','asc'))) unset($desc);

	/*******************************************************************************
 	 * include 되었는지를 검사
 	 ******************************************************************************/
	if(defined("_zb_lib_included")) return;
	define("_zb_lib_included",true);

	$_startTime=getmicrotime();

	/*******************************************************************************
 	 * 기본 설정 파일을 읽음
 	 ******************************************************************************/
 	$_zbDefaultSetup = getDefaultSetup();

	/*******************************************************************************
 	 * install 페이지가 아닌 경우
 	 ******************************************************************************/
	if(strpos(strtolower($PHP_SELF),"install") === false &&file_exists($_zb_path."config.php")) {

 	 	//세션 처리 (세션은 3일동안 유효하게 설정)
		if(!is_dir($_zb_path.$_zbDefaultSetup['session_path'])) {
			mkdir($_zb_path.$_zbDefaultSetup['session_path'], 0777);
			chmod($_zb_path.$_zbDefaultSetup['session_path'], 0777);
		}

		// Data, Icon, 세션디렉토리의 쓰기 권한이 없다면 에러 처리
		if(!is_writable($_zb_path."data")) error("Data 디렉토리의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 Data 디렉토리의 쓰기 권한이 있어야 합니다");
		if(!is_writable($_zb_path."icon")) error("icon 디렉토리의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 icon 디렉토리의 쓰기 권한이 있어야 합니다");
		if(!is_writable($_zb_path.$_zbDefaultSetup['session_path'])) error("세션 디렉토리(".$_zb_path.$_zbDefaultSetup['session_path'].")의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 세션디렉토리의 쓰기 권한이 있어야 합니다");

		$_sessionStart = getmicrotime();
		@session_save_path($_zb_path.$_zbDefaultSetup['session_path']);
		@session_cache_limiter('nocache, must_revalidate');
		@ini_set("session.gc_maxlifetime", "18000");

		session_set_cookie_params(0,"/");

		// 세션 변수의 등록
		@session_start();

		// 조회수 가 512byte를, 투표 세션변수가 256byte를 넘을시 리셋 (개인서버를 이용시에는 조금 더 늘려도 됨)
		if(isset($_SESSION['zb_hit'])) {
			if(strlen($_SESSION['zb_hit'])>$_zbDefaultSetup['session_view_size']) {
				///$zb_hit='';
				//session_register("zb_hit");
				$_SESSION['zb_hit'] = '';
			}
		}
		if(isset($_SESSION['zb_vote'])) {
			if(strlen($_SESSION['zb_vote'])>$_zbDefaultSetup['session_vote_size']) {
				//$zb_vote='';
				//session_register("zb_vote");
				$_SESSION['zb_vote'] = '';
			}
		}
		// 자동 로그인일때 제대로 된 자동 로그인인지 체크하는 부분
		unset($autoLoginData);
		$autoLoginData = getZBSessionID();
		if(isset($autoLoginData['no'])) {
			$zb_logged_no=$autoLoginData['no'];
			$zb_logged_ip=$_SERVER['REMOTE_ADDR'];
			$zb_logged_time=time();
			$_SESSION['zb_logged_no'] = $zb_logged_no;
			$_SESSION['zb_logged_ip'] = $zb_logged_ip;
			$_SESSION['zb_logged_time'] = $zb_logged_time;

		// 세션 값을 체크하여 로그인을 처리
		} elseif(isset($_SESSION['zb_logged_no'])) {

			// 로그인 시간이 지정된 시간을 넘었거나 로그인 아이피가 현재 사용자의 아이피와 다를 경우 로그아웃 시킴
			if(time()-intval($_SESSION['zb_logged_time'])>$_zbDefaultSetup['login_time']||$_SESSION['zb_logged_ip']!=$_SERVER['REMOTE_ADDR']) {

				$_SESSION['zb_logged_no'] = '';
			$_SESSION['zb_logged_ip'] = '';
			$_SESSION['zb_logged_time'] = '';
				unset($_SESSION['zb_logged_no'],$_SESSION['zb_logged_ip'],$_SESSION['zb_logged_time']);
				session_destroy();

			// 유효할 경우 로그인 시간을 다시 설정
			} else {
				// 4.0x 용 세션 처리
				$zb_logged_time=time();
				$_SESSION['zb_logged_time'] = $zb_logged_time;
			}

		}

		// 현재 접속자의 데이타를 체크하여 파일로 저장 (회원, 비회원으로 구분해서 저장)
		$_nowConnectStart = getmicrotime();
		if($_zbDefaultSetup['nowconnect_enable']=="true") {
			$_zb_now_check_intervalTime = isset($_SESSION['zb_last_connect_check']) ? time()-$_SESSION['zb_last_connect_check'] : time();

			if(!isset($_SESSION['zb_last_connect_check'])||$_zb_now_check_intervalTime>$_zbDefaultSetup['nowconnect_refresh_time']) {

				// 4.0x 용 세션 처리
				$zb_last_connect_check = time();
				$_SESSION['zb_last_connect_check'] = $zb_last_connect_check;

				if(isset($_SESSION['zb_logged_no'])) {
					$total_member_connect = $total_connect = getNowConnector($_zb_path."data/now_member_connect.php",$_SESSION['zb_logged_no']);
					$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php", TRUE);
				} else {
					$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php", TRUE);
					$total_guest_connect = getNowConnector($_zb_path."data/now_connect.php",$_SERVER['REMOTE_ADDR']);
				}
			} else {
				$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php",FALSE);
				$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php",FALSE);
			}

		}

	}

	$_nowConnectEnd = getmicrotime();

	
	// 익스와 넷스케이프일때 처리
	if(strpos($HTTP_USER_AGENT,"MSIE") !== false) $browser="1"; else $browser="0";


	// DB가 설정이 되었는지를 검사
	if(!file_exists($config_dir."config.php")&&strpos(strtolower($PHP_SELF),"install") === false) {
 		echo"<meta http-equiv=\"refresh\" content=\"0; url=install.php\">";
 		exit;
	}


	// 관리자 테이블과 회원관리 테이블의 이름을 미리 변수로 정의
	$table_prefix = 'zetyx_';  // 테이블 접두사
	$member_table = $table_prefix . 'member_table';  // 회원들의 데이타가 들어 있는 직접적인 테이블
	$group_table = $table_prefix . 'group_table';   // 그룹테이블
	$admin_table=$table_prefix . 'admin_table';     // 게시판의 관리자 테이블

	$send_memo_table =$table_prefix . 'send_memo';
	$get_memo_table =$table_prefix . 'get_memo';

	$t_division=$table_prefix . 'division'; // Division 테이블
	$t_board = $table_prefix . 'board'; // 메인 테이블
	$t_comment =$table_prefix . 'board_comment'; // 코멘트테이블
	$t_category =$table_prefix . 'board_category'; // 카테고리 테이블


	// 마이크로 타임 구함
	function getmicrotime() {
    	list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
	}


	/******************************************************************************
 	* Division 관련 함수
 	*****************************************************************************/
	// 전체 division 구함
	function total_division() {
 		global $connect, $t_division, $id;
 		$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
 		return $temp[0];
	}

	// 답글일때 해당 division의 num 값 증가
	function plus_division($division) {
		global $connect, $t_division, $id;
		zb_query("update $t_division"."_$id set num=num+1 where division='$division'") or error(zb_error);
	}

	// 삭제하거나 공지글을 일반글로 옮기는 등의 division num값 변화시 해당 division의 num값 감소시킴
	function minus_division($division) {
		global $connect, $t_division, $id;
		zb_query("update $t_division"."_$id set num=num-1 where division='$division'") or error(zb_error);
	}


	// 신규글쓰기일때 최근 division의 num 값 증가
	function add_division($board_name="") {
		global $connect, $t_division, $id, $t_board;
		if($board_name) $board_id=$board_name;
		else $board_id=$id;
		$temp=mysql_fetch_array(zb_query("select num from $t_division"."_$board_id order by division desc limit 1"));

		// 현재 division의 num값이 기준값일때는 division +1 해줌;
		if($temp[0]>=500000) {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$board_id"));
			$max_division=$temp[0]+1;
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$board_id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$board_id where (division='$max_division' or division='$second_division') and headnum<=-2000000000"));
			if($temp[0]>0) {
				zb_query("update $t_board"."_$board_id set division='$max_division' where (division='$max_division' or division='$second_division') and  headnum<='-2000000000'") or error(zb_error());
				zb_query("update $t_division"."_$board_id set num=num-$temp[0] where division=$max_division-1") or error(zb_error());
			}
			$num=$temp[0]+1;
			zb_query("insert into $t_division"."_$board_id (division,num) values ('$max_division','$num')");
			return $max_division;
		} else {
 		// 현재 division이 기준값개보다 작을때~
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$board_id"));
			$division=$temp[0];
			zb_query("update $t_division"."_$board_id set num=num+1 where division='$division'");
			return $division;
		}
	}
		$_sessionEnd = getmicrotime();
	/******************************************************************************
 	* 로그인이 되어 있는지를 검사하여 로그인되어있으면 해당 회원의 정보를 저장
 	*****************************************************************************/
	function member_info() {

		global $member_table, $member, $connect;
		if(defined("_member_info_included")&&$member['no']) return $member;
		define("_member_info_included", true);

		if(isset($member['no'])) return $member;
		
		if(isset($_SESSION['zb_logged_no'])) {
			$query=zb_query("select * from $member_table where no ='".$_SESSION['zb_logged_no']."'");
			$member=mysql_fetch_array($query);
			if(mysql_num_rows($query) < 1) {
			session_destroy();
			unset($member,$_SESSION['zb_logged_no'],$_SESSION['zb_logged_ip'],$_SESSION['zb_logged_time'],$_SESSION['zb_hash']);
			$member['level'] = 10;
			} else {
			$zb_hash_chk = md5($member['reg_m_date'].$member['user_id'].$member['no'].$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
			
			if(!isset($_SESSION['zb_hash'])) $_SESSION['zb_hash'] = "";
			if($_SESSION['zb_hash'] != $zb_hash_chk)
			{
				session_destroy();
				unset($member,$_SESSION['zb_logged_no'],$_SESSION['zb_logged_ip'],$_SESSION['zb_logged_time'],$_SESSION['zb_hash']);
				$member['level'] = 10;
			}
		} 
	} else $member['level'] = 10;
	return $member;
}


	function group_info($no) {
		global $group_table;
		$temp=mysql_fetch_array(zb_query("select * from $group_table where no='$no'"));
		return $temp;
	}

	/******************************************************************************
 	* 제로보드 전용 함수
 	*****************************************************************************/
	// MySQL 데이타 베이스에 접근
	function dbconn() {

		global $connect, $config_dir, $autologin, $_dbconn_is_included;

		if($_dbconn_is_included) return;
		$_dbconn_is_included = true;

		$f=@file($config_dir."config.php") or Error("config.php파일이 없습니다.<br>DB설정을 먼저 하십시오","install.php");

		for($i=1;$i<=4;$i++) $f[$i]=trim(str_replace("\n","",$f[$i]));

		if(!isset($connect)) $connect = mysql_connect($f[1],$f[2],$f[3]) or Error("DB 접속시 에러가 발생했습니다");

		mysql_select_db($f[4], $connect) or Error("DB Select 에러가 발생했습니다","");
		zb_query("set names 'utf8'");
	
		return $connect;
	}


	// 글의 아이콘을 뽑아줌;;
	function get_icon($data) {
		global $dir;
		if(isset($data['reg_date'])) {
			// 글쓴 시간 구함
			$check_time=(time()-$data['reg_date'])/60/60;

			// 앞에 붙는 아이콘 정의
			if($data['depth']) {
				if($check_time<=12) $icon="<img src=$dir/reply_new_head.gif border=0 align=absmiddle>&nbsp;"; // 최근 글일경우
				else $icon="<img src=$dir/reply_head.gif border=0 align=absmiddle>&nbsp;"; // 답글일때
			} else {
				if($check_time<=12) $icon="<img src=$dir/new_head.gif border=0 align=absmiddle>&nbsp;"; // 최근 글일경우
				else $icon="<img src=$dir/old_head.gif border=0 align=absmiddle>&nbsp;";          // 답글이 아닐때
			}
			if($data['headnum']<=-2000000000) $icon="<img src=$dir/notice_head.gif border=0 align=absmiddle>&nbsp;"; // 공지사항일때
			else if($data['is_secret']==1) $icon="<img src=$dir/secret_head.gif border=0 align=absmiddle alt='비밀글입니다'>&nbsp;";
			return $icon;
		}
	}


	// 회원 개인에게 주어지는 아이콘을 찾는 함수
	// $type : 1 -> 이름앞에 나타나는 아이콘
	// $type : 2 -> 이름을 대신하는 아이콘
	function get_private_icon($no, $type) {
		if($type==1) $dir = "icon/private_icon/";
		elseif($type==2) $dir = "icon/private_name/";

		if(@file_exists($dir.$no.".gif")) return $dir.$no.".gif";
	}


	// 이름 앞에 붙는 얼굴 아이콘
	function get_face($data, $check=0) {
		global $group;
		$face_image='';
		// 이름앞에 붙는 아이콘 정의;;
		if($group['use_icon']==0) {
			if($data['ismember']) { 
				if($data['islevel']==2) $face_image="<img src=images/admin2_face.gif border=0 align=absmiddle>";
				elseif($data['islevel']==1) $face_image="<img src=images/admin1_face.gif border=0 align=absmiddle>";
				else {
					if($group['icon']) $face_image="<img src=icon/$group[icon] border=0 align=absmiddle>";
					else $face_image="<img src=images/member_face.gif border=0 align=absmiddle>";
				}
			} 
			else $face_image="<img src=images/blank_face.gif border=0 align=absmiddle> ";
		}

		$temp_name = get_private_icon($data['ismember'], "1");
		if($temp_name) $face_image="<img src='$temp_name' border=0 align=absmiddle>";
	
		if($group['use_icon']<2&&$data['ismember']) $face_image .= "<b>";

		//if($data['ismember']&&$data['parent']) $face_image="<b>";
		//elseif($data['parent']) $face_image="";
	
		return $face_image;
	}


	// 게시판 관리자인지 체크하는 부분
	function check_board_master($member, $board_num) {
		if(!isset($member['board_name'])) return 0;
		$temp = explode(",",$member['board_name']);
		for($i=0;$i<count($temp);$i++) {
			$t = trim($temp[$i]);
			if($t&&$t==$board_num) return 1;
		}
		return 0;
	}

	//  초기 헤더를 뿌려주는 부분;;;;
	function head($body="",$scriptfile="") {

		global $group, $setup, $dir,$member, $PHP_SELF, $id, $_head_executived, $width;

		if($_head_executived) return;
		$_head_executived = true;

		if(file_exists('license.txt')) {
			$f = @fopen("license.txt","r");
			$license = @fread($f,filesize("license.txt"));
			@fclose($f);
			print "<!--\n".$license."\n-->\n";
		}
	
		if(strpos(strtolower($PHP_SELF),"member_") === false && isset($setup)) $stylefile="skin/$setup[skinname]/style.css"; else $stylefile="style.css";

		if(isset($setup) && isset($setup['use_formmail'])) {
			$f = fopen("script/script_zbLayer.php","r");
			$zbLayerScript = fread($f, filesize("script/script_zbLayer.php"));
			fclose($f);
		}
		
		// html 시작부분 출력
		if(isset($setup) && $setup['skinname']) {
			?>
<html> 
<head>
	<title><?=$setup['title']?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>
	<?php if($setup['use_formmail']) echo $zbLayerScript;?>
	<?php if($scriptfile) include "script/".$scriptfile;?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?><?php

			if($setup['bg_color']) echo " bgcolor=".$setup['bg_color']." ";
			if($setup['bg_image']) echo " background=".$setup['bg_image']." ";

			?>>
			<?php
			if($group['header_url']) { @include $group['header_url']; }
			if($setup['header_url']) { @include $setup['header_url']; }
			if($group['header']) echo stripslashes($group['header']);
			if($setup['header']) echo stripslashes($setup['header']);
			?>
			<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
			<?php
		} else {

			?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel=StyleSheet HREF=style.css type=text/css title=style>
	<?php if(isset($script)) echo $script; ?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
			<?php
				if(isset($group) && $group['header_url']) { @include $group['header_url']; }
				if(isset($group) && $group['header']) echo stripslashes($group['header']);
		}

	}



	// 푸터 부분 출력
	function foot() {

		global $width, $group, $setup, $_startTime , $_queryTime , $_foot_executived, $_skinTime, $_sessionStart, $_sessionEnd, $_nowConnectStart, $_nowConnectEnd, $_dbTime, $_listCheckTime, $_zbResizeCheck;

		if($_foot_executived) return;
		$_foot_executived = true;

		$maker_file=@file("skin/$setup[skinname]/maker.txt");
		if(is_array($maker_file) && $maker_file[0]) $maker="/ skin by $maker_file[0]";
		else $maker = "";

		if(isset($setup) && $setup['skinname']) {
			?>

			<table border=0 cellpadding=0 cellspacing=0 height=20 width=<?=$width?>>
			<tr>
				<td align=right style=font-family:tahoma,굴림;font-size:8pt;line-height:150%;letter-spacing:0px>
					<font style=font-size:7pt>Copyright 1999-<?=date("Y")?></font> <a href=https://github.com/zeroboard4-php8/zeroboard4-php8 target=_blank onfocus=blur()><font style=font-family:tahoma,굴림;font-size:8pt;>Zeroboard</a> <?=$maker?>
				</td>   
			</tr>
			</table>

			<?php
			if($_zbResizeCheck) {
			?>
			<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
			<script>
				function zb_img_check(){
					var zb_main_table_width = document.zb_get_table_width.width;
					var zb_target_resize_num = document.zb_target_resize.length;
					for(i=0;i<zb_target_resize_num;i++){ 
						if(document.zb_target_resize[i].width > zb_main_table_width) {
							document.zb_target_resize[i].width = zb_main_table_width;
						}
					}
				}
				window.onload = zb_img_check;
			</script>

			<?php
			}

			if($setup['footer']) echo stripslashes($setup['footer']);
			if($group['footer']) echo stripslashes($group['footer']);
			if($setup['footer_url']) { @include $setup['footer_url']; }
			if($group['footer_url']) { @include $group['footer_url']; }
			?>

</body>
</html>
			<?php
			
		} else {

			if(isset($group) && $group['footer']) echo stripslashes($group['footer']);
			if(isset($group) && $group['footer_url']) { @include $group['footer_url']; }

			?>
			</body>
			</html>
			<?php
		}

		$_phpExecutedTime = (getmicrotime()-$_startTime)-($_sessionEnd-$_sessionStart)-($_nowConnectEnd-$_nowConnectStart)-$_dbTime-$_skinTime;
		// 실행시간 출력
		echo "\n\n<!--"; 
		if($_sessionStart&&$_sessionEnd)  		echo"\n Session Executed  : ".sprintf("%0.4f",$_sessionEnd-$_sessionStart);
		if($_nowConnectStart&&$_nowConnectEnd) 	echo"\n Connect Checked  : ".sprintf("%0.4f",$_nowConnectEnd-$_nowConnectStart);
		if($_dbTime)  							echo"\n Query Executed  : ".sprintf("%0.3f",$_dbTime);
		if($_phpExecutedTime)  					echo"\n PHP Executed  : ".sprintf("%0.3f",$_phpExecutedTime);
		if($_listCheckTime) 					echo"\n Check Lists : ".sprintf("%0.3f",$_listCheckTime);
		if($_skinTime) 							echo"\n Skins Executed  : ".sprintf("%0.3f",$_skinTime);
   		if($_startTime) 						echo"\n Total Executed Time : ".sprintf("%0.3f",getmicrotime()-$_startTime);
		echo "\n-->\n";
	}


	// zbLayer 출력
	function check_zbLayer($data) {
		global $zbLayer, $setup, $member, $is_admin, $id, $_zbCheckNum;
		if($setup['use_formmail']) {
			if(!$_zbCheckNum) $_zbCheckNum=0;
			$data['name']=isset($data['name']) ? $data['name'] : '';
			$data['name']=stripslashes($data['name']);
			$data['name']=urlencode($data['name']);
			//$data['name']=str_replace("\"","",$data['name']);
			//$data['name']=str_replace("'","\'",$data['name']);
			//$data['name']=str_replace(" ","",$data['name']);

			if(isset($data['homepage'])){
				$data['homepage']=str_replace("http://","",stripslashes($data['homepage']));
				//$data['homepage']=str_replace("\"","",$data['homepage']);
				//$data['homepage']=str_replace("'","",$data['homepage']);
				//$data['homepage']=str_replace(" ","",$data['homepage']);
				$data['homepage']=urlencode($data['homepage']);
				$data['homepage']="http://".$data['homepage'];
			}

			$data['email']=base64_encode(isset($data['email'])?$data['email']:'');

			$_zbCheckNum++;
			$_zbCount=1;

			if($member['level']!==10) {
				if(($member['is_admin']==1||$member['is_admin']==2)&&$data['ismember']) {
					$traceID = $data['ismember'];
					$traceType="t";
					$isAdmin=1;
				} elseif(($member['is_admin']==1||$member['is_admin']==2)&&!$data['ismember']) {
					$traceID = $data['name'];
					$traceType="tn";
					$isAdmin=1;
				}
			}

			if(isset($member['no'])) $isMember = 1;

			if($data['ismember']<1) $data['ismember']="";

			if(!isset($traceID)) $traceID = '';
			if(!isset($traceType)) $traceType = '';
			if(!isset($isAdmin)) $isAdmin = '';
			if(!isset($isMember)) $isMember = '';
			if(!isset($data['homepage'])) $data['homepage'] = '';
			$zbLayer = $zbLayer."\nprint_ZBlayer('zbLayer$_zbCheckNum', '".$data['homepage']."', '$data[email]', '$data[ismember]', '$id', '$data[name]', '$traceID', '$traceType', '$isAdmin', '$isMember');";
			return $_zbCount;
		} else {
			return 0;
		}
	}
	

	// 에러 메세지 출력
	function error($message, $url="") {
		global $setup, $connect, $dir, $config_dir;

		if(!empty($setup['skinname'])) $dir="skin/".$setup['skinname']; else $dir="skin/";
		if($url=="window.close") {
			$message=str_replace("<br>","\\n",$message);
			$message=str_replace("\"","\\\"",$message);
			?>
			<script>
				alert("<?=$message?>");
				window.close();
			</script>
			<?php
		} else {

			head();

			if(!empty($setup['skinname'])) {
				include "skin/$setup[skinname]/error.php";
			} else {
				include $config_dir."error.php";
			}

			foot();

		}

		if($connect) mysql_close($connect);

		exit;
	}


	// 게시판 설정을 읽어옴
	function get_table_attrib($id) {

		global $connect, $admin_table;

		$data=mysql_fetch_array(zb_query("select * from $admin_table where name='$id'",$connect));

		if($data['table_width']<=100) $data['table_width']=$data['table_width']."%"; 

		// 원래는 IP를 보여주는 기능인데, DB 변경을 피하기 위해서 이미지 박스 사용 권한으로 변경하여 사용
		if(!$data['use_showip']) $data['use_showip'] = 1;
		$data['grant_imagebox'] = $data['use_showip'];

		return $data;
	}


	// 게시판의 생성유무 검사
	function istable($str, $dbname='') {
		global $config_dir;
		if(!$dbname) {
			$f=@file($config_dir."config.php") or Error("config.php파일이 없습니다.<br>DB설정을 먼저 하십시오","install.php");
			for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
			$dbname=$f[4];
		}

		$result = mysql_list_tables($dbname) or error(zb_error(),"");

		$i=0;

		while ($i < mysql_num_rows($result)) {
			if($str==mysql_tablename($result, $i)) return 1;
			$i++;
		}
		return 0;
	}


	// 현재 아이피와 주어진 아이피 리스트를 비교하여 아이피 블럭 대상자인지 검사
	function check_blockip() {
		global $setup;
		$avoid_ip=explode(",",$setup['avoid_ip']);
		$count = count($avoid_ip);
		for($i=0;$i<$count;$i++) {
			if(!isblank($avoid_ip[$i])&&strpos($_SERVER['REMOTE_ADDR'],$avoid_ip[$i]) !== false) Error("차단당한 IP 주소입니다.");
		}
	}


	// 접속자수 체크
	function getNowConnector($filename,$div) {
		global $_zbDefaultSetup;
		$_str = trim(zReadFile($filename));
		$num = 0;
		if($_str) {
			$_str = str_replace("<?php die('Access Denied');/*","",$_str);
			$_str = str_replace("*/?>","",$_str);
			$_connector = explode(":",$_str);
			$_sizeConnector = count($_connector);
			$_nowtime = date("YmdHi");
			$_realNowConnector = "";
			if($_sizeConnector) {
				for($i=0;$i<$_sizeConnector;$i++) {
					$_time = (int)substr($_connector[$i],0,12);
					$_div = substr($_connector[$i],12);
					if($_time+$_zbDefaultSetup['nowconnect_time']>=$_nowtime&&$_div!=$div) {
						$_realNowConnector.=$_time.$_div.":";
						$num++;
					}
				}
			}
		}
		if(!isset($_realNowConnector)) $_realNowConnector="";
		if(!isset($_nowtime)) $_nowtime="";
		$_realNowConnector.=$_nowtime.$div;
		//check_fileislocked($filename);
		zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
		return $num;
	}

	// 접속자수 구하기
	function getNowConnector_num($filename, $FLAG=FALSE) {
		global $_zbDefaultSetup;
		$_str = trim(zReadFile($filename));
		$num = 0;
		if($_str) {
			$_str = str_replace("<?php die('Access Denied');/*","",$_str);
			$_str = str_replace("*/?>","",$_str);
			$_connector = explode(":",$_str);
			$_sizeConnector = count($_connector);
			$_nowtime = date("YmdHi");
			$_realNowConnector = "";
			if($_sizeConnector) {
				for($i=0;$i<$_sizeConnector;$i++) {
					$_time = (int)substr($_connector[$i],0,12);
					$_div = substr($_connector[$i],12);
					if($_time+$_zbDefaultSetup['nowconnect_time']>=$_nowtime) {
						$_realNowConnector.=$_time.$_div.":";
						$num++;
					}
				}
			}
		}
		if($FLAG) {
			//check_fileislocked($filename);
			if(!isset($_realNowConnector)) $_realNowConnector="";
			zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
		}
		return $num;
	}


	// 제로보드 자동 로그인 세션값이 있는지 판단해서 있으면 해당 값을 리턴
	function getZBSessionID() {
		global $_zb_path, $_zbDefaultSetup;

		if(isset($_COOKIE['ZBSESSIONID'])) $zbSessionID = $_COOKIE['ZBSESSIONID'];

		if(!isset($zbSessionID)) return array();
		$str = zReadFile($_zb_path.$_zbDefaultSetup['session_path']."/zbSessionID_".$zbSessionID.".php");

		if(!$str) {
			@setcookie("ZBSESSIONID", "", time()+60*60*24*365, "/");
			return array();
		}

		$str = explode("\n",$str);

		$data['no'] = trim($str[1]);
		$data['time'] = trim($str[2]);

		$newZBSessionID = md5($data['no']."-^A-".$data['time']);

		if($newZBSessionID != $zbSessionID) {
			@setcookie("ZBSESSIONID", "", time()+60*60*24*365, "/");
			return array();
		}

		if(!$_zb_path) {
			z_unlink($_zb_path.$_zbDefaultSetup['session_path']."/zbSessionID_".$zbSessionID.".php");
			makeZBSessionID($data['no']);
		}

		return $data;
	}


	// 제로보드 자동 로그인 세션값을 만드는 함수
	function makeZBSessionID($no) {
		global $_zb_path, $_zbDefaultSetup;
		$no = (int)$no;

		$zbSessionID = md5($no."-^A-".time());

		$newStr = "<?php /*\n$no\n".time()."\n*/?>";

		zWriteFile($_zb_path.$_zbDefaultSetup['session_path']."/zbSessionID_".$zbSessionID.".php", $newStr);

		@setcookie("ZBSESSIONID", $zbSessionID, time()+60*60*24*365, "/");
	}


	// 제로보드 자동 로그인 세션값 파기시키는 함수
	function destroyZBSessionID($no) {
		global $_zb_path, $_zbDefaultSetup;
		$zbSessionID = isset($_COOKIE['ZBSESSIONID']) ? $_COOKIE['ZBSESSIONID'] : '';
		if (preg_match('/^[0-9a-f]+$/', $zbSessionID)) {
			z_unlink($_zb_path.$_zbDefaultSetup['session_path']."/zbSessionID_".$zbSessionID.".php");
		}
		@setcookie("ZBSESSIONID", "", time()+60*60*24*365, "/");
	}

	// 제로보드의 기본 설정 파일을 읽어오는 함수
	function getDefaultSetup() {
		global $_zb_path, $HTTP_HOST;
		$data = zReadFile($_zb_path."setup.php");
		$data = str_replace("<?php /*","",$data);	
		$data = str_replace("*/?>","",$data);	
		$data = explode("\n",$data);
		$_c = count($data);
		unset($defaultSetup);
		for($i=0;$i<$_c;$i++) {
			if(strpos($data[$i],";") === false &&strlen(trim($data[$i]))) {
				$tmpStr = explode("=",$data[$i]);
				$name = trim($tmpStr[0]);
				$value = trim($tmpStr[1]);
				$defaultSetup[$name]=$value;
			}
		}
		if(!$defaultSetup['url']) $defaultSetup['url'] = $HTTP_HOST;
		if(!$defaultSetup['sitename']) $defaultSetup['sitename'] = $HTTP_HOST;
		if(!$defaultSetup['session_path']) $defaultSetup['session_path'] = "data/__zbSessionTMP";
		if(!$defaultSetup['session_view_size']) $defaultSetup['session_view_size'] = 512;
		if(!$defaultSetup['session_vote_size']) $defaultSetup['session_vote_size'] = 256;
		if(!$defaultSetup['login_time']) $defaultSetup['login_time'] = 60*30;
		if(!$defaultSetup['nowconnect_enable']) $defaultSetup['nowconnect_enable'] = "true";
		if(!$defaultSetup['nowconnect_refresh_time']) $defaultSetup['nowconnect_refresh_time'] = 60*3;
		if(!$defaultSetup['nowconnect_time']) $defaultSetup['nowconnect_tim'] = 60*5;
		if(!$defaultSetup['enable_hangul_id']) $defaultSetup['enable_hangul_id'] = "false";
		if(!$defaultSetup['check_email']) $defaultSetup['check_email'] = "true";
		if(!$defaultSetup['memo_limit_time']) $defaultSetup['memo_limit_time'] = 0;
		$defaultSetup['memo_limit_time'] = 60 * 60 * 24 * $defaultSetup['memo_limit_time'];
		 
		return $defaultSetup;
	}


	/******************************************************************************
 	 * 일반 함수
 	 *****************************************************************************/
	// 빈문자열 경우 1을 리턴
	function isblank($str) {
		if(!isset($str)) return 1;
		$temp=str_replace("　","",$str);
		$temp=str_replace("\n","",$temp);
		$temp=strip_tags($temp);
		$temp=str_replace("&nbsp;","",$temp);
		$temp=str_replace(" ","",$temp);
		if(preg_match("/[^[:space:]]/",$temp)) return 0;
		return 1;
	}


	// 숫자일 경우 1을 리턴
	function isnum($str) {
		if(preg_match("/[^0-9]/",$str)) return 0;
		return 1;
	}


	function zero_script_conv($list,$str) {
		$str=str_replace("<","&lt;",$str);
		$source = array();
		$target = array();
		$list = explode(",", trim($list).',iframe');
		foreach($list as $key => $val) {
			$val = trim($val);
			if (!$val) continue;
			$source[] = "/&lt;{$val}/i";
			$target[] = "<{$val}";
			$source[] = "/&lt;\/{$val}/i";
			$target[] = "</{$val}";
		}
		return preg_replace($source, $target, $str);
	}


	function download_file($server_name,$file_name) {
		if(empty($server_name) || empty($file_name)) return 1;

		$filename = $server_name;
		$filename = realpath($filename);

		if(strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
			//$file_name = rawurlencode($file_name);
			$file_name = preg_replace("/\./", "%2E", $file_name, substr_count($file_name, '.') - 1);
		}
		
		if (!file_exists($filename)) {
			error("파일을 찾을 수 없습니다.");
		}
		$fp = fopen($filename, 'rb');
		if(!$fp) exit;
		header("Cache-Control: ");
		header("Pragma: ");
		header("Content-Type: application/octet-stream");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Content-Length: ".@filesize($filename));
		header("Content-Disposition: attachment; filename=\"".$file_name."\"");
		header("Content-Transfer-Encoding: binary\n");
		fpassthru($fp);
		exit();
	}

	// 숫자, 영문자 일경우 1을 리턴
	function isalNum($str) {
		if(preg_match("/[^0-9a-zA-Z\_]/",$str)) return 0;
		return 1;
	}

	// HTML Tag를 제거하는 함수
	function del_html( $str ) {
		$str = str_replace( ">", "&gt;",$str );
		$str = str_replace( "<", "&lt;",$str );
		return $str;
	}


	// 주민등록번호 검사
	function check_jumin($jumin) { 
		$weight = '234567892345'; // 자리수 weight 지정 
		$len = strlen($jumin); 
		$sum = 0; 

		if ($len <> 13) return false;

		for ($i = 0; $i < 12; $i++) { 
			$sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1)); 
		} 

		$rst = $sum%11; 
		$result = 11 - $rst; 

		if ($result == 10) $result = 0;
		else if ($result == 11) $result = 1;

		$ju13 = substr($jumin,12,1); 

		if ($result <> $ju13) return false;
		return true; 
	} 


	// E-mail 주소가 올바른지 검사
	function ismail( $str ) {
		if( preg_match("/([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/i", $str) ) return $str;
		else return ''; 
	}

	// E-mail 의 MX를 검색하여 실제 존재하는 메일인지 검사
	function mail_mx_check($email) {
		if(!ismail($email)) return false;
		list($user, $host) = explode("@", $email);
		if (checkdnsrr($host, "MX") or checkdnsrr($host, "A")) return true;
		else return false;
	}


	// 홈페이지 주소가 올바른지 검사
	function isHomepage( $str ) {
		if(preg_match("/^http://([a-z0-9\_\-\./~@?=&amp;-\#{5,}]+)/i", $str)) return $str;
		else return '';
	}


	// URL, Mail을 자동으로 체크하여 링크만듬
	function autolink($str) {
		global $is_admin, $data, $member;
		$regex['file'] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
		$regex['file'] = "(\.($regex[file])\") TARGET=\"_blank\"";
		$regex['http'] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9,:;&#=_~%\[\]?\/.,+\-]+)([.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
		$regex['mail'] = "([\xA1-\xFEa-z0-9_.-]+)@([\xA1-\xFEa-z0-9_-]+\.[\xA1-\xFEa-z0-9._-]*[a-z]{2,3}(\?[\xA1-\xFEa-z0-9=&\?]+)*)";
		$src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
		$tar[] = "<\\1\\2\\3>";
		$src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
		$tar[] = "<\\1\\2>";
		$src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*($regex[http]|mailto:$regex[mail])[^>]*>/i";
		$tar[] = "<\\1 \\2=\"\\3\">";
		$src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
		$tar[] = "\\1://\\2_HTTPAT_\\3";
		$src[] = "/&(quot|gt|lt)/i";
		$tar[] = "!\\1";
		$src[] = "/&#034;/i";
		$tar[] = "\"";
		$src[] = "/&#039;/i";
		$tar[] = "'";
		$src[] = "/&#125;/";
		$tar[] = "}";
		$src[] = "/<a([^>]*)href=[\"' ]*($regex[http])[\"']*[^>]*>/i";
		$tar[] = "<A\\1HREF=\"\\3_orig://\\4\" TARGET=\"_blank\">";
		$src[] = "/href=[\"' ]*mailto:($regex[mail])[\"']*>/i";
		$tar[] = "HREF=\"mailto:\\2#-#\\3\">";
		$src[] = "/<([^>]*)(background|codebase|src)[ \n]*=[\n\"' ]*($regex[http])[\"']*/i";
		$tar[] = "<\\1\\2=\"\\4_orig://\\5\"";
		$src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)($regex[http])/i";
		$tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</A>";
		$src[] = "/($regex[mail])/i";
		$tar[] = "<A HREF=\"mailto:\\1\">\\1</A>";
		$src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
		$tar[] = "\\1";
		$src[] = "/<\/A><\/A>/i";
		$tar[] = "</A>";
		$src[] = "/!(quot|gt|lt)/i";
		$tar[] = "&\\1";
		$src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
		$tar[] = "\\1";
		$src[] = "'#-#'";
		$tar[] = "@";
		$src[] = "/$regex[file]/i";
		$tar[] = "\\1";
		$src[] = "/_HTTPAT_/";
		$tar[] = "@";
		if (!empty($is_admin) && isset($data['ismember']) && isset($member['no'])) { 
			if ($is_admin && $data['ismember']!==$member['no']) { 
				$src[] = "/(\<(embed|object|ruby|form|meta)[^\>]*)\>?(\<\/(embed|object|ruby|form|meta)\>)?/i";
				$tar[] = "<div style=\"border:1px solid #dcbba3;padding: 6px;background-color: #f9f2ee;color: #bf0000;line-height: 160%\">보안문제로 인하여 관리자 아이디로는 이 게시물에 사용된 embed 또는 object 태그를 볼 수 없습니다.<br />확인하시려면 관리자 권한이 없는 다른 아이디로 접속하십시오.</div>";
			}
		}
	
		$str = preg_replace($src,$tar,$str);
		return $str;
	}


	// 파일 사이즈를 kb, mb에 맞추어서 변환해서 리턴
	function getfilesize($bytes) {
		$units = array( 0 => 'Byte', 1 => 'KB', 2 => 'MB', 3 => 'GB' );
		$log = log( $bytes, 1024 );
		$power = (int) $log;
		$size = pow(1024, $log - $power);
		return round($size, 2) . ' ' . $units[$power];
	}

	
	// 문자열 끊기 (이상의 길이일때는 ... 로 표시)
	function cut_str($msg, $cut_size, $suffix='...') {
		if ($cut_size <= 0) return $msg;
		$result = '';
		$currentlen = 0;
		$i = 0;
		$strlength = strlen($msg);
		while ($i < $strlength && $currentlen < $cut_size) {
			$char = ord($msg[$i]);
			// UTF-8 문자 바이트 수 계산
			$charlen = ($char < 128) ? 1 : (($char & 0xE0) == 0xC0 ? 2 : (($char & 0xF0) == 0xE0 ? 3 : 4));
			// 길이를 초과하지 않는 경우만 추가
			if ($currentlen + 1 > $cut_size) break;
			$result .= substr($msg, $i, $charlen);
			$currentlen += 1;
			$i += $charlen;
		}
		if ($i < $strlength) $result .= $suffix;
		return $result;
	}

	// 페이지 이동 스크립트
	function movepage($url) {
		global $connect;
		echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
		if(isset($connect)) mysql_close($connect);
		exit;
	}

	// input 또는 textarea의 사이즈를 넷쓰와 익스일때 구분하여 리턴
	function size($size) {
		global $browser;
		if(!$browser) return " size=".($size*0.6)." ";
		else return " size=$size ";
	}

	function size2($size) {
		global $browser;
		if(!$browser) return " cols=".($size*0.6)." ";
		else return " cols=$size ";
	}


	// 메일 보내는 함수
	function zb_sendmail($type, $to, $to_name, $from, $from_name, $subject, $comment, $cc="", $bcc="") {
		$recipient = "$to_name <$to>";

		if($type==1) $comment = nl2br($comment);

		$headers = "From: $from_name <$from>\n";
		$headers .= "X-Sender: <$from>\n";
		$headers .= "X-Mailer: PHP ".phpversion()."\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "Return-Path: <$from>\n";

		if(!$type) $headers .= "Content-Type: text/plain; ";
		else $headers .= "Content-Type: text/html; ";
		$headers .= "charset=utf-8\n";

		if($cc)  $headers .= "cc: $cc\n";
		if($bcc)  $headers .= "bcc: $bcc";

		$comment = stripslashes($comment);
		$comment = str_replace("\n\r","\n", $comment);

		return @mail($recipient , $subject , $comment , $headers);

	}

	// 지정된 디렉토리의 파일 정보를 구함
	function get_dirinfo($path) {
		$handle=@opendir($path);
		while($info = readdir($handle)) {
			if($info != "." && $info != "..") {
				$dir[] = $info;
			}
		}
		closedir($handle);
		return $dir;
	}

	// 파일을 삭제하는 함수
	function z_unlink($filename) {
		@chmod($filename,0777);
		$handle = @unlink($filename);
		if(@file_exists($filename)) {
			@chmod($filename,0775);
			$handle=@unlink($filename);
		}
		return $handle;
	}

	// 지정된 파일의 내용을 읽어옴
	function zReadFile($filename) {
		if(!file_exists($filename)) return '';

		$f = fopen($filename,"r");
		$str = fread($f, filesize($filename));
		fclose($f);

		return $str;
	}

	// 지정된 파일에 주어진 데이타를 씀
	function zWriteFile($filename, $str) {
		$f = fopen($filename,"w");
		$lock=flock($f,2);
		if($lock) {
			fwrite($f,$str);
		}
		flock($f,3);
		fclose($f);
	}

	// 지정된 파일이 Locking중인지 검사
	function check_fileislocked($filename) {
		$f=@fopen($filename,w);
		$count = 0;
		$break = true;
		while(!@flock($f,2)) {
			$count++;
			if($count>10) {
				$break = false;
				break;
			}
		}
		if($break!=false) @flock($f,3);
		@fclose($f);
	}

	// 순환적으로 디렉토리를 삭제
	function zRmDir($path) { 
		$directory = dir($path); 
		while($entry = $directory->read()) { 
			if ($entry != "." && $entry != "..") { 
				if (Is_Dir($path."/".$entry)) { 
					zRmDir($path."/".$entry); 
				} else { 
					@UnLink ($path."/".$entry); 
				} 
			} 
		} 
		$directory->close(); 
		@RmDir($path); 
	}
	
	function zb_escape_string($param) {
    		if(!empty($param) && is_string($param)) {
        		return str_replace(array("%", '\\', "\0", "\n", "\r", "'", '"', "\x1a"), array ("\%", '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $param);
    		}
    		return $param;
	}

	function Request_Var($str) {
		if(is_array($str)) return $str;
		else return htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $str));
	}
	
	// 패스워드 생성 함수
	// 1. 16자 방식 비밀번호 출력을 원하는 경우
	// 2. mysql에서 password() 사용 가능한 경우(16자 또는 41자 출력)
	// 3. mysql에 password()가 아예 없는 경우
	function get_password($str, $isold=false) {
		global $connect;
		if ($isold===true) {
			$nr    = 1345345333;
			$add   = 7;
			$nr2   = 0x12345671;
			$tmp   = null;
			for ($i = 0; $i < strlen($str); $i++) {
				$byte = substr($str, $i, 1);
				if ($byte == ' ' || $byte == "\t") {
					continue;
				}
				$tmp = ord($byte);
				$nr ^= ((($nr & 63) + $add) * $tmp) + (($nr << 8) & 0xFFFFFFFF);
				$nr2 += (($nr2 << 8) & 0xFFFFFFFF) ^ $nr;
				$add += $tmp;
			}
			$rs = sprintf("%08x%08x", $nr & 0x7FFFFFFF, $nr2 & 0x7FFFFFFF);
		} else {
			$tmp0 = zb_query("SELECT password('$str')");
			if (isset($tmp0)) {
				$tmp1 = mysql_fetch_array($tmp0);
				mysql_free_result($tmp0);
				$rs = $tmp1[0];
			} else {
				$rs = '*'.strtoupper(sha1(sha1($str, true)));
			}
		}
		return $rs;
	}
	
	// <input type=hidden name=csrf_token value=<?=generate_csrf_token() 방식으로 사용
	function generate_csrf_token() {
		if (isset($_SESSION['csrf_token']) && time() - $_SESSION['csrf_token_time'] < 600) {
			return $_SESSION['csrf_token'];
		}
		$_SESSION['csrf_token'] = uniqid(md5(mt_rand()), false);
		$_SESSION['csrf_token_time'] = time();
		return $_SESSION['csrf_token'];
	}
	
	function check_csrf_token() {
		$csrf_token = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : "";
		if (isset($_POST['csrf_token']) && ($csrf_token === $_POST['csrf_token'])) {
			if (time() - $_SESSION['csrf_token_time'] > 1800) {
				unset($_SESSION['csrf_token']);
				return false;
			}
			return true;
		} else {
			return false;
		}
	}
	
	function zb_gpc_extract($array) {
		if(!is_array($array)) return false;
		
		$valid_variables = preg_replace("/^(GLOBALS|dir|_.*)$/i", '', array_keys($array));
		$valid_variables = array_unique($valid_variables);
	
		foreach ( $valid_variables as $key ) {
			if(strlen($key)===0) continue;
			if(is_array($array[$key])) continue;
			$GLOBALS[$key] = trim(strval($array[$key]));
		}
		return true;
	}

	function zb_script_conv($message_comment) {
	/* 제로보드4.1 XSS/CSRF (by 체리맛 http://ncafe.kr) */
		$message_comment = str_replace("<","\n<",$message_comment);
		$message_comment = str_replace(">",">\n",$message_comment);
		$message_comment = preg_replace("#>.*\n\n<\/iframe>#i","></iframe>",$message_comment);
		$array_mess = explode ("\n",$message_comment);
		$message_comment = "";
		$youtube = '<iframe(?:\b|_).*?(?:\b|_)src=\"https?:\/\/(?:www\.)?youtube.com\/(?:\b|_).*?(?:\b|_)';
		foreach ($array_mess as $val) {
			if (preg_match("/</",$val)&&!preg_match("/{$youtube}/i", $val) ){
				$val = preg_replace('#\<(\/{0,1})([a-z]{0,2})(frame|applet|script|body|iframe|xmp|xml)(.*?)\>#i', '', $val);
				$val = preg_replace('#( on[a-z]{1,})="(.*?)"#i', '', $val);
				$val = preg_replace('#( on[a-z]{1,})=\'(.*?)\'#i', '', $val);
				$val = preg_replace('#( on[a-z]{1,})[ \t]*=[ \t]*([^ \t\>]*?)#i', '', $val);
				$val = preg_replace('#(alert|expression|javascript|vbscript|about|iframe|frameset|frame|applet|body|innerHTML|unescape)#i', '', $val);
				$val = preg_replace('#(&\#x*)([0-9A-F]+);*#i', '', $val);
				$val = str_replace(array('<?php ', '?>'), array('&lt;?', '?&gt;'), $val);
			}
			$message_comment .=$val;
		}
		return $message_comment;
	}

	function zb_sxs($src) {
 	/* 제로보드4.1 XSS/CSRF (by 체리맛 http://ncafe.kr) */
 		$message = trim($src);
 		$message = str_replace("<","\n<",$message);
 		$message = str_replace(">",">\n",$message);
 		$array_m = explode ("\n",$message);
 		$message = "";
 		foreach ($array_m as $val) {
  			if (preg_match("/</",$val)) {
   				$val = preg_replace('/admin_setup\.php/i', '403', $val);
  			}
  			$message .=$val;
 		}
 		return $message;
	}
	
	function xss2($data) {
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		$youtube = '<iframe(?:\b|_).*?(?:\b|_)src=\"https?:\/\/(?:www\.)?youtube.com\/(?:\b|_).*?(?:\b|_)iframe>';
		do {
			$Temporary = $data;
			if(!preg_match("/{$youtube}/i", $data)) $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		} while ($Temporary !== $data);
		return trim($data);
	}

	////////////////////////////////////// 레거시 함수 시작
	function zb_query($query, $conn = null) {
		global $connect;
		$query = trim($query);
		$query = preg_replace("#^select.*from.*[\s\(]+union[\s\)]+.*#i ", "select 1", $query);
		$query = preg_replace("#^select.*from.*where.*`?information_schema`?.*#i", "select 1", $query);
		if ($conn != null) $connect = $conn;
		if (!function_exists("mysql_query")) {
			try {
			    return @mysqli_query($connect, $query);
			}  catch (Exception $e) {
			}
		} else {
			return @mysql_query($query);
		}
	}
	
	function zb_error() {
		global $connect, $is_admin;
		if (empty($is_admin)&&(strpos($_SERVER['SCRIPT_NAME'], 'install')===false)&&(strpos($_SERVER['SCRIPT_NAME'], 'admin_setup.php')===false)) {
			return 'DB 질의 중 오류가 발생했습니다.<br>관리자라면 로그인해서 해당 내용을 확인 할 수 있습니다.';
		} elseif(!function_exists("mysql_error")) {
			if (empty($connect)) {
			    error("DB 접속시 에러가 발생했습니다");
			} else {
			    return mysqli_error($connect);
			}
		} else {
			return mysql_error();
		}
	}
	
	if (!function_exists("ereg")) {
		function ereg($pattern, $string, &$regs = array()) {
			$pattern = str_replace("\\/", "/", $pattern);
			$pattern = str_replace("/", "\\/", $pattern);
			return preg_match("/" . $pattern . "/", $string, $regs);
		}
	}

	if (!function_exists("eregi")) {
		function eregi($pattern, $string, &$regs = array()) {
			$pattern = str_replace("\\/", "/", $pattern);
			$pattern = str_replace("/", "\\/", $pattern);
			return preg_match("/" . $pattern . "/i", $string, $regs);
		}
	}

	if (!function_exists("ereg_replace")) {
		function ereg_replace($pattern, $replacement, $string) {
			$pattern = str_replace("\\/", "/", $pattern);
			$pattern = str_replace("/", "\\/", $pattern);
			return preg_replace("/" . $pattern . "/", $replacement, $string);
		}
	}

	if (!function_exists("eregi_replace")) {
		function eregi_replace($pattern, $replacement, $string) {
			$pattern = str_replace("\\/", "/", $pattern);
			$pattern = str_replace("/", "\\/", $pattern);
			return preg_replace("/" . $pattern . "/i", $replacement, $string);
		}
	}

	if (!function_exists("split")) {
		function split($pattern, $string) {
			return explode($pattern, $string);
		}
	}

	if (!function_exists("session_register")) {
		function session_register() {
			$arg_list = func_get_args();
			foreach ($arg_list as $name) {
				if (isset($GLOBALS[$name])) $_SESSION[$name] = $GLOBALS[$name];
				$GLOBALS[$name] = &$_SESSION[$name];
			}
		}
	}

	if (!function_exists("get_magic_quotes_gpc")) {
		function get_magic_quotes_gpc() {
			return false;
		}
	}

	if (!function_exists("mysql_fetch_array")) {
		function mysql_fetch_array($resource) {
			try {
			    return mysqli_fetch_array($resource);
			}  catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_connect")) {
		function mysql_connect($host = null, $user = null, $password = null, $database = null, $port = null, $socket = null) {
			try {
			    return @mysqli_connect($host, $user, $password, $database, $port, $socket);
			} catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_select_db")) {
		function mysql_select_db($dbname, $conn = null) {
			global $connect;
			if ($conn != null) $connect = $conn;
			try {
				return mysqli_select_db($connect, $dbname);
			} catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_close")) {
		function mysql_close($result) {
			try {
			    return mysqli_close($result);
			} catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_list_tables")) {
		function mysql_list_tables($dbname = null) {
			global $connect, $config_dir;
			if ($dbname) mysql_select_db($dbname, $connect);
			return zb_query("show tables");
		}
	}

	if (!function_exists("mysql_num_rows")) {
		function mysql_num_rows($result = null) {
			try {
			    return mysqli_num_rows($result);
			} catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_tablename")) {
		function mysql_tablename($result, $i) {
			global $connect;
			$result_copy = $result;
			$values = array();
			while ($row = mysql_fetch_array($result_copy)) {
				$values[] = $row[0];
			}
			return isset($values[$i]) ? $values[$i] : 0;
		}
	}

	if (!function_exists("mysql_insert_id")) {
		function mysql_insert_id($result = null) {
			global $connect;
			if ($result != null) $connect = $result;
			try {
			    return mysqli_insert_id($connect);
			} catch (Exception $e) {
			}
		}
	}

	if (!function_exists("mysql_free_result")) {
		function mysql_free_result($result) {
			try {
			    return mysqli_free_result($result);
			} catch (Exception $e) {
			}
		}
	}
	////////////////////////////////////// 레거시 함수 끝
?>