<br><br><br><table border="0" cellpadding="0" cellspacing="0" width="300" align="center">
<tr><form><td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td>
<td width="298" height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td>
<td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td></tr><tr>
<td width="1" height="5"></td>
<td width="284" align="center" height="78" valign="middle" style="background-image:url('<?=$dir?>/bg.gif'); background-repeat:repeat-y; background-attachment:fixed; background-position:90px 0px; padding:5px;"><span class=v81><?php echo $message;?></span></td>
<td width="1" height="5"></td></tr>
<tr><td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td>
<td width="298" height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td>
<td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td></tr></table>
<?php 
  if(!$url)
  {
?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=300>
<tr><td align="center"><input type=button value="BACK" class=submit onclick=history.back()>
<?php 
  }
  else
  {
?>
<input type=button value="BACK" class=submit onclick=history.back()>
<?php 
  }
?>
</td></form></tr></table>