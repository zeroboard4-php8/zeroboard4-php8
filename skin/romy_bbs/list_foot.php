</table>
</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td align=left style="padding-top:7;" class=thm6><font face="Nanum Myeongjo"><font family="Nanum Myeongjo">
<?=$a_list?>L</a>&nbsp;&nbsp;<?=$a_write?>W</a>&nbsp;&nbsp;<?=$a_delete_all?>D</a>
</td>
 <td align=right style="padding-top:5;" valign=top class=thm6>
<?=$a_1_prev_page?><</a> <?=$print_page?> <?=$a_1_next_page?>></a></td>
</tr>
</form>
</table>


<table border=0 cellspcing=0 cellpadding=0 width=<?=$width?>>
<tr><td>
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
</td></tr>

<tr>
<td align=right class=ver7>
<input type=text name=keyword value="<?=$keyword?>" style="width:120;height:18;" class=input2>
</td>
</tr>
</table>