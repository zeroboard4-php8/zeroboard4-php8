<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style='margin-top:25'>
<tr>
  <td nowrap style='padding:3'><font style='font-family:Verdana'><?=$number?>.</font></td>
</tr>
<table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td colspan=3 height=1 class=kissofgod-bgdotwidth><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
<tr>
  <td width=1 class=kissofgod-bgdotheight><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>

  <td style='padding:10 10 20 10'> 
<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
  <td nowrap>
    <?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>
    <?=$face_image?> <font style='font-family:Tahoma; font-size:9pt; font-weight:bold'><?=$name?></font>
  </td>
  <td width=100% style='word-break:break-all;' class=kissofgod-button-font nowrap>　
	<?php if($data['homepage']){?>
	<a href=<?=$data['homepage']?> target=_blank>&nbsp;URL&nbsp;</a>
	<?php }else{?><?php }?>
    <?=$a_modify?>&nbsp;Edit&nbsp;</a>
    <?=$a_delete?>&nbsp;Del&nbsp;</a>
	<?=$a_reply?>&nbsp;Re&nbsp;</a>
  </td>
  <td align=right nowrap><font style='font-family:tahoma;font-size:7pt'><?=$reg_date?></font>
  </td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
  <td style='word-break:break-all;'><p align=justify><?=$memo?></p></td>
</tr>
<tr>
<td valign=top style='padding-left:50'>

<?php 
 // 이 부분은 답글이 나오는 부분입니다;;; 제가 실력이 없어서 한큐에 못 끝내고 이렇게 불러쓰게 되네요;;
 include "include/get_reply.php"; // 답글을 가져와서 list_reply.php 파일을 불러서 출력합니다. 즉 답글 출력은 list_reply.php 겠죠?
?>

</td>
</tr>
</table>

</td>
<td class=kissofgod-bgdotheight width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
<tr>
  <td colspan=3 height=1 class=kissofgod-bgdotwidth><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
</table>