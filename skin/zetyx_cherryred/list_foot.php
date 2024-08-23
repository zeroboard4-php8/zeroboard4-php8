<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 목록을 다 출력한 다음 마무리 짓는 부분입니다.
  테이블을 닫고 페이지 출력이나 검색 출력, 버튼등을 출력하면 됩니다.
  아래부분은 그대로 사용하시면 됩니다.


  <?=$a_1_prev_page?> : 이전페이지를 출력합니다. (한페이지씩 이동)
  <?=$a_1_next_page?> : 다음 페이지를 출력합니다. (한페이지씩 이동)
  <?=$a_prev_page?> : 이전페이지를 출력합니다.
  <?=$a_next_page?> : 다음 페이지를 출력합니다.  
  <?=$print_page?> : 페이지를 출력합니다
  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_cancel?> : 취소 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_modify?> : 글수정 버튼
  <?=$a_delete_all?> : 관리자일때 나타나는 선택된 글 삭제 버튼;;
  
  */
///////////////////////////////////////////////////////////////////////// ?>

<!-- 마무리 부분입니다 -->
<tr>
<td colspan=10 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=3></td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
 <td></td>
 <td>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
 <td width=40% height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/images/btn_list.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/images/btn_delete.gif border=0 align=absmiddle></a>
  <?=$a_1_prev_page?><img src=<?=$dir?>/images/btn_prevpage.gif border=0 align=absmiddle></a>  
  <?=$a_1_next_page?><img src=<?=$dir?>/images/btn_nextpage.gif border=0 align=absmiddle></a>
</td>
 <td align=center colspan=2 class=thm8 nowrap>
   <?=$print_page?>
 </td>
 <td align=right width=40%>
  <?=$a_write?><img src=<?=$dir?>/images/btn_write.gif border=0 align=absmiddle></a>
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

<table border=0 width=100% cellspcing=0 cellpadding=0>
<tr>
 <td colspan=2 align=center>
    <a href="javascript:OnOff('sn')"><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
    <a href="javascript:OnOff('ss')"><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
    <a href="javascript:OnOff('sc')"><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><img src=images/t.gif width=35 height=1><br>
   <img src=<?=$dir?>/images/search_left.gif align=absmiddle><input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style=font-size:8pt;font-family:Arial;vertical-align:top;border-left-color:#ffffff;border-right-color:#ffffff;border-top-color:<?=$sC_search0?>;border-bottom-color:<?=$sC_search0?>;height:18px;><input type=image border=0 align=absmiddle src=<?=$dir?>/images/search_right.gif><?=$a_cancel?><img src=<?=$dir?>/images/search_right2.gif align=absmiddle border=0></a>
 </td>
</form>
</tr>

<!-- 페이지 출력 ---------------------->
</form>
</table>
</td></tr></table>
</td></tr></table>


