<?php
/***************************************************************************
 * 게시판 기능 설정 실행
 **************************************************************************/
 	if(isset($_POST['exec2']) && !check_csrf_token()) Error('CSRF 토큰이 일치하지 않습니다.');

// 게시판 수정
	if(isset($_POST['exec2']) && $_POST['exec2']==="modify_ok") {
		// 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
		if(isBlank($name)) Error("게시판 이름을 입력하셔야 합니다","");
		if(!isAlNum($name)) Error("게시판 이름은 영문과 숫자로만 하셔야 합니다","");
		if(!$admin_passwd) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($admin_passwd, $isold)) {
				Error("관리자 비밀번호가 틀렸습니다.");
			}
		if(isset($_SESSION['csrf_token'])) unset($_SESSION['csrf_token']);
		$name=addslashes($name);
		$bg_color=addslashes($bg_color);
		$ba_image=addslashes($bg_image);
		$header_url=addslashes($header_url);
		$footer_url=addslashes($footer_url);
		$header=addslashes($header);
		$footer=addslashes($footer);
		$pds_ext1=str_replace(" ","",$pds_ext1);
		$pds_ext2=str_replace(" ","",$pds_ext2);
		$title=addslashes($title);
		if(!isset($use_category)) $use_category=0;
		if(!isset($use_status)) $use_status=0;
		if(!isset($use_pds)) $use_pds=0;
		if(!isset($use_homelink)) $use_homelink=0;
		if(!isset($use_filelink)) $use_filelink=0;
		if(!isset($use_cart)) $use_cart=0;
		if(!isset($use_showip)) $use_showip=0;
		if(!isset($use_alllist)) $use_alllist=0;
		if(!isset($use_filter)) $use_filter=0;
		if(!isset($use_secret)) $use_secret=0;
		if(!isset($only_board)) $only_board=0;
		if(!isset($use_showreply)) $use_showreply=0;
		zb_query("update $admin_table set
				only_board='$only_board',skinname='$skinname',header='$header',footer='$footer',header_url='$header_url',footer_url='$footer_url',
				bg_image='$bg_image',bg_color='$bg_color',table_width='$table_width',memo_num='$memo_num', page_num='$page_num', cut_length='$cut_length', use_category='$use_category', use_html='$use_html',max_upload_size='$max_upload_size',
				use_filter='$use_filter',use_status='$use_status',use_pds='$use_pds',use_homelink='$use_homelink',
				title='$title',pds_ext1='$pds_ext1',pds_ext2='$pds_ext2',
				use_filelink='$use_filelink',use_cart='$use_cart',use_autolink='$use_autolink',use_showip='$use_showip',
				use_comment='$use_comment',use_formmail='$use_formmail',use_showreply='$use_showreply', use_secret='$use_secret', filter='$filter', avoid_tag='$avoid_tag', avoid_ip='$avoid_ip', use_alllist='$use_alllist' where no='$no'") or Error("게시판의 기능설정 변경시 에러가 발생하였습니다");

		if(!empty($applyall_filter)) zb_query("update $admin_table set filter='$filter'");
		if(!empty($applyall_tag)) zb_query("update $admin_table set avoid_tag='$avoid_tag'");
		if(!empty($applyall_ip)) zb_query("update $admin_table set avoid_ip='$avoid_ip'");

		movepage("$PHP_SELF?group_no=$group_no&exec=view_board&no=$no&exec2=modify&page=$page&page_num=$s_page_num");
	}

// 게시판 추가 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="add_ok") {
		// 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
		if(isBlank($name)) Error("게시판 이름을 입력하셔야 합니다","");
		if(!isAlNum($name)) Error("게시판 이름은 영문과 숫자로만 하셔야 합니다","");
		if(!$admin_passwd) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($admin_passwd, $isold)) {
				Error("관리자 비밀번호가 틀렸습니다.");
			}

		// 같은 이름의 게시판이 이미 생성되었는지를 검사
		$result=zb_query("select count(*) from $admin_table where name='$name'",$connect) or Error(zb_error());
		$temp=mysql_fetch_array($result);
		if($temp[0]>0) Error("이미 등록되어 있는 게시판입니다.<br>다른 이름으로 생성하십시오","");

		$name=addslashes($name);
		$bg_color=addslashes($bg_color);
		$ba_image=addslashes($bg_image);
		$header_url=addslashes($header_url);
		$footer_url=addslashes($footer_url);
		$header=addslashes($header);
		$footer=addslashes($footer);
		$title=addslashes($title);
		$pds_ext1=str_replace(" ","",$pds_ext1);
		$pds_ext2=str_replace(" ","",$pds_ext2);
		if(!isset($use_category)) $use_category=0;
		if(!isset($use_status)) $use_status=0;
		if(!isset($use_pds)) $use_pds=0;
		if(!isset($use_homelink)) $use_homelink=0;
		if(!isset($use_filelink)) $use_filelink=0;
		if(!isset($use_cart)) $use_cart=0;
		if(!isset($use_showip)) $use_showip=0;
		if(!isset($use_alllist)) $use_alllist=0;

		// 관리자 테이블 생성
		zb_query("insert into $admin_table 
					(group_no,name,skinname,header,footer,header_url,footer_url,bg_image,bg_color,table_width,
					memo_num,page_num,cut_length,use_category,use_html,use_filter,use_status,use_pds,use_homelink,
					use_filelink,use_cart,use_autolink,use_showip,use_comment,use_formmail,use_showreply,use_secret,filter,avoid_tag, avoid_ip, use_alllist, max_upload_size,title,pds_ext1,pds_ext2,only_board)
				values
					('$group_no','$name','$skinname','$header','$footer','$header_url','$footer_url','$bg_image','$bg_color','$table_width',
					'$memo_num','$page_num','$cut_length','$use_category','$use_html','$use_filter','$use_status','$use_pds','$use_homelink',
					'$use_filelink','$use_cart','$use_autolink','$use_showip','$use_comment','$use_formmail','$use_showreply','$use_secret','$filter','$avoid_tag','$avoid_ip','$use_alllist','$max_upload_size','$title','$pds_ext1','$pds_ext2','$only_board')")                  
				or Error("관리자 테이블 생성 에러<br><br>".zb_error());

		$table_name=$name;

		include "schema.sql";

		// 게시판 본체 테이블 생성
		zb_query($board_table_main_schema) or Error("게시판의 메인 테이블 생성 에러가 발생하였습니다");

		// Division 테이블 생성
		zb_query($division_table_schema) or Error("Division 테이블 생성시 에러가 발생했습니다");
		zb_query("insert into $t_division"."_$table_name (division,num) values ('1','0')") or Error("Division 테이블 행 추가시 에러가 발생했습니다");

		// 코멘트 테이블 생성
		zb_query($board_comment_schema) or Error("게시판의 코멘트 테이블 생성 에러가 발생하였습니다");

		// 카테고리 테이블 생성 
		zb_query($board_category_table) or Error("게시판의 카테고리 테이블 생성 에러가 발생하였습니다");
 
		// 기본 카테고리 필드 입력
		zb_query("insert into $t_category"."_$table_name (num, name) values ('0','일반')") or Error("기본 카테고리 입력시 에러가 발생하였습니다");
		zb_query("insert into $t_category"."_$table_name (num, name) values ('0','질문')") or Error("기본 카테고리 입력시 에러가 발생하였습니다");
		zb_query("insert into $t_category"."_$table_name (num, name) values ('0','답변')") or Error("기본 카테고리 입력시 에러가 발생하였습니다");
 
		zb_query("update $group_table set board_num=board_num+1 where no='$group_no'");    

		movepage("$PHP_SELF?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// 게시판 삭제 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="del") {
		if(!$admin_passwd) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($admin_passwd, $isold)) {
				Error("관리자 비밀번호가 틀렸습니다.");
			}
		$data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		
		$table_name=$data['name'];

		$tmpData = zb_query("select file_name1, file_name2 from $t_board"."_$table_name") or die("첨부파일 삭제 처리중 에러가 발생했습니다");
		while($data=mysql_fetch_array($tmpData)) {
			if($data["file_name1"]) @z_unlink("./".$data["file_name1"]);
			if($data["file_name2"]) @z_unlink("./".$data["file_name2"]);
		}

		if(is_dir("./data/".$table_name)) zRmDir("./data/".$table_name);

		zb_query("delete from $admin_table where no='$no'") or Error("게시판 삭제시 관리자 테이블에서 에러가 발생하였습니다");
		zb_query("drop table $t_board"."_$table_name") or Error("게시판의 메인 테이블 삭제 에러가 발생하였습니다");
		zb_query("drop table $t_division"."_$table_name") or Error("게시판의 Division 테이블 삭제 에러가 발생했습니다");
		zb_query("drop table $t_comment"."_$table_name") or Error("게시판의 코멘트 테이블 삭제 에러가 발생하였습니다");
		zb_query("drop table $t_category"."_$table_name") or Error("게시판의 카테고리 테이블 삭제 에러가 발생하였습니다");

		zb_query("update $group_table set board_num=board_num-1 where no='$group_no'");    

		movepage("$PHP_SELF?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// 카테고리 부분
	if(isset($_POST['exec2']) && $_POST['exec2']==="category_add") {
		if(!$name) error("생성할 카테고리 이름을 입력하여 주십시오");
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		$check=mysql_fetch_array(zb_query("select count(*) from $t_category"."_$table_data[name] where name='$name'"));
		if($check[0]>0) Error("동일한 이름의 카테고리가 있습니다");
		zb_query("insert into $t_category"."_$table_data[name] (name) values ('$name')") or error("카테고리 추가시 에러가 발생했습니다");
		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif(isset($_POST['exec2']) && $_POST['exec2']==="del_category") {
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		zb_query("delete from $t_category"."_$table_data[name] where no='$category_no'",$connect) or Error("카테고리 삭제시 에러가 발생했습니다");
		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif(isset($_POST['exec2']) && $_POST['exec2']==="category_modify_ok") {
		if(!$name) error("수정할 카테고리 이름을 입력하여 주십시오");
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		zb_query("update $t_category"."_$table_data[name] set name='$name' where no='$category_no'",$connect);

		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// 카테고리 내용 이동 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="category_move") {
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		foreach ($_POST['c'] as $value) {
			zb_query("update $t_board"."_$table_data[name] set category='$movename' where category='$value'",$connect);
		}

		$result = zb_query("select * from $t_category"."_$table_data[name]") or die(zb_error());
		while($data=mysql_fetch_array($result)) {
			$num = mysql_fetch_array(zb_query("select count(*) from $t_board"."_$table_data[name] where category='$data[no]'"));
			zb_query("update $t_category"."_$table_data[name] set num='$num[0]' where no = '$data[no]'") or die(zb_error());
		}

		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// 권한 설정 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="modify_grant_ok") {
		if(!$admin_passwd) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($admin_passwd, $isold)) {
				Error("관리자 비밀번호가 틀렸습니다.");
			}
		zb_query("update $admin_table set grant_html='$grant_html', grant_list='$grant_list',
				grant_view='$grant_view', grant_comment='$grant_comment', grant_write='$grant_write',
				grant_reply='$grant_reply', grant_delete='$grant_delete', grant_notice='$grant_notice',
				grant_view_secret='$grant_view_secret', use_showip = '$grant_imagebox' where no='$no'") or Error("권한 설정 변경시 에러가 발생하였습니다".zb_error());
		movepage("$PHP_SELF?exec=view_board&exec=view_board&exec2=grant&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}
?>
