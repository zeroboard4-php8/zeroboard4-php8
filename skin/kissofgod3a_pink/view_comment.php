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
  <td align=right>
   <table border=0 cellpadding=0 cellspacing=0 width=95% style='margin:10 0 10 0'>
     <tr valign=bottom>
      <td nowrap style='padding:5 15 0 10'><?=$c_face_image?> <?=$comment_name?></td>
	  <td width=100% style='font-family:tahoma;font-size:7pt; padding:5 5 0 0'><?=$c_reg_date?><?=$a_del?><img src=<?=$dir?>/icon_del.gif border=0 style='margin:0 0 1 10'></a></td>
	 </tr>
     <tr>
      <td colspan=2 class=kissofgod-comment-font style='word-break:break-all; padding:5 10 0 10'><p align=justify><?=nl2br($c_memo)?></p></td>
     </tr>
   </table>
 </td>
</tr>