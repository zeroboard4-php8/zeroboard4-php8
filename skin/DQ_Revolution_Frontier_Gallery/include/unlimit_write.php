<?php
if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

// 스킨 환경설정 파일 include
	$_put_css = '1';
	require 'skin/'.$setup['skinname'].'/get_config'.'.php';

// 편법을 이용한 글쓰기 방지
	$mode = $_POST['mode'];
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error('정상적으로 글을 작성하여 주시기 바랍니다.');
	if(getenv("REQUEST_METHOD") == 'GET' ) Error('정상적으로 글을 쓰시기 바랍니다','');
	if(!$mode) $mode = 'write';

// 설정
	//if(!$skin_setup['using_preview_img']) $use_thumbimg = '';
	if($notice) $skin_setup['using_market'] = false; // 공지글일 경우 장터기능 해제

// 구형 PHP서버의 호환성을 위한 처리
	if (substr(phpversion(),0,5) < '4.1.0') 
    {
      $_FILES  = $HTTP_POST_FILES;
      $_POST   = $HTTP_POST_VARS;
      $_GET    = $HTTP_GET_VARS;
	  $_SERVER = $HTTP_SERVER_VARS;
    }

// 필드 검사
    $_chk = @mysql_field_name(zb_query("SELECT modify_date from $t_board"."_$id"),0);
    if(!$_chk) {
        zb_query("ALTER TABLE `$t_board"."_$id` ADD `modify_date` INT(1)") or error(zb_error());
        zb_query("update $t_board"."_$id set modify_date=reg_date where modify_date < 1") or error(zb_error());
    }

// 사용권한 체크
	if($mode=="reply"&&$setup['grant_reply']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&file=zboard.php");
	if($mode!="reply"&&$setup['grant_write']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no&file=zboard.php");

	if(!$is_admin&&$setup['grant_notice']<$member['level']) $notice = 0;
	
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$homepage = isset($_POST['homepage']) ? $_POST['homepage'] : null;
	$category = isset($_POST['category']) && is_numeric($_POST['category']) ? $_POST['category'] : null;
	$subject = isset($_POST['subject']) ? str_replace('ㅤ','',$_POST['subject']) : null;
	$memo = isset($_POST['memo']) ? str_replace('ㅤ','',$_POST['memo']) : null;
	$memo2 = isset($_POST['memo2']) ? str_replace('ㅤ','',$_POST['memo2']) : null;
	$sitelink1 = isset($_POST['sitelink1']) ? str_replace('ㅤ','',$_POST['sitelink1']) : null;
	$sitelink2 = isset($_POST['sitelink2']) ? str_replace('ㅤ','',$_POST['sitelink2']) : null;
	$use_html = isset($_POST['use_html']) && in_array($_POST['use_html'], array('0','1')) ? $_POST['use_html'] : '0';
	$reply_mail = isset($_POST['reply_mail']) && in_array($_POST['reply_mail'], array('0','1')) ? $_POST['reply_mail'] : '0';
	$is_secret = isset($_POST['is_secret']) && in_array($_POST['is_secret'], array('0','1')) ? $_POST['is_secret'] : '0';
	$del_file1 = isset($_POST['del_file1']) && in_array($_POST['del_file1'], array('0','1')) ? $_POST['del_file1'] : null;
	$del_file2 = isset($_POST['del_file2']) && in_array($_POST['del_file2'], array('0','1')) ? $_POST['del_file2'] : null;
	$is_vdel = isset($_POST['is_vdel']) && in_array($_POST['is_vdel'], array('0','1')) ? $_POST['is_vdel'] : '0';

// 원본글을 가져옴
	unset($s_data);
	$s_data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));
	unset($m_data);
	$m_data=mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$no'"));

// 장터기능 사용시
	if(!empty($skin_setup['using_market']) && $mode == 'modify') {
		$memo = $s_data['memo'];
		$subject = $s_data['subject'];
		$sitelink1 = $s_data['sitelink1'];
		$sitelink2 = $s_data['sitelink2'];
		$name = $s_data['name'];
		$email = $s_data['email'];
		$homepage = $s_data['homepage'];

		if($s_data['category'] == $category && isblank($memo2)) Error("추가내용을 입력하셔야 합니다");
	}

// 각종 변수 검사;;
	if(!isset($member['no'])) {
		$name = isset($_POST['name']) ? str_replace('ㅤ','',$_POST['name']) : null;
		$password = isset($_POST['password']) ? str_replace('ㅤ','',$_POST['password']) : null;
		if(isblank($name)) Error('이름을 입력하셔야 합니다');
		if(isblank($password)) Error('비밀번호를 입력하셔야 합니다');
		$member['is_admin'] = '0';
	} elseif(!(!empty($_SS['inputPWD_mbSecretArticle']) && $is_secret)) {
		$password = $member['password'];
	}

	if(!empty($_SS['inputPWD_mbSecretArticle']) && $is_secret && isblank($password)) Error("비밀번호를 입력하셔야 합니다");

	$subject = str_replace("ㅤ","",$subject);
	$memo = str_replace("ㅤ","",$memo);

	if(!empty($skin_setup['using_market']) && $mode == 'modify') $skin_setup['using_emptyArticle'] = '1';

	if(empty($skin_setup['using_emptyArticle'])) {
		if(isblank($subject)) Error("제목을 입력하셔야 합니다");
		if(empty($use_weditor) && isblank($memo)) {
			Error("내용을 입력하셔야 합니다.");
		}
		if(!empty($use_weditor)) {
			$chk_memo = trim(strip_tags($memo));
			if(!$chk_memo) Error("내용을 입력하셔야 합니다.");
		}
	}

	if(!$category) {
		$cate_temp=mysql_fetch_array(zb_query("select min(no) from $t_category"."_$id",$connect));
		$category=$cate_temp[0];
	}

// 필터링;; 관리자가 아닐때;;
	if(!$is_admin&&$setup['use_filter']) {
		$filter=explode(",",$setup['filter']);
		$f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($memo));
		$f_name=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($name));
		$f_subject=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($subject));
		$f_email=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($email));
		$f_homepage=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($homepage));
		for($i=0;$i<count($filter);$i++) {
			if(!isblank($filter[$i])) {
				if(eregi($filter[$i],$f_memo)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
				if(eregi($filter[$i],$f_name)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
				if(eregi($filter[$i],$f_subject)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
				if(eregi($filter[$i],$f_email)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
				if(eregi($filter[$i],$f_homepage)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			}
		}
	}

//패스워드를 암호화
    if($mode=='modify' && $is_admin && $s_data['ismember'] != $member['no']) 
    { // 관리자가 다른사람의 비밀글 수정시 비밀번호 변경 안되게
      $password = $s_data['password'];
    } elseif(isset($password)) {
		$password=get_password($password);
	}

// 관리자이거나 HTML허용레벨이 낮을때 태그의 금지유무를 체크
	if(!empty($use_weditor) && !empty($use_html)) {
		$memo=str_replace("\n",'',$memo);
	}
	if(empty($use_weditor) && !$is_admin&&$setup['grant_html']<$member['level']) {

		// 내용의 HTML 금지;;
		if(!$use_html||$setup['use_html']==0) $memo=del_html($memo);

		// HTML의 부분허용일때;;
		if($use_html&&$setup['use_html']==1) {
			$memo=str_replace("<","&lt;",$memo);
			$tag=explode(",",$setup['avoid_tag']);
			for($i=0;$i<count($tag);$i++) {
				$tag[$i] = trim($tag[$i]);
				if(!isblank($tag[$i])) { 
					$memo=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo); 
					$memo=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo); 
					$memo=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo); 
				}
			}  
		}
	} elseif(empty($use_weditor) && empty($use_html)) {
		$memo=del_html($memo);
	}


// 원본글을 이용한 비교
	if($mode=="modify"||$mode=="reply") {
		if(!$s_data['no']) Error("원본글이 존재하지 않습니다");
	}

// 공지글에는 답글이 안 달리게 처리
	if($mode=="reply"&&$s_data['headnum']<=-2000000000) Error("공지글에는 답글을 달수 없습니다");


// 회원등록이 되어 있을때 이름등을 가져옴;;
	if(!empty($member['no'])) {
		if($mode=="modify"&&$member['no']!=$s_data['ismember']) {
			$name=$s_data['name'];
			$email=$s_data['email'];
			$homepage=$s_data['homepage'];
		} else {
			$name=$member['name'];
			$email=$member['email'];
			$homepage=$member['homepage'];
		}
	}

// 보안코드를 입력 받아야 할지 결정
    if($mode!='modify' && !empty($_SS['using_secretCode'])) {
      if(!$member['no']) $need_secretCode = true;
      else {
        if($_SS['using_secretCodeValue1'] && $_SS['using_secretCodeValue1'] <= $member['level']) $need_secretCode = true;
        $_totalPoint = ($member['point1']*10) + $member['point2'];
        if($_SS['using_secretCodeValue2'] && $_SS['using_secretCodeValue2'] >= $_totalPoint ) $need_secretCode = true;
      }
    }

// 스팸방지 보안코드
    $uniqNo = !empty($_POST['uniqNo']) ? $_POST['uniqNo'] : '';
    $captchaKey = 'captcha_keystring_'.$uniqNo;
    if(!empty($need_secretCode) && empty($_SESSION[$captchaKey])) die('Access Denied');
    if(!empty($need_secretCode) && !empty($_SESSION[$captchaKey]) != strtolower($_POST['secret_code'])){
		error('보안코드를 맞게 입력하세요.');
    }
    if(isset($_SESSION[$captchaKey])) unset($_SESSION[$captchaKey]);

// 각종 변수를 addslashes 시킴;;
	$name=addslashes(del_html($name));
	if(($is_admin||$member['level']<=$setup['use_html'])&&$use_html) $subject=addslashes($subject);
	else $subject=addslashes(del_html($subject));
	$memo=addslashes($memo);
	if($use_html<2) {
		$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
		$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
	}	
	$sitelink1=addslashes(del_html($sitelink1));
	$sitelink2=addslashes(del_html($sitelink2));
	$email=addslashes(del_html($email));
	$homepage=addslashes(del_html($homepage));

// 파일설명을 분해하고 addslashes 시킴;;
    if(empty($file_virtName)) {
      unset($file_descript);
	  $file_descript = '';
      if(!empty($use_descript_z1)) $file_descript = "[use]";
      if(!empty($descript_z1)) $file_descript .= addslashes(del_html($descript_z1));
      $file_descript .= "||";
      if(!empty($use_descript_z2)) $file_descript .= "[use]";
      if(!empty($descript_z2)) $file_descript .= addslashes(del_html($descript_z2));

      for($i=0; $i<99; $i++) {
          $chk_use = "use_descript_$i";
          $file_descript .= "||";
          $tmp = "descript_$i";
          if(!empty($$chk_use) && !empty($$tmp)) {
              $file_descript .= "[use]";
              $file_descript .= addslashes(strip_tags($$tmp));
          }
      }
      if(strlen($file_descript) <= 200) $file_descript = "";
    } else {
      $tmp = explode(',',$file_descript);
      $len = count($tmp);
      for($i=0; $i<$len; $i++) {
        $tmp[$i] = addslashes(strip_tags($tmp[$i]));
      }
      $file_descript = implode(',',$tmp);
    }

// 홈페이지 주소의 경우 http:// 가 없으면 붙임
	if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

// 각종 변수 설정
	$ip=$REMOTE_ADDR; // 아이피값 구함;;
	$reg_date=time(); // 현재의 시간구함;;

	$x = !empty($zx) ? $zx : null;
	$y = !empty($zy) ? $zy : null;

//스킨 설정을 가져옴
	require "skin/".$setup['skinname']."/get_config.php";

//게시물 등록 제한
	require "skin/".$setup['skinname']."/include/write_limit.php";

if($skin_setup['using_attacguard']) {
	// 도배인지 아닌지 검사;; 우선 같은 아이피대에 30초이내의 글은 도배로 간주;;
		if(!$is_admin&&$mode!="modify") {
			$max_no=mysql_fetch_array(zb_query("select max(no) from $t_board"."_$id"));
			$temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where ip='$ip' and $reg_date - reg_date <30 and no='$max_no[0]'"));
			if($temp[0]>0) {Error("글등록은 30초이상이 지나야 가능합니다"); exit;}
		}

	// 같은 내용이 있는지 검사;;
		if(!$is_admin&&$mode!="modify") {
			$max_no=mysql_fetch_array(zb_query("select max(no) from $t_board"."_$id"));
			$temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where memo='$memo' and no='$max_no[0]'"));
			if($temp[0]>0) {Error("같은 내용의 글은 등록할수가 없습니다"); exit; }
		}
}



// 쿠키 설정;;
	if($mode!="modify") {
		if($name) {
			$zb_writer_name = $name;
			$_SESSION['zb_writer_name'] = $zb_writer_name;
		}
		if($email) {
			$zb_writer_email = $email;
			$_SESSION['zb_writer_email'] = $zb_writer_email;
		}
		if($homepage) {
			$zb_writer_homepage = $homepage;
			$_SESSION['zb_writer_homepage'] = $zb_writer_homepage;
		}
	}

//글쓰기 완료 & DB에 데이터 입력
    $_inclib_01 = 'skin/'.$setup['skinname'].'/include/dq_thumb_engine2.';
	$_inclib_02 = 'skin/'.$setup['skinname'].'/include/unlimit_write2.php';
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) require_once $_inclib_01.'php';
	else require_once $_inclib_01.'zend';
	require_once $_inclib_02;

// 설정
    if(!$dqEngine['thumbfile_permit']) $dqEngine['thumbfile_permit'] = 0705;

// 작성된 글을 가져옴
	unset($data);
	$data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));

// 본문에 삽입된 파일을 교정
    $count = (!empty($count_back) && is_array($count_back)) ? count($count_back) : null;
    if($count) {
      for($i=0; $i<$count; $i++){
        $new_link = 'revol_getimg.php?id='.$id.'&no='.$no.'&num='.$i.'&fc='.md5($tmp_sfiles[$i]);
        $data['memo'] = str_replace('?id='.$id.'&amp;file_id=','?id='.$id.'&file_id=',$data['memo']);
        $data['memo'] = str_replace($old_ilink[$i],$new_link,$data['memo']);
      }
    }
    $old_link = 'revol_download.php?id='.$id.'&no=&filenum=';
    $new_link = 'revol_download.php?id='.$id.'&no='.$no.'&filenum=';
    $data['memo'] = str_replace($old_link,$new_link,$data['memo']);

    $old_link = 'revol_download.php?id='.$id.'&amp;no=&amp;filenum=';
    $data['memo'] = str_replace($old_link,$new_link,$data['memo']);
    $data['memo'] = addslashes($data['memo']);
   	zb_query('update '.$t_board.'_'.$id.' set memo=\''.$data['memo'].'\' where no='.$no) or error(zb_error());

//토토루 스킨의 업로드 데이터 삭제
    if($mode=="modify" && !empty($tMutiupload['sfilename'])) {
      zb_query("delete from zetyx_upload where sid='$id' and sno='$no'");
    }

// 세션 삭제
/* 1.8.p15 버전 부터 불필요
    if(count($tmp_sessionName)) foreach($tmp_sessionName as $k=>$v) {
      @unlink($swf_tempDir.$_SESSION[$v]);
      unset($_SESSION[$v]);
    }
    if($_SS['delete_oldSession']) delete_oldSession($_zb_path.$_zbDefaultSetup['session_path'].'/',240);
*/
    @unlink($buffer_filename);
    

// 섬네일을 생성
    $_gd_support = get_support_GD_type();
    if(eregi("\.jpg",$_gd_support)) $ext = '.jpg';
    elseif(eregi("\.png",$_gd_support)) $ext = '.png';
    elseif(eregi("\.gif",$_gd_support)) $ext = '.gif';

	$data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));
	$old_thumb_file = 'data/'.$id.'/small_'.$data['no'].'.thumb';
    $_dq_tempFile = 'data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$data['reg_date']).'small_'.$data['no'].$ext;
	$_dq_workFile = $_dq_tempFile.'.work';

    if(file_exists($old_thumb_file)) @unlink ($old_thumb_file);
	if(file_exists($_dq_tempFile)) @unlink ($_dq_tempFile);
	if(file_exists($_dq_workFile)) @unlink ($_dq_workFile);
    if(($dqrevolutionType = 'Gallery' || !empty($skin_setup['using_thumbnail'])) && empty($skin_setup['using_mpicThumb'])) {
	    //$thumb_tag = get_thumbTag($data,$skin_setup['thumb_imagex'],$skin_setup['thumb_imagey'],$dir);
    }

// 최근게시물 썸네일 삭제
    function clearLatestThumbnail($path) 
    {
      if(!is_dir($path)) return false;
      $directory = dir($path);
      while($entry = $directory->read()) :
        if ($entry != "." && $entry != "..") {
          if (is_dir($path."/".$entry)) clearLatestThumbnail($path."/".$entry);
          elseif(@eregi($GLOBALS['id'].'_'.$no,$entry)) z_unlink($path.'/'.$entry);
        }
      endwhile;
    }
    if($mode == 'modify') {
        $path = './data/_DQThumb_Latest_Temp';
        clearLatestThumbnail($path);
    }

// 글의 갯수를 다시 갱신
	$total=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id "));
	zb_query("update $admin_table set total_article='$total[0]' where name='$id'");

// 회원일 경우 해당 해원의 점수 주기
	$addPoint = $_SS['writePointValue'];
	if(empty($skin_setup['write_nopoint']) && $addPoint && $member['no'] && ($mode=="write"||$mode=="reply")) @zb_query("update $member_table set point1=point1+$addPoint where no='$member[no]'",$connect) or error('회원점수 주기 실패<br>'.zb_error());

// 게시물 바로가기 링크 주소 설정
    if($setup['use_alllist']) $view_file="zboard.php"; else $view_file="view.php";

// 관리자에게 메일 보내기
    if(!empty($_SS['using_submitArticle_eMail2Admin']) && ($mode == 'write' || $mode == 'reply')) {
      if($_SERVER['HTTP_HOST']) $host = $_SERVER['HTTP_HOST'];
      elseif(getenv('HTTP_HOST')) $host = getenv('HTTP_HOST');
      elseif($HTTP_HOST) $host = $HTTP_HOST;
      if(!$email) $email = 'null@'.$host;
      if($use_html == 1) $memo = nl2br($memo);
      submitArticle_eMail2Admin($host, $view_file, $email, $_SS['adminEmailAdress'], $name, $subject, $memo, $id, $no);
    }

// MySQL 닫기 
	if($connect) {
		mysql_close($connect); 
		unset($connect);
	}

// 캐쉬처리
    revolution_cache_clear();

// 페이지 이동
	//$view_file = "zboard.php";
	movepage($view_file."?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&no=$no");
?>