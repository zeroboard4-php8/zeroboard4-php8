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
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_modify?> : 글수정 버튼
  <?=$a_delete_all?> : 관리자일때 나타나는 선택된 글 삭제 버튼;;
  
  */
///////////////////////////////////////////////////////////////////////// ?>

<!-- 마무리 부분입니다 -->
<tr><td height=1 colspan=10 bgcolor='<?=$list_foot_line?>'></td></tr>
</table>

<!-- 버튼 부분 -->
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=25>
<tr>
  <td width=49%>
    <?=$a_list?><img src=<?=$dir?>/images/i_list.gif width=29 height=9 border=0></a>
	<?=$a_delete_all?><img src=<?=$dir?>/images/i_delete.gif width=43 height=9 border=0></a></td>
  <td align=center nowrap class=thm8>
<!-- 페이지 출력 ---------------------->
    <?=$a_prev_page?>[prev]</a> <?=$print_page?> <?=$a_next_page?>[next]</a>
  </td>
  <td align=right width=49%>
    <?=$a_write?><img src=<?=$dir?>/images/i_write.gif width=36 height=9 border=0></a>
  </td>
</tr>
</form></table>


<table border=0 cellspacing=0 cellpadding=0 align=center>
<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">
  <tr>
<!----- 검색창 ----->
    <td colspan=3 align=center>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 width=32 height=11 name=sn></a><img width=10 height=1><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 width=50 height=11 name=ss></a><img width=10 height=1><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 width=56 height=11 name=sc></a><img width=20 height=1></td>
  </tr>
  <tr>
    <td><input type=text name=keyword value="<?=$keyword?>" <?=size(20)?> class=search></td>
    <td width=57><input type=image src=<?=$dir?>/images/search.gif onfocus=blur() style='width:57;height:19'></td>
	<td width=45><?=$a_cancel?><img src=<?=$dir?>/images/search_no.gif width=45 height=19 border=0></a></td>
  </tr>
</form></table>

<?php
 if($setup['use_category'])
{
?>
   </td>
</tr>
</table>
<?php }?>
