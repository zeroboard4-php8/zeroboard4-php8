<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=1>
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
</td><td width=100%>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr align=center >
<tr>
<td><img src=<?=$dir?>/t.gif border=0 height=2></td>
</tr>
  <td>
    <table border=0 height=15 cellspacing=0 cellpadding=0 width=25>
       <tr><td align=center valign=top nowrap><?=$a_no?><div class=t7_4a4d4a>No</font></div></a></td></tr>
    </table>
  </td>
<?=$hide_cart_start?>
  <td>
    <table border=0 height=15 cellspacing=0 cellpadding=0>
       <tr><td align=center valign=top nowrap><?=$a_cart?><div class=t7_4a4d4a>C</font></div></a></td></tr>
    </table>
  </td>
<?=$hide_cart_end?>
<?=$hide_category_start?><td><?=$a_category?></td><?=$hide_category_end?>
  <td width=100%>
    <table border=0 height=15 cellspacing=0 cellpadding=0 width=100%>
       <tr><td align=center valign=top><?=$a_subject?><div class=t7_4a4d4a>Subject</font></div></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=15 cellspacing=0 cellpadding=0 width=90>
       <tr><td align=center valign=top><?=$a_name?><div class=t7_4a4d4a>Name</font></div></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=15 cellspacing=0 cellpadding=0>
       <tr><td align=center valign=top nowrap><?=$a_date?><div class=t7_4a4d4a>Date</font></div></a></td></tr>
    </table>
  </td>
  <td>
    <table border=0 height=15 cellspacing=0 cellpadding=0>
       <tr><td align=center valign=top nowrap><?=$a_hit?><div class=t7_4a4d4a>Hit</font></div></a></td></tr>
    </table>
  </td>
  <td>
  </td>
</tr>
