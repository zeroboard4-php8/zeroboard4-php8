<?php
if(eregi(basename(__FILE__),$PHP_SELF)) die('정상적인 접근이 아닙니다');

//	$a_vote = str_replace("select_arrange=hit", "select_arrange=vote", $a_hit);

// 정렬 버튼의 경우 $desc를 역으로 변환
	//if($desc=="desc") $t_desc="asc"; else $t_desc="desc";

// 정렬버튼 링크 정의
	$a_no	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=headnum&desc=$t_desc\">";
	$a_hit	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=hit&desc=$t_desc\">";
	$a_vote	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=vote&desc=$t_desc\">";
	$a_date	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=reg_date&desc=$t_desc\">";
	$a_subj	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=subject&desc=$t_desc\">";
	$a_name	= "<a onfocus=\"blur()\" href=\"$PHP_SELF?$href&select_arrange=name&desc=$t_desc\">";

// 언어묶음 가져오기
	require $dir."/".$skin_setup['language_dir']."list.php";
    $member_memo_icon = str_replace($skin_setup['css_dir'].$skin_setup['css_dir'], $skin_setup['css_dir'], $member_memo_icon);

// 상단 바
	$colspanNum = 9;
	if(!$setup['use_cart']) $colspanNum--;
	if(!$setup['use_category']) {
		$colspanNum--; 
		if(!$skin_setup['using_titlebar2']) $colspanNum++;
	}

//	if($skin_setup['using_titlebar']) {
		if(empty($skin_setup['using_titlebar1'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar2'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar3'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar4'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar5'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar6'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar7'])) $colspanNum--;
		if(empty($skin_setup['using_titlebar8'])) $colspanNum--;

		$colspan = $colspanNum*2;
		if(!empty($skin_setup['using_titlebar3'])) $colspan--;
//	}

	$_ss_ = &$skin_setup;

// 설정
	$_separator = "<td><img src=\"$_css_dir"."separator.gif\"></td>";
	$_line_print = '';
	if(isset($a_category)) $a_category = str_replace(">Category</option>",">".$_strSkin['category']."</option>",$a_category);

	$list_valign  = 'middle';
	$list_valign2 = (!empty($skin_setup['using_shortmemo']) || !empty($skin_setup['using_shortinfo'])) ? 'top' : 'middle';
	$dqEngine['thumb_resize'] = isset($skin_setup['thumb_resize'])? $skin_setup['thumb_resize']	: 0;
	if(!empty($skin_setup['using_shortinfo'])) $bt_subj = '';
?>

<div id="controlbar" class="highslide-overlay controlbar">
	<a href="#" class="previous" onclick="return hs.previous(this)" title="왼쪽 방향키를 누르셔도 됩니다"></a>
	<a href="#" class="next" onclick="return hs.next(this)" title="오른쪽 방향키를 누르셔도 됩니다"></a>
</div>
<div class="highslide-caption"></div>

<?php if(!empty($view_once)) {?>
<div style="height:20px;width:<?=$width?>"></div>
<?php }

// 카테고리 출력(가로방향)
	if($setup['use_category'] && $skin_setup['using_category'] && $skin_setup['category_type']=='col') $_line_print=1;
	if($_line_print == 1 && !$view_once) {?>
<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>">
  <tr><td style="height:10px;"></td></tr>
  <tr><td><?php include "include/print_category.php"?></td></tr>
  <tr><td height="3px"><img height="1px" width="1px"></td></tr>
</table>
	<?php }?>

<?php
// 로그인 관련
	if(!eregi("<Zeroboard",$a_login)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_join)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_modify)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_memo)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_logout)) $_line_print = 2;
	if($is_admin) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_write_tmp) && !empty($_ss_['using_topWriteBT'])) $_line_print = 2;
	if(!empty($skin_setup['using_sort'])) $_line_print = 2;

	if($setup['use_category'] && $skin_setup['using_category'] && $skin_setup['category_type']=='row' && $skin_setup['category_pos'] != '3') {
		$_str_category = &$a_category;
		$_line_print=2;
	}
    if($setup['use_category'] && $skin_setup['using_category'] && $skin_setup['category_type']=='row' && $skin_setup['category_pos'] == '3') {
		$_str_category_bar = &$a_category;
	};

if($_line_print == 2 && empty($view_once)) {?>
<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>">
<tr><td style="height:3px"></td></tr>
<?php if($_line_print == 2) {?>
<tr>
	<td><table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>			  
			  <?php if(!empty($_str_category) && $skin_setup['category_pos']=='1'){?><td width="5px">&nbsp;</td><td width="50px"><?=$_str_category?></td><?php }?>
			  <td align="right">
			    <?php if(!empty($_str_category) && $skin_setup['category_pos']=='2'){?><?=$_str_category?><br><img src="<?=$dir?>/t.gif" height="8px">&nbsp;&nbsp;<?php }?><div class="small_han">
				<?php if(!$skin_setup['disable_login']) { ?>
				<?=$bt_login?><?=$bt_member_join?><?=$bt_member_modify?><?=$a_member_memo?><?=$member_memo_icon?></a><?=$memo_on_sound?><?=$bt_logout?>
				<?php } ?>
				<?php if($is_admin) {?>
				<?=$bt_setup?>
				<a href="javascript:void(window.open('<?=$dir?>/skin_config_<?=$dqrevolutionType?>.php?id=<?=$id?>&mode=modify'))"><?=$bt_skinsetup?></a>
				<?php } ?>
				<?php if(!empty($_ss_['using_topWriteBT'])) echo $bt_write."</a>"?>
				</div>
			  </td>
		  </tr></table></td>
</tr>
<tr><td height="3px"></td></tr>
<?php }?>
</table>
<?php } ?>

<form method="post" name="list" action="list_all.php" style="display:inline">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="select_arrange" value="<?=$select_arrange?>">
<input type="hidden" name="desc" value="<?=$desc?>">
<input type="hidden" name="page_num" value="<?=$page_num?>">
<input type="hidden" name="selected">
<input type="hidden" name="exec">
<input type="hidden" name="keyword" value="<?=$keyword?>">
<input type="hidden" name="sn" value="<?=$sn?>">
<input type="hidden" name="ss" value="<?=!empty($_ss_)?'on':'off'?>">
<input type="hidden" name="sc" value="<?=$sc?>">
<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" class="info_bg">
<?php $coloring=0;?>
	<?php if(!empty($_ss_['using_titlebar1'])){?><col width="42px"></col><col width="3px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><col width="40px"></col><col width="3px"></col><?=$hide_category_end?><?php }?>
	<?=$hide_cart_start?><col width="20px"></col><col width="3px"></col><?=$hide_cart_end?>
	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><col width="<?=$skin_setup['namedsp_width']?>px"></col><col width="3px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><col width="auto"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar8'])){?><col width="3px"></col><col width="25"></col><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><col width="3px"></col><col width="<?=$skin_setup['namedsp_width']?>px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><col width="3px"></col><col width="60px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><col width="3px"></col><col width="30px"></col><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><col width="3px"></col><col width="35px"></col><?php }?>

<?php if(!empty($_ss_['using_titlebar'])) {?>
<tr align="center" valign="middle" class="title">
	<?php if(!empty($_ss_['using_titlebar1'])){?><td class="list_tspace"><nobr><?=$bt_no?></nobr></td><?=$_separator?><?php }?>
    <?php if(!empty($_ss_['using_titlebar2']) && !empty($_str_category_bar) && $skin_setup['category_pos']=='3'){?><td class="list_tspace"><?=$_str_category_bar?></td><?=$_separator?><?php }
	elseif(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><td class="list_tspace"><?=$bt_cate?></td><?=$_separator?><?=$hide_category_end?><?php }?>
	<?=$hide_cart_start?><td class="list_tspace"><?=$bt_cart?></td><?=$_separator?><?=$hide_cart_end?>
	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td class="list_tspace" align="left">&nbsp;<?=$bt_name?></td><?=$_separator?><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><td class="list_tspace"><?=$bt_subj?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar8'])){?><td></td><td></td><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><?=$_separator?><td class="list_tspace"><?=$bt_name?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_date?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_vote?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><?=$_separator?><td class="list_tspace"><nobr><?=$bt_hit?></nobr></td><?php }?>
</tr>
<?php } else {
	$_separator = "<td></td>";
?>
<tr style="height:5px">
	<?php if($_ss_['using_titlebar1']){?><td></td><?=$_separator?><?php }?>
    <?php if($_ss_['using_titlebar2'] && $_str_category_bar && $skin_setup['category_pos']=='3'){?><td></td><?=$_separator?><?php }
	elseif($_ss_['using_titlebar2']){?><?=$hide_category_start?><td></td><?=$_separator?><?=$hide_category_end?><?php }?>
	<?=$hide_cart_start?><td></td><?=$_separator?><?=$hide_cart_end?>
	<?php if($_ss_['move_name'] && $_ss_['using_titlebar4']){?><td></td><?=$_separator?><?php }?>
	<?php if($_ss_['using_titlebar3']){?><td></td><?php }?>
	<?php if(!$_ss_['move_name'] && $_ss_['using_titlebar4']){?><?=$_separator?><td></td><?php }?>
	<?php if($_ss_['using_titlebar8']){?><?=$_separator?><td></td><?php }?>
	<?php if($_ss_['using_titlebar5']){?><?=$_separator?><td></td><?php }?>
	<?php if($_ss_['using_titlebar6']){?><?=$_separator?><td></td><?php }?>
	<?php if($_ss_['using_titlebar7']){?><?=$_separator?><td></td><?php }?>
</tr>
<?php }?>
