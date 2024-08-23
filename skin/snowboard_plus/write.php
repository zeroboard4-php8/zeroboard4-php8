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
<br>
<?php
  if($mode=="reply") $title="<span style=font-family:verdana;font-size:8pt;font-weight:bold;><font color=gray>Post a </font><font color=red>Reply</font></span>";
  elseif($mode=="modify") $title="<span style=font-family:verdana;font-size:8pt;font-weight:bold;><font color=red>Modify</font><font color=gray> Article</font></span>";
  else $title="<span style=font-family:verdana;font-size:8pt;font-weight:bold;><font color=gray>Post a</font><font color=red> New</font><font color=gray> Article</font></span>";
?>
<table border=0 cellspacing=0 cellpadding=0 width=550 >
<tr><td colspan=100><table width=100% cellpadding=1 cellspacing=0 border=0 bgcolor=c3c3c3>
<tr><td><table width=100% cellpadding=0 cellspacing=0 border=0 bgcolor=white><tr><td>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
   <td colspan=2><table width=100% height=22 border=0 cellspacing=0 cellpadding=f7f7f7>
  <tr><td>
<table width=100% height=20 border=0 cellspacing=0 cellpadding=0 bgcolor=f7f7f7><tr>
   <td align=left nowrap >&nbsp;&nbsp;<?=$title?></td>
   <td align=right nowrap class=t9b_gray>resize writing form</span> &nbsp;&nbsp;<img src=<?=$dir?>/image/btn_down.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_down(document.write.memo)>
	    &nbsp; <img src=<?=$dir?>/image/btn_up.gif border=0 valign=absmiddle style=cursor:hand; onclick=sb_formresize_up(document.write.memo)>&nbsp;&nbsp;
  </td>
  </tr>
</table></td>
</tr>
</table>

</td></tr></table>

<table border=0 cellspacing=0 cellpadding=0 width=550>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr>
 <td width=0>
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
 
<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor=>

<?=$hide_start?>
<tr height=25>
 <td colspan=2>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td width=72 align=right class=t7_gray><b>Name&nbsp;</b></td>
  <td align=left>
  <img src=/image/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input>
  </td>
  <td width=80 align=center class=t7_gray><b>Password&nbsp;</b></td>
  <td>
  <input type=password name=password <?=size(20)?> maxlength=20 class=input>
  </td>
</tr>
</table>
</td></tr>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>E-mail&nbsp;</b></td>
  <td width=100%> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Homepage&nbsp;</b></td>
  <td width=100%> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<?=$hide_end?>

<tr height=25>
  <td align=right class=t7_gray width=80><b>Option&nbsp;</b></td>
  <td width=100%> 
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr><td class=g8_gray>
	   <?=$category_kind?> 
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1 > 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML사용 <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
  </td></tr>
  </table>
  </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr>
  <td width=80 align=right class=t7_gray><b>Subject&nbsp;</b></td>
<td width=100%><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input></td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr>
  <td width=80 align=right class=t7_gray><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contents&nbsp;</b></td>
  <td valign=top width=100%>
  <textarea name=memo <?=size2(70)?> rows=20 style=padding:3px class=sb_contents><?=$memo?></textarea>
  </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<?=$hide_sitelink1_start?>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>Link &nbsp;</b></td>
  <td width=100%> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<?=$hide_sitelink1_end?>
<?=$hide_sitelink2_start?>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>Link &nbsp;</b></td>
  <td width=100%> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<?=$hide_sitelink2_end?>
<?=$hide_pds_start?>
<tr height=25>
  <td>&nbsp;</td>
  <td class=t7_gray><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>File #1&nbsp;</b></td>
  <td width=100%> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr height=25>
  <td width=80 align=right class=t7_gray><b>File #2&nbsp;</b></td>
  <td width=100%> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>
</table></td></tr></table></td></tr></table></td></tr></table>

<table border=0 cellspacing=1 cellpadding=1 width=550>
<tr align=center height=30>
  <td align=left>
      <?=$a_preview?><img src=<?=$dir?>/image/btn_preview.gif border=0></a>&nbsp;&nbsp;
      <?=$a_imagebox?><img src=<?=$dir?>/image/btn_imagebox.gif border=0></a>
  </td>
  <td align=right>
	  <input type=image border=0 align=absmiddle src=<?=$dir?>/image/btn_confirm.gif>&nbsp;&nbsp; 
      <img src=<?=$dir?>/image/btn_back.gif align=absmiddle border=0 onclick=history.go(-1) style=cursor:hand>
</tr>
</table>

</td>
</tr>
</table><br>
