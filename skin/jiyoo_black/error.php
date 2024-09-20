<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>
<table border=0 cellspacing=0 cellpadding=0 width=300>
<tr>
 <td colspan=2 align=left><img src=<?=$dir?>/images/i_error.gif border=0></td>
</tr>
<tr>
 <td background=<?=$dir?>/images/list_t01_bg.gif align=left><img src=<?=$dir?>/images/list_t01_f.gif border=0></td>
 <td background=<?=$dir?>/images/list_t01_bg.gif align=right><img src=<?=$dir?>/images/list_t03.gif border=0></td>
</tr>
<tr>
 <td colspan=2 align=left height=10><img src=<?=$dir?>/images/blank.gif border=0></td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr height=25 style=padding:5px;>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2 bgcolor=666666><img src=images/t.gif height=1></td></tr>
<tr><td height=30 align=right>

<?php 
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/images/i_wback.gif>

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
