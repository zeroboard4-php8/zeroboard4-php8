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

<!-- <tr>
  <td colspan=2>
   <table border=0 align=center cellpadding=2 cellspacing=1 width=100%>
   <tr>
     <td width=80 class=write>Name</td>
     <td class=write>Memo</td>
   </tr>
   </table>
 </td>
</tr>
<tr>
  <td bgcolor=818181 colspan=2><img src=<?=$dir?>/images/blank.gif width=1 height=1></td>
</tr> -->
<tr>
  <td colspan=2>
   <table border=0 align=center cellpadding=2 cellspacing=1 width=100%>
   <tr>
     <td width=90><?=$c_face_image?> <?=$comment_name?></td>
     <td width=85%><?=$c_memo=nl2br($c_memo);?></td>
     <td nowrap align=right><?=$a_del?><img src=<?=$dir?>/secret_head.gif border=0></a></td>
   </tr>
   </table>
 </td>
</tr>

