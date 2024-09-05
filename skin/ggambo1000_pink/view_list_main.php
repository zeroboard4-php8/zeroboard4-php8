<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name = str_replace(">","><font class=list_han>",$name);
		$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'>".date("m-d", $data['reg_date'])."</span>"; 
?>
<tr align=center class=list<?=$coloring%2?>>
	<td class=zv3_small height=20><?=$number?></td>
	<td align=left style='word-break:break-all;'>&nbsp;<?=$insert?><?=$hide_category_start?>[<?=$category_name?>]<?=$hide_category_end?><?=$subject?> <font class=thm7pt><?=$comment_num?></font></td>
	<td nowrap><?=$face_image?>&nbsp;<?=$name?>&nbsp;</div></td>
	<td nowrap class=list_eng><?=$date?></td>
</tr>
<?php $coloring++?>
