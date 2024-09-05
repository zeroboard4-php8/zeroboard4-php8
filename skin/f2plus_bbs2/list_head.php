<?php $coloring=0;
 if($setup['use_category']==1) $num=11;
   else $num=9;
  ?>
<table border=0 cellspacing=1 cellpadding=4 width=<?=$width?> align=center style=table-layout:fixed>
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

<?php if(substr($id, 0, 4) != "club" && substr($id, 0, 5) != "class"){ ?>
<col width=50></col><?=$hide_category_start?><col width=1></col><col width=80></col><?=$hide_category_end?><col width=1></col><col width=></col><col width=1></col><col width=100></col><col width=1></col><col width=70><col width=1></col></col><col width=50></col>
<tr bgcolor=ECECEC height=1>
<td colspan=<?=$num?>>
</td>
</tr>
<tr align=center valign="middle" height=25 bgcolor=f3f3f3>
	<td class=title_han2><?=$a_no?>번호</td><?=$hide_category_start?>
	<td bgcolor=CDCDCD></td>
	<td nowrap  class=title_han2><?=$a_category?></td><?=$hide_category_end?>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_subject?>제목</td>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_name?>이름</td>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_date?>작성일</td>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_hit?>조회</td>
</tr>
<tr bgcolor=ECECEC height=1>
<td colspan=<?=$num?>>
</td>
</tr>
<tr bgcolor=ffffff height=1>
<td colspan=<?=$num?>>
</td>
</tr>
<?php }else{ 
	$num1 = $num - 1;	
?>
<col width=50></col><?=$hide_category_start?><col width=1></col><col width=80></col><?=$hide_category_end?><col width=1></col><col width=></col><col width=1></col><col width=70></col><col width=1></col><col width=70><col width=1></col></col>
<tr bgcolor=ECECEC height=1>
<td colspan=<?=$num1?>>
</td>
</tr>
<tr align=center valign="middle" height=25 bgcolor=f3f3f3>
	<td class=title_han2><?=$a_no?>번호</td><?=$hide_category_start?>
	<td bgcolor=CDCDCD></td>
	<td nowrap  class=title_han2><?=$a_category?></td><?=$hide_category_end?>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_subject?>제목</td>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_name?>이름</td>
	<td bgcolor=CDCDCD></td>
	<td class=title_han2><?=$a_date?>작성일</td>
</tr>
<tr bgcolor=ECECEC height=1>
<td colspan=<?=$num1?>>
</td>
</tr>
<tr bgcolor=ffffff height=1>
<td colspan=<?=$num1?>>
</td>
</tr>
<?php } ?>
