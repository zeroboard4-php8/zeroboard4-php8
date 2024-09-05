<SCRIPT LANGUAGE="JavaScript">
<!--
function formresize(mode) {
        if (mode == 0) {
                document.write.memo.cols  = 80;
                document.write.memo.rows  = 20; }
        if (mode == 1) {
                document.write.memo.cols += 5; }
        if (mode == 2) {
                document.write.memo.rows += 3; }
}
// -->
</SCRIPT>
<table border=0 cellspacing=0 cellpadding=0 width=350>
<tr>
<td align=center><img src=<?=$dir?>/ruvin_fine.gif border=0 height=33></td>
</tr></table>

<table border=0 cellspacing=0 cellpadding=0 width=350>
<tr>
<td width=1>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
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
<!-- 검색폼 끝 -->
 </td>
 <Td>
 
<table border=0 cellspacing=5 cellpadding=0 width=100%>
<?=$hide_start?>
<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/name.gif border=0>&nbsp;</td>
<td><input type=text name=name value="<?=$name?>" <?=size(15)?> maxlength=15 class=input></td></tr>　　

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/password.gif border=0>&nbsp;</td>
<td><input type=password name=password <?=size(15)?> maxlength=20 class=input></td></tr>

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/email.gif border=0>&nbsp;</td>
<td><input type=text name=email value="<?=$email?>" <?=size(45)?> maxlength=200 class=input></td></tr>

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/homepage.gif border=0>&nbsp;</td>
<td><input type=text name=homepage value="<?=$homepage?>" <?=size(45)?> maxlength=200 class=input></td></tr>
<?=$hide_end?>

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/subject.gif border=0>&nbsp;</td>
<td><input type=text name=subject value="<?=$subject?>" <?=size(45)?> maxlength=200 class=input></td></tr>

<tr>
<td colspan=2 align=right class=fine4>
<?=$category_kind?>
<?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>Notice<?=$hide_notice_end?><?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>HTML<?=$hide_html_end?><input type=checkbox name=reply_mail <?=$reply_mail?> value=1>Reply to e-mail<?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>Secret<?=$hide_secret_end?>
</td></tr>

<tr>
<td width=70 align=right><img src=<?=$dir?>/content.gif border=0>&nbsp;</td>
<td><textarea name=memo <?=size2(43)?> rows=10 class=textarea><?=$memo?></textarea></td></tr>

<?=$hide_sitelink1_start?>
<tr height=23>
<td width=70 align=right> <img src=<?=$dir?>/link1.gif border=0>&nbsp;</td>
<td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(45)?> maxlength=200 class=input></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=23>
<td width=70 align=right> <img src=<?=$dir?>/link2.gif border=0>&nbsp;</td>
<td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(45)?> maxlength=200 class=input></td></tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr><td>&nbsp;</td>
<td><font class=small><?=$upload_limit?> 이하의 화일만 올릴 수 있습니다.</td>
</tr>

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/upload1.gif border=0>&nbsp;</td>
<td><input type=file name=file1 <?=size(29)?> maxlength=255 class=input> <?=$file_name1?></td></tr>

<tr height=23>
<td width=70 align=right><img src=<?=$dir?>/upload2.gif border=0>&nbsp;</td>
<td><input type=file name=file2 <?=size(29)?> maxlength=255 class=input> <?=$file_name2?></td></tr>
<?=$hide_pds_end?>

<tr height=23>
<td colspan=2 align=right>
<input type=image src=<?=$dir?>/confirm.gif border=0 accesskey="s" onfocus='this.blur()' alt=확인>&nbsp;
<a href=javascript:void(history.back()) onfocus='this.blur()'><img src=<?=$dir?>/back.gif border=0 alt=취소>
</td></tr>
</table>
</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=350>
<tr>
<td height=10>
</td></tr>
</table>