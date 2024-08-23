<?php
if(intval($number)%2) {
	$listBg="class=\"ctl_list1\"";
}else{
	$listBg="class=\"ctl_list2\"";
}

// 코멘트 개수의 [ ] 없애고
$comment_num = str_replace("[","",$comment_num); 
$comment_num = str_replace("]","",$comment_num); 

// 코멘트 말풍선이미지 처리
if($comment_num){
$com_img = "<img src=\"$dir/images/iconReply.gif\" class=\"list_com_icon\" title=\"덧글\" alt=\"덧글\" />";
}else{
$com_img = "";}

// 오늘 올라온글 표시
if((date("d", $data['reg_date']) == date("d", time())) && (time()-$data['reg_date'] < 86400)) {
	$nIcon="<img src=\"$dir/images/new.gif\" class=\"list_n_icon\" title=\"오늘 등록된 글\" alt=\"오늘 등록된 글\" />";
} else {
	$nIcon="";
}

// 업로드한 파일이 이미지(확장자 검사)일때 리스트에 출력하기
 if(eregi("\.gif|\.png|\.bmp|\.jpg",$data['file_name1']) || eregi("\.gif|\.png|\.bmp|\.jpg",$data['file_name2'])) { 
		$list_image1 = "<img src=\"$dir/images/file_image.gif\" style=\"width:14px; height:13px; vertical-align:middle\" title=\"이미지\" alt=\"이미지\" /></a>";
		}
		else{
		$list_image1 = "";
		}
?>

	<tr <?=$listBg?>>
	<td class="ctl_nb"><?=$hide_cart_start?><input type="checkbox" name="cart" value="<?=$data['no']?>" /><?=$hide_cart_end?><?=$number?></td>
	<td class="ctl_sj"><?=$hide_category_start?><strong><?=$category_name?></strong> <?=$hide_category_end?><?=$insert?><?=$icon?><?=$subject?> <?=$com_img?><span class="list_com_sp"><?=$comment_num?></span> <?=$list_image1?><?=$nIcon?></td>
	<td class="ctl_name"><?=$name?></td>
	<td class="ctl_hit"><?=$hit?></td>
	<td class="ctl_date"><?=$date=date("n/d, g:i a",$data['reg_date'])?></td>
	</tr>
