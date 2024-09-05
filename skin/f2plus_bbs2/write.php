<?php 
	if($mode=="reply") $title="답글 쓰기";
	elseif($mode=="modify") $title="글 수정하기";
	else $title="새로 글 쓰기";

	$a_preview = str_replace(">","><font class=com2>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=com2>",$a_imagebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}
// -->
</SCRIPT><br><br>
<table border=0 cellspacing=1 cellpadding=4 width=<?=$width?> align=center class=list0>
<col width=200></col><col width=></col>
<tr align=left valign="middle" height=25>
	<td class=title_han2><img src=<?=$dir?>/front_img.gif>&nbsp;&nbsp;새글쓰기 </td>
	<td class=title_han2 ><?=$subject?></td>
</tr>
	<tr bgcolor=cccccc height=1>
		<td colspan=7>
		</td>
	</tr>	
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
<col width=80 align=right style=padding-right:10px;height:28px class=com2></col><col class=list1 style=padding-left:10px;height:28px width=></col>


<?=$hide_start?>
<tr>
  <td><font class=com2><b>비밀번호</b></font></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>

<tr>
  <td><font class=com2><b>이름</b></font></td>
  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
</tr>

<tr>
  <td><font class=com2>이메일</font></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>

<tr>
  <td><font class=com2>홈페이지</font></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>

<?=$hide_category_start?>
<tr> 
<td width=100 align=RIGHT>분류&nbsp;&nbsp;</td>
	  <td> 
		  <?=$category_kind?>
	  </td>
	</tr>
<?=$hide_category_end?>	

<tr>
  <td><font class=com2>옵션</font></td>
  <td class=com2>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML사용 <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
	   <input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif>
		</div>
  </td>
</tr>

<tr valign=top>
  <td><font class=com2><b>제목</b></font></td>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input></td>
</tr>

<tr>
  <td onclick=document.write.memo.rows=document.write.memo.rows+4 style=cursor:hand>
  <font class=com2><b>내용</b></font> <font class=com2>▼</font></td>
  <td style=padding-top:8px;padding-bottom:8px;><textarea name=memo <?=size2(90)?> rows=18 class=textarea style=width:99%><?=$memo?></textarea></td>
</tr>

<?=$hide_sitelink1_start?>
<tr>
  <td><font class=com2>링크 #1</font></td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
  <td><font class=com2>링크 #2</font></td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr>
  <td><font class=com2>업로드 #1</font></td>
  <td class=com2><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name1?></td>
</tr>
<tr>
  <td><font class=com2>업로드 #2</font></td>
  <td class=com2><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>

</table>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center" width=<?=$width?>>
<TR>
<TD><?php include "$dir/emo.php"; ?>
</TD>
</TR>
<table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td colspan=2>
		<table border=0 cellspacing=1 cellpadding=2 width=100% height=40>
		<tr>
			<td>
				<?=$a_preview?>미리보기</a>
				<?=$a_imagebox?>그림창고</a>
				&nbsp;
			</td>
			<td align=right>
				<input type=submit value="작성완료" class=submit accesskey="s">
				<input type=button value="취소하기" class=button onclick=history.back()>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<br>
