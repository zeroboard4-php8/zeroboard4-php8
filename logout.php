<?php
	include "lib.php";

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 멤버 정보 구해오기
	$member=member_info();

	if(!isset($member['no'])) Error("로그인 상태가 아닙니다");

	if(!isset($group_no)) $group_no=$member['group_no'];

	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
	if(isset($id)) $setup=get_table_attrib($id);
  
	if(isset($setup['group_no'])&&!isset($group_no)) $group_no=$setup['group_no'];
  
	//mysql_close($connect);

	destroyZBSessionID($member['no']);
	
	// 4.0x 용 세션 처리
	$_SESSION['zb_logged_no']='';
	$_SESSION['zb_logged_time']='';
	$_SESSION['zb_logged_ip']='';
	$_SESSION['zb_secret']='';
	$_SESSION['zb_last_connect_check']=0;
	unset($_SESSION['zb_logged_no'],$_SESSION['zb_logged_time'],$_SESSION['zb_logged_ip'],$_SESSION['zb_secret']);
	session_destroy(); 
	$id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page_num = !empty($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '';
	$select_arrange = !empty($_REQUEST['select_arrange']) ? $_REQUEST['select_arrange'] : '';
	$des = !empty($_REQUEST['des']) ? $_REQUEST['des'] : '';
	$sn = !empty($_REQUEST['sn']) ? $_REQUEST['sn'] : '';
	$ss = !empty($_REQUEST['ss']) ? $_REQUEST['ss'] : '';
	$sc = !empty($_REQUEST['sc']) ? $_REQUEST['sc'] : '';
	$keyword = !empty($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
	$category = !empty($_REQUEST['category']) ? $_REQUEST['category'] : '';
	$no = !empty($_REQUEST['no']) ? $_REQUEST['no'] : '';
	$s_url = !empty($_REQUEST['s_url']) ? urldecode($_REQUEST['s_url']) : '';
	if(!empty($s_url)) movepage($s_url);
	if(!empty($id)) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");
	elseif(!empty($group['join_return_url'])) movepage($group['join_return_url']);
	elseif(!empty($referer)) movepage($referer);
	else echo"<script>history.go(-2);</script>";
?>
