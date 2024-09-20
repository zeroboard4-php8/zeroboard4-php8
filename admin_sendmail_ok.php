<?php
	include "lib.php";
	$connect=dbConn();

	set_time_limit(0);

	function thisError($message) {
		print("<script>\nalert('$message');\nwindow.close();\n</script>\n");
		exit();
	}

	$member=member_info();
	if(!$member['no']) thisError("로그인후 사용하여주십시오");

	if($member['is_admin']>3||$member['is_admin']<1) thisError("관리자페이지를 사용할수 있는 권한이 없습니다");
	
	$group_no = isset($_POST['group_no']) && is_numeric($_POST['group_no']) ? $_POST['group_no'] : null;
	$cart = isset($_POST['cart']) ? $_POST['cart'] : null;
	$s_que = isset($_POST['s_que']) ? $_POST['s_que'] : null;
	$exec2 = isset($_POST['exec2']) ? $_POST['exec2'] : null;
	$from = isset($_POST['from']) ? $_POST['from'] : null;
	$name = isset($_POST['name']) ? $_POST['name'] : null;
	$html = isset($_POST['html']) && is_numeric($_POST['html']) ? $_POST['html'] : null;
	$subject = isset($_POST['subject']) ? $_POST['subject'] : null;
	$comment = isset($_POST['comment']) ? $_POST['comment'] : null;
	$sendnum = isset($_POST['sendnum']) && is_numeric($_POST['sendnum']) ? $_POST['sendnum'] : null;

	if($s_comment) $comment = $s_comment;
	else $s_comment = $comment;

	if(isblank($from)) thisError("보내는 이의 mail을 적어주십시오");
	if(isblank($name)) thisError("보내시는 분의 이름을 적어주십시오");
	if(isblank($subject)) thisError("제목을 적어주십시오");
	if(isblank($comment)) thisError("내용을 적어주십시오");

	// 페이지 이동 할때 페이지를 구함
	if(!$page) $page = 1; else $page++;
	if(!$fault) $fault = 0;
	if(!$true) $true = 0;
	if(!$nomailing) $nomailing = 0;
	if(!$sendnum) $sendnum = 100;
    $group_no = (int)$group_no;
    $s_que = '';
	if(!$total_member_num) {
		$temp=mysql_fetch_array(zb_query("select count(*) from $member_table where group_no='$group_no'",$connect));
		$total_member_num=$temp[0];
	}

	if(!empty($cart)) {
		$temp = explode("||",$cart);
        for($i=0;$i<count($temp);$i++) $target_srls[] = (int)$temp[$i];
        $s_que = sprintf(' and ( no in (%s) )', "'".implode("','", $target_srls)."'");
	} else {
		// 직접 선택이 없을때
		$s_que=stripslashes($s_que);
	}

	$startnum = ($page-1)*$sendnum;

	if(!$total_member) {
		$temp=mysql_fetch_array(zb_query("select count(*) from $member_table where group_no='$group_no' $s_que",$connect));
		$total_member=$temp[0];
	}

	if(!$totalpage) $totalpage = (int)(($total_member-1)/$sendnum)+1;

	if($total_member==0) thisError("메일을 보낼 회원이 없습니다");

	$result=zb_query("select name, email, mailing from $member_table where group_no='$group_no' $s_que order by no limit $startnum, $sendnum",$connect) or thisError(addslashes(zb_error()));

	mysql_close($connect);  

	head( "onload=window.resizeTo(550,420); bgcolor=white");
?>

<br>
<center><b>메일링 발송</b></center><br>

<table border=0 cellpadding=4 cellspacing=1 width=100% bgcolor=white height=30>
<form action=<?=$_SERVER['PHP_SELF']?> method=post>
<tr>
	<td>
		전체 그룹 회원 수 : <?=number_format($total_member_num)?> 명<br>
		<img src=images/t.gif border=0 height=5><br>
		메일링 발송 대상 회원 수 : <?=number_format($total_member)?> 명<br>
		<img src=images/t.gif border=0 height=5><br>
		메일 발송 단위  : <?=$sendnum?> 명 단위로 잘라서 발송<br>
		<img src=images/t.gif border=0 height=5><br>
		메일 발송 페이지 : <?=$page?> / <?=$totalpage?><br>

<?php
	$fault=0;
	$i=1;
	while($data=mysql_fetch_array($result)) {
		if($data['mailing']) {

			$temp=zb_sendmail($html, $data['email'], $data['name'], $from, $name, $subject, $comment);

			if(!$temp) $fault++;
			else $true ++;

			echo ".";

		} else {

			$nomailing ++;

		}

		flush();

	}
?>

		<img src=images/t.gif border=0 height=5><br>
		메일 발송 결과 : <?=$true?>명 발송 성공 (<?=$nomailing?>명은 메일링 수신 거부)<br>
		<img src=images/t.gif border=0 height=5><br>
		<font color=white>메일 발송 결과 : </font><?=$fault?>명 발송 실패<br>
		<img src=images/t.gif border=0 height=5><br>
		<center>
<?php
	if($page==$totalpage) {
?>
		<input type=button value="메일링 발송 완료하였습니다" onclick=window.close() class=submit style=width:100%>
<?php
	} else {
?>
		<input type=submit value="다음 <?=$sendnum?>명 에게 메일 발송" class=submit style=width:100%>
<?php
	}
?>
		</center>
		<textarea name="s_comment" cols=1 rows=1 style=width:1px;height:1px><?=stripslashes($s_comment)?></textarea>
	</td>
</tr>
<input type=hidden name="from" value="<?=$from?>">
<input type=hidden name="name" value="<?=$name?>">
<input type=hidden name="subject" value="<?=$subject?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="totalpage" value="<?=$totalpage?>">
<input type=hidden name="total_member_num" value="<?=$total_member_num?>">
<input type=hidden name="total_member" value="<?=$total_member?>">
<input type=hidden name="sendnum" value="<?=$sendnum?>">
<input type=hidden name="fault" value="<?=$fault?>">
<input type=hidden name="true" value="<?=$true?>">
<input type=hidden name="cart" value="<?=$cart?>">
<input type=hidden name="html" value="<?=$html?>">
<input type=hidden name="nomailing" value="<?=$nomailing?>">
<input type=hidden name="s_que" value="<?=$s_que?>">
<input type=hidden name="group_no" value="<?=$group_no?>">
</form>
</table>
<?php
	foot();
?>
