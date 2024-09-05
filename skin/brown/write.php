<?php 
  /*
  write.php 는 글쓰기 폼입니다.
  아래 변수를 사용합니다.

  회원일때 나타나지 않는 부분을 처리하는 부분입니다. 감싸주면 회원일때는 나타나지 않습니다.
  <?=$hide_start?> : 회원일때 글쓰기등을 나타나지 않게 하는 부분입니다;; 회원일때는 자동 주석(<!--)이 들어갑니다.  
  <?=$hide_end?>  : 회원일때 보이지 않게 합니다. <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.

  <?=$hide_sitelink1_start?>, <?=$hide_sitelink1_end?> : 싸이트링크 1번을 사용하는지 않하는지 표시
  <?=$hide_sitelink2_start?>, <?=$hide_sitelink2_end?> : 싸이트링크 2번을 사용하는지 않하는지 표시
  <?=$hide_pds_start?>, <?=$hide_pds_end?> : 자료실을 사용하는지 않하는지 표시
  <?=$hide_html_start?>, <?=$hide_html_end?> : HTML 체크박스 표시 


  <?=$title?> : 신규, 수정, 답글일때의 제목 표시

  아래변수는 해당폼에 있는것을 그대로 놔두시면 됩니다.
  <?=$name?> : 원본 이름입니다.
  <?=$subject?> : 원본 제목입니다.
  <?=$email?> : 원본 메일입니다.
  <?=$homepage?> : 홈페이지입니다.
  <?=$memo?> : 원본 내용입니다.
  <?=$sitelink1?> : 싸이트 링크 1번입니다
  <?=$sitelink2?> : 싸이트 링크 2번입니다
  <?=$file_name1?> : 업로드된 파일 1번입니다.
  <?=$file_name2?> : 업로드된 파일 2번입니다.
  <?=$category_kind?> : 카테고리 셀렉트 박스
  <?=$use_html?> : HTML 체크 표시;; 즉 html체크였을때(수정) checked 가 들어가 있음;;
  <?=$reply_mail?> : 답변메일 체크 표시;;
  <?=$secret?> : 비밀글 표시
  <?=$upload_limit?> : 업로드 용량
  */
?>

<?php 
 if ($mode=="reply") $write_str="<img src=$dir/head_reply.gif>";
 elseif($mode=="modify") $write_str="<img src=$dir/head_modify.gif>";
 else $write_str="<img src=$dir/head_write.gif>";
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
<!----------------------------------------------->

<table cellspacing=0 cellpadding=0 width=<?=$width?>>
	<tr>
	  <td><img src="<?=$dir?>/t_img.gif" border="0"></td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/s_top_bg.gif><img src=<?=$dir?>/s_top_bg.gif border=0></td>
	</tr>
</table>


<table width=<?=$width?> cellspacing=0 cellpadding=0>
<?=$hide_start?>
	<tr height=27>
		<td width=75 align=right><font class=ver8><b><b>Name</b></font><img width=5></td> 
	  <td style="padding:5 5 5 5;"><input type="text" name="name" value="<?=$name?>" maxlength="20" class="input"> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td width=75 align=right><font class=ver8><b>Password</b></font><img width=5></td>
		<td style="padding:5 5 5 5;"><input type=password name=password maxlength=20 class=input> </td>
	<tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td align=right><font class=ver8><b>E-Mail</b></font><img width=5></td>		<td style="padding:5 5 5 5;"><input type=text name=email value="<?=$email?>" maxlength=200 class=input2> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td align=right><font class=ver8><b>Homepage</b></font><img width=5></td>
		<td style="padding:5 5 5 5;"><input type=text name=homepage value="<?=$homepage?>" maxlength=200 class=input2> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
<?=$hide_end?>
	<tr height=27>
		<td align=right width=75><font class=ver8><b>Function</b></font><img width=5></td>
		<td style="padding:5 5 5 5;">
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> <font class=ver8>Notice</font><?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> <font class=ver8>Use HTML</font><?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> <font class=ver8>ReplyMail</font>
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> <font class=ver8>Secret</font><?=$hide_secret_end?>
		</td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td align=right><font class=ver8><b>Subject</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><input type=text name=subject value="<?=$subject?>" maxlength=200 class=input2> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td align=right><font class=ver8><b>Content</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><textarea name=memo rows=24 class=textarea><?=$memo?></textarea></td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
<?=$hide_sitelink1_start?>
	<tr height=27>
		<td align=right><font class=ver8><b>Link#1</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><input type=text name=sitelink1 value="<?=$sitelink1?>" maxlength=200 class=input2> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
<?=$hide_sitelink1_end?>
<?=$hide_sitelink2_start?>
	<tr height=27>
		<td align=right><font class=ver8><b>Link#2</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><input type=text name=sitelink2 value="<?=$sitelink2?>" maxlength=200 class=input2> </td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
<?=$hide_sitelink2_end?>
<?=$hide_pds_start?>
	<tr height=27>
		<td align=right><font class=ver8><b>Upload#1</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><input type=file name=file1 maxlength=255 class=input2> <?=$file_name1?></td>
	</tr>
	<tr>
	  <td background=<?=$dir?>/line_back.gif colspan=2></td>
	</tr>
	<tr height=27>
		<td align=right><font class=ver8><b>Upload#2</b></font><img width=5></td>
		<td style="padding:5 5 5 5;" align="center"><input type=file name=file2 maxlength=255 class=input2> <?=$file_name2?></td>
	</tr>
<?=$hide_pds_end?>
</table>
<table cellspacing=0 cellpadding=0 width=<?=$width?>>
	<tr>
	  <td colspan=2 background=<?=$dir?>/s_top_bg.gif><img src=<?=$dir?>/s_top_bg.gif border=0></td>
	</tr>
	<tr>
	  <td height=10 colspan=2></td>
	</tr>
	<tr>
		<td><?=$a_preview?><img src=<?=$dir?>/preview.gif border=0></a></td>
		<td align=right><input type=image src="<?=$dir?>/confirm.gif" accesskey="s"> <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/cancel.gif border=0></a></td>
	</tr>
</table>
<br>