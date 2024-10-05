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
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td height=1 bgcolor="#efefef">
</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
 <td height=4></td>
<td>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
 <td align=left> 
  <font class=thm7><?=$a_delete_all?>Delete</a></font>
</td>
 <td align=right>
<font class=thm7><?=$a_1_prev_page?>[prev]</a></font>
<font class=thm7><?=$print_page?></font>
  <font class=thm7><?=$a_1_next_page?>[next]</a></font>
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
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
<!----------------------------------------------->
 </td>
 <td>
<table border=0 width=100% cellspacing=0 cellpadding=0>
<tr>
 <td align=center>
<input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style="width:100;height:19;"><img width="3"><input type=submit value="확인" class="submit" style="height:19;">
 </td>
			  </tr>
  </form>
</tr>
<!-- 페이지 출력 ---------------------->
</form>
</table>
</td></tr></table>
</td></tr></table>
<br>