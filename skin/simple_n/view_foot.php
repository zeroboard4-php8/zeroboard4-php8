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

<!-- 이전 / 다음글 출력 -->
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr><td height=10></td></tr>
<tr><td>
<?=$hide_prev_start?>
<table border=0 cellpadding=0 cellspacing=0 width=90% align=center>
  <tr align=center height=22>
  <td width=8%><img src=<?=$dir?>/image/prev.gif border=0></td>
  <td width=82% align=left style='word-break:break-all;'>&nbsp; <?=$prev_icon?><?=$a_prev?><?=$prev_subject?></a></td>
  <td width=10% nowrap><?=$prev_face_image?> <?=$prev_name?></td>
</tr>

 <tr>
  <td height=1 colspan=3 background=<?=$dir?>/image/dot.gif><img src=<?=$dir?>/image/dot.gif border=0 height=1></td>
  </tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>
<table border=0 cellspacing=0 cellpadding=0 width=90% align=center>

<tr align=center height=22>
  <td width=8%><img src=<?=$dir?>/image/next.gif border=0></td>
  <td width=82% align=left class=thm9 style='word-break:break-all;'>&nbsp; <?=$next_icon?><?=$a_next?><?=$next_subject?></a></td>
  <td width=10% nowrap><?=$next_face_image?> <?=$next_name?></td>
</tr>
</table>
<?=$hide_next_end?>
</td></tr></table>

<!-- 버튼 관련 출력 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr><td height=20 colspan=2></td></tr>
<tr>
<td height=1 colspan=2 background=<?=$dir?>/image/dot.gif><img src=<?=$dir?>/image/dot.gif border=0 height=1></td>
</tr>
<tr><td height=10 colspan=2></td></tr>
<tr height=23>
 <td>&nbsp;&nbsp;
    <?=$a_list?><img src=<?=$dir?>/image/i_list.gif border=0 align=absmiddle></a>
     </td>
 <td align=right>
 <?=$a_write?><img src=<?=$dir?>/image/i_write.gif border=0 align=absmiddle></a>
 <?=$a_reply?><img src=<?=$dir?>/image/i_reply.gif border=0 align=absmiddle></a>
 &nbsp;&nbsp;</td>
</tr>
<tr><td height=10 colspan=2></td></tr>
<tr>
<td height=1 colspan=2 background=<?=$dir?>/image/dot.gif><img src=<?=$dir?>/image/dot.gif border=0 height=1></td>
</tr>
</table>
<br><br>

