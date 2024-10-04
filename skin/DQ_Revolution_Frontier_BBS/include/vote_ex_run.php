<?php
if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

//스킨 환경설정 읽어오기
	include "skin/$setup[skinname]/get_config.php";

	$addPoint = !empty($_SS['write_nopoint']) ? 0 : $_SS['commentPointValue'];

// 엔진 가져오기
	$_inclib_01 = $dir."/include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
	else include_once $_inclib_01.'zend';

// 해당글이 있는 지를 검사
	$check = mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where no = '$no'", $connect));
	if(!$check[0]) Error("원본 글이 존재하지 않습니다.");
	
// 대상 파일 이름 정리
	if(!$setup['use_alllist']) $view_file_link="view.php"; else $view_file_link="zboard.php";

// 사용권한 체크
	if($setup['grant_comment']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&file=$view_file_link");

// 필드 검사
	$_chk = @mysql_field_name(zb_query("SELECT mother from `$t_comment"."_".$id."`"),0);
	if(!$_chk) {
		zb_query("ALTER TABLE `$t_board"."_comment"."_".$id."` ADD `mother` INT(1) NOT NULL DEFAULT 0, ADD `depth` INT(1) NOT NULL DEFAULT 0") or error(zb_error());
	}

// 각종 변수 검사;;
	if(!empty($memo_backup)) $memo = $memo_backup;
	$memo = !empty($_POST['memo']) ? str_replace("ㅤ","",$_POST['memo']) : '';
	$name = !empty($_POST['name']) ? $_POST['name'] : '';
	$password = !empty($_POST['password']) ? $_POST['password'] : '';
	$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
	$ment_type = !empty($_POST['ment_type']) ? $_POST['ment_type'] : '';
	$uniqNo = !empty($_POST['uniqNo']) ? $_POST['uniqNo'] : '';
	
	if(!empty($use_weditor) && $ment_type!="vote" && $ment_type!="remove_vote") {
		$chk_memo = trim(strip_tags($memo));
		if(!$chk_memo) Error("내용을 입력하셔야 합니다.");
	}
	if(empty($member['no'])) {
		if(isblank($name)) Error("이름을 입력하셔야 합니다");
		if(isblank($password)) Error("비밀번호를 입력하셔야 합니다");
	}

// 필터링;; 관리자가 아닐때;;
	if(empty($is_admin)&&$setup['use_filter']) {
		$filter=explode(",",$setup['filter']);

		$f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($memo));
		$f_name=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($name));
		$f_subject=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($subject));
		$f_email=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($email));
		$f_homepage=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($homepage));
		for($i=0;$i<count($filter);$i++) 
		if(!isblank($filter[$i])) {
			if(eregi($filter[$i],$f_memo)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(eregi($filter[$i],$f_name)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
		}
	}

// 원본 코멘트 글
    //if($ment_type == 'edit') $s_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where no='$c_no'"));

// 보안코드를 입력 받아야 할지 결정
    if($ment_type != 'edit' && !empty($_SS['using_secretCode'])) {
      if(!$member['no']) $need_secretCode = true;
      else {
        if($_SS['using_secretCodeValue1'] && $_SS['using_secretCodeValue1'] <= $member['level']) $need_secretCode = true;
        $_totalPoint = ($member['point1']*10) + $member['point2'];
        if($_SS['using_secretCodeValue2'] && $_SS['using_secretCodeValue2'] >= $_totalPoint ) $need_secretCode = true;
      }
    }

// 스팸방지 보안코드
    $captchaKey = 'captcha_keystring_'.$uniqNo;
    if(!empty($need_secretCode) && empty($_SESSION[$captchaKey])) die('Access Denied');
    if(!empty($need_secretCode) && $_SESSION[$captchaKey] != strtolower($_POST['secret_code'])){
		error('보안코드를 맞게 입력하세요.');
    }
    if(isset($_SESSION[$captchaKey])) unset($_SESSION[$captchaKey]);

// 회원등록이 되어 있을때 이름등을 가져옴;;
	if(!empty($member['no'])) {
		if($mode=="modify"&&$member['no']!=$s_data['ismember']) {
			$name=$s_data['name'];
		} else {
			$name=$member['name'];
		}
	}

// 패스워드를 암호화
	if(!empty($password)) {
		$password=get_password($password); 
	}

// 태그 삭제
	if(empty($use_weditor)) {
		$memo=del_html($memo);// 내용의 HTML 금지;;
	} else {
		$memo=str_replace("\n",'',$memo);
	}


// 각종 변수의 addslashes 시킴
	$name=addslashes(del_html($name));
	$memo=autolink($memo);
	$memo=addslashes($memo);

// 코멘트의 최고 Number 값을 구함 (중복 체크를 위해서)
	$max_no=mysql_fetch_array(zb_query("select max(no) from $t_comment"."_$id where parent='$no'"));

// 같은 내용이 있는지 검사;;
	$ment_check=false;
	if($ment_type!="vote" && $ment_type!="del") $ment_check=true;
	if($is_admin) $ment_check=false;
	if($ment_check) {
		$temp=mysql_fetch_array(zb_query("select count(*) from $t_comment"."_$id where memo='$memo' and no='$max_no[0]'"));
		if($temp[0]>0) Error("같은 내용의 글은 등록할수가 없습니다");
	}

// 각종 변수 설정
	$reg_date=time(); // 현재의 시간구함;;
	$parent=$no;

// 자추검사
	if ($ment_type=="vote") {
		$temp = mysql_fetch_array(zb_query("select ismember from $t_board"."_$id where no=$no "));
		if ($temp['ismember'] == $member['no']) {Error("자신의 게시물에는 추천할수 없습니다.");} // 자추 막기
		elseif(!$member['no']) {Error ("비회원은 추천하실수 없습니다.");} // 비회원 추천막기
	}

// 추천취소
	if ($ment_type=="remove_vote") {
		// 본인 검사
		$m_data=@mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$no'"));
		$m_data['vote_users'] = ereg_replace("\[^\\]'","\\'",$m_data['vote_users']);
		if(!eregi($member['no'],$m_data['vote_users'])) error("본인이 아닙니다.");

		// 추천인 목록에서 현재회원을 삭제
		$vote_users=str_replace("<".$member['no'].">".$member['name'],'',$m_data['vote_users']);
		zb_query("update dq_revolution set vote_users='$vote_users' where zb_id='$id' and zb_no='$no'") or error(zb_error());

		// 추천 게시물 목록에서 현재 게시물 삭제
		$vote_article=str_replace(",".$id." $no","",$member['vote_article']);
		zb_query("update $member_table set vote_article='$vote_article' where no='$member[no]'") or error(zb_error());

		// 현재글의 Vote수 내림;;
		zb_query("update $t_board"."_$id set vote=vote-1 where no='$no'");

        // 본문글 작성자에게 포인트 부여 설정시 포인트 차감
        if(!empty($_SS['using_addOwnerPoint'])) {
            $sdata = mysql_fetch_array(zb_query("select * from $t_board"."_$id where no = '$no'", $connect));
            if($sdata['ismember']) @zb_query("update $member_table set point2=point2-$addPoint where no='$sdata[ismember]'",$connect) or error(zb_error());
        }
	}

// 코멘트 입력
	if(!isblank($memo) && $ment_type != 'edit') 
    {
	// 코멘트 입력
		if(empty($member['no'])) $member['no']=null;
		if(empty($mother)) $mother=0;
		if(empty($depth)) $depth=0;
		zb_query("insert into $t_comment"."_$id (parent,ismember,name,password,memo,reg_date,ip,mother,depth) values ('$parent','$member[no]','$name','$password','$memo','$reg_date','$REMOTE_ADDR','$mother','$depth')") or error(zb_error());

	// 일정기간이 지난 게시물에 코멘트를 남겼을때 쪽지로 알림
		$s_data=mysql_fetch_array(zb_query("select no,reg_date,ismember,name,subject from $t_board"."_$id where no='$no'")) or error(zb_error());
		if(!empty($_SS['using_sendCommentMemo']) && $s_data['ismember'] && $s_data['ismember'] != $member['no']) {
			$limitday = $_SS['using_sendCommentMemo2'];
			$time_count = time()-(60*60*24*$limitday);
			if((isset($_SS['using_sendCommentMemo2']) && $limitday == 0) || (date('Ymd',$s_data['reg_date']) < date('Ymd',$time_count))) {
				$reg_date = time();
				$s_subj = $s_data['subject'];
				$subject = "짧은답글 알림 - $s_subj";
				$memo2 = "이 쪽지는 $s_data[name]님께서 작성한 게시물중 <b>".$limitday."일</b> 이상 경과한 게시물에 짧은 답글이 남겨졌을때 자동으로 통보되는 알림 메세지 입니다.<br>원본글의 주소는 <a href=view.php?id=$id&no=$no target=_blank>zboard.php?id=$id&no=$no</a> 입니다.<br><br>원본 글제목:<b>$s_subj</b><br>짧은답글을 남긴이: <b>".$name."</b><br>-------------남겨진 내용-------------<br><br>".$memo."<br><br><a href=view.php?id=$id&no=$no target=_blank><b>원본글 바로가기 (클릭)</b></a>";

				zb_query("insert into $get_memo_table (member_no,member_from,subject,memo,readed,reg_date) 							values ('$s_data[ismember]','1','$subject','$memo2',1,'$reg_date')") or error(zb_error());
				zb_query("insert into $send_memo_table (member_to,member_no,subject,memo,readed,reg_date) 							values ('$s_data[ismember]','1','$subject','$memo2',1,'$reg_date')") or error(zb_error());
				zb_query("update $member_table set new_memo=1 where no='$s_data[ismember]'") or error(zb_error());
			}
		}

	// 코멘트 갯수를 구해서 정리
		$total=mysql_fetch_array(zb_query("select count(*) from $t_comment"."_$id where parent='$no'"));
		zb_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'") or error(zb_error());


	// 회원일 경우 해당 회원의 점수 주기
		if ($addPoint && !empty($member['no']) && strlen($memo)>=$_SS['comment_nopoint2']) {
			@zb_query("update $member_table set point2=point2+$addPoint where no='$member[no]'",$connect) or error(zb_error());
			$already_point_add = 1;
		}

	}

// 코멘트 수정
	if(!isblank($memo) && $ment_type == 'edit') 
    {
        if(!$member['no']) {
            $s_comment = mysql_fetch_array(zb_query("select * from $t_comment"."_$id where no='$c_no'"));
            if($password!=$s_comment['password']) error("비밀번호를 틀렸습니다.");
        }
        update_comment($memo,$c_no);
    }

// 추천 처리 - 레볼루션
	if ($ment_type=="vote") {
	// 회원 테이블에 추천을 기록하기 위한 필드가 존제하는지 검사하고 없다면 생성
		@mysql_field_name(zb_query("SELECT vote_article from $member_table"),0) or zb_query("ALTER TABLE `$member_table` ADD `vote_article` TEXT");

		$m_data=@mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$no'"));
		if(empty($m_data['vote_users'])) $m_data['vote_users']='';
		$m_data['vote_users'] = ereg_replace("\[^\\]'","\\'",$m_data['vote_users']);
		$m_data['vote_users'] = ereg_replace("\[^\\]\"",'\"',$m_data['vote_users']);

	    //현재글의 Vote수 올림;;
		if(!ereg("<".$member['no'].">",$m_data['vote_users'])){
			zb_query("update $t_board"."_$id set vote=vote+1 where no='$no'");
		}
		else Error("이미 추천하셨습니다.");
		
		if(empty($member['vote_article'])) $member['vote_article']='';
		$vote_article=",".$id." ".$no.$member['vote_article'];
		$vote_users="<".$member['no'].">".addslashes($member['name']).$m_data['vote_users'];
		zb_query("update $member_table set vote_article='$vote_article' where no='$member[no]'") or error(zb_error());
		if(!empty($m_data['no'])) 
			zb_query("update dq_revolution set vote_users='$vote_users' where zb_id='$id' and zb_no='$no'") or error(zb_error());
		else zb_query("insert into dq_revolution (zb_id,zb_no,vote_users) values ('$id','$no','$vote_users')") or error(zb_error());

		// 회원점수 주기
		if($addPoint) {
			if(!$already_point_add) @zb_query("update $member_table set point2=point2+$addPoint where no='$member[no]'",$connect) or error(zb_error());
			if(!empty($_SS['using_addOwnerPoint'])) {
				$sdata = mysql_fetch_array(zb_query("select * from $t_board"."_$id where no = '$no'", $connect));
				if($sdata['ismember']) @zb_query("update $member_table set point2=point2+$addPoint where no='$sdata[ismember]'",$connect) or error(zb_error());
			}
		}


	// 적정 추천수 일 때 게시물 이동		
		$vote_count = mysql_fetch_array(zb_query("select vote, headnum from $t_board"."_$id where no='$no'"));
		if(!empty($_SS['move_vote']) && $vote_count['vote'] >= $_SS['move_vote2']) {
			$exec = $_SS['move_vote4'];
			$board_name = $_SS['move_vote3'];
			$org_no = $no;
			if($exec != 'move_all' && $vote_count['vote'] == $_SS['move_vote2']) {
				$tmp_no = move_zbArticle($id,$no,$board_name,$exec);
			}
			if($exec == 'move_all') {
				$tmp_no = move_zbArticle($id,$no,$board_name,$exec);
				$no = $tmp_no;
				$id = $board_name;
				@mysql_close($connect);

                revolution_cache_clear();
				movepage("$view_file_link?id=$id&no=$no");
			} else $no = $org_no;
		}
	}

// 최근 업데이트 시간 기록
	if(!isblank($memo)) {
      zb_query("update $t_board"."_$id set modify_date=".time()." where no='$no'") or die(zb_error());
    }

// 캐쉬처리
    revolution_cache_clear();

// 페이지 이동
	if($select_arrange=='modify_date') {
    	movepage("$view_file_link?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&category=$category&prev=$tprev&next=$tnext");
    } else {
    	movepage("$view_file_link?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&category=$category");
    }
?>
