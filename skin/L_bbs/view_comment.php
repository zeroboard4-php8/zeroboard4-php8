<?php
  /* 간단한 답글을 출력하는 부분입니다.
   view.php스킨파일에 간단한 답글을 시작하는 <table>시작 태그가 시작되어 있습니다.
   그리고view_foot.php 파일에 </table>태그가 간단한 답글 쓰기 폼과 같이 있습니다

  <?=$comment_name?> : 글쓴이
  <?=nl2br($c_memo)?>  : 내용
  <?=$c_reg_date?> : 글을 쓴 날자;;
  <?=$a_del?> : 코멘트 삭제 버튼링크
  <?=$c_face_image?> : 멤버용 아이콘;;
 */
?>

<tr onMouseOver=this.style.backgroundColor='#FAFAFA' onMouseOut=this.style.backgroundColor=''>
    <td nowrap width=80><?=$c_face_image?><?=$comment_name?></td>
    <td style='word-break:break-all;'><?=nl2br($c_memo)?></td>
    <td width=25 nowrap style=font-family:tahoma;font-size:7pt><?=$c_reg_date?></td>
    <td width=10 style=font-family:굴림;font-size:8px;color:E40F0F>&nbsp;<?=$a_del?>X</a>&nbsp;</td>
    <td height=20></td>
</tr>


