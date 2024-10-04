<?php 
// 글쓰기버튼
	if(!empty($a_write) && eregi("a ",$a_write)) $bt_write=$a_write."<img src=".$_lang_dir."bt_write.gif border=0></a>";

// 목록 버튼
	$bt_list = $a_list."<img src=".$_lang_dir."bt_list.gif border=0></a>&nbsp;&nbsp;";

// 답글달기
	if(!empty($a_reply) && eregi("a ",$a_reply)) $bt_reply = $a_reply."<img src=".$_lang_dir."bt_re.gif border=0></a>&nbsp;&nbsp;";

// 수정하기	
	if(!empty($a_modify) && eregi("a ",$a_modify)) $bt_modify = $a_modify."<img src=".$_lang_dir."bt_edit.gif border=0></a>&nbsp;&nbsp;";

// 삭제하기
	if(!empty($a_delete) && eregi("a ",$a_delete)) $bt_delete = $a_delete."<img src=".$_lang_dir."bt_del.gif border=0></a>&nbsp;&nbsp;";

// 추천하기	
	if(!empty($a_vote) && eregi("a ",$a_vote)) $bt_vote = $a_vote."<img src=".$_lang_dir."bt_vote.gif border=0></a>&nbsp;&nbsp;";

// 이전사진, 다음사진
	$bt_vprev = $a_prev."◁ <font class=han2>이전사진</font></a>&nbsp;&nbsp;&nbsp;";
	$bt_iprev = "△ 이전글";
	$bt_vnext = $a_next."<font class=han2>다음사진</font> ▷</a>&nbsp;&nbsp;";
	$bt_inext = "▽ 다음글";

// 다운로드 버튼
    $bt_download = "<img src=".$_lang_dir."bt_download.gif border=0 align=absmiddle>";

//---- text ----------------------------------

	$_strSkin['exp_memo']		= '글칸크기 늘리기';
	$_strSkin['org_memo']		= '글칸크기 원래대로';
	$_strSkin['save_comment']	= $_lang_dir.'bt_comment_ok.gif';
	$_strSkin['save_commentEX']	= $_lang_dir.'bt_comment_EX.gif';
	$_strSkin['password']		= '<b class=han>비밀번호</b>';
	$_strSkin['name']			= '<b class=han>이름(별명)</b>';
	$_strSkin['vote']			= '<font class=thumb_han>이 사진을 추천</font>';
	$_strSkin['only_memo']		= '<font class=thumb_han>글만 남김</font>';
	$_strSkin['vote_cancel']	= '<font class=thumb_han>추천 취소</font>';
	$_strSkin['viewer_lvAlert']	= '로그인 하지 않았거나 열람 할 수 없는 회원레벨입니다.';
?>
