<!-- 버튼 부분 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> class=kissofgod-listline style='margin-top:25'>
<tr>
  <td colspan=10><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style='padding-top:3'>
<tr>
  <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
  <td class=kissofgod-button-font>
    <?=$a_list?>&nbsp;List&nbsp;</a>
	<?=$a_delete_all?>&nbsp;Order&nbsp;</a>
    <img src=<?=$dir?>/t.gif border=0 width=1 height=1>
  </td>
  <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
<tr>
  <td width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
  <td align=center>
    <?=$a_prev_page?>[PREV]</a> <?=$print_page?> <?=$a_next_page?>[NEXT]</a>  
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
 <td align=center>

<table border=0 cellspacing=0 cellpadding=0>
<tr>
  <td valign=bottom>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 width=32 height=5 name=sn></a><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 width=55 height=5 name=ss></a><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 width=67 height=5 name=sc></a></td>
  <td><input type=text name=keyword value="<?=$keyword?>" class=input-search size=15></td>
  <td valign=bottom><input type=image src=<?=$dir?>/search.gif border=0 width=56 height=11 onfocus=blur()></td>
</tr>
<tr>
  <td colspan=3 height=15><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
</form>
</table>

</td></tr></table>
