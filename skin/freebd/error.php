<br><br><br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="315" height="167" background="<?=$dir?>/img/error.gif">
    <tr height="167">
        <td width="315" height="167">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="149" height="78">
                        <p>&nbsp;</p>
                    </td>
                    <td width="149" height="78">
                    </td>
                </tr>
                <tr>
                    <td align='center' width="298" height="30" colspan="2"><font color=red>&nbsp;&nbsp;<?php echo $message;?></font></td>
                </tr>
                  <tr><td width="298" height="23" colspan="2"><div align=center></tr>
<table border=0 cellspacing=0 cellpadding=0 width=300>
  <td align=right valign=bottom><?php  if(!$url)  {  ?><img onclick=history.back() border=0 src=<?=$dir?>/img/b_back.gif onfocus=blur()><?php  }  else  {  ?><img src=<?=$dir?>/img/b_back.gif border=0 onfocus=blur() onclick=location.href="<?php echo $url;?>"><?php  }?></td>
        </table><br></table>