<?php 
if(eregi(basename(__FILE__),$PHP_SELF)) die('정상적인 접근이 아닙니다');

	if(!$setup['use_alllist']) $_zb_exec="view.php"; else $_zb_exec="zboard.php";

// 코멘트 재설정
	$comment_css = (get_newComment($data['no']))? 'list_comment2' : 'list_comment';
	$comment_num = ($comment_num) ? '&nbsp;<span class="'.$comment_css.'">'.$data['total_comment'].'</span>' : '';
	//$comment_num = ($comment_num) ? "&nbsp;<span class=list_comment>$comment_num </span>" : '';

// 제목 재설정
	$bgm = is_mediafile($data['sitelink1'])? '<font class="han" style="font-size:10pt">&nbsp;♬</font>' : '';
	if(!empty($skin_setup['using_newicon'])) 
		$new_icon  = ($data['reg_date'] > (time() - (60*60*$skin_setup['using_newicon2']))) ? '&nbsp;<img src="'.$_css_dir.'icon_new.gif" align="absmiddle">' : '';
	else
		$new_icon  = '';
	$chk_subj	= cut_str($data['subject'],$setup['cut_length']);
	$subject	= str_replace(" >$chk_subj"," ><span class=\"list_title\">$chk_subj</span>",$subject).$bgm.$comment_num.$new_icon;
	if(!$skin_setup['using_subjicon'] && $data['is_secret'] && !$skin_setup['using_secretonly']) 
		$subject = str_replace("class=\"list_title\">","class=\"list_title\">['<span class=han2>비밀글</span>'] ",$subject);

// 이름 재설정
	$name = str_replace('<div ','<span ',str_replace('/div>','/span>',$name));
	$name = str_replace(">{$data['name']}<","><span class=\"list_name\">{$data['name']}</span><","$name");
	if(eregi('<b>',$face_image)) $name = $name.'</b>';

// 재설정
	$number		= str_replace(".gif",".gif height=\"13px\"",$number);
	$reg_date	= date('Y-m-d',$data['reg_date']);
	if($skin_setup['using_subjicon']) {
		$icon		= str_replace(".gif",".gif height=\"13px\"",$icon);
		$icon		= str_replace($dir.'/',$_css_dir,$icon);
	} else $icon = '';

// 글쓴이가 오른쪽으로 갈 때 카테고리에 공백 추가
    if(!empty($_ss_['using_titlebar2']) && empty($_ss_['move_name'])) $category_name .= '&nbsp;&nbsp;';

// 썸네일 설정
	$dqEngine['thumb_resize'] = isset($skin_setup['thumb_resize'])? $skin_setup['thumb_resize']	: 0;
	if(!empty($data['depth']) && !empty($skin_setup['using_thumbnail'])) {
		$thumb_area_space = ($skin_setup['thumb_imagex']/5)*$data['depth'] + ($data['depth']*10);
		$insert = ''; // 들여쓰기 초기화
	}

// 섬네일 가져오기
	if(!empty($skin_setup['using_thumbnail'])) {
		$thumb_padding="0 5px 0 0";
		$_thumb_bgcolor = "white";
		include $dir."/include/get_thumbnail.php";
	} else {
		$_line_height = '16';
	}

	$m_data=@mysql_fetch_array(zb_query("select is_vdel from dq_revolution where zb_id='$id' and zb_no='{$data['no']}'"));
	$is_vdel = !empty($m_data['is_vdel']) ? $m_data['is_vdel'] : null;

	if(isset($is_vdel)) {
		$subject = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\"><font class=\"list_title\">$_strSkin[is_vdel]</font></a>";
		$data['memo'] = '';
	}

// 파일 아이콘
	$file_icon = '';
	if(!$is_vdel && !$data['is_secret'] && !empty($_ss_['using_titlebar8'])) $file_icon = getFileIcon();

// 짧은 본문내용
	if(!empty($skin_setup['using_shortmemo'])) {
		unset($_smemo);
		$subject = str_replace("class=\"list_title\">","class=\"color_h\">",$subject);
		if(!$is_vdel && $skin_setup['using_shortmemo'] && !$data['is_secret']) {
			if($data['memo'] && trim(strip_tags($data['memo'])) != '.') {
				$dwidth = $data['depth'] ? (19+(5*$data['depth'])-7):0;
				//$dwidth = $skin_setup['using_subjicon'] ? $dwidth+15 : $dwidth;
				$dwidth .= 'px';
				$_smemo = str_replace("&nbsp;","",stripslashes(strip_tags($data['memo'])));
				$_smemo = cut_str($_smemo,$skin_setup['smemo_maxlen']);
				$_smemo = "<div  class=\"color_d small_han\" style=\"padding:3px 0 5px $dwidth;line-height:135%\">$_smemo</div>";
			}
		}
	}

// 제목아래 게시물 정보 출력
	if(!empty($skin_setup['using_shortinfo'])) {
		unset($shortinfo);
		if(!$data['is_secret']) $subject = str_replace("class=\"list_title\">","class=\"color_h\">",$subject);
		//$dwidth2 = $dwidth ? $dwidth : ($data['depth'] ? (19+(5*$data['depth'])-7):0);
		//$dwidth2 = $skin_setup['using_subjicon'] ? $dwidth2+15 : $dwidth2;
		$dwidth2 = '0';
		$shortinfo = '<div>'.$insert.'<span style="padding:3px 10px 0 '.$dwidth2.'px;line-height:135%" class="eng color_d">등록일: '.$reg_date.' &nbsp; 조회수: '.$hit;
		$shortinfo .= '</span></div>';
		$subject = $subject.'&nbsp;- '.$face_image.'<span class="list_name">'.$name.'</span>';
	}

// 공지사항이 출력 되었다면 구분선을 넣는다.
	if(!empty($_notice_display)) {
		unset($_notice_display);
?>
	<tr><td colspan="<?=$colspan?>" class="line_shadow"></td></tr>
<?php 	}?>

<?php if($coloring) {?><tr><td colspan="<?=$colspan?>" class="line_separator" height="1px"></td></tr><?php }?>
<tr align="center" class="list<?=$coloring%2?>" onMouseOver="this.style.backgroundColor='<?=$skin_setup['over_color']?>'" onMouseOut="this.style.backgroundColor=''" style="height:<?=$_line_height?>;word-break:break-all;" valign="<?=$list_valign?>">
	<?php if(!empty($_ss_['using_titlebar1'])){?><td class="eng list_vspace" colspan="2"><?=str_replace($dir.'/',$_css_dir,$number)?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><td class="han list_vspace" nowrap colspan="2"><nobr><?=$category_name?></nobr></td><?=$hide_category_end?><?php }?>

	<?=$hide_cart_start?><td nowrap colspan="2" style="padding:0"><input type="checkbox" name="cart" value="<?=$data['no']?>"></td><?=$hide_cart_end?>

	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" class="list_vspace" align="left"><div style="width:<?=$skin_setup['namedsp_width']?>px;overflow:hidden;text-overflow:ellipsis" class="list_name"><nobr>&nbsp;<?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><td align="left" class="list_vspace">
	<?php if(!empty($skin_setup['using_thumbnail'])) {?>
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="table-layout:fixed">
	<tr>
	  <?php if(!empty($data['depth'])){ ?><td width="<?=$thumb_area_space?>"></td><?php } ?>
	  <td align="<?=$skin_setup['thumb_align']?>" valign="top" width="<?=($skin_setup['thumb_imagex'] + 10)?>px" style="padding:<?=$thumb_padding?>"><?=$_thumbnail_tag?></td>
	  <td valign="<?=$list_valign2?>">
	<?php }?>
	  <?=$insert?><?=$icon?><?=$subject?><?=isset($shortinfo)?$shortinfo:''?><?=isset($_smemo)?$_smemo:''?>
	<?php if(!empty($skin_setup['using_thumbnail'])) {?>
	  </td></tr></table></td>
	<?php }?>
	<?php }?>

	<?php if(!empty($_ss_['using_titlebar8'])){?><td class="eng list_vspace" colspan="2"><?=$file_icon?></td><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" class="list_vspace"><div style="width:<?=$skin_setup['namedsp_width']?>px;overflow:hidden;text-overflow:ellipsis" class="list_name"><nobr><?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><td class="eng list_vspace" colspan="2"><?=$reg_date?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><td class="eng list_vspace" colspan="2"><?=$vote?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><td class="eng list_vspace" colspan="2"><?=$hit?></td><?php }?>
</tr>

<?php $coloring++;?>
<?=isset($hiddenSlide)?$hiddenSlide:''?>
<?php 
// 썸네일 설정
	$dqEngine['thumb_resize'] = '';
?>
