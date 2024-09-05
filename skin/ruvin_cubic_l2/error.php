<form>
<br><br>

<table width=250 border=0 cellpadding=0 cellspacing=0>
<tr>
<td colspan=10 class=line1 height=1></td>
</tr>
<tr>
<td colspan=10 class=line2 height=1></td>
</tr>

<tr>
<td height=15></td>
</tr>

<tr>
<td align=center><span class=cu><?php echo $message;?></span>
<br><br>

<?php 
  if(!$url)
  {
?>
  <center><input type=button value=" Back " onclick=history.go(-1) class=submit onfocus='this.blur()' style=cursor:hand>
<?php 
  }
  else
  {
?>
  <div align=center><input type=button value=" Back " onclick=location.href="<?php echo $url;?>"  class=submit onfocus='this.blur()' style=cursor:hand>
<?php 
  }
?>
<br><br>
</td>
</tr>

<tr>
<td colspan=10 class=line1 height=1></td>
</tr>
<tr>
<td colspan=10 class=line2 height=1></td>
</tr>
</form>
</table>
<br><br>