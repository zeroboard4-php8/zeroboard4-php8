<?php

/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include_once "_head.php";

	if(!eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

/***************************************************************************
* 코멘트 삭제 진행
**************************************************************************/

// 패스워드를 암호화
	if(isset($_POST['password'])) {
		$password=get_password($_POST['password']);
	}
	
	if(!isset($_POST['password'])) $_POST['password']='';
	if(!isset($des)) $des='';
// 원본글을 가져옴
	$s_data=mysql_fetch_array(zb_query("select * from $t_comment"."_$id where no='$c_no'"));
	if(strlen($s_data['password'])<=16&&strlen(get_password("a"))>=41) $password=get_password($_POST['password'], true);

// 회원일때를 확인;;
	if(!$is_admin&&$member['level']>$setup['grant_delete']) {
		if(!$s_data['ismember']) {
			if($s_data['password']!=$password) Error("비밀번호가 올바르지 않습니다");
		} else {
			if($s_data['ismember']!=$member['no']) Error("비밀번호를 입력하여 주십시요");
		}
	}

// 코멘트 삭제
	zb_query("delete from $t_comment"."_$id where no='$c_no'") or error(zb_error());

// 코멘트 갯수 정리
	$total=mysql_fetch_array(zb_query("select count(*) from $t_comment"."_$id where parent='$no'"));
	zb_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'")  or error(zb_error()); 

// 회원일 경우 해당 해원의 점수 주기
	if(isset($member['no'])&&($member['no']==$s_data['ismember'])) zb_query("update $member_table set point2=point2-1 where no='$member[no]'",$connect) or error(zb_error());

// 페이지 이동
	if($setup['use_alllist']) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no");
	else movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no");
?>
