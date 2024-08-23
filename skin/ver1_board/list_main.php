                <tr>
                    <td width="100%" height="27">
                        <table width="99%" align="center" cellpadding="0" cellspacing="0" height="100%">
                            <tr>
                                <td width="30" align="center" valign="middle" class=n4><?=$number?></td>
                                <td width="50" align="center" valign="middle" class=n4><font face="Tahoma" color="white"><span style="font-size:7pt; background-color:00bcc7;">&nbsp;<?=$date=date("y.m.d",$data['reg_date'])?>&nbsp;</span></font></td>
                                <td align="left" valign="middle" width="10"></td>
                                <td align="left" valign="middle"><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>
<font class=n3><?=$face_image?><?=$name?></nobr></font>&nbsp;&nbsp;<?=$subject?>&nbsp;&nbsp;
<?php
$comment_num="".$data['total_comment']."";
if($data['total_comment']==0) {
  $comment_num="";
}
echo "<font class=n5>$comment_num</font>";
?>
</td>
                                <td width="30" align="center" valign="middle" class=n4><?=$hit?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="100%" height="1" background="<?=$dir?>/line.gif"></td>
                </tr>