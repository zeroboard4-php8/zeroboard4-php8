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
</td></tr>

<tr>
<td width=100%>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>

<td>
   <table border=0 height=1 cellspacing=0 cellpadding=0 width=100% class=line>
   <tr>
   <td><?=$a_no?></a></td> 
   </tr>
   </table>
</td>

<td>
    <table border=0 height=1 cellspacing=0 cellpadding=0 width=100% class=line>
    <tr>
    <td></td>
    </tr>
    </table>
</td>

<td width=<?=$width?>>
    <table border=0 height=1 cellspacing=0 cellpadding=0 width=100% class=line>
    <tr>
    <td><?=$a_subject?></a></td>
    </tr>
    </table>
</td>

<?=$hide_cart_start?>
<td>
   <table border=0 height=1 cellspacing=0 cellpadding=0 width=100% class=line>
   <tr>
   <td><?=$a_cart?></a></td>
   </tr>
   </table>
</td>
<?=$hide_cart_end?>

</tr>