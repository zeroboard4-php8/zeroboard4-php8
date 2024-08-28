<?php
	$name = str_replace(">","><font class=list_han>",$name);
	$homepage = str_replace(">","><font class=list_eng></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=list_eng></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=list_eng></b>",$a_file_link2);
	$sitelink1 = str_replace(">","><font class=list_eng></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=list_eng></b>",$sitelink2);
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td colspan=10 align=left width=100% height=30 class='view2' style='word-break:break-all; padding:12 20 9 30;word-break:break-all;'><b><?=$subject?></b></td>
</tr>
<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding: 3 10 0 20;' class='ver8'>
<table border=0 cellspacing=0 cellpadding=0 width='100%'><tr><td>
<span style=font-size:7pt><font color=silver>◆</font></span> <?=$face_image?>&nbsp;<?=$name?>&nbsp;
<?php
					if($data['homepage']) {
				?><a href="<?=$data['homepage']?>" target=_blank>(<font class=thm8pt>HOMEPAGE</font>)</a>&nbsp;<?php
					}
				?></td><td align=right><font class='thm8pt'><span title='<?=date("Y년 m월 d일 H시 i분 s초",$data['reg_date'])?>'><?=date("m-d",$data['reg_date'])?></span> | HIT : <?=number_format($hit)?></font></td></tr></table>
<td></tr>
<tr><td height=1 class=line1 colspan=10><img src=$dir/t.gif border=0 height=1></td></tr>
<?=$hide_download1_start?>
<?php if(!$file_name1 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name1)) { }
else { echo "<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;' class='ver8'>";
echo "<span style=font-size:7pt><font color=silver>◆</font></span> $a_file_link1$file_name1 ($file_size1)</a>, Down : $file_download1</td></tr>";
echo  "<tr><td height=1 class=line1 colspan=10><img src=$dir/t.gif border=0 height=1></td></tr>"; }
?>
	<?=$hide_download1_end?>
	<?=$hide_download2_start?>
<?php if(!$file_name2 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name2)) { }
else { echo "<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding:5 20 5 20;' class='ver8'>";
echo "<span style=font-size:7pt><font color=silver>◆</font></span> $a_file_link2$file_name2 ($file_size2)</a>, Down : $file_download2</td></tr>";
echo  "<tr><td height=1 class=line1 colspan=10><img src=$dir/t.gif border=0 height=1></td></tr>"; }
?>
	<?=$hide_download2_end?>
<tr><td colspan=10 width=100% style='padding:10 0 10 0;word-break:break-all;'>
<table border=0 cellspacing=0 cellpadding=0 style='table-layout:fixed;line-height:150%;'>
<?=$hide_download1_start?>
<?php if(!$file_name1 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name1)) { ?>
<tr><td style='padding:5 20 5 20;border:1 #F0F0F0 solid;' bgcolor=#F8F8F8>
사진 1 : <?=$data['sitelink1']?></td></tr><tr><td style='padding:10;'><?=$upload_image1?></td></tr>
<?php } else { } ?>
<?=$hide_download1_end?>
<?=$hide_download2_start?>
<?php if(!$file_name2 || eregi("(\.(gif|jpg|jpeg|bmp|png))$",$file_name2)) { ?>
<tr><td style='padding:5 20 5 20;border:1 #F0F0F0 solid;' bgcolor=#F8F8F8>
사진 2 : <?=$data['sitelink2']?></td></tr><tr><td style='padding:10;'><?=$upload_image2?></td></tr>
<?php } else { } ?>
<?=$hide_download2_end?>
<tr>
 <td style='padding:5 20 5 20;border:1 #F0F0F0 solid;' bgcolor=#F8F8F8><b>내용 :</b></td>
</tr><tr><td style='line-height:160%;padding:10'>
				<?=$memo?></td></tr></table>
				<div align=right class=list_eng style='padding-right:10;'><?=$ip?></div></td>
			
</tr>
</table>

<?php if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?>
<table width=<?=$width?>><tr><td><img src=/images/t.gif border=0 height=8><br></td></tr><tr><td class='line1' width=100%></td></tr></table>
<?=$hide_comment_end?>
<?php }?>
