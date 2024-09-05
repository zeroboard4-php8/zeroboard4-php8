<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 목록을 다 출력한 다음 마무리 짓는 부분입니다.
  테이블을 닫고 페이지 출력이나 검색 출력, 버튼등을 출력하면 됩니다.
  아래부분은 그대로 사용하시면 됩니다.

  <?=$a_1_prev_page?>

: 이전페이지를 출력합니다. (한페이지씩 이동)
<?=$a_1_next_page?>
: 다음 페이지를 출력합니다. (한페이지씩 이동)
<?=$a_prev_page?>
: 이전페이지를 출력합니다.
<?=$a_next_page?>
: 다음 페이지를 출력합니다.
<?=$print_page?>
: 페이지를 출력합니다
<?=$a_write?>
: 글쓰기 버튼
<?=$a_list?>
: 목록보기 버튼
<?=$a_reply?>
: 답글쓰기 버튼
<?=$a_delete?>
: 글삭제 버튼
<?=$a_modify?>
: 글수정 버튼
<?=$a_delete_all?>
: 관리자일때 나타나는 선택된 글 삭제 버튼;; */ /////////////////////////////////////////////////////////////////////////
?>
<!-- 마무리 부분입니다 -->
<tr>
  <td height=15 colspan=7></td>
</tr>
</table>
<tr>
<td>
<table cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td><?=$a_write?>
      <img src="<?=$dir?>/w.gif" border="0"></a>&nbsp;
      <?=$a_delete_all?>
      <img src="<?=$dir?>/control.gif" border="0"></a></td>
    <td align=right><?=$a_prev_page?>
      Prev</a>
      <?=$print_page?>
      <?=$a_next_page?>
      Next</a></td>
  </tr>
  </form>
</table>
</td></tr>
<tr>
<td>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> align=right>
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
    <tr>
      <td align=right><table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td><input type=text name=keyword value="<?=$keyword?>" class=search size=15></td>
          <td><input type=image src=<?=$dir?>/search.gif border=0 onfocus=blur()></td>
        </tr>
  </form>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<br>
