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
</td></tr><tr><td width=100%>


<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>
   <td>
   <table border=0 height=19 cellspacing=0 cellpadding=0 width=25>
  <tr>
    <td background=<?=$dir?>/list_left.gif border=0 align=center nowrap>&nbsp;<?=$a_no?><img src=<?=$dir?>/h_no.gif border=0></a>&nbsp;</td>
  </tr>
</table>
   </td>

<?=$hide_cart_start?>
   <td>
   <table width=100% height=19 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td background=<?=$dir?>/list_back.gif border=0 align=center nowrap>&nbsp;<?=$a_cart?>&nbsp;</td>
  </tr>
</table>
   </td>
<?=$hide_cart_end?>

<?=$hide_category_start?>
   <td align=center><img src=images/t.gif border=0 height=1 border=0><br><?=$a_category?></td>
<?=$hide_category_end?>

   <td width=100%>
   <table width=100% height=19 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td background=<?=$dir?>/list_back.gif border=0 align=center nowrap><img src=/images/t.gif width=3>&nbsp;<?=$a_subject?><img src=<?=$dir?>/h_subject.gif 
border=0></a>&nbsp;</td>
  </tr>
</table>
  </td>
   <td>
   <table width=80 height=19 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td background=<?=$dir?>/list_back.gif border=0 align=center nowrap style='word-break:break-all;'>&nbsp;<?=$a_name?><img src=<?=$dir?>/h_name.gif border=0></a>&nbsp;</td>
  </tr>
</table>
  </td>

   <td>
   <table width=100% height=19 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td background=<?=$dir?>/list_back.gif border=0 align=center nowrap><img src=/images/t.gif width=3>&nbsp;<?=$a_date?><img src=<?=$dir?>/h_date.gif border=0></a>&nbsp;</td>
  </tr>
</table>
  </td>
   <td>
   <table width=25 height=19 border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td background=<?=$dir?>/list_right.gif border=0 align=center><img src=/images/t.gif width=3><?=$a_hit?><img src=<?=$dir?>/h_read.gif 
border=0></a></td>
  </tr>
</table>
  </td>
</tr>
</tr>
