<table border=0 cellspacing=0 cellpadding=0 width=100% style='margin-top:25'>
  <tr>
    <td class=kissofgod-line><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
  </tr>
</table>

<table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
  <td width=94% style='word-break:break-all; padding-left:5'>
    <?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>
    <b><?=$data['subject']?></b> 
    <?=$hide_category_start?> [<?=$category_name?>]<?=$hide_category_end?> 
	<font style=font-size:8pt><?=$sitelink1?></font>
  </td>
  <td width=6% align=right nowrap style='font-family:Tahoma; font-size:8pt'>
    hit : <?=$hit?>
  </td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
  <td valign=top><?=$sitelink1?><?=$upload_image1?></a></td>
  <td valign=top width=100% style='word-break:break-all; padding-left:10'><p  align=justify><?=$memo?></p></td>
</tr>
</tr>
<tr>
  <td colspan=2 align=right nowrap style='font-family:Tahoma; font-size:8pt'>&nbsp;
     <?=$a_modify?>Edit</a>　
     <?=$a_delete?>Del</a>　
     <?=$reg_date?></td>
</tr>
</table>
