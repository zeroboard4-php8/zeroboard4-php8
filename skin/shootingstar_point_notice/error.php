<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>
<form>
<table border=0 cellspacing=0 cellpadding=0 width=300>
<tr>
   <td colspan=2><table width=100% border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td align=center nowrap><img src=/images/t.gif height=3></td> 
  </tr>
</table></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300>
<tr>
  <td colspan=2 height=30>&nbsp; <span class=ver7><span class=color>E</span>RROR</span></td>
</tr>
<tr height=1><td colspan=2 class=trans><img src=images/t.gif height=1></td></tr>
<tr height=25 style=padding:5px;>
    <td align=center height=30>
      <br>
      <?php echo $message;?><br><br>
</td>
</tr>
<tr height=1><td colspan=2 class=transclass=trans><img src=images/t.gif height=1></td></tr>
<tr><td height=30 align=right>

<?php 
  if(!$url)
  {
?>

  <img src=images/t.gif height=3><br><a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/b.gif border=0></a>

<?php 
  }
  else
  {
?>

  <div align=right><a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/b.gif border=0></a>

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

