






<form>
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
                                <td width="250" height="25" align="center" valign="middle"><font color=red><?php echo $message;?></font></td>
                            </tr>
                            <tr>
                                <td width="250" height="30" align="center"><?php
  if(!$url)
  {
?>

<input type=button value="back" onclick=history.go(-1) class=submit>

<?php
  }
  else
  {
?>

<input type=submit value="back" class=submit onclick=location.href="<?php echo $url;?>">

<?php
  }
?></td>
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