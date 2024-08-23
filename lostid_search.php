<?php
	include "lib.php";

	// 웹마스터 E-mail
	$_from = $_zbDefaultSetup['email'];

	// 사이트 주소
	$_homepage = $_zbDefaultSetup['url'];

	// 사이트 이름
	$_sitename = $_zbDefaultSetup['sitename'];

	$connect = dbconn();

 	if(isblank($email)) Error("E-Mail을 입력하여 주세요");
 	if(isblank($jumin1)||!isnum($jumin1)) Error("주민등록번호를 제대로 입력하여 주세요");
	if(isblank($jumin2)||!isnum($jumin2)) Error("주민등록번호를 제대로 입력하여 주세요");
	
	$jumin_enc1 = get_password($jumin1.$jumin2);
	$jumin_enc2 = get_password($jumin1.$jumin2, true);
	$result=zb_query("select * from ".$member_table." where email='$email' and jumin='$jumin_enc1' or jumin='$jumin_enc2'",$connect) or Error(zb_error());

	if(!mysql_num_rows($result)) Error("입력하신 정보에 해당하는 회원이 없습니다.<br><br>다시 한번확인하여 주시기 바랍니다");
 	else {
		$temp=substr(base64_encode(time()),1,10);

		$data=mysql_fetch_array($result);
		
		$temp=get_password($temp);
		zb_query("update $member_table set password='$temp' where no='$data[no]'",$connect) or Error(zb_error());

		$name=stripslashes($data['name']);
		$to=$data['email'];


		$subject="안녕하세요, $_sitename 입니다";

		$comment="안녕하세요.\n"."$_sitename 입니다.\n"."$name 님의 회원 아이디와 새롭게 변경된 비밀번호입니다. \n확인후 곧 바로 $_sitename ($_homepage) 에 로그인 하셔서 비밀번호를 변경하여 주시기 바랍니다.\n\nID : $data[user_id]\nPassword : $temp \n\n * 위의 비밀번호를 타이핑하기 힘들때 마우스로 더블클릭한후 Ctrl-C 를 눌러서 복사한후,\n 비밀번호 입력칸에서 Ctrl-V를 눌러서 복사하세요.";

		if(!zb_sendmail(0, $to, $name, $_from, "", $subject, $comment)) Error("메일 발송 에러");
	}

	mysql_close($connect);
?>
<script>
	alert('변경된 비밀번호가 <?=$email?>로 발송되었습니다.\n\n메일을 확인하신후 곧 바로 로그인하여\n\n비밀번호를 변경하여 주시기 바라겠습니다');
	window.close();
</script>
