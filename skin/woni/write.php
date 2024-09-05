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

<table border=0 cellspacing=0 cellpadding=0 width=600>
<tr>
 <td><img src=<?=$dir?>/h_left.gif border=0></td>
 <td background=<?=$dir?>/h_bg.gif width=100%><img src=<?=$dir?>/h_bg.gif border=0></td>
 <td><img src=<?=$dir?>/h_right.gif border=0></td>
</tr>
</table>
<table border=0 cellspacing=1 cellpadding=0 width=600>
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
 
<table border=0 width=100% cellsapcing=0 cellpadding=2>

<?=$hide_start?>

<tr>
  <td align=right><img src=<?=$dir?>/w_password.gif border=0></td>
  <td> <input type=password name=password <?=size(20)?> maxlength=20 class=input3> </td>
</tr>

<tr>
  <td width=80 align=right> <img src=<?=$dir?>/w_name.gif border=0> </td> 
  <td> <input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input3> </td>
</tr>

<tr>
  <td align=right> <img src=<?=$dir?>/w_email.gif border=0> </td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input3> </td>
</tr>

<tr>
  <td align=right> <img src=<?=$dir?>/w_homepage.gif border=0> </td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input3> </td>
</tr>

<?=$hide_end?>

<tr>
  <td align=right width=80> <img src=<?=$dir?>/w_special.gif border=0> </td>
  <td style=font-family:민9;font-size:9pt>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> NOTICE <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> REPLY MAIL      
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> SECRET <?=$hide_secret_end?>
  </td>
</tr>

<tr>
  <td align=right> <img src=<?=$dir?>/w_subject.gif border=0> </td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input3> </td>
</tr>

<tr>
  <td align=right> <img src=<?=$dir?>/w_content.gif border=0> </td>
  <td><textarea name=memo <?=size2(80)?> rows=20 class=textarea><?=$memo?></textarea></td>
</tr>


<?=$hide_sitelink1_start?>
<tr>
  <td align=right> <img src=<?=$dir?>/w_sitelink1.gif border=0> </td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input3> </td>
</tr>
<?=$hide_sitelink1_end?>


<?=$hide_sitelink2_start?>
<tr>
  <td align=right> <img src=<?=$dir?>/w_sitelink2.gif border=0> </td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input3> </td>
</tr>
<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td >업로드는 <?=$upload_limit?> 까지 올릴수있습니다</td>
</tr>
<tr>
  <td align=right> <img src=<?=$dir?>/w_upload1.gif border=0> </td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input3> <?=$file_name1?></td>
</tr>
<tr>
  <td align=right> <img src=<?=$dir?>/w_upload2.gif border=0> </td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input3> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>

</table>

<table border=0 cellspacing=1 cellpadding=1 width=600>
<tr align=center>
  <td>
      <input type=image src=<?=$dir?>/i_confirm.gif border=0 accesskey="s">
      <a href=javascript:void(history.back())><img src=<?=$dir?>/i_back.gif border=0>
  </td>
</tr>
</table>

</td>
</tr>
</table>
