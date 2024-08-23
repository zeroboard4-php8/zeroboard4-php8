</td>
</tr>

<tr>
 <td>
<!-- 버튼 부분 -->
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
	<td colspan=2 height=5></td>
</tr>
 <tr>
    <td colspan=2 height=1 border=0 width=1 height=1 class=line></td>
  </tr>
<tr>
	<td colspan=2 height=5></td>
</tr>
<tr>
   <td width=20% align=left nowrap class=list-foot-h>
   <?=$a_write?>write</a>
<?=$a_list?>list</a>
<?=$a_delete_all?>delete</a>
  </td>
  <td width=80% align=right nowrap class=list-foot-h>
    <?=$a_prev_page?>prev</a> <?=$print_page?> <?=$a_next_page?>next</a> </td>
  </td>
</tr>
</form>
</table>

 </td>
</tr>
<tr>
<!-- 검색테그 부분입니다. ---------------------->
<!-- 검색시 이름 내용 제목 다 검사하게 소스가 수정 되어있습니다 -->
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
<!-- 검색창 나오는곳 입니다 -->
</td>
<td align=center>
 <table border=0 width=100% cellspcing=0 cellpadding=0>
   <tr>
     <td align=right valign=middle><input type=text name=keyword value="<?=$keyword?>" style="width:247px; height:100%" class="input-search"></td>
</form>
</tr>
</table>
</td>
</tr>
</form>
</table>
</td>
</tr>
</table>