<tr>  
 <td height=1 colspan=<?=$colnum?>></td>
</tr>
<tr align=center height=25 bgcolor=transparent onMouseOver=this.style.backgroundColor='' onMouseOut=this.style.backgroundColor=''>
<td align=center width=40 class=9px nowrap>&nbsp;&nbsp;&nbsp;<?=$number?>&nbsp;&nbsp;&nbsp;</td>
<td><nobr>&nbsp;&nbsp;<?=$face_image?><?=$name?>&nbsp;&nbsp;</nobr></td>
<td width=85% align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$subject?> &nbsp;<?php
$comment_num="".$data['total_comment']."";
if($data['total_comment']==0) {
  $comment_num="";
}
echo "<span class=9px>$comment_num</span>";
?></td>
<td width=80 align=center nowrap class=9px>&nbsp;<?=$date=date("Y-m-d",$data['reg_date'])?>&nbsp;</td>
<td nowrap align=center width=30 class=9px><?=$hit?>&nbsp;</td>
</tr>


<tr><td olspan=6 height=1 background=<?=$dir?>/line.gif></td></tr>