<?php $coloring=0;?>
<table border=0 cellspacing=1 cellpadding=4 width=<?=$width?> style=table-layout:fixed>
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
<col width=50></col><?=$hide_category_start?><col width=80></col><?=$hide_category_end?><col width=></col><col width=100></col><col width=70></col><col width=50></col><col width=50></col>
<tr align=center class=title>
	<td class=title_han height=30>번호</td>
	<?=$hide_category_start?><td class=title_han nowrap><?=$a_category?></td><?=$hide_category_end?>
	<td class=title_han>제목</td>
	<td class=title_han>작성자</td>
	<td class=title_han>작성일</td>
	<td class=title_han><?=$a_vote?><font class=title_han>추천</font></a></td>
	<td class=title_han><?=$a_hit?><font class=title_han>조회</font></a></td>
</tr>

