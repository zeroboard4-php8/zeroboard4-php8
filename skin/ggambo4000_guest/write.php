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
<div align=center>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<form method=post name=write action=write_ok.php enctype=multipart/form-data>
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
<tr>
<td align=center><?=isset($title)?$title:''?></td>
</tr>

<tr>
<td valign=top>
<table border=0 cellsapcing=0 cellpadding=0 width=100% align=center>
<tr>
<td><input type=hidden name=subject value="Guest" <?=size(16)?> maxlength=200 class=input2></td>
</tr>
<tr>
<td height=5></td>
</tr>
<?=$hide_start?>
<tr><td align=center>
<table border=0 cellsapcing=0 cellpadding=0 align=center>
<tr>
<td width=100 align=right class=icon>NAME&nbsp;</td>
<td align=left><input type=text name=name value="<?=$name?>" <?=size(35)?> maxlength=20 class=input></td>
</tr>
<tr>
<td width=100 align=right class=icon>PASSWORD&nbsp;</td>
<td><input type=password name=password <?=size(35)?> maxlength=20 class=input></td>
</tr>
<tr>
<td width=100 align=right class=icon>E-MAIL&nbsp;</td>
<td><input type=text name=email value="<?=$email?>" <?=size(35)?> maxlength=200 class=input></td>
</tr>
<tr>
<td width=100 align=right class=icon>HOMEPAGE&nbsp;</td>
<td><input type=text name=homepage value="<?=$homepage?>" <?=size(35)?> maxlength=200 class=input></td>
</tr>
</table></td></tr>
<?=$hide_end?>
<tr>
<td align=center><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>&nbsp;<font class=icon>NOTICE</font><?=$hide_notice_end?>&nbsp;<?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1><font class=icon>&nbsp;HTML</font><?=$hide_html_end?>&nbsp;<input type=checkbox name=reply_mail <?=$reply_mail?> value=1><font class=icon>&nbsp;E-MAIL</font></td>
</tr>
<tr><td align=center>
<table border=0 cellsapcing=0 cellpadding=0 width=354 align=center>
<tr><td bgcolor=#F8F8F8 style='border-width:1 1 1 1;border-color:#E0E0E0;border-style:solid;padding:3 0 1 0;' align=center>
<font class=icon2>resize writing form</font> &nbsp;&nbsp;<img src=<?=$dir?>/btn_down.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_down(document.write.memo)>
	    &nbsp; <img src=<?=$dir?>/btn_up.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_up(document.write.memo)>
	    </td></tr></table>
</td></tr>
<tr>
<td align=center valign=top><textarea name=memo <?=size2(35)?> class=input3 rows=4 style='overflow-y:auto; overflow-x:hidden;width:350;word-break:break-all;padding:6 6 0 6;'><?=isset($memo)?$memo:''?></textarea></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align=center valign=bottom><input type=submit value="CONFIRM" class=submit onfocus='this.blur()' style=cursor:hand>&nbsp;&nbsp;<input type=button value=" BACK " onclick=history.go(-1) class=submit onfocus='this.blur()' style=cursor:hand></td>
</tr>
</form>
</table>
</div>