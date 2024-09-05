<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
?>
<?php if(substr($id, 0, 4) != "club" && substr($id, 0, 5) != "class"){ ?>
<tr align=center height=25 bgcolor=white>
	<td class=list_eng><?=$number?></td><?=$hide_category_start?>
	<td bgcolor=ffffff></td>
	<td class=list_eng nowrap><nobr><?=$category_name?><nobr></td><?=$hide_category_end?>
	<td bgcolor=EAEAEA></td>
	<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?> &nbsp;<?=$icon?><font class=list_eng style=font-size:7pt><?=$comment_num?></font></td> 
	<td bgcolor=ffffff></td>
	<td><nobr><?=$face_image?>&nbsp;<b><?=$name?></b></nobr></td>
	<td bgcolor=ffffff></td>
	<td nowrap class=list_eng><?=$reg_date?></td>
	<td bgcolor=ffffff></td>
	<td nowrap class=list_eng><?=$hit?></td>
</tr>
<tr>
<td colspan=<?=$num?> bgcolor=f9f9f9 height=1></td>
</tr>
<?php }else{
	$num1 = $num - 1;
?>
<tr align=center height=25 bgcolor=white>
	<td class=list_eng><?=$number?></td><?=$hide_category_start?>
	<td bgcolor=ffffff></td>
	<td class=list_eng nowrap><nobr><?=$category_name?><nobr></td><?=$hide_category_end?>
	<td bgcolor=EAEAEA></td>
	<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?> &nbsp;<?=$icon?><font class=list_eng style=font-size:7pt><?=$comment_num?></font></td> 
	<td bgcolor=ffffff></td>
	<td><nobr><?=$face_image?>&nbsp;<b><?=$name?></b></nobr></td>
	<td bgcolor=ffffff></td>
	<td nowrap class=list_eng><?=$reg_date?></td>
</tr>
<tr>
<td colspan=<?=$num1?> bgcolor=f9f9f9 height=1></td>
</tr>
<?php } ?>
