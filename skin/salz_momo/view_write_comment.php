</table>
<div align=center>
<table border=0 cellspacing=0>
<col width=11></col><col width=></col><col width=11></col>
<tr align=center>
<td width=11>
<form method=post name=write action=comment_ok.php>
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
</td>
<td>
  <img src=images/t.gif border=0 height=20><Br>

  <table border=1 cellspacing=0 cellpadding=0 cellpadding=0 bordercolordark=ededed bordercolorlight=black>
  <tr>
  <td>

  <table border=0 cellpadding=5 cellspacing=1>
  <tr align=center style=font-size:9pt;font-family:굴림>
    <td width=80 valgin=top style="filter: Alpha(Opacity=70)"><img src=<?=$dir?>/name.gif border=0><br><?=$c_name?><br><br><?=$hide_c_password_start?><img src=<?=$dir?>/psswd.gif border=0><br><input type=password name=password <?=size(10)?> maxlength=20 class=input></td><?=$hide_c_password_end?>

    <td style="filter: Alpha(Opacity=70)"><img src=<?=$dir?>/content.gif border=0><br><textarea name=memo cols=50 rows=5 class=TEXTAREA style='overflow:auto'></textarea>&nbsp;&nbsp;</td>
</td>
    <td>
    <td rowspan=2 valign=bottom><input type=image src=<?=$dir?>/btn_comment_ok.gif border=0 onfocus=blur() accesskey="s"></td>
  </tr>
  <tr align=center>

    <td></td>


  </tr>
  </table>

  </td>
  </tr>
  </table>

  </td>
  <td width=11>&nbsp;</td>
</tr>
</form>
</table>
<img src=images/t.gif border=0 height=20><br>
</div>

<?=$hide_comment_end?>
