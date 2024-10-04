<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');

if($_SS['show_articleInfo']) 
{
	$_SS['PNthumbnailSize_x'] = !empty($_SS['PNthumbnailSize_x']) ? $_SS['PNthumbnailSize_x'] : $_SS['thumb_imagex'];
	$_SS['PNthumbnailSize_y'] = !empty($_SS['PNthumbnailSize_y']) ? $_SS['PNthumbnailSize_y'] : $_SS['thumb_imagey'];

// 글 작성자의 프로필 사진 가져오기
	if(empty($_SS['member_picture_x']) && empty($_SS['member_picture_y'])) $_mb_picture_share = '1';
	if(!empty($_mb_picture_share)) $c_picWidth = 100; else $c_picWidth = $_SS['member_picture_x'];

	$c_picture = get_memberPicture($data['ismember'], $dir.'/'.$_SS['css_dir'], $_SS['member_picture_x'], $_SS['member_picture_y']);

	if($_SS['using_vote'] && $_SS['vote_type'] == "1" &&  $member['no'] != $data['ismember']) $using_vote = true;

	// 내용스크립트 치환
	    include $dir."/include/analysis_02.php";

	// 썸네일 설정
		$dqEngine['thumb_resize'] = isset($_SS['thumb_resize'])? $_SS['thumb_resize']	: 0;
		$_SS['mpic_border_width'] = isset($_SS['mpic_border_width'])? $_SS['mpic_border_width'] : 5;

		// 목록의 썸네일 설정과 이전&다음사진 썸네일의 크기 설정이 같다면 AlphaLoader 호출하지않음
		if($_SS['thumb_imagex'] != $_SS['PNthumbnailSize_x'] || $_SS['thumb_imagey'] != $_SS['PNthumbnailSize_y'])
			$strAddAlphaLoader = 'onload="call_AlphaImageLoader(this)" ';

        $_gd_support = get_support_GD_type();
        if(eregi("\.jpg",$_gd_support)) $ext = '.jpg';
        elseif(eregi("\.png",$_gd_support)) $ext = '.png';
        elseif(eregi("\.gif",$_gd_support)) $ext = '.gif';

        $thumbnail_dir  = !empty($prev_data['reg_date']) ? 'data/_RV_Thumbnail_Files_/'.$id.'/'.date('Y',$prev_data['reg_date']).'/'.date('m',$prev_data['reg_date']) : 'data/_RV_Thumbnail_Files_/'.$id.'/';
        $prev_thumbnail = !empty($prev_data['no']) ? $thumbnail_dir.'/small_'.$prev_data['no'].$ext : '';
		$thumbnail_dir  = !empty($next_data['reg_date']) ? 'data/_RV_Thumbnail_Files_/'.$id.'/'.date('Y',$next_data['reg_date']).'/'.date('m',$next_data['reg_date']) : 'data/_RV_Thumbnail_Files_/'.$id.'/';
        $next_thumbnail = !empty($next_data['no']) ? $thumbnail_dir.'/small_'.$next_data['no'].$ext : '';
		if(!empty($prev_data['no']) && !file_exists($prev_thumbnail)) 
			$tmpThumbnail = get_thumbTag($prev_data,$_SS['thumb_imagex'],$_SS['thumb_imagey'],$prev_thumbnail);
		if(!empty($next_data['no']) && !file_exists($next_thumbnail)) 
			$tmpThumbnail = get_thumbTag($next_data,$_SS['thumb_imagex'],$_SS['thumb_imagey'],$next_thumbnail);
?>

<table border="0" cellspacing="0" cellpadding="0" width="<?=$width?>" class="info_bg">
<tr>
	<td valign="top" style="padding:0 <?=$_rSwidth?>px 0 <?=$_lSwidth?>px">
	  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed">
	  <tr>
	  <?php if($_SS['using_memberPicture']) {?>
		<td valign="top" width="<?=($c_picWidth+10)?>" align="center"><div class="separator2" style="padding:<?=$_SS['mpic_border_width']?>px"><?=$c_picture?></div></td>
		<td width="3"></td>
	  <?php } ?>
		<td valign="top" nowrap style="padding:5px 5px 5px 6px;line-height:140%;" class="han" align="left">
		  <?=$tInfo?>
		</td>
<?php 
if(!$use_alllist && $enable_pn_list && $_SS['using_thumbnail']) {
	if(!empty($prev_data['no'])||!empty($next_data['no'])) {
		if(empty($strAddAlphaLoader)) $strAddAlphaLoader='';
		if(!empty($prev_data['no'])) {
			//섬네일 생성
			$cal_size = cal_thumb_size($prev_thumbnail,$_SS['PNthumbnailSize_x'],$_SS['PNthumbnailSize_y']);
			$prev_thumb_tag = '<img src="'.$prev_thumbnail.'" width="'.$cal_size[0].'" height="'.$cal_size[1].'" border="0" '.$strAddAlphaLoader.' />';
			$prev_space = $cal_size[0]+10;
			if ($prev_space < 50) $prev_space=50;
		}

		if (!empty($next_data['no'])) {
			//섬네일 생성
			$cal_size = cal_thumb_size($next_thumbnail,$_SS['PNthumbnailSize_x'],$_SS['PNthumbnailSize_y']);
			$next_thumb_tag = '<img src="'.$next_thumbnail.'" width="'.$cal_size[0].'" height="'.$cal_size[1].'" border="0" '.$strAddAlphaLoader.' />';
			$next_space = $cal_size[0]+10;
			if ($next_space < 50) $next_space=50;
		}
	}
	?>

		<?php if (!empty($prev_data['no'])||!empty($next_data['no'])) {?>

		<td style="width:3px" class="separator2"></td>
		  <?php if (!empty($prev_data['no'])) {?>
			  <td valign="top" width="<?=$prev_space?>"px style="padding:0 0 5px 5px" align="left">
			  <?=$bt_iprev?>
			  <table cellpadding="0" cellspacing="0" border="0">
				<tr><td valign="top">
				<?php echo "\n<a href=\"$_zb_exec?$href&$sort&no={$prev_data['no']}\" onfocus=\"blur()\">$prev_thumb_tag</a>\n</td></tr></table>"?>
				<img src="<?=$dir?>/t.gif" height="2"><br />
				<?php if(eregi("[subj]",$tInfo) && trim($prev_data['subject']) != ".") echo "<a href=\"$_zb_exec?$href&$sort&no={$prev_data['no']}\" onfocus=\"blur()\"><font class=\"thumb_list_title\">".cut_str(stripslashes($prev_data['subject']),$setup['cut_length'])."</font></a>"?>
			  </td>
		  <?php }?>

		  <?php if (!empty($next_data['no'])){?>
			  <td valign="top" width="<?=$next_space?>" style="padding:0 0 5px 5px" align="left">
			  <?=$bt_inext?>
			  <table cellpadding="0" cellspacing="0" border="0">
				<tr><td valign="top">
				<?php echo "\n<a href=\"$_zb_exec?$href&$sort&no={$next_data['no']}\" onfocus=\"blur()\">$next_thumb_tag</a>\n</td></tr></table>"?>
				<img src="<?=$dir?>/t.gif" border="0" height="2"><br>
				<?php if(eregi("[subj]",$tInfo) && trim($next_data['subject']) != ".") echo "<a href=\"$_zb_exec?$href&$sort&no={$next_data['no']}\" onfocus=\"blur()\"><font class=\"thumb_list_title\">".cut_str(stripslashes($next_data['subject']),$setup['cut_length'])."</font></a>"?>
			  </td>
		  <?php 
		  }//다음사진?>
	
<?php 	}//이전사진, 다음사진
}//$enable_pn_list
?>

	  </tr></table>
	</td></tr>
</table>
<?php 
}//using_articleInfo

// 썸네일 설정 초기화
	unset($dqEngine['thumb_resize']);
?>
