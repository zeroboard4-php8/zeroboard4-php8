<form method="post" name="write" action="comment_ok.php" onsubmit="return check_comment_submit(this)">
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="no" value="<?=$no?>" />
<input type="hidden" name="select_arrange" value="<?=$select_arrange?>" />
<input type="hidden" name="desc" value="<?=$desc?>" />
<input type="hidden" name="page_num" value="<?=$page_num?>" />
<input type="hidden" name="keyword" value="<?=$keyword?>" />
<input type="hidden" name="category" value="<?=$category?>" />
<input type="hidden" id="sn" name="sn" value="<?=$sn?>" />
<input type="hidden" id="ss" name="ss" value="<?=$ss?>" />
<input type="hidden" id="sc" name="sc" value="<?=$sc?>" />
<input type="hidden" name="mode" value="<?=$mode?>" /> 

	<table class="xe_W_comTb" width="100%" cellSpacing="0" cellpadding="0">
		<?php if(!$member['no']){?>
		<tr>
			<td class="xe_W_com_guest">
			글쓴이 : <?=$c_name?> <?=$hide_c_password_start?>비밀번호 : <input type="password" name="password" maxlength="20" /><?=$hide_c_password_end?></td>
		</tr>
		<?php }?>

		<tr>
			<td class="xe_W_com_write"><textarea name="memo"></textarea></td>
		</tr>

		<tr>
			<td class="xe_W_com_writeBtn">
			<span class="button"><input type="submit" value="댓글등록" accesskey="s" title="댓글등록" /></span></td>
		</tr>
	</table>
</form>
