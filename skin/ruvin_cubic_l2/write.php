<?php $memo="내용은 나오지 않아요. 아무글이나 대충 쓰세요."; ?>
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

<table border=0 cellspacing=1 cellpadding=1 width=350>
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
</td><Td>

<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
<td height=5></td>
</tr>

<?=$hide_start?>
<tr>
<td align=right class=cu><span class=v7><b>N</b>ame&nbsp;&nbsp;</span></td>
<td><input type=text name=name value="<?=$name?>" <?=size(15)?> maxlength=15 class=input></td>
</tr>

<tr>
<td align=right class=cu><span class=v7><b>P</b>assword&nbsp;&nbsp;</span></td>
<td><input type=password name=password <?=size(15)?> maxlength=20 class=input></td>
</tr>
<?=$hide_end?>

<tr>
<td align=right class=cu><span class=v7><b>S</b>ubject&nbsp;&nbsp;</span></td>
<td><input type=text name=subject value="<?=$subject?>" <?=size(45)?> maxlength=200 class=input></td>
</tr>

<tr>
<td colspan=2 align=right class=cu style=padding-right:6><?=$category_kind?>  <?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1> <span class=v7><b>N</b>otice</span><?=$hide_notice_end?> <?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1> <span class=v7><b>H</b>TML</span><?=$hide_html_end?></td>
</tr>

<tr>
<td align=right valign=middle class=cu><span class=v7><b>C</b>ontent&nbsp;&nbsp;</span></td>
<td><textarea name=memo <?=size2(44)?> rows=1 class=text><?=$memo?></textarea></td>
</tr>

<?=$hide_sitelink1_start?>
<tr>
<td align=right class=cu><span class=v7><b>H</b>ome&nbsp;<b>U</b>RL&nbsp;&nbsp;</span></td>
<td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(45)?> maxlength=200 class=input></td>
</tr>
<?=$hide_sitelink1_end?>

<tr>
<td colspan=2 align=right><input type=submit value=" Write " class=submit onfocus='this.blur()' style=cursor:hand> 
<input type=button value=" Back " onclick=history.go(-1) class=submit onfocus='this.blur()' style=cursor:hand></td>
</tr>
</table>
</td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=350>
<tr>
<td height=10></td>
</tr>
</table>