<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>
<table border=0 cellspacing=0 cellpadding=0 width=300 height=25 >
<tr>
  <td height="30" class=pqbig-lh>&nbsp;&nbsp;<span style=font-family:verdana;font-size:8pt;font-weight:bold;><font color=#FFFFFF>Error</font></span></span></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr height=1><td colspan=2 ><img src=images/t.gif height=1></td></tr>
<tr height=25 style=padding:5px;>
    <td height=70 align=center bgcolor="f5f5f5" class=ssuk-ver9>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
<td height=2 class=ssuk-line2></td></tr>
<tr><td align=right valign="top">
<?php
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><input type=button value="back" onclick=history.go(-1) class=pqbig-submit>

<?php
  }
  else
  {
?>

  <div align=center><input type=button value=' Login ' onclick=location.href="<?php echo $url;?>" class=pqbig-submit>

<?php
  }
?>
</td>
</tr>
</table>

</form>
</div>
<br><br>
