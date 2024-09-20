<?php
// 라이브러리 함수 파일 인크루드
require "lib.php";


// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 멤버정보 구하기
	$member=member_info();

	if(!$member['no']) Error("가입되어 있는 회원만 쪽지 보내기가 가능합니다","window.close");
	
	$member_no = isset($_REQUEST['member_no']) && is_numeric($_REQUEST['member_no']) ? $_REQUEST['member_no'] : null;

	$data=mysql_fetch_array(zb_query("select * from $member_table where no='$member_no'"));

	$data['name']=del_html($data['name']);

	$temp_name = get_private_icon($data['no'], "2");
	if($temp_name) $data['name']="<img src='$temp_name' border=0 align=absmiddle>";
	$temp_name = get_private_icon($data['no'], "1");
	if($temp_name) $data['name']="<img src='$temp_name' border=0 align=absmiddle>&nbsp;".$data['name'];
	$data['name']="&nbsp;".$data['name']."&nbsp;";

// 그룹데이타 읽어오기;;
	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$data[group_no]'"));

	mysql_close($connect);
	$query_time=getmicrotime();

	head("bgcolor=white","script_memo.php");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_topleft.gif" width="15" height="50"></td>
    <td background="images/memo_topbg.gif">&nbsp;
    </td>
    <td width="15"><img src="images/sm_topright.gif" height="50"></td>
  </tr>
</table>
<?php
	if($member_no>0&&$member['no']>0) {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
 <td>&nbsp;&nbsp;&nbsp;
<?php
	if($data['openinfo']||$member['is_admin']==1) {
?>
	<a href=view_info2.php?member_no=<?=$member_no?>><img src=images/vi_B_userinfo.gif border=0></a>
<?php
	} else { 
?>
 <img src=images/vi_B_userinfo.gif border=0 onclick="alert('개인정보를 공개하지 않았습니다')">

<?php }?>

 </td>
  </tr>
</table>
<?php
 }
?>

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
<table border=0 width=100% cellspacing=0 cellpadding=3>
<form method=post action=send_message.php name=write>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=member_no value="<?=$member_no?>">
<input type=hidden name=kind value=1>
<?php
	if($member['no']&&$data['no']) {
?>
<tr>
  <td align=right><img src=images/memo_id.gif></td>
  <td valign=bottom>&nbsp;<font color=brown><b><?=del_html($data['user_id'])?> (<?=$data['name']?>)</td>
</tr>
<?php
 } else {
?>

<input type=hidden name=kind value=0>

<?php
	if($data['no']) {
?>

<tr>
  <td align=right><img src=images/memo_id.gif></td>
  <td valign=bottom>&nbsp;<font color=brown><b><?=$data['user_id']?> (<?=$data['name']?>)</td>
</tr>
<?php } ?>


<tr>
  <td align=right><img src=images/sm_from.gif></td>
  <td>&nbsp;<input type=text name=from size=20 maxlength=20 class=input style=border-color:#d8b3b3></td>
</tr>
<tr>
  <Td align=right><img src=images/vi_email.gif></td>
  <td>&nbsp;<input type=text name=email size=40 maxlength=80 class=input style=border-color:#d8b3b3></td>
</tr>
<?php
 }
?>
<tr>
  <td width=50 align=right><img src=images/vi_subject.gif></td> 
  <td>&nbsp;<input type=text style=width:80% name=subject class=input style=border-color:#d8b3b3> <input type=hidden name=html value=0></td>
</tr>
<tr>
  <td colspan=2 align=center><textarea name=memo class=textarea rows=21 style=width:100%;border-color:#d8b3b3></textarea></td>
</tr>
<tr>
  <td align=right colspan=2><input type=image border=0 src=images/sm_send.gif accesskey="s"> <a href=JavaScript:window.close()><img src="images/memo_close.gif" width="69" height="25" border="0"></a></td>
</tr>
</form>
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

<?php
	foot();
?>
