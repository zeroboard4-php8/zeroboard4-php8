<br><br><br>
<div align=center>
<form>
<table width=250 border=0 cellspacing=0 cellpadding=0>
<tr>
   <td width=10 height=10 background=<?=$dir?>/bg_1.gif></td>
   <td width=230 background=<?=$dir?>/bg_2.gif valign=BOTTOM><img src=<?=$dir?>/b_error.gif></td>
   <td width=10 height=10 background=<?=$dir?>/bg_3.gif></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=240>
<tr height=10><td><img src=images/t.gif height=1></td></tr>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
    </td>
</tr>
<tr height=1><td bgcolor=#484848><img src=images/t.gif height=1></td></tr>
<tr height=10><td><img src=images/t.gif height=1></td></tr>
<tr><td align=center>

<?php 
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/b_back.gif onfocus=blur()>

<?php 
  }
  else
  {
?>

  <div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><img src=<?=$dir?>/s_move.gif border=0></a>

<?php 
  }
?>
<br><br>
    </td>
</tr>
</form>
</table>
</div>
<br><br>
