<form>
<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250 style=background-color:#3bb0d6;>
<tr>
 <td><img src=<?=$dir?>/h_left.gif border=0></td>
 <td background=<?=$dir?>/h_bg.gif width=100%><img src=<?=$dir?>/h_bg.gif border=0></td>
 <td><img src=<?=$dir?>/h_right.gif border=0></td>
</tr>
</table>
<table border=0 width=250  style=background-color:#3bb0d6;>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
<?php
  if(!$url)
  {
?>

  <center><img src=<?=$dir?>/i_back.gif border=0 onclick=history.back()>

<?php
  }
  else
  {
?>

  <div align=center><img src=<?=$dir?>/i_back.gif border=0  onclick=location.href="<?php echo $url;?>" >

<?php
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>
<br><br>
