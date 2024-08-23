<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30>
<tr>
    <td align=center height=30 bgcolor=white>
      <?php echo $message;?>
	</td>
</tr>
</table>
<?php 
  if(!$url)
  {
?>

  <br>
  <center><a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a>

<?php 
  }
  else
  {
?>
	<br>
  <div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><img src=<?=$dir?>/btn_move.gif border=0></a>

<?php 
  }
?>
   <br><br>
</form>
<br><br>
