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
    <td width=80 nowrap style='padding:6 0 3 15'><?=$c_face_image?> <?=$comment_name?></td>
    <td style='word-break:break-all;padding:6 0 3 5'><p align=justify><?=nl2br($c_memo)?></p></td>
    <td align=right width=15 style='padding:7 0 3 0'><?=$a_del?><img src=<?=$dir?>/icon_delete.gif border=0 alt='간단한 답글을 삭제합니다.'></td>
    <td align=right width=50 nowrap style='font-family:tahoma;font-size:7pt;padding:5 5 3 0'><?=$c_reg_date?></td>
</tr>
