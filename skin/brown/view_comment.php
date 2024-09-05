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
		<td background="<?=$dir?>/s_top_bg.gif" colspan="2"><img src="<?=$dir?>/s_top_bg.gif" border="0"></td>
	</tr>
	<tr height=22>
		<td><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td nowrap width=90 valign=top style='padding:7 0 7 5;'><?=$c_face_image?> <b><?=$comment_name?></td>
		<td style='word-break:break-all; padding:7 7 7 0;'><?=nl2br($c_memo)?><br><img height=7><br><font class=ver7><?=$c_reg_date?></font> <a class=ver8 onfocus=blur() href='del_comment.php?<?=$href?><?=$sort?>&no=<?=$no?>&c_no=<?=$c_data['no']?>'>- Delete</a></td>
  </tr>
</table>
</td>
	</tr>