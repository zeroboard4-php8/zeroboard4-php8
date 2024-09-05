<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
		$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'>".date("m-d", $data['reg_date'])."</span>"; 
?>

<tr align=center class=list<?=$coloring%2?> bgcolor=#FFF5F9>
<td></td>
	<td class=list_eng><img src=<?=$dir?>/notice12.gif></td>
	<td align=left nowrap colspan=4><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$hide_category_start?>[알림]<?=$hide_category_end?> &nbsp;<?=$subject?> &nbsp;<font style=font-family:Verdana;font-size:7pt;><?=$comment_num?></font></td> 
<td></td>
</tr>
<?php $coloring++;?>
