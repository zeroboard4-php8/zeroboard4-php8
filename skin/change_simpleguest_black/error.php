<?php include "$dir/value.php3";?>

<br>
<br>
<br>
<div align=center>
<form>
<table border=0 cellpadding=0 cellspacing=0 width=250>

<tr>
<td align=center colspan=2 bgcolor=<?=$line_color?>></td>
</tr>

<tr>
<td bgcolor=<?=$bg_color?> align=center height=20><b>Message</b></td>
</tr>

<tr>
<td align=center height=50>

<?php echo $message;?>

<?php 
  if(!$url)
  {
?>

  <center><input type=button value="   Back   " onclick=history.back() class=submit>

<?php 
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class=submit>

<?php 
  }
?>
 

</td>
</tr>

<tr>
<td align=center colspan=2 bgcolor=<?=$line_color?>></td>
</tr>

</form>
</table>
</div>
<br>