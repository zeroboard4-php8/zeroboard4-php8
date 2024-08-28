<?php
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
	if(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name1'])&&@file_exists($data['file_name1'])) {
		$screenshot = $data['file_name1'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>100) {
			$_x = 100;
			$_y = 100;
		}
		else {
			$_x = $image_info[0];
			$_y = $image_info[1];
		}
		$img_a = "<a href=\"javascript:void(window.open('$dir/view_image.php?filename=".urlencode($screenshot)."','screenshot','width=$image_info[0],height=$image_info[1],scrollbars=no,toolbars=no'))\"  title='클릭하면 원본 사이즈로 보실 수 있습니다'>";
		$img_a2 = "</a>";
	} elseif(eregi("\.jpg|\.png|\.gif|\.jpeg",$data['file_name2'])&&@file_exists($data['file_name2'])) {
		$screenshot = $data['file_name2'];
		$image_info = @getimagesize($screenshot);
		if($image_info[0]>100) {
			$_x = 100;
			$_y = 100;
		}
		else {
			$_x = $image_info[0];
			$_y = $image_info[1];
		}
		$img_a = "<a href=\"javascript:void(window.open('$dir/view_image.php?filename=".urlencode($screenshot)."','screenshot','width=$image_info[0],height=$image_info[1],scrollbars=no,toolbars=no'))\"  title='클릭하면 원본 사이즈로 보실 수 있습니다'>";
		$img_a2 = "</a>";
	} else {
		$screenshot=$dir."/noscreenshot.gif";
		$_x = 100;
		$_y = 100;
		$img_a = $img_a2 = "";
	}

	unset($_m);
	unset($line);
	$_m = explode("\n",strip_tags($data['memo']));
	for($i=0;$i<count($_m);$i++) if(trim($_m[$i])) $line[] = $_m[$i];
	$tmp_memo = $line[0];
	if($line[1]) $tmp_memo.="<span style=font-size:8pt;><font face=arial color=silver><b>...more</b></font></span>";
?>
<tr align=center>
<td width=100%>
<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
<col width=120></col><col width=></col>
<tr valign=top>
	<td align=center width=120 style='padding:10 10 10 10;' height=120>
		<table border=0 cellspacing=0 cellpadding=0 width=100% height=100%>
		<tr align=center valign=middle>
			<td><?=$img_a?><img src="<?=$screenshot?>" width=<?=$_x?> height=<?=$_y?> border=1 style="border-color:#F0F0F0"><?=$img_a2?></td>
		</tr>
		</table>
	</td>
	<td valign=top class=list_han nowrap style='padding:10 10 8 10;' height=120>
		<table border=0 width=100% cellspacing=0 cellpadding=0>
		<tr>
		<td class=list_han style='padding:3 0 3 0;'>
		<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>">&nbsp;<?=$hide_cart_end?><b><?=$number?>.</b>&nbsp;<?=$insert?><b><?=$subject?></b> <font style=font-family:Verdana;font-size:7pt;><?=$comment_num?></font> <?=$icon?>
		</td>
			<td align=right style='padding:3 0 3 0;'>				<?=$hide_category_start?><font class=list_han>
				<nobr>- <?=$category_name?></nobr><?=$hide_category_end?>
			</td>
		</tr>
		<?php if($data['sitelink1']) {?>
		<tr>
		<td class=list_han style='padding:3 0 3 0;' colspan=2>
		◁ <?=$data['sitelink1']?>
				</td></tr>
		<?php } elseif ($data['sitelink2']) {?>
		<td class=list_han style='padding:3 0 3 0;' colspan=2>
		◁ <?=$data['sitelink2']?>
				</td></tr>
		<?php } ?>
		</table>
				<table border=0 width=100% cellspacing=0 cellpadding=0 style='margin:3 0 3 0;'>
		<tr><td><nobr>- 등록회원: <?=$face_image?>&nbsp;<?=$name?></b></nobr><br></td><td align=right width=100%><font class='thm8pt'><span title='<?=date("Y년 m월 d일 H시 i분 s초",$data['reg_date'])?>'><?=date("m-d",$data['reg_date'])?></span> | HIT : <?=number_format($hit)?></font></td></tr>
		<tr><td colspan=2  class=list_han style='word-break:break-all;padding:5 0 0 0;'><?=$tmp_memo?></td></tr></table>

	</td>
</tr>
<tr><td height=1 bgcolor=#F3F3F3 colspan=2></td></tr>
</table>
</td></tr>

<?php $coloring++;?>
