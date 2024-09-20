<?php
  $no = isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) ? $_REQUEST['no'] : '';
  $category_no = isset($_REQUEST['category_no']) && is_numeric($_REQUEST['category_no']) ? $_REQUEST['category_no'] : '';
  $page_num = isset($_REQUEST['category_no']) && is_numeric($_REQUEST['category_no']) ? $_REQUEST['category_no'] : '';
  $table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
  $data=mysql_fetch_array(zb_query("select name from $t_category"."_$table_data[name] where no='$category_no'"));
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>

<form name=write method=post action=<?=$_SERVER['PHP_SELF']?> enctype=multipart/form-data onsubmit="return confirm('<?=$data['name']?> 카테고리를 삭제 하시겠습니까?')">
<input type=hidden name=exec value="view_board">
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec2 value="del_category">
<input type=hidden name=page value=<?=$page?>>
   <input type=hidden name=page_num value=<?=$page_num?>>
   <input type=hidden name=no value=<?=$no?>>
   <input type=hidden name=category_no value=<?=$category_no?>>
   <input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
   
  <tr align=center><td bgcolor=bbbbbb colspan=2 height=25 style=font-family:Tahoma;font-size:8pt;></td></tr>
  <tr align=center><td colspan=2 style=line-height:180%; bgcolor=#e0e0e0><br>
  <B style=color:#cc0000><?=$data['name']?> 카테고리를 삭제 하시겠습니까?</b><br><br>
  </td></tr>
  <tr align=center><td colspan=2 bgcolor=#e0e0e0><br><input type=submit value=' 카테고리 삭제 ' style='border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;font-weight:bold;color=#ff5555'> <input type=button value= ' 취소 ' onclick=history.back() style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;><br><br></td></tr>
  </form>
</table>
