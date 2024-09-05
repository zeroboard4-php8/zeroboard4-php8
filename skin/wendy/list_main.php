<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% height=11 background=<?=$dir?>/line.gif><tr>
<td>
</td>
</tr>
</table>
<TABLE border=0 cellPadding=5 cellSpacing=0 width=100%>
<tr>
<td>
<?=$hide_cart_start?>
<input type=checkbox name=cart value="<?=$data['no']?>">
<?=$hide_cart_end?>
<span class=small>&nbsp;&nbsp;<font color=#888888><?=$number?></font>
</span>
&nbsp;&nbsp;<font color=#cccccc><?=$data['name']?></font>
</TD>
<TD align=right width=80>
<?=$a_reply?><img src=<?=$dir?>/reply.gif border=0></a>
<?php if($data['homepage']){?><a href="<?=$data['homepage']?>" target="_blank" onfocus='this.blur()'><img src=<?=$dir?>/home.gif border=0></a>&nbsp;<?php } else { ?><?php } ?><?php if($data['email']){?><a href="mailto:<?=$data['email']?>" onfocus='this.blur()'><img src=<?=$dir?>/email.gif border=0></a>&nbsp;<?php } else { ?><?php } ?><?=$a_modify?><img src=<?=$dir?>/modify.gif border=0></a>&nbsp;<?=$a_delete?><img src=<?=$dir?>/delete.gif border=0></a></td></tr></table><TABLE border=0 cellPadding=5 cellSpacing=0 width=100%><TR><TD valign=top></td><td valign=top><?=$memo?></td></tr><tr><td></td>
<td align=left class=small><font color=#666666><?=$reg_date?>&nbsp;</font></td></tr></TABLE><?php include "include/get_reply.php";?>