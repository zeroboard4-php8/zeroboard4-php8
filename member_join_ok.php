<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

	if(strpos(strtolower($HTTP_REFERER),strtolower($HTTP_HOST)) === false) Error("정상적으로 작성하여 주시기 바랍니다.");
	if(strpos(strtolower($HTTP_REFERER),"member_join.php") === false) Error("정상적으로 작성하여 주시기 바랍니다","");
	if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 멤버 정보 구해오기;;; 멤버가 있을때
	$member=member_info();
	if($mode=="admin"&&($member['is_admin']==1||($member['is_admin']==2&&$member['group_no']==$group_no))) $mode = "admin";
	else $mode = "";

	if(isset($member['no'])&&!$mode) Error("이미 가입이 되어 있습니다.","window.close");


// 현재 게시판 설정 읽어 오기
	if(!empty($id)) {
		$setup=get_table_attrib($id);

		// 설정되지 않은 게시판일때 에러 표시
		if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시오");

		// 현재 게시판의 그룹의 설정 읽어 오기
		$group_data=group_info($setup['group_no']);
		if(!$group_data['use_join']&&!$mode) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다");

	} else {

		if(!$group_no) Error("회원그룹을 정해주셔야 합니다");
		$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));
		if(!$group_data['no']) Error("지정된 그룹이 존재하지 않습니다");
		if(!$group_data['use_join']&&!$mode) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다");
	}


// 빈문자열인지를 검사
	$user_id = str_replace("ㅤ","",$user_id);
	$name = str_replace("ㅤ","",$name);

        if(!get_magic_quotes_gpc()) {
          $user_id = addslashes($user_id);
          $password = addslashes($password);
        }
	
	$user_id=trim($user_id);
	if(isBlank($user_id)) Error("ID를 입력하셔야 합니다","");

	$check=mysql_fetch_array(zb_query("select count(*) from $member_table where user_id='$user_id'",$connect));
	if($check[0]>0) Error("이미 등록되어 있는 ID입니다","");

	unset($check);
	$check=mysql_fetch_array(zb_query("select count(*) from $member_table where email='$email'",$connect));
	if($check[0]>0) Error("이미 등록되어 있는 E-Mail입니다","");

	if(isBlank($password)) Error("비밀번호를 입력하셔야 합니다","");

	if(isBlank($password1)) Error("비밀번호 확인을 입력하셔야 합니다","");

	if($password!=$password1) Error("비밀번호와 비밀번호 확인이 일치하지 않습니다","");

	if(isBlank($name)) Error("이름을 입력하셔야 합니다","");
	if(preg_match("/(<|>)/",$name)) Error("이름을 영문, 한글, 숫자등으로 입력하여 주십시오");

	if($group_data['use_jumin']&&!$mode) {

		// 주민등록 번호 루틴
		if(isBlank($jumin1)||isBlank($jumin2)||strlen($jumin1)!=6||strlen($jumin2)!=7) Error("주민등록번호를 올바르게 입력하여 주십시오","");

		if(!check_jumin($jumin1.$jumin2)) Error("잘못된 주민등록번호입니다","");
		
		$jumin_enc1 = get_password($jumin1.$jumin2);
		$jumin_enc2 = get_password($jumin1.$jumin2, true);
		$check=mysql_fetch_array(zb_query("select count(*) from $member_table where jumin='$jumin_enc1' or jumin='$jumin_enc2'",$connect));
		if($check[0]>0) Error("이미 등록되어 있는 주민등록번호입니다","");
		$jumin=get_password($jumin1.$jumin2);
	}


	$name=isset($name) ? addslashes(del_html($name)) : '';
	$email=isset($email) ? addslashes(del_html($email)) : '';
	if($_zbDefaultSetup['check_email']=="true"&&!mail_mx_check($email)) Error("입력하신 $email 은 존재하지 않는 메일주소입니다.<br>다시 한번 확인하여 주시기 바랍니다.");
	$home_address=isset($home_address) ? addslashes(del_html($home_address)) : '';
	$home_tel=isset($home_tel) ? addslashes(del_html($home_tel)) : '';
	$office_address=isset($office_address) ? addslashes(del_html($office_address)) : '';
	$office_tel=isset($office_tel) ? addslashes(del_html($office_tel)) : '';
	$handphone=isset($handphone) ? addslashes(del_html($handphone)) : '';
	$comment=isset($comment) ? addslashes(del_html($comment)) : '';
	$birth=isset($birth_1) ? mktime(0,0,0,$birth_2,$birth_3,$birth_1) : '';
	if(strpos($homepage,'http://') === false &&$homepage) $homepage=addslashes(del_html("http://$homepage"));
	$reg_date=time();
	$job = isset($job) ? addslashes(del_html($job)) : '';
	$homepage = isset($homepage) ? addslashes(del_html($homepage)) : '';
	$birth = isset($birth) ? addslashes(del_html($birth)) : '';
	$hobby = isset($hobby) ? addslashes(del_html($hobby)) : '';
	$icq = isset($icq) ? addslashes(del_html($icq)) : '';
	$msn = isset($msn) ? addslashes(del_html($msn)) : '';
	
	if(!isset($mailing)) $mailing = empty($mailing) ? '0' : '1';
	$openinfo = empty($openinfo) ? '0' : '1';
	if(!isset($open_email)) $open_email = empty($open_email) ? '0' : '1';
	if(!isset($open_homepage)) $open_homepage = empty($open_homepage) ? '0' : '1';
	if(!isset($open_icq)) $open_icq = empty($open_icq) ? '0' : '1';
	if(!isset($open_msn)) $open_msn = empty($open_msn) ? '0' : '1';
	if(!isset($open_comment)) $open_comment = empty($open_comment) ? '0' : '1';
	if(!isset($open_job)) $open_job = empty($open_job) ? '0' : '1';
	if(!isset($open_hobby)) $open_hobby = empty($open_hobby) ? '0' : '1';
	if(!isset($open_home_address)) $open_home_address = empty($open_home_address) ? '0' : '1';
	if(!isset($open_home_tel)) $open_home_tel = empty($open_home_tel) ? '0' : '1';
	if(!isset($open_office_address)) $open_office_address = empty($open_office_address) ? '0' : '1';
	if(!isset($open_office_tel)) $open_office_tel = empty($open_office_tel) ? '0' : '1';
	if(!isset($open_handphone)) $open_handphone = empty($open_handphone) ? '0' : '1';
	if(!isset($open_birth)) $open_birth = empty($open_birth) ? '0' : '1';
	if(!isset($open_picture)) $open_picture = empty($open_picture) ? '0' : '1';
	if(!isset($picture_name)) $picture_name = "";
	if(!isset($open_aol)) $open_aol = empty($open_aol) ? '0' : '1';

	if(isset($_FILES['picture'])) {
		$picture = $_FILES['picture']['tmp_name'];
		$picture_name = $_FILES['picture']['name'];
		$picture_type = $_FILES['picture']['type'];
		$picture_size = $_FILES['picture']['size'];
	}

	if(!empty($picture_name)) {
		if(!is_uploaded_file($picture)) Error("정상적인 방법으로 업로드 해주세요");
		if(!preg_match("/\.(gif|jpe?g|png)$/i",$picture_name)) Error("사진은 gif, png 또는 jpg 파일을 올려주세요");
		$picture_name_org = md5(uniqid(mt_rand(), true)).".".array_pop(explode(".",$picture_name));
		$path="icon/$picture_name_org";
		if(!@move_uploaded_file($picture,$path)) Error("사진 업로드가 제대로 되지 않았습니다");
		$picture_name=$path;
	}

    $password = get_password($password);
	zb_query("insert into $member_table (level,group_no,user_id,password,name,email,homepage,icq,aol,msn,jumin,comment,job,hobby,home_address,home_tel,office_address,office_tel,handphone,mailing,birth,reg_date,openinfo,open_email,open_homepage,open_icq,open_msn,open_comment,open_job,open_hobby,open_home_address,open_home_tel,open_office_address,open_office_tel,open_handphone,open_birth,open_picture,picture,open_aol) values ('$group_data[join_level]','$group_data[no]','$user_id','$password','$name','$email','$homepage','$icq','$aol','$msn','$jumin','$comment','$job','$hobby','$home_address','$home_tel','$office_address','$office_tel','$handphone','$mailing','$birth','$reg_date','$openinfo','$open_email','$open_homepage','$open_icq','$open_msn','$open_comment','$open_job','$open_hobby','$open_home_address','$open_home_tel','$open_office_address','$open_office_tel','$open_handphone','$open_birth','$open_picture','$picture_name','$open_aol')") or error("회원 데이타 입력시 에러가 발생했습니다<br>".zb_error());
	zb_query("update $group_table set member_num=member_num+1 where no='$group_data[no]'");

	if(!$mode) {
		$member_data=mysql_fetch_array(zb_query("select * from $member_table where user_id='$user_id' and password='$password'"));

		// 4.0x 용 세션 처리
		$zb_logged_no = $member_data['no'];
		$zb_logged_time = time();
		$zb_logged_ip = $REMOTE_ADDR;
		$zb_last_connect_check = '0';
$_SESSION['zb_logged_no']=$zb_logged_no;
	$_SESSION['zb_logged_time']=$zb_logged_time;
	$_SESSION['zb_logged_ip']=$zb_logged_ip;
	$_SESSION['zb_last_connect_check']=0;
	}


	mysql_close($connect);
?>

<script>
	alert("회원가입이 정상적으로 처리 되었습니다\n\n회원이 되신것을 진심으로 축하드립니다.");
	opener.window.history.go(0);
	window.close();
</script>
