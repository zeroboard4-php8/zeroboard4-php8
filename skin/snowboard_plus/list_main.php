<!-- 목록 부분 시작 -->
 <tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
 <tr>
 <td colspan=8 bgcolor=ffffff height=3></td>
</tr>
<tr align=center height="20" bgcolor=f7f7f7 onMouseOver=this.style.backgroundColor='#ffffff' onMouseOut=this.style.backgroundColor=''>
  <td class=t7_gray><?=$number?></td>
<?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
<?=$hide_category_start?><td><?=$category_name?></td><?=$hide_category_end?>
  <td align=left style='word-break:break-all;'>&nbsp; <?=$insert?><?=$icon?><?=$subject?> <font color=gray style=font-family:Tahoma;font-size:6pt;font-weight:bold;letter-spacing:-1px;'><?=$comment_num?></font></td> 
  <td style='word-break:break-all;'><?=$face_image?> <?=$name?></div></td>
  <td class=t7_gray><?=$reg_date?></td>
  <td class=t7_gray>&nbsp;<?=$hit?></td>
</tr>
