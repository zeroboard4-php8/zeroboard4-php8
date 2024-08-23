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

  <br>
  <center><a href=# onclick=history.back() onfocus=blur()>back</a>

<?php
  }
  else
  {
?>

  <div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()>move</a>

<?php
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>
<br><br>