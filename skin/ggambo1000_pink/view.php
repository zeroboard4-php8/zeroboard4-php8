<?php 
	$name = str_replace(">","><font class=list_han>",$name);
	$homepage = str_replace(">","><font class=list_eng></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=list_eng></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=list_eng></b>",$a_file_link2);
	$sitelink1 = str_replace(">","><font class=list_eng></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=list_eng></b>",$sitelink2);
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr><td width=100%>

<table border=0 cellspacing=0 cellpadding=0 width=100%>

<tr><td width=100%  colspan=10>
<table border=0  cellspacing=0 cellpadding=0 width=100%>
<tr><td  width=100% align=left valign=bottom>&nbsp;&nbsp;

</td><td aligh=right valign=bottom  style='word-break:break-all; ;padding-right:10px;' nowrap>
    <font class=list_eng2><?=$a_setup?>SETUP</a></font></td>
<?=$hide_category_start?><td align=right valign=bottom width=20%><img src=<?=$dir?>/trans.gif height=3><?=$a_category?>&nbsp;&nbsp;</td>
<?=$hide_category_end?></tr></table></td></tr>
<tr>
   <td height=5 width=100%  colspan=10>
   <table border=0  cellspacing=0 cellpadding=0 width=100% height=5><tr><td height=100% width=100% background=<?=$dir?>/line.gif ><img src=<?=$dir?>/line_left_icon.gif border=0 height=5></td>    <td background=<?=$dir?>/line.gif align=right ><img src=<?=$dir?>/line_right_icon.gif border=0 height=5></td></tr></table>
   </td>
</tr>
<tr>
 <td colspan=10 align=left width=100% height=40 class='view2' style='word-break:break-all;'><b><?=$subject?></b></td>
</tr>
<tr>
   <td height=5 width=100%  colspan=10>
   <table border=0  cellspacing=0 cellpadding=0 width=100% height=5><tr><td height=100% width=100% background=<?=$dir?>/line.gif ><img src=<?=$dir?>/line_left_icon.gif border=0 height=5></td>    <td background=<?=$dir?>/line.gif align=right ><img src=<?=$dir?>/line_right_icon.gif border=0 height=5></td></tr></table>
   </td>
</tr>
<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding: 3 10 0 20;' class='ver8'>
<table border=0 cellspacing=0 cellpadding=0 width='100%'><tr><td>
<font color=#D070C0 class=list_eng>♣</font></span> <?=$face_image?>&nbsp;<?=$name?>&nbsp;
<?php 
					if($data['homepage']) {
				?>( <a href="<?=$data['homepage']?>" target=_blank><font class=list_eng2>HOMEPAGE</font></a>&nbsp;)<?php 
					}
				?></td><td align=right><font class=list_eng><span title='<?=date("Y년 m월 d일 H시 i분 s초",$data['reg_date'])?>'><?=date("m-d",$data['reg_date'])?></span> | 조회 : <?=number_format($hit)?></font></td></tr></table>
<td></tr>
	<?=$hide_sitelink1_start?>
<tr>
<td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding-left:20px;' class='ver8'>
<font color=#D070C0 class=list_eng>♣</font></span> <?=$sitelink1?>
</td></tr><?=$hide_sitelink1_end?>
<?=$hide_sitelink2_start?>
<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding-left:20px;' class='ver8'>
<font color=#D070C0 class=list_eng>♣</font></span> <?=$sitelink2?>
</td></tr><?=$hide_sitelink2_end?>
<?=$hide_download1_start?>
<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding-left:20px;' class='ver8'>
<font color=#D070C0 class=list_eng>♣</font></span> <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Down : <?=$file_download1?>
	</td></tr><?=$hide_download1_end?>
	<?=$hide_download2_start?>
<tr><td colspan=10 align=left width=100% height=25 style='word-break:break-all; padding-left:20px;' class='ver8'>
<font color=#D070C0 class=list_eng>♣</font></span> <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Down : <?=$file_download2?>
	</td></tr><?=$hide_download2_end?>
	<tr><td colspan=10 width=100% style='padding:10 20 10 20;'>
<table border=0 cellspacing=0 cellpadding=0 width=100% style='table-layout:fixed;'><tr><td width=100% style='line-height:160%;'>
<?=$hide_download1_start?><?=$upload_image1?><br><?=$hide_download1_end?>
<?=$hide_download2_start?><?=$upload_image2?><br><?=$hide_download2_end?>
				<?=$memo?></td></tr></table>
				<div align=right class=list_eng><?=$ip?></div>
			


	</td>
</tr>
</table>

<img src=<?=$dir?>/t.gif border=0 height=2><br>


<?php if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?>

<?=$hide_comment_end?>
<?php }?>
