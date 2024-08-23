</form>
                <tr>
                    <td width="100%" height="27">
                        <table width="99%" height="100%" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="50%" height="100%" valign="middle" align="left" class=n1>
<?=$a_list?>list</a>&nbsp;&nbsp;
<?=$a_write?>write</a>
<?=$a_delete_all?>&nbsp;&nbsp;delete</a>
<?=$a_setup?>*</a></td>
                                <td width="50%" height="100%" valign="middle" align="right" class=n4>
<?=$a_prev_page?>prev&nbsp;&nbsp;</a><font class=n4><?=$print_page?></font><?=$a_next_page?>&nbsp;&nbsp;next</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>

<!-- 검색태그 부분 -->
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected><input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">

<td width="100%" height="27">
<table width="99%" height="100%" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="100%" height="100%" valign="middle" align="right">
<input type=text class=input name=keyword value="<?=$keyword?>" <?=size(20)?>><input type=image border=0 align=absmiddle src=<?=$dir?>/search.gif onfocus=blur()>
</td></form>
                            </tr>
                        </table>					
					</td>
                </tr>
            </table>
        </td>
    </tr>
</table>