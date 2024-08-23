<table border="0" cellpadding="0" cellspacing="0" width=<?=$width?> height="28">
    <tr height="28">
        <td>
          
        </td>
        <td width="9"><p align="right"><img src="<?=$dir?>/img/foot_left.gif" width="15" height="28" border="0"></p>
        </td>
        <td width="100%" height="28" background="<?=$dir?>/img/foot_bg.gif">
		
		<table border=0 cellpadding=0 cellspacing=0 width=100% height=25>
<tr>
  <td width=50%>
    <?=$a_list?><img src="<?=$dir?>/img/list_btn.gif" width="57" height="24" border=0>
        <?=$a_delete_all?><img src="<?=$dir?>/img/del_btn.gif" width="79" height="24" border=0></td>
  <td align=center nowrap class=thm8>
<!-- 페이지 출력 ---------------------->
    <?=$a_prev_page?><img src="<?=$dir?>/img/back_btn.gif" width="12" height="23" border="0"> <?=$print_page?> <?=$a_next_page?><img src="<?=$dir?>/img/next_btn.gif" width="12" height="23" border="0">
  </td>
  <td align=right width=50%>
<p align="right"><?=$a_write?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$dir?>/img/write_btn.gif" width="71" height="24" border=0>
  </td>
</tr>
</form></table>


</td>
        <td width="14">   <p><img src="<?=$dir?>/img/foot_right.gif" width="15" height="28" border="0"></p>
        </td>
        <td>
            
        </td>
    </tr>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="269" height="47">
    <tr height="47">
        <td width="269" height="47" background="<?=$dir?>/img/search_bg.gif"><table border=0 cellspacing=0 cellpadding=0 align=center>
<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">
  <tr>
<!----- 검색창 ----->
                <td colspan=3 align=center>

                            <p align="center"style="margin-bottom:2%;"><a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 width=32 height=11 name=sn></a><img width=10 height=1><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 width=50 height=11 name=ss></a><img width=10 height=1><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 width=56 height=11 name=sc></a><img width=20 height=1></td>
  </tr>
  <tr>
    <td><input type=text name=keyword value="<?=$keyword?>"style="height:20;width:120;border:0px;background:url(<?=$dir?>/t.gif) repeat-x bottom class=.thm9"></td>
    <td width=60>
                            <p align="center"><input type=image src=<?=$dir?>/img/search.gif onfocus=blur() style='width:48;height:12'></td>
        <td width=60>
                            <p align="center"><?=$a_cancel?><img src=<?=$dir?>/img/cancel.gif width=36 height=6 border=0></td>
  </tr>
<p></table></td>
    </tr>
</table>