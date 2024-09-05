<?php include "$dir/value.php3";?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td bgcolor=<?=$line_color?> height=1 colspan=3></td></tr>
<tr>
<td width=50% bgcolor=<?=$bg_color?> class=change_tahoma_8pt><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?><b>&nbsp;<?=$number?></b>. <?=$face_image?><b><?=$name?></b> <?php if($data['homepage']){?><a href=<?=$data['homepage']?> target=_blank>&nbsp;URL&nbsp;</a><?php }else{?><?php }?>
</td>
<td align=right bgcolor=<?=$bg_color?> class=change_tahoma_8pt nowrap><?=$a_reply?>Reply</a> <?=$a_modify?>Modify</a> <?=$a_delete?>Del</a> (<?=$reg_date?>)
</td>
</tr>
<tr>
<td colspan=3>
<table border=0 width=100% cellspacing=0 cellpadding=5>
<tr>
<td  style='word-break:break-all;'><?=$memo?></td>
</tr>
</table>
</td>
</tr>
</table>

<?php 
 // 이 부분은 답글이 나오는 부분입니다;;; 제가 실력이 없어서 한큐에 못 끝내고 이렇게 불러쓰게 되네요;;
 include "include/get_reply.php"; // 답글을 가져와서 list_reply.php 파일을 불러서 출력합니다. 즉 답글 출력은 list_reply.php 겠죠?
?>

<table border=0 cellspacing=0 cellpadding=0 height=5><tr><td>&nbsp;</td></tr></table> 