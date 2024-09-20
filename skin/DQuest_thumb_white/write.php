<?php 
	$_dq_tempFile="data/$id/small_".$no.".thumb";
	if(file_exists($_dq_tempFile)) unlink ($_dq_tempFile);
	if($mode=="reply") $title="답글 쓰기";
	elseif($mode=="modify") $title="글 수정하기";
	else $title="새로 글 쓰기";

	$a_preview = str_replace(">","><font class=thumb_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=thumb_eng>",$a_imagebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}
// -->
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=0 cellpadding=5 style=table-layout:fixed>
<tr><td class=thumb_bg>
	<table border=0 width=100% cellsapcing=1 cellpadding=0>
	<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
	<col width=80 align=right style=padding-right:10px;height:28px class=w1></col><col class=w2 style=padding-left:10px;height:28px width=></col>

	<tr><td colspan=2 style=padding:0><img src=<?=$dir?>/t.gif height=1></td></tr>
	<tr>
		<td colspan=2 class=line2 align=center style=padding:5px>&nbsp;&nbsp;<b><?=$title?></b></td>
	</tr>
	<tr><td colspan=2 style=padding:0 src=<?=$dir?>/t.gif height=2></td></tr>

	<?=$hide_start?>
	<tr>
	  <td><font class=thumb_eng><b>비밀번호</b></font></td>
	  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
	</tr>

	<tr>
	  <td><font class=thumb_eng><b>이름(별명)</b></font></td>
	  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
	</tr>

	<tr>
	  <td><font class=thumb_eng>이메일</font></td>
	  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
	</tr>

	<tr>
	  <td><font class=thumb_eng>홈페이지</font></td>
	  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
	</tr>
	<?=$hide_end?>

	<tr>
	  <td><font class=thumb_eng>선택</font></td>
	  <td class=thumb_eng>
		   <?=$category_kind?>
		   <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
		   <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML사용 <?=$hide_html_end?>
		   <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
		   <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
	  </td>
	</tr>

	<tr valign=top>
	  <td><font class=thumb_eng><b>글 제목</b></font></td>
	  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input2></td>
	</tr>
	<?php 
	$zfile='';
	if($mode == "modify" && $setup['use_alllist']) $zfile="/zboard.php?";
	if($mode == "modify" && !$setup['use_alllist']) $zfile="/view.php?";

	$_zboard_url = str_replace(strstr($_SERVER['HTTP_REFERER'],$zfile),"",$_SERVER['HTTP_REFERER']);
	$imageBoxPattern = "/\[img\:(.+?)\.(jpg|jpeg|gif)\,align\=([a-z]){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
	if(isset($data['ismember'])) $memo=preg_replace($imageBoxPattern,"<img src='$_zboard_url/icon/member_image_box/{$data['ismember']}/\\1.\\2' align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>", stripslashes($memo));
	?>

	<tr>
	  <td onclick=document.write.memo.rows=document.write.memo.rows+4 style=cursor:hand><font class=thumb_eng><b>내용</b></font> <font class=thumb_eng>▼</font></td>
	  <td style=padding-top:8px;padding-bottom:8px;><textarea name=memo <?=size2(90)?> rows=18 class=textarea style=width:99%><?=$memo?></textarea></td>
	</tr>

	<?=$hide_sitelink1_start?>
	<tr>
	  <td><font class=thumb_eng>촬영장소</font></td>
	  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input2 style=width:99%></td>
	</tr>
	<?=$hide_sitelink1_end?>

	<?=$hide_sitelink2_start?>
	<tr>
	  <td><font class=thumb_eng>사진설명</font></td>
	  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input2 style=width:99%>
	</tr>
	<?=$hide_sitelink2_end?>

	<?=$hide_pds_start?>
	<tr>
	  <td><font class=thumb_eng>업로드 #1</font></td>
	  <td class=thumb_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input2 style=width:99%> <?=$file_name1?></td>
	</tr>

	<tr>
	  <td><font class=thumb_eng>업로드 #2</font></td>
	  <td class=thumb_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input2 style=width:99%> <?=$file_name2?></td>
	</tr>

	<?=$hide_pds_end?>

	</table>

	<table border=0 width=100% cellsapcing=1 cellpadding=0>
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
</td></tr></table>