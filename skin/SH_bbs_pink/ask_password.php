<?php include "$dir/value.php3"; ?>
<br><br><br>
<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=300>
<tr>
   <td colspan=2><table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=EAF9E1 bordercolorlight=D2EDC1 bordercolordark=#FFFFFF>
  <tr>
    <td style=font-family:굴림,Tahoma;font-size:8pt;color:gray align=center nowrap><img src=/images/t.gif height=3></td>
  </tr>
</table></td>
</tr>
</table>

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
  <td colspan=2 height=5>&nbsp;&nbsp;</td>
</tr>
<tr height=1><td colspan=2 bgcolor=ffffff><img src=images/t.gif height=1></td></tr>
<tr height=25 bgcolor=ffffff style=padding:5px;>
   <td align=center><?=$title?></td>
</tr>
<tr bgcolor=ffffff>
   <td align=center><?=$input_password?></td></td>
</tr>
<tr height=1><td colspan=2 bgcolor=ffffff><img src=images/t.gif height=1></td></tr>

<tr height=30>
  <td colspan=2 align=right>
     <input type=image align=absmiddle border=0 src=<?=$dir?>/images/btn_confirm.gif></a> <?=$a_view?><img src=<?=$dir?>/images/btn_back.gif align=absmiddle border=0></a>
  </td>
</tr>
</table>
<br><br>
