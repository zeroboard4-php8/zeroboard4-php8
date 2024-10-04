<?php 
	set_time_limit(0);

	echo "
	<br><font size=3><b>&nbsp;게시물 총 개수:</b> $board_setup['total_article']개</font>
	<br><font size=3><b>&nbsp;게시판 ID:</b> $id</font><br><br>
	<font size=2><b>&nbsp;추천 데이터 변환시작</b></font><br><br>\n";

	$result = zb_query("SELECT * FROM $t_board_$id ORDER BY no ASC");
	$del_comment = 0;
	while($dbData[$i]=@mysql_fetch_array($result)){

		$s_data=$dbData[$i];

		//간단한 답글의 데이타를 가지고옴;;
		$view_comment_result=zb_query("select * from $t_board_comment"."_$id where parent='$s_data['no']' order by no asc");
		
		$vote_users = "";
		while($c_data=mysql_fetch_array($view_comment_result)) {
			if($c_data['vote']) $vote_users .= "<".$c_data['ismember'].">".stripslashes($c_data['name']);
			if(trim($c_data['memo'])=="") {
				//코멘트 삭제
				zb_query("delete from $t_board_comment"."_$id where no='$c_data['no']'") or error(zb_error());
				//코멘트 갯수 정리
				$total=mysql_fetch_array(zb_query("select count(*) from $t_board_comment"."_$id where parent='$s_data['no']'"));
				zb_query("update $t_board"."_$id set total_comment='$total[0]' where no='$s_data['no']'")  or error(zb_error()); 

				$del_comment++;
			}
		}

		echo "&nbsp;<b>$s_data['no']</b>";

		$m_data=mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$s_data['no']'"));

		if($vote_users) {			
			if($m_data['no'])	{
				if(strlen($vote_users) >= strlen($m_data['vote_users'])) {
					@zb_query("update dq_revolution set vote_users='$vote_users' where zb_id='$id' and zb_no='$s_data['no']'") or error(zb_error());
					echo "(수정)";
				} else echo "(패스)";
			} else {
				@zb_query("insert into dq_revolution (zb_id,zb_no,vote_users) values ('$id','$s_data['no']','$vote_users')") or error(zb_error());
				echo "(입력)";
			}
		} else echo "(패스)";

		echo ".";
		$count++; 
		if($count>=10) {echo "<br>"; $count=0;}
		flush();
	}

?>
<br><br>
<font size=2><b>&nbsp;추천 데이터 변환완료</b> / 삭제된 코멘트 갯수: <?=$del_comment?>개</font><br><br>

<?php 
	if(@mysql_field_name(zb_query("SELECT file_names3 from $t_board"."_$id"),0)) {
		$more_upload = '1';
		$more_limit = 20;
	}
	
	echo "<br><br><br><font size=2><b>&nbsp;업로드 데이터 변환시작</b></font><br><br>";

	$result = zb_query("SELECT * FROM $t_board_$id ORDER BY no ASC");

	while($dbData[$i]=@mysql_fetch_array($result)){
		$que="";		
		$s_data=$dbData[$i];
		if(eregi("data",$s_data['file_names'])) $que="file_names='$s_data['file_names']',s_file_names='$s_data['s_file_names']'";
		
		echo "&nbsp;<b>$s_data['no']</b>";

		$m_data=mysql_fetch_array(zb_query("select * from dq_revolution where zb_id='$id' and zb_no='$s_data['no']'"));

		if($que) {			
			if($m_data['no'])	{
				if(strlen($s_data['s_file_names']) >= strlen($m_data['s_file_names'])) {
					@zb_query("update dq_revolution set $que where zb_id='$id' and zb_no='$s_data['no']'") or error(zb_error());
					echo "(수정)";
				} else echo "(패스)";
			} else {
				@zb_query("insert into dq_revolution (zb_id,zb_no,file_names,s_file_names) values ('$id','$s_data['no']','$s_data['file_names']','$s_data['s_file_names']')") or error(zb_error());
				echo "(입력)";
			}
		} else echo "(패스)";

		echo ".";
		$count++; 
		if($count>=10) {echo "<br>"; $count=0;}
		flush();
	}
?>

<br><br>
<font size=2><b>&nbsp;게시물 변환완료</b></font><br><br>

<div align=center><font size=2><b>&nbsp;<a href=<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&mode=modify>[환경설정으로 돌아가기]</a></b></font></center><br>
