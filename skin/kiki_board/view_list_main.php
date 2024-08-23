<!-- 목록 부분 시작 -->


  <tr align=center onMouseOver=this.style.backgroundColor='#E6E6E6' font color='#000000' onMouseOut=this.style.backgroundColor=''>
    <td class=tver height=21>
      <?=$number?>
    </td>
    <?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>


    <td align=left style='word-break:break-all;' height=21>
     <?=$insert?><?=$icon?><?=$subject?>
      <span style="font-size:7pt;"><font face="Verdana" color="#bbbbbb"><?=$comment_num?></font></span>
    </td>

    <td style='word-break:break-all;' height=21>
      <?=$face_image?> <?=$name?>
    </td>
    <td class=tahoma height=21><?=$reg_date?></td>
    <td class=tahoma height=21><?=$hit?></td>
  </tr>
  <tr>
    <td colspan=10 height=1 background=<?=$dir?>/dot.gif>
    </td>
  </tr>


