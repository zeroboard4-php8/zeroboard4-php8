<?php include "$dir/value.php3"; ?>

<table><td height=30></td></table>
<div align=center>
<table border=0 cellpadding=0 cellspacing=0 width=250>
<tr>
  <td width=1 bgcolor='<?=$head_border?>'><img width=1 height=13></td>
  <td background=<?=$dir?>/images/head_bg.gif><img width=1 height=13></td>
  <td width=1 bgcolor='<?=$head_border?>'><img width=1 height=13></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=250>
<form>
<tr>
<td align=center height=50>
<?php echo $message;?></td>
</tr>
<tr><td height=1 bgcolor='<?=$all_foot_line?>'></td></tr>
<tr><td height=5></td></tr>
<tr>
<td align=right>
<?php
  if(!$url)
  {
?>
<a href=javascript:history.go(-1)><img src=<?=$dir?>/images/i_back.gif border=0 width=60 height=15></a>
<?php
  }
  else
  {
?>
<a href="<?php echo $url;?>"><img src=<?=$dir?>/images/i_confirm.gif border=0 width=60 height=15></a>
<?php
  }
?>
</td>
</tr>
</form>
</table>
</div>