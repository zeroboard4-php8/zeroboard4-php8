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
<td colspan=7 bgcolor=#FFFFFF><img src=images/t.gif height=3></td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr> 
          <td bgcolor=#999999><img src=images/t.gif height=1></td>
        </tr>
 <td>
<tr>
<!-- 버튼 부분 -->
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr valign=top>
	<td>
		<?=$a_list?><img src=<?=$dir?>/i_list.gif border=0></a>
		<?=$a_delete_all?><img src=<?=$dir?>/i_trace.gif border=0></a>
		<?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0></a>
		<?=$a_1_next_page?><img src=<?=$dir?>/i_next.gif border=0></a>
		<?=$a_write?><img src=<?=$dir?>/i_write.gif border=0></a>
	</td>
	<td align=right>
		<font color=000000 style=font-family:tahoma;font-size:7pt><?=$print_page?></font></a><br>
	</td>
</tr>
</table>

