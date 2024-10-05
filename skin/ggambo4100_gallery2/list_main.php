<?php 
	if($member['level']<=$setup['grant_view']||$is_admin) {
	$comment_num=$data['total_comment']; 
/* Check New Comment <?=$comment_new?> */
if(!$comment_num==0) {
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font><font color=orange class=icon4 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">*</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font><font color=gray class=icon4 style=\"cursor:hand\" title=\"".cut_str(stripslashes($last_comment['memo']),30)."\">*</font>";
  else $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font>";
  }
  else $comment_new = "";
  } else {
	$comment_num=$data['total_comment']; 
/* Check New Comment <?=$comment_new?> */
if(!$comment_num==0) {
  $last_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date desc limit 1"));
  $last_comment_time = $last_comment['reg_date'];
  if(time()-$last_comment_time<60*60*12) $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font><font color=orange class=icon4 style=\"cursor:hand\">*</font>";
  elseif(time()-$last_comment_time<60*60*24) $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font><font color=gray class=icon4 style=\"cursor:hand\">*</font>";
  else $comment_new = "<font color=#800080 class=ve8>".$comment_num."</font>";
  }
  else $comment_new = "";
  }
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=list_eng2>".date("m-d", $data['reg_date'])."</font></span>"; 
	if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name1'])&&@file_exists($data['file_name1'])) {
		$screenshot = $data['file_name1'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>110) {
			$_x = 110;
			$_y = 110;
		}
		else {
			$_x = $image_info[0];
			$_y = $image_info[1];
		}
			if($member['level']<=$setup['grant_view']||$is_admin) {
		$img_a = "<a href=\"javascript:void(window.open('$dir/view_image.php?filename=".$screenshot."','screenshot','width=$image_info[0],height=$image_info[1],scrollbars=no,toolbars=no'))\"  title='클릭하시면 원본 사이즈로 보실 수 있습니다'>";
		$img_a2 = "</a>";
		} else {
		$img_a = "";
		$img_a2 = "";
		}
	} elseif(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) {
		$screenshot = $data['file_name2'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>110) {
			$_x = 110;
			$_y = 110;
		}
		else {
			$_x = $image_info[0];
			$_y = $image_info[1];
		}
					if($member['level']<=$setup['grant_view']||$is_admin) {
		$img_a = "<a href=\"javascript:void(window.open('$dir/view_image.php?filename=".$screenshot."','screenshot','width=$image_info[0],height=$image_info[1],scrollbars=no,toolbars=no'))\"  title='클릭하시면 원본 사이즈로 보실 수 있습니다'>";
		$img_a2 = "</a>";
				} else {
		$img_a = "";
		$img_a2 = "";
		}
	} else {
		$screenshot=$dir."/t.gif";
		$_x = 110;
		$_y = 110;
		$img_a = $img_a2 = "";
	}
	$size_factor=0;
?>
  <th class=thm8 width=<?php echo (100 / $max_show_image);?>% valign=top>
    <table border=0 cellspacing=0 cellpadding=0  width=<?=$size_factor*1.01?> style='table-layout:fixed;'>
               <tr>
                <td align=center style='padding:10;'>
      <table border=0 cellspacing=0 cellpadding=0 width=122 style='table-layout:fixed;'>
       <tr><td widh=122 height=122 style='padding:5;border:1 #F0F0F0 solid;' bgcolor=#FAFAFA style='FILTER:dropshadow(color=#e6b1b7,offX=1,offY=1,positive=1);'>
       <?=$img_a?><img src="<?=$screenshot?>" width=<?=$_x?> height=<?=$_y?> border=0 onMouseOver="this.className='imgover'" onMouseOut="this.className='imgbase'" class="imgbase"></td>
       </tr>
       <tr><td align=center style='word-break:break-all;padding:5 0 0 0;'><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?><?=$icon?><?=$subject?> <?=$comment_new?></td>
                      </table>
          </td>
         </tr>
   </table></th>
<?php 
  $image_loop++;
  if($image_loop>=$max_show_image)
  {
     echo"
               </tr>
        <tr>
         <td colspan=$max_show_image class='line1'></td>
        </tr>";
     $image_loop=0;
  }
?>
