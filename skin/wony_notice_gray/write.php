<SCRIPT LANGUAGE="JavaScript"><!--function formresize(mode) {        if (mode == 0) {                document.write.memo.cols  = 80;                document.write.memo.rows  = 20; }        if (mode == 1) {                document.write.memo.cols += 5; }        if (mode == 2) {                document.write.memo.rows += 3; }}// --></SCRIPT><br><?php  if($mode=="reply") $title="<span class=n><b>reply mode</b></span><span class=n7_2></span>";  elseif($mode=="modify") $title="<span class=n><b>modify mode</b></span><span class=n7_2></span>";  else $title="<span class=n><b>.:.+.:.글쓰기.:.+.:.</b></span><span class=n7_2></span>";?>
<table border=0 cellspacing=2 cellpadding=0><tr>
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
<td colspan=2><br><br><?=$title?><br><br><br></td></tr><?=$hide_start?>
<tr>  
  <td width=80 align=right class=n><span class=n7_2></span><b>이름&nbsp;</b></td>  
  <td> <input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=15 class=input></td>
</tr>
<tr>
  <td align=right class=n><span class=n7_2></span><b>비밀번호&nbsp;</b></td>
　<td> <input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>
  <td align=right class=n><b>메일주소&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td align=right class=n><span class=n7_2></span><b>홈페이지&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>
<tr>  
<td colspan=2 align=right>
<table border=0 cellpadding=0 cellspacing=0><tr><td class=n align=right>
<?=$hide_notice_start?>
<?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>html사용<?=$hide_html_end?>
<input type=checkbox name=reply_mail <?=$reply_mail?> value=1>답글메일로받기
<?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>secret<?=$hide_secret_end?>
<?=$hide_category_start?>&nbsp;<?=$category_kind?>&nbsp;&nbsp;<?=$hide_category_end?>
</td></tr></table>  
</td></tr>

<tr>
  <td align=right class=n><span class=n7_2></span><b>제목&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td align=right class=n><span class=n7_2></span><b>내용&nbsp;</b></td>
  <td valign=top> <textarea name=memo <?=size2(39)?> rows=7 class=textarea><?=$memo?></textarea></td>
</tr>
<tr>
<td colspan=2 align=right> 
<input type=submit value=".+:올리기:+." class=submit onfocus=blur()> <input type=button value=".+:취소:+." onclick=history.go(-1) class=submit onfocus=blur()></td>
</tr></table><br><br>