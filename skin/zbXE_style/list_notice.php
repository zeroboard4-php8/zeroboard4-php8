<?php
// 코멘트 개수의 [ ] 없애고
$comment_num = str_replace("[","",$comment_num); 
$comment_num = str_replace("]","",$comment_num); 

// 코멘트 말풍선 처리
if($comment_num){
$com_img = "<img src=\"$dir/images/iconReply.gif\" class=\"list_com_icon\" title=\"덧글\" alt=\"덧글\" />";
}else{
$com_img = "";}
?>

	<tr class="ctl_listN">
	<td class="ctl_nbN">공지</td>
	<td class="ctl_sj"><?=$insert?><?=$subject?> <?=$com_img?><span class="list_com_sp"><?=$comment_num?></span></td>
	<td class="ctl_name"><?=$name?></td>
	<td class="ctl_hit"><?=$hit?></td>
	<td class="ctl_date"><?=$date=date("n/d, g:i a",$data['reg_date'])?></td>
	</tr>
