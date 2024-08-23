<?php 
$c_date="<span title='".date("a.g:i:s", $c_data['reg_date'])."'>".date("m-d", $c_data['reg_date'])."</span>"; 
?>
                <tr>
                    <td width="100%">
                        <table width="85%" height="100%" align="center" cellpadding="0" cellspacing="0">

                            <tr>
                                <td width="100%" height="1" background="<?=$dir?>/line.gif">
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="27" align="left" valign="middle"><font class=n2>comment by</font> <font class=n3><?=$c_face_image?><?=$comment_name?></font></font>&nbsp;<font class=n5><?=$c_date?>&nbsp;&nbsp;<?=$a_del?>d</a></td>
                            </tr>
                            <tr>
                                <td width="100%" height="1" background="<?=$dir?>/line.gif"></td>
                            </tr>
                            <tr>
                                <td width="100%" align="left" valign="top" height="10"></td>
                            </tr>
                            <tr>
                                <td width="100%" height="9" align="left" valign="top">
<?=nl2br($c_memo)?>
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="10">
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>