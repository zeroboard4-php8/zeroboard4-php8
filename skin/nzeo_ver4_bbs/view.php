<?php
	$name = str_replace(">","><font class=list_han>",$name);
	$homepage = str_replace(">","><font class=list_eng></b>",$homepage);
	$a_file_link1 = str_replace(">","><font class=list_eng></b>",$a_file_link1);
	$a_file_link2 = str_replace(">","><font class=list_eng></b>",$a_file_link2);
	$sitelink1 = str_replace(">","><font class=list_eng></b>",$sitelink1);
	$sitelink2 = str_replace(">","><font class=list_eng></b>",$sitelink2);
	$memo = str_replace("<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top>","<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"table-layout:fixed;\"><col width=100%></col><tr><td valign=top class=list_han>",$memo);
?>

<img src=<?=$dir?>/t.gif border=0 height=5><br>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr class=title>
	<td class=title_han style=padding:8px;word-break:break-all;>
		<b><?=$subject?></b>
	</td>
</tr>
<tr class=list1>
	<td height=180 valign=top bgcolor=white>
		<table border=0 cellspacing=0 width=100% style=table-layout:fixed height=30 class=list0>
		<col width=></col><col width=240></col>
		<tr>
			<td nowrap style=padding-left:10px>
				<?=$face_image?> <?=$name?></b>&nbsp;
				<?php
					if($data['homepage']) {
				?><a href="<?=$data['homepage']?>" target=_blank><font class=list_eng>(Homepage)</font></a><?php
					}
				?>
			</td>
			<td align=right style=padding-right:10px class=list_eng><?=$date?>, 조회 : <b><?=number_format($hit)?></b>, 추천 : <b><?=$vote?></b></td>
		</tr>
		</table>
		<table border=0 cellspacing=0 cellpadding=10 width=100% padding=8>
		<tr>
			<td>

				<?=$hide_sitelink1_start?><font class=list_eng>- <b>SiteLink #1</b> : <?=$sitelink1?></font><br><?=$hide_sitelink1_end?>
				<?=$hide_sitelink2_start?><font class=list_eng>- <b>SiteLink #2</b> : <?=$sitelink2?></font><br><?=$hide_sitelink2_end?>
				<?=$hide_download1_start?><font class=list_eng>- <b>Download #1</b> : <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></font><br><?=$upload_image1?><?=$hide_download1_end?>
				<?=$hide_download2_start?><font class=list_eng>- <b>Download #2</b> : <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></font><br><?=$upload_image2?><?=$hide_download2_end?>
		
				<img src=<?=$dir?>/t.gif border=0 width=10><br>
				<?=$memo?>
				<div align=right class=list_eng><?=$ip?></div>
			</td>
		</tr>
		</table>
	</td>

	</td>
</tr>
</table>

<img src=<?=$dir?>/t.gif border=0 height=2><br>


<?php if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?>>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=8><br>
<table width=<?=$width?> cellspacing=1 cellpadding=4>
<col width=100></col><col width=8></col><col width=></col><col width=100></col>
<tr valign=top bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td class=list_eng>바른생활 <b>NZEO</b></td>
		</tr>
		</table>
	</td>
	<td width=8 class=line2 style=padding:0px><img src=/images/t.gif border=0 width=8></td>
	<td class=list_eng>글은 인터넷에서 자신을 나타내는 유일한 모습입니다.<br>상대에게 상처를 주기보다 같이 즐거워 할 수 있는 코멘트 부탁드려요.</td>
	<td align=right><font class=list_eng><?=date("Y-m-d")?><br><?=date("H:i:s")?></font></td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=8><br>
<?=$hide_comment_end?>
<?php }?>
