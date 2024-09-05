</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td></td>
<td>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td align=left height=15 nowrap class=cub><span class=t7><font title="글쓰기"><?=$a_write?>&nbsp;W&nbsp;&nbsp;</a></font><font title="게시물정리"><?=$a_delete_all?>D&nbsp;&nbsp;</a></font><a href=javascript:show(down) onfocus=this.blur() title=검색>S</a></span></td>
<td align=right height=15 nowrap class=cu><?=$a_prev_page?>&lt;&lt;</a> <?=$print_page?></a> <?=$a_next_page?>&gt;&gt;</a>&nbsp;</td>
</tr>
</form>
</table>
</td></tr>

<tr>
<td>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
<!-- 폼태그 끝 -->
</td>
<td width=100% align=right>
<span id="down" style="display:none;width:300px">
<table border=0 width=40% cellspcing=0 cellpadding=0>
<tr>
<td align=right><input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input2></td>
<tr></tr>
<tr></tr>
</form>
</tr>
</form>
</table>
</td></tr>
</table>
</td></tr>
</table>