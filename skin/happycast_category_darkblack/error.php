<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>

<table width=300 border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>><tr><td><img src=images/t.gif height=3></td></tr></table>

<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<font class=view_title2>Error</font></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$list_divider?>><img src=images/t.gif height=1></td></tr>
<tr height=25 bgcolor=<?=$view_left_header_color?> style=padding:5px;>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
<tr><td height=50 align=right colspan=2>

<?php
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/images/btn_back.gif onfocus=blur()>

<?php
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class=submit onfocus=blur()>

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
