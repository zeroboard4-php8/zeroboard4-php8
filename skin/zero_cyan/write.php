<?php
 if ($mode=="reply") $write_str="답변 글 쓰기";
 elseif($mode=="modify") $write_str="글 수정하기";
 else $write_str="신규 글 쓰기";
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
 <td><img src=<?=$dir?>/list_left.gif border=0></td>
 <td align=center background=<?=$dir?>/list_back.gif width=100%><font color=888888><?=$write_str?></td>
 <td><img src=<?=$dir?>/list_right.gif border=0></td>
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
  <td align=right>비밀번호</td>
  <td> <input type=password name=password <?=size(20)?> maxlength=20 class=input> </td>
</tr>

<tr>
  <td width=80 align=right>이 름</td> 
  <td> <input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input> </td>
</tr>

<tr>
  <td align=right>E-Mail </td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>

<tr>
  <td align=right>Homepage </td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input> </td>
</tr>

<?=$hide_end?>

<tr>
  <td align=right width=80>기능선택 </td>
  <td style=font-family:tahoma;font-size:8pt>
       <font color=aaaaaa>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML사용 <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
  </td>
</tr>

<tr>
  <td align=right> 제 목 </td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>

<tr>
  <td colspan=2 align=center><textarea name=memo <?=size2(90)?> rows=24 class=textarea><?=$memo?></textarea></td>
</tr>


<?=$hide_sitelink1_start?>
<tr>
  <td align=right> 링크 #1 </td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink1_end?>


<?=$hide_sitelink2_start?>
<tr>
  <td align=right>  링크 #2 </td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input> </td>
</tr>
<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td >업로드는 <?=$upload_limit?> 까지 올릴수있습니다</td>
</tr>
<tr>
  <td align=right> 업로드 #1 </td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input> <?=$file_name1?></td>
</tr>
<tr>
  <td align=right> 업로드 #2 </td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>

</table>

<br>

<table border=0 cellspacing=1 cellpadding=1 width=600>
<tr align=center>
  <td>
      <input type=image src=<?=$dir?>/btn_ok.gif border=0 onfocus=blur() accesskey="s">
      <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a>
  </td>
</tr>
</table>

</td>
</tr>
</table>
