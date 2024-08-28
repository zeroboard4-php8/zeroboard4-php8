<?php
 /* 이전 다음글과 버튼 표시
 
  --- 이전/ 이후글 링크 ---

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

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td colspan=10 height=1 class=pqbig-line2><img src=images/t.gif width=1 height=1></td></tr>
</table>
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?>>
<tr height=23 nowrap>
 <td class='pqbig-ver7' style='padding:5 0 0 3'>
    <?=$a_list?><img src="<?=$dir?>/vf_list.gif" border=0 align=absmiddle></a>
    <?=$a_write?><img src="<?=$dir?>/vf_write.gif" border=0 align=absmiddle></a>
    <?=$a_modify?><img src=<?=$dir?>/vf_modify.gif border=0 align=absmiddle></a>
    <?=$a_delete?><img src=<?=$dir?>/vf_delete.gif border=0 align=absmiddle></a>
 </td>
 <td align=right class='pqbig-ver7' nowrap>
    <?=$a_reply?><img src="<?=$dir?>/vf_reply.gif" border=0 align=absmiddle></a>
 </td>
</tr>
</table>
<br><Br>