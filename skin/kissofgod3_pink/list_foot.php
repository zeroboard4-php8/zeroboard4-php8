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
<tr><td colspan=10 height=1 class='kissofgod-line2'><img src=images/t.gif border=0 width=1 height=1></td></tr>
</table>

<!-- 버튼 부분 -->
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr>
 <td width=40% nowrap style='padding-top:10'> 
  <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a><img src=images/t.gif border=0 width=5 height=1>
  <?=$a_delete_all?><img src=<?=$dir?>/i_admin.gif border=0 align=absmiddle></a></td>
 <td align=center nowrap style='padding-top:10' class=kissofgod-tahoma8>
<!-- 페이지 출력 ---------------------->
   <?=$a_prev_page?>[prev]</a>
   <?=$print_page?>
   <?=$a_next_page?>[next]</a></td>
 <td align=right width=40% style='padding-top:10'>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a></td>
</tr>
</table>
</form>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">

<tr>
  <td align=center>
  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
     <td valign=bottom>
       <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 width=31 height=11 name=sn></a><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 width=55 height=11 name=ss></a><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 width=61 height=11 name=sc></a></td>
     <td style='padding:0 0 0 3'><input type=text name=keyword value="<?=$keyword?>" class=kissofgod-input-search size=15></td>
     <td valign=bottom><input type=image src=<?=$dir?>/search.gif border=0 width=53 height=11 onfocus=blur() title='검색어를 입력하셨으면 누르세요.'></td>
     <td valign=bottom><?=$a_cancel?><img src=<?=$dir?>/search2.gif border=0 width=15 height=11 title='게시판 목록으로 되돌아갑니다.'></a></td>
  </tr>
  </table>

  </td>
</tr>
<tr>
  <td height=10><img src=images/t.gif border=0 width=1 height=1></td>
</tr>
</form>
</table>
