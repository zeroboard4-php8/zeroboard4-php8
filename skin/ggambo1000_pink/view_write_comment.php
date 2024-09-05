<table border=0 cellspacing=1 cellpadding=1 width=100% style='padding-top:14;padding-left:20;padding-righ:20;' align=center>
<tr><td width=100% height=1 class=line1 colspan=10></td></tr>
<tr>
	<td style='padding:8 20 0 0;'><div align=right>
		<table border=0 cellspacing=0 cellpadding=0 width=90% height=70>
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
			<td class=list1>
				<table border=0 cellspacing=0 cellpadding=0 width=100% height=100%>
				<col width=></col><col width=100></col><col></col>
				<tr>
			<td align=center onclick="document.write.memo.rows=document.write.memo.rows+4" style='cursor:hand;' valign=middle align=center width=20><img src=<?=$dir?>/size.gif></td>

					<td width=100% height=20><textarea name=memo cols=20 rows=4 class=textarea style=width:100%;overflow:auto; onblur="this.style.backgroundColor=''"
 onfocus="this.style.backgroundColor='F8F8F8'"></textarea></td>
 <td width=100><input type=image src=<?=$dir?>/comment.gif border=0 onfocus=blur() accesskey="s"></td>
 </tr><tr>
					<tr><td width=100% colspan=2><?php if(!$member['no']){?><font class=list_eng2>NAME : </font><?=$c_name?>&nbsp;&nbsp;<?php }?>		<?=$hide_c_password_start?>
<font class=list_eng2>PASS : </font><input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td>
					
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table></div>
