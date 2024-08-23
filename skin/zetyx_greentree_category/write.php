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
?>
<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=600>
<tr align=center>
  <td background=<?=$dir?>/images/lh_bg.gif><img src=images/t.gif height=15></td>
  </tr>
</table>
<?php
  if($mode=="reply") $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Post a </font> <span style=font-size:15px;letter-spacing:-1px;>Reply</span></span>";
  elseif($mode=="modify") $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Modify</font> <span style=font-size:15px;letter-spacing:-1px;>Article</span></span>";
  else $title="<span style=font-family:Arial;font-size:8pt;font-weight:bold;><font color=#333333>Post a </font> <span style=font-size:15px;letter-spacing:-1px;>New Article</span></span>";
?>
<table border=0 cellspacing=1 cellpadding=0 width=600>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<?=$title?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
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
 
<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor=<?=$sC_light1?>>

<?=$hide_start?>
<tr height=25>
 <td colspan=2>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td width=80 align=right class=thm8><b>Name&nbsp;</b></td>
  <td>
  <img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input>
  </td>
  <td width=80 align=right class=thm8><b>Password&nbsp;</b></td>
  <td>
  <input type=password name=password <?=size(20)?> maxlength=20 class=input>
  </td>
</tr>
</table>
</td></tr>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>Homepage&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr height=25>
  <td align=right class=thm8 width=80><b>Special&nbsp;</b></td>
  <td> 
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
  <td> 
<?=$category_kind?> 
  </td>
  <td>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1></td><td class=thm8>&nbsp;Notice &nbsp;&nbsp;<?=$hide_notice_end?></td>
  <td>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=thm8>&nbsp;Use HTML &nbsp;&nbsp;<?=$hide_html_end?></td>
  <td>     <input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=thm8>&nbsp;Reply Mail &nbsp;&nbsp;</td>  
  <td>    <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1></td><td class=thm8>&nbsp;Secret &nbsp;&nbsp;<?=$hide_secret_end?></td>
  </tr>
  </table>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=thm8><b>Contents&nbsp;</b></td>
  <td valign=top>
  <textarea name=memo <?=size2(80)?> rows=20 class=textarea><?=$memo?></textarea>
  </td>
</tr>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_start?>
<tr height=25>
  <td align=right class=thm8><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink1_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_start?>
<tr height=25>
  <td align=right class=thm8><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink2_end?>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>

<?=$hide_pds_start?>
<tr height=25>
  <td>&nbsp;</td>
  <td class=thm8><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>File #1&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=25>
  <td align=right class=thm8><b>File #2&nbsp;</b></td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
</table>

<table border=0 cellspacing=1 cellpadding=1 width=600>
<tr align=center height=30>
  <td align=right>
      <input type=image border=0 align=absmiddle src=<?=$dir?>/images/btn_confirm.gif>
      <img src=<?=$dir?>/images/btn_back.gif align=absmiddle border=0 style=cursor:hand onclick=history.back()>
  </td>
</tr>
</table>

</td>
</tr>
</table>
