
<?php 
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=list_eng2>",$a_list)."&nbsp;";
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=list_eng2>",$a_reply)."&nbsp;";
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=list_eng2>",$a_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=list_eng2>",$a_delete)."&nbsp;";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=list_eng2>",$a_write)."&nbsp;";
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=list_eng2>",$a_vote)."&nbsp;";
?>

<img src=/images/t.gif border=0 height=0><br>

<table width=100% cellspacing=0 cellpadding=0>
<tr>
   <td height=5 width=100%  colspan=10>
   <table border=0  cellspacing=0 cellpadding=0 width=100% height=5><tr><td height=100% width=100% background=<?=$dir?>/line.gif ><img src=<?=$dir?>/line_left_icon.gif border=0 height=5></td>    <td background=<?=$dir?>/line.gif align=right ><img src=<?=$dir?>/line_right_icon.gif border=0 height=5></td></tr></table>
   </td>
</tr>
<tr>
 <td height=25>
 </td>
 <td align=right>
     <font face=Verdana><span style=font-size:8pt><?=$a_list?>LIST</a>
    <?=$a_write?>WRITE</a>
    <?=$a_reply?>REPLY</a>
    <?=$a_modify?>MODIFY</a>
    <?=$a_delete?>DELETE</a></span></font>
    &nbsp;&nbsp;
 </td>
</tr>
</table></td></tr></table>

<br>
