<form>
<br><br><br>
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
</form>
</table>
<br><br>
