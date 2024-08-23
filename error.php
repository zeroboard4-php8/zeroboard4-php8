<br>
<br>
<br>
<div align=center>
<form>
<table border=0 cellpadding=3 cellspacing=1 width=300 bgcolor=8d8d8d>
<tr bgcolor=bbbbbb>
	<td align=center height=30  style="font-family:Tahoma;font-size:8pt;"><b>Message</font></td>
</tr>
<tr bgcolor=d3d3d3>
	<td align=center height=30 style="font-family:Tahoma;font-size:8pt;">
		<br>
		<?php echo $message;?>
		<br>
		<br>
<?php
  if(!$url) {
?>

		<center><input type=button value="   Move Back   " onclick=history.back() style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px;>

<?php
  } else {
?>

		<div align=center><input type=button value='   Move Page   ' onclick=location.href="<?php echo $url;?>" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px;>

<?php
  }
?>
 		<br>
		<br>
    </td>
</tr>
</form>
</table>

</div>
<br>
<br>

