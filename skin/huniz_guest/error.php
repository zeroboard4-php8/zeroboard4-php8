<div align=center>
<form>
<br><br><br>
<table border=0 width=250>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?>
      <br><br>
<?php 
  if(!$url)
  {
?>

  <center><input onfocus='this.blur()' type=button value=' back ' class=submit onclick="history.go(-1)">

<?php 
  }
  else
  {
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>