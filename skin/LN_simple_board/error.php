<?php include "$dir/value.php3"; ?>
<form>
<br><br><br>
<table width=250 border=0 cellpadding=0 cellspacing=0>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
<tr>
    <td bgcolor=<?=$sC_color?> align=center height=30 class=ver8>
      <br>
      <?php echo $message;?><br><br>
<?php 
  if(!$url)
  {
?>

  <br>
  <center><input type=button value="Back" onclick=history.go(-1) class=submit>

<?php 
  }
  else
  {
?>

  <div align=center><input type=button value=' Move ' onclick=location.href="<?php echo $url;?>" class=submit>

<?php 
  }
?>
   <br><br>
    </td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
</form>
</table>
<br><br>
