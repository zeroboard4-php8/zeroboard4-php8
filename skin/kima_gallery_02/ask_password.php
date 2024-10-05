<div align=center>
<br><br><br><br>

<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
  <td colspan=2 height=1 class=line></td>
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
  <td width=90 align=right class=ver7>password&nbsp;&nbsp;</td>
  <td align=left><input type=password name=password style="width:100;height:18;" class=input2></td>
</tr>

<tr>
  <td colspan=2 height=20></td>
</tr>

<tr>
  <td colspan=2 height=1 class=line></td>
</tr>

<tr height=30>
  <td colspan=2 align=center>
<input onfocus='this.blur()' type=submit value=' submit ' align=center class=button>
  <input onfocus='this.blur()' type=button value=' back ' align=center class=button onclick="history.go(-1)">
  </td>
</tr>
</table>
<br><br>