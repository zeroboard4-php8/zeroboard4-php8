<form>
<br><br>
<table width=200 border=0 cellpadding=0 cellspacing=0>
<td align=center><img src=<?=$dir?>/ruvin_fine.gif border=0 height=33></td></tr>
<tr><td height=3></td></tr>
<tr height=2><td colspan=6 background=<?=$dir?>/line_dot.gif height=2></td></tr>
<tr><td height=15></td></tr>
<tr><td align=center>
<?php echo $message;?>
<?php 
  if(!$url)
  {
?>
<tr><td height=15></td></tr>
<tr height=2><td colspan=6 background=<?=$dir?>/line_dot.gif height=2></td></tr>
<tr><td height=5></td></tr>

<tr height=30>
<td align=center><img src=<?=$dir?>/back.gif border=0 onclick=history.back() style=cursor:hand onfocus=blur()></td></tr>
<?php 
  }
  else
  {
?>
<div align=center><img src=<?=$dir?>/back.gif border=0  style=cursor:hand onclick=location.href="<?php echo $url;?>" >
<?php 
  }
?>
<br><br>
</td></tr>
</form>
</table>
</div>
<br><br>