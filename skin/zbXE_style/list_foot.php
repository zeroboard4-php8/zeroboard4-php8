</table>
</form>

<?php
$print_page="";
        $show_page_num=$setup['page_num']; // 한번에 보일 페이지 갯수
        $show_page_half=ceil($show_page_num/2); //한번에 보일페이지의 반
        $show_page_next=$show_page_num-$show_page_half; //나머지 페이지
        $show_page_half--;

        if($page > ($show_page_half+1)) {
                if(($show_page_num < $total_page)&&($page+$show_page_next > $total_page)) $start_page=($total_page-$show_page_num)+1;
                else $start_page=$page-$show_page_half;
        }
        else $start_page=1;
        
        if((($page+$show_page_next)<$total_page)&&($total_page>$show_page_num)){
                if($start_page==1)$end_page=$show_page_num;
                else $end_page=$page+$show_page_next;
        }
        else $end_page=$total_page;
        $i=0;

        $a_1_prev_page= "<Zeroboard ";
        $a_1_next_page= "<Zeroboard ";
        $a_prev_page = "<Zeroboard ";
        $a_next_page = "<Zeroboard ";

        if($page>1) $a_1_prev_page="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=".($page-1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

        if($page<$total_page) $a_1_next_page="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=".($page+1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

        if($page > 1) {
                $prev_page=$page-1;
                $a_prev_page="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=$prev_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
                $prev_page_exists = true;
                }

        if($page < $total_page) {
                $next_page=$page+1;
                $a_next_page="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=$next_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
                $next_page_exists = true;
                }

        if($start_page != 1) {
                $print_page.="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=1&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>1..";
                }

        while($i+$start_page<=$end_page) {
                $move_page=$start_page+$i;
                if($page==$move_page) $print_page.="<span class=\"moveOn\">$move_page</span>";
                else $print_page.="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=$move_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>$move_page</a>";
                $i++;
        }

        if($end_page != $total_page) {
                $print_page.="<a class=\"link_move\" href='$PHP_SELF?id=$id&page=$total_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>..$total_page";
        }

        // 검색시 Divsion 페이지 이동 표시
        if($use_division) {
                if($prevdivpage&&!$prev_page_exists) $a_div_prev_page="<a class=\"link_move\" href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$prevdivpage'>[이전 검색]</a>...";
                if($nextdivpage&&!$next_page_exists) $a_div_next_page="...<a class=\"link_move\" href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$nextdivpage'>[계속 검색]</a>";
                $print_page = $a_div_prev_page.$print_page.$a_div_next_page;
        }

?>

<form method="get" id="search" name="search" action="<?=$PHP_SELF?>">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="select_arrange" value="<?=$select_arrange?>" />
<input type="hidden" name="desc" value="<?=$desc?>" />
<input type="hidden" name="page_num" value="<?=$page_num?>" />
<input type="hidden" name="selected" />
<input type="hidden" name="exec" />
<input type="hidden" id="sn" name="sn" value="<?=$sn?>" />
<input type="hidden" id="ss" name="ss" value="<?=$ss?>" />
<input type="hidden" id="sc" name="sc" value="<?=$sc?>" />
<input type="hidden" name="category" value="<?=$category?>" />

<script language="javascript">
function zbSearchSelectOption(key) {
	document.getElementById('search').sn.value = 'off';
	document.getElementById('search').ss.value = 'off';
	document.getElementById('search').sc.value = 'off';
	document.search[key].value = 'on';
}
</script>

<table width="<?=$width?>" cellSpacing="0" cellpadding="0" border="0" style="table-layout: fixed">
<colgroup span="2"><col></col><col width="30%"></col></colgroup>
	<tr>
		<td class="ctl_page"><?=$a_prev_page?>이전</a></font> <?=$print_page?> <?=$a_next_page?>다음</td>
		<td class="list_foot_btn" align="right">
		<?php if($is_admin) { // 삭제?>
		<a class="button" href="javascript:delete_all()" title="삭제"><span>삭제</span></a>
		<?php }?>
		<?php if($is_admin||$member['level']<=$setup['grant_list']) {?>
		<a class="button" href="<?=$PHP_SELF?>?id=<?=$id?>&page=<?=$page?>&category=<?=$category?>&sn=<?=$sn?>&ss=<?=$ss?>&sc=<?=$sc?>&keyword=<?=$keyword?>&prev_no=<?=$no?>&sn1=<?=$sn1?>&divpage=<?=$divpage?>" title="목록"><span>목록</span></a>
		<?php }?>
		<?php if($is_admin||$member['level']<=$setup['grant_write']) {?><a class="button" href="write.php?<?=$href?><?=$sort?>&no=<?=$no?>&mode=write&sn1=<?=$sn1?>&divpage=<?=$divpage?>" title="쓰기"><span>쓰기</span></a><?php }?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="xe_search">
			<select onChange="zbSearchSelectOption(this.options[this.selectedIndex].value);">
			<option value="sn" <?php if($_GET['sn']=="on"){?>selected="selected"<?php }?>>이름으로</option>
			<option value="ss" <?php if($_GET['ss']=="on"){?>selected="selected"<?php }?>>제목으로</option>
			<option value="sc" <?php if($_GET['sc']=="on"){?>selected="selected"<?php }?>>내용으로</option>
			</select>
			<input type="text" name="keyword" value="<?=$keyword?>" class="xe_searchIp" /><span class="button" style="margin-top:-6px"><input type="submit" value="검색" /></span><a class="button" style="margin-top:-6px" href="#" onclick="location.href='zboard.php?id=<?=$id?>'; return false;" title="취소"><span>취소</span></a></span>
		</td>
	</tr>
</table>
</form>
