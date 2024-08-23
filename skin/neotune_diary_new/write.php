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
<br>
<table width=550 border=0 cellspacing=0 cellpadding=0>
<tr>
<td  height=1 class=line></td>   
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=550>
<tr>
  <td colspan=2 height=30><form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">&nbsp;&nbsp;<?=$title?></td>
</tr>
</table>
 
<table border=0 width=550 cellspacing=1 cellpadding=0 bgcolor=ffffff>
<col width=80></col><col width=></col>
<?=$hide_start?>
<tr>
  <td width=80 align=right class=neotune-write><b>Name&nbsp;</b></td>
  <td><img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>  
  <td width=80 align=right class=neotune-write><b>Password&nbsp;</b></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td width=80 align=right class=neotune-write><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr>
  <td align=right class=listnum width=80><img src=images/t.gif border=0 width=80 height=1><br><b>*&nbsp;</b></td>
  <td> 
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td><?=$category_kind?></td>
    <td><?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=neotune-upload>&nbsp;HTML &nbsp;&nbsp;<?=$hide_html_end?></td>
  </tr>
  </table>
  </td>
</tr>
<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=neotune-write><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=neotune-write><b>Contents&nbsp;</b></td>
  <td valign=top>
  <textarea name=memo <?=size2(63)?> rows=18 class=input><?=$memo?></textarea>
  </td>
</tr>

<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>

<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td class=neotune-upload>최대 <?=$upload_limit?> 까지 업로드 가능합니다.</td>
</tr>
<tr><td bgcolor=#FFFFFF height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=neotune-write><b>picture&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr>


<?=$hide_pds_end?>

</table>
<table width=550 border=0 cellspacing=0 cellpadding=0>
<tr>
    <td  height=1 class=line></td>
</tr>
</table>

<img src=images/t.gif border=0 height=10><br>

<div align=center>
      <input type=submit value="write" class=submit>
<input type=button value="back" onclick=history.go(-1) class=submit>
</div>
