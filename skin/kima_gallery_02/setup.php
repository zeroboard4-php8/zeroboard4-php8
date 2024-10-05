<?php 
  $max_show_image=3;       // 한줄에 보일 개수
  $img_w=120;          // 가로 사이즈
  $img_h=120;          // 세로 사이즈
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
<td align=center style="padding-bottom:10;"><?php include "include/print_category.php"; ?></td>
</tr>
<tr>
<td height=21 align=right class=ver7>
<?=$a_member_join?>join</a>
<?=$a_login?>&nbsp;login</a>
<?=$a_member_memo?><?=$member_memo_icon?></a>
<?=$a_member_modify?>&nbsp;info</a>
<?=$a_logout?>&nbsp;logout</a>
<?=$a_setup?>&nbsp;setup</a>
</td>
</tr>

<tr><td height=1 class=line></td></tr>
</table>