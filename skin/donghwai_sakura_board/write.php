<table border="0" cellpadding="0" cellspacing="0" height="38" align="center" width=500>
<tr><form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
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
<input type=hidden name=mode value="<?=$mode?>"><td width="113" align="left" background="<?=$dir?>/sakura01.gif" height="38" valign="bottom">
<img src="<?=$dir?>/t.gif" width="113" height="1" border="0"><br></td>
<td height="38" width=<?=$width?>></td>
<td width="105" height="38" style="padding-bottom:3px;" background="<?=$dir?>/sakura02.gif" valign="bottom"><img src="<?=$dir?>/t.gif" width="105" height="1" border="0"><br></td></tr></table>

<table border="0" width="500" cellpadding="0" cellspacing="0" height="5" align="center">
<tr><td width="122" background="<?=$dir?>/sakura03.gif" height="5">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="105" height="5" background="<?=$dir?>/sakura04.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" width="500" height="24" align="center">
<tr><td height="24" align="left" valign="middle" style="background-image:url('<?=$dir?>/sakura05.gif'); background-repeat:no-repeat; background-attachment:fixed; background-position:0px 0px;">
<span class=v91><b>&nbsp;&nbsp;&nbsp;<?=$title?></b></span></td>
<td width="105" height="24" align="center" valign="middle" background="<?=$dir?>/sakura06.gif"></td></tr></table>

<table border="0" width="500" cellpadding="0" cellspacing="0" height="5" align="center">
<tr><td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td>
<td width="86" height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif" width="19"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td></tr></table>
<?=$hide_start?>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*name</b></span></td>
<td height="25" valign="middle"><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*password</b></span></td>
<td height="25" valign="middle"><input type=password name=password <?=size(20)?> maxlength=20 class=input></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*email</b></span></td>
<td height="25" valign="middle"><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*homepage</b></span></td>
<td height="25" valign="middle"><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td></tr></table>
<?=$hide_end?>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*select</b></span></td>
<td height="25" valign="middle"><span class=v82><?=$category_kind?>  <?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1> html <?=$hide_html_end?><?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> notice <?=$hide_notice_end?><?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1> secret <?=$hide_secret_end?><input type=checkbox name=reply_mail <?=$reply_mail?> value=1> reply mail</span></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*subject</b></span></td>
<td height="25" valign="middle"><input type=text name=subject value="<?=$subject?>" <?=size(66)?> maxlength=200 class=input></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*memo</b></span></td>
<td height="25" valign="middle"><textarea name=memo <?=size2(64)?> rows=10 class=textarea><?=$memo?></textarea></td></tr></table>
<?=$hide_sitelink1_start?>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*link1</b></span></td>
<td height="25" valign="middle"><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(66)?> maxlength=200 class=input></td></tr></table>
<?=$hide_sitelink1_end?><?=$hide_sitelink2_start?>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*link2</b></span></td>
<td height="25" valign="middle"><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(66)?> maxlength=200 class=input></td></tr></table>
<?=$hide_sitelink2_end?><?=$hide_pds_start?>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr align="center"><td width="491" height="25" valign="middle" style="padding-right:6px;">
<span class=v82>MAXIMUM FILE SIZE : <?=$upload_limit?></span></td></tr></table>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*file1</b></span></td>
<td height="25" valign="middle"><input type=file name=file1 <?=size(51)?> maxlength=255 class=input> <?=$file_name1?></td></tr></table>
<table border="0" cellpadding="3" cellspacing="0" width="500" align="center">
<tr><td width="80" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v82><b>*file2</b></span></td>
<td height="25" valign="middle"><input type=file name=file2 <?=size(51)?> maxlength=255 class=input> <?=$file_name2?></td></tr></table>
<?=$hide_pds_end?>

<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=500>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" align="center" width=500>
<tr><td valign="top"><?=$a_preview?>［미리보기］</a>
<?=$a_imagebox?>［그림창고］</a></td>
<td align="right">
<input type=submit value="WRITE" class=submit>
<input type=button value="BACK" class=submit onclick=history.back()></td></tr></table>