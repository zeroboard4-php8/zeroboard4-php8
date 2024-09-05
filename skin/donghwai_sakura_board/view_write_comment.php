<table border="0" cellpadding="5" cellspacing="0" align="center" width=<?=$width?>><script>
			function check_comment_submit(obj) {
				if(obj.memo.value.length<10) {
					alert("코멘트는 10자 이상 적어주세요");
					obj.memo.focus();
					return false;
				}
				return true;
			}
		</script><tr><form method=post name=write action=comment_ok.php onsubmit="return check_comment_submit(this)"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"><td align="right">
<table border="0" cellpadding="5" cellspacing="0" align="center" width=<?=$width?>>
<tr><td valign="bottom" align="right"><?=$hide_c_password_start?><font class=v7>NAME&nbsp;</font><?=$c_name?>&nbsp;&nbsp;<font class=v7>PASS&nbsp;</font><input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td>
<td width="367" align="right"><textarea name=memo cols=50 class=comment_textarea style='overflow:auto'></textarea><input type=image src=<?=$dir?>/ok.gif width="77" height="80" border=0 border=0 accesskey="s" align=absmiddle></td></tr></table></td></form></tr></table>