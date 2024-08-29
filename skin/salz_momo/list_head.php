<?php 
 $colnum=5+$setup['use_cart'];
?>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<col width=11></col><?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=50></col>
<col width=></col><col width=90></col><col width=70></col><col width=40></col>
<col width=11></col>

<tr align=center>
   <td width=11><img src=<?=$dir?>/list_left.gif width=11 height=200 border=0></td>
   <?=$hide_cart_start?><td width=20><?=$a_cart?><img src=<?=$dir?>/h_c.gif border=0></a></td><?=$hide_cart_end?>
   <td width=50 valign=bottom></td>
   <td width=><img src=<?=$dir?>/h_subject.gif border=0></a></td>
   <td width=90 align=right><img src=<?=$dir?>/h_writer.gif border=0></a></td>
   <td width=70><img src=<?=$dir?>/h_date.gif border=0></a></td>
   <td width=40><img src=<?=$dir?>/h_read.gif border=0></a></td>
   <td width=11><img src=<?=$dir?>/list_right.gif border=0></td>
</tr>
<tr><td colspan=8 background=<?php echo $dir?>/dot.gif height=1></td></tr>
<form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>">
