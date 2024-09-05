<table border="0" cellpadding="3" cellspacing="0" align="center" width=<?=$width?>></form><tr>
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
<td valign="top"><span class=v91><img align="absmiddle" src="<?=$dir?>/img_1.gif" width="17" height="18" border="0"><?=$a_list?>리스트</a> &nbsp;<?=$a_write?>글쓰기</a> &nbsp;<?=$a_delete_all?>삭제</a></span></td>
<td align="right"><span class=v71><img align="absmiddle" src="<?=$dir?>/img_2.gif" width="17" height="18" border="0"> <?=$print_page?><br><img src="t.gif" width="5" height="5" border="0"><br>
<a href="javascript:OnOff('sn')" onfocus="blur()"><img src="<?=$dir?>/name_<?=$sn?>.gif" align="absmiddle" border="0" name="sn"></a>
<a href="javascript:OnOff('ss')" onfocus="blur()"><img src="<?=$dir?>/subject_<?=$ss?>.gif" align="absmiddle" border="0" name="ss"></a>
<a href="javascript:OnOff('sc')" onfocus="blur()"><img src="<?=$dir?>/content_<?=$sc?>.gif" align="absmiddle" border="0" name="sc"></a>
<input type="text" name="keyword" value="<?=$keyword?>" align="absmiddle" class="search" size="20"><input type="image" src="<?=$dir?>/search.gif" align="absmiddle" width="29" height="16" border="0"></td></tr></form></table>