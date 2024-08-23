<img src=<?=$dir?>/t.gif border=0 height=4><br>

<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>

<tr>

	<td bgcolor=white>

		<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>

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

		<col width=95 align=right style=padding-right:10px></col><col width=></col>

		<?php if(!$member['no']){?>

		<tr>

			<td class=list0><font class=list_eng><b>Name</b></td>

			<td class=list1><font class=list_han><?=$c_name?></font></td>

		</tr>

		<?php }?>

		<?=$hide_c_password_start?>

		<tr>

			<td class=list0><font class=list_eng><b>Password</b></td>

			<td class=list1><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>

		</tr>

		<?=$hide_c_password_end?>

		<tr>	

			<td class=list0 onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:hand><font class=list_eng><b>Comment</b><br>▼</td>

			<td class=list1>

				<table border=0 cellspacing=2 cellpadding=0 width=100% height=100%>

				<col width=></col><col width=100></col>

				<tr>

					<td width=100%><textarea name=memo cols=20 rows=8 class=textarea style=width:100%></textarea></td>

					<td width=100><input type=submit rows=5 class=submit value='  글쓰기  ' accesskey="s" style=height:100%></td>

				</tr>

				</table>

			</td>

		</tr>

		</form>

		</table>

	</td>

</tr>

</table>

