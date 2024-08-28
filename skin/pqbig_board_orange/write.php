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
<?php
/*
  write.php 는 글쓰기 폼입니다.
  아래 변수를 사용합니다.

  회원일때 나타나지 않는 부분을 처리하는 부분입니다. 감싸주면 회원일때는 나타나지 않습니다.
  <?=$hide_start?> : 회원일때 글쓰기등을 나타나지 않게 하는 부분입니다;; 회원일때는 자동 주석!--)이 들어갑니다.  
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
<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
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
<tr>
  <td><img src=images/t.gif width=1 height=1></td>
</tr>
</table>
 
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
  <col width=80 align=right style=padding-right:10px;height:28px class=list1></col>
  <col class=list0 style=padding-left:10px;height:28px width=></col>
  <tr class=pqbig-ver7> 
    <td colspan=2 class=pqbig-lh align=left>&nbsp;&nbsp;&nbsp;<img src="<?=$dir?>/title.gif" border=0 align=absmiddle></td>
  </tr>
  <?=$hide_start?>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7><b>Name</b></font></td>
    <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=pqbig-inputtext></td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7><b>Password</b></font></td>
    <td><input type=password name=password <?=size(20)?> maxlength=20 class=pqbig-inputtext></td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>E-mail</font></td>
    <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=pqbig-inputtext></td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Homepage</font></td>
    <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=pqbig-inputtext></td>
  </tr>
  <?=$hide_end?>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Option</font></td>
    <td class=pqbig-ver7> 
      <?=$category_kind?>
      <?=$hide_notice_start?>
      <input type=checkbox name=notice <?=$notice?> value=1>
      notice 
      <?=$hide_notice_end?>
      &nbsp; 
      <?=$hide_html_start?>
      <input type=checkbox name=use_html <?=$use_html?> value=1>
      HTML 
      <?=$hide_html_end?>
      &nbsp; <input type=checkbox name=reply_mail <?=$reply_mail?> value=1>
      reply e-mail &nbsp; 
      <?=$hide_secret_start?>
      <input type=checkbox name=is_secret <?=$secret?> value=1>
      secret 
      <?=$hide_secret_end?>
    </td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8" valign="middle"><font class=pqbig-ver7><b>Subject</b></font></td>
    <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=pqbig-inputtext></td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7><b>Memo</b></font> </td>
    <td style=padding-top:8px;padding-bottom:8px;><textarea name=memo <?=size2(90)?> rows=15 class=pqbig-memo style=width:99%;><?=$memo?></textarea></td>
  </tr>
  <?=$hide_sitelink1_start?>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Link #1</font></td>
    <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=pqbig-inputtext style=width:99%></td>
  </tr>
  <?=$hide_sitelink1_end?>
  <?=$hide_sitelink2_start?>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Link #2</font></td>
    <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=pqbig-inputtext style=width:99%></td>
  </tr>
  <?=$hide_sitelink2_end?>
  <?=$hide_pds_start?>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Upload #1</font></td>
    <td class=pqbig-ver7><input type=file name=file1 <?=size(50)?> maxlength=255 class=pqbig-inputtext style=width:99%> 
      <?=$file_name1?>
    </td>
  </tr>
  <tr> 
    <td bgcolor="#F8F8F8"><font class=pqbig-ver7>Upload #2</font></td>
    <td class=pqbig-ver7><input type=file name=file2 <?=size(50)?> maxlength=255 class=pqbig-inputtext style=width:99%> 
      <?=$file_name2?>
    </td>
  </tr>
  <?=$hide_pds_end?>
  <tr align="right" valign="bottom"> 
    <td height="25" colspan="2"> 
      <input name="submit" type=submit class=pqbig-submit style=cursor:hand accesskey="s" onfocus='this.blur()' value="write"> 
      <input name="button" type=button class=pqbig-submit style=cursor:hand onfocus='this.blur()' onclick=history.back() value="cancel"> 
    </td>
  </tr>
</table>

