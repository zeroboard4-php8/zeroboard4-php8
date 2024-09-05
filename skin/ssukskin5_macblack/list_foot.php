<tr>
   <td colspan=8 bgcolor=#484848><img src=images/t.gif height=2></td></tr>
</table>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
 <td width=40% height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/s_list.gif border=0 align=absmiddle></a><?=$a_delete_all?><img src=<?=$dir?>/s_order.gif border=0 align=absmiddle></a><?=$a_write?><img src=<?=$dir?>/s_write.gif border=0 align=absmiddle></a><?=$a_1_prev_page?><img src=<?=$dir?>/b_prev.gif border=0 align=absmiddle></a><?=$a_1_next_page?><img src=<?=$dir?>/b_next.gif border=0 align=absmiddle></a>
</td>
 <td align=right class=ssuk_page nowrap>
<!-- 페이지 출력 ---------------------->
   <?=$a_prev_page?><img src=<?=$dir?>/s_prevpage.gif border=0 align=absmiddle></a>
   <?=$print_page?>
   <?=$a_next_page?><img src=<?=$dir?>/s_nextpage.gif border=0 align=absmiddle></a>
 </td>
</tr>
</table>
</form>
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
<div align=center>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
    <td><a href="javascript:OnOff('sn')" onfocus='this.blur()'><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a><a href="javascript:OnOff('ss')" onfocus='this.blur()'><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a><a href="javascript:OnOff('sc')" onfocus='this.blur()'><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a></td>
   <td><input type=text name=keyword value="<?=$keyword?>" <?=size(12)?> class=ssuk_input></td>
   <td><input type=image border=0 src=<?=$dir?>/search_right2.gif onfocus='this.blur()'></td>
   <td><?=$a_cancel?><img src=<?=$dir?>/search_right.gif border=0></a></td>
</tr>
</table>
</form>

<?php 
 if($setup['use_category'])
{
?>
   </td>
</tr>
</table>
<?php }?>
