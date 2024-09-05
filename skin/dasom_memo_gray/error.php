<form>
<br>
<table cellpadding="1" cellspacing="0" bgcolor="white">
<tr><td>
<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
 <td class=tdclass width=100% align=center>&nbsp;</td>
 <td class=tdclass width=100% align=center>&nbsp;</td>
 <td class=tdclass width=100% align=center>&nbsp;</td>
</tr>
</table><br>
<table border=0 width=250>
<tr>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
<?php 
  if(!$url)
  {
?>

  <center><a href=javascript:void(history.back())><img src=<?=$dir?>/i_back.gif border=0 onfocus="this.blur()"></a> 

<?php 
  }
  else
  {
?>

  <div align=center><img src=<?=$dir?>/i_back.gif border=0 onfocus="this.blur()" onclick=location.href="<?php echo $url;?>">

<?php 
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>

</td>
</tr>
</table>

