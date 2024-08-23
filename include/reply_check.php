<?php

// 검색어에 해당하는 글자를 빨간;; 색으로 바꾸어줌;;
	if($keyword) {
		if($sn=="on") $reply_data['name']=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data['name']);
		if($ss=="on") $reply_data['subject']=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data['subject']);
		if($sc=="on") $reply_data['memo']=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data['memo']);
		if($ss=="on"&&$setup['cut_length']>0) $setup['cut_length']=$setup['cut_length']+16;
	}

// ' 등의 특수문자때문에 붙인 \(역슬래쉬)를 떼어낸다
	$name=$reply_data['name']=stripslashes($reply_data['name']);  // 이름
	$email=$reply_data['email']=stripslashes($reply_data['email']);  // 메일
	$subject=$reply_data['subject']=stripslashes($reply_data['subject']); // 제목
	$subject=cut_str($subject,$setup['cut_length']); // 제목 자르는 부분
	if($member['level']<=$setup['grant_view']) $subject="<a href=view.php?$href$sort&no=$reply_data[no]>".$subject."</a>"; // 제목에 링크 거는 부분;
	$homepage=$reply_data['homepage']=stripslashes($reply_data['homepage']);
	if($homepage) $homepage="<a href=$homepage target=_blank>$homepage</a>";
	$memo=$reply_data['memo']=nl2br(stripslashes($reply_data['memo'])); // 내용
	$memo=autolink($memo); // 자동링크 거는 부분;;
	$hit=$reply_data['hit'];  // 조회수
	$vote=$reply_data['vote'];  // 투표수
	if($setup['use_showip']||$is_admin)$ip="IP Address : ".$reply_data['ip']."&nbsp;";  // 아이피
	$comment_num="[".$reply_data['total_comment']."]"; // 간단한 답글 수
	$sitelink1=$reply_data["sitelink1"]=stripslashes($reply_data["sitelink1"]);
	$sitelink2=$reply_data["sitelink2"]=stripslashes($reply_data["sitelink2"]);
	if($sitelink1)$sitelink1="<a href=$sitelink1 target=_blank>$sitelink1</a>";
	if($sitelink2)$sitelink2="<a href=$sitelink2 target=_blank>$sitelink2</a>";
	$file_name1=$reply_data["s_file_name1"];
	$file_name2=$reply_data["s_file_name2"];
	$file_download1=$reply_data["download1"];
	$file_download2=$reply_data["download2"];

	if($file_name1) {
		$file_size1=@GetFileSize(filesize($reply_data["file_name1"]));
		$a_file_link1="<a href=download.php?$href$sort&no=$reply_data[no]&filenum=1>";
	} else $a_file_link="<Zeroboard";

	if($file_name2) {
		$file_size2=@GetFileSize(filesize($reply_data["file_name2"]));
		$a_file_link2="<a href=download.php?$href$sort&no=$reply_data[no]&filenum=2>";
	} else $a_file_link="Zeroboard";

	if($comment_num==0) $comment_num="";

	$upload_image1=$upload_image2="";

	if(eregi("\.jpg",$file_name1)||eregi("\.gif",$file_name1)||eregi("\.png",$file_name1)) $upload_image1="<img src=$reply_data[file_name1] border=0><br>";
	if(eregi("\.jpg",$file_name2)||eregi("\.gif",$file_name2)||eregi("\.png",$file_name2)) $upload_image2="<img src=$reply_data[file_name2] border=0><br>";

// 카테고리의 이름을 구함
	if($reply_data['category']&&$setup['use_category']) $category_name=$category_data[$reply_data['category']];
	else $category_name="&nbsp;";

// 글쓴 시간을 년월일 시분초 로 변환함
	$reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초", $reply_data['reg_date'])."'>".date("Y/m/d", $reply_data['reg_date'])."</span>";

	$temp_name = get_private_icon($reply_data['ismember'], "2");
	if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>";

// 메일주소가 있으면 이름에 메일 링크시킴
	if(!isBlank($email)||$reply_data['ismember']) {
		if(!$setup['use_formmail']) $name="<a href=mailto:$email>$name</a>";
		else $name="<a href=javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$reply_data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))>$name</a>";
	}

// Depth에 의한 들임값을 정함
	$insert="";
	for($z=0;$z<$reply_data['depth'];$z++) $insert .="&nbsp; ";

	$icon=get_icon($reply_data);

// 이름앞에 붙는 아이콘 정의;;
	$face_image=get_face($reply_data);

// 바로 전에 본 글인 경우 번호를 아이콘으로 바꿈
	if($no==$reply_data['no']) $number="<img src=$dir/arrow.gif border=0 align=absmiddle>"; elseif($number!="&nbsp;") $number=$roop_number;

// 답글 버튼
	if(($is_admin||$member['level']<=$setup['grant_reply'])&&$reply_data['headnum']>-2000000000&&$reply_data['headnum']!=-1) $a_reply="<a href=write.php?$href$sort&no=$reply_data[no]&mode=reply>"; else $a_reply="<Zeroboard";
// 삭제버튼
	if(($is_admin||$member['level']<=$setup['grant_delete']||$reply_data['ismember']==$member['no']||!$reply_data['ismember'])&&!$reply_data['child']) $a_delete="<a href=delete.php?$href$sort&no=$reply_data[no]>"; else $a_delete="<Zeroboard";
// 수정버튼
	if(($is_admin||$member['level']<=$setup['grant_delete']||$reply_data['ismember']==$member['no']||!$reply_data['ismember'])) $a_modify="<a href=write.php?$href$sort&no=$reply_data[no]&mode=modify>"; else $a_modify="<Zeroboard";
?>
