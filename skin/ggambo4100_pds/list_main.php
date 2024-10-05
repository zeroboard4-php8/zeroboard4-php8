<?php 
	$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=list_eng2>".date("m-d", $data['reg_date'])."</font></span>"; 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$a_file_link1 = str_replace(">","><font class=list_eng>",$a_file_link1);
	$file_download1 = str_replace(">","><font class=list_eng>",$file_download1);
	$name= str_replace(">","><font class=list_han>",$name);
	$_x=0;
$_y=0;
	if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) {
		$screenshot = $data['file_name2'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>140) {
			$_x = 140;
			$_y = 120;
		}
		else {
			$_x = $image_info[0];
			$_y = $image_info[1];
		}
		if($member['level']<=$setup['grant_view']||$is_admin) {
		$img_a = "<a href=\"javascript:void(window.open('$dir/view_image.php?filename=".$screenshot."','screenshot','width=$image_info[0],height=$image_info[1],scrollbars=no,toolbars=no'))\"  title='클릭하면 원본 사이즈로 보실 수 있습니다'>";
		$img_a2 = "</a>";
		} else {
		$img_a = "";
		$img_a2 = "";
		}
	} else {
		$screenshot=$dir."/t.gif";
		$_x = 0;
		$_y = 0;
		$img_a = $img_a2 = "";
	}

	unset($_m);
	unset($line);
	$_m = explode("\n",strip_tags($data['memo']));
	for($i=0;$i<count($_m);$i++) if(trim($_m[$i])) $line[] = $_m[$i];
	if(empty($line[1])) $line[1]='';
	if(empty($line[2])) $line[2]='';
	if(empty($line[3])) $line[3]='';
	if(empty($view_file)) $view_file='';
	if(empty($addShowComment)) $addShowComment='';
	if(empty($showCommentStr)) $showCommentStr='';
	$tmp_memo = $line[0]."<br>".$line[1]."<br>".$line[2]."<br>".$line[3];
	if($member['level']<=$setup['grant_view']||$is_admin) {
	if(!empty($line[4])) $tmp_memo.="<a href=\"".$view_file."?$href$sort&no={$data['no']}\" $addShowComment ><font class=icon2><b>...more</b></font></a>"; }
	else {
	if(!empty($line[4])) $tmp_memo.="<font class=icon2><b>...more</b></font>"; }
?>
<?php 
	if($member['level']<=$setup['grant_view']||$is_admin) {
		if($setup['use_status']&&!$data['is_secret']) $addShowComment = " title=\"$showCommentStr\" ";
	}
			else { 
		if($setup['use_status']&&!$data['is_secret']) $addShowComment = " title=\"$showCommentStr\" ";
					if($tmp_memo){
		$tmp_memo="$tmp_memo"; }
		$subject="<b>".$subject."</b>";

			}
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
<tr align=center>
<td width=100%>
<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
<col width=></col><?php if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) { ?><col width=150></col><?php } ?>
<tr valign=top>
	<td valign=top class=list_han nowrap style='padding:8 10 5 10;' width=100%>
		<table border=0 width=100% cellspacing=0 cellpadding=0>
		<tr>
		<td class=list_han style='padding:0 0 3 0;'>
		<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>">&nbsp;<?=$hide_cart_end?><b><?=$number?>.</b>&nbsp;<?=$insert?><?=$icon?><b><?=$subject?></b> <?=$comment_new?>
		</td>
			<td align=right style='padding:0 0 3 0;'>				<?=$hide_category_start?><font class=list_han>
				<nobr>- <?=$category_name?></nobr><?=$hide_category_end?>
			</td>
		</tr>
<?php if(eregi("\.zip|\.arj|\.rar|\.tar|\.rar|\.lzh|\.cab|\.arc|\.gz",$data['file_name1'])&&@file_exists($data['file_name1'])) { ?>
		<tr>
		<td class=list_eng style='padding:3 0 3 0;' colspan=2 align=right>
		<img src=<?=$dir?>/zip.gif border=0 align=absmiddle>&nbsp;&nbsp;<?php if($member['level']<=$setup['grant_view']||$is_admin) { ?><?=$a_file_link1?><?=$file_name1?></a><?php } else { ?><?=$file_name1?><?php } ?> ( SIZE : <?=$file_size1?> , DOWN : <?=$file_download1?> )
		</td></tr><?php } ?>
		</table>
		<table border=0 width=100% cellspacing=0 cellpadding=0 style=table-layout:fixed>
		<tr>
			<td class=list_han style='word-break:break-all;padding:3 0 0 0;'><?=$tmp_memo?></td>
		</tr>
		</table>
	</td>
<?php if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) { ?>
	<td align=center width=150 style='padding:10 10 10 0;'>
		<table border=0 cellspacing=0 cellpadding=0 width=100% height=100%>
		<tr align=center valign=middle>
			<td><?=$img_a?><img src="<?=$screenshot?>" width=<?=$_x?> height=<?=$_y?> border=1 style="border:1 #C0C0C0 solid;"><?=$img_a2?></td>
		</tr>
		</table>
	</td><?php } else { ?><td></td><?php } ?>
</tr>
</table>
</td></tr>
<tr><td class=line1></td></tr>

<?php $coloring++;?>
