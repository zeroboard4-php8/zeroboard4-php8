<?php
	if($mode=="reply") $title="답글 쓰기";
	elseif($mode=="modify") $title="글 수정하기";
	else $title="새로 글 쓰기";

	$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}
// -->
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
<col width=80 align=right style=padding-right:10px;height:28px class=list1></col><col class=list0 style=padding-left:10px;height:28px width=></col>
<tr>
	<td colspan=2 background=<?=$dir?>/h_bg.gif><img src=<?=$dir?>/write.gif border=0 align=left></td>
</tr>

<?=$hide_start?>
<tr>
  <td algin=left><img src=<?=$dir?>/w_password.gif border=0 vling=middle></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>

<tr>
  <td algin=left> <img src=<?=$dir?>/w_name.gif border=0 vling=middle></td>
  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
</tr>

<tr>
  <td algin=left> <img src=<?=$dir?>/w_email.gif border=0 vling=middle>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>

<tr>
  <td algin=left> <img src=<?=$dir?>/w_homepage.gif border=0 vling=middle> </td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>

<tr>
  <td algin=left><img src=<?=$dir?>/w_special.gif border=0 vling=middle></td>
  <td class=list_eng>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML사용 <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
  </td>
</tr>

<tr valign=top>
  <td algin=left> <img src=<?=$dir?>/w_subject.gif border=0 vling=middle>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input></td>
</tr>

<tr>
  <td onclick=document.write.memo.rows=document.write.memo.rows+4 style=cursor:hand><img src=<?=$dir?>/w_content.gif border=0></td>
  <td style=padding-top:8px;padding-bottom:8px;><textarea name=memo <?=size2(80)?> rows=10 class=textarea style=width:99%><?=$memo?></textarea></td>
</tr>

<tr>
<td colspan=2 style=padding:5px>
<!-- 이모티콘 들어갈 부분 -->
<!-- 이모티콘 끝 -->
</td>
</tr>

<?=$hide_sitelink1_start?>
<tr>
  <td algin=left><img src=<?=$dir?>/w_sitelink1.gif border=0 vling=middle></td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
  <td algin=left><img src=<?=$dir?>/w_sitelink2.gif border=0 vling=middle></font></td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr>
  <td algin=left><img src=<?=$dir?>/w_upload1.gif border=0 vling=middle></td>
  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name1?></td>
</tr>
<tr>
  <td algin=left><img src=<?=$dir?>/w_upload2.gif border=0 vling=middle></td>
  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>

</table>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td colspan=2>
		<table border=0 cellspacing=1 cellpadding=2 width=100% height=40>
		<tr>
			<td>
				
			</td>
			<td align=right>
				<input type=image src=<?=$dir?>/i_write.gif border=0>
                                <a href=javascript:void(history.back())><img src=<?=$dir?>/i_back.gif border=0>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<br>
