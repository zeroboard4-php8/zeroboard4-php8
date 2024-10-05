<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr>
  <td width=100% valign=top>
<?php include "$dir/value.php3"; ?>
<?php include "$dir/script_popup.php"; ?>


<table border=0 cellspacing=0 cellpadding=0 width=100%>
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
<tr><td class=line1 width=100%></td></tr>
<tr><td width=100%>

<?php 
  $image_loop=0;
?>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>
