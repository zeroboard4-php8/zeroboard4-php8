<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 리스트의 상단 부분을 보여주는 곳입니다
  <?=$a_ 로 시작되는 항목은 HTML의 <a 라고 생각하시면 됩니다.
  뒤에 </a>를 붙여주면 되죠;
  다음은 스킨 제작시 만들수 있는 변수 입니다. 그대로 사용하시면 됩니다;;;;

  <?=$width?> : 게시판의 가로크기
  <?=$dir?> : 스킨디렉토리를 가리킵니다.
  <?=$print_page?> : 페이지를 보여줍니다
  <?=$a_status?> : 통계링크
  <?=$a_login?> : 로그인 버튼
  <?=$a_logout?> : 로그오프버튼
  <?=$a_no?> : 원래순서.. 즉 순서대로 정렬
  <?=$a_subject?> : 제목정렬
  <?=$a_name?> : 이름정렬
  <?=$a_hit?> : 조회수 정렬
  <?=$a_vote?> : 추천수 정렬
  <?=$a_date?> : 날자별 정렬
  <?=$a_download1?> : 첫번재 항목의 자료 다운로드 순서 정렬
  <?=$a_download2?> : 두번째 항목의 자료 다운로드 순서 정렬
  <?=$a_cart?> : 바구니 선택 링크
  <?=$a_category?> : 카테고리 정렬

  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_modify?> : 글수정 버튼
  <?=$a_delete_all?> : 관리자일때 나타나는 선택된 글 삭제 버튼;;

  바구니와 카테고리의 경우 사용하지 않는 수가 있으므로 숨겨놓을때 쓰는 변수;;
  <?=$hide_cart_start?> 내용 <?=$hide_cart_end?> : start 와 end 사이에는 사라짐;; 바구니
  <?=$hide_category_start?> 내용 <?=$hide_category_end?> : Start와 end 사이에는 사라짐;; 바구니
  */ 
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=1>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
</td></tr><tr><td width=100%>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=50 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_no?><img src=<?=$dir?>/images/lh_no.gif border=0 alt="Sort by No"></a></td></tr>
    </table>
  </td>
<?=$hide_cart_start?>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=40 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_cart?><img src=<?=$dir?>/images/lh_cart.gif border=0 alt="Selece / Deselect"></a></td></tr>
    </table>
  </td>
<?=$hide_cart_end?>
<?=$hide_category_start?><td><?=$a_category?></td><?=$hide_category_end?>
  <td width=100%>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=100% background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_subject?><img src=<?=$dir?>/images/lh_subject.gif border=0 alt="Sort by Subject"></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=90 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_name?><img src=<?=$dir?>/images/lh_name.gif border=0 alt="Sort by Name"></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=70 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_date?><img src=<?=$dir?>/images/lh_date.gif border=0 alt="Sort by Date"></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=55 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_hit?><img src=<?=$dir?>/images/lh_read.gif border=0 alt="Sort by Readed Count"></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=18 cellspacing=0 cellpadding=0 width=30 background=<?=$dir?>/images/lh_bg.gif>
       <tr><td align=center valign=top><?=$a_vote?><img src=<?=$dir?>/images/lh_vote.gif border=0 alt="Sort by Voted Count"></a></td></tr>
    </table>
  </td>
</tr>
