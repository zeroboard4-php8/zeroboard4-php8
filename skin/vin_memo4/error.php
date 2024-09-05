<form>
<table width=<?=$width?> cellspacing=0 cellpadding=0 border=0>
<tr>
   <td align=center>
      <table width=250 cellspacing=0 cellpadding=0 border=0>
      <tr>
         <td class=line-1></td>
      </tr>
      <tr>
         <td height=20 bgcolor=#F5F5F5 align=center><b>오류입니다</b></td>
      </tr>
      <tr>
         <td class=line-1></td>
      </tr>
      <tr>
         <td align=center>
<?php 
echo ("<br>".$message."<br>");
if(!$url) {
  echo ("<br><input type=button onclick=history.go(-1) value=' 뒤로 ' class=submit onfocus=blur() style='width:45px; background-color:#f5f5f5'>");
}
else {
  echo ("<br><input type=button onclick=location.href='".$url."' value=' move ' class=submit style=width:45px onfocus=blur()>");
}
?>
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
