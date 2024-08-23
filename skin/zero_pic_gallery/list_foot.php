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

<?php
 // 리스트에서 모자라는 <Td> 부분 마저 출력함.. 쿨럭/////////////////////
 for($_i=$_x;$i<$_h_hum;$i++)
 {
?>
	<td>&nbsp;</td>
<?php
 }
 ////////////////////////////////////////////////////////////////////////
?>

<tr>
  <td height=1 colspan=<?=$_h_num?> background=<?=$dir?>/dot.gif><img src=<?=$dir?>/dot.gif border=0 height=1></td>
</tr>

<!-- 마무리 부분입니다 -->
</table>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
 <td width=100% align=left colspan=2 class=font-family:matchworks;font-size:8pt nowrap>
  <?=$a_prev_page?>[PREV]</a> <?=$print_page?> <?=$a_next_page?>[NEXT]</a>  
 </td>
 <td align=right height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
  <?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0 align=absmiddle></a>  
  <?=$a_1_next_page?><img src=<?=$dir?>/i_back.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/i_delete.gif border=0 align=absmiddle></a>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
 </td>
</tr>
</form>
</table>

<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
	<td width=1>
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
 <td align=center>

<table border=0 cellspcing=0 cellpadding=0>
<tr>
 <td align=center>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
    <a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
    <a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><img src=images/t.gif width=35 height=1>
  </td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
  <td><img src=<?=$dir?>/s_left.gif align=absmiddle></td>
  <td background=<?=$dir?>/s_bg.gif width=100><input type=text name=keyword value="<?=$keyword?>" class=input2 size=20></td>
  <td><input type=image src=<?=$dir?>/search.gif border=0></td>
  <td><?=$a_cancel?><img src=<?=$dir?>/cancel.gif align=absmiddle border=0></a></td>
</form>
</tr>
</table>

	</td>
</tr>
</table>


