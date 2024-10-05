<?php 
	$name= str_replace(">","><font class=list_han>",$name);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=icon>".date("m-d", $data['reg_date'])."</font></span>"; 
?>
<table align=center border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td width=100% align=right>
<table border=0 cellpadding=0 cellspacing=0 width=70% bgcolor=#F8F8F8 style='padding:10;border:1 #F0F0F0 solid;'>
<tr height=18>
<td align=left valign=bottom><?=$name?>&nbsp;&nbsp;(&nbsp;<?=$date?>&nbsp;)</td>
<td align=right valign=bottom class=icon><font title="수정"><?=$a_modify?>R&nbsp;&nbsp;</font></a><font title="삭제"><?=$a_delete?>D</font></a></td>
</tr>
<tr>
<td style='word-break:break-all;padding:8 20 8 20;' valign=top colspan=2><?=$memo?><br></td>
</tr>
</table>
</td></tr>
</table><br>