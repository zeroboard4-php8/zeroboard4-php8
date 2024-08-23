<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=13></col> <col width=></col> <col width=13></col>
<tr>
  <td><img src=<?=$dir?>/1.gif border=0></td>
  <td background=<?=$dir?>/2.gif width=100%>
  <td><img src=<?=$dir?>/3.gif border=0></td>
</tr>

<tr>
  <td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
  <td width=100%>
  
    <table border=0 cellspacing=0 cellpadding=0 width=100% height=25>
    <tr>
      <td width=70>Subject</td>
      <td style='word-break:break-all;'><img src=images/t.gif border=0 height=1><br><?=$subject?>
				       <font size=1 color=444444>(<?=$vote?> voted)</td>
    </tr>
    </table>

<?php
  //// 삭제하지 마세요;; 설문조사를 위한 프로그램 불러오는 부분입니다 //////
  include "include/vote_check.php";
  //// 위의 파일에서는 현재 스킨디렉토리의 vote_list.php파일을 불러씁니다///
?>

  </td>
  <td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
</tr>

<tr>
  <td><img src=<?=$dir?>/7.gif border=0></td>
  <td background=<?=$dir?>/8.gif width=100%>
  <td><img src=<?=$dir?>/9.gif border=0></td>
</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>
