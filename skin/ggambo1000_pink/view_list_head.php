<?php $use_view_list_skin=1; ?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=1>
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
</td><td width=100%>
</table>

<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?> class=line1>
<tr>
	<td bgcolor=white>
		<table border=0 cellspacing=1 cellpadding=0 width=100%>
		<col width=50></col><col width=></col><col width=70></col><col width=50></col>
		<?php $coloring=0;?>
