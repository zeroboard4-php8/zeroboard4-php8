<?php
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
?>

<tr>
	<td align=left nowrap class='notice' height=30 style='padding:3 0 0 20;'><img src=<?=$dir?>/notice12.gif>&nbsp;&nbsp;<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?>&nbsp;<?=$hide_category_start?>[¾Ë¸²]<?=$hide_category_end?> &nbsp;<?=$subject?> &nbsp;<font style=font-family:Verdana;font-size:7pt;><?=$comment_num?></font></td> 
</tr>

<?php$coloring++;?>
