<?php 
if($select_arrange == 'headnum' && $desc == 'asc') {
    $subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
	$_notice_visible = true;
	if(!empty($memo_num)) echo $memo_num;
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="han" align="left"><?=$hide_cart_start?><input type="checkbox" name="cart" value="<?=$data['no']?>"><?=$hide_cart_end?>::&nbsp;<?=$insert?><b><?=$subject?></b>&nbsp;<font class="eng" style="font-size:8pt"><?=$comment_num?></font>
	<?php if(!empty($skin_setup['show_name'])){?>&nbsp;-&nbsp;<?=$face_image?>&nbsp;<?=$name?><?php }?>
	</td>
</tr>
</table>
<?php } else {
    include $dir.'/list_main.php';
}
?>
