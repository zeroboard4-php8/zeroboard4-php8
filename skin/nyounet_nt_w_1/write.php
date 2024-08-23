<?php
	if($mode=="reply") $title="Post a Reply";
	elseif($mode=="modify") $title="Modify Article";
	else $title="New Article";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}
// -->
</SCRIPT>

<table width=80% border=0 cellspacing=0 cellpadding=0>
  <form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>">
  <tr>
    <td width=100% height=13></td>
  </tr>
  <tr>
    <td height=20 align=left><img src=<?=$dir?>/t.gif border=0 width=20 height=1><?=$title?></td>
  </tr>
  <tr>
    <td height=1 background=<?=$dir?>/dot.gif></td>
  </tr>
</table>

<table width=80% border=0 cellspacing=0 cellpadding=0>
  <tr><td nowrap width=85 height=6 class=write_left></td><td width=100%></td></tr>

<?=$hide_start?>
  <tr>
    <td height=20 align=right class=write_left>name<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td> 
    <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1><input type=text name=name value="<?=$name?>" <?=size(13)?> maxlength=20 class=textbox></td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=2 class=write_left></td><td></td></tr>

  <tr>
    <td height=20 align=right class=write_left>password<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1><input type=password name=password <?=size(13)?> maxlength=20 class=textbox></td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=2 class=write_left></td><td></td></tr>

  <tr>
    <td height=20 align=right class=write_left>e-mail<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1><input type=text name=email value="<?=$email?>" <?=size(20)?> maxlength=200 class=textbox></td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=2 class=write_left></td><td></td></tr>

  <tr>
    <td height=20 align=right class=write_left>homepage<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1><input type=text name=homepage value="<?=$homepage?>" <?=size(20)?> maxlength=200 class=textbox></td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=2 class=write_left></td><td></td></tr>
<?=$hide_end?>

  <tr>
    <td height=20 align=right class=write_left>select<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
          <td><?=$category_kind?></td>
          <?=$hide_html_start?>
          <td><img src=<?=$dir?>/t.gif border=0 width=3 height=1><input type=checkbox name=use_html class=checkbox <?=$use_html?> value=1></td>
          <td><font class=tahoma_b>&nbsp;html</font></td>
          <?=$hide_html_end?>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;<img src=<?=$dir?>/arrange.gif border=0 width=13 height=7 alt=enlarge_area valign=absmiddle style=cursor:hand; onclick=zb_formresize(document.write.memo)></td>
        </tr>
      </table>
    </td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=2 class=write_left></td><td></td></tr>

  <tr>
    <td height=20 align=right class=write_left>subject<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td><img src=<?=$dir?>/t.gif border=0 width=7 height=1><input type=text name=subject value="<?=$subject?>" <?=size(30)?> maxlength=200 class=textbox></td>
  </tr>

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>
  <tr><td height=3 class=write_left></td><td></td></tr>

<!--메모-->
  <tr>
    <td align=right class=write_left>comment<img src=<?=$dir?>/t.gif border=0 width=7 height=1></td>
    <td>
      <table border=0 cellspacing=0 cellpadding=0 width=100%>
        <tr>
          <td nowrap width=7></td>
          <td width=100%><textarea name=memo <?=size2(40)?> rows=16 class=textarea style=width:100%><?=$memo?></textarea></td>
          <td nowrap width=7></td>
        </tr>
      </table>
    </td>
  </tr>
<!--/메모-->

  <tr><td height=2 class=write_left></td><td></td></tr>
  <tr><td height=1 class=write_left></td><td background=<?=$dir?>/dot.gif></td></tr>

  <tr>
    <td colspan=2 height=4></td>
  </tr>
  <tr>
    <td colspan=2>
      <table border=0 cellspacing=0 cellpadding=0 width=100%>
        <tr>
          <td><?=$a_imagebox?><img src=<?=$dir?>/btn_imagebox.gif border=0></a></td>
          <td align=right><input type=image src=<?=$dir?>/btn_writeok.gif border=0 onfocus=blur() border=0 accesskey="s"><a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_writecancel.gif border=0></a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

