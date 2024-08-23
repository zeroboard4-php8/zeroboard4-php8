<form>
<br><br><br>

<table border=0 cellspacing=0 cellpadding=0 width=263>
<tr>
<td height=1 class=line></td>   
</tr>
</table>
<br>
<table border=0 width=250>
<tr>
    <td align=center height=30>
      <br>
      <font color=red><?php echo $message;?></font><br><br>
<?php
  if(!$url)
  {
?>

  <center><input type=button value="back" onclick=history.go(-1) class=submit>

<?php
  }
  else
  {
?>

  <div align=center><input type=submit value="back" class=submit onclick=location.href="<?php echo $url;?>">

<?php
  }
?>
   <br><br>
 </td>
</tr>
</table>

</form>

<table border=0 cellspacing=0 cellpadding=0 width=263>
<tr>
<td height=1 class=line></td>   
</tr>
</table>
<br><br>