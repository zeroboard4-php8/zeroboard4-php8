<?php 
	$name= str_replace(">","><font class=list_han>",$name);
$date="<span title='".date("Y년 m월 d일 D H시 i분 s초", $data['reg_date'])."'><font class=icon>".date("m-d", $data['reg_date'])."</font></span>"; 
?>
<table align=center border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td colspan=10 class=line1 height=1></td>
</tr>
</table>

<table border=0 align=center cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td style='padding:8 8 0 10;'><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<span class=icon>*&nbsp;</span><span class=icon>NO. <?=$number?></span>&nbsp;&nbsp;<?=$name?>&nbsp;&nbsp;(&nbsp;<?=$date?>&nbsp;)</td>
<td align=right class=icon2 style='padding:8 10 8 10;'><font title="답변"><?=$a_reply?>REPLY</a></font>&nbsp;<?php if($data['homepage']){?><a href="<?=$data['homepage']?>" target="_blank" onfocus='this.blur()'><font title="홈페이지">HOME&nbsp;</a></font><?php } else { ?><?php } ?><?php if($data['email']){?><a href="mailto:<?=$data['email']?>" onfocus='this.blur()'><font title="이메일">E-MAIL&nbsp;</a></font><?php } else { ?><?php } ?><font title="수정"><?=$a_modify?>MODIFY&nbsp;</a></font><font title="삭제"><?=$a_delete?>DELETE</a></font></span></td>
</tr>

<tr>
<td align=left style='word-break:break-all;padding:8 30 15 30;'' valign=top colspan=2><?=$memo?></td>
</tr>
</table>

<?php include "include/get_reply.php";?>