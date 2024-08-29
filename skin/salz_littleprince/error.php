<form>
<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
 <td></td>
 <td align=center width=100%>&nbsp;</td>
 <td></td>
</tr>
</table>
<table border=0 width=250>
<tr><td colspan=10 background=<?php echo $dir?>/dot.gif height=1></td></tr>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
<?php 
  if(!$url)
  {
?>
<tr><td colspan=10 background=<?php echo $dir?>/dot.gif height=1></td></tr>
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
   <br>
    </td>
</tr>
</form>
</table>
<br><br>
