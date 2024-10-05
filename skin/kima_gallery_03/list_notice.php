<tr align=center>
  <td height=30 nowrap width=35 align=center class=ver7>@</td>
  <td align=left style="padding-top:3;" colspan=2><?=$insert?><?=$subject?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $comment_num=$data['total_comment'];
if($data['total_comment']==0) {
  $comment_num="";}
echo "<span class=color2>$comment_num</font>";?></td>

<?=$hide_cart_start?>
<td><input type=checkbox name=cart value="<?=$data['no']?>"></td>
<?=$hide_cart_end?>
</tr>

<tr><td colspan=4 height=1 class=line></td></tr>