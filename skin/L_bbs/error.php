<form>
<br><br><br>
<table border=0 width=250>
<tr>
    <td align=center height=30 style=font-family:Lfont >
      <br>
      <?php echo $message;?><br><br>
<?php
  if(!$url)
  {
?>

  <center>
  <input type=button style=font-family:Lfont value="뒤로" class=submit onclick=history.back()>

<?php
  }
  else
  {
?>

 <div align=center>
<input type=button style=font-family:Lfont value="뒤 로" class=submit onclick=history.back()>

<?php
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>
<br><br>
