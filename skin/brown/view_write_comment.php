<?php 
 /* 간단한 답글 쓰기 표시

  -- 간단한 답글 관련
  <?=$hide_comment_start?> <?=$hide_comment_end?> : 간단한 답글 쓰기 보여주기/ 숨기기
  <?=$hide_c_password_start?> <?=$hide_c_password_end?> : 간단한 답글시 비밀번호 입력 보여주기/ 숨기기;;

  <?=$c_name?> : 코멘트시 이름 입력하는 곳;;

  ** view.php 제일 아래쪽에 간답한 답글이 시작하는 <table>태그 시작부분이 있습니다.
     그리고 간단한 답글이 있으면 view_comment_view.php 파일에서 출력을 합니다.

 */
?>

</table>
<table width=100% cellspacing=5 cellpadding=0 bgcolor=F8F5F2 align=center>
	<tr>
		<td width="100%" padding="8 8 8 8">
			<table cellpadding=0 cellspacing=0 align=center width=100%>
				<tr>
					<td width=90 valign=top>
					<form method=post name=write action=comment_ok.php>
					<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"><img width=5><font class=ver8><b>Name</b></font><br><img height=1><br><img width=3><?=$c_name?>  <?=$hide_c_password_start?><img height=5><br><img width=5><font class=ver8><b>Password</b></font><br><img height=1><br><img width=3><input type=password name=password maxlength=20 class=input></td><?=$hide_c_password_end?></td>
					<td width="7"></td>
					<td valign=top><img width=2><font class=ver8><b>Comment</b></font><br><img height=3><br><textarea name=memo class=comment_textarea maxlength=400></textarea></td>
					<td width=70 valign=top><img width=1 height=16><br><input type=image src=<?=$dir?>/comment.gif rows=5 accesskey="s" onFocus=this.blur()></td>
				</tr>
				</form>
			</table>
		<td>
	</tr>
</table>

<table width=100% cellpadding=0 cellspacing=0>
	<tr>
		<td height=15 colspan=2></td>
	</tr>
</table>
<?=$hide_comment_end?>