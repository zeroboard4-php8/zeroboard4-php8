<?php
  /* 간단한 답글을 출력하는 부분입니다.
   view.php스킨파일에 간단한 답글을 시작하는 <table>시작 태그가 시작되어 있습니다.
   그리고view_foot.php 파일에 </table>태그가 간단한 답글 쓰기 폼과 같이 있습니다

  <?=$comment_name?> : 글쓴이
  <?=$c_memo?> : 내용
  <?=$c_reg_date?> : 글을 쓴 날자;;
  <?=$a_del?> : 코멘트 삭제 버튼링크
  <?=$c_face_image?> : 멤버용 아이콘;;
 */
?>

<tr valign=top onMouseOver=this.style.backgroundColor='<?=$list_mouse_over_color?>' onMouseOut=this.style.backgroundColor=''>
     <td width=80 nowrap><img src=images/t.gif border=0 height=1 width=80><br><?=$c_face_image?> <?=$comment_name?></td>
     <td width=100% style='word-break:break-all;'><?=nl2br($c_memo)?></td>
     <td width=80 nowrap align=right><font class=commentnum>&nbsp;<?=$c_reg_date?>&nbsp;</font></td>
     <td nowrap align=right>&nbsp;<?=$a_del?><img src=<?=$dir?>/secret_head.gif border=0></a></td>
</tr>

