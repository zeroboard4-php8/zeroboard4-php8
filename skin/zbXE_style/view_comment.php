<?php
	$comment_name = str_replace(">","><span style=\"font:12px 굴림; color:#3074A5\">",$comment_name);
?>

<table class="xeComment_tbc" width="100%" cellSpacing="0" cellpadding="0" border="0">
<colgroup span="2"><col></col><col width="160px"></col></colgroup>
	<tr>
	<td class="xeComment_name"><?=$c_face_image?> <?=$comment_name?></b></td>
	<td class="xeComment_date">
	<span class="xeComment_dateSp"><?=date("Y-m-d",$c_data['reg_date'])?> <?=date("H:i:s",$c_data['reg_date'])?></span>
	<?=$a_del?><img src="<?=$dir?>/images/buttonDelete.gif" class="xeComment_del" title="삭제" alt="삭제" /></a></td>
	</tr>
	<tr>
	<td colspan="2" class="xeComment_memo"><?=str_replace("\n","<br />",$c_memo)?></td>
	</tr>
</table>
