<div align=center>
<br><br><br><br>

<form>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
  <td colspan=2 height=1 bgcolor=#F3F3F3></td>
</tr>
<tr>
  <td colspan=2 height=26 align=center><font color=E41111 class=rini_ver>Error!!</font></td>
</tr>

<tr>
  <td height=1 bgcolor=#F3F3F3></td>
</tr>

<tr>
  <td height=20></td>
</tr>


<tr>
  <td align=center height=20><?php echo $message;?></td>
</tr>

<tr>
  <td height=20></td>
</tr>

<tr>
  <td height=1 bgcolor=#F3F3F3></td>
</tr>

<tr>
  <td height=30 align=center>
<?php
  if(!$url)
  {
?>
  <input type=button value=' back ' onclick=history.back() border=0 align=absmiddle class=rini_submit>
<?php
  }
  else
  {
?>
   <div align=center><input type=button value=' Move ' onclick=location.href="<?php echo $url;?>" class=rini_submit>
<?php
  }
?>

  </td>
</tr>
</table>
</form>
</div>
<br><br>