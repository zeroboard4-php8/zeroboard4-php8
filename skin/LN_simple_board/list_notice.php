
<?php   
/* Check New Article to <?=$new?> */

if(time()-$data['reg_date']<60*60*12) $new = "<font color=red size=1>*</font>";
elseif(time()-$data['reg_date']<60*60*24) $new = "<font color=blue size=1>*</font>";
else $new = "";

/* Check New Comment <?=$comment_new?> */
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=red size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=blue size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  else $comment_new = "";
 ?>

<tr align=center  bgcolor=fafafa>
	<?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
	<td class=ver7 height=30>notice</td>
	<td align=left style='word-break:break-all;'>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?> <font class=thm7><?=$comment_num?><?=$comment_new?></font></td> 
	<td nowrap><?=$face_image?>&nbsp;<?=$name?></td>
	<td nowrap class=ver7><?=$reg_date?></td>
	<td nowrap class=ver7 align=right ><?=$hit?>&nbsp;</td>

</tr>
<tr>
	<td colspan=<?=$colspanNum?> background=<?=$dir?>/images/dot.gif></td>
</tr>