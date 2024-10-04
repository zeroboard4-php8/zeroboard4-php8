<?php
	include "lib.php";
	if($_SERVER['REQUEST_METHOD'] != 'POST')  Error("잘못된 접근입니다.");

	$connect=dbconn();

	$user_id = trim($_POST['user_id']);
	$password = trim($_POST['password']);

	if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
		$user_id = zb_escape_string($user_id);
		$password = zb_escape_string($password);
	} else {
        	$user_id = addslashes(zb_escape_string($user_id));
        	$password = addslashes(zb_escape_string($password));
        }

	if(empty($user_id)) Error("아이디를 입력하여 주십시요");
	if(empty($password)) Error("비밀번호를 입력하여 주십시요");
	
	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
	if(isset($id)) {
		$setup=get_table_attrib($id);
		$group=group_info($setup['group_no']);
	}

	if(isset($setup['group_no'])) $group_no=$setup['group_no'];


// 회원 로그인 체크
    $password_new=get_password($password);
	$result = zb_query("select * from $member_table where user_id='$user_id' and password='$password_new'") or error(zb_error());
	$member_data = mysql_fetch_array($result);
	
	if(!isset($member_data['no'])&&strlen(get_password("a"))>=41) {
		$password=get_password($password, true);
		$result = zb_query("select * from $member_table where user_id='$user_id' and password='$password'") or error(zb_error());
		$member_data = mysql_fetch_array($result);
	}

// 회원로그인이 성공하였을 경우 세션을 생성하고 페이지를 이동함
	if(isset($member_data['no'])) {
		$query = mysql_fetch_array(zb_query("show columns from $member_table like 'reg_m_date'"));
		if(!isset($query[0])) {
			zb_query("alter table $member_table add reg_m_date int(13)");
		}
		$dbqry="UPDATE $member_table SET reg_m_date = '$now_time' WHERE no='$member_data[no]'";
		zb_query($dbqry);

		if(!empty($_POST['auto_login'])) {
			makeZBSessionID($member_data['no']);
		}

		// 4.0x 용 세션 처리
		$zb_logged_no = $member_data['no'];
		$zb_logged_time = time();
		$zb_logged_ip = $_SERVER['REMOTE_ADDR'];
		$zb_last_connect_check = '0';
		$_SESSION['zb_logged_no']=$zb_logged_no;
		$_SESSION['zb_logged_time']=$zb_logged_time;
		$_SESSION['zb_logged_ip']=$zb_logged_ip;
		$_SESSION['zb_last_connect_check']=0;
		$_SESSION['zb_hash'] = md5($now_time.$member_data['user_id'].$member_data['no'].$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);


		// 로그인 후 페이지 이동
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
		if(empty($s_url)&&!empty($id)) $s_url="zboard.php?id=$id";
		if(!empty($s_url)) movepage($s_url);
		elseif(!empty($id)) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no");
		elseif(!empty($group['join_return_url'])) movepage($group['join_return_url']);
		elseif(!empty($referer)) movepage($referer);
		else echo"<script>history.go(-2);</script>";

// 회원로그인이 실패하였을 경우 에러 표시
	} else {
		head();
		Error("로그인을 실패하였습니다");
		foot();
	}

	mysql_close($connect);
?>
