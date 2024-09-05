<!-- 버튼 부분 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td bgcolor=<?=$line_color?> height=1 colspan=2>
</tr>
<tr>
 <td width=20% class=change_tahoma_8pt> 
  <?=$a_list?>List</a>
  <?=$a_delete_all?>Admin</a>
 </td>
 <td align=right width=80%  class=change_tahoma_8pt nowrap>
 <?=$a_prev_page?>[prev]</a> <?=$print_page?> <?=$a_next_page?>[next]</a>
 </td>
</form>
</tr>
</table>

<!-- 검색폼 부분 ---------------------->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

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

 <td>

<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=310>
<tr>
<td valign=bottom><a href="javascript:OnOff('sn')" onfocus=this.blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a></td>
<td width=7></td>
<td valign=bottom><a href="javascript:OnOff('ss')" onfocus=this.blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a></td>
<td width=7></td>
<td valign=bottom><a href="javascript:OnOff('sc')" onfocus=this.blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a></td>
<td width=2></td>
<td valign=bottom><input type=text name=keyword value="<?=$keyword?>" <?=size(10)?> class=change_search></td>
<td valign=bottom><input type=image border=0 src=<?=$dir?>/search_right.gif onfocus=this.blur()></td>
<td width=3></td>
<td valign=bottom><?=$a_cancel?><img src=<?=$dir?>/search_right2.gif border=0></a></td>
</tr>
</table>
</form>
</div>

</td>
</tr>
</table>
