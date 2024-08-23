<?php
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
?>

<tr align=center class=list<?=$coloring%2?>>
	<td class=list_eng>Notice</td>
	<?=$hide_category_start?><td class=list_eng><?=$category_name?></td><?=$hide_category_end?>
	<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?> &nbsp;<font class=list_eng style=font-size:7pt><?=$comment_num?></font></td> 
	<td nowrap><nobr><?=$face_image?>&nbsp;<?=$name?></nobr></td>
	<td nowrap class=list_eng><?=$reg_date?></td>
	<td nowrap class=list_eng><?=$vote?></td>
	<td nowrap class=list_eng><?=$hit?></td>
</tr>

<?php $coloring++;?>
