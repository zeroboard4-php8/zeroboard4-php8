<form>
<br><br><br>
<table border=0 width=<?=$width?> class=zv3_writeform height=30>
<tr class=title>
	<td class=title_han align=center><b>Message</b></td>
</tr>
<tr class=list0>
    <td align=center height=50 class=list_han>
      <?php echo $message;?>
	</td>
</tr>
</table>
<?php 
  if(!$url)
  {
?>

  <br>
  <center><a href=# onclick=history.back() onfocus=blur()><font class=list_han>이전 화면</font></a></center>

<?php 
  }
  else
  {
?>
	<br>
  <div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><font class=list_han>페이지 이동</font></a></center>

<?php 
  }
?>
</form>
<br>
<br>