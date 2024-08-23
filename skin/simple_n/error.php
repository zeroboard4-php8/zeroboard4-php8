<form>
<br><br><br>

<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></td></tr>
<tr>
	<td align=center height=25 bgcolor=#F8F8F8 class=yeinsub><b>ERROR</b></td>
</tr>
<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></a></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=3 width=250>
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
  <center><a href=# onclick=history.back() onfocus=blur()><font class=yeinsfont><b>Back</b></font></a>

<?php
  }
  else
  {
?>

  <div align=center><a href=# onclick=location.href="<?php echo $url;?>" onfocus=blur()><font class=th7><b>Move</b></font></a>

<?php
  }
?>
   <br><br>
   </td>
</tr>
</form>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></a></td></tr>
</table>
<br><br>