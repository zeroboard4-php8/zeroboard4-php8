<?php 
if(eregi(basename(__FILE__),$PHP_SELF)) die('정상적인 접근이 아닙니다');

	$colspanNum = 8;
	$colspanNum = $colspanNum - 1;
	$_separator = "<td><img src=$_css_dir"."separator.gif></td>";

	if(!$setup['use_cart']) $colspanNum--;
	if(!$setup['use_category']) {
		$colspanNum--; 
		if(!$skin_setup['using_titlebar2']) $colspanNum++;
	}

	if(empty($skin_setup['using_titlebar2'])) $colspanNum--;
	if(empty($skin_setup['using_titlebar3'])) $colspanNum--;
	if(empty($skin_setup['using_titlebar4'])) $colspanNum--;
	if(empty($skin_setup['using_titlebar5'])) $colspanNum--;
	if(empty($skin_setup['using_titlebar6'])) $colspanNum--;
	if(empty($skin_setup['using_titlebar7'])) $colspanNum--;

	$colspan = $colspanNum*2;
	if(!$skin_setup['using_titlebar3']) $colspan--;

	$_ss_ = &$skin_setup;

// 설정
	$_separator = "<td class=\"list_tspace\"><img src=\"$_css_dir"."separator.gif\"></td>";
	if(!empty($skin_setup['using_shortmemo'])) $list_valign = 'top'; else $list_valign = 'middle';

// 언어묶음 가져오기
	include $dir."/".$skin_setup['language_dir']."list.php";

?>

<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" class="info_bg">
<?php $coloring=0;?>
	<?php if(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><col width="40px"></col><col width="3px"></col><?=$hide_category_end?><?php }?>
	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><col width="100px"></col><col width="3px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><col width="auto"></col><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><col width="3px"></col><col width="80px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><col width="3px"></col><col width="60px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><col width="3px"></col><col width="30px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><col width="3px"></col><col width="35px"></col><?php }?>

<tr><td colspan="<?=$colspan?>" height="20px" class="han2" style="padding:20px 10px 0 0" align="left"><font class="han">■</font> <b>관련글 목록</b></td></tr>
<?php if(!empty($_ss_['using_titlebar'])) {?>
<tr><td colspan="<?=$colspan?>" height="5px"></td></tr>
<tr align="center" valign="middle" class="title" style="font-weight:bold;height:27px;padding-top:5px">
    <?php if(!empty($_ss_['using_titlebar2']) && !empty($_str_category) && $skin_setup['category_pos']=='3'){?><td class="list_tspace"><?=$_str_category?></td><?=$_separator?><?php }
	elseif(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><td class="list_tspace"><?=$bt_cate?></td><?=$_separator?><?=$hide_category_end?><?php }?>
	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td class="list_tspace" align="left"><?=$bt_name?></td><?=$_separator?><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><td class="list_tspace"><?=$bt_subj?></td><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><?=$_separator?><td class="list_tspace"><?=$bt_name?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_date?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_vote?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_hit?></nobr></td><?php }?>
</tr>
<?php }?>
<tr><td colspan="<?=$colspan?>" class="line_dark" height="1px"></td></tr>
<tr><td colspan="<?=$colspan?>" class="line_shadow" height="3px"></td></tr>
