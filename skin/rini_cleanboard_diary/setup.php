<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=28>
  <tr>
  <td nowrap><?=$memo_on_sound?></td>
<?php
if($setup['use_category'])
{
?>
  <td align=left><?php include "include/print_category.php"; ?></td>
<?php }?>

<td align=right class=rini_ver3>
<?=$a_member_modify?>myinfo&nbsp;</a>
<?=$a_member_memo?>memo&nbsp;</a>
<?=$a_logout?>logout&nbsp;</a>
<?=$a_setup?>admin</a>
<?=$a_member_join?>&nbsp;</a>
<?=$a_login?>아름다운 세상이 보이나요</a>
</td>

</tr>
</table>
