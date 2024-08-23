<?php include "$dir/value.php3"; ?>

<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=500>
<tr align=center>
  <td background=<?=$dir?>/images/lh_bg.gif><img src=images/t.gif height=15></td>
  </tr>
</table>
<?php
  if($mode=="reply") $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Post a </font> <span style=font-size:15px;letter-spacing:-1px;>Reply</span></span>";
  elseif($mode=="modify") $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Modify</font> <span style=font-size:15px;letter-spacing:-1px;>Data</span></span>";
  else $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Post a </font> <span style=font-size:15px;letter-spacing:-1px;>Data</span></span>";
?>
<table border=0 cellspacing=1 cellpadding=0 width=500>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<?=$title?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
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
 
<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor=<?=$sC_light1?>>

<?=$hide_start?>
<tr height=25>
 <td colspan=2>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td width=80 align=right class=thm8><b>Name&nbsp;</b></td>
  <td>
  <img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input>
  </td>
  <td width=80 align=right class=thm8><b>Password&nbsp;</b></td>
  <td>
  <input type=password name=password <?=size(20)?> maxlength=20 class=input>
  </td>
</tr>
</table>
</td></tr>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Homepage&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr height=25>
  <td align=right class=thm8 width=80><b>My Category&nbsp;</b></td>
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
  </tr>
  </table>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Contents&nbsp;</b></td>
  <td valign=top>
  <textarea name=memo <?=size2(60)?> rows=20 class=textarea><?=$memo?></textarea>
  </td>
</tr>

<?=$hide_sitelink1_start?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Site Link&nbsp;</b></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Link File&nbsp;</b></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr align=center>
  <td colspan=2 class=thm8><img src=images/t.gif height=4><br><b>스크린샷은 가로 150px 이어야 합니다.</b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Upload File&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr> 
<?=$hide_pds_end?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>ScreenShot&nbsp;</b></td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
</table>

<table border=0 cellspacing=1 cellpadding=1 width=500>
<tr align=center height=30>
  <td align=right>
      <input type=image border=0 align=absmiddle src=<?=$dir?>/images/btn_confirm.gif>
      <img src=<?=$dir?>/images/btn_back.gif align=absmiddle border=0 style=cursor:hand onclick=history.back()>
  </td>
</tr>
</table>

</td>
</tr>
</table>
