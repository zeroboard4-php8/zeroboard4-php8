<tr>
<td colspan=10 bgcolor="#FFFAEF"><img src=images/t.gif height=3></td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
 <td></td>
 <td>

<table border=0 cellspacing=1 cellpadding=1 width=100%>
<tr>
 <td width=1% height=20 nowrap> 
  <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0 align=absmiddle></a>
  <?=$a_delete_all?><img src=<?=$dir?>/i_delete.gif border=0 align=absmiddle></a>
  <?=$a_1_prev_page?><img src=<?=$dir?>/i_prev.gif border=0 align=absmiddle></a>  
  <?=$a_1_next_page?><img src=<?=$dir?>/i_next.gif border=0 align=absmiddle></a>
</td>
 <td align=left width=40%>
  <?=$a_write?><img src=<?=$dir?>/i_write.gif border=0 align=absmiddle></a>
  <?=$a_reply?><img src=<?=$dir?>/i_reply.gif border=0 align=absmiddle></a>
 </td>
<tr>
 <td></td>
 <td align=right colspan=2 class=thm8 nowrap>
   <?=$print_page?>
 </td>
</tr>
</tr>
</form>
</table>

 </td>
</tr>
<tr>
 <td>
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=category value="<?=$category?>">
 </td>
 <td>

<table border=0 width=100% cellspcing=0 cellpadding=0>
<tr>
 <td colspan=2 align=right>
    <a href="javascript:OnOff('sn')"><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>
    <a href="javascript:OnOff('ss')"><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>
    <a href="javascript:OnOff('sc')"><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><img src=images/t.gif width=1 height=1>
<input type=text name=keyword value="<?=$keyword?>" <?=size(15)?> class=input style=font-size:8pt;font-family:Arial;vertical-align:top;border-left-color:#eeeeee;border-right-color:#eeeeee;border-top-color:eeeeee;border-bottom-color:eeeeee;height:16px;>&nbsp;<input type=image border=0 align=absmiddle src=<?=$dir?>/images/search_right.gif></a>
 </td>
</form>
</tr>

</form>
</table>
</td></tr></table>
</td></tr></table>
