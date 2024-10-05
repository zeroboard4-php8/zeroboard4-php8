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
<!-- 목록 부분 시작 -->
<tr align=center onmouseover="this.style.backgroundColor='F8F8F8'" onmouseout="this.style.backgroundColor=''">
  <td height=25 colspan=<?=$max_show_image?> style='padding:0 10 0 10;' valign=middle class=thm8 align=left>
  <table border=0 cellspacing=0 cellpadding=0 width=100% height=25>
<?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=></col><col width=70></col> 
<tr>
	<?=$hide_cart_start?><Td width=20 align=center><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
	<td style='word-break:break-all;padding:3 0 0 10;'><?=$insert?><?=$icon?><?=$subject?> &nbsp;<?=$comment_new?></td>
</tr>
</table>
  </td>
</tr>
<tr>
<td colspan=<?=$max_show_image?> class='line1' height=1></td>
</tr>

