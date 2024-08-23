<?php $use_view_list_skin=1; ?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=1>
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
</td><td width=100%>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=11></col><col width=50></col><col width=></col><col width=90></col><col width=70></col><col width=40></col><col width=11></col>
<tr align=center>
<td width=11><img src=<?=$dir?>/list_left.gif width=11 border=0></td>
<td background=<?=$dir?>/list_back.gif width=50><img src=<?=$dir?>/h_no.gif border=0></td>
<td background=<?=$dir?>/list_back.gif width=><img src=<?=$dir?>/h_subject.gif border=0></td>
<td background=<?=$dir?>/list_back.gif width=90><img src=<?=$dir?>/h_writer.gif border=0></td>
<td background=<?=$dir?>/list_back.gif width=70><img src=<?=$dir?>/h_date.gif border=0></td>
<td background=<?=$dir?>/list_back.gif width=40><img src=<?=$dir?>/h_read.gif border=0></td>
<td width=11><img src=<?=$dir?>/list_right.gif width=11 border=0></td>
</tr>
</table>
<img src=images/t.gif height=4><br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=7></col><col width=50></col><col width=></col><col width=90></col><col width=70></col><col width=40></col><col width=6></col>
