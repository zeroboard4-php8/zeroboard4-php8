<tr><td height=1 bgcolor=#333333><img src=images/t.gif height=1></td></tr>
<tr valign=top onMouseOver=this.style.backgroundColor='#282828' onMouseOut=this.style.backgroundColor=''>
     <td style='padding:5 0 5 5'>
	 <table border=0 cellspacing=0 cellpadding=3>
	 <tr>
	 <td nowrap><img src=images/t.gif border=0 height=1><br><?=$c_face_image?> <?=$comment_name?></td>
	 <td style=font-size:7pt;font-family:verdana>&nbsp;&nbsp;(&nbsp;<?=$c_reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초",$c_data['reg_date'])."'>".date("Y-m-d H:i:s",$c_data['reg_date'])."</span>"?>&nbsp;)&nbsp;&nbsp;<?=$a_del?>X</a></td>
	 </tr>
	 </table>
	 <table border=0 cellspacing=0 cellpadding=3>
	 <tr>
	 <td><?=nl2br($c_memo)?></td></tr></table></td>
</tr>