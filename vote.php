<?php
/***************************************************************************
 * 공통파일 include
 **************************************************************************/
	include_once "_head.php";


/***************************************************************************
 * 설정 체크
 **************************************************************************/

// 사용권한 체크
	if($setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

// 현재글의 Vote수 올림;;
	if(empty($_SESSION['zb_vote'])) $_SESSION['zb_vote']='';
	if(!ereg($setup['no']."_".$no,$_SESSION['zb_vote'])) {
		zb_query("update $t_board"."_$id set vote=vote+1 where no='$no'");
		$vote_str =  "," . $setup['no']."_".$no;

		// 기존 세션 처리 (4.0x용 세션 처리로 인하여 주석 처리)	
		//$HTTP_SESSION_VARS['zb_vote'] = $HTTP_SESSION_VARS['zb_vote'] . $vote_str;

		// 4.0x 용 세션 처리
		$zb_vote = $_SESSION['zb_vote'] . $vote_str;
		session_register("zb_vote");
	}
	
	if(!isset($des)) $des='';

// 페이지 이동
	if($setup['use_alllist']) $temp_href="zboard.php"; else $temp_href="view.php";
	movepage("$temp_href?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&category=$category&no=$no"); 
?>
