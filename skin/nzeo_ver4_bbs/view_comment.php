<?php
	$comment_name = str_replace(">","><font class=list_han>",$comment_name);
	if($is_admin) $show_comment_ip = "<font class=list_eng>".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>
<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?>>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=8><br>
<table width=<?=$width?> cellspacing=1 cellpadding=4>
<col width=100></col><col width=8></col><col width=></col><col width=100></col>
<tr valign=top bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td><NOBR><?=$c_face_image?> <?=$comment_name?></b></NOBR></td>
		</tr>
		</table>
		<?=$show_comment_ip?>
	</td>
	<td width=8 class=line2 style=padding:0px><img src=/images/t.gif border=0 width=8></td>
	<td style='word-break:break-all;'><font class=list_han><?=str_replace("\n","<br>",$c_memo)?></font></td>
	<td align=right><font class=list_eng><?=date("Y-m-d",$c_data['reg_date'])?><br><?=date("H:i:s",$c_data['reg_date'])?></font><br><?=$a_del?><img src=<?=$dir?>/del.gif border=0 valign=absmiddle></a></td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=8><br>
