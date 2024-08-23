</table>

<table border=0 width=<?=$width?> height=3 cellspacing=0 cellpadding=0>
<tr>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
  <td width=100%><img src=<?=$dir?>/list_foot.gif border=0 width=100% height=3></td>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
</tr>
</table>


<img src=images/t.gif border=0 height=10><br>


<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
  <td>
    <?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0 align=absmiddle width-63 height=32></a>
    <?=$a_delete_all?><img src=<?=$dir?>/btn_deleteall.gif border=0 align=absmiddle width-63 height=32></a>
    <img src=images/t.gif border=0 width=1 height=1>
  </td>
  <td align=right>
    <?=$a_write?><img src=<?=$dir?>/btn_write.gif border=0 align=absmiddle width-63 height=32></a>
    <img src=images/t.gif border=0 width=1 height=1>
  </td>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
</tr>
<tr>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
  <td align=center colspan=2>
    <?=$a_prev_page?>[PREV]</a> <?=$print_page?> <?=$a_next_page?>[NEXT]</a>  
  </td>
  <td width=11><img src=images/t.gif border=0 width=11 height=1></td>
</tr>
</form>
</table>

<img src=images/t.gif border=0 height=10><br>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">

<tr>
   <td align=center>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a> &nbsp;
    <a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a> &nbsp;
    <a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a> 
  </td>
</tr>

<tr>
  <td align=center>

  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
     <td><img src=<?=$dir?>/search_left.gif border=0></td>
     <td background=<?=$dir?>/search_back.gif><input type=text name=keyword value="<?=$keyword?>" class=input2 size=15></td>
     <td><input type=image src=<?=$dir?>/search_ok.gif border=0 onfocus=blur()></td>
     <td><?=$a_cancel?><img src=<?=$dir?>/search_no.gif align=absmiddle border=0></a></td>
  </tr>
  </table>

  </td>
</tr>
</form>
</table>

<?php 
 if($setup['use_category']) 
  { 
  ?>
  </td>
</tr>
</table>
<?php } ?>
