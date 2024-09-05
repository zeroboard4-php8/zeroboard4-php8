</table>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
function formresize1(obj1) { 
                obj1.rows += 3; // 늘어나는 rows 수치 
        } 
function formresize2(obj2) { 
                obj2.rows = 4; // 원래 textarea rows 
        } 

// --> 
</SCRIPT>
<!-- 간단한 답변글 쓰기 -->
<form method=post name=write action=comment_ok.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<table border=0 cellspacing=0 cellpadding=0 class=ssuk_input2 width=<?=$width?>>
<tr>
  <td>
	<table border=0 cellspacing=0 cellpadding=5 width=100%>
	<tr align=center> 
	  <td style=font-family:Verdana;font-size:8pt;letter-spacing:-1px; ><img src=images/t.gif border=0 width=80 height=1><br><B>Name</b></td>
	  <td style=font-family:Verdana;font-size:8pt;letter-spacing:-1px;><B>Memo</b>&nbsp;&nbsp;&nbsp;<a href="#a" onclick=formresize1(document.write.memo) onfocus='this.blur()'><img src=<?=$dir?>/rows_down.gif border=0 alt='글쓰기 칸 늘이기'></a></td>
	  <td>&nbsp;</td>
	</tr>
	<tr align=center valign=top>
	  <td nowrap >
	     <?=$c_name?>
	     <?=$hide_c_password_start?>
	     <br><img src=images/t.gif border=0 height=5><br>
	     <font style=font-family:Verdana;font-size:8pt;letter-spacing:-1px;><B>Password</b></font><br>
	     <input type=password name=password <?=size(8)?> maxlength=20 class=input>
	     <?=$hide_c_password_end?>
	  </td>
	  <td width=100%><textarea name=memo <?=size(40)?> rows=4 class=input style="width:100%;"></textarea></td>
	  <td height=60><input type=submit class=ssuk_comment_submit value='COMMENT' accesskey="s" style=height:100%></td>
	</tr>
	<tr>
	<td colspan=3 height=5></td></tr>
	</table>
  </td>
<td width=10></td>
</tr>
</table>
</form>
