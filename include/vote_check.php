<?php
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	if(eregi(":\/\/",$dir)||eregi("\.\.",$dir)) $dir ="./";

	if(!$data['vote']) $data['vote']=1;

	$reply_result=zb_query("select * from $t_board"."_$id where headnum='$data[headnum]' and depth>0 order by arrangenum");

	while($reply_data=mysql_fetch_array($reply_result)) {
		include "include/reply_check.php";
		$subject=$reply_data['subject'];
		$a_vote="<a href=apply_vote.php?id=$id&no=$data[no]&sub_no=$reply_data[no]&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&cn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category>";
		$bar_size=(int)(($reply_data['vote']/$data['vote'])*100);
		$vote=$reply_data['vote'];
		include "$dir/vote_list.php";
	}

?>

