<?php
  if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
  $data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));
  $check_open[$data['is_open']]="checked";
  $check_join[$data['use_join']]="checked";
  $check_use_icon[$data['use_icon']]="checked";
?>

<script>
  function check_submit()
  {
   if(!write.name.value)
   {
    alert("그룹이름을 입력하셔야 합니다");
    write.name.focus();
    return false;
   }
   return true;
  }
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<form name=write method=post action=<?=$_SERVER['PHP_SELF']?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=modify_group_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_editgroup.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>

  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <font color=red>*</font> <b>그룹이름</b>&nbsp;&nbsp;</td><td align=left>&nbsp;<input value="<?=isset($data['name'])?$data['name']:''?>" type=text name=name size=20 maxlength=20 class=input style=border-color:#b0b0b0> 그룹이름을 입력하세요</td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <b>그룹 공개</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=is_open <?=isset($check_open[1])?$check_open[1]:''?> checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=is_open <?=isset($check_open[0])?$check_open[0]:''?> value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; 공개그룹이면 Yes, 아니면 No를 선택하요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>회원 가입 허용</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_join <?=isset($check_join[1])?$check_join[1]:''?> value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=use_join <?=isset($check_join[0])?$check_join[0]:''?> value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; 회원가입을 허용할거면 Yes, 아니면 No를 선택하세요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>그룹 아이콘</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;line-height:160%>&nbsp;<input type=file name=icon size=40 class=input style=border-color:#b0b0b0;font-family:Tahoma;font-size:8pt;><br>&nbsp; 일반멤버들의 아이콘을 지정하세요.<br>&nbsp;(Under Width,Height 24pixel JPG or GIF File format)
<br><?php if(!empty($data['icon'])) echo"&nbsp;<b>현재 아이콘이 저장되어 있습니다 (<img src=icon/$data[icon] border=0> <input type=checkbox name=del_icon value=1> 삭제)";?></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>회원 표시 방법</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_icon value=0 <?=isset($check_use_icon[0])?$check_use_icon[0]:''?>></td><td style=font-family:Tahoma;font-size:8pt;> Icon &nbsp&nbsp;</td><td><input type=radio name=use_icon value=1 <?=isset($check_use_icon[1])?$check_use_icon[1]:''?>></td><td style=font-family:Tahoma;font-size:8pt;> Bold Text &nbsp;&nbsp;</td><td><input type=radio name=use_icon value=2 <?=isset($check_use_icon[2])?$check_use_icon[2]:''?>></td><td style=font-family:Tahoma;font-size:8pt;> None division viewing</td></tr><tr><Td colspan=4 height=20>&nbsp;회원표시 방법을 선택하세요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>회원가입후 이동할 페이지</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;line-height:160%><input type=text name=join_return_url size=40 maxlength=255 class=input style=border-color:#b0b0b0 value="<?=isset($data['join_return_url'])?$data['join_return_url']:''?>"><br>&nbsp;게시판이 아닌곳에서의 회원가입, 로그인시 이동할 URL을 입력하세요</td></tr>
<!-- 헤더, 푸터  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>게시판 상하단에 출력한 파일, 내용 지정</td></tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에 불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=header_url value='<?php echo isset($data['header_url'])?$data['header_url']:'';?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에 출력할 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=header cols=70 rows=10 class=textarea style=border-color:b0b0b0><?php echo isset($data['header'])?stripslashes($data['header']):'';?></textarea>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에 불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=footer_url value='<?php echo isset($data['footer_url'])?stripslashes($data['footer_url']):'';?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에 출력할 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=footer cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?php echo isset($data['footer'])?stripslashes($data['footer']):'';?></textarea>
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>관리자 비밀번호 입력&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;">
  </td>
</tr>

  <tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td></tr>

  </form>
</table>
