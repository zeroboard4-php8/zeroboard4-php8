<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');
	if(empty($cidno)) $cidno = 0;
	$cidno++;
    if(!empty($_SS['using_hideComment']) && ($limitCommentOFF || $member['level']>$setup['grant_comment']))
		$hideComment = true;
	if(!empty($_SS['using_comment']) && empty($hideComment)) {
		if(!empty($_SS['using_commentEditor2'])) $cetime     = time()-(60*intval($_SS['using_commentEditor2'])); else $cetime     = time();

		$strShowIP = 
			!empty($_SS['using_market']) ? ' &nbsp;<span class="eng">IP:'.ereg_replace("(.*\.)(.*\.)(.*\.)(.*)","\\1\\2*.\\4",$c_data['ip']).'</span> ,' : '';

	    //언어묶음 읽어오기
	    $a_del = str_replace('del_comment.php','revol_del_comment.php',$a_del);
		if(empty($strLangFile_comment)) $strLangFile_comment = implode('', file($dir."/".$_SS['language_dir']."comment.php"));
		eval('?>'.$strLangFile_comment.'<?php ');

        //코멘트 편집
        $a_edit = '';
		$mode = $member['no']? 1 : 2;
		if(!empty($_SS['using_commentEditor']) && $c_data['reg_date'] > $cetime && (!$c_data['ismember'] || $member['no'] == $c_data['ismember'])) 
          $a_edit = "<span onClick=\"comment_edit('cid$cidno','{$c_data['no']}',$mode)\" style=\"cursor:pointer\">$_strSkin[cmtEdit]</span>";

        //락 걸기
        if($is_admin && !isset($using_commentMD) && !empty($_SS['using_commentMultiDelete']) && $data['total_comment'] >= $_SS['commentMD_Value'] && ($licStatus == 1 || $licStatus == 3)) $using_commentMD = true;
        if(!empty($using_commentMD)){
            $a_lock  = '';
            $on_off  = $c_data['is_lock']  ? 'on' : 'off';
            $command = "comment_lock(this, '$id', $no, {$c_data['no']})";
            $a_lock  = "&nbsp;<img src='$dir/images/lock_$on_off.gif' align='absmiddle' style='border:0px; cursor:pointer'onClick=\"$command\">";
        }

        //계층형 코멘트
        $a_creply   = '';
		$strHiddenClass = $c_data['mother'] ? ' class="hidden"' : '';
		$depth = $c_data['depth'] + 1;
		if($member['level'] <= $setup['grant_comment'] && empty($limitCommentOFF) && $c_replyMode) 
          $a_creply = "<span onclick=\"return reComment_edit('cid$cidno','{$c_data['no']}',$mode,$depth)\" style=\"cursor:pointer\">$_strSkin[cmtReply]</span>";
		if(empty($comment_count)) $comment_count = 0;
		$comment_count++;
		if(!eregi("<br/>",$c_memo)) $c_memo = str_replace("\n","<br/>",$c_memo);

        $c_data['name'] = stripslashes($c_data['name']);

		if(!empty($skin_setup['using_hideNickname']) || (!empty($_SS['using_market']) && !empty($_SS['marketMode_hideUser']) && $data['ismember'] != $member['no'])) {
			$comment_name = get_hiddenNickname().$strShowIP;
			unset($c_face_image);
		} else {
			$comment_name = str_replace(">".$c_data['name'],"><span class=\"view_name\">".$c_data['name']."</span>",$comment_name)."</b>";
		}

	  // 등수 표시
		if(!empty($_SS['using_cmtRanking'])) 
		{
			if(empty($cmtRanking)) $cmtRanking=0;
			$cmtRanking++;
			$cetime = time()-(60*60*6);
			$cmtHiright = ($c_data['reg_date'] > $cetime) ? ' list_comment2' : '';
			$strCmtRanking = "<span class=\"list_comment$cmtHiright\">$cmtRanking</span>";
		}

		// 코멘트 작성자의 프로필 사진 가져오기
		$c_picture = get_memberPicture($c_data['ismember'], $dir."/$_SS[css_dir]",$_SS['member_picture_x'],$_SS['member_picture_y']);

		$c_picWidth = $_SS['member_picture_x'];

		$reCommentDepthPixel = !empty($_SS['using_memberPicture']) ? (intval($c_picWidth) / 2) : 0;
?>
<?php if($c_replyMode){?>
	<div id="commentHidden<?=$c_data['no']?>"<?=$strHiddenClass?>>
<?php }?>
		<div class="vSpacer"></div>
		<div class="separator1" style="height:1px;font-size:1px"><?=$blank_Image?></div>
		<table border="0" width="100%" cellspacing="0" cellpadding="0" class="info_bg">
		<tr valign="top">
		  <?php if(!empty($_SS['using_memberPicture'])) {?>
			<td width="<?=(intval($c_picWidth)+10)?>px" align="center">
			  <div class="separator2" style="padding:<?=$_SS['mpic_border_width']?>px"><?=$c_picture?></div>
			</td>
			<td width="3px"></td>
		  <?php } ?>
			<td style="padding:2px 0 4px 5px" align="left">
			  <span id="cTitle<?=$c_data['no']?>" style="line-height:200%">
			  <?=!empty($strCmtRanking)?$strCmtRanking:''?><?=!empty($c_face_image)?$c_face_image:''?> <?=!empty($comment_name)?$comment_name:''?></b>
			  &nbsp;&nbsp;<font class="eng"><?=date("Y-m-d",$c_data['reg_date'])?> <?=date("H:i:s",$c_data['reg_date'])?></font>
			  <?php if($c_replyMode) echo $a_creply?><?php if(!ereg("<Zeroboard ",$a_del)) {?> <?=$a_edit?> <?=$bt_cdel?><?php }?><?php if($is_admin&&isset($a_lock)) echo $a_lock?></span>
			  <div style="height:1px" class="separator2"><?=$blank_Image?></div>
			  <table width="100%" cellpadding="0" cellspacing="0" id="dq_textContents_comment"><tr><td id="cid<?=$cidno?>" align="left" class="han" style="padding-top:4px"><?=$c_memo?></td></tr></table>
			</td>
		</tr>
		</table>
<?php if($c_replyMode){?>
		<div id="reComment<?=$c_data['no']?>" class="hidden"></div>
	</div>
<?php }?>

<?php 
if($c_replyMode){
//	$strAlign_reComment .= "align_reComment($c_data['no'],$c_data['mother'],$c_data['depth'],$reCommentDepthPixel);\n";
	$strAlign_reComment .= 
      "addEvent(window,'load',function() {align_reComment({$c_data['no']},{$c_data['mother']},{$c_data['depth']},$reCommentDepthPixel)})\n";}
}
$dqEngine['thumb_resize'] = '';
?>
