<?php
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	$_empty_value_str = $skin_setup['info_emptyValue'];

	$tInfo = stripslashes(trim($skin_setup['thumb_info']));
	$tInfo = str_replace("[no]",$loop_number,$tInfo);

	$m_data=@mysql_fetch_array(zb_query("select is_vdel from dq_revolution where zb_id='$id' and zb_no='$data[no]'"));
	$is_vdel = !empty($m_data['is_vdel']) ? $m_data['is_vdel'] : '';

	if($is_admin) $is_vdel = '';
	if($is_vdel) $subject = "<a href=$_zb_exec?$href&$sort&no=$data[no] onfocus=blur()><font class=thumb_list_title>$_strSkin[is_vdel]</font></a>";

	if($data['subject'] != "." && $data['subject'] != "") {
		$tInfo = str_replace("[subj_start]","",$tInfo);
		$tInfo = str_replace("[subj_end]","",$tInfo);
		$tInfo = str_replace("[subj]",$subject,$tInfo);
	} else {
		$tInfo = ereg_replace("\[subj_start\].*\[subj_end\]","",$tInfo);
		$tInfo = str_replace("[subj]","",$tInfo);
	}

	$memo_text = trim(strip_tags($data['memo']));
	if($memo_text != "." && $memo_text != "") {
		$tInfo = str_replace("[memo_start]","",$tInfo);
		$tInfo = str_replace("[memo_end]","",$tInfo);
		$tInfo = str_replace("[memo]",$memo_text,$tInfo);
	} else {
		$tInfo = ereg_replace("\[memo_start\].*\[memo_end\]","",$tInfo);
		$tInfo = str_replace("[memo]","",$tInfo);
	}

	if($setup['use_category']) {
		$tInfo = str_replace("[cate_start]","",$tInfo);
		$tInfo = str_replace("[cate_end]","",$tInfo);
		$tInfo = str_replace("[cate]",$category_name,$tInfo);
	} else {
		$tInfo = ereg_replace("\[cate_start\].*\[cate_end\]","",$tInfo);
		$tInfo = str_replace("[cate]","",$tInfo);
	}

	if($su != "on") {
		$tInfo = str_replace("[name_start]","",$tInfo);
		$tInfo = str_replace("[name_end]","",$tInfo);
		$tInfo = str_replace("[name]",str_replace("<div align=\"left\">","",$face_image)."</b> ".$name,$tInfo);
	} else {
		$tInfo = ereg_replace("\[name_start\].*\[name_end\]","",$tInfo);
		$tInfo = str_replace("[name]","",$tInfo);
	}

	if(!$comment_num) $comment_num = "0";


 // 통계 출력

	$ppoint1=0; $ppoint=0;
	$ppoint1 = $data['total_comment']+1;
	if($data['vote']) $ppoint = ceil((100*($data['vote']*$ppoint1)/$data['hit'])+($data['hit']/3));

	if(eregi("\[hit\]",$tInfo) && $hit)			$info1_on = true;
	if(eregi("\[vote\]",$tInfo) && $vote)		$info1_on = true;
	if(eregi("\[comment\]",$tInfo) && $comment_num) $info1_on = true;
	if(eregi("\[point\]",$tInfo) && $ppoint)		$info1_on = true;
	if(!empty($info1_on)) {
		$tInfo = str_replace("[info1_start]","",$tInfo);
		$tInfo = str_replace("[info1_end]","",$tInfo);
	} else {
		$tInfo = preg_replace("/\[info1_start\].*\[info1_end\]/s","",$tInfo);
	}

	if(!empty($ppoint)) {
		$tInfo = str_replace("[point_start]","",$tInfo);
		$tInfo = str_replace("[point_end]","",$tInfo);
		$tInfo = str_replace("[point]",$ppoint,$tInfo);
	} else {
		$tInfo = ereg_replace("\[point_start\].*\[point_end\]","",$tInfo);
		$tInfo = str_replace("[point]",$_empty_value_str,$tInfo);
	}

	if(!empty($hit)) {
		$tInfo = str_replace("[hit_start]","",$tInfo);
		$tInfo = str_replace("[hit_end]","",$tInfo);
		$tInfo = str_replace("[hit]",$hit,$tInfo);
	} else {
		$tInfo = ereg_replace("\[hit_start\].*\[hit_end\]","",$tInfo);
		$tInfo = str_replace("[hit]",$_empty_value_str,$tInfo);
	}

	if(!empty($comment_num)) {
		$tInfo = str_replace("[comment_start]","",$tInfo);
		$tInfo = str_replace("[comment_end]","",$tInfo);
		$tInfo = str_replace("[comment]",$comment_num,$tInfo);
	} else {
		$tInfo = ereg_replace("\[comment_start\].*\[comment_end\]","",$tInfo);
		$tInfo = str_replace("[comment]",$_empty_value_str,$tInfo);
	}

	if(!empty($vote)) {
		$tInfo = str_replace("[vote_start]","",$tInfo);
		$tInfo = str_replace("[vote_end]","",$tInfo);
		$tInfo = str_replace("[vote]",$vote,$tInfo);
	} else {
		$tInfo = ereg_replace("\[vote_start\].*\[vote_end\]","",$tInfo);
		$tInfo = str_replace("[vote]",$_empty_value_str,$tInfo);
	}

	$tInfo = str_replace("[y]",date("Y",$data['reg_date']),$tInfo);
	$tInfo = str_replace("[month]",date("m",$data['reg_date']),$tInfo);
	$tInfo = str_replace("[day]",date("d",$data['reg_date']),$tInfo);
	$tInfo = str_replace("[time]",date("H:i",$data['reg_date']),$tInfo);

	if(eregi("[bgm]",$tInfo) && is_mediafile($data['sitelink1'])) {
		$tInfo = str_replace("[bgm]","<font class=thumb_list_title style=\"font-size:10pt\">&nbsp;♬</font>",$tInfo);
	} else $tInfo = str_replace("[bgm]","",$tInfo);

	if(eregi("[admin]",$tInfo) && $is_admin) {
		$tInfo = str_replace("[admin]",$hide_cart_start."<input type=\"checkbox\" name=\"cart\" value=\"$data[no]\">".$hide_cart_end,$tInfo);
	} elseif(eregi("[admin]",$tInfo)) {
		$tInfo = str_replace("<br>[admin]","",$tInfo);
		$tInfo = str_replace("[admin]","",$tInfo);
	}

	$tInfo = str_replace("[spacer]","<img src=\"$dir/t.gif\" height=\"5px\" width=\"5px\">",$tInfo);

?>
