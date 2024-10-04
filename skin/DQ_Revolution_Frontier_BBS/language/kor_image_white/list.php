<?php 
// 읽기권한
    $_strSkin['no_grant1'] = "읽기 권한이 없습니다.\n\n로그인 하시겠습니까?";
    $_strSkin['no_grant2'] = '읽기 권한이 없습니다.';

// 정렬버튼
	$str_no		= "번호";
	$str_hit	= "조회";
	$str_vote	= "추천";
	$str_date	= "등록일";
	$str_subj	= "제목";
	$str_name	= "글쓴이";
	$str_cate	= "분류";
	$str_cart	= "C";
	$str_file	= "파일";
	$str_notice	= "<img src=".$_lang_dir."notice_head.gif border=0>";
	if(!isset($a_no)) $a_no = '';
	if(!isset($a_hit)) $a_hit = '';
	if(!isset($a_date)) $a_date = '';
	if(!isset($a_name)) $a_name = '';
	if(!isset($a_1_prev_page)) $a_1_prev_page = '';
	if(!isset($a_1_next_page)) $a_1_next_page = '';
	if(!isset($a_prev_page)) $a_prev_page = '';
	if(!isset($a_next_page)) $a_next_page = '';
	if(!isset($print_page)) $print_page = '';
	$bt_no		= $a_no."<font class=title_text>$str_no</a>";
	$bt_hit		= $a_hit."<font class=title_text>$str_hit</a>";
	$bt_vote	= $a_vote."<font class=title_text>$str_vote</a>";
	$bt_date	= $a_date."<font class=title_text>$str_date</a>";
	$bt_subj	= $a_subj."<font class=title_text>$str_subj</a>";
	$bt_name	= $a_name."<font class=title_text>$str_name</a>";
	$bt_cate	= $a_cate."<font class=title_text>$str_cate</a>";
	$bt_cart	= $a_cart."<font class=title_text>$str_cart</a>";
	$bt_file	= "<font class=title_text style=cursor:default>$str_file";

// 메모아이콘
	if(eregi('_off.gif',$member_memo_icon)) $member_memo_icon = str_replace('/member_memo_off.gif','/'.$skin_setup['css_dir'].'member_memo_off.gif',$member_memo_icon);
	if(eregi('_on.gif',$member_memo_icon))  $member_memo_icon = str_replace('/member_memo_on.gif','/'.$skin_setup['css_dir'].'member_memo_on.gif',$member_memo_icon);
	$a_write_tmp = str_replace(">","><font class=han2 style=font-weight:bold>",$a_write);

// 로그인 관련 버튼
	$bt_login			= $a_login."[로그인"; if(!$group['use_join']) $bt_login = $bt_login."]"; $bt_login = $bt_login."</a>\n";
	$bt_member_join		= $a_member_join."회원가입]&nbsp;</a>\n";
	$bt_member_modify	= $a_member_modify."[정보수정</a>\n";
	$bt_bember_memo		= $a_member_memo."&nbsp;".$member_memo_icon."&nbsp;메모박스</a>\n";
	$bt_logout			= $a_logout."&nbsp;로그아웃]&nbsp;</a>\n";
	$bt_setup			= $a_setup."-게시판 설정&nbsp;</a>\n";

// 갤러리 설정 버튼
	$bt_skinsetup = "<b>-스킨설정</b>&nbsp;";

// 카테고리 "전체" 버튼
	if(!$category) $bt_c_list = "<a href=zboard.php?&id=$id><b>전체</b></a>";
	else $bt_c_list = "<a href=zboard.php?&id=$id>전체</a>";

// 글쓰기버튼
	if(!eregi("<Zeroboard",$a_write)) $bt_write=$a_write."<img src=".$_lang_dir."bt_write.gif border=0 align=absmiddle></a>";

// 목록 버튼
	if($view_once) $_strList = "<img src=".$_lang_dir."bt_list.gif border=0>"; else $_strList = "<img src=".$_lang_dir."bt_refresh.gif border=0>";
	$bt_list = $a_list.$_strList."</a>&nbsp;&nbsp;";

// 게시물정리
	if(!eregi("<Zeroboard",$a_delete_all)) $bt_delete_all = $a_delete_all."<img src=".$_lang_dir."bt_admin.gif border=0></a>&nbsp;&nbsp;";

// 이전페이지, 다음페이지
	if(!eregi("<Zeroboard",$a_1_prev_page)) $bt_1_prev_page = $a_1_prev_page."<img src=".$_lang_dir."bt_prev.gif border=0></a>&nbsp;&nbsp;";
	if(!eregi("<Zeroboard",$a_1_next_page)) $bt_1_next_page	= $a_1_next_page."<img src=".$_lang_dir."bt_next.gif border=0></a>&nbsp;&nbsp;";

// 이전 n개
	if(!eregi("<Zeroboard",$a_prev_page)) $bt_prev_page = $a_prev_page."<font class=thumb_list_page style=font-weight:normal>[이전 ".$setup['page_num']."개]</font></a>&nbsp;";
	if(!eregi("<Zeroboard",$a_next_page)) $bt_next_page = $a_next_page."<font class=thumb_list_page style=font-weight:normal>[다음 ".$setup['page_num']."개]</font></a>";

// 계속검색, 이전검색
	$print_page = str_replace("<font style=font-size:8pt>","<font class=han>",$print_page);
	$print_page = str_replace("계속 검색","<font class=han>계속 검색</font>",$print_page);
	$print_page = str_replace("이전 검색","<font class=han>계속 검색</font>",$print_page);
	$print_page = preg_replace("/>\[([0-9]+)\]</i",">&nbsp;\\1&nbsp;&nbsp;<", $print_page);
	$print_page = str_replace("</b>","</b>&nbsp;",$print_page);



//---- text ----------------------------------

	$_strSkin['search']		= '검색';
	$_strSkin['cancel']		= '취소';
	$_strSkin['category']	= '분류선택';
	$_strSkin['is_vdel']	= '--- 운영자에 의해 삭제되었습니다. ---';

?>
