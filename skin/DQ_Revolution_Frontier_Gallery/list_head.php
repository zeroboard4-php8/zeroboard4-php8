<?php 
	if(!file_exists(getcwd().'/zboard.php')) die("정상적인 접근이 아닙니다.");

//	$a_vote = str_replace("select_arrange=hit", "select_arrange=vote", $a_hit);

	$_line_print = false;

// 정렬버튼 링크 정의
	$a_no	= "<a onfocus=blur() href=\"$_SERVER[PHP_SELF]?$href&select_arrange=headnum&desc=$t_desc\">";
	$a_hit	= "<a onfocus=blur() href=\"$_SERVER[PHP_SELF]?$href&select_arrange=hit&desc=$t_desc\">";
	$a_vote	= "<a onfocus=blur() href=\"$_SERVER[PHP_SELF]?$href&select_arrange=vote&desc=$t_desc\">";
	$a_date	= "<a onfocus=blur() href=\"$_SERVER[PHP_SELF]?$href&select_arrange=reg_date&desc=$t_desc\">";

// 정렬 버튼의 경우 $desc를 역으로 변환
	if($desc=="desc") $t_desc="asc"; else $t_desc="desc";

// 언어묶음 불러오기
    require $dir."/".$skin_setup['language_dir']."list.php";
    $member_memo_icon = str_replace($skin_setup['css_dir'].$skin_setup['css_dir'], $skin_setup['css_dir'], $member_memo_icon);

//개인갤러리 사용시 개인정보 헤더를 뿌려줌
	if(!empty($skin_setup['using_pGallery']) && $su=="on" && $keyword && !$view_once) include "$dir/plug-ins/pgallery_header.php";
?>
    <div id="controlbar" class="highslide-overlay controlbar">
        <a href="#" class="previous" onclick="return hs.previous(this)"></a>
        <a href="#" class="next" onclick="return hs.next(this)"></a>
    </div>
    <div class="highslide-caption"></div>
	<div id="thumbNaviSelector"><div></div></div>
    <table border="0" cellpadding="0" cellspacing="0" width="<?=$width?>" class="thumb_area_bg">
		<form method="post" name="list" action="list_all.php">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="id" value="<?=$id?>">
		<input type="hidden" name="select_arrange" value="<?=$select_arrange?>">
		<input type="hidden" name="desc" value="<?=$desc?>">
		<input type="hidden" name="page_num" value="<?=$page_num?>">
		<input type="hidden" name="selected">
		<input type="hidden" name="exec">
		<input type="hidden" name="keyword" value="<?=$keyword?>">
		<input type="hidden" name="sn" value="<?=$sn?>">
		<input type="hidden" name="ss" value="<?=$ss?>">
		<input type="hidden" name="sc" value="<?=$sc?>">
	<tr><td style="height:5px;"></td></tr>

	<?php if($setup['use_category'] && $skin_setup['using_category']) {?>
	<tr>
		<td>
		<?php include "include/print_category.php"?>
		</td>
	</tr>
	<?php $_line_print = 1; }?>

<?php 
	if(!eregi("<Zeroboard",$a_login)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_join)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_modify)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_member_memo)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_logout)) $_line_print = 2;
	if(!eregi("<Zeroboard",$a_write_tmp) && !empty($_SS['using_topWriteBT'])) $_line_print = 2;
	if($is_admin) $_line_print = 2;
	if($skin_setup['using_sort']) $_line_print = 2;

	if($_line_print==2) {
?>
	<tr>
		<td><table border="0" cellpadding="0" cellspacing="4" width="100%">
			  <tr>
				  <td style="width:5px"></td>
	<?php if($skin_setup['using_sort']) {?>
				  <td class="han" align="left"><?=$bt_sort?></td>
	<?php } ?>
				  <td class="han" align="right" align="left">
					<div class="small_han">
					<?php if(!$skin_setup['disable_login'] && !$view_once) { ?>
					<?=$bt_login?><?=$bt_member_join?><?=$bt_member_modify?><?=$a_member_memo?><?=$member_memo_icon?></a><?=$memo_on_sound?><?=$bt_logout?>
					<?php } ?>
					<?php if($is_admin && !$view_once) {?>
					<?=$bt_setup?><a href="javascript:void(window.open('<?=$dir?>/skin_config_<?=$dqrevolutionType?>.php?id=<?=$id?>&mode=modify'))"><?=$bt_skinsetup?></a>
					<?php } ?>
					<?php if(!empty($_SS['using_topWriteBT'])) echo $bt_write."</a>"?>
					</div>
				  </td>
				  <td style="width:5px"></td>
			  </tr></table></td>
	</tr>
	<?php }?>

	<?php if($_line_print) { ?>
	<tr><td style="height:4px;"></td></tr>
	<tr><td colspan="4" class="lined"><?=$blank_Image?></td></tr>
	<?php } ?>
	<tr><td style="height:10px;"></td></tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" width="<?=$width?>" class="thumb_area_bg">
	<tr><td style="padding:5px <?=$skin_setup['thumb_aMargin2']?>px 0 <?=$skin_setup['thumb_aMargin1']?>px;">
