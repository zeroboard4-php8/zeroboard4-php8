<form>
<br><br><br>
<table width=250 cellspacing=0 cellpadding=0 border=0>
<tr>
<td style='padding-left:10;'><b>에러~</b></td>
</tr>
<tr>
<td class=wk-line><span class=none>&nbsp;</span></td>
</tr>
<tr>
<td style='padding-left:10;'>
<br>
<?php echo $message;?>
<br>
<?php 
if(!$url) {
?>
<br><center>
<input type=button onclick=history.go(-1) value='취소' class=submit-comment style="width:45px" onfocus=blur()></center>
<?php 
}
else {
?>
<center><input type=button onclick=location.href="<?php echo $url;?>" value='확인' class=submit-comment style="width:45px" onfocus=blur()></center>
<?php 
}
?>
<br>
</td>
</tr>
<tr>
<td class=wk-line><span class=none>&nbsp;</span></td>
</tr>
</table>
</form>
