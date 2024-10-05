<?php 
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
	if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name1'])&&@file_exists($data['file_name1'])) {
		$screenshot = $data['file_name1'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>50) {
			$_x = 50;
			$_y = 40;
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
	} elseif(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) {
		$screenshot = $data['file_name2'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>50) {
			$_x = 50;
			$_y = 40;
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
		$_x = 50;
		$_y = 40;
		$img_a = $img_a2 = "";
	}
?>
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
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=list_eng2>".date("m-d", $data['reg_date'])."</font></span>"; 
?> 
<tr align=center class=list<?=$coloring%2?>  onmouseover="this.style.backgroundColor='F8F8F8'" onmouseout="this.style.backgroundColor=''">
<td class=list3></td>
	<td class=list_eng2><?=$number?></td>
	<td><?=$img_a?><img src="<?=$screenshot?>" width=<?=$_x?> height=<?=$_y?> style="border:1 #F0F0F0 solid;"><?=$img_a2?></td>
	<td align=left nowrap height=25 class='list3'><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?><nobr><font color=#777777><?=$category_name?> ::</font><nobr>&nbsp;<?=$hide_category_end?><?=$subject?> <?=$comment_new?></td> 
	<td style='padding-top:3;' class=list_han><nobr><?=$face_image?>&nbsp;<?=$name?></nobr></td>
	<td nowrap class=list_eng2><?=$date?></td>
	<td nowrap class=list_eng2><?=$hit?></td>
<td class=list3></td>
</tr>
<tr><td class='line1' width=100% colspan=8></td></tr>

<?php $coloring++;?>
