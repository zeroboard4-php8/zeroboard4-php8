<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

	if($_SERVER['REQUEST_METHOD'] == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 멤버 정보 구해오기;;; 멤버가 있을때
	$member=member_info();
	if(!$member['no']) Error("회원정보가 존재하지 않습니다");
	$group=group_info($member['group_no']);
	
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$password1 = isset($_POST['password1']) ? $_POST['password1'] : null;
	$name = isset($_POST['name']) ? $_POST['name'] : null;
	$birth_1 = isset($_POST['birth_1']) && is_numeric($_POST['birth_1']) ? $_POST['birth_1'] : null;
	$birth_2 = isset($_POST['birth_2']) && is_numeric($_POST['birth_2']) ? $_POST['birth_2'] : null;
	$birth_3 = isset($_POST['birth_3']) && is_numeric($_POST['birth_3']) ? $_POST['birth_3'] : null;
	$open_birth = isset($_POST['open_birth']) && in_array($_POST['open_birth'], array('0','1')) ? $_POST['open_birth'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$open_email = isset($_POST['open_email']) && in_array($_POST['open_email'], array('0','1')) ? $_POST['open_email'] : null;
	$homepage = isset($_POST['homepage']) ? $_POST['homepage'] : null;
	$open_homepage = isset($_POST['open_homepage']) && in_array($_POST['open_homepage'], array('0','1')) ? $_POST['open_homepage'] : null;
	$icq = isset($_POST['icq']) ? $_POST['icq'] : null;
	$open_icq = isset($_POST['open_icq']) && in_array($_POST['open_icq'], array('0','1')) ? $_POST['open_icq'] : null;
	$aol = isset($_POST['aol']) ? $_POST['aol'] : null;
	$open_aol = isset($_POST['open_aol']) && in_array($_POST['open_aol'], array('0','1')) ? $_POST['open_aol'] : null;
	$msn = isset($_POST['msn']) ? $_POST['msn'] : null;
	$open_msn = isset($_POST['open_msn']) && in_array($_POST['open_msn'], array('0','1')) ? $_POST['open_msn'] : null;
	$jumin1 = isset($_POST['jumin1']) && is_numeric($_POST['jumin1']) ? $_POST['jumin1'] : null;
	$jumin2 = isset($_POST['jumin2']) && is_numeric($_POST['jumin2']) ? $_POST['jumin2'] : null;
	$hobby = isset($_POST['hobby']) ? $_POST['hobby'] : null;
	$open_hobby = isset($_POST['open_hobby']) && in_array($_POST['open_hobby'], array('0','1')) ? $_POST['open_hobby'] : null;
	$job = isset($_POST['job']) ? $_POST['job'] : null;
	$open_job = isset($_POST['open_job']) && in_array($_POST['open_job'], array('0','1')) ? $_POST['open_job'] : null;
	$home_address = isset($_POST['home_address']) ? $_POST['home_address'] : null;
	$open_home_address = isset($_POST['open_home_address']) && in_array($_POST['open_home_address'], array('0','1')) ? $_POST['open_home_address'] : null;
	$home_tel = isset($_POST['home_tel']) ? $_POST['home_tel'] : null;
	$open_home_tel = isset($_POST['open_home_tel']) && in_array($_POST['open_home_tel'], array('0','1')) ? $_POST['open_home_tel'] : null;
	$office_address = isset($_POST['office_address']) ? $_POST['office_address'] : null;
	$open_office_address = isset($_POST['open_office_address']) && in_array($_POST['open_office_address'], array('0','1')) ? $_POST['open_office_address'] : null;
	$office_tel = isset($_POST['office_tel']) ? $_POST['office_tel'] : null;
	$open_office_tel = isset($_POST['open_office_tel']) && in_array($_POST['open_office_tel'], array('0','1')) ? $_POST['open_office_tel'] : null;
	$handphone = isset($_POST['handphone']) ? $_POST['handphone'] : null;
	$open_handphone = isset($_POST['open_handphone']) && in_array($_POST['open_handphone'], array('0','1')) ? $_POST['open_handphone'] : null;	
	$mailing = isset($_POST['mailing']) && in_array($_POST['mailing'], array('0','1')) ? $_POST['mailing'] : null;	
	$open_picture = isset($_POST['open_picture']) && in_array($_POST['open_picture'], array('0','1')) ? $_POST['open_picture'] : null;	
	$comment = isset($_POST['comment']) ? $_POST['comment'] : null;
	$open_comment = isset($_POST['open_comment']) && in_array($_POST['open_comment'], array('0','1')) ? $_POST['open_comment'] : null;
	$openinfo = isset($_POST['openinfo']) && in_array($_POST['openinfo'], array('0','1')) ? $_POST['openinfo'] : null;			

	$name = str_replace('ㅤ','',$name);

	if(isblank($name)) Error("이름을 입력하셔야 합니다");
	if(preg_match("/(<|>)/",$name)) Error("이름에는 태그를 사용하실수 없습니다.");
	if($password&&$password1&&$password!=$password1) Error("비밀번호가 일치하지 않습니다");
	$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);

	$check=mysql_fetch_array(zb_query("select count(*) from $member_table where email='$email' and no <> ".$member['no'],$connect));
	if($check[0]>0) Error("이미 등록되어 있는 E-Mail입니다");


	$name = isset($name) ? addslashes(del_html($name)) : '';
	$job = isset($job) ? addslashes(del_html($job)) : '';
	$email = isset($email) ? addslashes(del_html($email)) : '';
	if($_zbDefaultSetup['check_email']=="true"&&!mail_mx_check($email)) Error("입력하신 $email 은 존재하지 않는 메일주소입니다.<br>다시 한번 확인하여 주시기 바랍니다.");
	if(strpos($homepage,'http') === false &&$homepage) $homepage="http://$homepage";
	$homepage = isset($homepage) ? addslashes(del_html($homepage)) : '';
	$birth = isset($birth) ? addslashes(del_html($birth)) : '';
	$hobby = isset($hobby) ? addslashes(del_html($hobby)) : '';
	$icq = isset($icq) ? addslashes(del_html($icq)) : '';
	$aol = isset($aol) ? addslashes(del_html($aol)) : '';
	$msn = isset($msn) ? addslashes(del_html($msn)) : '';
	$home_address = isset($home_address) ? addslashes(del_html($home_address)) : '';
	$home_tel = isset($home_tel) ? addslashes(del_html($home_tel)) : '';
	$office_address = isset($office_address) ? addslashes(del_html($office_address)) : '';
	$office_tel = isset($office_tel) ? addslashes(del_html($office_tel)) : '';
	$handphone = isset($handphone) ? addslashes(del_html($handphone)) : '';
	$comment = isset($comment) ? addslashes(del_html($comment)) : '';

	$que="update $member_table set name='$name'";
	if($password&&$password1&&$password==$password) $que.=" ,password='".get_password($password)."' ";
	if(isset($birth_1)&&isset($birth_2)&&isset($birth_3)&&isset($group['use_birth'])) $que.=",birth='$birth'";
	if($email) $que.=",email='$email'";
	$que.=",homepage='$homepage'";
	if(isset($group['use_job'])) $que.=",job='$job'";
	if(isset($group['use_hobby'])) $que.=",hobby='$hobby'";
	if(isset($group['use_icq'])) $que.=",icq='$icq'";
	if(isset($group['use_aol'])) $que.=",aol='$aol'";
	if(isset($group['use_msn'])) $que.=",msn='$msn'";
	if(isset($group['use_home_address'])) $que.=",home_address='$home_address'";
	if(isset($group['use_home_tel'])) $que.=",home_tel='$home_tel'";
	if(isset($group['use_office_address'])) $que.=",office_address='$office_address'";
	if(isset($group['use_office_tel'])) $que.=",office_tel='$office_tel'";
	if(isset($group['use_handphone'])) $que.=",handphone='$handphone'";
	if(isset($group['use_mailing'])) $que.=empty($mailing) ? ",mailing='0'" : ",mailing='1'";
	$que.=empty($openinfo) ? ",openinfo='0'" : ",openinfo='1'";
	if(isset($group['use_comment'])) $que.=",comment='$comment'";
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
	if(!isset($open_aol)) $open_aol = empty($open_aol) ? '0' : '1';
	$que.=",openinfo='$openinfo',open_email='$open_email',open_homepage='$open_homepage',open_icq='$open_icq',open_msn='$open_msn',open_comment='$open_comment',open_job='$open_job',open_hobby='$open_hobby',open_home_address='$open_home_address',open_home_tel='$open_home_tel',open_office_address='$open_office_address',open_office_tel='$open_office_tel',open_handphone='$open_handphone',open_birth='$open_birth',open_picture='$open_picture',open_aol='$open_aol' ";
	$que.=" where no='$member[no]'";

	zb_query($que) or Error("회원정보 수정시에 에러가 발생하였습니다 ".zb_error());

	if(isset($del_picture)) {
		z_unlink($member['picture']);
		zb_query("update $member_table set picture='' where no='$member[no]'") or Error("사진 자료 업로드시 에러가 발생하였습니다");
	}

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
		if(!move_uploaded_file($picture,$path)) Error("사진 업로드가 제대로 되지 않았습니다");
		@z_unlink($member['picture']);
		zb_query("update $member_table set picture='$path' where no='$member[no]'") or Error("사진 자료 업로드시 에러가 발생하였습니다");
	}

	mysql_close($connect);
?>
<script>
alert("회원님의 정보 수정이 제대로 처리되었습니다.");
opener.window.history.go(0);
window.close();
</script>
