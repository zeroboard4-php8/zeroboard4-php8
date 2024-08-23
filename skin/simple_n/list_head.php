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
<tr>
  <td height=2 colspan=9 bgcolor=444444></td>
</tr>


<tr align=center>
<td width=1>
</td>


<td width=40>
<?=$a_no?><img src=<?=$dir?>/image/t_no.gif border=0></a>
</td>


<?=$hide_cart_start?>
<td width=30>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=1>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center>
<?=$a_cart?><img src=<?=$dir?>/image/t_c.gif border=0></a>
</td></tr></table>
</td>
<?=$hide_cart_end?>


<td>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=1>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center>
<?=$a_subject?><img src=<?=$dir?>/image/t_subject.gif border=0></a>
</td></tr></table>
</td>



<td width=100>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=1>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center>
<?=$a_name?><img src=<?=$dir?>/image/t_name.gif border=0></a>
</td></tr></table>
</td>



<td width=70>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=1>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center>
<?=$a_date?><img src=<?=$dir?>/image/t_date.gif border=0></a>
</td></tr></table>
</td>




<td width=40>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=1>
<img src=<?=$dir?>/image/v_line.gif border=0>
</td>
<td align=center>
<?=$a_hit?><img src=<?=$dir?>/image/t_hit.gif border=0></a>
</td></tr></table>
</td>

<td width=1>
</td>

</tr>

<tr>
  <td height=4 colspan=9 background=<?=$dir?>/image/v_bg1.gif></td>
</tr>

