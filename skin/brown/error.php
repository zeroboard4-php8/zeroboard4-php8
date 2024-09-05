<form>
<table width=300 cellpadding=0 cellspacing=0 align=center>
	<tr>
	  <td><img src="<?=$dir?>/t_img.gif" border="0"></td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/s_top_bg.gif><img src=<?=$dir?>/s_top_bg.gif border=0></td>
	</tr>
</table>
<table width=300 cellpadding=0 cellspacing=0 align=center>
	<tr>
		<td align=center colspan=2 style="padding:25 15 15 15;"><?php echo $message;?></td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/s_bottom_bg.gif><img src=<?=$dir?>/s_bottom_bg.gif border=0></td>
	</tr>
	<tr>
		<td height=10></td>
	</tr>
	<tr colspan=2>
		<td align=right colspan=2>
		<?php 
		  if(!$url)
		  {
		?>
		<a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/cancel.gif border=0></a>
		<?php 
		  }
		  else
		  {
		?>
		<a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><img src=<?=$dir?>/cancel.gif border=0></a>
		<?php 
		  }
		?></td>
	</tr>
</form>
</table>
<br>
<div align="right">