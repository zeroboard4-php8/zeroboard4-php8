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
  <td>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr>
    <td colspan=5 height=1 bgcolor=eeeeee></td>
  </tr>
  <tr>
    <td colspan=5 height=5 ></td>
  </tr>
  <tr> 
    <td  width=50 valign=top><B>
      <?=$comment_name?>
      </B></td>
    <td width=15 ></td>
    <td  align=LEFT valign=top >
      <?=nl2br($c_memo)?>
    </td>
    <td width=100 class=pqbig-thm7 align=right valign=top >[ <?=$c_reg_date?> ] <?=$a_del?> D</td>
  </tr>
  <tr>
    <td colspan=5 height=5 ></td>
  </tr>
</table>
 </td>
</tr>
