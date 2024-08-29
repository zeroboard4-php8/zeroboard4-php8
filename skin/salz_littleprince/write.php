<?php 
 if ($mode=="reply") $write_str="";
 elseif($mode=="modify") $write_str="글 수정하기";
 else $write_str="";
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

<table border=0 cellspacing=0 cellpadding=0 width=450>
<tr>
 <td align=center><br></td>
 <td align=center width=100%><font color=4D4D4D><b><font size=2>Write</font></b><?=$write_str?></td>
 <td></td>
</tr>
<tr><td colspan=8 background=<?php echo $dir?>/dot.gif height=1></td></tr>
</table>
<table border=0 cellspacing=1 cellpadding=0 width=450>
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
  <td align=right><img src=<?=$dir?>/psswd.gif border=0></td>
  <td> <input type=password name=password <?=size(20)?> maxlength=20 class=dot> </td>
</tr>

<tr>
  <td width=80 align=right><img src=<?=$dir?>/name.gif border=0></td> 
  <td> <input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=dot> </td>
</tr>

<tr>
  <td align=right><img src=<?=$dir?>/mail.gif border=0></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=dot> </td>
</tr>

<tr>
  <td align=right><img src=<?=$dir?>/home.gif border=0></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=dot> </td>
</tr>

<?=$hide_end?>

<tr>
  <td align=right width=80><img src=<?=$dir?>/choose.gif border=0></td>
  <td style=font-family:arial;font-size:8pt>
       <font color=#4F3A16>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> Use HTML <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> Receive Mail
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> Secret Message <?=$hide_secret_end?>
  </td>
</tr>

<tr>
  <td align=right><img src=<?=$dir?>/title.gif border=0></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=dot> </td>
</tr>

<tr>
  <td colspan=2 align=center style="filter: Alpha(Opacity=60)"><textarea name=memo <?=size2(90)?> rows=24 class=textarea><?=$memo?></textarea></td>
</tr>


<?=$hide_sitelink1_start?>
<tr>
  <td align=right><img src=<?=$dir?>/links1.gif border=0></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=dot> </td>
</tr>
<?=$hide_sitelink1_end?>


<?=$hide_sitelink2_start?>
<tr>
  <td align=right><img src=<?=$dir?>/links2.gif border=0></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=dot> </td>
</tr>
<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td >The Limit of Upload : <?=$upload_limit?> </td>
</tr>
<tr>
  <td align=right><img src=<?=$dir?>/upload1.gif border=0></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=dot> <?=$file_name1?></td>
</tr>
<tr>
  <td align=right><img src=<?=$dir?>/upload2.gif border=0></td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=dot> <?=$file_name2?></td>
</tr>

<?=$hide_pds_end?>

</table>

<br>

<table border=0 cellspacing=1 cellpadding=1 width=450>
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
