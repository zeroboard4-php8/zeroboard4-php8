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

<table align=center border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

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
<!----------------------------------------------->

<tr>
 <td align=center>
 <table border=0 cellspacing=0 cellpadding=0 align=center>

<?=$hide_start?>
<tr height=22>
 <td width=70 align=right><font class=rini_ver4>NAME</font>&nbsp;&nbsp;&nbsp;</td>
 <td align=left><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=rini_input style="width:200;height:18;">
 </td>
</tr>

<tr height=22>
 <td width=70 align=right><font class=rini_ver4>PASSWORD</font>&nbsp;&nbsp;&nbsp;</td>
 <td align=left><input type=password name=password <?=size(20)?> maxlength=20 class=rini_input style="width:200;height:18;">
 </td>
</tr>

<tr height=22>
  <td width=70 align=right><font class=rini_ver4>E-MAIL</font>&nbsp;&nbsp;&nbsp;</td>
  <td align=left><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=rini_input style="width:340;height:18;">
  </td>
</tr>



<tr height=22>
  <td width=70 align=right><font class=rini_ver4>HOMEPAGE</font>&nbsp;&nbsp;&nbsp;</td>
  <td align=left><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=rini_input style="width:340;height:18;">
  </td>
</tr>
<?=$hide_end?>

<tr height=30>
  <td width=70 align=right><font class=rini_ver4>OPTION</font>&nbsp;&nbsp;&nbsp;</td>
  <td>
  <table height=22 border=0 cellpadding=0 cellspacing=0>
      <tr height=22>
       <td class=rini_ver3><?=$category_kind?>&nbsp;</td>
       <?=$hide_notice_start?>
       <td class=rini_ver3><input type=checkbox name=notice <?=$notice?> value=1></td>
       <td class=rini_ver3>&nbsp;Notice&nbsp;&nbsp;</td>
       <?=$hide_notice_end?>
       <?=$hide_html_start?>
       <td class=rini_ver3><input type=checkbox name=use_html <?=$use_html?> value=1></td>
       <td class=rini_ver3>&nbsp;Use html&nbsp;&nbsp;</td>
       <?=$hide_html_end?>
       <td class=rini_ver3><input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td>
       <td class=rini_ver3>&nbsp;Reply Mail&nbsp;&nbsp;</td>
       <?=$hide_secret_start?>
       <td class=rini_ver3>
       <input type=checkbox name=is_secret <?=$secret?> value=1></td>
       <td class=rini_ver3>&nbsp;Secret&nbsp;&nbsp;</td>
       <?=$hide_secret_end?>
      </tr>
   </table>
   </td>
</tr>

<tr height=22>
  <td width=70 align=right><font class=rini_ver4>SUBJECT</font>&nbsp;&nbsp;&nbsp;</td>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=rini_input style="width:340;height:18;">
  </td>
</tr>

<tr>
<td height=2 colspan=2></td>
</tr>

<tr>
  <td width=70 align=right><font class=rini_ver4>CONTENTS</font>&nbsp;&nbsp;&nbsp;</td>
  <td valign=top><textarea name=memo class=rini_textarea style='width:340px; height:200px'><?=$memo?></textarea>
  </td>
</tr>

<tr>
<td height=2 colspan=2></td>
</tr>

<?=$hide_sitelink1_start?>
<tr height=22>
  <td width=70 align=right><font class=rini_ver4>LINK 1</font>&nbsp;&nbsp;&nbsp;</td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=rini_input style="width:340;height:18;">
  </td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=22>
  <td width=70 align=right><font class=rini_ver4>LINK 2</font>&nbsp;&nbsp;&nbsp;</td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=rini_input style="width:340;height:18;">
  </td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr height=22>
  <td width=70>&nbsp;</td>
  <td class=rini_ver3>Maximum File size : <?=$upload_limit?></td>
</tr>

<tr height=22>
  <td width=70 align=right><font class=rini_ver4>FILE 1</font>&nbsp;&nbsp;&nbsp;</td>
  <td><input type=file name=file1 <?=size(50)?> maxlength=255 class=rini_input style="width:340;height:18;"> <?=$file_name1?>
  </td>
</tr>

<tr height=22>
  <td width=70 align=right><font class=rini_ver4>FILE 2</font>&nbsp;&nbsp;&nbsp;</td>
  <td><input type=file name=file2 <?=size(50)?> maxlength=255 class=rini_input style="width:340;height:18;"> <?=$file_name2?>
  </td>
</tr>
<?=$hide_pds_end?>

<tr>
<td height=10 colspan=2></td>
</tr>

</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr height=30>
  <td align=center>
  <input type=submit value="write" class=rini_submit>
  <input type=button value="back" onclick=history.go(-1) class=rini_submit>
  </td>
</tr>

<tr>
<td height=10></td>
</tr>
</table>

</td>
</tr>
</table>