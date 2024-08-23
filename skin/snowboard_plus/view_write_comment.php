<SCRIPT LANGUAGE="JavaScript">
<!--
function sb_formresize_down(obj) {
	obj.rows += 3;
}
function sb_formresize_up(obj) {
	obj.rows -= 3;
}
// -->
</SCRIPT>
<!-- 간단한 답변글 쓰기 -->
<tr>
	<td colspan=8 bgcolor=#c4c4c4 height=1></td>
</tr>
 <tr>
	<td colspan=8 bgcolor=ffffff height=3></td>
</tr>
<tr align=center bgcolor=f7f7f7>
<td width=0>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=comment_ok.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"> 
<!----------------------------------------------->
</td>
 <td align=center>
<div align=center>
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?>>
<tr>
  <td>
	<table border=0 cellspacing=0 cellpadding=4 width=100% height=100>
	<col width=80></col><col width=></col><col width=80></col>
	<tr align=center> 
	  <td height=20 style=font-family:Verdana;font-size:8pt;letter-spacing:-1px; ><img src=images/t.gif border=0 width=80 height=1><br><B>Name</b></td>
	  <td style=font-family:Verdana;font-size:8pt;letter-spacing:-1px;><B>Memo</b> &nbsp;&nbsp;&nbsp; resize writing form</span> &nbsp;&nbsp;<img src=<?=$dir?>/image/btn_down.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_down(document.write.memo)>
	    &nbsp; <img src=<?=$dir?>/image/btn_up.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_up(document.write.memo)></td>
	  <td>&nbsp;</td>
	</tr>
	<tr align=center valign=top>
	  <td nowrap height=80>
		<?=$c_name?> 
		 <?=$hide_c_password_start?>
	     <br><img src=images/t.gif border=0 height=10><br>
	     <font style=font-family:Verdana;font-size:8pt;letter-spacing:-1px;><B>Password</b></font><br>
	     <img src=images/t.gif border=0 height=5><br>
	     <input type=password name=password <?=size(8)?> maxlength=20 class=sb_comment_input> 
	     <?=$hide_c_password_end?>
	  </td>
	  <td><textarea name=memo <?=size(40)?> rows=5 class=sb_comment_contents></textarea></td>
	  <td><input type=submit rows=5 <?php if($browser){?>class=sb_submit<?php }?> value='Submit' accesskey="s"></td>
	</tr>
</table>
     </td>
    </tr>
</table>
</div>
	</td>
</tr>
	</form>
<tr>
	<td colspan=8 bgcolor=fffff height=1></td>
</tr>
 <tr>
	<td colspan=8 bgcolor=000000 height=1></td>
</tr>
</table>
