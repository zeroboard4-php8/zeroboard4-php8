<?php
    if(isset($_POST['cart'])) {
	    $data['name'] = "선택된";
    } else {	  
        $data=mysql_fetch_array(zb_query("select * from $member_table where no='$no'"));
    }
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>

<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return confirm('<?=del_html(stripslashes($data['name']))?> 회원을 삭제 하시겠습니까?')">
<input type=hidden name=exec value="view_member">
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec2 value="<?=isset($_POST['cart'])?'deleteall':'del'?>">
<input type=hidden name=page value=<?=$page?>>
   <input type=hidden name=href value=<?=isset($href)?$href:''?>>
<?php
  if(isset($_POST['cart'])) {
	  foreach ($_POST['cart'] as $value) {
		  echo "   <input type=hidden name=cart[] value=$value>\r\n";
	  }
  } else {
	  echo "   <input type=hidden name=no value=$no>\r\n";
  }
?>
   <input type=hidden name=keyword value=<?=$keyword?>>
   <input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
   
  <tr align=center><td bgcolor=bbbbbb colspan=2 height=25 style=font-family:Tahoma;font-size:8pt;></td></tr>
  <tr align=center><td colspan=2 style=line-height:180%; bgcolor=#e0e0e0><br>
  <B style=color:#cc0000><?=del_html(stripslashes($data['name']))?> 회원을 삭제 하시겠습니까?</b><br><br>
  </td></tr>

  <tr align=right>
    <td style=font-family:Tahoma;font-size:8pt;>관리자 비밀번호를 입력해주세요 : &nbsp;</td>
    <td align=left>&nbsp;<input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;"></td>
  </tr>
  <tr align=center><td colspan=2 bgcolor=#e0e0e0><br><input type=submit value=' 회원 삭제 ' style='border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;font-weight:bold;color=#ff5555'> <input type=button value= ' 취소 ' onclick=history.back() style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;><br><br></td></tr>
  </form>
</table>
