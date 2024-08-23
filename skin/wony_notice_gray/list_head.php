</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td align=right class=n style='padding-top:5'>
<?=$a_login?>.+:로그인:+.</a><?=$a_member_memo?>.+:메모함:+.</a><?=$a_logout?>.+:로그아웃:+.</a><?=$a_setup?>.+:설정:+.</a><?=$a_delete_all?>.+:삭제:+.</a><?=$a_write?>.+:글쓰기:+.</a>
<td align=right valign=top style='padding-top:5'></td>
</tr></form></table>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>">
</tr>
<tr><td background=<?=$dir?>/center.gif><table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td align=left><img src=<?=$dir?>/left.gif></td><td align=right><img src=<?=$dir?>/right.gif></td></tr></table>
</td></tr></table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>