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
<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=550>
<tr>
   <td colspan=2><table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=FFF0D3 bordercolorlight=FFE5B2 bordercolordark=#FFFFFF>
  <tr>
    <td style=font-family:Arial;font-size:8pt;color:666666 align=center nowrap><img src=/images/t.gif height=3></td>
  </tr>
</table></td>
</tr>
</table>

<?php 
  if($mode=="reply") $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;></span>";
  elseif($mode=="modify") $title="<span style=font-family:Afial;font-size:8pt;font-weight:bold;></span>";
  else $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;></span>";
?>
<table border=0 cellspacing=1 cellpadding=0 width=550>
<tr>
  <td colspan=2 height=10><?=$title?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark1?>><img src=images/t.gif height=1></td></tr>
<tr>
 <td width=1>
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
 </td>
 <Td>
 
<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor=ffffff>

<?=$hide_start?>
<tr height=25>
 <td colspan=2>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td width=80 align=right class=thm8><b>Name&nbsp;</b></td>
  <td>
  <img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;">
  </td>
  <td width=80 align=right class=thm8><b>Password&nbsp;</b></td>
  <td>
  <input type=password name=password <?=size(20)?> maxlength=20 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;">
  </td>
</tr>
</table>
</td></tr>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Homepage&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr height=25>
  <td align=right class=thm8 width=80><b>Special&nbsp;</b></td>
  <td> 
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td> 
<?=$category_kind?> 
  </td>
  <td>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1></td><td class=thm8>&nbsp;Notice &nbsp;&nbsp;<?=$hide_notice_end?></td>
  <td>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=thm8>&nbsp;Use HTML &nbsp;&nbsp;<?=$hide_html_end?></td>
  <td>     <input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=thm8>&nbsp;Reply Mail &nbsp;&nbsp;</td>  
  <td>    <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1></td><td class=thm8>&nbsp;Secret &nbsp;&nbsp;<?=$hide_secret_end?></td>
  </tr>
  </table>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Contents&nbsp;</b></td>
  <td valign=top>
  <textarea name=memo style="background-color:F9FCF5; border-width:1; border-color:rgb(193,214,152); border-style:solid;" <?=size2(70)?> rows=20 class=textarea><?=$memo?></textarea>
  </td>
</tr>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_start?>
<tr height=25>
  <td align=right class=thm8><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"></td>
</tr>
<?=$hide_sitelink1_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_start?>
<tr height=25>
  <td align=right class=thm8><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"> </td>
</tr>
<?=$hide_sitelink2_end?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>

<?=$hide_pds_start?>
<tr height=25>
  <td>&nbsp;</td>
  <td class=thm8><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>File #1&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input style="background-color:F3F9E8; border-width:1px; border-color:C1D698; border-style:solid;"> <?=$file_name1?></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>File #2&nbsp;</b></td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input style="background-color:F9FCF5; border-width:1px; border-color:C1D698; border-style:solid;"> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>
<tr height=1><td colspan=2 bgcolor=ffffff><img src=images/t.gif height=1></td></tr>
</table>

<table border=0 cellspacing=1 cellpadding=1 width=550>
<tr align=center height=30>
  <td align=center>
      <input type=image border=0 align=absmiddle src=<?=$dir?>/i_write.gif> &nbsp;&nbsp;
      <img src=<?=$dir?>/i_list.gif align=absmiddle border=0 style=cursor:hand onclick=history.back()>
  </td>
</tr>
</table>

</td>
</tr>
</table>
