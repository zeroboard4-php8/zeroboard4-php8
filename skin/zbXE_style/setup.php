<table width="<?=$width?>" cellSpacing="0" cellpadding="0" class="xe_setup">
<colgroup span="2"><col width="200px"></col><col></col></colgroup>
	<tr>
		<td class="xe_setupTt_L"><?php if($setup['title']) {?><?=$setup['title']?><?php }else{?>게시판<?php }?>&nbsp;</td>
		<td class="xe_setupTt_R" align="right">&nbsp;
		<?php if($is_admin) { // 운영자 게시판설정 버튼?>
		<a class="button" href="admin_setup.php?exec=view_board&no=<?=$setup['no']?>&group_no=<?=$setup['group_no']?>&exec2=modify" title="설정" target="_blank"><span>게시판설정</span></a>
		<?php }?></td>
	</tr>

	<tr>
		<td class="xe_setup_total"><img src="<?=$dir?>/images/iconArticle.gif" class="xe_setup_total_ic" title="total" alt="total" onclick="location.href='zboard.php?id=<?=$id?>'" />글수 <span class="list_com_sp"><?=$total?></span></td>
		<td class="xe_setup_ct"><?=$hide_category_start?><?php include "include/print_category.php"; ?><?=$hide_category_end?>&nbsp;</td>
	</tr>
</table>
