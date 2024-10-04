<?php   
/* Check New Article to <?=$new?> */

if(time()-$data['reg_date']<60*60*12) $new = "<font color=red size=1>*</font>";
elseif(time()-$data['reg_date']<60*60*24) $new = "<font color=blue size=1>*</font>";
else $new = "";

/* Check New Comment <?=$comment_new?> */
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='$data['no']' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=red size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=blue size=1 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">+</font>";
  else $comment_new = "";
 ?>


<tr>
	<td colspan=<?=$colspanNum?> background=<?=$dir?>/images/dot.gif></td>
</tr>
