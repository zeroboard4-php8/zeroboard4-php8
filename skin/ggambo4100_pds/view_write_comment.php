<SCRIPT LANGUAGE="JavaScript"> 
function OnEnter( field ) { if( field.value == field.defaultValue ) { field.value = ""; } } 
function OnExit( field ) { if( field.value == "" ) { field.value = field.defaultValue; } } 
</SCRIPT>
<table width=<?=$width?> cellspacing=0 cellpadding=0 border=0><tr><td class='line1' width=100%></td></tr></table>
<table border=0 cellspacing=1 cellpadding=1 width=<?=$width?> style='padding:14 20 20 0;margin:8 0 8 0;'>
<tr>
	<td style='padding-right:20;'><div align=right>
		<table border=0 cellspacing=0 cellpadding=0 width=85%>
		<script>
			function check_comment_submit(obj) {
				if(obj.memo.value.length<10) {
					alert("코멘트는 10자 이상 적어주세요");
					obj.memo.focus();
					return false;
				}
				return true;
			}
		</script>
		<form method=post name=write action=comment_ok.php onsubmit="return check_comment_submit(this)"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"> 
				<tr>	
			<td>
				<table border=0 cellspacing=0 cellpadding=0 height=100%>
				<col width=20></col><col width=></col><col width=20></col>
				<tr>
			<td class=list9 onclick="document.write.memo.rows=document.write.memo.rows+3" style='cursor:hand; padding-right:0;' valign=middle align=center width=20 bgcolor=#F0F0F0><img src=<?=$dir?>/increase.gif border=0></td>

					<td width=100% height=20 class='scroll4'><textarea name=memo cols=20 rows=3 class=textarea style='width:100%;overflow-y:auto; overflow-x:hidden;padding:3 3 0 3;' onblur='OnExit(this)' onfocus='OnEnter(this)'"></textarea></td>
 <td width=20 bgcolor=#F0F0F0><input type=image src=<?=$dir?>/comment.gif border=0 onfocus=blur() accesskey="s" class=submit2></td>
 </tr><tr>
					<tr><td width=100% colspan=2 class=list_eng><?php if(!$member['no']){?><font color=silver>NAME : </font><?=$c_name?>&nbsp;&nbsp;<?php }?>		<?=$hide_c_password_start?>
<font color=silver>PASS : </font><input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td>
					
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table></div>
	</td>
</tr>
</table>
