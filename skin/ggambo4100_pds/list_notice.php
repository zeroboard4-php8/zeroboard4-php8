<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
	if($member['level']<=$setup['grant_view']||$is_admin) {
	$comment_num=$data['total_comment']; 
/* Check New Comment <?=$comment_new?> */
if(!$comment_num==0) {
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font><font color=orange class=icon4 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">*</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font><font color=gray class=icon4 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">*</font>";
  else $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font>";
  }
  else $comment_new = "";
  } else {
	$comment_num=$data['total_comment']; 
/* Check New Comment <?=$comment_new?> */
if(!$comment_num==0) {
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font><font color=orange class=icon4 style=\"cursor:hand\">*</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font><font color=gray class=icon4 style=\"cursor:hand\">*</font>";
  else $comment_new = "<font color=#6898C0 class=icon4>…</font><font color=#800080 class=ve8>".$comment_num."</font>";
  }
  else $comment_new = "";
  }
?>

<tr>
	<td align=left nowrap class='notice' height=30 style='padding:3 0 0 20;'><img src=<?=$dir?>/notice12.gif>&nbsp;&nbsp;<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?>[알림]<?=$hide_category_end?> &nbsp;<?=$subject?> <?=$comment_new?></td> 
</tr>

<?php $coloring++;?>
