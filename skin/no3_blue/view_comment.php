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
    <td nowrap valign=top>&nbsp&nbsp<font class=blue><?=$c_face_image?><?=$comment_name?></font></td>
    <td style='word-break:break-all;'><font class=blue3><?=str_replace("\n","<br>",$c_memo)?></font></td>
    <td nowrap><font class=blue2><?=$c_reg_date?></font></td>
    <td style=font-family:tahoma;font-size:7px;color:red><?=$a_del?><img src=<?=$dir?>/coment_del.gif border=0></a></td>
</tr>




  