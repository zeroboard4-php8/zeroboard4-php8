
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?>>
<tr>
  <td colspan=2>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
      <tr><td colspan=10 class=kissofgod-listline><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td></tr>
    </table>
  </td>
</tr>
<tr>
 <td width=1>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php enctype=multipart/form-data>
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
 <td align=center>
 
<table border=0 cellspacing=0 cellpadding=0 class=kissofgod-write-stamptable style='margin:15 0'>
<tr>
  <td colspan=2> <?=$title?> </td>
</tr>

<tr>
  <td colspan=2> <?=$category_kind?>
     <?=$hide_html_start?> <input type=hidden name=use_html <?=$use_html?> value=1 checked><?=$hide_html_end?>
     <input type=hidden name=reply_mail <?=$reply_mail?> value=1 checked><input type=hidden name=subject value='방명록입니다' <?=size(34)?> maxlength=200 class=input>
  </td>
</tr>

<?=$hide_start?>
<tr>
  <td style='padding:2'><font class=kissofgod-info-font>Name</font></td>
  <td style='padding:2'><input type=text name=name value="<?=$name?>" <?=size(10)?> maxlength=10 class=input> </td>
</tr>

<tr>
  <td style='padding:2'><font class=kissofgod-info-font>E-mail</font></td>
  <td style='padding:2'><input type=text name=email value="<?=$email?>" <?=size(25)?> maxlength=200 class=input></td>
</tr>

<tr>
  <td style='padding:2 2 10 2'><font class=kissofgod-info-font>Homepage</font></td>
  <td style='padding:2 2 10 2'><input type=text name=homepage value="<?=$homepage?>" <?=size(30)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>

<tr>
  <td><font class=kissofgod-info-font>Comment</font></td>
  <td style='padding:0 0 0 2'><textarea name=memo <?=size2(50)?> rows=7 class=textarea><?=$memo?></textarea></td>

</tr>

<tr>
  <td colspan=2 align=right style='padding:2 0 0 0'>
    <?=$hide_notice_start?>
	<input type=checkbox name=notice <?=$notice?> value=1>공지사항 
	<?=$hide_notice_end?>　
	<?=$hide_start?>
	<font class=kissofgod-info-font>PassWD</font><input type=password name=password <?=size(10)?> maxlength=20 class=input>
	<?=$hide_end?>
	<input type=submit value="Ok~" class=kissofgod-submit>&nbsp;
    <input type=button value="Back" class=kissofgod-submit onclick=history.back()>
</td>
</tr>

</table>

</td>
</tr>
</form>
<tr>
  <td colspan=2>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
      <tr><td colspan=10 class=kissofgod-listline><img src=<?=$dir?>/t.gif border=0 width=1 height=1></td></tr>
    </table>
  </td>
</tr>
</table>
<br>
