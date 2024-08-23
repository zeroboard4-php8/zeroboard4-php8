<?php
  $data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));
  $check_open[$data['is_open']]="checked";
  $check_join[$data['use_join']]="checked";

  // 현재 그룹데이타 뽑아옴;;;
  $temp=zb_query("select no,name from $group_table where no!='$group_no'");
  $group_option='';
  while($temp2=mysql_fetch_array($temp))
  {
   $group_option.="<option value='$temp2[no]'>$temp2[name]</option>";
  }
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_deletegroup.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>

<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return confirm('삭제하시겠습니까?')">
<input type=hidden name=exec value=del_group_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>

  <tr align=center><td bgcolor=bbbbbb colspan=2 height=25 style=font-family:Tahoma;font-size:8pt;>Group Name : <b><?=$data['name']?></b></td></tr>
  <tr align=center><td colspan=2 style=line-height:180%; bgcolor=#e0e0e0><br>
  그룹을 삭제할때는 해당 그룹에 속해있는 회원들과 <br>
  그룹에서 생성한 게시판들에 대해서 이동을 해주어야 합니다.<br>
  신중하게 선택을 하여 주시기 바랍니다.<br><br>
  <B style=color:#cc0000>쏟아진 물은 주워담을수 없습니다 -_-ㆀ</b><br><br>
  </td></tr>

  <tr align=right>
    <td width=47%  style=font-family:Tahoma;font-size:8pt;><br>회원들을 이동시킬 그룹 지정 : &nbsp;</font></td>
    <td align=left><br>&nbsp;<select name=member_move><?=$group_option?></select></td>
  </tr>
  <tr align=right>
    <td style=font-family:Tahoma;font-size:8pt;>게시판을 이동시킬 그룹 지정 : &nbsp;<br><br></td>
    <td align=left>&nbsp;<select name=board_move><?=$group_option?></select><br><br></td>
  </tr>
  <tr align=right>
    <td style=font-family:Tahoma;font-size:8pt;>관리자 비밀번호를 입력해주세요 : &nbsp;</td>
    <td align=left>&nbsp;<input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;"></td>
  </tr>
  <tr align=center><td colspan=2 bgcolor=#e0e0e0><br><input type=submit value=' 그룹 삭제 ' style='border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;font-weight:bold;color=#ff5555'> <input type=button value= ' 취소 ' onclick=history.back() style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;><br><br></td></tr>
  </form>
</table>
