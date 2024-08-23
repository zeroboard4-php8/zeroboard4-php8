

<form method=post name=delete action=<?=$target?>>
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
<input type=hidden name=c_no value=<?=$c_no?>>
<table align="center" cellpadding="0" cellspacing="0" width="400" height="200">
    <tr>
        <td width="1221">
            <table align="center" cellpadding="0" cellspacing="0" width="200" height="82">
                <tr>
                    <td width="250" height="1" background="<?=$dir?>/line.gif"></td>
                </tr>
<tr><td height="10"></td></tr>
                <tr>
                    <td width="250" height="80" align="center" valign="middle">
                        <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
                            <tr>
                                <td width="250" height="50" align="center" valign="middle"><?=$title?></td>
                            </tr>
                            <tr>
                                <td width="250" height="25" class=n1 align="center" valign="middle"><?=$input_password?></td>
                            </tr>
                            <tr>
                                <td width="250" height="30" align="center"><input type=submit value="yes" class=submit>
<input type=button value="back" onclick=history.go(-1) class=submit></td>
                            </tr>
                        </table>
</td>
                </tr>
<tr><td height="10"></td></tr>
                <tr>
                    <td width="250" height="1" background="<?=$dir?>/line.gif"></td>
                </tr>
            </table>
</td>
    </tr>
</table>
</form>