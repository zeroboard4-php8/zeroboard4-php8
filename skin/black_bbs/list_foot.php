<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 목록을 다 출력한 다음 마무리 짓는 부분입니다.
  테이블을 닫고 페이지 출력이나 검색 출력, 버튼등을 출력하면 됩니다.
  아래부분은 그대로 사용하시면 됩니다.

  <?=$a_1_prev_page?> : 이전페이지를 출력합니다. (한페이지씩 이동)
  <?=$a_1_next_page?> : 다음 페이지를 출력합니다. (한페이지씩 이동)
  <?=$a_prev_page?> : 이전페이지를 출력합니다.
  <?=$a_next_page?> : 다음 페이지를 출력합니다.  
  <?=$print_page?> : 페이지를 출력합니다
  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_modify?> : 글수정 버튼
  <?=$a_delete_all?> : 관리자일때 나타나는 선택된 글 삭제 버튼;;
  
  */
///////////////////////////////////////////////////////////////////////// ?>
<?php
/***************************************************************************
 * 스킨에서 사용할 페이지 정리
 **************************************************************************/

	$print_page="";
	$show_page_num=$setup['page_num']; // 한번에 보일 페이지 갯수
	$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
	$i=1;

	$a_1_prev_page= "<Zeroboard ";
	$a_1_next_page= "<Zeroboard ";
	$a_prev_page = "<Zeroboard ";
	$a_next_page = "<Zeroboard ";

	if($page>1) $a_1_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page-1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

	if($page<$total_page) $a_1_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page+1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

	if($page>$show_page_num) {
		$prev_page=$start_page;
		$a_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$prev_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
		$print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=1&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'><span class=7v>1</a><span class=7px> ...";
		$prev_page_exists = true;
		}

	while($i+$start_page<=$total_page&&$i<=$show_page_num) {
		$move_page=$i+$start_page;
		if($page==$move_page) $print_page.=" <span class=7v> <b>$move_page</b> </font>";
		else $print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$move_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'><span class=7v>&nbsp;$move_page&nbsp;</a>";
		$i++;
	}

	if($total_page>$move_page) {
		$next_page=$move_page+1;
		$a_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$next_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
		$print_page.="<span class=7px> ... <a onfocus=blur() href='$PHP_SELF?id=$id&page=$total_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$divpage'><span class=7v>&nbsp;$total_page</a>";
		$next_page_exists = true;
	}

	// 검색시 Divsion 페이지 이동 표시
	if($use_division) {
		if($prevdivpage&&!$prev_page_exists) $a_div_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$prevdivpage'>이전 검색</a>...";
		if($nextdivpage&&!$next_page_exists) $a_div_next_page="...<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&sn1=$sn1&divpage=$nextdivpage'>계속 검색</a>";
		$print_page = $a_div_prev_page.$print_page.$a_div_next_page;

	}

?>
</table>



<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
  <td class=n height=30>
    <?=$a_list?>list</a>
    <?=$a_delete_all?>delete</a>
  </td>
  <td align=right class=n>
    <?=$a_write?>write</a>
  </td>
</tr>
<tr>
  <td align=center colspan=2 class=en>
 <?=$a_prev_page?><&nbsp;</a> <?=$print_page?> <?=$a_next_page?>&nbsp;></a>
  </td>
</tr>
</form>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

<form method=post name=search action=<?=$PHP_SELF?>><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=category value="<?=$category?>">

<tr>
   <td align=right>
    <a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>&nbsp;<input type=text name=keyword value="<?=$keyword?>" class=input2 size=15>
  </td>

</tr>

<tr>
  <td align=right>

  <table border=0 cellspacing=0 cellpadding=0>
  <tr>
     <td></td>
  </tr>
  </table>

  </td>
</tr>
</form>
</table>

<?php 
 if($setup['use_category'])
  { 
  	$width=$setup['table_width'];
  ?>
  </td>
</tr>
</table>
<?php }?>
