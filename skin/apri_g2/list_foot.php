

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style='padding-top:3'>

<tr>
  <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
  <td align=center class=num>
    <?=$a_prev_page?><img src=<?=$dir?>/prev.gif border=0></a> 
    <?=$print_page?> 
    <?=$a_next_page?><img src=<?=$dir?>/next.gif border=0></a>
  </td>
  <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
</form>
</table>

<!-- 검색폼 부분 ---------------------->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
 <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1>
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
 <td align=right>

<table border=0 cellspacing=0 cellpadding=0>
<tr>
 <td align=right>
  <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn valign=bottom></a>
  <a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss valign=bottom></a>
  <a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc valign=bottom></a>
  <input type=text name=keyword value="<?=$keyword?>" class=input size=10>   <input type=image src=<?=$dir?>/find.gif border=0 valign=bottom>
  </form>
</td>
</tr>
</table>
</td></tr></table>
