<?php
	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));

	if($member['is_admin']>2&&!eregi($no.",",$member['board_name'])) error("사용 권한이 없습니다");

	$board_data=mysql_fetch_array(zb_query("select * from $admin_table where no='$no'")); 
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=10><img src=images/admin_webboard.gif></td></tr>
<Tr height=30><td bgcolor=white colspan=10 align=right style=font-family:Tahoma;font-size:8pt;>
그룹 이름 : <b><?=$group_data['name']?></b> , 게시판 이름 : <a href=zboard.php?id=<?=$board_data['name']?> target=_blank><b><?=$board_data['name']?></a></b> &nbsp;&nbsp;&nbsp;
    <input type=button value='게시판관리' class=input style=width=100px onclick=location.href="<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_no?>&exec2=modify&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">
    <input type=button value='카테고리 관리' class=input style=width=100px onclick=location.href="<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_no?>&exec2=category&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">&nbsp;&nbsp;&nbsp;
</td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=10><img src=images/t.gif height=1></td></tr>
<form method=post action=<?=$PHP_SELF?>>
<input type=hidden name=exec value=<?=$exec?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec2 value=modify_grant_ok>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;width=30%><b>목록 보기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_list class=input >
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_list']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     글 목록 보기 권한을 레벨별로 지정합니다
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>내용 보기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_view  class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_view']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     글의 내용을 읽을수 있는 권한을 레벨별로 지정합니다
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>글쓰기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_write class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_write']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     글쓰기 권한을 레벨별로 지정합니다.
  </td>
</tr>


<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>간단한 답글 쓰기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_comment class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_comment']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     간단한 답글 달기 권한을 레벨별로 지정합니다
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>답변쓰기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_reply class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_reply']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     댓글 달기 권한을 레벨별로 지정합니다.
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>삭제 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_delete class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_delete']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     글 삭제 권한을 레벨별로 지정합니다.
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b> HTML 사용 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_html class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_html']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
     HTML 모두 사용할수 있는 권한을 레벨별로 지정합니다.
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>공지사항 작성 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_notice class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_notice']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
    공지사항 작성 권한을 레벨별로 지정합니다.
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>비밀글 보기 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_view_secret class=input>
<?php
  for($i=1;$i<=10;$i++)
  if($i==$board_data['grant_view_secret']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i</option>";
?>
     </select> &nbsp;&nbsp;
    비밀 글 보기 권한을 레벨별로 지정합니다.
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>Image Box 사용 권한 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <select name=grant_imagebox class=input>
<?php
  if(!$board_data['use_showip']) $board_data['use_showip']=1;
  for($i=1;$i<10;$i++)
  if($i==$board_data['use_showip']) echo"<option value=$i selected>$i</option>";
  else echo"<option value=$i>$i </option>";
?>
     </select> &nbsp;&nbsp;
	Image Box 사용권한을 레벨별로 지정합니다. (회원만 사용가능합니다)
  </td>
<!-- Submit  -->
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;><b>관리자 비밀번호 입력 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;">
  </td>
</tr>

<tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td>
</form>
</tr>
</table>
</div>
