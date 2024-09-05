<table border="0" cellpadding="0" cellspacing="0" height="38" align="center" width=<?=$width?>><tr>
<td width="113" align="left" background="<?=$dir?>/sakura01.gif" height="38" valign="bottom">
<img src="<?=$dir?>/t.gif" width="113" height="1" border="0"><br>
<span class=v9> <font title=회원가입><?=$a_member_join?>*</a> <font title=정보수정><?=$a_member_modify?>*</a> <font title=쪽지함><?=$a_member_memo?>*</a> <font title=로그인><?=$a_login?>*</a> <font title=로그아웃><?=$a_logout?>*</a> <font title=관리자><?=$a_setup?>*</a><?=$memo_on_sound?></span></td>
<td height="38" width=<?=$width?>></td>
<td width="105" height="38" style="padding-bottom:3px;" background="<?=$dir?>/sakura02.gif" valign="bottom"><img src="<?=$dir?>/t.gif" width="105" height="1" border="0"><br></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" height="5" align="center" width=<?=$width?>>
<tr><td width="122" background="<?=$dir?>/sakura03.gif" height="5">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="105" height="5" background="<?=$dir?>/sakura04.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" height="24" align="center" width=<?=$width?>>
<tr><td height="24" align="left" valign="middle" style="background-image:url('<?=$dir?>/sakura05.gif'); background-repeat:no-repeat; background-attachment:fixed; background-position:0px 0px;"><span class=v91><b>&nbsp;&nbsp;&nbsp;<?=$subject?></b></span></td>
<td width="105" height="24" align="center" valign="middle" background="<?=$dir?>/sakura06.gif"><span class=v81>(<?=$reg_date?>)</span></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" height="5" align="center" width=<?=$width?>>
<tr><td width="1" background="<?=$dir?>/sakura03.gif" height="5">
<img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td>
<td width="86" height="5" background="<?=$dir?>/bg1.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif" width="19">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif">
<img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="1" height="5">
<img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td></tr></table>

<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*name</b></span></td>
<td height="25" valign="middle"><span class=v91><?=$name?></span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>

<?=$hide_homepage_start?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*homepage</b></font></span></td>
<td height="25" valign="middle"><span class=v91><?=$homepage?></span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>
<?=$hide_homepage_end?>

<?=$hide_sitelink1_start?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*link1</b></font></span></td>
<td height="25" valign="middle"><span class=v91><?=$sitelink1?></span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*link2</b></span></td>
<td height="25" valign="middle"><span class=v91><?=$sitelink2?></span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>
<?=$hide_sitelink2_end?>

<?=$hide_download1_start?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*download1</b></span></td>
<td height="25" valign="middle"><span class=v91><?=$a_file_link1?><?=$file_name1?></a> (size:<?=$file_size1?>, hit:<?=$file_download1?>)</span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>>
<tr><td width="100" height="25" align="right" valign="middle" style="padding-right:6px;">
<span class=v81><b>*download2</b></span></td>
<td height="25" valign="middle"><span class=v91><?=$a_file_link2?><?=$file_name2?></a> (size:<?=$file_size2?>, hit:<?=$file_download2?>)</span></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>
<?=$hide_download2_end?>

<table border="0" cellpadding="10" cellspacing="0" align="center" width=<?=$width?>>
<tr><td valign="top"><?=$upload_image1?><?=$upload_image2?><?=$memo?><br>
<p align="right"><span class=v71><?=$ip?></span></font></p></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" background="<?=$dir?>/dot.gif" align="center" width=<?=$width?>>
<tr><td height="1"><img src="<?=$dir?>/t.gif" width="1" height="1" border="0"></td></tr></table>