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
   <td colspan=10 bgcolor=<?=$list_footer_bg_color?>><img src=images/t.gif height=3></td></tr>
</table>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
 <td width=40% height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/i_admin.gif border=0 align=absmiddle></a>
  <?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0 align=absmiddle></a>  
  <?=$a_1_next_page?><img src=<?=$dir?>/i_next.gif border=0 align=absmiddle></a>
</td>
 <td align=center colspan=2 class=listnum nowrap>
<!-- 페이지 출력 ---------------------->
   <?=$a_prev_page?>[prev]</a>
   <?=$print_page?>
   <?=$a_next_page?>[next]</a>
 </td>
 <td align=right width=40%>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
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
    <a href="javascript:OnOff('sn')"><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
    <a href="javascript:OnOff('ss')"><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
    <a href="javascript:OnOff('sc')"><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><img src=images/t.gif width=35 height=1>
<Br>

<table border=0 cellspacing=0 cellpadding=0>
<tr>
   <td><img src=<?=$dir?>/search_left.gif></td>
   <td><input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style=font-size:8pt;font-family:Arial;vertical-align:top;border-left-color:#ffffff;border-right-color:#ffffff;border-top-color:<?=$list_footer_bg_color?>;border-bottom-color:<?=$list_footer_bg_color?>;height:18px;></td>
   <td><input type=image border=0 src=<?=$dir?>/search_right.gif></td>
   <td><?=$a_cancel?><img src=<?=$dir?>/search_right2.gif border=0></a></td>
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
<?php } ?>
