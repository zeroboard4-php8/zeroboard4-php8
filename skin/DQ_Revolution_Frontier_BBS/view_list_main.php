<?php 
if(eregi(basename(__FILE__),$PHP_SELF)) die('정상적인 접근이 아닙니다');

	if(!$setup['use_alllist']) $_zb_exec="view.php"; else $_zb_exec="zboard.php";

// 코멘트 재설정
	$css = (get_newComment($data['no']))? 'list_comment2' : 'list_comment';
	$comment_num = ($comment_num) ? '&nbsp;<font class='.$css.'> '.$data['total_comment'].' </font>' : '';
	//$comment_num = ($comment_num) ? "&nbsp;<font class=list_comment>$comment_num</font>" : '';

// 제목 재설정
	$bgm = is_mediafile($data['sitelink1'])? "<font class=\"han\" style=\"font-size:10pt\">&nbsp;♬</font>" : '';
	if(!isset($new_icon)) $new_icon='';
	if(!empty($skin_setup['using_newicon'])) $new_icon  = ($data['reg_date'] > (time() - (60*60*$skin_setup['using_newicon2']))) ? '&nbsp;<img src='.$_css_dir.'icon_new.gif align=absmiddle>' : '';
	$chk_subj	 = cut_str($data['subject'],$setup['cut_length']);
	$subject	 = str_replace(" >$chk_subj"," ><font class=\"list_title\">$chk_subj</font>",$subject).$bgm.$comment_num.$new_icon;
	if(empty($skin_setup['using_subjicon']) && !empty($data['is_secret']) && empty($skin_setup['using_secretonly'])) $subject = str_replace("class=\"list_title\">","class=\"list_title\">[<span class=\"han2\">비밀글</span>] ",$subject);
	$subject_padding="2 5 0 5";

// 재설정
	$name		= str_replace('>'.$data['name'].'<',"><font class=\"han\">{$data['name']}</font><","$name");
	$number		= str_replace(".gif",".gif height=\"13px\"",$number);
	$reg_date	= date('Y-m-d',$data['reg_date']);
	if($skin_setup['using_subjicon']) {
		$icon		= str_replace(".gif",".gif height=13px",$icon);
		$icon		= str_replace($dir.'/',$_css_dir,$icon);
	} else $icon = '';

// 섬네일 가져오기
	if($skin_setup['using_thumbnail']) {
		$subject_padding="0 5px 0 0";
		$_thumb_bgcolor = "white";
		include $dir."/include/get_thumbnail.php";
	} else {
		$_line_height = '16';
	}

	$m_data=@mysql_fetch_array(zb_query("select is_vdel from dq_revolution where zb_id='$id' and zb_no='{$data['no']}'"));
	$is_vdel = $m_data['is_vdel'];

	if($is_vdel) {
		$subject = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\"><font class=\"list_title\">$_strSkin[is_vdel]</font></a>";
		$data['memo'] = '';
	}

// 파일 아이콘
	$file_icon = '';
	if(!$is_vdel && !$data['is_secret'] && !empty($_ss_['using_titlebar8'])) $file_icon = getFileIcon();

// 짧은 본문내용
	unset($_smemo);
	if(!$is_vdel && !empty($skin_setup['using_shortmemo']) && !$data['is_secret']) {
		$subject = str_replace("class=\"list_title\">","class=\"han\" style=\"font-weight:bold\">",$subject);
		if($data['memo'] && trim(strip_tags($data['memo'])) != '.') {
			$dwidth = 15+($data['depth'] ? (19+(5*$data['depth'])-7):0);
			$_smemo = str_replace("&nbsp;","",stripslashes(strip_tags($data['memo'])));
			$_smemo = cut_str($_smemo,$skin_setup['smemo_maxlen']);
			$_smemo = "<br><div style='padding:3px 10ox 5px $dwidth;line-height:135%'>$_smemo</div>";
		}
	}

// 공지사항이 출력 되었다면 구분선을 넣는다.
	if(!empty($_notice_display)) {
		unset($_notice_display);
?>
	<tr><td colspan="<?=$colspan?>" class="line_dark" height="1px"></td></tr>
	<tr><td colspan="<?=$colspan?>" class="line_shadow" height="3px"></td></tr>
<?php 	}?>

<tr align="center" class="list<?=$coloring%2?>" onMouseOver="this.style.backgroundColor='<?=$skin_setup['over_color']?>'" onMouseOut="this.style.backgroundColor=''" style="height:<?=$_line_height?>;word-break:break-all;" valign="<?=$list_valign?>">
	<?php if(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><td class='han list_vspace' nowrap colspan="2"><nobr><?=$category_name?></nobr></td><?=$hide_category_end?><?php }?>

	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" class="list_vspace" align="left"><div style="width:<?=$skin_setup['namedsp_width']?>;overflow:hidden;text-overflow:ellipsis"><nobr><?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><td align="left" nowrap class="list_vspace">

	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="table-layout:fixed">
	<tr>
	<?php if(!empty($skin_setup['using_thumbnail'])) {?>
	  <td align="<?=$skin_setup['thumb_align']?>" valign="top" width="<?=($skin_setup['thumb_imagex'] + 15)?>" style="padding:<?=$subject_padding?>"><?=$_thumbnail_tag?></td>
	<?php }?>
	  <td valign="<?=$list_valign?>"><?=$insert?><?=$icon?><?=$subject?><?=!empty($_smemo)?$_smemo:''?></td>
	</tr></table></td><?php }?>

	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" class="list_vspace"><div style="width:<?=$skin_setup['namedsp_width']?>px;overflow:hidden;text-overflow:ellipsis'><nobr><?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><td nowrap class="eng list_vspace" colspan="2"><nobr><?=$reg_date?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><td nowrap class="eng list_vspace" colspan="2"><?=$vote?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><td nowrap class="eng list_vspace" colspan="2"><?=$hit?></td><?php }?>
</tr>
<tr><td colspan="<?=$colspan?>" class="line_separator" height="1px"></td></tr>

<?php $coloring++;?>
