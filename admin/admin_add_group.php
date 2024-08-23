<script>
function check_submit() {
	if(!write.name.value) {
		alert("그룹이름을 입력하셔야 합니다");
		write.name.focus();
		return false;
	}
return true;
}
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=add_group_ok>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>

  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_addgroup.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <font color=red>*</font> <b>그룹 이름</b>&nbsp;&nbsp;</td><td align=left>&nbsp;<input type=text name=name size=20 maxlength=20 class=input style=border-color:#b0b0b0> 그룹이름을 입력하세요</td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <b>그룹 공개 여부</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=is_open checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=is_open value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; 공개그룹이면 Yes, 아니면 No를 선택하세요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>회원 가입 허용</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_join checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=use_join value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; 회원가입을 허용할거면 Yes, 아니면 No를 선택하세요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>그룹 아이콘</b>&nbsp;&nbsp;</td><td align=left height=60 style=font-family:Tahoma;font-size:8pt;line-height:160%>&nbsp;<input type=file name=icon size=40 class=input style=border-color:#b0b0b0;font-family:Tahoma;font-size:8pt;> &nbsp; <br>&nbsp; 일반멤버들의 아이콘을 지정하세요.<br>&nbsp;(Under Width,Height 24pixel JPG or GIF File format)</td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>회원 표시 방법</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_icon value=0 ></td><td style=font-family:Tahoma;font-size:8pt;> 아이콘 사용 &nbsp&nbsp;</td><td><input type=radio name=use_icon checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> 진한 글자 &nbsp;&nbsp;</td><td><input type=radio name=use_icon value=2></td><td style=font-family:Tahoma;font-size:8pt;> 구분 하지 않음&nbsp; </td><tr><Td colspan=4 height=20>&nbsp;회원표시 방법을 선택하세요</td></tr></table></td></tr>
  <tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>회원가입후 이동할 페이지</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;><input type=text name=join_return_url size=40 maxlength=255 class=input style=border-color:#b0b0b0><br><img src=images/t.gif border=0 height=4><br>&nbsp;게시판이 아닌곳에서의 회원가입, 로그인시 이동할 URL을 입력하세요</td></tr>
<!-- 헤더, 푸터  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>게시판 상, 하단에 출력할 내용Footer</td></tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에 불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=header_url value='<?php if(isset($data)) echo $data['header_url'];?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에 출력될 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=header cols=70 rows=10 class=textarea style=border-color:b0b0b0><?php if(isset($data)) echo stripslashes($data['header']);?></textarea>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에 불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=footer_url value='<?php if(isset($data)) echo stripslashes($data['footer_url']);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에 출력될 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=footer cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?php if(isset($data)) echo stripslashes($data['footer']);?></textarea>
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>관리자 암호를 입력해주세요.&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;">
  </td>
</tr>

  <tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td></tr>
  </form>
</table>
