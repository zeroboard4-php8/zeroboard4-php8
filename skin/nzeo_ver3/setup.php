<?php 
	$colspanNum = 8;
	if($setup['use_cart']) $colspanNum--;
	if(!$setup['use_alllist']) {
		$hide_category_start="<!--";
		$hide_category_end="-->";
		$setup['use_category']=false;
	}
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function zb_formresize(obj) {
		obj.rows += 3; 
	}
// -->
</SCRIPT>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
	<td <?php if(!$setup['use_category']) echo"align=right";?>>
		<?=$a_login?><img src=<?=$dir?>/btn_s_login.gif border=0></a>
		<?=$a_member_join?><img src=<?=$dir?>/btn_join.gif border=0></a>
		<?=$a_member_modify?><img src=<?=$dir?>/btn_info.gif border=0></a>
		<?=$a_member_memo?><img src=<?=$dir?>/btn_memobox.gif border=0></a>
		<?=$a_logout?><img src=<?=$dir?>/btn_logout.gif border=0></a>
		<?=$a_setup?><img src=<?=$dir?>/btn_setup.gif border=0></a>
	</td>
	<?=$hide_category_start?>
	<td align=right><table border=0 cellspacing=0 cellpadding=0><tr><td><img src=<?=$dir?>/h_category.gif border=0></td><td><?=$a_category?></td></tr></table></td>
	<?=$hide_category_end?>
</tr>
</table>
