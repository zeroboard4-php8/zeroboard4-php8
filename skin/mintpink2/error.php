<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
   <td colspan=2><table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#FFE8F5 bordercolorlight=#FFE8F5 bordercolordark=#FFFFFF>
  <tr>
    <td style=font-family:Matchworks,Tahoma;font-size:8pt;color:#738711 align=center nowrap><img src=/images/t.gif height=3></td> 
  </tr>
</table></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=250>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"><span style=font-size:15px;letter-spacing:-1px;>Error</span></span></td>
</tr>
<tr height=1><td colspan=2 bgcolor=#FF7FBF><img src=images/t.gif height=1></td></tr>
<tr height=25 bgcolor=#FFFFFF style=padding:5px;>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2 bgcolor=#FF7FBF><img src=images/t.gif height=1></td></tr>
<tr><td height=30 align=right>

<?php
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/images/btn_back.gif>

<?php
  }
  else
  {
?>

  <div align=center><input type=button value='   Move   ' onclick=location.href="<?php echo $url;?>" class=submit>

<?php
  }
?>
   <br><br>
    </td>
</tr>
</form>
</table>
</div>
<br><br>
