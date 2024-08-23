<form>
<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
 <td><img src=<?=$dir?>/list_left.gif border=0></td>
 <td align=center background=<?=$dir?>/list_back.gif width=100%>&nbsp;</td>
 <td><img src=<?=$dir?>/list_right.gif border=0></td>
</tr>
</table>
<table border=0 width=250>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
<?php
  if(!$url)
  {
?>

  <br>
  <center><img src=<?=$dir?>/btn_back.gif border=0 onclick=history.back() onfocus=blur()>

<?php
  }
  else
  {
?>

  <div align=center><img src=<?=$dir?>/btn_back.gif border=0  onfocus=blur() onclick=location.href="<?php echo $url;?>" >

<?php
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>
<br><br>
