<form method=post name=delete action=<?=$target?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<table width=300 cellspacing=0 cellpadding=0 border=0>
<tr>
   <td align=center>
      <table width=250 cellspacing=0 cellpadding=0 border=0>
      <tr>
         <td class=line-1></td>
      </tr>
      <tr>
         <td height=20 bgcolor=#F5F5F5 align=center><b>비밀번호 확인</b></td>
      </tr>
      <tr>
         <td class=line-1></td>
      </tr>
      <tr>
         <td height=5></td>
      </tr>
      <tr>
         <td align=center><?=$title?></td>
      </tr>
      <tr>
         <td height=20></td>
      </tr>
      <tr>
         <td align=center><?=$input_password?></td>
      </tr>
      <tr>
         <td height=10></td>
      </tr>
      <tr>
         <td align=center>
         <input type=submit value=' 확인 ' style=width:45px class=submit onfocus=blur() style='background-color:#f5f5f5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type=button value=' 취소 ' onclick='history.go(-1)' style=width:45px class=submit onfocus=blur() style='background-color:#f5f5f5'>
         </td>
      </tr>
      <tr>
         <td height=10></td>
      </tr>
      <tr>
         <td class=line-1></td>
      </tr>
      </table>
   </td>
</tr>
</table>
</form>
