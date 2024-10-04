<?php
if($data['headnum'] <= -2000000000 && !$skin_setup['using_noticecomment']) $skin_setup['using_comment'] = '';

if(!empty($skin_setup['using_comment']) && empty($limitCommentOFF)) 
{
    //언어묶음 읽어오기
    if(empty($strLangFile_comment)) require $dir."/".$_SS['language_dir']."comment.php";

    $c_name=str_replace("size=8 maxlength=10","size=\"12\" maxlength=\"20\"",$c_name);
	if($skin_setup['using_vote'] && $skin_setup['vote_type'] == "2" && $member['no']) {
		 $usine_voteEX = true;
		 $_target_comment = "revol_comment.php";
	} else $_target_comment = "revol_comment.php";

	$vote_msg = $_strSkin['vote'];
	$vote_type = "vote";

	if(@eregi(",".$member['no'].",",",".$vote_users[1])) {
		$already_vote="1";
		$vote_msg = $_strSkin['vote_cancel'];
		$vote_type = "remove_vote";
	}
	if(!empty($skin_setup['using_vote']) && !empty($skin_setup['coment_select']) && $skin_setup['coment_select'] == "2" && $member['no']) $already_vote="1";

	$_rSpacer = $_rSwidth + 40;
	$_lSpacer = $_lSwidth + 40;

	$comment_guide = str_replace("_NAME_","$this_name",$skin_setup['comment_guide']);
	$comment_guide = str_replace("_SMILE_","<img src=".$_css_dir."smile.gif />",$comment_guide);

// 보안코드를 입력 받아야 할지 결정
    if(!empty($_SS['using_secretCode'])) {
      if(!$member['no']) $need_secretCode = true;
      else {
        if($_SS['using_secretCodeValue1'] && $_SS['using_secretCodeValue1'] <= $member['level']) $need_secretCode = true;
        $_totalPoint = ($member['point1']*10) + $member['point2'];
        if($_SS['using_secretCodeValue2'] && $_SS['using_secretCodeValue2'] >= $_totalPoint ) $need_secretCode = true;
      }
    }
?>

<?php if(!empty($need_secretCode)){?>
<script type="text/javascript">var need_secretCode = true</script>
<?php }?>

	<table id="table_write" border="0" cellspacing="0" cellpadding="0" width="100%" class="info_bg">
	<tr>
	  <td width="<?=$_lSwidth?>"></td>
	  <td>
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr><td class="info_bg" style="height:10px"></td></tr>
	  <?php if(!empty($comment_count) || !empty($skin_setup['show_articleInfo'])) {?>
		<tr><td class="lined"><?=$blank_Image?></td></tr>
	  <?php } ?>
		</table>
		<table border="0" cellspacing="0" cellpadding="0" width="100%" class="info_bg">
		<tr><td class="info_bg" style="height:10px"></td></tr>
		<tr>
		  <td valign="top" style="padding-top:8px" width="30px">&nbsp;</td>
		  <td align="left"><font class="thumb_han" style="line-height:160%"><?=$comment_guide?></font></td>
		</tr>
		</table>
	  </td>
	  <td width="<?=$_rSwidth?>px"></td>
	</tr>
	</table>

	<form method="post" name="zbform" action="<?=$_target_comment?>" style="display:inline" onsubmit="return chk_commentSubmit('memo')">
	<input type="hidden" name="page" value="<?=$page?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="no" value="<?=$no?>" />
	<input type="hidden" name="select_arrange" value="<?=$select_arrange?>" />
	<input type="hidden" name="desc" value="<?=$desc?>" />
	<input type="hidden" name="page_num" value="<?=$page_num?>" />
	<input type="hidden" name="keyword" value="<?=$keyword?>" />
	<input type="hidden" name="category" value="<?=$category?>" />
	<input type="hidden" name="sn" value="<?=$sn?>" />
	<input type="hidden" name="ss" value="<?=$ss?>" />
	<input type="hidden" name="sc" value="<?=$sc?>" />
	<input type="hidden" name="su" value="<?=$su?>" />
	<input type="hidden" name="mode" value="<?=$mode?>" />
	<input type="hidden" name="uniqNo" value="<?=$uniqNo?>" />
	<input type="hidden" name="tprev" value="<?=$data['prev_no']?>" />
	<input type="hidden" name="tnext" value="<?=$data['next_no']?>" />

<?php if(!empty($need_secretCode)){?>
    <div id="need_secretCode">
        <div style="background-color:#505050;color:#DDD;padding:10px;font-weight:bold">보안코드 입력</div>
        <div align="center" style="margin:10px 0 10px 0">
          <img src="<?=$dir?>/plug-ins/kcaptcha/?<?=session_name()?>=<?=session_id()?>&uniqNo=<?=$uniqNo?>" />
        </div>
        <div>스팸글 방지를 위해 보안코드를 필요로 합니다.<br />위 그림에 보이는 글자를 아래 칸에 입력하세요.</div>
        <div style="padding-top:5px" align="center">
          <div style="width:100px;padding:5px;border:2px solid #707070;background-color:#FFF">
            <input type="text" name="secret_code" size="12" style="border:0;background-color:#FFF;color:#000;text-align:center;font-weight:bold;" />
          </div>
          <div style="margin-top:10px;border-top:2px solid #b0b0b0;padding-top:5px"><input type="submit" value="확인" style="padding:5px" onclick="return chk_commentSubmit()" /></div>
        </div>
    </div>
<?php }?>

<?php if(!empty($skin_setup['using_weditor']) && !empty($skin_setup['WEditor_dir'])) {?>
	<table border="0" cellspacing="0" cellpadding="0" class="info_bg" width="100%">
	<tr><td id="write_options" style="padding-left:<?=($_lSpacer)?>px;text-align:left">
		<input type="checkbox" name="use_weditor" value="1" id="chk_weditor" onClick="wEditorCall('',this)" /><?=$_strSkin['cUseWeditor']?>
	</td></tr></table>
<?php }?>
	<table border="0" cellspacing="0" cellpadding="0" class="info_bg" width="100%" style="table-layout:fixed">
	<tr>	
		<td valign="top" style="padding:8px 5px 0 0" width="<?=$_lSpacer?>px" align="right">
		  <span id="cMemo_controller">
		  <font class="taSizeBT" onclick="document.zbform.memo.rows=6;document.zbform.memo.focus();" style="cursor:pointer;padding-top:3px;" title="<?=$_strSkin['org_memo']?>">-</font><br>
		  <font class="taSizeBT" onclick="document.zbform.memo.rows=document.zbform.memo.rows+4;document.zbform.memo.focus();" style="cursor:pointer;padding-top:3px;" title="<?=$_strSkin['exp_memo']?>">+</font>
		  </span>
		</td>
		<td>
			<table border="0" cellspacing="2" cellpadding="0" width="100%" height="100%">
			<tr>
			  <td><textarea id="memo" name="memo" cols="20" rows="6" class="textarea" style="width:100%"><?=!empty($cmemo)?$cmemo:''?></textarea></td>
			  <td width="<?=$_rSpacer?>px" align="center" style="padding:1px 0 1px 0"></td>
			</tr>

			<?php if(!empty($usine_voteEX)){?>
			<tr>
			  <td>
				<table border="0" cellspacing="2" cellpadding="0" width="100%" height="100%" style="table-layout:fixed">
				<tr>
				  <td>&nbsp;</td>
				  <td width="115px" align="left">
					<input name="ment_type" type="radio" value="<?=$vote_type?>" <?php if($member['no']!=$data['ismember'] && empty($already_vote)) echo "checked"?>><?=$vote_msg?><br>
					<input name="ment_type" type="radio" value="ment" <?php if($member['no']==$data['ismember'] || !empty($already_vote)) echo "checked"?>><?=$_strSkin['only_memo']?> </td>
				  <td width="85px" style="padding-top:4px" align="left"><?php
				if(!eregi(".gif",$_strSkin['save_commentEX'])) echo "<input type=\"submit\" rows=\"5\" class=\"submit_c\"  name=\"reply_vote\" value=\"$_strSkin[save_commentEX]\" accesskey=\"s\" style=\"height:38px;width:80px\" onSubmit=\"chk_comment_submit('memo')\">";
				else echo "<input type=\"image\" src=\"$_strSkin[save_commentEX]\" name=\"reply_vote\" accesskey=\"s\" onsubmit=\"return chk_comment_submit('memo')\">";
				?></td>
				</tr></table>
			  </td>
			  <td>&nbsp;</td>
			</tr>		  

			<?php } elseif($member['no']) {?>
			<tr>
			  <td align="right" style="padding:4px 8px 0 0" align="left"><?php
				if(!eregi(".gif",$_strSkin['save_comment'])) echo "<input type=\"submit\" rows=\"5\" class=\"submit_c\"  name=\"reply_vote\" value=\"$_strSkin[save_comment]\" accesskey=\"s\" style=\"height:28px;width:80px\" onSubmit=\"chk_comment_submit('memo')\">";
				else echo "<input type=\"image\" src=\"$_strSkin[save_comment]\" name=\"reply_vote\" accesskey=\"s\" onsubmit=\"return chk_comment_submit('memo')\">";
				?></td>
			  <td>&nbsp;</td>
			</tr>
			<?php }?>
			</table>
		</td>
	</tr>
	<?php if(!$member['no']){?>
	<tr>
		<td width="<?=$_lSwidth?>px" align="right">&nbsp;</td>
		<td>
		  <table border="0" cellspacing="2" cellpadding="0" height="100%" align="right">
			<tr>
				<td align="right"><?=$_strSkin['name']?>&nbsp;</td>
				<td><?=$c_name?></td>
				<td align="right">&nbsp;&nbsp;<?=$_strSkin['password']?>&nbsp;</td>
				<td><input type="password" name="password" size="12" maxlength="20" class="input"></td>
				<td><?php
				if(!eregi(".gif",$_strSkin['save_comment'])) echo "<input type=\"submit\" rows=\"5\" class=\"submit_c\"  name=\"reply_vote\" value=\"$_strSkin[save_comment]\" accesskey=\"s\" style=\"height:28px;width:80px\">";
				else echo "<input type=\"image\" src=\"$_strSkin[save_comment]\" name=\"reply_vote\" accesskey=\"s\">";
				?></td>
				<td width="<?=$_rSpacer?>px" align="right">&nbsp;</td>
			</tr>
		  </table>
		</td>
	</tr>
	<?php }?>
	<tr><td class="info_bg" style="height:20px"></td></tr>
	</table>
	</form>

	<?php
	//$_miniwiniEditor_incFile = './miniwini.visualEditor.php';
	//if(file_exists($_miniwiniEditor_incFile)) include $_miniwiniEditor_incFile;
	?>

<?php } ?>
