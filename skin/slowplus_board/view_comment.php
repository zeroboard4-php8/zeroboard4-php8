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

<tr valign=top bgcolor='<?=$comment_view_bg?>' onMouseOver="this.style.backgroundColor='<?=$comment_over_bg?>'" onMouseOut="this.style.backgroundColor=''">
  <td align=right width='<?=$comment_name_width?>' style='padding-top:6;padding-bottom:3'><?=$c_face_image?> <?=$comment_name?></td>
  <td width=1 style='padding-top:6;padding-bottom:3'>&nbsp;:&nbsp;</td>
  <td style='word-break:break-all;padding-top:6;padding-bottom:3'><?=nl2br($c_memo)?></td>
  <td width=10 style='padding-top:7;padding-bottom:2'><?=$a_del?><img src=<?=$dir?>/secret_head.gif width=9 height=9 border=0></a></td>
  <td align=center width=55 class=thm7 style='padding-top:6;padding-bottom:3'><?=$c_reg_date?></td>
</tr>
