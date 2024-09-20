<?php 
$c_name=str_replace("size=8 maxlength=10","size=12 maxlength=20",$c_name);
?>
<table border=0 cellspacing=0 cellpadding=0 height=4 width=<?=$width?>>
<tr><td height=4 class=thumb_bg style=height:4px><img src=<?=$dir?>/t.gif border=0 height=4></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=2 class=thumb_bg width=<?=$width?>>
<tr>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 class=c_line1 width=100%>
		<tr>
			<td>
				<table border=0 cellspacing=1 cellpadding=2 width=100% height=98>
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
				<form method=post name=write action=comment_ok.php onsubmit="return check_comment_submit(this)"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"><col width=95 align=right style=padding-right:10px></col><?php if(!$member['no']) echo "<col width=85></col><col width=70 align=right style=padding-right:10px></col>"?><col width=></col>
				<?php if(!$member['no']){?>
				<tr>
					<td class=c0><font class=thumb_han><b>이름(별명)</b></td>
					<td class=c1 style=padding-left:4px;><font class=thumb_han><?=$c_name?></font></td>
					<td class=c0><font class=thumb_han><b>비밀번호</b></td>
					<td class=c1 style=padding-left:4px;><input type=password name=password <?=size(12)?> maxlength=20 class=input></td>
				</tr>
				<?php }?>
				<tr>	
					<td class=c0 onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:hand><font class=thumb_eng><b><?=isset($member['name'])?$member['name']:''?></b><br>▼</td>
					<td <?php if(!$member['no']) echo "colspan=3 "?>class=c1>
						<table border=0 cellspacing=2 cellpadding=0 width=100% height=100%>
						<col width=></col><col width=100></col>
						<tr>
							<td width=100%><textarea name=memo cols=20 rows=6 class=textarea style=width:100%></textarea></td>
							<td width=100><input type=submit rows=5 class=submit_c value=' 짧은답글 ' accesskey="s" style=height:100%></td>
						</tr>
						</table>
					</td>
				</tr>
				</form>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
