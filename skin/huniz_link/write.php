<?php 
if($mode=="reply") $write_str=" 답 변 달 기 ";
elseif($mode=="modify") $write_str=" 다 시 쓰 기 ";
else $write_str=" 새글 올리기 ";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function formresize(mode) {
  if(mode == 0) {
    document.write.memo.cols  = 80;
    document.write.memo.rows  = 20;
  }
  if(mode == 1) {
    document.write.memo.cols += 5;
  }
  if(mode == 2) {
    document.write.memo.rows += 3;
  }
}
// -->
</SCRIPT>

<table width=<?=$width?> cellspacing=0 cellpadding=0 border=0>
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=mode value="<?=$mode?>">
<tr>
<td align=center valign=middle colspan=2>
<table width=100% height=27 style="margin-bottom:5px; border-width:1px; border-color:#efefef; border-style:solid;" cellpadding="0" cellspacing="0" bgcolor="#F7F7F7">
    <tr>
        <td><center><b><?=$write_str?></b></center></td>
    </tr>
</table>
</td>
</tr>
<tr>
<td colspan=2 height=1 bgcolor=#efefef></td>
</tr>
<?=$hide_start?>
<tr>
<td width=80 bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>비밀번호&nbsp;&nbsp;</td> 
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;"><input type=password name=password style='width:400px' maxlength=20 class=write_form_style></td>
</tr>
<tr>
<td width=80 bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>이&nbsp;&nbsp;름&nbsp;&nbsp;</td> 
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;"><input type=text name=name value="<?=$name?>" style='width:400px' maxlength=20 class=write_form_style></td>
</tr>
<tr>
<td bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>메&nbsp;&nbsp;일&nbsp;&nbsp;</td>
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;"><input type=text name=email value="<?=$email?>" style='width:400px' maxlength=200 class=write_form_style></td>
</tr>
<tr>
<td bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>주&nbsp;&nbsp;소&nbsp;&nbsp;</td>
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;"><input type=text name=homepage value="<?=$homepage?>" style='width:400px' maxlength=200 class=write_form_style></td>
</tr>
<?=$hide_end?>
<tr>
<td bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>제&nbsp;&nbsp;목&nbsp;&nbsp;</td>
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;"><input type=text name=subject value="<?=$subject?>" style='width:400px' maxlength=200 class=write_form_style></td>
</tr>
<tr>
<td bgcolor=#f7f7f7 style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;" align=right>유&nbsp;&nbsp;형&nbsp;&nbsp;</td>
<td style="border-bottom-width:1px; border-bottom-color:rgb(239,239,239); border-bottom-style:solid;">
<?=$category_kind?>
<?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>공지사항 <?=$hide_notice_end?>
<?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>태그사용 <?=$hide_html_end?>
<?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>비공개글 <?=$hide_secret_end?>
<input type=checkbox name=reply_mail <?=$reply_mail?> value=1>답글수신
</td>
</tr>
<tr>
<td align=right>내&nbsp;&nbsp;용&nbsp;&nbsp;</td>

<td style="padding-top:6px; padding-bottom:2px;">
<textarea name=memo style='width:100%; height:250px' class=textarea style="background-image:url('<?=$dir?>/img/line.gif');"><?=$memo?></textarea></td>
<tr>
<td height=4></td>
</tr>
</tr>
<?=$hide_sitelink1_start?>
<tr>
<td bgcolor=#f7f7f7 style="border-top-width:1px; border-bottom-width:1px; border-top-color:rgb(239,239,239); border-bottom-color:rgb(239,239,239); border-top-style:solid; border-bottom-style:solid;" align=right>사이트&nbsp;</td>
<td style="border-top-width:1px; border-bottom-width:1px; border-top-color:rgb(239,239,239); border-bottom-color:rgb(239,239,239); border-top-style:solid; border-bottom-style:solid;"><input type=text name=sitelink1 value="<?=$sitelink1?>" style='width:100%' maxlength=200 class=write_form_style></td>
</tr>
<?=$hide_sitelink1_end?>
<?=$hide_pds_start?>
<tr>
<td colspan=2 class=vd7-n><center><B>MAX&nbsp;&nbsp;<?=$upload_limit?></center></b></td>
</tr>
<tr>
<td style="border-top-width:1px; border-bottom-width:1px; border-top-color:rgb(239,239,239); border-bottom-color:rgb(239,239,239); border-top-style:solid; border-bottom-style:solid;" align=right bgcolor=#f7f7f7>스크린샷&nbsp;</td>
<td style="border-top-width:1px; border-bottom-width:1px; border-top-color:rgb(239,239,239); border-bottom-color:rgb(239,239,239); border-top-style:solid; border-bottom-style:solid;"><input type=file name=file1 style='width:100%' maxlength=255 class=write_form_style> <?=$file_name1?></td>
</tr>
<?=$hide_pds_end?>
<tr>
<td class=none>&nbsp;</td>
<td>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td height=8></td>
</tr>
<tr>
<td align=right>
<input type=submit value="글올리기" class=submit onfocus=this.blur()>&nbsp;
<input type='reset' value='다시쓰기' class='submit' onfocus=this.blur()>&nbsp;
<input type=button value="취  소" onclick=history.go(-1) class=submit onfocus=this.blur()>
</td>
</tr>
</tr>
</table>
</td>
</tr>
<tr>
<td height=10 colspan=2 class=none>&nbsp;</td>
</tr>
<tr>
<td colspan=2 height=1 bgcolor=#f7f7f7></td>
</tr>
</form>
</table>
