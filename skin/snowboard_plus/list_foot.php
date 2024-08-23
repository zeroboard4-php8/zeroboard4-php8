<!-- 마무리 부분입니다 -->
 <tr>
 <td colspan=8 bgcolor=fffff height=1></td>
</tr>
 <tr>
 <td colspan=8 bgcolor=000000 height=1></td>
</tr>
</table>

<tr>
 <td></td>
 <td>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
 <td width=40% height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/image/btn_list.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/image/btn_delete.gif border=0 align=absmiddle></a>
</td>
 <td align=center colspan=2 class=t7_g nowrap>
   <?=$a_1_prev_page?>Prev</font></a> <?=$print_page?> <?=$a_1_next_page?>Next</font></a>
 </td>
 <td align=right width=40%>
  <?=$a_write?><img src=<?=$dir?>/image/btn_write.gif border=0 align=absmiddle></a>
 </td>
</tr>
</form>
</table>

 </td>
</tr>
<tr>
 <td>
<!-- 검색폼 부분 ---------------------->
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
 </td>
 <td>

<table border=0 cellpadding=0 align=right>
<tr><td height=10></td></tr>
<tr>
 <td colspan=2 align=center class=t8_gray height=18 valign=absmiddle>
    <a href="javascript:OnOff('sn')"><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn align=absmiddle></a><a href="javascript:OnOff('ss')"><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss align=absmiddle></a><a href="javascript:OnOff('sc')"><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc align=absmiddle></a><img src=<?=$dir?>/image/search_left.gif align=absmiddle><input type=text name=keyword value="<?=$keyword?>" <?=size(10)?> class=sb_search style=font-size:8pt;font-family:Arial;vertical-align:top;border-left-color:#ffffff;border-right-color:#ffffff;border-top-color:;border-bottom-color:;height:18px;><input type=image border=0 align=absmiddle src=<?=$dir?>/image/search_ok.gif></a><?=$a_cancel?><img src=<?=$dir?>/image/search_no.gif align=absmiddle border=0></a>
 </td>
</form>
</tr>
</table>

</td></tr></table>
