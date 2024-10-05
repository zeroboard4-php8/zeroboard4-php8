<br><br><br>
<div align=center>
<table border=0 cellspacing=1 cellpadding=3 width=250 bgcolor=#E7E7E7>
  <tr>
      <td bgcolor=#FFFFFF height=25 class=thm7pt>
           &nbsp;&nbsp;
      </td>
  </tr>
  <tr>
      <td bgcolor=#FFFFFF height=2></td>
  </tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=250>
  <tr>
      <td bgcolor=#FFFFFF height=2></td>
  </tr>
</table>

<table border=0 width=250 cellspacing=1 cellpadding=0>
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

  <tr height=20>
     <td align=center class=list0>
     </td>
  </tr>
<?php if(!$member['no']) { ?> 

  <tr height=60>
     <td align=center class=list0>
         <font class=list_eng><b>비밀번호</b></font> <?=$input_password?>
     </td>
  </tr>

<?php } ?>

  <tr class=list0 height=30>
     <td align=center>
         <input type=submit class=vvom_submit value=" 확인 " border=0 accesskey="s"> <input type=button class=vvom_button value="뒤로" onclick=history.back()>
     </td>
  </tr>
</table>
</form>
<br>
