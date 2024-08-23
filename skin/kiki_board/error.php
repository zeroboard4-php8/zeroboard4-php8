<?php include "$dir/value.php3"; ?>

<br><br><br>
<div align=center>

<table border="0" width="200" cellspacing=0 cellpadding=0>
    <tr>
        <td width="30" height=20  background=<?=$dir?>/bar_left.gif>

        </td>
        <td width="140" align=center height=20 background=<?=$dir?>/bar_center.gif>
<b><font size="1" face="verdana" color="CCCCCC">Login</font></b>
        </td>
        <td width="30" height=20 background=<?=$dir?>/bar_right.gif>

        </td>
    </tr>
    <tr>
        <td width="200" colspan="3" align=center>

        <table border=0 width=190 cellspacing=0 cellpadding=0>
<tr height=50>

<td align=center><font color=e24f1d><?php echo $message;?></td></tr>

 <tr>
 <td align=center>
<?php
  if(!$url)
  {
?>

  <img onclick=history.back() border=0 align=absmiddle src=<?=$dir?>/cancle.gif alt=취소>

<?php
  }
  else
  {
?>

  <div align=center><input type=button value='   돌아가기   ' onclick=location.href="<?php echo $url;?>" class=submit>

<?php
  }
?>

 </td>
</tr>

</table>
</td>
</tr>

</table>
<br><BR><BR>
</div>



