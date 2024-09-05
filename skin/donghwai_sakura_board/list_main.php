<table border="0" cellpadding="0" cellspacing="0" align="center" width=<?=$width?>>
<tr align="center" onMouseOver="this.style.backgroundColor='FFFBFE'" onMouseOut="this.style.backgroundColor=''">
<?=$hide_cart_start?><td width="30" height="25" valign="middle"><span class=v91><input type=checkbox name=cart value="<?=$data['no']?>"></span></td><?=$hide_cart_end?>
<td width="60" height="25" valign="middle">
<span class=v81><?=$number?></span></td>
<td height="25" valign="middle" align="left">
<span class=v91><?=$insert?><?=$icon?><?=$hide_category_start?>[<?=$category_name?>]<?=$hide_category_end?> <?=$subject?> <?php 
$comment_num="".$data['total_comment']."";
if($data['total_comment']==0) {
  $comment_num="";
}
echo "<span class=v7>$comment_num</span>";
?></span></td>
<td width="120" height="25" valign="middle">
<span class=v91><?=$face_image?> <?=$name?></span></td>
<td width="100" height="25" valign="middle">
<span class=v81><?=$reg_date?></span></td>
<td width="60" height="25" valign="middle">
<span class=v81><?=$hit?></span></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>