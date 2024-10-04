<?php
	include "lib.php";
	include "include/list_check.php";

	if(!eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])) Error("정상적으로 글을 작성하여 주시기 바랍니다.","window.close");
	if(!eregi("write.php",$_SERVER['HTTP_REFERER'])) Error("정상적으로 글을 쓰시기 바랍니다","window.close");
	if($_SERVER['REQUEST_METHOD'] == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","window.close");

	$subject = isset($_POST['subject']) ? str_replace('ㅤ','',$_POST['subject']) : null;
	$memo = isset($_POST['memo']) ? str_replace('ㅤ','',$_POST['memo']) : null;
	$use_html = isset($_POST['use_html']) && in_array($_POST['use_html'], array('0','1')) ? $_POST['use_html'] : '0';

	if(!isset($subject)) Error("제목을 입력하여 주십시요","window.close");
	if(!isset($memo)) Error("내용을 입력하여 주십시요","window.close");
	

	$connect=dbconn();

// 게시판 설정 읽어 오기
	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
	$setup=get_table_attrib($id);

// 설정되지 않은 게시판
	if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","window.close()"); 

// 현재 게시판의 그룹의 설정 읽어 오기
	$group=group_info($setup['group_no']);

// 회원 데이타 읽어 오기
	$member = member_info();

// 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
	$member['is_admin']=isset($member['is_admin']) ? $member['is_admin'] : null;
	if($member['is_admin']==1||($member['is_admin']==2&&$member['group_no']==$setup['group_no'])||check_board_master($member, $setup['no'])) $is_admin=1; else $is_admin='';


// 가상의 게시물 데이타 제작

	if(isset($use_html) && $use_html<2) {
		$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
		$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
	}


	// 내용 제작
 	if(!$is_admin&&$setup['grant_html']<$member['level']) {

		// 내용의 HTML 금지;;
		if($use_html!=1||$setup['use_html']==0) $memo=del_html($memo);

		// HTML의 부분허용일때;;
		if($use_html==1&&$setup['use_html']==1) {
			$memo=str_replace("<","&lt;",$memo);
			$tag=explode(",",$setup['avoid_tag']);
			for($i=0;$i<count($tag);$i++) {
				if(!isblank($tag[$i])) {
					$memo=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo);
					$memo=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo);
					$memo=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo);
				}
			}
		}
	} else {
		if(!isset($use_html)) {
			$memo=del_html($memo);
		}
	}

	$data['memo']=$memo;

	// 제목 제작
	if(($is_admin||$member['level']<=$setup['use_html'])&&isset($use_html)) $data['subject']=$subject;
	else $data['subject']=del_html($subject);

	// 기타 데이타 작성
	$data['use_html']=isset($use_html) ? $use_html : null;
	$data['ismember']=isset($member['no']) ? $member['no'] : null;

// 데이타 가공
	list_check($data,1);
?>
<html>
<head>
	<title><?=$setup['title']?></title>
	<meta http-equiv=Content-Type content=text/html; charset=utf-8>
	<link rel=StyleSheet HREF=skin/<?=$setup['skinname']?>/style.css type=text/css title=style>
</head>
<body topmargin='10'  leftmargin='10' marginwidth='10' marginheight='10' <?php
	if($setup['bg_color']) echo " bgcolor=".$setup['bg_color'];
	if($setup['bg_image']) echo " background=".$setup['bg_image'];?>>

<table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor=white>
<tr>
	<td align=left><img src=images/pv_title_left.gif border=0></td>
	<td width=100% background=images/pv_title_back.gif><img src=images/pv_title_back.gif></td>
	<td align=right><img src=images/pv_title_right.gif border=0></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=10 width=100% height=100% bgcolor=black>
<Tr bgcolor=white valign=top>
	<td height=20>
		<b><?=$data['subject']?></b><br>
	</td>
</tr>
<Tr bgcolor=white valign=top>
	<td>
		<?=$memo?>
	</td>
</tr>
</table>

</body>
</html>

<?php
	mysql_close($connect);
?>
