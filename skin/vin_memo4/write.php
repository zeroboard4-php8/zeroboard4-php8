<table width=<?=$width?> height="18" cellspacing=0 cellpadding=0 border=0>
<tr>
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value=<?=$sn?>>
<input type=hidden name=ss value=<?=$ss?>>
<input type=hidden name=sc value=<?=$sc?>>
<input type=hidden name=mode value="<?=$mode?>">
   <?=$hide_start?><td class=th8-n>ID&nbsp;</td><td><input type=text name=name value="<?=$name?>" maxlength=30 class=input style='background-color:#f8f8f8; width:50px; height:18px;'></td>
   <td class=th8-n>&nbsp;PW&nbsp;</td>
   <td><input type=password name=password style='background-color:#f8f8f8; width:50px; height:18px;' maxlength=10 class=input></td><?=$hide_end?>
   <td align=center width=95% nowrap><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>공지<?=$hide_notice_end?>&nbsp;<input type=text name=memo value="<?=$memo?>" maxlength=50 class=input style='background-color:#f8f8f8; width:100%; height:18px;'></td>
   <td valing=center><input type=submit value=" 확인 " class=submit style='padding-top:1px; background-color:#f6f6f6; height:18px;' accesskey="s"></td>
   <td><textarea name=subject style='width:0px; height:0px' class=textarea rows="1">^^</textarea></td>
</form>
</tr>
</table>
