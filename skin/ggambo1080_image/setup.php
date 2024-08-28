<?php
@zb_query("update zetyx_admin_table  set only_board='1'  where name='$id'"); 
@zb_query("update zetyx_admin_table  set use_pds='1'  where name='$id'"); 
@zb_query("update zetyx_admin_table  set use_homelink='1'  where name='$id'"); 
@zb_query("update zetyx_admin_table  set use_filelink='1'  where name='$id'"); 
?>
<?php
if(!eregi("Zeroboard",$a_login)) $a_login= str_replace(">","><font class=list_han>",$a_login)."&nbsp;";
if(!eregi("Zeroboard",$a_logout)) $a_logout= str_replace(">","><font class=list_han>",$a_logout)."&nbsp;";
if(!eregi("Zeroboard",$a_setup)) $a_setup= str_replace(">","><font class=list_han>",$a_setup)."&nbsp;";
if(!eregi("Zeroboard",$a_member_join)) $a_member_join= str_replace(">","><font class=list_han>",$a_member_join)."&nbsp;";
if(!eregi("Zeroboard",$a_member_modify)) $a_member_modify= str_replace(">","><font class=list_han>",$a_member_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_member_memo)) $a_member_memo= str_replace(">","><font class=list_han>",$a_member_memo)."&nbsp;";
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td align=right valign=bottom  style='word-break:break-all;padding:0 10 3 0;' nowrap width=100%>
<?=$a_setup?>설정</a></td>
<?=$hide_category_start?><td align=right valign=bottom><img src=<?=$dir?>/trans.gif height=3><?=$a_category?>&nbsp;&nbsp;</td>
<?=$hide_category_end?>
</tr>
</table>
