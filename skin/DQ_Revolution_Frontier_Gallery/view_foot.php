</td></tr></table>
<script type="text/javascript">
addEvent(window,'load', chk_resizeImages);
//addEvent(window,'load',function() {
<?=!empty($strAlign_reComment)?$strAlign_reComment:''?>
//});
</script>

<?php 
$_comment_grant_guide = !empty($comment_grant_element) ? implode(', ',$comment_grant_element) : '';
if(empty($skin_setup['using_comment']) || empty($comment_count)) $skin_setup['using_bodyBtTool2'] = '';

if(!empty($limitCommentOFF) || (!empty($skin_setup['using_comment']) && !empty($_comment_grant_guide) && $member['level']>$setup['grant_comment'])) { ?>
	<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>">
	<tr><td style="height:15px" class="info_bg"></td></tr>
	<tr><td><div class="lined"><?=$blank_Image?></div></td></tr>
	<tr class="info_bg">
	  <td align="center" style="padding:10px <?=$_rSwidth?>px 8px <?=$_lSwidth?>px">
		<font class="han2">의견(코멘트)을 작성하실 수 없습니다.</font><font class="han"> 이유: <?=$_comment_grant_guide?></font>
	  </td>
	</tr>
	</table>
<?php 
} elseif($skin_setup['using_bodyBtTool2']) {?>
	<table border="0" cellspacing="0" cellpadding="0" height="1px" width="<?=$width?>" class="info_bg">
	<tr><td style="height:10px"></td></tr>
	</table>
<?php 
}
?>

<?php if($skin_setup['using_bodyBtTool2']) {?>
	<div style="width:<?=$width?>" class="lined"><?=$blank_Image?></div>
<?php } ?>

<?php if($skin_setup['using_bodyBtTool2']) { ?>
	<table width="<?=$width?>" cellspacing="0" cellpadding="0" class="info_bg">
	<tr><td colspan="4" height="3px"></td></tr>
	<tr>
	 <td width="<?=$_lSwidth?>px"><img src="<?=$dir?>/t.gif" width="<?=$_lSwidth?>px" height="1px" />
	 <td height="30px" align="left">
		<?=isset($bt_reply)?$bt_reply:''?><?php if($is_admin || empty($is_vdel)) {?><?=isset($bt_modify)?$bt_modify:''?><?=isset($bt_delete)?$bt_delete:''?><?php }?>
		<?php if(!empty($using_vote)) {?><?=$bt_vote?><?php }?>
	 </td>
	 <td align="right">
		<?=$bt_list?><?=$bt_write?>
	 </td>
	 <td width="<?=$_rSwidth?>px"><img src="<?=$dir?>/t.gif" width="<?=$_rSwidth?>px" height="1px" />
	</tr>
	</table>
<?php } ?>

<?php if(!empty($skin_setup['using_bmode']) && !empty($enable_pn_list) && empty($setup['use_alllist']) && ($prev_data['no']||$next_data['no'])) {?>
	<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" class="info_bg">
	<tr><td height="10px"></td></tr>
	<?php 
	if($prev_data['no']) echo "<tr><td class=\"han\" style=\"padding:0 0 5px 10px;text-align:left\">$bt_iprev: <a href=\"$_zb_exec?$href&$sort&no={$prev_data['no']}\" onfocus=\"blur()\"><font class=\"han2\">".cut_str(stripslashes($prev_data['subject']),$setup['cut_length'])."</font></a></td></tr>";
	if($next_data['no']) echo "<tr><td class=\"han\" style=\"padding:0 0 5px 10px;text-align:left\">$bt_inext: <a href=\"$_zb_exec?$href&$sort&no={$next_data['no']}\" onfocus=\"blur()\"><font class=\"han2\">".cut_str(stripslashes($next_data['subject']),$setup['cut_length'])."</font></a></td></tr>";
	?>
	</table>
<?php } ?>

<?php if(!$setup['use_alllist']) { ?>
	<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>">
	<tr><td style="height:10px"></td></tr>
	</table>
<?php } ?>
