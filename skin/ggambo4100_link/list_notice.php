<?php 
	$data['subject'] = str_replace(">","><font class=list_notice>",$data['subject']);
	$name= str_replace(">","><font class=list_han>",$name);
	$siteadd= str_replace(">","><font class=icon3>",$siteadd);
if ($data['sitelink1']) {$siteadd = "<a href='$dir/hit.php?sitelink={$data['sitelink1']}&$href$sort&no={$data['no']}' onfocus='this.blur()' target=_blank>";
$link = $data['sitelink1']; }
elseif ($data['sitelink2']) {$siteadd = "<a href='$dir/hit.php?sitelink={$data['sitelink2']}&$href$sort&no={$data['no']}' onfocus='this.blur()' target=_blank>";
$link = $data['sitelink2']; }
else {$siteadd = "";
$link="";}
?>
<tr align=center class=list0 onmouseover="this.style.backgroundColor='F8F8F8'" onmouseout="this.style.backgroundColor=''">
<td><table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr>
	<td align=left nowrap height=25 class=list_notice style='padding:3 0 0 0;'><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?><nobr><font class=icon>NOTICE</icon><nobr>&nbsp;&nbsp;::<?=$hide_category_end?>&nbsp;&nbsp;<?=$data['subject']?>&nbsp;&nbsp;
	<?=$a_modify?>&nbsp;+</a><?=$a_delete?>&nbsp;-</a></td><td align=right class=icon3 nowrap>
	<?=$siteadd?><?=$link?></a></td> 
</tr></table></td>
</tr>
<tr><td class=line1></td></tr>
<?php $coloring++;?>