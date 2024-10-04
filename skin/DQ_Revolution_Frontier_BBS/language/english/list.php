<?php 
// 읽기권한
    $_strSkin['no_grant1'] = "읽기 권한이 없습니다.\n\n로그인 하시겠습니까?";
    $_strSkin['no_grant2'] = '읽기 권한이 없습니다.';

// 정렬버튼
	$str_no		= "no";
	$str_hit	= "hit";
	$str_vote	= "vote";
	$str_date	= "date";
	$str_subj	= "subject";
	$str_name	= "name";
	$str_cate	= "category";
	$str_cart	= "C";
	$str_notice	= "<b style=font-size:8pt;font-family:tahoma>N</b>";
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

// 메모아이콘
	if(eregi('_off.gif',$member_memo_icon)) $member_memo_icon = str_replace('/member_memo_off.gif','/'.$skin_setup['css_dir'].'member_memo_off.gif',$member_memo_icon);
	if(eregi('_on.gif',$member_memo_icon))  $member_memo_icon = str_replace('/member_memo_on.gif','/'.$skin_setup['css_dir'].'member_memo_on.gif',$member_memo_icon);
	$a_write_tmp = str_replace(">","><font class=han2 style=font-weight:bold>",$a_write);

// 로그인 관련 버튼
	$bt_login			= $a_login."[login"; if(!$group['use_join']) $bt_login = $bt_login."]"; $bt_login = $bt_login."</a>\n";
	$bt_member_join		= $a_member_join."join]&nbsp;</a>\n";
	$bt_member_modify	= $a_member_modify."[my info</a>\n";
	$bt_bember_memo		= $a_member_memo."&nbsp;".$member_memo_icon."&nbsp;memo</a>\n";
	$bt_logout			= $a_logout."&nbsp;logout]&nbsp;</a>\n";
	$bt_setup			= $a_setup."-board setup&nbsp;</a>\n";

// 갤러리 설정 버튼
	$bt_skinsetup = "<b>-skin setup</b>&nbsp;";

// 카테고리 "전체" 버튼
	if(!$category) $bt_c_list = "<a href=zboard.php?&id=$id><b>all list</b></a>";
	else $bt_c_list = "<a href=zboard.php?&id=$id>all list</a>";

// 글쓰기버튼
	if(!eregi("<Zeroboard",$a_write)) $bt_write=$a_write."<font class=han2 style='font-weight:bold'>".$skin_setup['write_buttonName']."</font></a>";

// 목록 버튼
	if($view_once) $_strList = "-list"; else $_strList = "-refresh";
	$bt_list = $a_list."<font class=han style=font-weight:bold>".$_strList."</font></a>&nbsp;&nbsp;";

// 게시물정리
	if(!eregi("<Zeroboard",$a_delete_all)) $bt_delete_all = $a_delete_all."<font class=han style='font-weight:bold'>-admin</font></a>&nbsp;&nbsp;";

// 이전페이지, 다음페이지
	if(!eregi("<Zeroboard",$a_1_prev_page)) $bt_1_prev_page = $a_1_prev_page."<font class=han style=font-weight:bold>-prev page</font></a>&nbsp;&nbsp;";
	if(!eregi("<Zeroboard",$a_1_next_page)) $bt_1_next_page	= $a_1_next_page."<font class=han style=font-weight:bold>-next page</font></a>&nbsp;&nbsp;";

// 이전 n개
	if(!eregi("<Zeroboard",$a_prev_page)) $bt_prev_page = $a_prev_page."<font class=thumb_list_page style=font-weight:normal>[prev ".$setup['page_num']."]</font></a>&nbsp;";
	if(!eregi("<Zeroboard",$a_next_page)) $bt_next_page = $a_next_page."<font class=thumb_list_page style=font-weight:normal>[next ".$setup['page_num']."]</font></a>";

// 계속검색, 이전검색
	$print_page = str_replace("<font style=font-size:8pt>","<font class=han>",$print_page);
	$print_page = str_replace("계속 검색","<font class=han>Search Continue</font>",$print_page);
	$print_page = str_replace("이전 검색","<font class=han>Search Continue</font>",$print_page);
	$print_page = preg_replace("/>\[([0-9]+)\]</i",">&nbsp;\\1&nbsp;&nbsp;<", $print_page);
	$print_page = str_replace("</b>","</b>&nbsp;",$print_page);



//---- text ----------------------------------

	$_strSkin['search']		= 'Search';
	$_strSkin['cancel']		= 'Cancel';
	$_strSkin['is_vdel']	= '--- 운영자에 의해 삭제되었습니다. ---';
?>
