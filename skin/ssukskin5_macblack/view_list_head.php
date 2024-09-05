<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=10></td><col width=30></col><?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=></col><col width=90></col><col width=80></col><col width=30></col><col width=10></td>
<tr align=center>

  <td><img src=<?=$dir?>/bg_1.gif border=0></td>
  <td align=center valign=top class=ssuk_lh><form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><?=$a_no?><img src=<?=$dir?>/h_no.gif border=0></a></td>

  <?=$hide_cart_start?>
  <td align=center valign=top class=ssuk_lh><?=$a_cart?><img src=<?=$dir?>/h_c.gif border=0 ></a></td><?=$hide_cart_end?>

  <td align=center valign=top class=ssuk_lh <?php if(!$browser)echo"width=90%";?>><?=$a_subject?><img src=<?=$dir?>/h_subject.gif border=0></a></td>

  <td align=center valign=top class=ssuk_lh><?=$a_name?><img src=<?=$dir?>/h_name.gif border=0 ></a></td>

  <td align=center valign=top class=ssuk_lh><?=$a_date?><img src=<?=$dir?>/h_date.gif border=0></a></td>

  <td align=center valign=top class=ssuk_lh><?=$a_hit?><img src=<?=$dir?>/h_hit.gif border=0 ></a></td>

  <td><img src=<?=$dir?>/bg_3.gif border=0></td>
</tr>
