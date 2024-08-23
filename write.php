<?php
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include_once "_head.php";

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

 	$mode = $_GET['mode'];

 	if(strpos(strtolower($HTTP_REFERER),strtolower($HTTP_HOST)) === false) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

  if(strpos($dir,'://') !== false) $dir=".";

// 변수 체크
	if(!$mode||$mode=="write") {
		$mode = "write";
		unset($no);
	}

// 사용권한 체크
	if($mode=="reply"&&$setup['grant_reply']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");
	elseif($setup['grant_write']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");
	if($mode=="reply"&&$setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

// 답글이나 수정일때 원본글을 가져옴;;
	if(($mode=="reply"||$mode=="modify")&&$no) {
		$result=zb_query("select * from $t_board"."_$id where no='$no'") or error(zb_error());
		unset($data);
		$data=mysql_fetch_array($result);
		if(!$data['no']) Error("원본글이 존재하지 않습니다");
	}

// 수정 글일때 권한 체크
	if($mode=="modify"&&$data['ismember']) {
		if($data['ismember']!=$member['no']&&!$is_admin&&$member['level']>$setup['grant_delete']) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");
	}

// 공지글에는 답글이 안 달리게 처리
	if($mode=="reply"&&$data['headnum']<=-2000000000) Error("공지글에는 답글을 달수 없습니다");


// 카테고리 데이타 가져옴;;
	$category_result=zb_query("select * from $t_category"."_$id order by no");

// 카테고리 데이타 갖고 오기;;
	if($setup['use_category']) {
		$category_kind="<select name=category><option>Category</option>";

		while($category_data=mysql_fetch_array($category_result)) {
			if($data['category']==$category_data['no']) $category_kind.="<option value=$category_data[no] selected>$category_data[name]</option>";
			else $category_kind.="<option value=$category_data[no]>$category_data[name]</option>";
		}

		$category_kind.="</select>";
	}
  
	if($mode=="modify") $title = " 글 수정하기 ";
	elseif($mode=="reply") $title = " 답글 달기 ";
	else $title = " 신규 글쓰기 "; 

// 쿠키값을 이용;;
	$name=isset($_SESSION['zb_writer_name']) ? $_SESSION['zb_writer_name'] : '';
	$email=isset($_SESSION['zb_writer_email']) ? $_SESSION['zb_writer_email'] : ''; 
	$homepage=isset($_SESSION['zb_writer_homepage']) ? $_SESSION['zb_writer_homepage'] : '';

/******************************************************************************************
 * 글쓰기 모드에 따른 내용 체크
 *****************************************************************************************/

	if($mode=="modify") {

		// 비밀글이고 패스워드가 틀리고 관리자가 아니면 리턴
		if($data['is_secret']&&!$is_admin&&$data['ismember']!=$member['no']&&$_SESSION['zb_s_check']!=$setup['no']."_".$no) error("정상적인 방법으로 수정하세요");

			$name=isset($data['name']) ? stripslashes($data['name']) : ''; // 이름
			$email=isset($data['email']) ? stripslashes($data['email']) : ''; // 메일
			$homepage=isset($data['homepage']) ? stripslashes($data['homepage']) : ''; // 홈페이지 
			$subject=$data['subject']=isset($data['subject']) ? stripslashes($data['subject']) : ''; // 제목
			$subject=isset($subject) ? str_replace("\"","&quot;",$subject) : '';
			$homepage=isset($homepage) ? str_replace("\"","&quot;",$homepage) : '';
			$name=isset($name) ? str_replace("\"","&quot;",$name) : '';
			$sitelink1=isset($sitelink1) ? str_replace("\"","&quot;",$sitelink1) : '';
			$sitelink2=isset($sitelink2) ? str_replace("\"","&quot;",$sitelink2) : '';
			$memo=isset($data['memo']) ? stripslashes($data['memo']) : ''; // 내용
			$sitelink1=$data["sitelink1"]=isset($data['sitelink1']) ? stripslashes($data["sitelink1"]) : '';
			$sitelink2=$data["sitelink2"]=isset($data['sitelink2']) ? stripslashes($data["sitelink2"]) : '';
			if($data['file_name1'])$file_name1="<br>&nbsp;".$data["s_file_name1"]."이 등록되어 있습니다. <input type=checkbox name=del_file1 value=1> 삭제";
			if($data['file_name2'])$file_name2="<br>&nbsp;".$data["s_file_name2"]."이 등록되어 있습니다. <input type=checkbox name=del_file2 value=1> 삭제";

			if($data['use_html']) $use_html=" checked ";

			if($data['reply_mail']) $reply_mail=" checked ";
			if($data['is_secret']) $secret=" checked ";
			if($data['headnum']<=-2000000000) $notice=" checked ";

		// 답글일때 제목과 내용 수정;;
		} elseif($mode=="reply") {

   			// 비밀글이고 패스워드가 틀리고 관리자가 아니면 리턴
			if(isset($data['is_secret'])&&!isset($is_admin)&&$data['ismember']!=$member['no']&&$_SESSION['zb_s_check']!=$setup['no']."_".$no) error("정상적인 방법으로 답글을 다세요");

			if(isset($data['is_secret'])) $secret=" checked ";

			$subject=$data['subject']=isset($data['subject']) ? stripslashes($data['subject']) : ''; // 제목
			$subject=isset($subject) ? str_replace("\"","&quot;",$subject) : '';
			$sitelink1=isset($sitelink1) ? str_replace("\"","&quot;",$sitelink1) : '';
			$sitelink2=isset($sitelink2) ? str_replace("\"","&quot;",$sitelink2) : '';
			$memo=isset($data['memo']) ? stripslashes($data['memo']) : ''; // 내용
			if(strpos(strtolower($subject),'[re]') === false) $subject="[re] ".$subject; // 답글일때는 앞에 [re] 붙임;;
			$memo=str_replace("\n","\n>",$memo);
			$memo="\n\n>".$memo."\n";
			$title="{$name}님의 글에 대한 답글쓰기";
		}


// 회원일때는 기본 입력사항 안보이게;;
	if(isset($member['no'])) { $hide_start="<!--"; $hide_end="-->"; }

// 싸이트 링크 기능이 없을때 링크 지우기 표시;;
	if(!$setup['use_homelink']) { $hide_sitelink1_start="<!--";$hide_sitelink1_end="-->";}
	if(!$setup['use_filelink']) { $hide_sitelink2_start="<!--";$hide_sitelink2_end="-->";}

// 자료실 기능을 사용하는지 않하는지 표시;;
	if(!$setup['use_pds']) { $hide_pds_start="<!--";$hide_pds_end="-->";}

// HTML사용 체크버튼 
	if($setup['use_html']==0) {
		if(!$is_admin&&$member['level']>$setup['grant_html']) { 
			$hide_html_start="<!--";
			$hide_html_end="-->"; 
		}
	}

// HTML 사용 체크를 확장시킴
	if($mode!="reply") {
		if(!isset($data['use_html'])) $value_use_html = 1;
		else $value_use_html=$data['use_html'];
	} else {
		$value_use_html=1;
	}
	if(isset($use_html)) $use_html .= " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard"; else $use_html = " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard";


// 비밀글 사용;;
	if(!$setup['use_secret']) { $hide_secret_start="<!--"; $hide_secret_end="-->"; } else { $hide_secret_start=''; $hide_secret_end=''; }

// 공지기능 사용하는지 않하는지 표시;;
	if((!$is_admin&&$member['level']>$setup['grant_notice'])||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

// 최고 업로드 가능 용량
	if($setup['use_pds']) $upload_limit=GetFileSize($setup['max_upload_size']);

// 이미지 창고 버튼
	if(empty($member['no'])) $member['no'] = '0';
	if(isset($member['no'])&&$setup['grant_imagebox']>=$member['level']) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($mode=="modify"&&$data['ismember']!=$member['no']) $a_imagebox = "<Zeroboard";

// 미리보기 버튼
	$a_preview="<a onfocus=blur() href='javascript:view_preview()'>";


// HTML 출력 

	head(" onload=unlock() onunload=hideImageBox() ","script_write.php");
	if(!isset($hide_start)) $hide_start = '';
	if(!isset($hide_end)) $hide_end = '';
	if(!isset($hide_sitelink1_start)) $hide_sitelink1_start = '';
	if(!isset($hide_sitelink1_end)) $hide_sitelink1_end = '';
	if(!isset($hide_sitelink2_start)) $hide_sitelink2_start = '';
	if(!isset($hide_sitelink2_end)) $hide_sitelink2_end = '';
	if(!isset($hide_pds_start)) $hide_pds_start = '';
	if(!isset($hide_pds_end)) $hide_pds_end = '';
	if(!isset($hide_html_start)) $hide_html_start = '';
	if(!isset($hide_html_end)) $hide_html_end = '';
	if(!isset($hide_notice_start)) $hide_notice_start = '';
	if(!isset($hide_notice_end)) $hide_notice_end = '';
	if(!isset($no)) $no = '';
	if(!isset($page_num)) $page_num = '';
	if(!isset($name)) $name = '';
	if(!isset($subject)) $subject = '';
	if(!isset($email)) $email = '';
	if(!isset($homepage)) $homepage = '';
	if(!isset($notice)) $notice = '';
	if(!isset($memo)) $memo = '';
	if(!isset($sitelink1)) $sitelink1 = '';
	if(!isset($sitelink2)) $sitelink2 = '';
	if(!isset($file_name1)) $file_name1 = '';
	if(!isset($file_name2)) $file_name2 = '';
	if(!isset($category_kind)) $category_kind = '';
	if(!isset($use_html)) $use_html = '';
	if(!isset($reply_mail)) $reply_mail = '';
	if(!isset($secret)) $secret = '';
	if(!isset($upload_limit)) $upload_limit = '';
	include $dir."/write.php";

	foot();

	include "_foot.php";

?>
