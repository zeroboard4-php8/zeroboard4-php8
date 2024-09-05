<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=100%  colspan=10>
<table border=0  cellspacing=0 cellpadding=0 width=100%>
<tr><td  width=100% align=left valign=bottom padding-left:20; border-bottom-width:4;>
&nbsp;&nbsp;
</td><td aligh=right valign=bottom  style='word-break:break-all; padding-bottom:0px;padding-right:10px;' nowrap>
    <font class=list_eng2><?=$a_setup?>SETUP</a></font></td>
<?=$hide_category_start?><td align=right valign=bottom width=200><img src=<?=$dir?>/trans.gif height=3><?=$a_category?>&nbsp;&nbsp;</td>
<?=$hide_category_end?></tr></table></td></tr>
<tr>
   <td height=5 width=100%  colspan=10>
   <table border=0  cellspacing=0 cellpadding=0 width=100% height=5><tr><td height=100% width=100% background=<?=$dir?>/line.gif ><img src=<?=$dir?>/line_left_icon.gif border=0 height=5></td>    <td background=<?=$dir?>/line.gif align=right ><img src=<?=$dir?>/line_right_icon.gif border=0 height=5></td></tr></table>
   </td>
</tr>
</table>
<?php $coloring=0;?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<col width=10></col><col width=20></col><col width=></col><col width=80></col><col width=40></col><col width=20></col><col width=10></col>

