<tr>
    <td bgcolor=dddddd><img src=<?=$dir?>/t.gif height=1></td>
</tr>
<tr>
	<td height=3><img src=<?=$dir?>/t.gif border=0 hieght=3></td>
</tr>
<tr valign=top>
	<td style='word-break:break-all;' class=zv3_header>
		<table border=0 cellspacing=0 cellpadding=0 width=100% class=zv3_header_inside>
		<tr>
			<td><?=$c_face_image?> <?=$comment_name?> </b><font class=zv3_small color=888888>(<?=date("Y-m-d H:i:s",$c_data['reg_date'])?>)</font></td>
			<td align=right><?=$a_del?><img src=<?=$dir?>/btn_delete.gif border=0 valign=absmiddle></a></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td class=zv3_viewList style='word-break:break-all;padding:2px'>
		<?=nl2br($c_memo)?>
	 </td>
</tr>
<tr>
	<td height=3><img src=<?=$dir?>/t.gif border=0 hieght=3></td>
</tr>
