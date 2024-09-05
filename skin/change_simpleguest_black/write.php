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
<br>
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
  include "$dir/value.php3";

  if($mode=="reply") $title="<font class=view_tile1>Post a </font> <font class=change_tahoma_8pt>Reply</font>";
  elseif($mode=="modify") $title="<font class=view_tile1>Modify </font> <font class=change_tahoma_8pt>Article</font>";
  else $title="<font class=view_tile1>New </font> <font class=change_tahoma_8pt>Article</font>";
?>

<!-- HTML -->

<table border=0 cellspacing=0 cellpadding=0 width=350>
<tr><td height=1 bgcolor=<?=$line_color?>></td></tr>
<tr>
<td bgcolor=<?=$bg_color?> align=center>
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
<input type=hidden name=mode value="<?=$mode?>"><b><?=$title?></b>
</td>
</tr>
</table>


<table border=0 width=350 cellspacing=0 cellpadding=0 >
<col width=60></col><col width=></col>



<?=$hide_start?>
<tr><td colspan=3>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<col width=60></col><col></col><col width=60></col><col></col>

<tr><td height=8 colspan=2></td></tr>
</table>



</td>
</tr>

<tr>
<td height=23 align=right class=change_tahoma_8pt>Name&nbsp;</td>
<td colspan=2><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=change_input></td>
</tr>

<tr>
<td height=23 align=right class=change_tahoma_8pt>E-mail&nbsp;</td>
<td colspan=2><input type=text name=email value="<?=$email?>" <?=size(44)?> maxlength=200 class=change_input></td>
</tr>

<tr>
<td height=23 align=right class=change_tahoma_8pt>Homepage&nbsp;</td>
<td colspan=2> <input type=text name=homepage value="<?=$homepage?>" <?=size(44)?> maxlength=200 class=change_input> </td>
</tr>
<?=$hide_end?>



<tr>
<td height=23 align=right class=change_tahoma_8pt>Special&nbsp;</td>

<td colspan=2> 

<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><?=$category_kind?></td>
<td><?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1></td><td class=change_tahoma_8pt>&nbsp;Notice &nbsp;&nbsp;<?=$hide_notice_end?></td>
<td><?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=change_tahoma_8pt>&nbsp;HTML &nbsp;&nbsp;<?=$hide_html_end?></td>
<td><input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=change_tahoma_8pt>&nbsp;Reply Mail&nbsp;&nbsp;</td>  
<td><input type=hidden name=subject value='Guest' <?=size(34)?> maxlength=200 class=input></td>
</tr>
</table>

</td>
</tr>

<tr>
<td align=right class=change_tahoma_8pt>Contents&nbsp;</td>
<td colspan=2>
<textarea name=memo <?=size2(43)?> rows=9 class=textarea><?=$memo?></textarea>
</td>
</tr>

<tr>
<td align=right class=change_tahoma_8pt ><?=$hide_start?>Password&nbsp;<?=$hide_end?></td>
<td><?=$hide_start?><input type=password name=password <?=size(20)?> maxlength=20 class=change_input><?=$hide_end?></td>
<td align=right nowrap><input type=submit value="Write" class=submit> <input type=button value="Back" class=submit onclick=history.back()>
</td>
<td width=20>
</td>
</tr>

<tr><td height=8 colspan=4></td></tr>
<tr><td height=1 bgcolor=<?=$line_color?> colspan=4></td></tr>

</table>
<br>
<div align=center>
</div>