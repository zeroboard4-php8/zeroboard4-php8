<?php

/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
 	if(!isset($_view_included)) {include_once "_head.php";}

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

// 사용권한 체크
	if($setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&s_url=".urlencode($_SERVER['REQUEST_URI']));


// 현재 선택된 데이타가 있을때, 즉 $no 가 있을때 데이타 가져옴
	unset($data);
	$_dbTimeStart = getmicrotime();
	$data=mysql_fetch_array(zb_query("select * from  $t_board"."_$id  where no='$no'"));
	$_dbTime += getmicrotime()-$_dbTimeStart;

	if(empty($data['no'])) Error("선택하신 게시물이 존재하지 않습니다","zboard.php?$href$sort");

// 이전글과 이후글의 데이타를 구함;
	if(!$setup['use_alllist']) {	
		$_dbTimeStart = getmicrotime();
		if($data['prev_no']) $prev_data=mysql_fetch_array(zb_query("select * from  $t_board"."_$id  where no='$data[prev_no]'"));
		if($data['next_no']) $next_data=mysql_fetch_array(zb_query("select * from  $t_board"."_$id  where no='$data[next_no]'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
	}

// 모든 목록 보기가 아닐때 관련글을 모두 읽어옴;;
	if(!$setup['use_alllist']) {	
		$_dbTimeStart = getmicrotime();
		$check_ref=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where division='$data[division]' and headnum='$data[headnum]'"));
		if($check_ref[0]>1) $view_result=zb_query("select * from $t_board"."_$id  where division='$data[division]' and headnum='$data[headnum]' order by headnum desc,arrangenum");
		$_dbTime += getmicrotime()-$_dbTimeStart;
	}

// 간단한 답글의 데이타를 가지고옴;;
	$_dbTimeStart = getmicrotime();
	$view_comment_result=zb_query("select * from $t_comment"."_$id where parent='$no' order by no asc");
	$_dbTime += getmicrotime()-$_dbTimeStart;

// zboard.php에서 인크루드시 대상 위치를 zboard.php로 설정
	if(!isset($_view_included)) $target="view.php";
	else $target="zboard.php";

// 비밀글이고 패스워드가 틀리고 관리자가 아니면 에러 표시
	if(!isset($member['no'])) $member['no']=null;
	if($data['is_secret']&&!$is_admin&&$data['ismember']!=$member['no']&&$member['level']>$setup['grant_view_secret']) {
		if($member['no']) {
			$secret_check=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where headnum='$data[headnum]' and ismember='$member[no]'"));
			if(!$secret_check[0]) error("비밀글을 열람할 권한이 없습니다");
		} else {
			$password=zb_escape_string($_POST['password']);
			$password_new=get_password($password);
			$password=get_password($password,true);
			$secret_check=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where headnum='$data[headnum]' and password='$password_new'"));
			if(!$secret_check[0]&&strlen(get_password("a"))>=41) $secret_check=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where headnum='$data[headnum]' and password='$password'"));
			if(!$secret_check[0]) {
				head();
				$a_list="<a onfocus=blur() href='zboard.php?$href$sort'>";    
				$a_view="<Zeroboard ";
				$title="이 글은 비밀글입니다.<br>비밀번호를 입력하여 주십시요";
				$input_password="<input type=password name=password size=20 maxlength=20 class=input>";
				if(preg_match("/(:\/\/|\.\.)/",$dir)) $dir="./";
				include $dir."/ask_password.php";
				foot();
				exit();
			} else {
				$secret_str = $setup['no']."_".$no;
                $_SESSION['zb_s_check'] = $secret_str;
			}
		}
	}

// 현재글의 HIT수를 올림;;
	if(!isset($_SESSION['zb_hit'])) $_SESSION['zb_hit']='';
	if(strpos($_SESSION['zb_hit'],$setup['no']."_".$no) === false) {
		$_dbTimeStart = getmicrotime();
		zb_query("update $t_board"."_$id set hit=hit+1 where no='$no'");
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$hitStr=",".$setup['no']."_".$no;
		
		// 4.0x 용 세션 처리
		$zb_hit=$_SESSION['zb_hit'].$hitStr;
		$_SESSION['zb_hit'] = $zb_hit;
	}

// 이전글 정리
	if($data['prev_no']&&!$setup['use_alllist']&&!empty($prev_data)) {
		$prev_comment_num="[".$prev_data['total_comment']."]"; // 간단한 답글 수
		if($prev_data['total_comment']==0) $prev_comment_num="";
		$a_prev="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[prev_no]'>";
		$prev_subject=$prev_data['subject']=stripslashes($prev_data['subject'])." ".$prev_comment_num;
		$prev_name=$prev_data['name']=stripslashes($prev_data['name']);
		$prev_data['email']=stripslashes($prev_data['email']);

		$temp_name = get_private_icon($prev_data['ismember'], "2");
		if($temp_name) $prev_name="<img src='$temp_name' border=0 align=absmiddle>";

		if(!isset($show_ip)) $show_ip = '';
		if(!isset($next_email)) $next_email = '';
		if(!isset($prev_email)) $prev_email = '';
		if($setup['use_formmail']&&check_zbLayer($prev_data)) {
			$prev_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible')\" style=cursor:hand>$prev_name</span>";
		} else {
			if($prev_data['ismember']) $prev_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$prev_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$prev_name</a>";
			else $prev_name="<div $show_ip>$prev_name</div>";
		}

		$prev_hit=stripslashes($prev_data['hit']);
		$prev_vote=stripslashes($prev_data['vote']);
		$prev_reg_date="<span title='".date("Y/m/d H:i:d",$prev_data['reg_date'])."'>".date("Y/m/d",$prev_data['reg_date'])."</span>";

		if(!isBlank($prev_email)||$prev_data['ismember']) {
			if(!$setup['use_formmail']) $a_prev_email="<a onfocus=blur() href='mailto:$prev_email'>";
			else $a_prev_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$prev_email&id=$id&member_no=$prev_data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))\">";
			$prev_name=$a_prev_email.$prev_name."</a>";
		} 

		$prev="";
		$prev_icon=get_icon($prev_data);

		// 이름앞에 붙는 아이콘 정의;;
		$prev_face_image=get_face($prev_data);

		// 스팸 메일러 금지용
		$prev_mail=$prev_data['email']="";
		$a_prev_email="<Zeroboard ";
		$hide_prev_start='';
		$hide_prev_end='';
	} else {
		$hide_prev_start="<!--";
		$hide_prev_end="-->";
	}

// 다음글 정리
	if($data['next_no']&&!$setup['use_alllist']&&!empty($next_data)) {
		$a_next="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[next_no]'>";
		$next_comment_num="[".$next_data['total_comment']."]"; // 간단한 답글 수
		if($next_data['total_comment']==0) $next_comment_num="";
		$next_subject=$next_data['subject']=stripslashes($next_data['subject'])." ".$next_comment_num;
		$next_name=$next_data['name']=stripslashes($next_data['name']);
		$next_data['email']=stripslashes($next_data['email']);

		$temp_name = get_private_icon($next_data['ismember'], "2");
		if($temp_name) $next_name="<img src='$temp_name' border=0 align=absmiddle>";
		
		if(!isset($show_ip)) $show_ip = '';
		if(!isset($next_email)) $next_email = '';
		if($setup['use_formmail']&&check_zbLayer($next_data)) {
			$next_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible')\" style=cursor:hand>$next_name</span>";
		} else {
			if($next_data['ismember']) $next_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$next_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$next_name</a>";
			else $next_name="<div $show_ip>$next_name</div>";
		}
		
		$next_hit=stripslashes($next_data['hit']);
		$next_vote=stripslashes($next_data['vote']);
		$next_reg_date="<span title='".date("Y/m/d H:i:d",$next_data['reg_date'])."'>".date("Y/m/d",$next_data['reg_date'])."</span>";
		if(!isBlank($next_email)||$next_data['ismember']) {
			if(!$setup['use_formmail']) $a_next_email="<a onfocus=blur() href='mailto:$next_email'>";
			else $a_next_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$next_email&id=$id&member_no=$next_data[ismember]','mailform','width=400,height=500,statusbar=noscrollbars=yes,toolbar=no'))\">";
			$next_name=$a_next_email.$next_name."</a>";
		}

		$next_icon=get_icon($next_data);

		// 이름앞에 붙는 아이콘 정의;;
		$next_face_image=get_face($next_data);

		// 스팸 메일러 금지용
		$next_mail=$next_data['email']="";
		$a_next_email="<Zeroboard ";
		$hide_next_start='';
		$hide_next_end='';
	} else {
		$hide_next_start="<!--";
		$hide_next_end="-->";
	}


// 현재 선택된 글을 정리함
	list_check($data,1);

/****************************************************************************************
 * 변수 설정
 ***************************************************************************************/

// 글보기에서 쓰는 변수 수정
	$subject=$data['subject'];
	if($data['homepage']) $a_homepage="<a onfocus=blur() href='$data[homepage]' target=_blank>"; else $a_homepage="<Zetx"; // 홈페이지 주소 링크


/****************************************************************************************
 * 버튼 정리
 ***************************************************************************************/
	if(!isset($sn1)) $sn1 = '';
// 메일주소가 있으면 이름에 메일 링크
	if(!isBlank($email)||$data['ismember']) {
		if(!$setup['use_formmail']) $a_email="<a onfocus=blur() href='mailto:$email'>";
		else $a_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))\">";
	} else $a_email="<Zeroboard ";

// 글쓰기버튼
	if($is_admin||$member['level']<=$setup['grant_write']) $a_write="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=write&sn1=$sn1'>"; else $a_write="<Zeroboard ";

// 답글 버튼
	if(($is_admin||$member['level']<=$setup['grant_reply'])&&$no&&$data['headnum']>-2000000000) $a_reply="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=reply&sn1=$sn1'>"; else $a_reply="<Zeroboard ";

// 목록 버튼
	if($is_admin||$member['level']<=$setup['grant_list']) $a_list="<a onfocus=blur() href='zboard.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&prev_no=$no&sn1=$sn1&divpage=$divpage&select_arrange=$select_arrange&desc=$desc'>"; else $a_list="<Zeroboard  ";

// 취소버튼
	$a_cancel="<a onfocus=blur() href='{$_SERVER['PHP_SELF']}?id=$id'>";

// 삭제버튼
	if(($is_admin||$member['level']<=$setup['grant_delete']||$data['ismember']==$member['no']||!$data['ismember'])&&!$data['child']) $a_delete="<a onfocus=blur() href='delete.php?$href$sort&no=$no'>"; else $a_delete="<Zeroboard ";

// 수정버튼
	if(($is_admin||$member['level']<=$setup['grant_delete']||$data['ismember']==$member['no']||!$data['ismember'])&&$no) $a_modify="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=modify'>"; else $a_modify="<Zeroboard ";

// 파일링크
	if(!empty($file_name1)) $a_download1="<a onfocus=blur() href='download.php?$href$sort&no=$no&file=1'>"; else $a_download1="<Zeroboard ";
	if(!empty($file_name2)) $a_download2="<a onfocus=blur() href='download.php?$href$sort&no=$no&file=2'>"; else $a_download2="<Zeroboard ";

// 추천버튼
	$votechk = isset($_SESSION['zb_vote']) ? $_SESSION['zb_vote'] : '';
	if(strpos($votechk,$setup['no']."_".$no) === false) $a_vote="<a onfocus=blur() href='vote.php?$href$sort&no=$no'>";
	else $a_vote = "<Zeroboard ";

// 사이트 링크를 나타나게 하는 변수;;
	if(empty($sitelink1)) {$hide_sitelink1_start="<!--";$hide_sitelink1_end="-->";} else {$hide_sitelink1_start='';$hide_sitelink1_end='';}
	if(empty($sitelink2)) {$hide_sitelink2_start="<!--";$hide_sitelink2_end="-->";} else {$hide_sitelink2_start='';$hide_sitelink2_end='';}

// 파일 다운로드를 나타나게 하는 변수;;
	if(empty($file_name1)) {$hide_download1_start="<!--";$hide_download1_end="-->";} else {$hide_download1_start='';$hide_download1_end='';}
	if(empty($file_name2)) {$hide_download2_start="<!--";$hide_download2_end="-->";} else {$hide_download2_start='';$hide_download2_end='';}
 
// 홈페이지를 나타나게 하는 변수
	if(empty($data['homepage'])) {$hide_homepage_start="<!--";$hide_homepage_end="-->";} else {$hide_homepage_start='';$hide_homepage_end='';}

// E-MAIL 을 나타나게 하는 변수
	if(empty($data['email'])) {$hide_email_start="<!--";$hide_email_end="-->";} else {$hide_email_start='';$hide_email_end='';}
 
// 코멘트를 안 보이게 하는 변수;;
	if(empty($setup['use_comment']))
	{$hide_comment_start='<!--'; $hide_comment_end='-->';}
	else {$hide_comment_start=''; $hide_comment_end='';}

// 회원로그인이 되어 있으면 코멘트 비밀번호를 안 나타나게;;
	$_SESSION['zb_writer_name'] = isset($_SESSION['zb_writer_name']) ? $_SESSION['zb_writer_name'] : '';
	if($member['no']) {
		$c_name=$member['name']; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; 
		$temp_name = get_private_icon($member['no'], "2");
		if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>";
		$temp_name = get_private_icon($member['no'], "1");
		if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>".$c_name;
	} else $c_name="<input type=text name=name size=8 maxlength=10 class=input value=\"".$_SESSION['zb_writer_name']."\">";


/****************************************************************************************
 * 실제 출력 부분
 ***************************************************************************************/
// 헤더 출력
	if(!isset($_view_included)) head();

// 상단 현황 부분 출력 
	if(!isset($_view_included)) {
		$_skinTimeStart = getmicrotime();
		include "$dir/setup.php";
		$_skinTime = isset($_skinTime) ? $_skinTime+(getmicrotime()-$_skinTimeStart) : getmicrotime()-$_skinTimeStart;
	}


// 내용보기 출력
	$_skinTimeStart = getmicrotime();
	include $dir."/view.php";
	if(!isset($_skinTime)) $_skinTime = getmicrotime()-$_skinTimeStart;
	$_skinTime += getmicrotime()-$_skinTimeStart;

// 코멘트 출력;;
	if($setup['use_comment']) {
		while($c_data=mysql_fetch_array($view_comment_result)) {
			$comment_name=stripslashes($c_data['name']);
			$temp_name = get_private_icon($c_data['ismember'], "2");
			if($temp_name) $comment_name="<img src='$temp_name' border=0 align=absmiddle>";
			$c_memo=trim(stripslashes($c_data['memo']));
			$c_reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초",$c_data['reg_date'])."'>".date("Y/m/d",$c_data['reg_date'])."</span>";
			if($c_data['ismember']) {
				if($c_data['ismember']==$member['no']||$is_admin||$member['level']<=$setup['grant_delete']) $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";
				else $a_del="&nbsp;<Zeroboard ";
			} else $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";

			// 이름앞에 붙는 아이콘 정의;;
			$c_face_image=get_face($c_data);

			if($is_admin) $show_ip=" title='$c_data[ip]' "; else $show_ip="";    

			if($setup['use_formmail']&&check_zbLayer($c_data)) {
				$comment_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible')\" style=cursor:hand>$comment_name</span>";
			} else {
				if($c_data['ismember']) $comment_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$c_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$comment_name</a>";
				else $comment_name="<div $show_ip>$comment_name</div>";
			}

			$_skinTimeStart = getmicrotime();
			include $dir."/view_comment.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;
			flush();
		}
		if($member['level']<=$setup['grant_comment']) {
			if(!isset($hide_c_password_start)) $hide_c_password_start = '';
			if(!isset($hide_c_password_end)) $hide_c_password_end = '';
			if(!isset($mode)) $mode = '';
			$_skinTimeStart = getmicrotime();
			include "$dir/view_write_comment.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;
		}
	}

// 위, 아래글 출력, 코멘트, 버튼 출력
	$_skinTimeStart = getmicrotime();
	include $dir."/view_foot.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;

// 관련글을 출력
	if(isset($check_ref)) {
		if($check_ref[0]>1) {

			$_skinTimeStart = getmicrotime();
			include "$dir/view_list_head.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;

			while($data=mysql_fetch_array($view_result)) {
				// 데이타 정렬
				list_check($data);

				if($data['no']==$no) $number="<img src=$dir/arrow.gif border=0>"; else $number="&nbsp;";
	
				// 목록을 출력하는 부분
				$_skinTimeStart = getmicrotime();
				include $dir."/view_list_main.php";
				$_skinTime += getmicrotime()-$_skinTimeStart;
			}

			$_skinTimeStart = getmicrotime();
			include "$dir/view_list_foot.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;
		}
	}
	

// layer 출력
 	if($zbLayer&&!isset($_view_included)) {
		$_skinTimeStart = getmicrotime();
		echo "\n<script>".$zbLayer."\n</script>";
		$_skinTime += getmicrotime()-$_skinTimeStart;
		unset($zbLayer);
	}

// 마지막 부분 출력
	if(!isset($_view_included)) foot();

/***************************************************************************
 * 마무리 부분 include
 **************************************************************************/
	if(!isset($_view_included)) { 
		$_skinTimeStart = getmicrotime();
		include "_foot.php"; 
		$_skinTime += getmicrotime()-$_skinTimeStart;
	}

?>
