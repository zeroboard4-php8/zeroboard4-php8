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
<table border=0 cellpadding cellspacing=0 width=100%>
<tr>
	  <td background="<?=$dir?>/s_bottom_bg.gif"><img src="<?=$dir?>/s_bottom_bg.gif" border="0"></td>
	</tr>
</table>
<?=$hide_prev_start?>
<table border=0 width=100% cellspacing=0 cellpadding=0 style='table-layout:fixed'>
<tr align=center height="30">
  <td width=90 align=center><img src=<?=$dir?>/p.gif border=0> 이전글<br><img src=images/t.gif height=5></td>
  <td align=left><img src=images/t.gif height=2><br>&nbsp;&nbsp;<?=$a_prev?><?=$prev_subject?></a></td>
  <td nowrap align=right width=100><img src=images/t.gif height=2><br><?=$prev_name?>&nbsp;&nbsp;</td>
</tr>
</table>
<?=$hide_prev_end?>
<table border=0 cellpadding cellspacing=0 width=100%><tr>
<tr>
<td background="<?=$dir?>/s_top_bg.gif"><img src="<?=$dir?>/s_top_bg.gif" border="0"></td>
</tr>
</table>


<?=$hide_next_start?>
<table border=0 width=100% cellspacing=0 cellpadding=0 style='table-layout:fixed'>
<tr align=center height="30">
  <td width=90 align=center><img src=<?=$dir?>/p.gif border=0> 다음글<br><img src=images/t.gif height=5></td>
  <td align=left style='word-break:break-all;'><img src=images/t.gif height=2><br>&nbsp;&nbsp;<?=$a_next?><?=$next_subject?></a></td>
  <td nowrap align=right width=100><img src=images/t.gif height=2><br><?=$next_name?>&nbsp;&nbsp;</td>
</tr>
</table>
<?=$hide_next_end?>
<table border=0 cellpadding cellspacing=0 width=100%>
<tr>
	<td background="<?=$dir?>/s_bottom_bg.gif"><img src="<?=$dir?>/s_bottom_bg.gif" border="0"></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<td colspan=2 height=7><img src=images/t.gif height=1></td></tr>
<tr>
 <td height=23 width=40%>
    <?=$a_list?><img src=<?=$dir?>/list.gif border=0></a>
    <?=$a_write?><img src=<?=$dir?>/w.gif border=0></a>
 </td>
 <td align=right width=60%>
    <?=$a_reply?><img src=<?=$dir?>/re.gif border=0></a>
    <?=$a_modify?><img src=<?=$dir?>/mod.gif border=0></a>
    <?=$a_delete?><img src=<?=$dir?>/del.gif border=0></a>
 </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<br>