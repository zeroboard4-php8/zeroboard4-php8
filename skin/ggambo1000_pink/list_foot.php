 </table>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
   <td height=5 width=100%  colspan=10>
   <table border=0  cellspacing=0 cellpadding=0 width=100% height=5><tr><td height=100% width=100% background=<?=$dir?>/line.gif ><img src=<?=$dir?>/line_left_icon.gif border=0 height=5></td>    <td background=<?=$dir?>/line.gif align=right ><img src=<?=$dir?>/line_right_icon.gif border=0 height=5></td></tr></table>
   </td>
</tr>
</table>
<?php 
	if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=list_eng2>",$a_list)."";
	if(!eregi("Zeroboard",$delete_all)) $a_delete_all = str_replace(">","><font class=list_eng2>",$a_delete_all)."";
	if(!eregi("Zeroboard",$a_1_prev_page)) $a_1_prev_page = str_replace(">","><font class=list_eng>",$a_1_prev_page)."&nbsp;";
	if(!eregi("Zeroboard",$a_1_next_page)) $a_1_next_page = str_replace(">","><font class=list_eng>",$a_1_next_page)."&nbsp;";
	if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=list_eng2>",$a_write)."&nbsp;";
	if(!eregi("Zeroboard",$a_prev_page)) $a_prev_page = str_replace(">","><font class=list_eng>",$a_prev_page)."&nbsp;";
	if(!eregi("Zeroboard",$a_next_page)) $a_next_page = str_replace(">","><font class=list_eng>",$a_next_page)."&nbsp;";
	$print_page = str_replace("<font style=font-size:8pt>","<font class=list_eng>",$print_page);
	$print_page = str_replace("계속 검색","<font class=list_han>계속 검색",$print_page);
	$print_page = str_replace("이전 검색","<font class=list_han>계속 검색",$print_page);
?>
<img src=<?=$dir?>/t.gif border=0 height=5><br>

<script language="JavaScript">
function toggle(e) {
	if (e.style.display == "none")
		{ e.style.display = ""; }
	else 	{ e.style.display = "none"; }
	}
</script>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr valign=top>
	<td style='padding-left:10px;' class=font-family:Verdana;font-size:7pt nowrap><?=$a_prev_page?>◁</a></font> <?=$print_page?> <?=$a_next_page?>▷</a>
		
	</td>
	<td align=right style='padding-right:10px;'><font face=Verdana><span style=font-size:8pt>
	<a href=javascript:toggle(link1) onfocus=this.blur() title=검색><font class=list_eng2>SEARCH</font></a>&nbsp;
	<?=$a_delete_all?>DELETE</a>&nbsp;<?=$a_write?>WRITE</a></span></font>
		<br>
		<div id="link1" style="width:10px; z-index:1; border:0px solid #000000; background-color:; layer-background-color:; margin:0px; display: none;">
		<table border=0 cellspacing=0 cellpadding=0>
		</form>
		<form method=get name=search action=<?=$PHP_SELF?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="off"><input type=hidden name=category value="<?=$category?>">
		<tr>
			<td style='padding-top:4;'>
				<a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>&nbsp;
				<a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>&nbsp;
				<a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>&nbsp;
			</td>
			<td><input type=text name=keyword value="<?=$keyword?>" class=input size=10></td>
			<td><input type=image src=<?=$dir?>/search.gif class=input3 value="검색"  onfocus=blur()></td>
		</tr>
		</form>
		</table><br></div>
	</td>
</tr>
</table>
<br>
