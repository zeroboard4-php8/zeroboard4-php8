<?php 
// 스킨설정 가져오기
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	$setup = get_table_attrib($id);
    $config_file = 'skin/'.$setup['skinname'].'/get_config.php';
	if(!$_SS['version'] && file_exists($config_file)) {
		require_once $config_file;
        if($_SS['version']) {
          $_inclib_01 = 'skin/'.$setup['skinname'].'/include/dq_thumb_engine2.';
          if(file_exists($_inclib_01.php) && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
          else include_once $_inclib_01.'zend';
        }
	}

    if($_SS['version']) 
    {
        if(!$dqEngine['thumbfile_permit']) $dqEngine['thumbfile_permit'] = 0755;

        // 업로드 필드 1,2 처리
        if(($data['file_name1'] && !@eregi($zbUpload_dir,$data['file_name1'])) || ($data['file_name2'] && !@eregi($zbUpload_dir,$data['file_name2']))) 
        {
			$save_dir = 'data/'.$board_name.'/'.date('Y').'/'.date('m').'/'.date('d').'/';
			if(!file_exists($save_dir)) mkdirs($save_dir,$dqEngine['thumbfile_permit']);

		    // 업로드된 파일이 있을경우 처리 #1		
			if($data['file_name1']) {
				$save_filename = new_filename($data['s_file_name1'],$save_dir);
				@copy($data['file_name1'] , $save_dir.$save_filename);
				$t_data['file_name1'] = $save_dir.$save_filename;
				@chmod('./'.$t_data['file_name1'],$dqEngine['thumbfile_permit']);
        		zb_query("update $t_board"."_$board_name set file_name1='{$t_data['file_name1']}' where no='$no'") or error(zb_error());
                $tmp_dir = get_dirinfo(dirname('./'.$data['file_name1']));
                if(!$tmp_dir) @z_unlink($tmp_dir);
			}

	        // 업로드된 파일이 있을경우 처리 #2	
			if($data['file_name2']) {
				$save_filename = new_filename($data['s_file_name2'],$save_dir);
				@copy($data['file_name2'] , $save_dir.$save_filename);
				$t_data['file_name2'] = $save_dir.$save_filename;
				@chmod('./'.$t_data['file_name2'],$dqEngine['thumbfile_permit']);
				if(empty($fnum)) $fnum=0;
                $fnum++;
        		zb_query("update $t_board"."_$board_name set file_name2='{$t_data['file_name2']}' where no='$no'") or error(zb_error());
                $tmp_dir = get_dirinfo(dirname('./'.$data['file_name2']));
                if(!$tmp_dir) @z_unlink($tmp_dir);
			}
		}

        // 추가 업로드된 파일이 있을경우 처리 - 레볼루션
		$file_names   = '';
		$s_file_names = '';

		if(!empty($m_data['file_names']) && eregi('data2/',$m_data['file_names'])) {
			$tmp_files  = explode(',',$m_data['file_names']);
			$tmp_sfiles = explode(',',$m_data['s_file_names']);

			$rvUpload_dir  = 'data2/'.$board_name.'/'.date('Y').'/'.date('m').'/'.date('d').'/';
			mkdirs($rvUpload_dir,$dqEngine['thumbfile_permit']);

			//레볼루션 파일복사
			if($tmp_files) {
			  for($mImg_count=0; $mImg_count<999; $mImg_count++) {
				if($tmp_files[$mImg_count]) {
					$save_filename = new_filename($tmp_sfiles[$mImg_count],$rvUpload_dir);
					@copy($tmp_files[$mImg_count] , $rvUpload_dir.$save_filename);
					$tmp_files[$mImg_count] = $rvUpload_dir.$save_filename;
					@chmod('./'.$tmp_files[$mImg_count],$dqEngine['thumbfile_permit']);
				}
				$file_names .= $tmp_files[$mImg_count].',';
			  }
			}
		}

    // 본문에 삽입된 파일을 교정
        // 이미지 파일
        $old_link = 'revol_getimg.php?id='.$id.'&no='.$s_data['no'].'&num=';
        $new_link = 'revol_getimg.php?id='.$board_name.'&no='.$no.'&num=';
        $data['memo'] = str_replace($old_link,$new_link,$data['memo']);
        // 일반(다운로드) 파일
        $old_link = 'revol_download.php?id='.$id.'&no='.$s_data['no'].'&filenum=';
        $new_link = 'revol_download.php?id='.$board_name.'&no='.$no.'&filenum=';
        $data['memo'] = str_replace($old_link,$new_link,$data['memo']);

        zb_query('update '.$t_board.'_'.$board_name.' set memo=\''.$data['memo'].'\' where no='.$no) or error(zb_error());

		// DB에 데이터 입력
		if($m_data) zb_query("insert into dq_revolution (zb_id,zb_no,file_names,s_file_names,vote_users,is_hidden,is_vdel,is_slide,file_descript) values ('$board_name','$no','$file_names','{$m_data['s_file_names']}','{$m_data['vote_users']}','{$m_data['is_hidden']}','{$m_data['is_vdel']}','{$m_data['is_slide']}','{$m_data['file_descript']}')");

        // 이동할 게시판에 동일 카테고리가 있을때 동기화 시킴
        $s_cateName = get_zbCategoryName($id, $s_data['category']);
        $t_cateNo   = get_zbCategoryNo($board_name,$s_cateName);
        if($t_cateNo) {
            $category = $t_cateNo;
            zb_query("update $t_board"."_$board_name set category='$category' where no='$no'") or die(zb_error());
        }

        // 필드 검사
        if(empty($__field_check)) {
            $_chk = @mysql_field_name(zb_query("SELECT modify_date from $t_board"."_$board_name"),0);
            if(!$_chk) {
                zb_query("ALTER TABLE `$t_board"."_$board_name` ADD `modify_date` INT(1)") or error(zb_error());
                zb_query("update $t_board"."_$board_name set modify_date=reg_date where modify_date < 1") or error(zb_error());
            }
            $_chk = mysql_field_name(zb_query("SELECT mother from `$t_comment"."_".$board_name."`"),0);
			if(!$_chk) {
                zb_query("ALTER TABLE `$t_board"."_comment"."_".$board_name."` ADD `mother` INT(1) NOT NULL DEFAULT 0, ADD `depth` INT(1) NOT NULL DEFAULT 0") or error(zb_error());
			}
            $__field_check = true;
        }

        // 코멘트 정리
        $comment_result=zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date",$connect) or error(zb_error());
        while($comment_data=mysql_fetch_array($comment_result)) {
            $comment_data['memo']=addslashes($comment_data['memo']);
            $comment_data['name']=addslashes($comment_data['name']);
            if($comment_data['mother']) $comment_data['mother'] = $mother_data[$comment_data['mother']];
            zb_query("insert into $t_comment"."_$board_name (parent,ismember,name,password,memo,reg_date,ip,mother,depth) values ('$no','{$comment_data['ismember']}','{$comment_data['name']}','{$comment_data['password']}','{$comment_data['memo']}','{$comment_data['reg_date']}','{$comment_data['ip']}','{$comment_data['mother']}','{$comment_data['depth']}')") or error(zb_error());
            $mother_data[$comment_data['no']] = mysql_insert_id();
        }

        if(!empty($_SS['using_addRecommentPoint']) && !empty($_SS['RecommentPointValue']) && !empty($data['ismember']) && $board_name == $_SS['move_vote3']) {
            addRecommentOwnerPoint( $data['ismember'],$_SS['RecommentPointValue']);
        }

        // 최근 고침시간 기록
        $_chk = @mysql_field_name(zb_query("SELECT modify_date from $t_board"."_$board_name"),0);
        if(!$_chk) {
            zb_query("ALTER TABLE `$t_board"."_$board_name` ADD `modify_date` INT(1)") or error(zb_error());
            zb_query("update $t_board"."_$board_name set modify_date=reg_date where modify_date < 1") or error(zb_error());
        }
        zb_query("update $t_board"."_$board_name set modify_date=".time()." where no='$no'") or die(zb_error());

        // 캐쉬 처리
        revolution_cache_clear();
    }
    else 
    {
        $comment_result=zb_query("select * from $t_comment"."_$id where parent='{$data['no']}' order by reg_date",$connect) or error(zb_error());
        while($comment_data=mysql_fetch_array($comment_result)) {
            $comment_data['memo']=addslashes($comment_data['memo']);
            $comment_data['name']=addslashes($comment_data['name']);
            zb_query("insert into $t_comment"."_$board_name (parent,ismember,name,password,memo,reg_date,ip) values ('$no','{$comment_data['ismember']}','{$comment_data['name']}','{$comment_data['password']}','{$comment_data['memo']}','{$comment_data['reg_date']}','{$comment_data['ip']}')") or error(zb_error());
        }
    }
?>
