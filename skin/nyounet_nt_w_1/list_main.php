        <tr>
          <td width=100% height=1 background=<?=$dir?>/dot.gif></td>
        </tr>
        <tr>
          <td height=4></td>
        </tr>
        <tr>
          <td height=24 class=sub_bg>
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <tr>
                <td width=6 height=24 nowrap></td>
                <?=$hide_cart_start?><td width=15 align=center nowrap><input type=checkbox name=cart value="<?=$data['no']?>" class=checkbox></td><?=$hide_cart_end?>
                <td width=11 nowrap><img src=<?=$dir?>/head.gif width=7 height=7 border=0></td>
                <td width=100% style='word-break:break-all'><img src=<?=$dir?>/t.gif border=0 width=1 height=2><br><?=$hide_category_start?>[<?=$category_name?>]<?=$hide_category_end?> <font style=font-weight:bold><?=$data['subject']?></font></td>
                <td width=30 align=center nowrap><img src=<?=$dir?>/t.gif border=0 width=1 height=2><br><font title=modify><?=$a_modify?><img src=<?=$dir?>/modify.gif width=7 height=7 border=0></a></font><img src=<?=$dir?>/t.gif width=3 height=7 border=0><font title=delete><?=$a_delete?><img src=<?=$dir?>/delete.gif width=7 height=7 border=0></a></font></td>
                <td width=65 align=center nowrap class=tahoma><?=$reg_date?></a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td height=5></td></tr>
        <tr>
          <td>
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <tr>
                <td width=100% valign=top>
                  <table width=100% border=0 cellspacing=0 cellpadding=0>
                    <tr>
                      <td nowrap width=15></td>
                      <td width=100% valign=top style='word-break:break-all'><?=$memo?></td>
                      <td nowrap width=13></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>      
        <tr><td height=8></td></tr>
