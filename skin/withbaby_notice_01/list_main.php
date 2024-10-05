<table border=0 cellspacing=0 cellpadding=0 width=100%>

	
<tr>
		
<td width=80% height=25 nowrap align=left>			

<font class="ver7">&nbsp;<?=$date=date("[Y-m-d]",$data['reg_date'])?><font>&nbsp;<font class="ver9"><?=$insert?><?=$subject?><font> &nbsp;<?php 
$comment_num="".$data['total_comment']."";
if($data['total_comment']==0) {
  $comment_num="";
}
echo "<span class=9px>$comment_num</span>";
?>&nbsp;&nbsp;</font></td>				
<td width=20% height=25 nowrap align=right valign="top"><font class=ver7><?=$a_modify?>+</a>&nbsp;<?=$a_delete?>-</a></font><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?></td>
				
</tr>
			
</table>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td height=1 colspan=6 class=line></td></tr>
	
<tr>
		
<td style='word-break:break-all;padding:10px;' valign=top>
			
<span style=line-height:160%>
		
<p align="center"><?=$upload_image1?>
		
<?=$upload_image2?></p>
		
<p align="center"><?=$memo?>		
</span></center>
		
</td>
	
</tr>

</table>
<table height=1 width=100%>

<tr><td height=1 colspan=6 class=line></td></tr>
