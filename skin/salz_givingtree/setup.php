<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td style=font-family:arial;font-size:8pt; align=left>
  <font color=4F3A16>
  &nbsp; Total : <b><?=$setup['total_article']?></b><?php if($setup['total_article']!=$total)echo" (<font color=red>$total</font> searched) ";?>, <B><?=$page?></b> / <b><?=$total_page?> pages

  </td>
  <td style=font-family:arial;font-size:8pt; align=right>
    <?=$a_login?><img src=<?=$dir?>/setup_login.gif border=0></a>
    <?=$a_member_join?><img src=<?=$dir?>/setup_join.gif border=0></a>
    <?=$a_member_modify?><img src=<?=$dir?>/setup_modify.gif border=0></a>
    <?=$a_member_memo?><img src=<?=$dir?>/setup_memo.gif border=0></a>
    <?=$a_logout?><img src=<?=$dir?>/setup_logout.gif border=0></a>
    <?=$a_setup?><img src=<?=$dir?>/setup_admin.gif border=0></a>
    &nbsp;
  </td>
</tr>
</table>
  
<?php 
 if($setup['use_category']) 
 { 
?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr valign=top>
  <td><?php include "include/print_category.php"; ?></td>
  <td align=right>
<?php 
 $width="98%";
 }
?>
