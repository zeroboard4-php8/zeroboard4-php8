<?php //목록 foot파일 출력 부분입니다?>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td></td>
<td>

<!-- 리스트,글쓰기,넘어가기 버튼부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
<td width=40% height=20 nowrap class=ver7> 
<?=$a_list?>list</a>
<?=$a_write?>&nbsp;write</a>
<?=$a_delete_all?>&nbsp;delete</a>
</td>
<td align=right colspan=2 nowrap>
<table cellpadding=0 cellspacing=0 border=0>
<tr align=center>
<td width=3>&nbsp;</td>
<td valign=bottom class=ver7><?=$a_prev_page?>prev</a></td>
<td width=3>&nbsp;</td>
<td class=list-foot-h nowrap><?=$print_page?></td> 
</td>
<td width=3>&nbsp;</td>
<td valign=bottom class=ver7><?=$a_next_page?>next</a></td>
<td width=3>&nbsp;</td>
</tr>
</table>
</td>
</tr>
</form>
</table>
</td>
</tr>
<tr>
<td>
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected><input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
</td>
<td align=center>
 <table border=0 width=100% cellspcing=0 cellpadding=0>
   <tr>
     <td align=right valign=middle><input type=text name=keyword value="<?=$keyword?>" style="width:160px;line-height:100%" class="input"></td>
</form>
</tr>
</table>
</td>
</tr>
</form>
</table>
</td>
</tr>
</table>