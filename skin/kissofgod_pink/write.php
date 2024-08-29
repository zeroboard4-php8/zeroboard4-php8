<?php 
 if ($mode=="reply") $write_str="Reply Mode";
 elseif($mode=="modify") $write_str="Edit Mode";
 else $write_str="Write Mode";
?>

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

<table border=0 cellspacing=0 cellpadding=0 width=450>
<tr>
 <td align=center><span class=kissofgod-bold-font><?=$write_str?></span></td>
</tr>
<tr>
 <td class=kissofgod-base-line></td>
</tr>
</table>
<table border=0 cellspacing=1 cellpadding=0 width=450 style='margin-top:10'>
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
<!----------------------------------------------->
 </td>
 <Td>
 
<table border=0 cellspacing=5 cellpadding=0 width=100%>

<?=$hide_start?>

<tr>
  <td width=40 style='font-family:Tahoma; font-size:8pt'>Name</td> 
  <td style='font-family:Tahoma; font-size:8pt'> <input type=text name=name value="<?=$name?>" <?=size(10)?> maxlength=20 class=input>　　PassWD <input type=password name=password <?=size(10)?> maxlength=20 class=input> </td>
</tr>

<tr>
  <td style='font-family:Tahoma; font-size:8pt'>E-mail</td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(35)?> maxlength=200 class=input> </td>
</tr>

<tr>
  <td style='font-family:Tahoma; font-size:8pt'>U R L</td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(35)?> maxlength=200 class=input> </td>
</tr>

<?=$hide_end?>

<tr>
  <td style='font-family:Tahoma; font-size:8pt'>Subject</td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>

<tr>
  <td colspan=2 align=right style='font-family:tahoma; font-size:8pt'>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> notice　<?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> html　<?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> reply email　
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> secret　<?=$hide_secret_end?>
  </td>
</tr>

<tr>
  <td valign=top style='font-family:Tahoma; font-size:8pt'>Content</td>
  <td><textarea name=memo <?=size2(63)?> rows=12 class=textarea><?=$memo?></textarea></td>
</tr>


<?=$hide_sitelink1_start?>
<tr>
  <td style='font-family:Tahoma; font-size:8pt'>Link 1</td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink1_end?>


<?=$hide_sitelink2_start?>
<tr>
  <td style='font-family:Tahoma; font-size:8pt'>Link 2</td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td><?=$upload_limit?> 이하의 화일만 올릴 수 있습니다.</td>
</tr>
<tr>
  <td style='font-family:Tahoma; font-size:8pt'>File 1</td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr>
<tr>
  <td style='font-family:Tahoma; font-size:8pt'>File 2</td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>


<tr>
  <td colspan=2 align=right>
      <input type=submit value=" Ok~! " class=kissofgod-submit>&nbsp;
      <input type=button value=" Back " onclick=history.go(-1) class=kissofgod-submit>
  </td>
</tr>

</table>

</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=450 style='margin-top:7'>
<tr>
 <td class=kissofgod-base-line></td>
</tr>
</table>
