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
</td>
 <td align=right>
<img src=images/t.gif border=0 height=10><br>
<table border=0 cellpadding=10 cellspacing=1 bgcolor=ffffff>
<tr><td bgcolor=#ffffff>
<table border=0 cellspacing=0 cellpadding=0>
<tr><td height=10></td></tr></table>
<table border=0 cellspacing=0 cellpadding=0>
<tr><td colspan=2 align=right><textarea name=memo style="border-width:1; border-color:eeeeee; border-style:solid; width:300;height:50;" class=co></textarea></td></tr>
<tr><td class=date>name&nbsp;:&nbsp;<?=$c_name?>&nbsp;<?=$hide_c_password_start?>pass&nbsp;:&nbsp;<input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td><td align=right>
<input type=submit style="font-family:굴림; font-style:normal; color:rgb(98,176,207); background-color:rgb(231,245,252); padding-top:2; border-width:1; border-top-color:rgb(239,250,255); border-right-color:rgb(190,227,241); border-bottom-color:rgb(190,227,241); border-left-color:rgb(239,250,255); border-style:solid;" value=' 글쓰기 ' class=submit>
</td></tr> 
</table><br>
<img src=images/t.gif border=0 height=6><br>
 </td>
</tr>
</form>
</table>