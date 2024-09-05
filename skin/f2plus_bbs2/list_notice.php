<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
?>
<tr bgcolor=f3f3f3 height=1>
<td colspan=<?=$num?>>
</td>
</tr>
<tr align=center bgcolor=fcfcfc height=25>
	<td class=list_eng>Notice</td><?=$hide_category_start?>
	<td bgcolor=fcfcfc></td>
	<td class=list_eng nowrap><nobr>공지사항<nobr></td><?=$hide_category_end?>
	<td bgcolor=fcfcfc></td>
	<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?> &nbsp;<font class=list_eng style=font-size:7pt><?=$comment_num?></font></td> 
	<td bgcolor=fcfcfc></td>
	<td nowrap><nobr><?=$face_image?>&nbsp;<b><?=$name?></b></nobr></td>
	<td bgcolor=fcfcfc></td>
	<td nowrap class=list_eng><?=$reg_date?></td>
	<td bgcolor=fcfcfc></td>
	<td nowrap class=list_eng><?=$hit?></td>
</tr>
<tr bgcolor=ececec height=1>
<td colspan=<?=$num?>>
</td>
</tr>