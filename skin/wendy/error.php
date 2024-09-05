<br>
<br>
<div align=center>
<form>
<table align="center" cellpadding="10" cellspacing="0" width="250">
<tr><td width="250" colspan="2" align=center><?php echo $message;?></td>
</table>

<table align="center" cellpadding="0" cellspacing="0" width="250">
<tr>
<td width="125">
</td>
<td width="125"><p align="center">
<?php 
  if(!$url)
  {
?>

  <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/back_l.gif border=0>

<?php 
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class="submit">

<?php 
  }
?>
</p></td></tr>
</table>

</td>
</tr>
</table>
</form>
</div>
