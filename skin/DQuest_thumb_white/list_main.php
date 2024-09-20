<?php
	$subject = str_replace(">","><font class=thumb_han>",$subject);
	$category_name = "<font class=thumb_han3>".$category_name;
	$name = str_replace($data['name'],"<font class=thumb_han>{$data['name']}</font>","$name");
	$comment_num = str_replace("[","",str_replace("]","",$comment_num));

	if(empty($use_alllist)) $_zb_url="view.php"; else $_zb_url="zboard.php";
	$subject = str_replace($data['subject'], cut_str(stripslashes($data['subject']),$_textlen), $subject)."</font></b>";

if(isset($_notice_visible)) {
	echo "<img src=$dir/t.gif border=0 height=10>\n";
	$_notice_visible = false;
}

unset($thumb_x);
unset($thumb_y);

if(!isset($_xx)) $_xx=0;
if(!isset($_hcol)) $_hcol=0;
$_xx++;
$_hcol++;
$_temp = $_xx % $_hcount;
if ($_temp==1) {?>
<table border=0 cellpadding=0 cellspacing=0 class=thumb_area_bg><tr>
<td>
<div align=left>
<table border=0 cellpadding=0 cellspacing=4 style="table-layout:fixed">
  <tr>
<?php }?>

<?php 
if(eregi("\.gif|\.jpg|\.jpeg|\.png",$data['file_name1'])) $filename = $data['file_name1'];
elseif(eregi("\.gif|\.jpg|\.jpeg|\.png",$data['file_name2'])) $filename = $data['file_name2'];
else $filename="";
if ($filename) {
  $filename=make_thumb($_dq_imagex,$_dq_imagey,$filename,$data);
} else {
  //$filename=chk_imgtag($_dq_imagex,$_dq_imagey,$data);
  //if (!$filename) $filename=make_thumb($_dq_imagex,$_dq_imagey,"$dir/no_screenshot.gif",$data);
  $filename=make_thumb($_dq_imagex,$_dq_imagey,"$dir/no_screenshot.gif",$data);
}
?>

	<td width=<?=$_hsize?>>
	  <table border=0 cellspacing=0 cellpadding=0 style="table-layout:fixed" height=100%>
	  <tr><td style='padding:-top:4px; padding-bottom:4px;' <?php if($_thumb_hspace) echo "height=$_thumb_hspace"?> valign=<?=$_thumb_valign?>>
		  <table align=<?=$_thumb_align?> border=0 cellspacing=0 cellpadding=0><tr><td class=thumb_border>
		  <?php echo "<a href=$_zb_url?$href&$sort&no={$data['no']} onfocus=blur()><img src=$filename border=0 width=".$cal_size[0]." height=".$cal_size[1]."></a>";?></td></tr></table></td>
	  </tr>
	  <tr align=<?=$_thumb_align?>><td style=padding-left:0px;padding-right:5px; class=thumb_area_bg>
		 <?=$hide_category_start?><?=$category_name?><?=$hide_category_end?></td></tr>
	  <tr align=<?=$_thumb_align?>><td style=padding-left:0px;padding-right:5px; class=thumb_area_bg>
		<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?><?=$insert?><?=$subject?></td></tr>
	  <tr align=<?=$_thumb_align?>><td style=padding-left:0px;padding-right:5px; class=thumb_area_bg>
		<nobr><?php if($_show_name){?><?=$face_image?><?=$name?></b>&nbsp;<?php }?><font class=thumb_eng>(hit:<?=$hit?><?php if($comment_num) echo "&nbsp;c:$comment_num"?>)</font></nobr></td></tr>
	  </td></tr>
	  </table>
	</td>
<?php if (!$_temp) {?>
  </tr>
  <tr><td colspan=<?=$_hcol?> height=10 class=thumb_area_bg><img name=dq_table_width width=<?=$width?> src=<?=$dir?>/t.gif border=0 height=10></td></tr>
</table>
</div>
</td></tr></table>
<?php $_hcol=0;?>
<?php }?>
