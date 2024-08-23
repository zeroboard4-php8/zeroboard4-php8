<?php
	if(!defined("_zb_lib_included")) return;
	if(eregi(":\/\/",$dir)||eregi("^\.",$dir)) $dir ="./";

	if($setup['use_category']) {

		$c_href="&id=$id&page=$page&page_num=$page_num&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword";
		$c_sort="&select_arrange=$select_arrange&desc=$desc";
 
		$a_c_list="<a href=zboard.php?&id=$id>";

		include "$dir/category_head.php";

		for($i=0;$i<count($category_num_c);$i++) {
			if($category==$category_num_c[$i]) $b="<b>"; else $b="";
			$print_category_data="<a href='zboard.php?category=$category_num_c[$i]$c_href$c_sort'>$b$category_name_c[$i] ($category_n_c[$i])</a></b>";
			include "$dir/category_main.php";
		}  
		
		include "$dir/category_foot.php";
	}
?>
