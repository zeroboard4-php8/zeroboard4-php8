<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>
<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr>
  <td colspan=2 height=110 align=right><img src=<?=$dir?>/images/error1.gif></td>
</tr>
<tr>
  <td colspan=2 height=16 background=<?=$dir?>/images/lh_bg.gif align=right>
  <img src=<?=$dir?>/images/error2.gif></td>
</tr>
<tr>
  <td colspan=2 height=30 background=<?=$dir?>/images/error3.gif align=right>&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"><span style=font-size:15px;letter-spacing:-1px;><font color=#CF0000>Error</font></span></span>&nbsp;&nbsp;</td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
<tr height=25 bgcolor=<?=$sC_light1?> style=padding:5px;>
    <td align=center background=<?=$dir?>/images/error4.gif height=30>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark1?>><img src=images/t.gif height=1></td></tr>
<tr><td height=30 align=right>

<?php 
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/images/btn_back.gif>

<?php 
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class=submit>

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
