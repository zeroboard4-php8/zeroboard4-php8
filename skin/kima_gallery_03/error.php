<br><br><br>

<form>
<table align=center border=0 cellspacing=0 cellpadding=0 width=250>
<tr><td height=1 class=line></td></tr>
<tr><td height=20></td></tr>

<tr><td align=center><?php echo $message;?></td></tr>

<tr><td height=20></td></tr>
<tr><td height=1 class=line></td></tr>
<tr><td height=10></td></tr>
<tr>
<td align=center>

<?php 
  if(!$url)
  {
?>

  <input type=button value=' back ' onclick=history.go(-1) class=button>

<?php 
  }
  else
  {
?>

  <input type=button value=' back ' onclick=history.go(-1) class=button>

<?php 
  }
?>

</td>
</tr>
</form>
</table>


<br><br><br>