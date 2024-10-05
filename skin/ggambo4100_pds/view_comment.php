<?php 
	$comment_name = str_replace(">","><font class=list_han>",$comment_name);
	$a_del = str_replace(">","><font class=icon title=삭제>",$a_del);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $c_data['reg_date'])."'><font class=list_eng>".date("m-d", $c_data['reg_date'])."</font></span>"; 
	if($is_admin) $show_comment_ip = "<font class=list_eng>".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>

<table width=<?=$width?> cellspacing=0 cellpadding=0 border=0><tr><td class='line1' width=100%></td></tr></table>
<table width=<?=$width?> cellspacing=1 cellpadding=4 style='table-layout:fixed;margin:8 0 8 0;'>
<col width=5></col><col width=70></col><col width=8></col><col width=></col><col width=50></col><col width=5></col>
<tr valign=top>
<td></td>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100% style='table-layout:fixed;'>
		<tr>
			<td titli='<?=$show_comment_ip?>'><NOBR><?=$c_face_image?> <?=$comment_name?></b></NOBR></td>
		</tr>
		</table>
			</td>
	<td width=8 class=line2 style=padding:0px><img src=/images/t.gif border=0 width=8></td>
	<td style='word-break:break-all;'><font class=list_han><?=str_replace("\n","<br>",$c_memo)?></font></td>
<td align=right><?=$date?>&nbsp;<?=$a_del?>*</a></td>
<td></td>
</tr>
</table>

