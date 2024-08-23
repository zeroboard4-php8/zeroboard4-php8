<style type="text/css">
BODY 
{scrollbar-face-color: #f5f5f5;scrollbar-highlight-color: #ffffff;
scrollbar-3dlight-color: #E1E1E1;scrollbar-shadow-color: #f5f5f5;
scrollbar-darkshadow-color: #E1E1E1;scrollbar-track-color: #ffffff;
scrollbar-arrow-color: #00bcc7}
</style>

<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">&nbsp;&nbsp;<?=$title?>


<table align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="100%" align="center" cellpadding="0" cellspacing="0">
<?=$hide_start?>
                <tr>
                    <td width="100%" height="35" align="center" valign="middle" class=n1>
name&nbsp;<input class=input2 type=text name=name value="<?=$name?>" <?=size(10)?> maxlength=12>&nbsp;pass&nbsp;<input class=input2 type=password name=password value="<?=$password?>" <?=size(10)?> maxlength=12>&nbsp;&nbsp;home&nbsp;<input type=text name=homepage value="<?=$homepage?>" <?=size(20)?> maxlength=180 class=input2>
</td>
                </tr>
<?=$hide_end?>
                <tr>
                    <td width="100%" height="35" align="center" valign="middle" class=n1>subject&nbsp;<input type=text name=subject value="<?=$subject?>" <?=size(54)?> maxlength=180 class=input2></td>
                </tr>
                <tr>
                    <td width="100%" height="35" align="left" valign="middle" class=n1><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>notice&nbsp;&nbsp;<?=$hide_notice_end?>
<?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>html&nbsp;&nbsp;<?=$hide_html_end?>
<?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>secret<?=$hide_secret_end?></td>
                </tr>
                <tr>
                    <td width="100%" align="center" valign="middle"><textarea name=memo <?=size2(60)?> rows=18 class=input3><?=$memo?></textarea></td>
                </tr>
                <tr>
                    <td width="100%" height="5"></td>
                </tr>

<?=$hide_sitelink1_start?>
                <tr>
                    <td width="100%" height="35" align="center" valign="middle" class=n1>site link #1&nbsp;<input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(19)?> maxlength=180 class=input2><?=$hide_sitelink1_end?>&nbsp;&nbsp;<?=$hide_sitelink2_start?>site link #2&nbsp;<input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(19)?> maxlength=180 class=input2></td>
                </tr>
<?=$hide_sitelink2_end?>


<?=$hide_pds_start?>
                <tr>
                    <td width="100%" height="35" align="center" valign="middle" class=n1>file upload #1&nbsp;<input type=file name=file1 <?=size(35)?> maxlength=225 class=input2> <?=$file_name1?></td>
                </tr>
                <tr>
                    <td width="100%" height="35" align="center" valign="middle" class=n1>file upload #1&nbsp;<input type=file name=file2 <?=size(35)?> maxlength=225 class=input2> <?=$file_name2?></td>
                </tr>
<?=$hide_pds_end?>

                <tr>
                    <td width="100%" height="40" align="center" valign="middle"><input type=submit value="write OK" class=submit>&nbsp;<input type=button value="back" onclick=history.go(-1) class=submit></td>
                </tr>
            </table>
        </td>
    </tr>
</table>