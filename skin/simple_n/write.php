<?php
 if ($mode=="reply") $write_str="Reply to this article";
 elseif($mode=="modify") $write_str="Modify this article";
 else $write_str="Write a new article";
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

<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
<!-------------------------------------------->

<table border=0 cellspacing=0 cellpadding=0 width=500 height=20>
<tr>
  <td height=2 colspan=9 bgcolor=444444></td>
</tr>
<tr height=25>
 <td align=right class=yeinlfont><b><?=$write_str?></b>&nbsp;&nbsp;</td>
</tr>
<tr>
  <td height=4 background=<?=$dir?>/image/v_bg1.gif></td>
</tr>
<tr>
  <td height=5></td>
</tr>


</table>

<table border=0 width=500 cellspacing=0 cellpadding=0>

<?=$hide_start?>

<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_name.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=name value="<?=$name?>" <?=size(50)?> maxlength=10 class=input> </td>
</tr>



<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_password.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=password name=password <?=size(50)?> maxlength=20 class=input></td>
</tr>



<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_email.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=email value="<?=$email?>" <?=size(50)?> maxlength=200 class=input> </td>
</tr>



<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_home.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=homepage value="<?=$homepage?>" <?=size(50)?> maxlength=200 class=input> </td>
</tr>

<?=$hide_end?>

<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_specal.gif border=0 align=absmiddle></td>
  <td class=yeinfont>

        &nbsp;<?=$category_kind?>
	   <?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>공지기능<?=$hide_notice_end?>
       <?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>HTML 사용<?=$hide_html_end?>
       <?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>비밀글<?=$hide_secret_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1>답변메일

  </td>
</tr>



<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_subject.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=subject value="<?=$subject?>" <?=size(65)?> maxlength=200 class=input></td>
</tr>


<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/w_contents.gif border=0 align=absmiddle></td>
  <td>&nbsp;<textarea name=memo rows=24 class=textarea style=width:400;height:250;><?=$memo?></textarea></td>
</tr>

<?=$hide_sitelink1_start?>
<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/link1.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(65)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/link2.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(65)?> maxlength=200 class=input> </td>
</tr>


<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
<tr>
  <td width=70 height=20>&nbsp;</td>
  <td>&nbsp;업로드는 <?=$upload_limit?> 까지 올릴수있습니다</td>
</tr>

<tr>
  <td width=70 height=27><img src=<?=$dir?>/image/file1.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=file name=file1 <?=size(50)?> maxlength=255 class=input><?=$file_name1?></td>
</tr>


<tr>
	<td width=70 height=27><img src=<?=$dir?>/image/file2.gif border=0 align=absmiddle></td>
  <td>&nbsp;<input type=file name=file2 <?=size(50)?> maxlength=255 class=input><?=$file_name2?></td>
</tr>


<?=$hide_pds_end?>
</table>

<br>

<table border=0 cellspacing=1 cellpadding=1 width=500>
<tr align=center height=30>
  <td align=right>
<input type=image border=0 align=absmiddle src=<?=$dir?>/image/i_write.gif>&nbsp;<img src=<?=$dir?>/image/i_back.gif align=absmiddle border=0 style=cursor:hand onclick=history.back()>&nbsp;&nbsp;

  </td>
</tr>
</table>

<br><br>