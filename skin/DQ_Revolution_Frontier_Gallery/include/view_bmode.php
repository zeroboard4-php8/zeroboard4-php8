<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');

	if($skin_setup['show_articleInfo']) {
	//  $skin_setup['using_exif'] = '';

// 글 작성자의 프로필 사진 가져오기
	$c_picture = get_memberPicture($data['ismember'], $dir.'/'.$skin_setup['css_dir'], $skin_setup['member_picture_x'], $skin_setup['member_picture_y']);

	if($skin_setup['using_vote'] && $skin_setup['vote_type'] == "1" &&  $member['no'] != $data['ismember']) $using_vote = true;

	  include $dir."/include/analysis_02.php";

	  if(file_exists($_css_dir."bg_view_title.gif")) $bg_string = " background=\"".$_css_dir."bg_view_title.gif\" style=\"background-repeat:repeat-x\"";
?>

	<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" class="info_bg"<?=$bg_string?>>
	<tr>
		<td valign="top" style="padding:10px <?=$_rSwidth?>px 3px <?=$_lSwidth?>px">
		  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed">
		  <tr>
		  <?php if(!empty($skin_setup['using_memberPicture'])) {?>
		  <td valign="top" width="<?=($c_picWidth+10)?>" align="center"><div class="separator2" style="padding:<?=$skin_setup['mpic_border_width']?>px"><?=$c_picture?></div></td>
			<td width="3px"></td>
		  <?php } ?>
			<td valign="top" align="left" style="padding:5px 5px 0px 6px;line-height:140%" class="han">
			  <?=$tInfo?>
			</td>
		  </tr></table>
		</td></tr>
	<tr><td height="5px">&nbsp;</td></tr>
	<tr><td class="lined"><img src="<?=$dir?>/t.gif" height="1px"></td></tr>
	</table>
<?php 
	}//using_articleInfo
?>
