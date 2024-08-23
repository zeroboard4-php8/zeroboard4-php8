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

<tr>
   <td align=center>

  <table border=0 width=90%>
  <tr>
   <td style='word-break:break-all;font-size:9pt;font-color:444444' width=98%>
   <?=$c_face_image?> <?=$comment_name?> </b> <font color=888888 size=1>:::</font> <?=$c_memo?> <?=$c_reg_date?> </td>
   <td align=right size=2%><font color=red><?=$a_del?>x</a>
  </tr>
  </table>

   </td>
</tr>

