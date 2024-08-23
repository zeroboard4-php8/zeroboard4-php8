<?php
	//set_time_limit(0); 
    

    $del_que1 = $del_que2 = null;

/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include_once "_head.php";

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

// 편법을 이용한 글쓰기 방지
	$mode = $_POST['mode'];
	if(strpos(strtolower($HTTP_REFERER),strtolower($HTTP_HOST)) === false) Error("정상적으로 글을 작성하여 주시기 바랍니다.");
	if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");
	if(!$mode) $mode = "write";

// 사용권한 체크
	if($mode=="reply"&&$setup['grant_reply']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");
	elseif($setup['grant_write']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

	if(!$is_admin&&$setup['grant_notice']<$member['level']) $notice = 0;

// 각종 변수 검사;;
	if(!isset($member['no'])) {
		if(isblank($name)) Error("이름을 입력하셔야 합니다");
		if(isblank($password)) Error("비밀번호를 입력하셔야 합니다");
		$member['is_admin'] = '0';
	} else {
		$password = $member['password'];
	}

	$subject = isset($subject) ? str_replace("ㅤ","",$subject) : '';
	$memo = isset($memo) ? str_replace("ㅤ","",$memo) : '';
	$name = isset($name) ? str_replace("ㅤ","",$name) : '';
	

	if(isblank($subject)) Error("제목을 입력하셔야 합니다");
	if(isblank($memo)) Error("내용을 입력하셔야 합니다");

	if(empty($category)) {
		$cate_temp=mysql_fetch_array(zb_query("select min(no) from $t_category"."_$id",$connect));
		$category=$cate_temp[0];
	}


// 필터링;; 관리자가 아닐때;;
	if(!$is_admin&&$setup['use_filter']) {
		$filter=explode(",",$setup['filter']);
		$f_memo=preg_replace("/([\_\-\.\/~@?=%&! ]+)/","",strip_tags($memo));
		$f_name=preg_replace("/([\_\-\.\/~@?=%&! ]+)/","",strip_tags($name));
		$f_subject=preg_replace("/([\_\-\.\/~@?=%&! ]+)/","",strip_tags($subject));
		$f_email=preg_replace("/([\_\-\.\/~@?=%&! ]+)/","",strip_tags($email));
		$f_homepage=preg_replace("/([\_\-\.\/~@?=%&! ]+)/","",strip_tags($homepage));
		foreach ($filter as $value) {
			if(stristr($f_memo,$value) !== false) Error("<b>$value</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(stristr($f_name,$value) !== false) Error("<b>$value</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(stristr($f_subject,$value) !== false) Error("<b>$value</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(stristr($f_email,$value) !== false) Error("<b>$value</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(stristr($f_homepage,$value) !== false) Error("<b>$value</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
		}
		
	}

//패스워드를 암호화
	if(strlen($password)) {
		$password=zb_escape_string($password);
		$password=get_password($password);   
	}

	if(!$is_admin) {
		$memo = isset($use_html) ? zb_sxs(zb_script_conv($memo)) : $memo;
	}

// 관리자이거나 HTML허용레벨이 낮을때 태그의 금지유무를 체크
	if(!$is_admin&&$setup['grant_html']<$member['level']) {

		// 내용의 HTML 금지;;
		if(!isset($use_html)||$setup['use_html']==0) $memo=del_html($memo);

		// HTML의 부분허용일때;;
		if(isset($use_html)&&$setup['use_html']==1) {
			$memo=zero_script_conv($setup['avoid_tag'],$memo);
		}
	} else {
		if(!isset($use_html)) {
			$memo=del_html($memo);
		}
	}


// 원본글을 가져옴
	unset($s_data);
	$s_data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));

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

// 각종 변수의 addslashes 시킴;;
	$name=addslashes(del_html($name));
	if(($is_admin||$member['level']<=$setup['use_html'])&&isset($use_html)) $subject=addslashes($subject);
	else $subject=addslashes(del_html($subject));
	$memo=addslashes($memo);
	if(isset($use_html) && $use_html<2) {
		$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
		$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
	}	
	$sitelink1=isset($sitelink1) ? addslashes(del_html($sitelink1)) : '';
	$sitelink2=isset($sitelink2) ? addslashes(del_html($sitelink2)) : '';
	$email=isset($email) ? addslashes(del_html($email)) : '';
	$homepage=isset($homepage) ? addslashes(del_html($homepage)) : '';

// 홈페이지 주소의 경우 http:// 가 없으면 붙임
	if(strpos($homepage,'http://') === false &&$homepage) $homepage="http://".$homepage;

// 각종 변수 설정
	$ip=$REMOTE_ADDR; // 아이피값 구함;;
	$reg_date=time(); // 현재의 시간구함;;

	$x = isset($zx) ? $zx : '';
	$y = isset($zy) ? $zy : '';

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


// 쿠키 설정;;
	if($mode!="modify") {
		// 기존 세션 처리 (4.0x용 세션 처리로 인하여 주석 처리)
		//if($name) $_SESSION['zb_writer_name'] = $name;
		//if($email) $_SESSION['zb_writer_email'] = $email;
		//if($homepage) $_SESSION['zb_writer_homepage'] = $homepage;

		// 4.0x 용 세션 처리
		if($name) {
			$_SESSION['zb_writer_name'] = $name;
		}
		if($email) {
			$_SESSION['zb_writer_email'] = $email;
		}
		if($homepage) {
			$_SESSION['zb_writer_homepage'] = $homepage;
		}
	}


/***************************************************************************
 * 업로드가 있을때
 **************************************************************************/
	if(isset($_FILES["file1"])) {
		$file1 = $_FILES['file1']['tmp_name'];
		$file1_name = $_FILES['file1']['name'];
		$file1_size = $_FILES['file1']['size'];
		$file1_type = $_FILES['file1']['type'];
	}
	if(isset($_FILES["file2"])) {
		$file2 = $_FILES['file2']['tmp_name'];
		$file2_name = $_FILES['file2']['name'];
		$file2_size = $_FILES['file2']['size'];
		$file2_type = $_FILES['file2']['type'];
	}

	if(isset($file1_size)&&$file1_size>0&&$setup['use_pds']&&$file1) {

		if(!is_uploaded_file($file1)) Error("정상적인 방법으로 업로드 해주세요");
		if($file1_name==$file2_name) Error("같은 파일은 등록할수 없습니다");
		$file1_size=filesize($file1);

		if($setup['max_upload_size']<$file1_size&&!$is_admin) error("첫번째 파일 업로드는 최고 ".GetFileSize($setup['max_upload_size'])." 까지 가능합니다");

		// 업로드 금지
		if($file1_size>0) {
			$s_file_name1=$file1_name;
			$s_file_name1_org=$file1_name;

			//확장자 검사
			if($setup["pds_ext1"]) {
				$temp=str_replace(',','|', $setup["pds_ext1"]);
				if(!preg_match("/\.($temp)$/i", $s_file_name1)) Error("첫번째 업로드는 $setup[pds_ext1] 확장자만 가능합니다");
			}

			// 파일명을 암호화 저장.
			$s_file_name1_org = md5(uniqid(mt_rand(), true)).".".array_pop(explode(".",$s_file_name1_org));

			// 디렉토리를 검사함
			if(!is_dir("data/".$id)) { 
				@mkdir("data/".$id,0777);
				@chmod("data/".$id,0706);
			}

				if(!move_uploaded_file($file1,"data/$id/".$s_file_name1_org)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1="data/$id/".$s_file_name1_org;   
				@chmod($file_name1,0706);
		}
  	}

	if(isset($file2_size)&&$file2_size>0&&$setup['use_pds']&&$file2) {
		if(!is_uploaded_file($file2)) Error("정상적인 방법으로 업로드 해주세요");
		$file2_size=filesize($file2);
		if($setup['max_upload_size']<$file2_size&&!$is_admin) error("파일 업로드는 최고 ".GetFileSize($setup['max_upload_size'])." 까지 가능합니다");
		if($file2_size>0) {
			$s_file_name2=$file2_name;
			$s_file_name2_org=$file2_name;

			//확장자 검사
			if($setup["pds_ext2"]) {
				$temp=str_replace(',','|', $setup["pds_ext2"]);
				if(!preg_match("/\.($temp)$/i", $s_file_name2)) Error("첫번째 업로드는 $setup[pds_ext2] 확장자만 가능합니다");
			}

			// 파일명을 암호화 저장.
			$s_file_name2_org = md5(uniqid(mt_rand(), true)).".".array_pop(explode(".",$s_file_name2_org));

			// 디렉토리를 검사함
			if(!is_dir("data/".$id)) {
				mkdir("data/".$id,0777);
				@chmod("data/".$id,0706);
			}

			
				if(!move_uploaded_file($file2,"data/$id/".$s_file_name2_org)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name2="data/$id/".$s_file_name2_org;              
				@chmod($file_name2,0706);
		}
	}


/***************************************************************************
 * 수정글일때
 **************************************************************************/
	if($mode=="modify"&&isset($no)) {
		if(!isset($use_html)) $use_html='0';
		if(!isset($reply_mail)) $reply_mail='0';
		if(!isset($is_secret)) $is_secret='0';
		
		if($s_data['ismember']) {
			if(!$is_admin&&$member['level']>$setup['grant_delete']&&$s_data['ismember']!=$member['no']) Error("정상적인 방법으로 수정하세요");
		}

		// 비밀번호 검사;;
		if($s_data['ismember']!=$member['no']&&!$is_admin) {
			$_POST['password']=isset($_POST['password']) ? zb_escape_string($_POST['password']) : '';
			$password=get_password($_POST['password']);
			if(strlen($s_data['password'])<=16&&strlen(get_password("a"))>=41) $password=get_password('$_POST[password]', true);
			if($password!==$s_data['password']) Error("비밀번호가 틀렸습니다");
		}

		// 파일삭제
		if(isset($del_file1) && $del_file1==1) {@z_unlink("./".$s_data["file_name1"]);$del_que1=",file_name1='',s_file_name1=''";} 
		if(isset($del_file2) && $del_file2==1) {@z_unlink("./".$s_data["file_name2"]);$del_que2=",file_name2='',s_file_name2=''";} 

		// 파일등록
		if(isset($file_name1)) {@z_unlink("./".$s_data["file_name1"]);$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
		if(isset($file_name2)) {@z_unlink("./".$s_data["file_name2"]);$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

		// 공지 -> 일반글 
		if(empty($notice)&&$s_data['headnum']<="-2000000000") {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			// 헤드넘+1 한값을 가짐;;
			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000")); // 공지가 아닌 최소 headnum 구함
			$headnum=$max_headnum[0]-1; 

			$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'")); // 다음글을 구함;;
			if(!$next_data[0]) $next_data[0]="0";
			$next_no=$next_data[0];

			if(!$next_data['division']) $division=1; else $division=$next_data['division'];

			$prev_data=mysql_fetch_array(zb_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<'$headnum' and no!='$no' order by headnum desc limit 1")); // 이전글을 구함;;
			if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no=0;

			$child="0";
			$depth="0";    
			$arrangenum="0";
			$father="0";
			minus_division($s_data['division']);
			zb_query("update $t_board"."_$id set headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(zb_error());
			plus_division($division);

			// 다음글의 이전글을 수정
			if($next_no)zb_query("update $t_board"."_$id set prev_no='$no' where division='$next_data[division]' and headnum='$next_data[headnum]'");  

			// 이전글의 다음글을 수정
			if($prev_no)zb_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");                  

			zb_query("update $t_board"."_$id set prev_no=0 where (division='$max_division' or division='$second_division') and prev_no='$s_data[no]' and headnum!='$next_data[headnum]'");
			zb_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
			zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
		}

   		// 일반글 -> 공지 
		elseif(!empty($notice)&&$s_data['headnum']>-2000000000) {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));  // 최고글을 구함;;
			$headnum=$max_headnum[0]-1;
			if($headnum>-2000000000) $headnum=-2000000000; // 최고 headnum이 공지가 아니면 현재 글에 공지를 넣음;

			$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'"));
			if(!$next_data[0]) $next_data[0]="0";
			$next_no=$next_data[0];
			$prev_no=0;
			$child="0";
			$depth="0";
			$arrangenum="0";
			$father="0";
			minus_division($s_data['division']);
			$division=add_division();
			zb_query("update $t_board"."_$id set division='$division',headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(zb_error());

			if($s_data['father']) zb_query("update $t_board"."_$id set child='$s_data[child]' where no='$s_data[father]'"); // 답글이었으면 원본글의 답글을 현재글의 답글로 대체
			if($s_data['child']) zb_query("update $t_board"."_$id set depth=depth-1,father='$s_data[father]' where no='$s_data[child]'"); // 답글이 있으면 현재글의 위치로;;

			// 원래 다음글로 이글을 가지고 있었던 데이타의 prev_no을 바꿈;
			$temp=mysql_fetch_array(zb_query("select max(headnum) from $t_board"."_$id where headnum<='$s_data[headnum]'"));
			$temp=mysql_fetch_array(zb_query("select no from $t_board"."_$id where headnum='$temp[0]' and depth='0'"));
			zb_query("update $t_board"."_$id set prev_no='$temp[no]' where prev_no='$s_data[no]'");

			zb_query("update $t_board"."_$id set next_no='$s_data[next_no]' where next_no='$s_data[no]'");

			zb_query("update $t_board"."_$id set prev_no='$no' where prev_no='0' and no!='$no'") or error(zb_error()); // 다음글의 이전글을 설정 
			zb_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
			zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

		// 일반->일반, 공지->공지 일때 
		} else {
			zb_query("update $t_board"."_$id set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(zb_error());
			zb_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
			zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
		}



/***************************************************************************
 * 답변글일때
 **************************************************************************/
	} elseif($mode=="reply"&&$no) {

		$prev_no=$s_data['prev_no'];
		$next_no=$s_data['next_no'];
		$father=$s_data['no'];
		$child=0;
		$headnum=$s_data['headnum'];    
		if($headnum<=-2000000000&&$notice) Error("공지사항에는 답글을 달수가 없습니다");
		$depth=$s_data['depth']+1;
		$arrangenum=$s_data['arrangenum']+1;
		$move_result=zb_query("select no from $t_board"."_$id where division='$s_data[division]' and headnum='$headnum' and arrangenum>='$arrangenum'");
		while($move_data=mysql_fetch_array($move_result)) {
			zb_query("update $t_board"."_$id set arrangenum=arrangenum+1 where no='$move_data[no]'");
		}

		$division=$s_data['division'];
		plus_division($s_data['division']);
		if(empty($member['no'])) $member['no'] = '0';
   
		// 답글 데이타 입력;;
		zb_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(zb_error());    

		// 원본글과 원본글의 아래글의 속성 변경;;
		$no=mysql_insert_id();
		zb_query("update $t_board"."_$id set child='$no' where no='$s_data[no]'");
		zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

		// 현재글의 조회수를 올릴수 없게 세션 등록
		$hitStr=",".$setup['no']."_".$no;
		$zb_hit=$_SESSION['zb_hit'].$hitStr;
		
		$_SESSION['zb_hit'] = $zb_hit;

		// 현재글의 추천을 할수 없게 세션 등록
		$voteStr=",".$setup['no']."_".$no;
		$zb_vote=$_SESSION['zb_vote'].$voteStr;
		$_SESSION['zb_vote'] = $zb_vote;

		// 응답글 보내기일때;;
		if($s_data['reply_mail']&&$s_data['email']) {

			if($use_html<2) $memo=nl2br($memo);
			$memo = stripslashes($memo);

			zb_sendmail($use_html, $s_data['email'], $s_data['name'], $email, $name, $subject, $memo);
		}

/***************************************************************************
 * 신규 글쓰기일때
 **************************************************************************/
	} elseif($mode=="write") {

		// 공지사항이 아닐때;;
		if(empty($notice)) {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000"));
			if(!$max_headnum[0]) $max_headnum[0]=0;

			$headnum=$max_headnum[0]-1;

			$next_data=mysql_fetch_array(zb_query("select division,headnum,arrangenum from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
			if(empty($next_data[0])) $next_data[0]="0";
			else {
				$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
			}
    
			$prev_data=mysql_fetch_array(zb_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<=-2000000000 order by headnum desc limit 1"));
			if(isset($prev_data[0])) $prev_no=$prev_data[0]; else $prev_no="0";

		// 공지사항일때;; 
		} else {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0]+1;
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));
			$headnum=$max_headnum[0]-1;
			if($headnum>-2000000000) $headnum=-2000000000;

			$next_data=mysql_fetch_array(zb_query("select division,headnum from $t_board"."_$id where division='$max_division' or division='$second_division' order by headnum limit 1"));
			if(!$next_data[0]) $next_data[0]="0";
			else {
				$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='0'"));
			}
			$prev_no=0; 
		}

		$next_no=isset($next_data['no']) ? $next_data['no'] : '0';
		$child="0";
		$depth="0";
		$arrangenum="0";
		$father="0";
		$division=add_division();

		if(!isset($use_html)) $use_html='0';
		if(!isset($reply_mail)) $reply_mail='0';
		if(!isset($is_secret)) $is_secret='0';
		if(!isset($file_name1)) $file_name1='';
		if(!isset($file_name2)) $file_name2='';
		if(!isset($s_file_name1)) $s_file_name1='';
		if(!isset($s_file_name2)) $s_file_name2='';
		if(!isset($des)) $des='';
		if(empty($member['no'])) $member['no'] = '0';
		zb_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(zb_error());
		$no=mysql_insert_id();

		// 현재글의 조회수를 올릴수 없게 세션 등록
		$hitStr=",".$setup['no']."_".$no;
		$zb_hit=isset($_SESSION['zb_hit']) ? $_SESSION['zb_hit'].$hitStr : $hitStr;
		$_SESSION['zb_hit'] = $zb_hit;

		// 현재글의 추천을 할수 없게 세션 등록
		$voteStr=",".$setup['no']."_".$no;
		$zb_vote=isset($_SESSION['zb_vote']) ? $_SESSION['zb_vote'].$voteStr : $voteStr;
		$_SESSION['zb_vote'] = $zb_vote;

		if($prev_no) zb_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");
		if($next_no) zb_query("update $t_board"."_$id set prev_no='$no' where headnum='$next_data[headnum]' and division='$next_data[division]'");
		zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}


// 글의 갯수를 다시 갱신
	$total=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id "));
	zb_query("update $admin_table set total_article='$total[0]' where name='$id'");

// 회원일 경우 해당 해원의 점수 주기
	if($mode=="write"||$mode=="reply") zb_query("update $member_table set point1=point1+1 where no='$member[no]'",$connect) or error(zb_error());

// MySQL 닫기 
	if($connect) {
		mysql_close($connect); 
		unset($connect);
	}
	if(!isset($des)) $des='';
// 페이지 이동
	//if($setup['use_alllist']) $view_file="zboard.php"; else $view_file="view.php";
	$view_file = "zboard.php";
	movepage($view_file."?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&category=$category");
?>
