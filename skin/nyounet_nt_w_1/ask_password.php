<br>
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

<table border=0 cellspacing=0 cellpadding=0 width=250>
  <tr>
    <td width=100% align=center style=color:#4A4A4A>
      <table border=0 cellspacing=0 cellpadding=10 width=100%>
        <tr>
          <td align=center class=normal><?=$title?></td>
        </tr>
      </table>
     </td>
  </tr>
  <tr>
    <td height=1 background=<?=$dir?>/dot.gif></td>
  </tr>
  <tr>
    <td height=7></td>
  </tr>
<?php
	if(!$member['no']) {
?>
  <tr height=40>
    <td align=center class=tahoma_b>password &nbsp;&nbsp;<?=$input_password?></td>
  </tr>
<?php
	}
?>
  <tr>
    <td height=7></td>
  </tr>
  <tr>
    <td height=1 background=<?=$dir?>/dot.gif></td>
  </tr>
  <tr>
    <td height=1></td>
  </tr>
  <tr height=30>
    <td align=center><input type=image src=<?=$dir?>/btn_writeok.gif border=0 width=58 height=17 accesskey="s" onfocus=blur()><?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0 width=28 height=17></a><a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0 width=36 height=17></a></td>
  </tr>
</table>
</form>

