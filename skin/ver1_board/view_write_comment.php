<form method=post name=write action=comment_ok.php> 
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
                    <td width="100%">
                        <table width="85%" height="100%" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="100%" height="1" background="<?=$dir?>/line.gif">
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" align="center" valign="middle" height="20">
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="36" align="center" valign="middle">
                                    <table align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="2"><textarea name=memo cols=75 rows=3 style='border:solid 1 #EFEFEF;' class=cbg></textarea></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" height=10></td>
                                        </tr>
                                        <tr>
                                            <td align=left><font class="n1">name</font>&nbsp;&nbsp;<?=$c_name?><?=$hide_c_password_start?>&nbsp;&nbsp;<font class="n1">password</font>&nbsp;&nbsp;<input type=password name=password <?=size(9)?> maxlength=200 class=input><?=$hide_c_password_end?></td>
                                            <td align=right><input type=submit value='comment OK' class=submit></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="20"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
</form>