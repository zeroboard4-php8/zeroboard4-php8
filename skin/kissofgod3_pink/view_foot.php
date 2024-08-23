<?php
 /* 이전 다음글과 버튼 표시
 
  --- 이전/ 이후글 링크 ---
  <?=$a_prev?> : 이전글 링크
  <?=$a_next?> : 다음글 링크

  <?=$prev_face_image?> : 이전글 글쓴이의 얼굴 아이콘?;
  <?=$next_face_image?> : 다음글 글쓴이의 얼굴 아이콘?;


  <?=$hide_prev_start?> <?=$hide_prev_end?> : 이전글 나타나기/ 숨기기
  <?=$hide_next_start?> <?=$hide_next_end?> : 다음글 나타나기/ 숨기기

  기타 제목이나 글쓴이등은 위의 데이타에서 앞에 prev_ , next_ 를 덧 붙인것임;
  ex) 이전글 제목 : <?=$prev_subject?>

  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_vote?> : 추천버튼
  <?=$a_modify?> : 글수정 버튼

 */
?>

<table border=0 cellpadding cellspacing=0 width=<?=$width?>>
<tr><td colspan=10 height=1 class='kissofgod-line2'><img src=images/t.gif width=1 height=1></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td style='padding-top:10'>
    <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a><img src=images/t.gif border=0 width=5 height=1>
    <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
 </td>
 <td align=right style='padding-top:10'>
    <?=$a_reply?><img src=<?=$dir?>/i_reply.gif border=0 align=absmiddle></a>
 </td>
</tr>
</table>
<br><br>
