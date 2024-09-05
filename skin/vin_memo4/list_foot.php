<table width=<?=$width?> border=0 cellspacing=0 cellpadding=0>
<tr>
   <td colspan=2 height=5></td>
</tr>
<tr>
   <td class=line-3 colspan=2></td>
</tr>
<tr>
   <td align=left style='padding-left:5px;' class=th8-n  style='word-break:break-all'>
      <?=$a_prev_page?><img src=<?=$dir?>/img/prevpage.gif width=29 height=9  border=0 align=absmiddle></a>
      <?=$print_page?>
      <?=$a_next_page?><img src=<?=$dir?>/img/nextpage.gif width=29 height=9  border=0 align=absmiddle></a>
   </td>
   <td width=150 align=right>
      <a href=javascript:toggle(link1) onfocus=blur()><img src=<?=$dir?>/img/search.gif width=41 height=9  border=0 align=absmiddle></a>
   </td>
</tr>
</table>
   </td>
</tr>
<tr>
   <td height=5></td>
</tr>
</form>
</table>
<script language="JavaScript">
function toggle(e) {
	if (e.style.display == "none")
		{ e.style.display = ""; }
	else 	{ e.style.display = "none"; }
	}
</script>
<div id="link1" style="width:10px; z-index:1; border:0px solid #000000; background-color:; layer-background-color:; margin:0px; display: none;"> 
<!-- 검색할때 사용하는 폼 -->
<table width=250 border=0 cellspacing=0 cellpadding=0>
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">
<tr>
   <td align=right><input type=text name=keyword value="<?=$keyword?>" style="background-color:#f8f8f8; width:150px" class=input-search></td>
   <td align=center width=54 bgcolor="#F5F5F5"><input type=image border=0 align=absmiddle src=<?=$dir?>/img/search-1.gif></td>
</tr>
</form>
</table></div>
