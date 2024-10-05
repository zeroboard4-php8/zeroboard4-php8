<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name = str_replace(">","><font class=list_han>",$name);

?>


<tr align=center class=list<?=$coloring%2?>>

	<td class=list_eng><?=$number?></td>
	<td align=left nowrap height=25 style='padding-top:3;' class=list_han><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$subject?> &nbsp;<font style=font-family:Verdana;font-size:7pt;><?=$comment_num?></font></td> 
	<td nowrap class=list_han style='padding-top:3;'><nobr><?=$face_image?>&nbsp;<?=$name?></nobr></td>
	<td nowrap class=list_eng><?=$reg_date?></td>
</tr>
<tr><td  colspan=10 class=line3 height=1></td></tr>
<?php $coloring++?>
