<!-- 마무리 부분입니다 -->
<tr>
<td colspan=6 height=2></td>
</tr>

<tr>
<td colspan=6 height=1 bgcolor=#F3F3F3></td>
</tr>
</table>

<table height=28 border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td align=left class=rini_ver4>
&nbsp;<?=$a_prev_page?>[prev]</a> <?=$print_page?> <?=$a_next_page?>[next]</a>
</td>
<td align=right>
<?=$a_list?><img src=<?=$dir?>/images/list.gif border=0></a><?=$a_delete_all?><img src=<?=$dir?>/images/delete.gif border=0></a><?=$a_write?><img src=<?=$dir?>/images/write.gif border=0></a>
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
 <td align=right><a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><input type=text name=keyword value="<?=$keyword?>" <?=size(12)?> class=rini_input><input type=submit value='search' class=rini_submit3><?=$a_cancel?><input type=submit value='cancel' class=rini_submit3></a>
 </td>
</tr>
<tr>
<td height=8></td>
</tr>
</form></table>