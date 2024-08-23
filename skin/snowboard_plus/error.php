<br><br><br>
<div align=center>
<form>
<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr>
    <td align=center height=20 class=t8_4a4d4a><b>Message</font></td>
</tr>
<tr>
 <td colspan=8 bgcolor=cccccc height=2></td>
</tr>
<tr>
<td height=2></td>
</td>
<tr>
 <td colspan=8 bgcolor=4A4D4A  height=1></td>
</tr>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
<?php
  if(!$url)
  {
?>

  <center><img src=<?=$dir?>/image/btn_back.gif align=absmiddle border=0 onclick=history.go(-1) style=cursor:hand>

<?php
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class=sd_submit>

<?php
  }
?>
   
   <br><br>
    </td>
</tr>
</form>
<tr>
 <td colspan=8 bgcolor=4A4D4A  height=1></td>
</tr>
<tr>
<td height=2></td>
</td>
<tr>
 <td colspan=8 bgcolor=cccccc height=2></td>
</tr>
</table>
</div>
<br><br>
