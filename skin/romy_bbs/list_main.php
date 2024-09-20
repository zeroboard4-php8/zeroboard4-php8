<tr>
<td width="45" height="30" nowrap align="center" class="thm6" style="padding-top:2;"><b><?=$number?></b></td>
<td align=left style="padding-top:3;"><?=$insert?><?=$subject?>&nbsp;&nbsp;<?php $comment_num=$data['total_comment'];
if($data['total_comment']==0) {
  $comment_num="";}
echo "<span class=color2>$comment_num</span>";?>&nbsp;&nbsp;</td>

<td nowrap align=right style="padding-top:3; padding-left:5; padding-right:10;"></td>
  <td nowrap width=40 align=center class=thm7 style="padding-top:2;"></td>
<?=$hide_cart_start?>
<td><input type=checkbox name=cart value="<?=$data['no']?>"></td>
<?=$hide_cart_end?>
</tr>

<tr><td colspan=6 height=1 class=line></td></tr>