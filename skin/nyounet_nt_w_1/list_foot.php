        <tr>
          <td width=100% height=1 background=<?=$dir?>/dot.gif></td>
        </tr>
        <tr>
          <td height=4><a href=http://nmiss.com target=_blank><img src=<?=$dir?>/t.gif border=0 width=2 height=2></td>
        </tr>
        <tr>
          <td>
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <tr>
                <td><?=$a_delete_all?><img src=<?=$dir?>/btn_admin.gif border=0 width=39 height=17></a><?=$a_1_prev_page?><img src=<?=$dir?>/btn_prev.gif border=0 width=36 height=17></a><?=$a_1_next_page?><img src=<?=$dir?>/btn_next.gif border=0 width=35 height=17></a><?=$a_write?><img src=<?=$dir?>/btn_write.gif border=0 width=37 height=17></a></td>
                <td align=right><font class=normal><?=$a_prev_page?>[이전]</a></font> <?=$print_page?> <font class=normal><?=$a_next_page?>[다음]</font></a></td>
              </tr>
              </form>
            </table>
          </td>
        </tr>
        <tr>
          <td align=right>
            <table border=0 cellspacing=0 cellpadding=0>
<!-- 검색폼 부분 ---------------------->
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
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
<!----------------------------------------------->
              <tr>
                <td><input type=text name=keyword value="<?=$keyword?>" style="height:19;width:80;border:0px;background:url(<?=$dir?>/dot.gif) repeat-x bottom"></td>
                <td><img src=<?=$dir?>/t.gif border=0 width=3 height=1><input type=image src=<?=$dir?>/btn_search.gif border=0 width=44 height=18 onfocus=blur()></td>
                <td><?=$a_cancel?><img src=<?=$dir?>/btn_search_cancel.gif border=0 width=18 height=18></a></td>
                </form> 
              </tr>
              </form>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

