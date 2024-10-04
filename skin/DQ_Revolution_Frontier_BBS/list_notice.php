<?php 
// 코멘트 재설정
	$comment_css = (get_newComment($data['no']))? 'list_comment2' : 'list_comment';
	$comment_num = ($comment_num) ? '&nbsp;<span class="'.$comment_css.'">'.$data['total_comment'].'</span>' : '';
	//$comment_num = ($comment_num) ? "&nbsp;<span class=list_comment>$comment_num </span>" : '';

// 제목 재설정
	$bgm = is_mediafile($data['sitelink1'])? "<font class=han style='font-size:10pt;'>&nbsp;♬</font>" : '';
	if(!empty($skin_setup['using_newicon'])) 
		$new_icon  = ($data['reg_date'] > (time() - (60*60*$skin_setup['using_newicon2']))) ? '&nbsp;<img src="'.$_css_dir.'icon_new.gif" align="absmiddle">' : '';
	else
		$new_icon  = '';
	$chk_subj	 = cut_str($data['subject'],$setup['cut_length']);
	$subject	 = str_replace(" >$chk_subj"," ><font class=\"list_title\">$chk_subj</font>",$subject).$bgm.$comment_num.$new_icon;
	if(!$skin_setup['using_subjicon'] && $data['is_secret'] && !$skin_setup['using_secretonly']) $subject = str_replace("class=\"list_title\">","class=\"list_title\">[<span class=\"han2\">비밀글</span>] ",$subject);

// 파일 아이콘
	$file_icon = '';
	if(empty($is_vdel) && empty($data['is_secret']) && !empty($_ss_['using_titlebar8'])) $file_icon = getFileIcon();

// 재설정
	$name		= str_replace(">$data[name]<","><span class=\"list_name\">$data[name]</span><","$name");
	if(eregi('<b>',$face_image)) $name = $name.'</b>';
	$number = str_replace(".gif",".gif height=\"13px\"",$number);
	$reg_date = date('Y-m-d',$data['reg_date']);
	if($skin_setup['using_subjicon']) {
		$icon		= str_replace(".gif",".gif height=\"13px\"",$icon);
		$icon		= str_replace($dir.'/',$_css_dir,$icon);
	} else $icon = '';

	$_line_height = '16';

	if(!empty($_notice_display)) {?>

<?php if($_notice_display) {?><tr><td colspan="<?=$colspan?>" class="line_separator" height="1px"></td></tr><?php }?>
<tr><td colspan=\"<?=$colspan?>\" class=\"notice_separator\" height=\"1px\"></td></tr>
<?php }?>
<tr align="center" valign="<?=$list_valign?>" class="list_notice" onMouseOver="this.style.backgroundColor='<?=$skin_setup['over_color']?>'" onMouseOut="this.style.backgroundColor=''" height="<?=$_line_height?>" style="word-break:break-all">
	<?php if(!empty($_ss_['using_titlebar1'])){?><td class="han list_vspace" colspan="2"><?=$str_notice?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar2'])){?><?=$hide_category_start?><td colspan="2" class="list_vspace">-</td><?=$hide_category_end?><?php }?>
	<?=$hide_cart_start?><td align="center" colspan="2" style="padding:0" nowrap><input type="checkbox" name="cart" value="<?=$data['no']?>"></td><?=$hide_cart_end?>
	<?php if(!empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" nowrap align="left" class="list_vspace"><div style="width:<?=$skin_setup['namedsp_width']?>px;overflow:hidden;text-overflow:ellipsis" class="list_name"><nobr>&nbsp;<?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar3'])){?><td align="left" class="list_vspace"><?=$insert?><?=$icon?><?=$subject?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar8'])){?><td nowrap class="eng list_vspace" colspan="2"><nobr><?=$file_icon?></nobr></td><?php }?>
	<?php if(empty($_ss_['move_name']) && !empty($_ss_['using_titlebar4'])){?><td colspan="2" class="list_vspace"><div style="width:<?=$skin_setup['namedsp_width']?>px;overflow:hidden;text-overflow:ellipsis" class="list_name"><nobr><?=$face_image?><?=$name?></nobr></div></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar5'])){?><td nowrap class="eng list_vspace" colspan="2"><nobr><?=$reg_date?></nobr></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar6'])){?><td nowrap class="eng list_vspace" colspan="2"><?=$vote?></td><?php }?>
	<?php if(!empty($_ss_['using_titlebar7'])){?><td nowrap class="eng list_vspace" colspan="2"><?=$hit?></td><?php }?>
</tr>

<?php $_notice_display='1'?>
