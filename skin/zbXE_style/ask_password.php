<center>
<p>&nbsp;</p>
<form method="post" name="delete" action="<?=$target?>">
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
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="c_no" value="<?=$c_no?>" />

<style type="text/css"  media="all">
.askTb {background-color:#fff; table-layout: fixed; border:1px solid #E0E1DB}
.askTitle {background-color:#fbfbfb; font:bold 12px 굴림; color:#FF6600; text-align:center; padding:10px}
.askPass {font:12px 굴림; color:#333; text-align:center; padding:10px;}
.askBtn {font:bold 12px 굴림; color:#333; text-align:center; padding:10px}

.askPass input {
	background-color:#FBFBFB; width:150px; height:22px; font:12px 굴림; color:#333;
	border-top:1px solid #A6A6A6;
	border-right:1px solid #D8D8D8;
	border-bottom:1px solid #D8D8D8;
	border-left:1px solid #A6A6A6;
	margin-right:10px; padding:3px 0 0 3px
}
</style>
<table width="300px" cellSpacing="0" cellpadding="0" border="0" class="askTb">
	<tr>
		<td class="askTitle"><?=$title?></td>
	</tr>
	<?php if(!$member['no']) {?>
	<tr>
		<td class="askTitle">비밀번호 : <?=$input_password?></td>
	</tr>
	<?php }?>
	<tr>
		<td class="askBtn">
		<span class="button"><input type="submit" value="OK" /></span>
		<a class="button" href="#" onclick="history.go(-1); return false;" title="취소"><span>취소</span></a></td>
	</tr>
</table>

</form>
</center>
