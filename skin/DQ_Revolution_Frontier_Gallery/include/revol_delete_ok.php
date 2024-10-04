<?php 
  // 라이브러리 함수 파일 인크루드
	if(preg_match('/revol_delete_ok.php/',$_SERVER['PHP_SELF'])) chdir("../../../");
	require_once "lib.php";

	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");
	if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 삭제하시기 바랍니다","");

  // 게시판 이름 지정이 안되어 있으면 경고;;;
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $no = isset($_POST['no']) && is_numeric($_POST['no']) ? $_POST['no'] : null;
  $page = isset($_REQUEST['page']) && is_numeric($_REQUEST['page']) ? $_REQUEST['page'] : null;
  $page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : null;
  $select_arrange = isset($_REQUEST['select_arrange'])
			&& in_array($_REQUEST['select_arrange'], array('headnum','subject','name','hit','vote','reg_date','download1','download2')) ? $_REQUEST['select_arrange'] : null;
  $des = isset($_REQUEST['des']) && in_array($_REQUEST['des'], array('desc','asc')) ? $_REQUEST['des'] : null;
  $sn = isset($_REQUEST['sn']) && in_array($_REQUEST['sn'], array('on','off')) ? $_REQUEST['sn'] : null;
  $sn1 = isset($_REQUEST['sn1']) && in_array($_REQUEST['sn1'], array('on','off')) ? $_REQUEST['sn1'] : null;
  $ss = isset($_REQUEST['ss']) && in_array($_REQUEST['ss'], array('on','off')) ? $_REQUEST['ss'] : null;
  $sc = isset($_REQUEST['sc']) && in_array($_REQUEST['sc'], array('on','off')) ? $_REQUEST['sc'] : null;
  $su = isset($_REQUEST['su']) && in_array($_REQUEST['su'], array('on','off')) ? $_REQUEST['su'] : null;
  $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : null;
  $divpage = isset($_REQUEST['divpage']) && is_numeric($_REQUEST['divpage']) ? $_REQUEST['divpage'] : null;
  if(!$id) Error("게시판 이름을 지정해 주셔야 합니다.<br><br>예) zboard.php?id=이름","");

  // DB 연결
  if(empty($connect)) $connect=dbConn();

  // 현재 게시판 설정 읽어 오기
  $setup=get_table_attrib($id);

  // 스킨 환경설정 읽어오기
	include "skin/".$setup['skinname']."/get_config.php";
//	$dir = "skin/$setup['skinname']";
	$_inclib_01 = "skin/".$setup['skinname']."/include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
	else include_once $_inclib_01.'zend';

  // 설정되지 않은 게시판일때 에러 표시
  if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","");

  // 현재 게시판의 그룹의 설정 읽어 오기
  $group=group_info($setup['group_no']);

  // 멤버 정보 구해오기;;; 멤버가 있을때
  $member=member_info();

  // 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
  if($member['is_admin']==1||$member['is_admin']==2&&$member['group_no']==$setup['group_no']||check_board_master($member, $setup['no'])) $is_admin=1; else $is_admin="";

  // 접근 금지 아이피인 경우 금지하기;;;
  $avoid_ip=explode(",",$setup['avoid_ip']);
  for($i=0;$i<count($avoid_ip);$i++)
  {
   if(!isblank($avoid_ip[$i])&&eregi($avoid_ip[$i],$REMOTE_ADDR)&&!$is_admin)
    Error(" Access Denied ");
  }

  // 현재 그룹이 폐쇄그룹이고 로그인한 멤버가 비멤버일때 에러표시
  if($group['is_open']==0&&!$is_admin&&$member['group_no']!=$setup['group_no']) Error("공개 되어 있지 않습니다");

  //패스워드를 암호화
  if(!empty($_POST['password']))
  {
    $password=get_password($_POST['password']);  
  }

  // 원본글을 가져옴
  $s_data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));
  if(empty($s_data['no'])) Error("선택하신 게시물이 존재하지 않습니다");
  if(strlen($s_data['password'])<=16&&strlen(get_password("a"))>=41&&isset($_POST['password'])) $password=get_password($_POST['password'], true);

  // 회원일때를 확인;;
  if(!$is_admin&&$member['level']>$setup['grant_delete'])
  {
     if(!$s_data['ismember'])
     {
      if($s_data['password']!=$password) Error("비밀번호가 올바르지 않습니다");
     }
     else
     {
      if($s_data['ismember']!=$member['no']) Error("비밀번호를 입력하여 주십시요");
     }
  }

  if(!empty($skin_setup['using_moveTrash'])) 
  { //삭제하지 않고 휴지통에 보관
     $tmp_no   = move_zbArticle($id,$no,$skin_setup['using_moveTrashValue'],'move_all');
     //die($tmp_no);
     $add_memo = addslashes($s_data['memo'])."\n".$member['name'].'님에 의해서 삭제되었습니다.('.date("Y-m-d H:i").')';
     if($tmp_no) zb_query('update '.$t_board.'_'.$skin_setup['using_moveTrashValue'].' set memo=\''.$add_memo.'\',is_secret=\'1\' where no='.$tmp_no) or die(zb_error());
  }
  elseif(!$s_data['child']) // 답글이 없을때;;
  {
     zb_query("delete from $t_board"."_$id where no='$no'") or Error(zb_error()); // 글삭제

     // 파일삭제
      $_gd_support = get_support_GD_type();
      if(eregi("\.jpg",$_gd_support)) $ext = '.jpg';
      elseif(eregi("\.png",$_gd_support)) $ext = '.png';
      elseif(eregi("\.gif",$_gd_support)) $ext = '.gif';

      $old_thumb_file = 'data/'.$id.'/small_'.$no.'.thumb';
      $_dq_tempFile = 'data/_RV_Thumbnail_Files_/'.$id.'/'.date('Y',$s_data['reg_date']).'/'.date('m',$s_data['reg_date']).'/small_'.$s_data['no'].$ext;
      $_dq_workFile = $_dq_tempFile.'.work';

      if(file_exists($old_thumb_file)) @unlink ($old_thumb_file);
      if(file_exists($_dq_tempFile)) @unlink ($_dq_tempFile);
      if(file_exists($_dq_workFile)) @unlink ($_dq_workFile);

      if($s_data['file_name1']) {
        $fnum = 0;
        $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$s_data['reg_date']).'_sThumb_'.$no.'_'.$fnum.$ext;
        @z_unlink('./'.$s_data['file_name1']);
        @z_unlink($t);
      }
      if($s_data['file_name2']) {
        $fnum++;
        $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$s_data['reg_date']).'_sThumb_'.$no.'_'.$fnum.$ext;
        @z_unlink('./'.$s_data['file_name2']);
        @z_unlink($t);
      }

     // 레볼루션 데이터를 가져옴
     $m_data=mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$no'"));

     if($m_data) {
         $tmp_files  = explode(",",$m_data['file_names']);
         $tmp_sfiles = explode(",",$m_data['s_file_names']);

         // 레볼루션 파일삭제
         if($tmp_files) {
             for($i=0; $i<99; $i++) {
                if($tmp_files[$i]) @z_unlink("./".$tmp_files[$i]);
                $fnum++;
                $t = './data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$s_data['reg_date']).'_sThumb_'.$no.'_'.$fnum.$ext;
                @z_unlink($t);
             }
         }

         //레볼루션 게시물 데이터 삭제
         zb_query("delete from dq_revolution where zb_id='$id' and zb_no='$no'") or Error(zb_error()); 
     }

     minus_division($s_data['division']);

     if($s_data['depth']==0)
     {
      if($s_data['prev_no']) zb_query("update $t_board"."_$id set next_no='{$s_data['next_no']}' where next_no='{$s_data['no']}'"); // 이전글이 있으면 빈자리 메꿈;;;
      if($s_data['next_no']) zb_query("update $t_board"."_$id set prev_no='{$s_data['prev_no']}' where prev_no='{$s_data['no']}'"); // 다음글이 있으면 빈자리 메꿈;;;
     }
     else
     { 
      $temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id where father='{$s_data['father']}'"));
      if(!$temp[0]) zb_query("update $t_board"."_$id set child='0' where no='{$s_data['father']}'"); // 원본글이 있으면 원본글의 자식글을 없앰
     }

     // 간단한 답글 삭제
      zb_query("delete from $t_comment"."_$id where parent='{$s_data['no']}'");

     $total=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$id "));
      zb_query("update $admin_table set total_article='$total[0]' where name='$id'");

     // 카테고리 필드 조절
      zb_query("update $t_category"."_$id set num=num-1 where no='{$s_data['category']}'",$connect);

     // 회원일 경우 해당 해원의 점수 주기
      $addPoint = $_SS['writePointValue'];
      if(empty($skin_setup['write_nopoint']) && $member['no']==$s_data['ismember']) {
         @zb_query("update $member_table set point1=point1-$addPoint where no='{$member['no']}'",$connect) or error(zb_error());
      }
  }

  //if($connect) mysql_close($connect);
  //$query_time=getmicrotime();

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
	$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
    if($mode == 'modify') {
        $path = './data/_DQThumb_Latest_Temp';
        clearLatestThumbnail($path);
    }

// 캐쉬처리
    revolution_cache_clear();

	if(eregi('revol_delete_ok.php',$_SERVER['PHP_SELF'])) $add_urlString = "../../../";
    movepage($add_urlString."zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&su=$su&keyword=$keyword&sn1=$sn1&divpage=$divpage");
?>
