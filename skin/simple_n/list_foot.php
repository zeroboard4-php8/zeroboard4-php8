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


</table>

<table border=0 cellpadding=0 cellspacing=0 width=100%>

<!-- 버튼 부분 -->
<tr>
 <td align=center class=page>

<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td>
&nbsp;&nbsp;&nbsp;<?=$a_1_prev_page?><img src=<?=$dir?>/image/prev.gif border=0 align=absmiddle alt=이전></a>
	<?=$print_page?>
    <?=$a_1_next_page?><img src=<?=$dir?>/image/next.gif border=0 align=absmiddle alt=다음></a>
</td>

<td align=right width=131>

<table width=100% border=0 cellspacing=0 cellpadding=0 height=28>
<tr>
<td align=center width=65>
<?=$a_delete_all?><img src=<?=$dir?>/image/i_delete.gif border=0 align=absmiddle></a>
</td>
<td width=1 valign=top>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center width=65>
<?=$a_write?><img src=<?=$dir?>/image/i_write.gif border=0 align=absmiddle></a>
</td></tr></table>

</td></tr></table>




 </td>
</tr>
</form>

<tr>
  <td height=4 background=<?=$dir?>/image/v_bg1.gif></td>
</tr>

<tr>
 <td height=10>
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
 </tr>

 <tr height=30>
 <td height=30 valign=bottom>

<table border=0 width=100% cellspacing=0 cellpadding=0 height=16>
<tr>
 <td height=16 align=right valign=bottom>
    &nbsp;&nbsp;<a href="javascript:OnOff('sn')" onfocus='this.blur()'><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn align=absmiddle></a>
    <a href="javascript:OnOff('ss')" onfocus='this.blur()'><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss align=absmiddle></a>
    <a href="javascript:OnOff('sc')"onfocus='this.blur()' ><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc align=absmiddle></a>
	<input type=text name=keyword value="<?=$keyword?>" <?=size(10)?> class=input2 style="width:80;height:20;"><input type=image border=0 src=<?=$dir?>/image/search.gif align=absmiddle><?=$a_cancel?><img src=<?=$dir?>/image/cancel.gif border=0 align=absmiddle></a>
 </td>

</form>
</tr>

<!-- 페이지 출력 ---------------------->
</form>
</table>
</td></tr></table>

</td></tr>

<tr>
  <td height=5></td>
</tr>
</table>

