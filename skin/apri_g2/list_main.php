<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style='margin-top:25'>
<tr>
  <td nowrap style='padding:3'><font style='font-family:Verdana'><?=$number?>.</font></td>
</tr>
<table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> >
<tr>
  <td colspan=3 height=1 class=bg_width><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
<tr>
  <td width=1 class=bg_height><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
  <td style='padding:10 10 20 10'> 
<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
  <td nowrap>
    <img src=<?=$dir?>/1.gif border=0 ><?=$face_image?> <font style='font-family:verdana; font-size:9pt; font-weight:bold'><?=$name?></font>
  </td>
  <td align=right width=100% style='word-break:break-all;' class=button nowrap>　
    <?=$a_reply?><img src=<?=$dir?>/reply.gif border=0></a>
    <?=$a_modify?><img src=<?=$dir?>/modify.gif border=0></a>
    <?=$a_delete?><img src=<?=$dir?>/delete.gif border=0></a>

    <?php if($data['homepage']){?>
    <a href=<?=$data['homepage']?> target=_blank><img src=<?=$dir?>/url.gif border=0 ></a>
    <?php }else{?><?php }?>
   </td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
  <td style='word-break:break-all;'><p align=justify><?=$memo?></p></td>
</tr>
<td align=right nowrap><font style='font-family:verdana;font-size:7pt'><?=$reg_date?></font>
  </td>
<tr>
<td valign=top style='padding-left:50'>

<?php
 include "include/get_reply.php";
?>
</td>
</tr>
</table>

</td>
<td class=bg_height width=1><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
<tr>
  <td colspan=3 height=1 class=bg_width><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td>
</tr>
</table>