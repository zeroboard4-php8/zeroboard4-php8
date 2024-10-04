<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');

dq_mkdir($_LIBS_dir);
dq_mkdir("data/$id");

// 다중업로드를 위한 DB필드 생성
	$dq_revolution_table_schema ="
		CREATE TABLE dq_revolution (
		no INT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		zb_id VARCHAR(40) NOT NULL ,
		zb_no INT(20) NOT NULL ,
		file_names TEXT NULL ,
		s_file_names TEXT NULL ,
		file_descript TEXT NULL ,
		vote_users TEXT NULL ,
		is_slide INT(1) NOT NULL DEFAULT '0',
		is_hidden INT(1) NOT NULL DEFAULT '0',
		is_vdel INT(1) NOT NULL DEFAULT '0',

	    KEY zb_id (zb_id),
		KEY zb_no (zb_no)
		)
	";

	if(!@mysql_field_name(zb_query("SELECT no from dq_revolution"),0)) {
		zb_query($dq_revolution_table_schema) or error(zb_error(),"");
	}
	@mysql_field_name(zb_query("SELECT is_vdel from dq_revolution"),0) or zb_query("ALTER TABLE `dq_revolution` ADD `is_vdel` INT(1) NOT NULL DEFAULT '0'");
    $_chk = @mysql_field_name(zb_query("SELECT modify_date from $t_board"."_$id"),0);
    if(!$_chk) {
        zb_query("ALTER TABLE `$t_board"."_$id` ADD `modify_date` INT(1)") or error(zb_error());
        zb_query("update $t_board"."_$id set modify_date=reg_date where modify_date < 1") or error(zb_error());
    }

// 계층형 코멘트를 위한 DB필드 생성
    $_chk2 = @mysql_field_name(zb_query("SELECT mother from $t_comment"."_".$id),0);
    if(!$_chk2) {
        zb_query("ALTER TABLE `$t_board"."_comment"."_".$id."` ADD `mother` INT(1) NOT NULL DEFAULT 0, ADD `depth` INT(1) NOT NULL DEFAULT 0") or error(zb_error());
    }

//환경설정 파일이 위치할 디렉토리 생성
	dq_mkdir($_LIBS_dir."icon");
	dq_mkdir($_LIBS_include_dir);
	dq_mkdir($_SKIN_config_dir);

	if(!is_writable($_SKIN_config_dir)) ;

//기본 환경설정파일 복사
	dq_copy("$dir/include/copyonly/skinconfig_default_".$dqrevolutionType.".php",$_SKIN_config_dir."cfg_default.php");
	if(!file_exists($_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php"))
		dq_copy("$dir/include/copyonly/skinconfig_mbpic_default.php",$_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php");
	@chmod($_SKIN_config_dir."cfg_default.php",0707);
	@chmod($_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php",0707);

    if(!is_file($_SKIN_config_file))
		dq_copy($_SKIN_config_dir."cfg_default.php",$_SKIN_config_file);

//스킨설정 읽어오기
	include $_SKIN_config_file;
	include $_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php";
	$_css_dir = $dir."/".$skin_setup['css_dir'];

//스타일시트 출력
	echo "<link rel=\"StyleSheet\" HREF=\"".$_css_dir."style.css\" type=\"text/css\" title=\"style\">\n";
	$_put_css = 1;

//라이브러리가 존제하는지 검사 & 복사
	dq_copy($dir."/include/copyonly/revol_delete.php",$_zb_path);
	dq_copy($dir."/include/copyonly/revol_write_ok.php",$_zb_path);
	dq_copy($dir."/include/copyonly/revol_comment.php",$_zb_path);
	dq_copy($dir."/include/copyonly/revol_getimg.php",$_zb_path);
	dq_copy($dir."/include/copyonly/revol_download.php",$_zb_path);
	dq_copy($dir."/include/copyonly/revol_del_comment.php",$_zb_path);
	dq_copy($dir."/include/copyonly/list_all_01.php",$_LIBS_include_dir);
	dq_copy($dir."/include/copyonly/list_all_03.php",$_LIBS_include_dir);
	dq_copy($dir."/include/copyonly/is_revolution.php",$_LIBS_include_dir);

//제로보드 소스 수정
    $m   = '// 레볼루션을 사용중인 게시판인지 검사';
    $s   = '// write.php가 아닐때 검색갯수 및 query 정리';
    $mix = "        // 레볼루션을 사용중인 게시판인지 검사\n        \$include_isRevolution = './DQ_LIBS/include/is_revolution.php';\n        if(file_exists(\$include_isRevolution)) require(\$include_isRevolution);\n";
    //modify_zbSource('_head.php', $s, $m, $mix);

    $m   = 'include "./DQ_LIBS/include/list_all_01.php"; //레볼루션';
    $s   = '// Divison 정리';
    $mix = "\n                ".$m;

    //if(modify_zbSource('list_all.php', $s, $m, $mix)) 
    //{
        $m   = '$m_data = @mysql_fetch_array(zb_query("select * from dq_revolution where zb_id=\'$id\' and zb_no=\'$selected[$i]\'"));';
        $s   = '// 답글이 없을때;;';
        $mix = '            '.$m;
    //    modify_zbSource('list_all.php', $s, $m, $mix);

        $m   = 'include "./DQ_LIBS/include/list_all_03.php"; //레볼루션';
        $s   = '// Comment 정리';
        $mix = "\n                    ".$m;
    //    modify_zbSource('list_all.php', $s, $m, $mix);

        $m   = '/* --- 레볼루션01';
        $s   = '\$comment_result=zb_query';
        $mix = '                    '.$m;
    //    modify_zbSource('list_all.php', $s, $m, $mix);

        $m   = '--- 레볼루션01 */';
        $s   = 'update \$t_category"."_\$board_name set num=num\+1 where no=\'\$category\'",\$connect';
        $mix = '                    '.$m;
    //    modify_zbSource('list_all.php', $s, $m, $mix);
    //}
	
//  파일복사를 위한 함수
	function dq_mkdir($dir) {
		if(is_dir($dir)) return;

		@mkdir($dir, 0777);
		@chmod($dir, 0707);
	}

	function dq_copy($s,$t) 
	{
		setlocale(LC_CTYPE, 'ko_KR.eucKR');
		if(!is_file($s)) return;
		if(is_dir($t) && !eregi("/$",$t)) $t .= '/';
		if(is_dir($t)) $t .= basename($s);

		$s = str_replace("\\","/",$s);
		$t = str_replace("\\","/",$t);

		if(!is_writable(dirname($t))) 
			dqerr("파일복사 실패",dirname($t)." 디렉토리에 쓰기 권한이 없습니다.<br />퍼미션 변경후 재시도 하세요.");
		if(file_exists($t)) {
			@chmod ($t,0777);
			@unlink($t);
		}			

		if(!copy($s, $t)) dqerr("파일복사 실패","'$t'로 복사 또는 생성할 권한이 없습니다.<br /> '$t' 파일을 삭제 하거나 퍼미션 변경후 재시도 하세요.");
		else @chmod($t, 0707);
	}

    function modify_zbSource($target, $s, $m, $mix) 
    {
        static $old_files;
        static $put_msg;

        if(!file_exists($target)) return false;

        $_zbHeadFile = file($target);
        foreach ($_zbHeadFile as $key => $value) {
          if(eregi($m,$value)) {$flag2 = true; break;}
          if(!$flag && eregi($s,$value)) {$flag = $key;}
          if(!$flag && eregi($s,$value)) {echo "....";}
        }

        if($flag && !$flag2) {
          if(!$put_msg) echo '<div class="view_title">제로보드 소스코드<span style="font-size:7pt;font-family:verdana;font-weight:normal">(_head.php, list_all.php)</span>를 수정합니다.</div>';
          $put_msg = true;

          if(!is_writeable($target)) error('<div align="left">\'제로보드/'.$target.'\' 파일이 수정되지 않았습니다.<br /><a href="http://dqstyle.com" target="_blank"><b>스킨 제작자 홈페이지의 FAQ 게시판</b></a>을 참고하여 해당 파일을 수정 하세요.<br>자동으로 수정하길 원한다면 해당 파일의 퍼미션을 707로 바꾸고 F5 키를 눌러 새로고침 해주세요.<br /><br >이미 수정 했음에도 이 메세지가 나타났다면 해당 파일의 수정 위치에 <b>\''.$m.'\'</b> 라는 주석을 추가하지 않았기 때문에 이 프로그램이 인식하지 못하는 것입니다.<br />자동인식을 회피하기 위해서는 주석을 꼭 추가 하셔야 합니다.<br />만일 이 사이트가 UTF-8 캐릭터셋으로 제작된 사이트라면 수동으로 수정 하실 것을 권합니다.</div>');

          $_zbHeadFileText1 = array_slice($_zbHeadFile,0,$flag-1);
          $_zbHeadFileText2 = array_slice($_zbHeadFile,$flag-1,count($_zbHeadFile)-1);
          $_zbHeadFileText3 = $mix."\n";
          $_zbHeadFileText = implode($_zbHeadFileText1).$_zbHeadFileText3.implode($_zbHeadFileText2);

          if(!file_exists($target.'.revolution.backup')) {
            dq_copy($target,$target.'.revolution.backup');
            echo '<br /><div class="han2"><b>제로보드/'.$target.'</b> 파일을 <b>'.$target.'.revolution.backup</b> 파일로 백업 하였습니다.</div></dr />';
          }
          zWriteFile($target,$_zbHeadFileText);
          echo '<br /><div class="han2"><b>제로보드/'.$target.'</b> 파일의 <b>'.($flag).'</b> 번째 줄에 아래 내용을 삽입 하였습니다.</div><blockquote>'.str_replace("\n",'<br />',$mix).'</blockquote>';
          if($old_files != $target && is_writeable($target)) echo '<div class="code">안전을 위해 <b>제로보드/'.$target.'</b> 파일의 퍼미션을 <b>644</b>로 바꾸십시오.<br />현재는 웹 스크립트에 의해 변조될 수 있는 위험이 있습니다.</div>';

          $old_files = $target;
          return true;
        }
    }
 
// 환경설정 파일 저장
    $_POST = $_SS;
    include $dir.'/include/write_config.php';

    $fp = fopen($_SKIN_config_file, "w");
	fwrite($fp, $_CONFIG_STR);
	fclose($fp);
?>
