<center>
<?php 
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=list_eng>",$a_list)."&nbsp;";
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=list_eng>",$a_reply)."&nbsp;";
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=list_eng>",$a_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=list_eng>",$a_delete)."&nbsp;";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."&nbsp;";
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=list_eng>",$a_vote)."&nbsp;";
?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<col width=10></col><col width=45></col><col width=></col><col width=10></col>
<?=$hide_prev_start?>
<tr><td colspan=4 height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr height=23>
<td></td>
<td><span class=icon>&nbsp;PREV ：</span></td>
<td><span class=list_han>&nbsp;<?=$prev_icon?><?=$a_prev?><?=$prev_subject?></a></span></td>
<td></td>
</tr>
<?=$hide_prev_end?>

<?=$hide_next_start?>
<tr><td colspan=4 height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr height=23>
<td></td>
<td width=45><span class=icon>&nbsp;NEXT ：</span></td>
<td><span class=list_han>&nbsp;<?=$next_icon?><?=$a_next?><?=$next_subject?></a></span></td>
<td></td>
</tr>


<?=$hide_next_end?>
</table>

<table width=<?=$width?> cellspacing=0 cellpadding=0>
<tr><td height=1 bgcolor=#F0F0F0 colspan=2></td></tr>
<tr>
 <td height=40 style='padding:0 0 15 20;'>
<a href='javascript:window.print();'><img src=<?=$dir?>/pipi152.gif width=20 height=20 border=0></a>
   
 </td>
 <td align=right style='padding-bottom:15;'>
     <?=$a_list?>LIST</a>
    <?=$a_write?>WRITE</a>
    <?=$a_reply?>REPLY</a>
    <?=$a_modify?>MODIFY</a>
    <?=$a_delete?>DELETE</a>
    &nbsp;&nbsp;
 </td>
</tr>
</table>


