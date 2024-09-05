<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
	$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'>".date("m-d", $data['reg_date'])."</span>"; 
?>

<tr align=center class=list<?=$coloring%2?>>
<td></td>
	<td class=list_eng><?=$number?></td>
	<td align=left nowrap height=25 style='padding-top:3;'><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?><nobr>[<?=$category_name?>]<nobr><?=$hide_category_end?> &nbsp;<?=$subject?> &nbsp;<font class=list_eng2><?=$comment_num?></font></td> 
	<td style='padding-top:3;'><nobr><?=$face_image?>&nbsp;<?=$name?></nobr></td>
	<td nowrap class=list_eng><?=$date?></td>
	<td nowrap class=list_eng><?=$hit?></td><td></td>
</tr>

<?php $coloring++;?>
