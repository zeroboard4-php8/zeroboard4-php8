<?php 
$_c_caount++;
if($_c_caount>$skin_setup['cate_limit']) {
	echo "</td></tr>\n<tr><td height=\"18px\">&nbsp;</td>\n";
	$_c_caount=1;
}
$print_category_data = str_replace(">","><font class=han>",$print_category_data);
?>
<td align="left">&nbsp;&nbsp;<font class="thumb_list_comment">ㆍ</font><?=$print_category_data?></td>
