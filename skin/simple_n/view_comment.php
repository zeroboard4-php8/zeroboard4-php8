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




<tr><td colspan=4><img width=1 height=3 border=0></a></tr>
<tr valign=top>
    <td nowrap width=100>&nbsp;<?=$c_face_image?><?=$comment_name?></td>
    <td style='word-break:break-all;'><?=str_replace("\n","<br>",$c_memo)?></td>
    <td width=10 align=right>&nbsp;<?=$a_del?>x</a>&nbsp;</td>
    <td width=55 nowrap class=yeinsfont align=right><?=$c_reg_date?></td>

</tr>
<tr><td colspan=4 height=2></td></tr>
<tr><td colspan=4 height=1 background=<?=$dir?>/image/dot.gif><img src=<?=$dir?>/image/dot.gif border=0 height=1></td>
  </tr>

