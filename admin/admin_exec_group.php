<?php
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$is_open = empty($_POST['is_open']) ? '0' : '1';
	$use_join = empty($_POST['use_join']) ? '0' : '1';
	$use_icon = isset($_POST['use_icon']) && in_array($_POST['use_icon'], array('0', '1', '2')) ? $_POST['use_icon'] : '1';
	$join_return_url = isset($_POST['join_return_url']) ? $_POST['join_return_url'] : '';
	$header_url = isset($_POST['header_url']) ? $_POST['header_url'] : '';
	$header = isset($_POST['header']) ? $_POST['header'] : '';
	$footer_url = isset($_POST['footer_url']) ? $_POST['footer_url'] : '';
	$footer = isset($_POST['footer']) ? $_POST['footer'] : '';
	
	function del_member($no) {
		global $group_no, $member_table, $get_memo_table, $send_memo_table, $admin_table, $t_board, $t_comment, $connect, $group_table, $member;

		$member_data = mysql_fetch_array(zb_query("select * from $member_table where no = '$no'"));
		if($member['is_admin']>1&&$member['no']!=$member_data['no']&&$member_data['level']<=$member['level']&&$member_data['is_admin']<=$member['is_admin']) error("선택하신 회원의 정보를 변경할 권한이 없습니다");

		// 멤버 정보 삭제
		zb_query("delete from $member_table where no='$no'") or error(zb_error());

		// 쪽지 테이블에서 멤버 정보 삭제
		zb_query("delete from $get_memo_table where member_no='$no'") or error(zb_error());
		zb_query("delete from $send_memo_table where member_no='$no'") or error(zb_error());

		// 그룹테이블에서 회원수 -1
		zb_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(zb_error());
	
		// 이름 그림, 아이콘, 이미지 박스 사용용량 파일 삭제
		@z_unlink("icon/private_name/".$no.".gif");
		@z_unlink("icon/private_icon/".$no.".gif");
		@z_unlink("icon/member_image_box/".$no."_maxsize.php");
	}

	if(isset($_POST['exec'])) {
		if(!check_csrf_token()) Error('CSRF 토큰이 일치하지 않습니다.');
		// 그룹추가
		if($_POST['exec']=="add_group_ok") {
			if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
			$isold = false;
			if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
			if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
					error("관리자 비밀번호가 틀렸습니다.");
			}
			if(isset($_SESSION['csrf_token'])) unset($_SESSION['csrf_token']);
			if($member['is_admin']>1) Error("그룹생성 권한이 없습니다");
			if(isblank($_POST['name'])) Error("그룹이름은 필수로 지정하셔야 합니다");
			// 중복 이름 검사
			$check=mysql_fetch_array(zb_query("select count(*) from $group_table where name='{$_POST['name']}'"));
			if($check[0]) Error("$name 이라는 이름의 그룹이 이미 있습니다");

			if($_FILES['icon']) {
				$icon = $_FILES['icon']['tmp_name'];
				$icon_name = $_FILES['icon']['name'];
				$icon_type = $_FILES['icon']['type'];
				$icon_size = $_FILES['icon']['size'];
			}

			// 아이콘 파일 업로드시
			if($icon_name) {
				if(!eregi(".gif",$icon_name)&&!eregi(".jpg",$icon_name)&&!eregi(".png",$icon_name)) Error("아이콘은 gif 또는 jpg 파일을 올려주세요");
				$size=GetImageSize($icon);
				if($size[0]>24||$size[1]>24) Error("아이콘의 크기는 24*24이하여야 합니다");
				$kind=array("","gif","jpg");
				$n=$size[2];
				@copy($icon,"icon/group_".$_POST['name'].".".$kind[$n]);
				$icon_name="group_{$_POST['name']}.".$kind[$n];
			}

			// 헤더푸터
			$header=addslashes($header);
			$header_url=addslashes($header_url);
			$footer=addslashes($footer);
			$footer_url=addslashes($footer_url);

			//DB에 입력
			zb_query("insert into $group_table (name,is_open,icon,use_join,join_return_url, use_icon, header,footer,header_url,footer_url)
							values ('{$_POST['name']}','$is_open','$icon_name','$use_join','$join_return_url','$use_icon','$header','$footer','$header_url','$footer_url')") or Error("그룹생성 에러가 났습니다");
			$group_no=mysql_insert_id();
			movepage("{$_SERVER['PHP_SELF']}?exec=view_group&group_no=$group_no");
		}
		// 그룹수정 완료
		elseif($_POST['exec']=="modify_group_ok") {
			if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
			$isold = false;
			if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
			if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
					error("관리자 비밀번호가 틀렸습니다.");
			}
			if($member['is_admin']>2) Error("그룹수정 권한이 없습니다");
			if($member['is_admin']==2&&$member['group_no']!=$group_no) Error("그룹수정 권한이 없습니다");
			if(isblank($_POST['name'])) Error("그룹이름은 필수로 지정하셔야 합니다");
			if(isset($del_icon)) $icon_sql=",icon=''";
			// 아이콘 파일 업로드시
			if($_FILES['icon']) {
				$icon = $_FILES['icon']['tmp_name'];
				$icon_name = $_FILES['icon']['name'];
				$icon_type = $_FILES['icon']['type'];
				$icon_size = $_FILES['icon']['size'];
			}

			if($icon_name) {
				if(!eregi(".gif",$icon_name)&&!eregi(".jpg",$icon_name)&&!eregi(".png",$icon_name)) Error("아이콘은 gif 또는 jpg 파일을 올려주세요");
				$size=GetImageSize($icon);
				if($size[0]>24||$size[1]>24) Error("아이콘의 크기는 24*24이하여야 합니다");
				$kind=array("","gif","jpg");
				$n=$size[2];
				@copy($icon,"icon/group_".$_POST['name'].".".$kind[$n]);
				$icon_name="group_{$_POST['name']}.".$kind[$n];
				$icon_sql=",icon='$icon_name'";
			}
			// 헤더푸터
			$header=addslashes($header);
			$header_url=addslashes($header_url);
			$footer=addslashes($footer);
			$footer_url=addslashes($footer_url);
			if(!isset($use_hobby)) $use_hobby='';
			if(!isset($icon_sql)) $icon_sql='';

			//DB에 입력
			zb_query("update $group_table set
							use_hobby='$use_hobby',name='{$_POST['name']}',is_open='$is_open' $icon_sql ,use_join='$use_join',join_return_url='$join_return_url',use_icon='$use_icon',
							header='$header',footer='$footer',footer_url='$footer_url',header_url='$header_url' 
							where no='$group_no'") or Error("그룹수정 에러가 났습니다");
			movepage("{$_SERVER['PHP_SELF']}?exec=view_group&group_no=$group_no&exec=modify_group");
		}
		// 그룹삭제 완료
		elseif($_POST['exec']=="del_group_ok") {
			if(empty($_POST['admin_passwd'])) Error("관리자 비밀번호를 입력해주세요.");
			$isold = false;
			if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
			if($member['password'] != get_password($_POST['admin_passwd'], $isold)) {
					error("관리자 비밀번호가 틀렸습니다.");
			}
			if($member['is_admin']>1) Error("그룹삭제 권한이 없습니다");
			// 삭제할 그룹의 회원수와 게시판 수를 구함
			$num=mysql_fetch_array(zb_query("select member_num, board_num from $group_table where no='$group_no'"));

			// 멤버 이동
			if(isset($_POST['member_move'])) {
				zb_query("update $member_table set group_no='{$_POST['member_move']}' where group_no='$group_no'") or Error("회원 이동시에 에러가 발생하였습니다");
				zb_query("update $group_table set member_num=member_num+".$num['member_num']." where no='{$_POST['member_move']}'");
			} else {
				$result = zb_query("select no from $member_table where group_no='$group_no'") or Error("회원 이동시에 에러가 발생하였습니다");
				while($data=mysql_fetch_array($result)) {
					$no = $data['no'];
					del_member($no);
				}
			}

			// 게시판이동
			if(isset($_POST['board_move'])) {
				zb_query("update $admin_table set group_no='{$_POST['board_move']}' where group_no='$group_no'") or Error("게시판 이동시에 에러가 발생하였습니다");
				zb_query("update $group_table set board_num=board_num+".$num['board_num']." where no='{$_POST['board_move']}'");
			} else {
				$temp=zb_query("select name from $admin_table where group_no='$group_no'");
				while($data=mysql_fetch_array($temp)) {
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
				}
				zb_query("delete from $admin_table where group_no='$group_no'");
			}

			// 그룹삭제                                                                                                
			zb_query("delete from $group_table where no='$group_no'") or Error("그룹삭제시 에러가 발생하였습니다");
                                                                                                              
			movepage($_SERVER['PHP_SELF']);                                                                                     
		}                                                                                                           
		// 가입양식 변경                                                                                            
		elseif($_POST['exec']=="modify_member_join_ok") {
			$join_level = in_array($_POST['join_level'], array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10')) ? $_POST['join_level'] : '9';
			if(empty($_POST['use_icq'])) $use_icq=0; else $use_icq=1;
			if(empty($_POST['use_aol'])) $use_aol=0; else $use_aol=1;
			if(empty($_POST['use_msn'])) $use_msn=0; else $use_msn=1;
			if(empty($_POST['use_jumin'])) $use_jumin=0; else $use_jumin=1;
			if(empty($_POST['use_comment'])) $use_comment=0; else $use_comment=1;
			if(empty($_POST['use_job'])) $use_job=0; else $use_job=1;
			if(empty($_POST['use_hobby'])) $use_hobby=0; else $use_hobby=1;
			if(empty($_POST['use_home_address'])) $use_home_address=0; else $use_home_address=1;
			if(empty($_POST['use_home_tel'])) $use_home_tel=0; else $use_home_tel=1;
			if(empty($_POST['use_office_address'])) $use_office_address=0; else $use_office_address=1;
			if(empty($_POST['use_office_tel'])) $use_office_tel=0; else $use_office_tel=1;
			if(empty($_POST['use_handphone'])) $use_handphone=0; else $use_handphone=1;
			if(empty($_POST['use_mailing'])) $use_mailing=0; else $use_mailing=1;
			if(empty($_POST['use_birth'])) $use_birth=0; else $use_birth=1;
			if(empty($_POST['use_picture'])) $use_picture=0; else $use_picture=1;
			zb_query("update $group_table set join_level='$join_level',use_icq='$use_icq',use_aol='$use_aol',use_msn='$use_msn',   
			use_jumin='$use_jumin',use_comment='$use_comment',use_job='$use_job',use_hobby='$use_hobby',          
			use_home_address='$use_home_address',use_home_tel='$use_home_tel',use_office_address='$use_office_address',
			use_office_tel='$use_office_tel',use_handphone='$use_handphone',use_mailing='$use_mailing',          
			use_birth='$use_birth',use_picture='$use_picture' where no='$group_no'") or error(zb_error());              
			movepage("{$_SERVER['PHP_SELF']}?exec=modify_member_join&group_no=$group_no");                                                  
		}    
	}    

?>
