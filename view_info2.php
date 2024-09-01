<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 글쓴이의 정보를 갖고옴;;
	$data=mysql_fetch_array(zb_query("select * from $member_table where no='$member_no'"));
	$data['name'] = isset($data['name']) ? stripslashes($data['name']) : '';
	$data['job'] = isset($data['job']) ? stripslashes($data['job']) : '';
	$data['email'] = isset($data['email']) ? stripslashes($data['email']) : '';
	$data['homepage'] = isset($data['homepage']) ? stripslashes($data['homepage']) : '';
	$data['birth'] = isset($data['birth']) ? stripslashes($data['birth']) : '';
	$data['hobby'] = isset($data['hobby']) ? stripslashes($data['hobby']) : '';
	$data['icq'] = isset($data['icq']) ? stripslashes($data['icq']) : '';
	$data['msn'] = isset($data['msn']) ? stripslashes($data['msn']) : '';
	$data['home_address'] = isset($data['home_address']) ? stripslashes($data['home_address']) : '';
	$data['home_tel'] = isset($data['home_tel']) ? stripslashes($data['home_tel']) : '';
	$data['office_address'] = isset($data['office_address']) ? stripslashes($data['office_address']) : '';
	$data['office_tel'] = isset($data['office_tel']) ? stripslashes($data['office_tel']) : '';
	$data['handphone'] = isset($data['handphone']) ? stripslashes($data['handphone']) : '';
	$data['comment'] = isset($data['comment']) ? stripslashes($data['comment']) : '';

	$temp_name = get_private_icon($data['no'], "2");
	$i_name='';
	if($temp_name) $i_name="<img src='$temp_name' border=0 align=absmiddle>";
	$temp_name = get_private_icon($data['no'], "1");
	if($temp_name) $i_name="<img src='$temp_name' border=0 align=absmiddle>&nbsp;".$i_name;
	$i_name="&nbsp;".$i_name."&nbsp;";

// $data 가 없을때, 즉 탈퇴한 회원인경우 표시
	if(!$data['no']) Error("탈퇴한 회원입니다", "window.close");

// 멤버정보 구하기
	$member=member_info();

// 그룹데이타 읽어오기;;
	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$data[group_no]'"));

	mysql_close($connect);

	head("bgcolor=white","script_memo.php");
?>

<?php
if($data['no']&&($data['openinfo']||$member['is_admin']==1)) {
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_topleft.gif" width="15" height="50"></td>
    <td background="images/memo_topbg.gif">&nbsp;</td>
    <td width="15"><img src="images/vi_topright.gif" height="50"></td>
  </tr>
</table>
<?php if($member['no']) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
 <td>&nbsp;&nbsp;&nbsp;<a href=view_info.php?member_no=<?=$member_no?>><img src=images/vi_B_sendmessage.gif border=0></a></td>
  </tr>
</table>
<?php }?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_listtopleft.gif" width="17" height="17"></td>
    <td background="images/memo_listtop.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listtopright.gif" width="17" height="17"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17" background="images/memo_listleftbg.gif"><img src="images/t.gif" width="17" height="10"></td>
    <td>

<table border=0 cellspacing=0 cellpadding=0 width=100%>

<?php if($data['open_picture']&&$data['picture']) { ?>
  <tr><td align=right valign=top><img src=images/t.gif height=1><br><img src=images/vi_photo.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left>&nbsp;<img src="<?=$data['picture']?>" border=0></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr> 
<?php } ?>


  <tr>
     <td width=25% align=right><img src=images/memo_id.gif align=absmiddle>&nbsp;&nbsp;</td>
     <td align=left><img src="images/t.gif" width="10" height="3"><br><b><?=del_html($data['user_id'])?></b></td>
  </tr>        
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
  <tr>
     <td align=right><img src=images/memo_level.gif align=absmiddle>&nbsp;&nbsp;</td>
     <td align=left><img src="images/t.gif" width="10" height="3"><br><?php if($data['is_admin']==1) echo "Super Administrator "; elseif($data['is_admin']==2) echo"Group Administrator "; else echo "Normal Member "; ?> (<?=$data['level']?>)
     </td>
  </tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
  <tr>
     <td align=right><img src=images/memo_name.gif align=absmiddle>&nbsp;&nbsp;</td>
     <td align=left><img src="images/t.gif" width="10" height="3"><br><?=del_html($data['name'])?> <?=$i_name?></td>
  </tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>

<?php if($data['open_birth']&&$data['birth']) { ?>
  <tr><td align=right><img src=images/vi_birthday.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=date("Y년 m월 d일",$data['birth'])?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_homepage']&&$data['homepage']) { ?>
  <tr><td align=right><img src=images/vi_homepage.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><a href=<?=$data['homepage']?> target=_blank><?=$data['homepage']?></a></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_icq']&&$data['icq']) {?>
  <tr><td align=right><img src=images/vi_icq.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['icq']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_aol']&&$data['aol']) {?>
  <tr><td align=right><img src=images/vi_aim.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['aol']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_msn']&&$data['msn']) {?>
  <tr><td align=right><img src=images/vi_msn.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['msn']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_hobby']&&$data['hobby']) {?>
  <tr><td align=right><img src=images/vi_hobby.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['hobby']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['job']&&$data['open_job']) {?>
  <tr><td align=right><img src=images/vi_job.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['job']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['home_address']||$data['home_tel']){ ?>
  <tr height=18><td>&nbsp;</td><td><img src=images/vi_home.gif align=absmiddle>&nbsp;&nbsp;</td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['home_address']&&$data['open_home_address']) {?>
  <tr><td align=right valign=top><img src=images/t.gif height=1><br><img src=images/vi_address.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['home_address']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['home_tel']&&$data['open_home_tel']) {?>
  <tr><td align=right><img src=images/vi_phone.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['home_tel']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['office_address']||$data['office_tel']){ ?>
  <tr height=18><td>&nbsp;</td><td><img src=images/vi_office.gif align=absmiddle>&nbsp;&nbsp;</td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_office_address']&&$data['office_address']) {?>
  <tr><td align=right valign=top><img src=images/t.gif height=1><br><img src=images/vi_address.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['office_address']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_office_tel']&&$data['office_tel']) {?>
  <tr><td align=right><img src=images/vi_phone.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['office_tel']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_handphone']&&$data['handphone']) {?>
  <tr><td align=right><img src=images/vi_cellular.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=$data['handphone']?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<?php if($data['open_comment']&&$data['comment']) {?>
  <tr><td align=right><img src=images/vi_comment.gif align=absmiddle>&nbsp;&nbsp;</td><td align=left><img src="images/t.gif" width="10" height="3"><br><?=nl2br(del_html($data['comment']))?></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<?php } ?>

<tr>
   <td align=right><img src=images/vi_point.gif align=absmiddle>&nbsp;&nbsp;</td>
   <td align=left><img src="images/t.gif" width="10" height="3"><br><?=($data["point1"]*10+$data["point2"])?> 점 ( 작성글수 : <?=$data["point1"]?>, 코멘트 : <?=$data["point2"]?> )</td>
</tr>
</table>
    </td>
    <td width="17" background="images/memo_listrightbg.gif"><img src="images/t.gif" width="17" height="10"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_listbottomleft.gif" width="17" height="17"></td>
    <td background="images/memo_listbottom.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listbottomright.gif" width="17" height="17"></td>
  </tr>
</table>
<table border=0 width=98%>
<tr><td align=right><a href=JavaScript:window.close()><img src="images/memo_close.gif" width="69" height="25" border="0"></a></tD></tr>
</table>

<?php
 } else Error("정보가 공개되어 있지 않습니다", "window.close");
?>

<?php
	foot();
?>
