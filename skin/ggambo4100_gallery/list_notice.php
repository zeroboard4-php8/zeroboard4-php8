<?php 
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
	$subject = str_replace(">","><font class=list_notice>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=list_eng2>".date("m-d", $data['reg_date'])."</font></span>"; 
?> 
<tr align=center height=29 onmouseover="this.style.backgroundColor='F8F8F8'" onmouseout="this.style.backgroundColor=''">
<td class=list3></td>
	<td class=list_eng2><img src=<?=$dir?>/notice12.gif></td>
	<td align=left nowrap height=25 class='list3' colspan=5><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?><nobr><font class=list_notice>공지사항 ::</font><nobr>&nbsp;<?=$hide_category_end?><?=$subject?> <?=$comment_new?></td> 
<td class=list3></td>
</tr>
<tr><td class='line1' width=100% colspan=8></td></tr>

<?php $coloring++;?>
