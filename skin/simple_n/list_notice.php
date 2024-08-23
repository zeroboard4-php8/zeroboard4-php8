<!-- 목록 부분 시작 -->

<tr align=center onMouseOver=this.style.backgroundColor="fafafa" onMouseOut=this.style.backgroundColor="">
  <td width=1 height=30></td>
  <td height=20 width=40><img src=<?=$dir?>/image/notice.gif border=0></td>

<?=$hide_cart_start?>
  <td width=30 align=center><input type=checkbox name=cart value="<?=$data['no']?>"></td>
<?=$hide_cart_end?>



   <td align=left>&nbsp;<?=$insert?><?=$icon?><?=$subject?><font class=yeinsfont>&nbsp;&nbsp;<?=$comment_num?></font></td>

   <td style='word-break:break-all;'><img src=images/t.gif height=3><br><?=$face_image?> <?=$name?></div></td>
  <td class=yeinsfont><?=$reg_date?></td>

  <td class=yeinsfont><?=$hit?></td>

  <td width=1 height=20></td>

</tr>
<tr>
  <td height=1 colspan=9 bgcolor=f2f2f2><img src=<?=$dir?>/image/dot.gif border=0 height=1></td>
</tr>
