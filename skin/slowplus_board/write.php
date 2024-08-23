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
?>

<!--글쓰기-->

<?php
  if($mode=="reply") $title="<img src=$dir/images/head_reply.gif width=66 height=13>";
  elseif($mode=="modify") $title="<img src=$dir/images/head_modify.gif width=72 height=13>";
  else $title="<img src=$dir/images/head_write.gif width=98 height=13>";
?>

<table border=0 cellspacing=0 cellpadding=0 width='<?=$write_width?>'>
<tr>
  <td height=10></td>
</tr>
<tr>
  <td>
  <table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr>
    <td width=1 bgcolor='<?=$head_border?>'><img width=1 height=13></td>
	<td height=13 background=<?=$dir?>/images/head_bg.gif><img width=10 height=1><?=$title?></td>
	<td width=1 bgcolor='<?=$head_border?>'><img width=1 height=13></td>
  </tr>
  </table>
  </td>
</tr>
<tr>
  <td align=center>

<table border=0 cellspacing=0 cellpadding=0>

<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">

<?=$hide_start?>
<tr height=25>
  <td colspan=2 style='padding-top:3'>
  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
	<td width=24></td>
    <td align=right><img src=<?=$dir?>/images/write_name.gif width=22 height=5><img width=10 height=1></td>
    <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
    <td width=80 align=right><img src=<?=$dir?>/images/write_password.gif width=49 height=5><img width=10 height=1></td>
    <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
  </tr>
  </table>
</td>
</tr>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_email.gif height=5><img width=10 height=1></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_homepage.gif width=45 height=5><img width=10 height=1></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>

<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_special.gif height=5><img width=10 height=1></td>
  <td> 
  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
  <td><?=$category_kind?></td>
  <td><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1></td><td class=thm8>&nbsp;Notice &nbsp;&nbsp;<?=$hide_notice_end?></td>
  <td><?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=thm8>&nbsp;Use HTML &nbsp;&nbsp;<?=$hide_html_end?></td>
  <td><input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=thm8>&nbsp;Reply Mail &nbsp;&nbsp;</td>  
  <td><?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1></td><td class=thm8>&nbsp;Secret<?=$hide_secret_end?></td>
  </tr>
  </table>

  </td>
</tr>
<tr height=23>
  <td align=right><img src=<?=$dir?>/images/write_subject.gif width=40 height=5><img width=10 height=1></td>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input></td>
</tr>

<tr>
  <td align=right><img src=<?=$dir?>/images/write_contents.gif height=5><img width=10 height=1></td>
  <td valign=top>
  <textarea name=memo <?=size2(60)?> rows=15 class=textarea><?=$memo?></textarea></td>
</tr>

<?=$hide_sitelink1_start?>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_link1.gif width=26 height=5><img width=10 height=1></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_link2.gif width=27 height=5><img width=10 height=1></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr height=25>
  <td></td>
  <td class=thm8><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_file1.gif width=23 height=5><img width=10 height=1></td>
  <td><input type=file name=file1 <?=size(50)?> maxlength=255 class=input><?=$file_name1?></td>
</tr>
<tr height=25>
  <td align=right><img src=<?=$dir?>/images/write_file2.gif width=25 height=5><img width=10 height=1></td>
  <td><input type=file name=file2 <?=size(50)?> maxlength=255 class=input><?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>
<tr width=100%>
  <td height=30 colspan=2 align=right style='padding-bottom:5'>
    <input type=image src=<?=$dir?>/images/i_confirm.gif style='width:60;height:15'><img width=10 height=1><a href=javascript:history.go(-1)><img src=<?=$dir?>/images/i_back.gif width=60 height=15 border=0></a></td>
</tr>
</table>

</td>
</tr>
<tr>
  <td height=1 colspan=2 bgcolor='<?=$all_foot_line?>'></td>
</tr>
</table>