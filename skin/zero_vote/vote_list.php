<?php /* //////////////////////
   <?=$bar_size?> : %로 나타난 설문의 결과치입니다
   ////////////////////// */ ?>

<table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
  <td background=<?=$dir?>/5.gif><img src=<?=$dir?>/5.gif border=0></td>
</tr>
<tr>
  <td colspan=2 style='word-break:break-all;' width=100%>
  <?=$a_vote?><?=$subject?></b></a> ( <?=$vote?> ) <?=$a_modify?><img src=<?=$dir?>/v.gif border=0 align=absmiddle></a> <?=$a_delete?><img src=<?=$dir?>/x.gif border=0 align=absmiddle></a> 
  </td>
</tr>
<tr>
  <td width=100%>
    <table border=0 width=100% height=6 cellspacing=0 cellpadding=0>
    <tr>
     <td width=1%><table border=0 width=100% height=6 bgcolor=666666 cellspacing=0 cellpadding=0><tr><td></td></tr></table></td>
     <td width=90%>
        <table border=0 width=<?=$bar_size?>% height=6 bgcolor=666666 cellspacing=0 cellpadding=0><tr><td></td></tr></table>
     </td>
     <td width=9%><?=$bar_size?>%</td>
    </tr>
    </table>
  </td>
</tr>
</table>
