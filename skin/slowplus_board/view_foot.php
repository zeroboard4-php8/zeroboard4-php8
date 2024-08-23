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


<!-- 버튼 관련 출력 -->


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr>
  
<td colspan=2 height=1 bgcolor='<?=$view_foot_line?>'></td>

</tr>

<tr>
  
<td height=2></td>

</tr>

<tr>
  
<td>
    
<?=$a_list?><img src=<?=$dir?>/images/i_list.gif width=29 height=9 border=0></a>
	
<?=$a_write?><img src=<?=$dir?>/images/i_write.gif width=36 height=9 border=0></a>
  
</td>
  
<td align=right>
    
<?=$a_reply?><img src=<?=$dir?>/images/i_reply.gif width=37 height=9 border=0></a>
	
<?=$a_vote?><img src=<?=$dir?>/images/i_vote.gif width=34 height=9 border=0></a>
<?=$a_modify?><img src=<?=$dir?>/images/i_modify.gif width=42 height=9 border=0></a>
	
<?=$a_delete?><img src=<?=$dir?>/images/i_delete.gif width=43 height=9 border=0></a>
  
</td>

</tr>

<tr>
  
<td height=20></td>

</tr>

</table>



<!-- 이전 / 다음글 출력 -->


<?=$hide_prev_start?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr>
  
<td colspan=5 height=1 bgcolor='<?=$view_list_line?>'></td>

</tr>

<tr align=center height=22 bgcolor='<?=$view_list_bg?>' onMouseOver="this.style.backgroundColor='<?=$view_list_over_bg?>'" onMouseOut="this.style.backgroundColor=''">
  
<td align=left width=40 class=thm8 style='padding-left:20'>Prev</td>
  
<td align=left style='word-break:break-all;'><img width=1 height=3><br>&nbsp;<?=$a_prev?><?=$prev_subject?></a></td>
  
<td width='<?=$head_name?>'><?=$prev_face_image?> <?=$prev_name?></td>
  
<td width='<?=$head_date?>' class=thm8><?=$reg_date?></td>
  
<td width='<?=$head_hit?>' class=thm8 style='padding:0 5'><?=$hit?></td>

</tr>

</table>

<?=$hide_prev_end?>


<?=$hide_next_start?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<tr>
  
<td colspan=5 height=1 bgcolor='<?=$view_list_line?>'></td>

</tr>

<tr align=center height=22 bgcolor='<?=$view_list_bg?>' onMouseOver="this.style.backgroundColor='<?=$view_list_over_bg?>'" onMouseOut="this.style.backgroundColor=''">
  
<td align=left width=40 class=thm8 style='padding-left:20'>Next</td>
  
<td align=left style='word-break:break-all;'><img width=1 height=3><br>&nbsp;<?=$a_next?><?=$next_subject?></a></td>
  
<td width='<?=$head_name?>'><?=$next_face_image?> <?=$next_name?></td>
  
<td width='<?=$head_date?>' class=thm8><?=$reg_date?></td>
  
<td width='<?=$head_hit?>' class=thm8 style='padding:0 5'><?=$hit?></td>

</tr>

<tr>
  
<td colspan=5 height=1 bgcolor='<?=$view_list_line?>'></td>

</tr>

</table>


<?=$hide_next_end?>