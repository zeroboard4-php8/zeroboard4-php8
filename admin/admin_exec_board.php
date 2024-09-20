<?php
/***************************************************************************
 * 게시판 기능 설정 실행
 **************************************************************************/
 	if(isset($_POST['exec2']) && !check_csrf_token()) Error('CSRF 토큰이 일치하지 않습니다.');

// 게시판 수정
	if(isset($_POST['exec2']) && $_POST['exec2']==="modify_ok") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$skinname = isset($_POST['skinname']) ? $_POST['skinname'] : '';
		$only_board = empty($_POST['only_board']) ? '0' : '1';
		$bg_image = isset($_POST['bg_image']) ? addslashes($_POST['bg_image']) : '';
		$bg_color = isset($_POST['bg_color']) ? addslashes($_POST['bg_color']) : 'white';
		$table_width = isset($_POST['table_width']) && is_numeric($_POST['table_width']) ? $_POST['table_width'] : '95';
		$cut_length = isset($_POST['cut_length']) && is_numeric($_POST['cut_length']) ? $_POST['cut_length'] : '45';
		$memo_num = isset($_POST['memo_num']) && is_numeric($_POST['memo_num']) ? $_POST['memo_num'] : '20';
		$page_num = isset($_POST['page_num']) && is_numeric($_POST['page_num']) ? $_POST['page_num'] : '10';
		$s_page_num = isset($_POST['s_page_num']) && is_numeric($_POST['s_page_num']) ? $_POST['s_page_num'] : '10';
		$title = isset($_POST['title']) ? addslashes($_POST['title']) : '';
		$header_url = isset($_POST['header_url']) ? addslashes($_POST['header_url']) : '';
		$header = isset($_POST['header']) ? addslashes($_POST['header']) : '<div align=center>';
		$footer_url = isset($_POST['footer_url']) ? addslashes($_POST['footer_url']) : '';
		$footer = isset($_POST['footer']) ? addslashes($_POST['footer']) : '</div>';
		$use_alllist = empty($_POST['use_alllist']) ? '0' : '1';
		$use_category = empty($_POST['use_category']) ? '0' : '1';
		$use_html = isset($_POST['use_html']) && in_array($_POST['use_html'], array('0', '1', '2')) ? $_POST['use_html'] : '0';
		$use_showreply = empty($_POST['use_showreply']) ? '0' : '1';
		$use_filter = empty($_POST['use_filter']) ? '0' : '1';
		$use_status = empty($_POST['use_status']) ? '0' : '1';
		$use_homelink = empty($_POST['use_homelink']) ? '0' : '1';
		$use_filelink = empty($_POST['use_filelink']) ? '0' : '1';
		$use_pds = empty($_POST['use_pds']) ? '0' : '1';
		$pds_ext1 = isset($_POST['pds_ext1']) ? str_replace(' ','', $_POST['pds_ext1']) : '';
		$pds_ext2 = isset($_POST['pds_ext2']) ? str_replace(' ','', $_POST['pds_ext2']) : '';
		$max_upload_size = isset($_POST['max_upload_size']) && is_numeric($_POST['max_upload_size']) ? $_POST['max_upload_size'] : '2097152';
		$use_cart = empty($_POST['use_cart']) ? '0' : '1';
		$use_autolink = empty($_POST['use_autolink']) ? '0' : '1';
		$use_showip = empty($_POST['use_showip']) ? '0' : '1';
		$use_comment = empty($_POST['use_comment']) ? '0' : '1';
		$use_formmail = empty($_POST['use_formmail']) ? '0' : '1';
		$use_secret = empty($_POST['use_secret']) ? '0' : '1';
		$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
		$avoid_tag = isset($_POST['avoid_tag']) ? $_POST['avoid_tag'] : '';
		$avoid_ip = isset($_POST['avoid_ip']) ? $_POST['avoid_ip'] : '';
		$name = isset($_POST['name']) ? addslashes($_POST['name']) : '';
		
		// 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
		if(isBlank($name)) Error("게시판 이름을 입력하셔야 합니다","");
		if(!isAlNum($name)) Error("게시판 이름은 영문과 숫자로만 하셔야 합니다","");
		if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
				error("관리자 비밀번호가 틀렸습니다.");
		}
		if(isset($_SESSION['csrf_token'])) unset($_SESSION['csrf_token']);
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

		movepage("{$_SERVER['PHP_SELF']}?group_no=$group_no&exec=view_board&no=$no&exec2=modify&page=$page&page_num=$s_page_num");
	}

// 게시판 추가 
	elseif($member['is_admin']<=2 && isset($_POST['exec2']) && $_POST['exec2']==="add_ok") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$skinname = isset($_POST['skinname']) ? $_POST['skinname'] : '';
		$only_board = empty($_POST['only_board']) ? '0' : '1';
		$bg_image = isset($_POST['bg_image']) ? addslashes($_POST['bg_image']) : '';
		$bg_color = isset($_POST['bg_color']) ? addslashes($_POST['bg_color']) : 'white';
		$table_width = isset($_POST['table_width']) && is_numeric($_POST['table_width']) ? $_POST['table_width'] : '95';
		$cut_length = isset($_POST['cut_length']) && is_numeric($_POST['cut_length']) ? $_POST['cut_length'] : '45';
		$memo_num = isset($_POST['memo_num']) && is_numeric($_POST['memo_num']) ? $_POST['memo_num'] : '20';
		$page_num = isset($_POST['page_num']) && is_numeric($_POST['page_num']) ? $_POST['page_num'] : '10';
		$title = isset($_POST['title']) ? addslashes($_POST['title']) : '';
		$header_url = isset($_POST['header_url']) ? addslashes($_POST['header_url']) : '';
		$header = isset($_POST['header']) ? addslashes($_POST['header']) : '<div align=center>';
		$footer_url = isset($_POST['footer_url']) ? addslashes($_POST['footer_url']) : '';
		$footer = isset($_POST['footer']) ? addslashes($_POST['footer']) : '</div>';
		$use_alllist = empty($_POST['use_alllist']) ? '0' : '1';
		$use_category = empty($_POST['use_category']) ? '0' : '1';
		$use_html = isset($_POST['use_html']) && in_array($_POST['use_html'], array('0', '1', '2')) ? $_POST['use_html'] : '0';
		$use_showreply = empty($_POST['use_showreply']) ? '0' : '1';
		$use_filter = empty($_POST['use_filter']) ? '0' : '1';
		$use_status = empty($_POST['use_status']) ? '0' : '1';
		$use_homelink = empty($_POST['use_homelink']) ? '0' : '1';
		$use_filelink = empty($_POST['use_filelink']) ? '0' : '1';
		$use_pds = empty($_POST['use_pds']) ? '0' : '1';
		$pds_ext1 = isset($_POST['pds_ext1']) ? str_replace(' ','', $_POST['pds_ext1']) : '';
		$pds_ext2 = isset($_POST['pds_ext2']) ? str_replace(' ','', $_POST['pds_ext2']) : '';
		$max_upload_size = isset($_POST['max_upload_size']) && is_numeric($_POST['max_upload_size']) ? $_POST['max_upload_size'] : '2097152';
		$use_cart = empty($_POST['use_cart']) ? '0' : '1';
		$use_autolink = empty($_POST['use_autolink']) ? '0' : '1';
		$use_showip = empty($_POST['use_showip']) ? '0' : '1';
		$use_comment = empty($_POST['use_comment']) ? '0' : '1';
		$use_formmail = empty($_POST['use_formmail']) ? '0' : '1';
		$use_secret = empty($_POST['use_secret']) ? '0' : '1';
		$filter = isset($_POST['filter']) ? $_POST['filter'] : '';
		$avoid_tag = isset($_POST['avoid_tag']) ? $_POST['avoid_tag'] : '';
		$avoid_ip = isset($_POST['avoid_ip']) ? $_POST['avoid_ip'] : '';
		$name = isset($_POST['name']) ? addslashes($_POST['name']) : '';

		// 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
		if(isBlank($name)) Error("게시판 이름을 입력하셔야 합니다","");
		if(!isAlNum($name)) Error("게시판 이름은 영문과 숫자로만 하셔야 합니다","");
		if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
				error("관리자 비밀번호가 틀렸습니다.");
		}

		// 같은 이름의 게시판이 이미 생성되었는지를 검사
		$result=zb_query("select count(*) from $admin_table where name='$name'",$connect) or Error(zb_error());
		$temp=mysql_fetch_array($result);
		if($temp[0]>0) Error("이미 등록되어 있는 게시판입니다.<br>다른 이름으로 생성하십시오","");

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

		include 'schema.sql';

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

		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// 게시판 삭제 
	elseif($member['is_admin']<=2 && isset($_POST['exec2']) && $_POST['exec2']==="del") {
		if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
				error("관리자 비밀번호가 틀렸습니다.");
		}
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
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

		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// 카테고리 부분
	if(isset($_POST['exec2']) && $_POST['exec2']==="category_add") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$name = isset($_POST['name']) ? addslashes($_POST['name']) : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
		if(!$name) error("생성할 카테고리 이름을 입력하여 주십시오");
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		$check=mysql_fetch_array(zb_query("select count(*) from $t_category"."_$table_data[name] where name='$name'"));
		if($check[0]>0) Error("동일한 이름의 카테고리가 있습니다");
		zb_query("insert into $t_category"."_$table_data[name] (name) values ('$name')") or error("카테고리 추가시 에러가 발생했습니다");
		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif(isset($_POST['exec2']) && $_POST['exec2']==="del_category") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$category_no = isset($_REQUEST['category_no']) && is_numeric($_REQUEST['category_no']) ? $_REQUEST['category_no'] : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		zb_query("delete from $t_category"."_$table_data[name] where no='$category_no'",$connect) or Error("카테고리 삭제시 에러가 발생했습니다");
		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif(isset($_POST['exec2']) && $_POST['exec2']==="category_modify_ok") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$name = isset($_POST['name']) ? addslashes($_POST['name']) : '';
		$category_no = isset($_REQUEST['category_no']) && is_numeric($_REQUEST['category_no']) ? $_REQUEST['category_no'] : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
		if(!$name) error("수정할 카테고리 이름을 입력하여 주십시오");
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		zb_query("update $t_category"."_$table_data[name] set name='$name' where no='$category_no'",$connect);

		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// 카테고리 내용 이동 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="category_move") {
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
		$movename = isset($_POST['movename']) && is_numeric($_POST['movename']) ? $_POST['movename'] : '';
		$table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));
		foreach ($_POST['c'] as $value) {
			zb_query("update $t_board"."_$table_data[name] set category='$movename' where category='$value'",$connect);
		}

		$result = zb_query("select * from $t_category"."_$table_data[name]") or die(zb_error());
		while($data=mysql_fetch_array($result)) {
			$num = mysql_fetch_array(zb_query("select count(*) from $t_board"."_$table_data[name] where category='$data[no]'"));
			zb_query("update $t_category"."_$table_data[name] set num='$num[0]' where no = '$data[no]'") or die(zb_error());
		}

		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// 권한 설정 
	elseif(isset($_POST['exec2']) && $_POST['exec2']==="modify_grant_ok") {
		if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
				error("관리자 비밀번호가 틀렸습니다.");
		}
		$no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : '';
		$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : '10';
		$grant_list = isset($_POST['grant_list']) && is_numeric($_POST['grant_list']) ? $_POST['grant_list'] : '1';
		$grant_view = isset($_POST['grant_view']) && is_numeric($_POST['grant_view']) ? $_POST['grant_view'] : '1';
		$grant_write = isset($_POST['grant_write']) && is_numeric($_POST['grant_write']) ? $_POST['grant_write'] : '1';
		$grant_comment = isset($_POST['grant_comment']) && is_numeric($_POST['grant_comment']) ? $_POST['grant_comment'] : '1';
		$grant_reply = isset($_POST['grant_reply']) && is_numeric($_POST['grant_reply']) ? $_POST['grant_reply'] : '1';
		$grant_delete = isset($_POST['grant_delete']) && is_numeric($_POST['grant_delete']) ? $_POST['grant_delete'] : '1';
		$grant_html = isset($_POST['grant_html']) && is_numeric($_POST['grant_html']) ? $_POST['grant_html'] : '1';
		$grant_notice = isset($_POST['grant_notice']) && is_numeric($_POST['grant_notice']) ? $_POST['grant_notice'] : '1';
		$grant_view_secret = isset($_POST['grant_view_secret']) && is_numeric($_POST['grant_view_secret']) ? $_POST['grant_view_secret'] : '1';
		$grant_imagebox = isset($_POST['grant_imagebox']) && is_numeric($_POST['grant_imagebox']) ? $_POST['grant_imagebox'] : '1';
		zb_query("update $admin_table set grant_html='$grant_html', grant_list='$grant_list',
				grant_view='$grant_view', grant_comment='$grant_comment', grant_write='$grant_write',
				grant_reply='$grant_reply', grant_delete='$grant_delete', grant_notice='$grant_notice',
				grant_view_secret='$grant_view_secret', use_showip = '$grant_imagebox' where no='$no'") or Error("권한 설정 변경시 에러가 발생하였습니다".zb_error());
		movepage("{$_SERVER['PHP_SELF']}?exec=view_board&exec=view_board&exec2=grant&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}
?>
