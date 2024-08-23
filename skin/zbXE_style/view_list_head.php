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


<table width="<?=$width?>" class="xectl" cellSpacing="0" cellpadding="0">
<colgroup span="5">
<col width="80px"></col>
<col></col>
<col width="120px"></col>
<col width="70px"></col>
<col width="100px"></col>
</colgroup>

	<tr class="ctl_title">
	<td class="ctl_titleL">번호</td>
	<td>제목 <?=$total_num?></td>
	<td>글쓴이</td>
	<td>조회수</td>
	<td>날짜</td>
	</tr>
