<?php 
if(eregi(basename(__FILE__),$PHP_SELF)) die('정상적인 접근이 아닙니다');
// 섬네일 이미지가 가로 갯수만큼 채워지지 않았을때
	if (!empty($_temp)) {
		$temp = $skin_setup['thumb_hcount'] - $_hcol;
		$_ta_width2 = $_ta_width*$temp;
		echo "<td colspan=".$temp." width=".$_ta_width2."%></td>\n";
		echo "</tr>\n<tr><td colspan=\"$_hcol\" style=\"height:10px\" class=\"thumb_area_bg\"></td></tr>\n</table>\n";
	}
?>

  </td></tr>
</form>
</table>

<?php if($skin_setup['using_pageNumber']) {?>
<table border="0" cellpadding="0" cellspacing="0" width="<?=$width?>" class="thumb_area_bg">
<tr>
  <td class="thumb_area_bg" style="padding:10px 3px 5px 10px" align="<?=$skin_setup['pageNum_align']?>">
	<?=isset($bt_prev_page)?$bt_prev_page:''?> <?=isset($print_page)?$print_page:''?> <?=isset($bt_next_page)?$bt_next_page:''?><br>
  </td>
</tr>
</table>
<?php } ?>

<?php if($skin_setup['using_pageNavi'] || $skin_setup['using_search']) {?>
<table border="0" cellpadding="0" cellspacing="0" width="<?=$width?>" class="info_bg">
<tr><td class="lined"><?=$blank_Image?></td></tr>
<tr><td height="5px"></td></tr>
</table>
<?php } ?>

<?php if($skin_setup['using_pageNavi'] || $bt_write) {?>
<table border="0" cellpadding="0" cellspacing="0" width="<?=$width?>" class="info_bg">
<tr><td height="5" colspan="3"></td></tr>
<tr valign="top" align="left">
	<?php if($skin_setup['using_pageNavi']) {?>
	<td style="padding-left:10px;">
		<nobr><?=isset($bt_list)?$bt_list:''?><?=isset($bt_delete_all)?$bt_delete_all:''?><?=isset($bt_1_prev_page)?$bt_1_prev_page:''?><?=isset($bt_1_next_page)?$bt_1_next_page:''?></nobr>
	</td>
	<?php } ?>
	<?php if($bt_write) {?>
	<td align="right"><nobr><?=$bt_write?></a></nobr></td>
	<td style="width:10px"></td>
	<?php } ?>
</tr>
</table>
<?php } ?>

<?php if($skin_setup['using_search']) {?>
<div class="vSpacer2 info_bg" style="width:<?=$width?>"></div>
<div class="info_bg" style="width:<?=$width?>;height:30px">
  <form method="POST" name="search" action="<?=$_SERVER['PHP_SELF']?>" style="display:inline">
    <input type="hidden" name="id" value="<?=$id?>"><input type="hidden" name="select_arrange" value="<?=$select_arrange?>"><input type="hidden" name="desc" value="<?=$desc?>"><input type="hidden" name="page_num" value="<?=$page_num?>"><input type="hidden" name="selected"><input type="hidden" name="exec"><input type="hidden" name="sn" value="<?=$sn?>"><input type="hidden" name="ss" value="<?=$ss?>"><input type="hidden" name="sc" value="<?=$sc?>"><input type="hidden" name="su" value="<?=$su?>"><input type="hidden" name="category" value="<?=$category?>">
    <?php include $_css_dir."search.php";?>
  </form>
</div>
<?php } ?>

<?php if(!empty($hiddenSlide1)) {?>
<div class="hidden">
<?=$hiddenSlide1?>
</div>
<script type="text/javascript"><?=$hiddenSlide2?></script>
<?php } ?>

<div class="vSpacer2 info_bg" style="width:<?=$width?>"></div>
