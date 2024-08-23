<br><br><br>
<div align=center>
<table border=0 width=300 cellpadding=0 cellspacing=0>
<form method=post name=delete action=<?=$target?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"><font color=#333333 class=t7_4a4d4a>Enter</font> <span style=font-size:15px;letter-spacing:-1px;>Password</span></span></td>
</tr>
<tr>
 <td colspan=8 bgcolor=4A4D4A  height=1></td>
</tr>
<tr><td height=2></td></tr>
<tr>
 <td colspan=8 bgcolor=cccccc height=2></td>
</tr>
<tr height=25 style=padding:5px;>
   <td align=center><?=$title?></td>
</tr>
<tr>
   <td align=center><?=isset($input_password)?$input_password:''?><br><br></td>
</tr>
<tr>
 <td colspan=8 bgcolor=cccccc height=2></td>
</tr>
<tr><td height=2></td></tr>
<tr>
 <td colspan=8 bgcolor=4A4D4A  height=1></td>
</tr>
<tr height=30>
  <td colspan=2 align=right>
     <input type=image align=absmiddle border=0 src=<?=$dir?>/image/btn_confirm.gif> <?=$a_list?><img src=<?=$dir?>/image/btn_list.gif border=0 align=absmiddle></a> <?=$a_view?><img src=<?=$dir?>/image/btn_back.gif align=absmiddle border=0></a>
  </td>
</tr>
</table>

