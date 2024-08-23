<?php 
    $memostr = explode("||",$c_memo);
    if ($memostr[1] =="") {
	$memostr[1] = 1;
    }
?>
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

<tr valign=top>
    <td><table border=0 cellspacing=0 cellpadding=0 height=6><tr><td></td></tr></table>
<table align=center cellpadding=1 cellspacing=10 width=99% class=com>
<tr>
<td width=200>
<?=$c_face_image?><?=$comment_name?> <font class=bar>|</font> </b><font class=en color=d6bf03><?=$c_reg_date?></font> <b><font class=bar>|</font></b> <?=$a_del?>x</a></td></tr>
<td>
<?=str_replace("\n","",$memostr[0])?></td>

</tr>
</table>