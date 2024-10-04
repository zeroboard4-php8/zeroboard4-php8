<?php
//마지막 수정일 : 2011-10-13

if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');
$del_que1 = $del_que2 = null;

// 업로드 갯수 한계치
    if($setup['use_pds'] && !empty($file_virtName)) 
    {
		$zbUpload_dir  = 'data/'.$id.date('/Y/m/d/');
    	$rvUpload_dir  = 'data2/'.$id.date('/Y/m/d/');
		$file_virtName = str_replace(',,','',$file_virtName);
		$file_virtName = ereg_replace("^,|,$",'',$file_virtName);
		$file_realName = str_replace(',,','',$file_realName);
		$file_realName = ereg_replace("^,|,$",'',$file_realName);
        $file_realName = del_html($file_realName);

        $tmp_files  = explode(',',$file_virtName);
		$tmp_sfiles = explode(',',$file_realName);
        $count_back = $tmp_files;
		$swf_tempDir = 'data/__DQ_Revolution_MultiUpload_TempDir__/';

        // 토토루 스킨 데이터 가져오기
        if(chk_table_name('zetyx_upload')) {
            $tMutiupload = mysql_fetch_array(zb_query("select sfilename from zetyx_upload where sid='$id' and sno='$data[no]' order by no asc limit 0,1"));
        }
        if($tMutiupload['sfilename']) {
            $t_result = zb_query("select * from zetyx_upload where sid='$id' and sno='$no' order by no asc");
            while($tm_data = mysql_fetch_array($t_result)) {
                $tmp_ttrFiles  .= 'data/mutiupload/'.$id.'/'.$tm_data['sfilename'].',';
                $tmp_sttrFiles .= $tm_data['sfileorgname'].',';
            }
            $m_data['file_names']   = $tmp_ttrFiles . $m_data['file_names'];
            $m_data['s_file_names'] = $tmp_sttrFiles . $m_data['s_file_names'];
        }

        if($s_data['file_name1']) $old_files[] = $s_data['file_name1'];
        if($s_data['file_name2']) $old_files[] = $s_data['file_name2'];
        $tmp = explode(',',$m_data['file_names']);
        $len = count($tmp);
        for($i=0; $i<$len; $i++) {
          if($tmp[$i]) $old_files[] = $tmp[$i];
        }

        if($mode == 'modify') 
        {
            // 수정 모드에서 썸네일 위치를 바꾼 파일을 찾아내어 일치시킴
            for($i=0; $i < count($tmp_files); $i++)
            {
                if(eregi("^revol_getimg.\php",$tmp_files[$i])) {
                  $tmp = parse_url($tmp_files[$i]);
                  $tmp = explode('&',$tmp['query']);
                  if(eregi('num=',$tmp[2])) {
                    $old_target = substr($tmp[2],4,strlen($tmp[2]));
                    $tmp_files[$i] = $old_files[$old_target];
                    $targetThumbnail = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$s_data['reg_date']).'_sThumb_'.$no.'_'.$i.$dqEngine['defult_ext'];
                    @unlink($targetThumbnail);
                  }              
                }
            }

            // 썸네일에서 삭제된 파일들을 실제로 삭제함
            for($i=0; $i < count($old_files); $i++)
            {
                if(!in_array($old_files[$i],$tmp_files)) @unlink($old_files[$i]);
            }
        }

        $moving_file_list = array();

		for($i=0; $i < count($tmp_files); $i++) 
        {
            if(!$tmp_files[$i]) continue;
            //if($tmp_files[$i] == $old_files[$old_target]) continue;

            //확장자 검사
            chk_cgifile($tmp_sfiles[$i]);

            //특수문자 변환
            $tmp_files[$i] = ereg_replace(" |\+|\"|\'","_",rawurldecode($tmp_files[$i]));

            if(!eregi('/',$tmp_files[$i])) 
            {
              $old_ilink[$i] = 'revol_getimg.php?id='.$id.'&file_id='.$tmp_files[$i];

              //파일이름을 세션에서 가져옴
              $tmp_sessionName[] = $tmp_files[$i];
              $_ufile_session = get_uploadFileSession($swf_tempDir);
              $tmp_files[$i] = $swf_tempDir.$_ufile_session[$tmp_files[$i]];
            }

            $old = eregi("^data",$tmp_files[$i]) ? $tmp_files[$i] : $swf_tempDir.$tmp_files[$i];
            if(!eregi("^data2/$id/",$tmp_files[$i])) {
              $tmp_files[$i] = $rvUpload_dir.new_filename($rvUpload_dir.$tmp_sfiles[$i]);
            }

            //이미지 파일 검사
            $is_imageFile = is_imageFile($old);
            if($is_imageFile) {
              $_SS['check_imageFileFound_pass'] = true;
              // 화소 수 제한
              chk_PixelLimit($old,$tmp_sfiles[$i]);
            }

            if(!file_exists($rvUpload_dir)) {
              mkdirs($rvUpload_dir,$dqEngine['thumbfile_permit']);
            }
            if(!file_exists($zbUpload_dir)) {
              mkdirs($zbUpload_dir,$dqEngine['thumbfile_permit']);
            }

            // 이미지 컨버팅
            if($is_imageFile) $_call_imgConvert = chk_is_ImageConvertMode($old);
            $_support_ImageType = chk_GDImageType($old);
            if($_call_imgConvert) 
            {
              if($dqEngine['imgConvertingMode']) $tmp_sfiles[$i] .= '.'.$_support_ImageType;
              $cvt_img = img_convert($old,$tmp_files[$i]);
              if(!$cvt_img || $cvt_img == $old) delete_uploadTmpFiles($moving_file_list,"이미지 컨버팅 도중에 문제가 발생했습니다");
              else {
                $tmp_files[$i] = $cvt_img;
                $moving_file_list[$old] = $tmp_files[$i];
              }
            }
            elseif(file_exists($old) && !rename($old,$tmp_files[$i]))
            {
              delete_uploadTmpFiles($moving_file_list,"파일을 이동하는 도중에 문제가 발생했습니다. rvUploadField".$i);
            } else {
              $moving_file_list[$old] = $tmp_files[$i];
            }
            @chmod($tmp_files[$i],$dqEngine['thumbfile_permit']);
		}

		if(file_exists($tmp_files[0])) {
			$file_name1   = array_shift($tmp_files);
			$s_file_name1 = array_shift($tmp_sfiles);
            if(!eregi("^data/$id/",$file_name1)) {
    			$new_name = $zbUpload_dir.new_filename($zbUpload_dir.$file_name1);
	    		if(!rename($file_name1,$new_name)) delete_uploadTmpFiles($moving_file_list,"파일 이동하는 도중에 문제가 발생했습니다. zbUploadField1");
                else $moving_file_list[$file_name1] = $new_name;
                $memo = eregi_replace($file_name1,$new_name,$memo);
		    	$file_name1   = $new_name;
            }
		}
		if(file_exists($tmp_files[0]) && $_SS['using_upload2']) {
			$file_name2   = array_shift($tmp_files);
			$s_file_name2 = array_shift($tmp_sfiles);
            if(!eregi("^data/$id/",$file_name2)) {
    			$new_name = $zbUpload_dir.new_filename($zbUpload_dir.$file_name2);
	    		if(!rename($file_name2,$new_name)) delete_uploadTmpFiles($moving_file_list,"파일을 이동하는 도중에 문제가 발생했습니다. zbUploadField2");
                else $moving_file_list[$file_name2] = $new_name;
                $memo = eregi_replace($file_name2,$new_name,$memo);
		    	$file_name2   = $new_name;
            }
		}
		$file_names   = implode(",",$tmp_files);
		$s_file_names = implode(",",$tmp_sfiles);
	// 일반 업로드
	} elseif($setup['use_pds'] && (!empty($_FILES['file1']['name']) || !empty($_FILES['file2']['name']))) {
		$file_names='';
		$s_file_names='';
		if(!empty($_FILES['file1']['name'])) {
			$file1 = $_FILES['file1']['tmp_name'];
			$file1_name = $_FILES['file1']['name'];
			$file1_size = $_FILES['file1']['size'];
			$file1_type = $_FILES['file1']['type'];
		} else {
			$file_name1 = '';
			$s_file_name1 = '';
		}
		if(!empty($_FILES['file2']['name'])) {
			$file2 = $_FILES['file2']['tmp_name'];
			$file2_name = $_FILES['file2']['name'];
			$file2_size = $_FILES['file2']['size'];
			$file2_type = $_FILES['file2']['type'];
		} else {
			$file_name2 = '';
			$s_file_name2 = '';
		}
		if(isset($file1_size)&&$file1_size>0&&$setup['use_pds']&&$file1) {
			if(!is_uploaded_file($file1)) Error('정상적인 방법으로 업로드 해주세요');
			if($file1_name==$file2_name) Error('같은 파일은 등록할수 없습니다');
			$file1_size=filesize($file1);

			if($setup['max_upload_size']<$file1_size&&!$is_admin) error('첫번째 파일 업로드는 최고 '.GetFileSize($setup['max_upload_size']).' 까지 가능합니다');

			// 업로드 금지
			if($file1_size>0) {
				$s_file_name1=$file1_name;
				$s_file_name1_org=$file1_name;
				if (preg_match('/\.(php|php3|html|inc|phtm|htm|shtm|ztx|dot|asp|cgi|pl|htaccess|htpasswd)$/i', $s_file_name1)) {
					error('Html, PHP 관련파일은 업로드할수 없습니다');
				}

				//확장자 검사
				if($setup["pds_ext1"]) {
					$temp=str_replace(',','|', $setup["pds_ext1"]);
					if(!preg_match("/\.($temp)$/i", $s_file_name1)) Error('첫번째 업로드는 $setup[pds_ext1] 확장자만 가능합니다');
				}

				// 파일명을 암호화 저장.
				$s_file_name1_org = md5(uniqid(mt_rand(), true)).".".array_pop(explode(".",$s_file_name1_org));

				// 디렉토리를 검사함
				if(!is_dir("data/".$id)) { 
					@mkdir("data/".$id,0777);
					@chmod("data/".$id,0706);
				}

					if(!move_uploaded_file($file1,"data/$id/".$s_file_name1_org)) Error('파일업로드가 제대로 되지 않았습니다');
					$file_name1="data/$id/".$s_file_name1_org;   
					@chmod($file_name1,0706);
			}
		}
		if(isset($file2_size)&&$file2_size>0&&$setup['use_pds']&&$file2) {
			if(!is_uploaded_file($file2)) Error('정상적인 방법으로 업로드 해주세요');
			$file2_size=filesize($file2);
			if($setup['max_upload_size']<$file2_size&&!$is_admin) error('파일 업로드는 최고 '.GetFileSize($setup['max_upload_size']).' 까지 가능합니다');
			if($file2_size>0) {
				$s_file_name2=$file2_name;
				$s_file_name2_org=$file2_name;
				if (preg_match('/\.(php|php3|html|inc|phtm|htm|shtm|ztx|dot|asp|cgi|pl|htaccess|htpasswd)$/i', $s_file_name2)) {
					error('Html, PHP 관련파일은 업로드할수 없습니다');
				}

				//확장자 검사
				if($setup["pds_ext2"]) {
					$temp=str_replace(',','|', $setup["pds_ext2"]);
					if(!preg_match("/\.($temp)$/i", $s_file_name2)) Error('첫번째 업로드는 $setup[pds_ext2] 확장자만 가능합니다');
				}

				// 파일명을 암호화 저장.
				$s_file_name2_org = md5(uniqid(mt_rand(), true)).".".array_pop(explode(".",$s_file_name2_org));

				// 디렉토리를 검사함
				if(!is_dir("data/".$id)) {
					mkdir("data/".$id,0777);
					@chmod("data/".$id,0706);
				}

			
					if(!move_uploaded_file($file2,"data/$id/".$s_file_name2_org)) Error('파일업로드가 제대로 되지 않았습니다');
					$file_name2="data/$id/".$s_file_name2_org;              
					@chmod($file_name2,0706);
			}	
		}
	} else {
		$file_name1='';
		$file_name2='';
		$s_file_name1='';
		$s_file_name2='';
		$file_names='';
		$s_file_names='';
	}

    if(!empty($_SS['check_imageFileFound']) && empty($_SS['check_imageFileFound_pass']))
      delete_uploadTmpFiles($moving_file_list,'반드시 하나 이상의 이미지 파일을 업로드 하셔야 합니다');

// sitelink2를 옵션용으로 사용, 처리
  //$sitelink2 = "";
  if(!empty($use_thumbimg)) $sitelink2 .= "||1";
  else $sitelink2 .= "||0";
  if(!empty($viewer_level)) $sitelink2 .= "||".$viewer_level;
  else $sitelink2 .= "||0";


// 수정글일때
	if($mode=="modify"&&$no) {
		if($s_data['ismember']) {
			if(!$is_admin&&$member['level']>$setup['grant_delete']&&$s_data['ismember']!=$member['no']) error("정상적인 방법으로 수정하세요");
		}

	// 비밀번호 검사;;
		if($s_data['ismember']!=$member['no']&&!$is_admin) {
			$_POST['password']=isset($_POST['password']) ? zb_escape_string($_POST['password']) : '';
			$password=get_password($_POST['password']);
			if(strlen($s_data['password'])<=16&&strlen(get_password("a"))>=41) $password=get_password('$_POST[password]', true);
			if($password!==$s_data['password']) Error("비밀번호가 틀렸습니다");
		}

	// 파일삭제
		if(isset($del_file1) && $del_file1==1) {@z_unlink('./'.$s_data['file_name1']);$del_que1=",file_name1='',s_file_name1=''";} 
		if(isset($del_file2) && $del_file2==1) {@z_unlink('./'.$s_data['file_name2']);$del_que2=",file_name2='',s_file_name2=''";}

	// 파일등록
		if(!empty($file_name1) && $file_name1 != $s_data['file_name1'] && $file_name1 != $s_data['file_name2'])
          {@z_unlink('./'.$s_data['file_name1']);$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
		if(!empty($file_name2) && $file_name2 != $s_data['file_name1'] && $file_name2 != $s_data['file_name2'])
          {@z_unlink('./'.$s_data['file_name2']);$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	// 장터기능 사용중일때
		if($memo2) {
			if($_SS['using_market']) {
				$memo2 = addslashes(str_replace('ㅤ','',$memo2));
				if(!$is_admin&&$setup['grant_html']<$member['level']) {

				// 내용의 HTML 금지;;
					if(!$use_html||$setup['use_html']==0) $memo2=del_html($memo2);

				// HTML의 부분허용일때;;
					if($use_html&&$setup['use_html']==1) {
						$memo2=str_replace("<","&lt;",$memo2);
						$tag=explode(",",$setup['avoid_tag']);
						for($i=0;$i<count($tag);$i++) {
							if(!isblank($tag[$i])) { 
								$memo2=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo2); 
								$memo2=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo2); 
								$memo2=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo2); 
							}
						}  
					}
				} else {
					if(!$use_html) {
						$memo2=del_html($memo2);
					}
				}
				if($use_html<2) {
					$memo2=str_replace('  ','&nbsp;&nbsp;',$memo2);
					$memo2=str_replace("\t",'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$memo2);
				}
				$mtime = date('Y년m월d일 H시i분s초',time());
				//$memo2 = "<div style=\"padding-left:20px\">$memo2</div>";
				$memo = $memo."\n\n-> ".$mtime."에 추가된 내용입니다.\n".$memo2;
			}
		}

	// 공지 -> 일반글 
		if(!$notice&&$s_data['headnum']<="-2000000000") {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		// 헤드넘+1 한값을 가짐;;
			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000 and no < '$no' "));
			$headnum=$max_headnum[0]-1; 
			zb_query("UPDATE $t_board"."_$id SET headnum = headnum-1 where no > $no");

			$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'")); // 다음글을 구함;;
			if(!$next_data[0]) $next_data[0]="0";
			$next_no=$next_data[0];

			if(!$next_data[division]) $division=1; else $division=$next_data['division'];

			$prev_data=mysql_fetch_array(zb_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<'$headnum' and no!='$no' order by headnum desc limit 1")); // 이전글을 구함;;
			if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no=0;

			$child="0";
			$depth="0";    
			$arrangenum="0";
			$father="0";

			minus_division($s_data['division']);
			@zb_query("update $t_board"."_$id set headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category',x='$x',y='$y',password='$password' $del_que1 $del_que2 $addstr_DBUpdate where no='$no'") or error(zb_error());
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
		elseif($notice&&$s_data['headnum']>-2000000000) {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division=$temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum=mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));  // 최고글을 구함;;
			$headnum = $max_headnum[0]-1;
			if($headnum>-2000000000) $headnum=-2000000000; // 최고 headnum이 공지가 아니면 현재 글에 공지를 넣음;

			$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division = '$second_division') and headnum='$max_headnum[0]' and arrangenum='0'"));
			if(!$next_data[0]) $next_data[0]="0";
			$next_no = $next_data[0];
			$prev_no = 0;
			$child   = '0';
			$depth   = '0';
			$arrangenum='0';
			$father  = '0';
			minus_division($s_data['division']);
			$division=add_division();
			@zb_query("update $t_board"."_$id set division='$division',headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category',x='$x',y='$y',password='$password' $del_que1 $del_que2 $addstr_DBUpdate where no='$no'") or error(zb_error());

			if($s_data[father]) zb_query("update $t_board"."_$id set child='$s_data[child]' where no='$s_data[father]'"); // 답글이었으면 원본글의 답글을 현재글의 답글로 대체
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
			@zb_query("update $t_board"."_$id set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category',x='$x',y='$y',password='$password' $del_que1 $del_que2 $addstr_DBUpdate where no='$no'") or error(zb_error());

			zb_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
			zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
		}

		// 다중업로드 파일 처리
			$del_que3 ="file_names='$file_names',s_file_names='$s_file_names',is_vdel='$is_vdel'";

			if(!empty($m_data['no']))	{
				@zb_query("update dq_revolution set $del_que3 where zb_id='$id' and zb_no='$no'") or error(zb_error());
			} else {
				@zb_query("insert into dq_revolution (zb_id,zb_no,file_names,s_file_names,is_vdel) values ('$id','$no','$file_names','$s_file_names','$is_vdel')") or error(zb_error());
			}
			$mdata_insert = "1";

		// 파일설명 처리
			if(!empty($m_data['no']) || !empty($mdata_insert))	{
				@zb_query("update dq_revolution set file_descript='$file_descript' where zb_id='$id' and zb_no='$no'") or error(zb_error());
			} elseif($file_descript) {
				@zb_query("insert into dq_revolution (zb_id,zb_no,file_descript) values ('$id','$no','$file_descript')") or error(zb_error());
			}
	} 
/***************************************************************************
 * 답변글일때
 **************************************************************************/
    elseif($mode=="reply"&&$no) 
    {

		$prev_no = $s_data['prev_no'];
		$next_no = $s_data['next_no'];
		$father  = $s_data['no'];
		$child   = 0;
		$headnum = $s_data['headnum'];    
		if($headnum<=-2000000000&&$notice) error("공지사항에는 답글을 달수가 없습니다");
		$depth = $s_data['depth']+1;
		$arrangenum = $s_data['arrangenum']+1;
		$move_result = zb_query("select no from $t_board"."_$id where division='$s_data[division]' and headnum='$headnum' and arrangenum>='$arrangenum'");
		while($move_data = mysql_fetch_array($move_result)) {
			zb_query("update $t_board"."_$id set arrangenum=arrangenum+1 where no='$move_data[no]'");
		}

		$division=$s_data['division'];
		plus_division($s_data['division']);
   
		// 답글 데이타 입력;;
		if(empty($member['no'])) $member['no']='0';
		zb_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(zb_error());    

		$no = mysql_insert_id();

		// 원본글과 원본글의 아래글의 속성 변경;;
		zb_query("update $t_board"."_$id set child = '$no' where no = '$s_data[no]'");
		zb_query("update $t_category"."_$id set num = num+1 where no = '$category'",$connect);

		// 다중업로드 파일 처리
		if(eregi("data2/",$file_names)) {
			zb_query("insert into dq_revolution (zb_id,zb_no,file_names,s_file_names,file_descript,vote_users) values ('$id','$no','$file_names','$s_file_names','$file_descript','')") or error(zb_error());
			$mdata_insert = '1';
		}

		// 파일설명 처리
		if(empty($mdata_insert) && !empty($file_descript)) @zb_query("insert into dq_revolution (zb_id,zb_no,file_descript,vote_users) values ('$id','$no','$file_descript','')") or error(zb_error());

        // 현재글의 조회수를 올릴수 없게 세션 등록
		$_SESSION['zb_hit'] .= ','.$setup['no'].'_'.$no;

		// 현재글의 추천을 할수 없게 세션 등록
		$_SESSION['zb_vote'] .= ','.$setup['no'].'_'.$no;

		// 응답글 보내기일때;;
		if( $s_data['reply_mail'] && $s_data['email'] ) {

			if($use_html < 2) $memo=nl2br($memo);
			$memo = stripslashes($memo);

			zb_sendmail($use_html, $s_data['email'], $s_data['name'], $email, $name, $subject, $memo);
		}

		// 파일설명 처리
		if($file_descript)
			@zb_query("insert into dq_revolution (zb_id,zb_no,file_descript) values ('$id','$no','$file_descript')") or error(zb_error());

/***************************************************************************
 * 신규 글쓰기일때
 **************************************************************************/
	} elseif($mode=='write') {

		// 공지사항이 아닐때;;
		if(!$notice) {
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division = $temp[0];
			$temp=mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum  = mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000"));
			if(!$max_headnum[0]) $max_headnum[0]=0;

			$headnum = $max_headnum[0]-1;

			$next_data=mysql_fetch_array(zb_query("select division,headnum,arrangenum from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
			if(!$next_data[0]) $next_data[0]="0";
			else {
				$next_data=mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
			}
    
			$prev_data=mysql_fetch_array(zb_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<=-2000000000 order by headnum desc limit 1"));
			if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no="0";

		// 공지사항일때;; 
		} else {
			$temp = mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id"));
			$max_division = $temp[0]+1;
			$temp = mysql_fetch_array(zb_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
			if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

			$max_headnum = mysql_fetch_array(zb_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));
			$headnum = $max_headnum[0]-1;
			if($headnum>-2000000000) $headnum=-2000000000;

			$next_data = mysql_fetch_array(zb_query("select division,headnum from $t_board"."_$id where division='$max_division' or division='$second_division' order by headnum limit 1"));
			if(!$next_data[0]) $next_data[0]="0";
			else {
				$next_data = mysql_fetch_array(zb_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='0'"));
			}
			$prev_no = 0; 
            if(!empty($_SS['using_secretonly'])) $is_secret = 0;
		}

		if(!$next_data[0]) $next_data[0] = '0';
		$next_no=$next_data[0];
		$child = '0';
		$depth = '0';
		$arrangenum = '0';
		$father = '0';
		$division = add_division();
		
		if(empty($member['no'])) $member['no']='0';
		zb_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(zb_error());
		$no=mysql_insert_id();

		// 다중업로드 파일 처리
		if(!empty($file_names) && eregi("data2/",$file_names)) {
			zb_query("insert into dq_revolution (zb_id,zb_no,file_names,s_file_names,file_descript,vote_users) values ('$id','$no','$file_names','$s_file_names','$file_descript','')") or error(zb_error());
			$mdata_insert = '1';
		}

		// 파일설명 처리
		if(empty($mdata_insert) && !empty($file_descript)) @zb_query("insert into dq_revolution (zb_id,zb_no,file_descript,vote_users) values ('$id','$no','$file_descript','')") or error(zb_error());

		// 현재글의 조회수를 올릴수 없게 세션 등록
		if(empty($_SESSION['zb_hit'])) $_SESSION['zb_hit']='';
		$_SESSION['zb_hit'] .= $hitStr=','.$setup['no'].'_'.$no;

		// 현재글의 추천을 할수 없게 세션 등록
		if(empty($_SESSION['zb_vote'])) $_SESSION['zb_vote']='';
		$_SESSION['zb_vote'] .= ','.$setup['no'].'_'.$no;

		if($prev_no) zb_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");
		if($next_no) zb_query("update $t_board"."_$id set prev_no='$no' where headnum='$next_data[headnum]' and division='$next_data[division]'");
		zb_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}

// 최근 업데이트 시간 기록
	zb_query("update $t_board"."_$id set modify_date=".time()." where no='$no'") or die(zb_error());

// 사진크기 검사
	function chk_PixelLimit($file, $filename) {
		global $_SS;
		if($_SS['ImgUpLimit']) {
			$size=GetImageSize($file);
			$imagesize = ceil(($size[0]*$size[1])/10000);
			if(($imagesize*10000)> ($_SS['ImgUpLimit2']*10000)) delete_uploadTmpFiles($moving_file_list,'<b>업로드 하는 이미지의 크기를 '.$_SS['ImgUpLimit2'].'만 화소 이하로 줄여주세요.</b><br />*화소수는 이미지의 가로폭과 세로폭의 픽셀수를 곱한 값입니다.<br /><br />업로드 하려는 <b>'.$filename.'</b>는(은) '.$imagesize.'만 화소 입니다.');
		}
	}

    function delete_uploadTmpFiles($files, $msg) 
    {
      if(count($files)) {
        $count = 0;
        $files = array_reverse($files);
        foreach($files as $k=>$v) {
            $count++;
            if(file_exists($v) && !file_exists($k) && !is_dir($v) && !is_dir($k)) {
              @rename($v,$k);
            };
        }
      }
      error($msg);
    }

    function delete_oldSession($path,$hour)
    {
      if(!is_dir($path)) return false;
      
      $ExpireTime  = time() - ($hour*3600);

      $directory = dir($path);

      while($entry = $directory->read()) :
        if ($entry != "." && $entry != "..") {
          if (is_dir($path.$entry)) delete_oldSession($path.$entry);
          elseif (fileatime($path.$entry) < $ExpireTime){
            z_unlink($path.'/'.$entry);
          }
        }
      endwhile;
    }
?>
