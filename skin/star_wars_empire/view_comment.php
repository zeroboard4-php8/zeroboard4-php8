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
  <td colspan=2>
   <table border=0 align=center cellpadding=2 cellspacing=1 width=100% bgcolor=<?=$sC_light01?>>
   <tr align=center bgcolor=<?=$sC_light01?>>
     <td width=10% align=right style='word-break:break-all;' nowrap><?=$c_face_image?> <?=$comment_name?></td>
     <td width=70 style='word-break:break-all;' nowrap class=thm8><font style=font-size:7pt;>&nbsp;[<?=$c_reg_date?>]</td>
     <td width=1%nowrap class=thm8><b>&nbsp;::</b><br><img src=images/t.gif height=5></td>
     <td align=left style='word-break:break-all;'>&nbsp;<?=$c_memo?></td>
     <td width=20><?=$a_del?><img src=<?=$dir?>/secret_head.gif border=0></a></td>
   </tr>
   </table>
 </td>
</tr>

