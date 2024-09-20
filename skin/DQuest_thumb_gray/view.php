<?php 
	include $dir."/exif_info.php";
	unset ($filename);

	$name = str_replace($data['name'],"<font class=thumb_han>{$data['name']}</font>","$name");
	$homepage = str_replace(">","><font class=thumb_eng></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=thumb_eng></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=thumb_eng></b>",$a_file_link2);
	$sitelink1 = str_replace(">","><font class=thumb_han></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=thumb_han></b>",$sitelink2);
	$memo = str_replace("<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top>","<table border=0 cellspacing=0 cellpadding=0 width=$_memo_width><tr><td align=$_memo_align valign=top class=thumb_han>",$memo);
	$_auto_resize_text = " name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)";

	if (!$_auto_resize) $memo=str_replace($_auto_resize_text,"",$memo);
	if(!eregi("Zeroboard",$a_vote)) $a_vote1 = str_replace(">","><font class=thumb_han2 style=font-weight:bold>",$a_vote."&nbsp;&nbsp;");
	$ip = isset($ip) ? str_replace("IP Address : ","IP: ",$ip) : '';
	if (empty($use_alllist)) $_zb_url="view.php"; else $_zb_url="zboard.php";
?>

<table border=0 cellspacing=0 cellpadding=8 width=<?=$_pic_width?>>
<tr class=pic_bg>
	<td align=center>
		<img src=<?=$dir?>/t.gif border=0 height=15><br>
		<font class=thumb_han><?=$subject?></font><br>
		<img src=<?=$dir?>/t.gif border=0 height=25><br>
		<?php if ($upload_image1){
			$img_info = getimagesize($data['file_name1']);
			if(!$_auto_resize) echo "<table border=0 cellspacing=0 cellpadding=0 width=$img_info[0]+2 align=center><tr><td class=pic_border>\n";
			echo "<img";
			if($_auto_resize) echo $_auto_resize_text;
			echo " src={$data['file_name1']} border=0><br>";
			if(!$_auto_resize) echo "</td></tr></table>"; 
		  }

		  if ($upload_image2){
			$img_info = getimagesize($data['file_name2']);
			if ($upload_image1) echo "<img src=$dir/t.gif border=0 width=10 height=30><br>";
			if(!$_auto_resize) echo "<table border=0 cellspacing=0 cellpadding=0 width=$img_info[0]+2 align=center><tr><td class=pic_border>\n";
			echo "<img";
			if($_auto_resize) echo $_auto_resize_text;
			echo " src={$data['file_name2']} border=0><br>";
			if(!$_auto_resize) echo "</td></tr></table>"; 
		  }
		?>

		<img src=<?=$dir?>/t.gif border=0 height=15><br>
		<div align=center><?=$memo?></div>
		<img src=<?=$dir?>/t.gif border=0 height=10><br>
	</td>
</tr>
<tr><td height=0 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>


<?php if(!eregi("<Zeroboard",$a_login)||!eregi("<Zeroboard",$a_logout)||!eregi("<Zeroboard",$a_setup)||!eregi("<!--",$hide_category_start)) $show_line=true;?>

<?php if($show_line){?>
<table border=0 cellspacing=0 cellpadding=3 width=<?=$width?> class=thumb_bg>
<?=$hide_category_start?>
<tr><td colspan=2 height=0 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_category_end?>
<tr>
	<td>
		<?=$a_login?>로그인</a>
		<?=$a_member_join?>회원가입</a>
		<?=$a_member_modify?>정보수정</a>
		<?=$a_member_memo?>메모박스</a>
		<?=$a_logout?>로그아웃</a>
		<?=$a_setup?>설정변경(관리자용)</a>
		<?php if ($member['no'] != $data['ismember'] && (isset($a_vote1)&&eregi("<a",$a_vote1))) {?><?=$a_vote1?>추천하기</a><?php }?>
	</td>
	<?php if (!empty($use_alllist)) {?>
	<?=$hide_category_start?>
	<td align=right valign=top style="padding-right:5px;"><nobr><?=$a_category?></nobr></td>
	<?=$hide_category_end?>
	<?php }?>
</tr>
</table>
<?php }?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> class=thumb_bg>
<?php if($show_line){?><tr><td height=0 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr><?php }?>
<tr><td height=10><img src=<?=$dir?>/t.gif border=0 height=10></td></tr>
<tr>
	<td valign=top><table border=0 cellspacing=0 width=100% style=table-layout:fixed>
	  <tr>
		<td valign=top nowrap style="padding-left:10px;" class=thumb_han><nobr>
			제목: <?=$subject?><br>
			<?=$hide_category_start?>
				분류: <?=$category_name?><br>
			<?=$hide_category_end?>
			<?=$_name_style?>: <?=$face_image?><?=$name?></b><br>
			<?php 
				if($data['homepage']) {
			?><font class=thumb_han>홈페이지: </font><a href="<?=$data['homepage']?>" target=_blank><font class=thumb_han><?=$data['homepage']?></font></a><br><?php 
				}
			?>
			<?=$hide_sitelink1_start?><font class=thumb_han>촬영장소: <?=$data['sitelink1']?></font><br><?=$hide_sitelink1_end?>
			<?=$hide_sitelink2_start?><font class=thumb_han>사진설명: <?=$data['sitelink2']?></font><br><?=$hide_sitelink2_end?>
		    <br>등록시간: <?=$date?><br>
			조회수: <?=number_format($hit)?><br>
			추천수: <?=$vote?><br>
			<?=$hide_download1_start?>
			<?php if($_exif_on) echo"<img src=$dir/t.gif border=0 width=10 height=5><br>\n"?>
			사진#1: <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download: <?=$file_download1?><br>
			<?php if($_exif_on) exiflist($data['file_name1']);?>
			<?=$hide_download1_end?>
			<?=$hide_download2_start?>
			<?php if($_exif_on) echo"<img src=$dir/t.gif border=0 width=10 height=5><br>\n"?>
			사진#2: <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download: <?=$file_download2?><br>
			<?php if($_exif_on) exiflist($data['file_name2']);?>
			<?=$hide_download2_end?>
			</nobr>
		</td>
<?php if ((isset($a_prev)&&eregi("<a",$a_prev))||(isset($a_next)&&eregi("<a",$a_next))) {
	if(isset($cal_size[0])) unset($cal_size[0]);
	if(isset($cal_size[1])) unset($cal_size[1]);
	if(eregi("<a",$a_prev)) {
		if(eregi("\.gif|\.jpg|\.jpeg|\.png",$prev_data['file_name1'])) $filename = $prev_data['file_name1'];
		elseif(eregi("\.gif|\.jpg|\.jpeg|\.png",$prev_data['file_name2'])) $filename = $prev_data['file_name2'];
		else $filename = "";
		if ($filename) {
		  $prev_filename=make_thumb($_dq_imagex,$_dq_imagey,$filename,$prev_data);
		  $prev_imagex = $cal_size[0];
		  $prev_imagey = $cal_size[1];
		  $prev_imagexx = $cal_size[0]+10;
		  $prev_imageyy = $cal_size[1];
		} else {
			//$prev_filename = chk_imgtag($_dq_imagex,$_dq_imagey,$prev_data);
			//if ($prev_filename) {
			//  $prev_imagex = $cal_size[0];
			//  $prev_imagey = $cal_size[1];
			//  $prev_imagexx = $cal_size[0]+10;
			//  $prev_imageyy = $cal_size[1];
			//} else {
			  $img_info = getimagesize("$dir/no_screenshot.gif");
			  $prev_imagexx = $img_info[0]+10;
			  $prev_imageyy = $img_info[1];
			//}
		}
	}

if (eregi("<a",$a_next)) {
	if(isset($cal_size[0])) unset($cal_size[0]);
	if(isset($cal_size[1])) unset($cal_size[1]);
	if(eregi("\.gif|\.jpg|\.jpeg|\.png",$next_data['file_name1'])) $filename = $next_data['file_name1'];
	elseif(eregi("\.gif|\.jpg|\.jpeg|\.png",$next_data['file_name2'])) $filename = $next_data['file_name2'];
	else $filename="";
	if ($filename) {
	  $next_filename=make_thumb($_dq_imagex,$_dq_imagey,$filename,$next_data);
	  $next_imagex = $cal_size[0];
	  $next_imagey = $cal_size[1];
	  $next_imagexx = $cal_size[0]+10;
	  $next_imageyy = $cal_size[1];
	} else {
		//$next_filename = chk_imgtag($_dq_imagex,$_dq_imagey,$next_data);
		//if ($next_filename) {
		//  $next_imagex = $cal_size[0];
		//  $next_imagey = $cal_size[1];
		//  $next_imagexx = $cal_size[0]+10;
		//  $next_imageyy = $cal_size[1];
		//} else {
		  $img_info = getimagesize ("$dir/no_screenshot.gif");
		  $next_imagexx = $img_info[0]+10;
		  $next_imageyy = $img_info[1];
		//}
	}
}
}
?>

	<?php if ((isset($a_prev)&&eregi("<a",$a_prev))||(isset($a_next)&&eregi("<a",$a_next))) {?>
		<td width=3 class=line1><img src=<?=$dir?>/t.gif border=0 width=3></td>

	  <?php if ($prev_data['no']) {?>
		  <td valign=top width=<?=$prev_imagexx?> style=padding:5px;>
		  <?=$a_prev?>▲ 이전사진</a>
		  <table cellpadding=0 cellspacing=0 border=0>
			<tr><td valign=top class=thumb_border>
			<?php if(isset($prev_filename)) echo "<a href=$_zb_url?$href&$sort&no={$prev_data['no']} onfocus=blur()><img src=$prev_filename border=0 width=$prev_imagex height=$prev_imagey></a></td></tr></table>"?>
			<?php if(!isset($prev_filename)) echo "<a href=$_zb_url?$href&$sort&no={$prev_data['no']} onfocus=blur()><img src=$dir/no_screenshot.gif border=0></a></td></tr></table>"?>
			<?php echo "<a href=$_zb_url?$href&$sort&no={$prev_data['no']} onfocus=blur()>ㆍ".cut_str(stripslashes($prev_data['subject']),$_textlen)."</a>"?>
		  </td>
	  <?php }?>

	  <?php if (eregi("<a",$a_next)){?>
		  <td valign=top width=<?=$next_imagexx?> style=padding:5px;>
		  <?=$a_next?>▼ 다음사진</a><br>
		  <table cellpadding=0 cellspacing=0 border=0>
			<tr><td valign=top class=thumb_border>
			<?php if (isset($next_filename)) echo "<a href=$_zb_url?$href&$sort&no={$next_data['no']} onfocus=blur()><img src=$next_filename border=0 width=$next_imagex height=$next_imagey></a></td></tr></table>"?>
			<?php if (!isset($next_filename)) echo "<a href=$_zb_url?$href&$sort&no={$next_data['no']} onfocus=blur()><img src=$dir/no_screenshot.gif border=0></a></td></tr></table>"?>
			<?php echo "<a href=$_zb_url?$href&$sort&no={$next_data['no']} onfocus=blur()>ㆍ".cut_str(stripslashes($next_data['subject']),$_textlen)."</a>"?>
		  </td>
	  <?php }?>
	<?php }?>

	  
	  </tr></table>
	</td></tr>
</table>

<?php if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?>

<table border=0 cellspacing=0 cellpadding=0 height=5 width=<?=$width?>>
<tr><td height=5 class=thumb_bg style=height:5px><img src=<?=$dir?>/t.gif border=0 height=5></td></tr>
</table>
<?=$hide_comment_end?>
<?php }?>
