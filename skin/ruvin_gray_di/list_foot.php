</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr><td></td><td>

<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr><td align=right height=25 nowrap>
<?=$a_write?><img src=<?=$dir?>/write.gif border=0 align=absmiddle alt=글쓰기></a>
<?=$a_delete_all?><img src=<?=$dir?>/delete_all.gif border=0 align=absmiddle></a>
<?=$a_1_prev_page?><img src=<?=$dir?>/prev.gif border=0 align=absmiddle alt=이전></a>
<?=$a_list?><img src=<?=$dir?>/list.gif border=0 align=absmiddle alt=목록></a>
<?=$a_1_next_page?><img src=<?=$dir?>/next.gif border=0 align=absmiddle alt=다음></a></td></tr>
</form>
</table>
</td></tr>
<tr><td>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=category value="<?=$category?>">
<!-- 폼태그 끝 -->
</td>
<td height=20><tr></tr>
<tr></tr>
</form>
</form>
</td></tr></table>
</td></tr></table>