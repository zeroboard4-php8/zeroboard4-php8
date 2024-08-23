<!-- 마무리 부분입니다 -->

<table height=27 border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td colspan=2 height=1 bgcolor=#F5F5F5></td>
</tr>
<tr height=27>
<td align=left>
&nbsp;<?=$a_prev_page?>[prev]</a> <?=$print_page?> <?=$a_next_page?>[next]</a>
</td>
<td align=right class=rini_ver3>
<?=$a_list?>.&nbsp;&nbsp;</a>
<?=$a_write?>.</a>
</td>
</tr>
</form></table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
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
<!----------------------------------------------->
</td></tr>

<tr>
<td align=right>
<input type=text name=keyword value="<?=$keyword?>" style="width:200px; height:18px" class=rini_input>
</td>
</tr>
<tr>
<td height=10></td></tr>
</form></table>