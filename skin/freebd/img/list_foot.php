<table border="0" cellpadding="0" cellspacing="0" width="100%" height="72">
    <tr height="72">
        <td width="31">
            <p>&nbsp;</p>
        </td>
        <td width="9">            <p align="right"><img src="<?=$dir?>/img/foot_left.gif" width="23" height="72" border="0"></p>
        </td>
        <td width="92%" height="72" background="<?=$dir?>/img/foot_bg.gif"><table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=25>
<tr>
  <td width=49%>
    <?=$a_list?><img src="<?=$dir?>/img/list_btn.gif" width="53" height="20" border=0>
        <?=$a_delete_all?><img src="<?=$dir?>/img/del_btn.gif" width="79" height="21" border=0></td>
  <td align=center nowrap class=thm8>
<!-- 페이지 출력 ---------------------->
    <?=$a_prev_page?><img src="<?=$dir?>/img/back_btn.gif" width="12" height="18" border="0"> <?=$print_page?> <?=$a_next_page?><img src="<?=$dir?>/img/next_btn.gif" width="12" height="18" border="0">
  </td>
  <td align=right width=49%>
<p align="right"><?=$a_write?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$dir?>/img/write_btn.gif" width="70" height="23" border=0>
  </td>
</tr>
</form></table>


<table border=0 cellspacing=0 cellpadding=0 align=center>
<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">
  <tr>
<!----- 검색창 ----->
    <td colspan=3 align=center>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 width=32 height=11 name=sn></a><img width=10 height=1><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 width=50 height=11 name=ss></a><img width=10 height=1><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 width=56 height=11 name=sc></a><img width=20 height=1></td>
  </tr>
  <tr>
    <td><input type=text name=keyword value="<?=$keyword?>" <?=size(20)?> class=search></td>
    <td width=57><input type=image src=<?=$dir?>/images/search.gif onfocus=blur() style='width:57;height:19'></td>
        <td width=45><?=$a_cancel?><img src=<?=$dir?>/images/search_no.gif width=45 height=19 border=0></td>
  </tr>
</form>
</table></td>
        <td width="14">            <p><img src="<?=$dir?>/img/foot_right.gif" width="14" height="72" border="0"></p>
        </td>
        <td width="27">
            <p>&nbsp;</p>
        </td>
    </tr>
</table>
