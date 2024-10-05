<!-- HTML 시작 -->
<!-- 게시판 처음에 글수 페이지수 접속현황 로그인 회원가입 표시 -->
<?php 
if($setup['use_category'])
{
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
  <tr align=center> <td><?php include "include/print_category.php"; ?></td>
  </tr>
</table>
<?php }?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
<td width=1></td>
<td class=ver7>
&nbsp;&nbsp;total : <?=$total?>
</td>

<td align=right class=ver7>
<?=$memo_on_sound?>
<?=$a_login?>login</a>
<?=$a_member_join?>&nbsp;join</a>
<?=$a_member_memo?>memo</a>
<?=$a_member_modify?>&nbsp;edit</a>
<?=$a_logout?>&nbsp;logout</a>
<?=$a_setup?>&nbsp;admin</a>
</td>
</tr>
</table>