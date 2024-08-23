<div align=center>
<br><br><br><br>

<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
  <td colspan=2 height=1 background=<?=$dir?>/images/dot.gif></td>
</tr>

<tr>
  <td colspan=2 height=20></td>
</tr>

<tr><td colspan=2>
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
</td></tr>

<tr height=25>
  <td align=center colspan=2><?=$title?></td>
</tr>

<tr>
  <td height=10 colspan=2></td>
</tr>

<tr>
  <td width=90 align=right class=rini_ver>password&nbsp;&nbsp;</td>
  <td align=left><?=$input_password?></td>
</tr>

<tr>
  <td colspan=2 height=20></td>
</tr>

<tr>
  <td colspan=2 height=1 background=<?=$dir?>/images/dot.gif></td>
</tr>

<tr height=30>
  <td colspan=2 align=center>
  <input type=submit border=0 value="ok~" onfocus=blur() align=absmiddle class=rini_submit>&nbsp;
  <?=$a_list?><input type=button value="back" onfocus=blur() align=absmiddle border=0 onclick=history.go(-1) class=rini_submit></a>
  </td>
</tr>
</table>
<br><br>