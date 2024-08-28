<center>
<?php
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=list_eng>",$a_list)."&nbsp;";
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=list_eng>",$a_reply)."&nbsp;";
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=list_eng>",$a_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=list_eng>",$a_delete)."&nbsp;";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."&nbsp;";
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=list_eng>",$a_vote)."&nbsp;";
?>

<img src=/images/t.gif border=0 height=0><br>

<table width=<?=$width?> cellspacing=0 cellpadding=0>
<tr><td height=1 bgcolor=#F3F3F3 colspan=2></td></tr>
<tr>
 <td height=40 style='padding:0 0 15 10;'>
<a href='javascript:window.print();'><img src=<?=$dir?>/print_icon.gif width=52 height=15 border=0></a>
   
 </td>
 <td align=right style='padding:0 10 15 0;'>
     <?=$a_list?>목록</a>
    <?=$a_write?>쓰기</a>
    <?=$a_reply?>답변</a>
    <?=$a_modify?>수정</a>
    <?=$a_delete?>삭제</a>
 </td>
</tr>
</table>


