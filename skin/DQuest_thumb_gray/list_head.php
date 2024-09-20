<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> class=thumb_bg>
	<form method=post name=list action=list_all.php>
	<input type=hidden name=page value=<?=$page?>>
	<input type=hidden name=id value=<?=$id?>>
	<input type=hidden name=select_arrange value=<?=$select_arrange?>>
	<input type=hidden name=desc value=<?=$desc?>>
	<input type=hidden name=page_num value=<?=$page_num?>>
	<input type=hidden name=selected>
	<input type=hidden name=exec>
	<input type=hidden name=keyword value="<?=$keyword?>">
	<input type=hidden name=sn value="<?=$sn?>">
	<input type=hidden name=ss value="<?=$ss?>">
	<input type=hidden name=sc value="<?=$sc?>">
<tr><td height=10 class=thumb_area_bg><img src=<?=$dir?>/t.gif border=0 height=10></td></tr>
<tr><td class=thumb_area_bg align=<?=$_thumb_area_align?>>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr><td style='padding-left:<?=$_thumb_area_hmargin?>;padding-right:<?=$_thumb_area_hmargin?>;'>
<?php 
	if (!$_gd_on && $is_admin) {
?>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td class=thumb_han><img src=<?=$dir?>/t.gif border=0 width=5 align=absmiddle>
	::&nbsp;gd 라이브러리가 로드되어 있지 않아 썸네일이 생성되지 않습니다. php 설정을 확인하십시오.
	</td>
</tr>
</table>
<?php
	}
	if (!$_exif_loaded && $is_admin) {
?>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td class=thumb_han><img src=<?=$dir?>/t.gif border=0 width=5 align=absmiddle>
	::&nbsp;exif 라이브러리가 로드되어 있지 않습니다. php 설정을 확인하십시오.
	</td>
</tr>
</table>
<?php
	}
?>