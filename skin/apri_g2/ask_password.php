<br><br><br>

<table border=0 width=250>
<form method=post name=delete action=<?=$target?>>
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
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
   <td align=center><Br><?=$title?><br></td>
</tr>
<tr height=50>
   <td align=center>
     <?=$input_password?> 
     <br><br>
     <input type=submit value="WRITE" class=submit>　
     <input type=button value="BACK" onclick=history.go(-1) class=submit>
   </td>
</tr>

</table>
</form>

