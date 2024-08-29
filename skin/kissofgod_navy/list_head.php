<?php 
 $colnum=5+$setup['use_cart'];
?>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<col width=1></col><?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=50></col>
<col width=></col><col width=90></col><col width=70></col><col width=40></col>
<col width=1></col>

<tr align=center>
   <td width=1 class=kissofgod-list-head-td></td>
   <?=$hide_cart_start?>
   <td width=20 class=kissofgod-list-head-td><?=$a_cart?><span class=kissofgod-list-head-title>v</span></a></td>
   <?=$hide_cart_end?>
   <td width=50 class=kissofgod-list-head-td><?=$a_no?><span class=kissofgod-list-head-title>no</span></a></td>
   <td class=kissofgod-list-head-td><?=$a_subject?><span class=kissofgod-list-head-title>subject</span></a></td>
   <td width=90 class=kissofgod-list-head-td><?=$a_name?><span class=kissofgod-list-head-title>name</span></a></td>
   <td width=70 class=kissofgod-list-head-td><?=$a_date?><span class=kissofgod-list-head-title>date</span></a></td>
   <td width=40 class=kissofgod-list-head-td><?=$a_hit?><span class=kissofgod-list-head-title>read</span></a></td>
   <td width=1 class=kissofgod-list-head-td></td>
</tr>

<tr><td colspan=10 class=kissofgod-base-listline></td></tr>

<form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>">
