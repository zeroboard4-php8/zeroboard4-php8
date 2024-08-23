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
<td colspan=9 ></td></tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
 <td>

<!-- 버튼 부분 -->
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
 <td width=20% height=30 nowrap>
  <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/delete.gif border=0 align=absmiddle></a>
  </td>
 <td align=center>
<?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0 align=absmiddle alt=이전></a>
  <?=$print_page?>
  <?=$a_1_next_page?><img src=<?=$dir?>/i_next.gif border=0 align=absmiddle alt=다음></a>
</td>

 <td align=right height=30 width=20%>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>

 </td>
</tr>
</form>
</table>

 </td>
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
 <tr>
 <td>


<table border=0 width=100% cellspcing=0 cellpadding=0 height=16>
<tr>
 <td colspan=2 align=center height=16>
    <input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style="width:185;height:16;background-color:#ffffff;border:1 solid #E3E3E3; font-size:9pt;color:#444444;">
 </td>
 </tr>
<tr>
 <td colspan=2 align=center height=20>
    <a href="javascript:OnOff('sn')" title="이름" onfocus='this.blur()'><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
    <a href="javascript:OnOff('ss')" title="제목" onfocus='this.blur()'><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
    <a href="javascript:OnOff('sc')" title="내용" onfocus='this.blur()'><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>
	<input type=image border=0 src=<?=$dir?>/search.gif>&nbsp;</a>
 </td>
</form>
</tr>

<!-- 페이지 출력 ---------------------->
</form>
</table>
</td></tr></table>
</td></tr></table>

