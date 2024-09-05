<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
<td>
<table border=0 cellspacing=0 cellpadding=3 width=100%>
<tr>
<td valign=bottom class=small>
  </td>
  <td style=font-family:verdana;font-size:7pt; align=left>
  <font color=#777777>
   Total : <?=$setup['total_article']?><?php if($setup['total_article']!=$total)echo" (<font color=#999999>$total</font> searched) ";?>, <?=$page?> / <?=$total_page?> pages
</font>
  </td>
  <td valign=bottom align=right class=small>
    <?=$a_login?><img src=<?=$dir?>/login.gif border=0></a>
    <?=$a_member_join?><img src=<?=$dir?>/join.gif border=0></a>
    <?=$a_member_modify?><img src=<?=$dir?>/myinfo.gif border=0></a>
    <?=$a_member_memo?><img src=<?=$dir?>/memo.gif border=0></a>
    <?=$a_logout?><img src=<?=$dir?>/logout.gif border=0></a>
    <?=$a_setup?><img src=<?=$dir?>/setup.gif border=0></a>
</td>
</tr>
</table>
<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% height=1 background=<?=$dir?>/dot.gif>
<tr><td></td></tr></table>

<?php 
  include "include/write.php";
?>
