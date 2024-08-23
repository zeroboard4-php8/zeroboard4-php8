<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
  <tr>
  <td nowrap><?=$memo_on_sound?></td>
<?php
if($setup['use_category'])
{
?>
  <td height=22 align=left valign=top><?php include "include/print_category.php"; ?></td>
<?php }?>
<td align=right>
<?=$a_member_modify?><img src=<?=$dir?>/images/myinfo.gif border=0></a><?=$a_member_memo?><img src=<?=$dir?>/images/memo.gif border=0></a><?=$a_logout?><img src=<?=$dir?>/images/logout.gif border=0></a><?=$a_setup?><img src=<?=$dir?>/images/setup.gif border=0></a><?=$a_member_join?><img src=<?=$dir?>/images/join.gif border=0></a><?=$a_login?><img src=<?=$dir?>/images/login.gif border=0></a></td>
</tr>
</table>