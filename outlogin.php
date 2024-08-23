<?php
/*******************************************************************************
 * Zeroboard 4.1 pl2 외부 로그인 파일
 *
 * 이 파일은 외부로그인으로 사용할시에 사용하시면 됩니다.
 *
 * 사용방법은 다음과 같습니다.
 *
 * 외부로그인을 원하시는 문서의 제일 상단에 다음과 같이 입력하세요
 *
 * <?php 
 *   $_zb_url = "http://도메인/제로보드경로/";                 // 끝에 꼭 / 를 써주세요
 *   $_zb_path = "/home/계정아이디/public_html/제로보드경로/"; // 끝에 꼭 / 를 써주세요
 *   include $_zb_path."outlogin.php"; 
 * ?>
 * 
 *
 * 그런후 외부로그인 폼이나 로그인 상태를 표시하고 싶은곳에 다음과 같이 입력하세요
 *
 * <?print_outlogin("스킨이름","그룹번호","허용레벨");?>
 *
 *
 * 위에서 "/home/계정 아이디/public_html/제로보드 경로/" 라는 것은 제로보드의 절대 경로를 나타냅니다.
 * 
 * 위에서 $_zb_url 과 $_zb_path 는 꼭 적어 주셔야 합니다.
 *
 * 절대경로는 관리자 페이지 메인 제일 아래에 있습니다
 *
 * 위와 같이 하면 로그인이 되었을때는 로그인 정보가, 그렇지 않은 경우에는 로그인 폼이 나타납니다.
 *
 * 로그인 정보와 로그인 폼을 수정하실때에는 제로보드경로/outlogin_skin/ 에 있는 파일을 수정하시면 됩니다.
 *
 * 로그인 되어 있는 상태 : logged.html
 * 로그인 폼 : login.html
 *
 * 위의 두 파일을 수정 하시면 됩니다.
 *
 * 그리고 만약 원하는 html 파일에서 레벨에 따른 권한을 제한 하고 싶을때에는 $level 변수를 수정하시면 됩니다.
 *
 * 라고 하시면 9이하의 레벨만 해당 페이지에 접속이 가능합니다.
 *
 * 실제 적용 파일을 보시려면 outlogin_skin 디렉토리내의 index.html 파일을 열어보세요.
 *
 * 외부로그인 모양을 바꾸시려면 outloing_skin 디렉토리 내의 README.TXT 파일을 꼭 읽어 주시기 바랍니다.
 *
 *******************************************************************************/
 if(realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) exit;
	global $member, $_head_php_excuted, $REQUEST_URI, $_zb_lib_included, $total_member_connect, $total_guest_connect;
	global $a_member_join, $a_member_modify, $a_member_memo, $member_memo_icon, $memo_on_sound, $a_logout, $a_login, $id, $PHP_SELF, $_outlogin_include;

	if (preg_match("/:\/\//i", $_zb_path) || preg_match("/\.\./i", $_zb_path)) $_zb_path = "./";


	// outlogin.php 파일이 include 되었는지를 체크
	if(!$_outlogin_include) {
		$_outlogin_include = TRUE;
	} else {
		return FALSE;
	}

	// 처음에 include 되었을때 필요한 파일을 include 하는 부분
	if(!$_head_php_excuted&&!$_zb_lib_included) {

		// 제로보드 디렉토리 인지 체크
		if(!file_exists($_zb_path."lib.php")) {
 			echo "제로보드 디렉토리가 아닙니다";
			return;
		}

		// _head.php 읽음
		@include_once $_zb_path."_head.php";

	}

	// 외부로그인 출력 함수
	function print_outlogin($skinname = "default", $group_no = 1, $level = "10") {
		global $member, $_head_php_excuted, $REQUEST_URI, $total_member_connect, $total_guest_connect, $_zb_path, $_zb_url;
		global $a_member_join, $a_member_modify, $a_member_memo, $member_memo_icon, $memo_on_sound, $a_logout, $a_login, $id, $PHP_SELF;

		if($level < $member['level']) {
?>
			<script>
				alert("인증된 회원만 접근 가능합니다");
				history.back();
			</script>
<?php
			exit;
		}

		// 회원 정보가 있는지 없는지를 체크해서 해당 스킨 파일을 읽음
		if(!$member['no']) {

			$f = fopen($_zb_path."script/outlogin_script.php","r");
			$_outlogin_script = fread($f, filesize($_zb_path."script/outlogin_script.php"));
			fclose($f);
	
			$f = fopen($_zb_path."outlogin_skin/$skinname/login.html","r");
			$_outlogin_data = fread($f, filesize($_zb_path."outlogin_skin/$skinname/login.html"));
			fclose($f);

			$login_img = $_zb_url."outlogin_skin/$skinname/images/i_login.gif";
			$join_img = $_zb_url."outlogin_skin/$skinname/images/i_join.gif";
			$help_img = $_zb_url."outlogin_skin/$skinname/images/i_help.gif";

			$_outlogin_data = str_replace("[action]", $_zb_url."login_check.php",$_outlogin_data);
			$s_url = $REQUEST_URI;
			if($id&&!eregi($id, $s_url)) {
				if(eregi("\?",$s_url)) $s_url = $s_url . "&id=$id";
				else $s_url = $s_url . "?id=$id";
			}
			$_outlogin_data = str_replace("[s_url]", urlencode($s_url),$_outlogin_data);
	
			$aUrl = "?group_no=".$group_no;

			$_outlogin_data = str_replace("[member_join]", "<a href=# onclick=\"window.open('".$_zb_url."member_join.php".$aUrl."','zbMemberJoin','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\"><img src=$join_img border=0></a>",$_outlogin_data);
			$_outlogin_data = str_replace("[login]", "<input type=image src=$login_img border=0>",$_outlogin_data);
			$_outlogin_data = str_replace("[lost_id]", "<a href=# onclick='window.open(\"".$_zb_url."lostid.php\",\"lost_id\",\"width=400,height=200,toolbars=no,autoscrollbars=no\")'><img src=$help_img border=0></a>",$_outlogin_data);

			$_outlogin_data = str_replace("[total_member_connect]",number_format($total_member_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[total_guest_connect]",number_format($total_guest_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[total_connect]",number_format($total_member_connect+$total_guest_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[dir]",$_zb_url."outlogin_skin/$skinname/images/",$_outlogin_data);

			if($group_no) {
				$_outlogin_data = str_replace("</form>","<input type=hidden name=group_no value='$group_no'></form>",$_outlogin_data);
			}

			print $_outlogin_script."\n";
			print $_outlogin_data."\n";

		} else {

			$f = fopen($_zb_path."outlogin_skin/$skinname/logged.html","r");
			$_outlogin_data = fread($f, filesize($_zb_path."outlogin_skin/$skinname/logged.html"));
			fclose($f);

			$memo_on_img = $_zb_url."outlogin_skin/$skinname/images/i_memo_on.gif";
			$memo_off_img = $_zb_url."outlogin_skin/$skinname/images/i_memo_off.gif";
			$logout_img = $_zb_url."outlogin_skin/$skinname/images/i_logout.gif";
			$info_img = $_zb_url."outlogin_skin/$skinname/images/i_info.gif";
			$admin_img = $_zb_url."outlogin_skin/$skinname/images/i_admin.gif";
			$memo_swf = $_zb_url."outlogin_skin/$skinname/images/i_memo.swf";
			$memo_mp3 = $_zb_url."outlogin_skin/$skinname/images/i_memo.mp3";

			if($member['new_memo']) {
				$memo_on_image = "<img src=$memo_on_img border=0 align=absmiddle> ";
				$memo_on_sound_out ="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0' width='0' height='0'><param name=menu value=false><param name=wmode value=transparent><param name=movie value='$memo_swf'><param name=quality value=low><param name='LOOP' value='false'><embed src='$memo_swf' quality=low pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='0' height='0' loop='false' wmode=transparent menu='false'></embed></object>"; 
				$memo_on_sound_out .="<audio src=\"$memo_mp3\" controls autoplay hidden style=\"display:none;\"><embed src=\"$memo_mp3\" width=\"0\" height=\"0\" loop=\"false\" hidden=\"false\"></audio>";
			} else {
				$memo_on_image = "<img src=$memo_off_img border=0 align=absmiddle> ";
			}

			$_outlogin_data = str_replace("[memo]",$memo_on_image,$_outlogin_data);
			$_outlogin_data = str_replace("[name]",$a_member_memo."<b>".del_html($member['name'])."</b></a>",$_outlogin_data);
			$_outlogin_data = str_replace("[logout]",$a_logout."<img src=$logout_img border=0></a>",$_outlogin_data);

			$_outlogin_data = str_replace("[info]",$a_member_modify."<img src=$info_img border=0></a>",$_outlogin_data);
			if($member['is_admin']==1||$member['is_admin']==2) $_outlogin_data = str_replace("[admin]","<a href=".$_zb_url."admin.php target=blank><img src=$admin_img border=0></a>",$_outlogin_data);
			else $_outlogin_data = str_replace("[admin]","",$_outlogin_data);
			$_outlogin_data = str_replace("[join_date]",date("Y/m/d",$member['reg_date']),$_outlogin_data);
			$_outlogin_data = str_replace("[level]",$member['level'],$_outlogin_data);
			$_outlogin_data = str_replace("[point]",number_format($member["point1"]*10+$member["point2"]),$_outlogin_data);
			$_outlogin_data = str_replace("[write_num]",number_format($member["point1"]),$_outlogin_data);
			$_outlogin_data = str_replace("[write_comment]",number_format($member["point2"]),$_outlogin_data);
			$_outlogin_data = str_replace("[total_member_connect]",number_format($total_member_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[total_guest_connect]",number_format($total_guest_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[total_connect]",number_format($total_member_connect+$total_guest_connect),$_outlogin_data);
			$_outlogin_data = str_replace("[dir]",$_zb_url."outlogin_skin/$skinname/images/",$_outlogin_data);
			
			print $_outlogin_data.$memo_on_sound_out ."\n";

		}

		$a_member_join = "<Zeroboard";
		$a_member_modify = "<Zeroboard";
		$a_member_memo = "<Zeroboard";
		$member_memo_icon = "<Zeroboard";
		$memo_on_sound = "";
		$a_logout = "<Zeroboard";
		$a_login = "<Zeroboard";

	}
	
	/*******************************************************
	 * 최근목록 보여주기를 위한 함수 지정
	 ******************************************************/

	 // 최근 글 목록 (일반 게시판 형)
	 function print_bbs($skinname, $title, $id, $num=5, $textlen=30, $datetype="Y/m/d") {
		global $_zb_path, $_zb_url, $connect, $t_board, $admin_table;

		if(!$skinname||!$id||!$title) return;

		$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
		if(!$str) { 
			echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
			return;
		}

		$setup = mysql_fetch_array(zb_query("select use_alllist from $admin_table where name='$id'"));
		if($setup['use_alllist']) $target = "zboard.php?id=".$id;
		else $target = "view.php?id=".$id;

		$result = zb_query("select * from $t_board"."_$id where is_secret=0 order by no desc limit $num", $connect) or die(zb_error());


		$tmpStr = explode("[loop]",$str);
		$header = $tmpStr[0];
		$tmpStr2 = explode("[/loop]",$tmpStr[1]);
		$loop = $tmpStr2[0];
		$footer = $tmpStr2[1];

		// 공지사항 형식을 만들때 사용
		if(eregi("\[notice\_",$header)) {
			$data=mysql_fetch_array($result);
			$memo = stripslashes($data['memo']);
			if($data['use_html']<2) $memo = nl2br($memo);
			else $memo = strip_tags($memo);
			$filename1 = $data["file_name1"];
			$filename2 = $data["file_name2"];
			if(eregi("\.gif|\.jpg",$filename1))$uploadimage1 = "<img src=".$_zb_url.$filename1." border=0><br>"; else $uploadimage1="";
			if(eregi("\.gif|\.jpg",$filename2))$uploadimage2 = "<img src=".$_zb_url.$filename1." border=0><br>"; else $uploadimage2="";
			$memo = autolink($uploadimage1.$uploadimage2.$memo);
			if($data['ismember']) {
				$imageBoxPattern = "/\[img\:(.+?)\.(jpg|gif)\,align\=([a-z]){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
				$memo=preg_replace($imageBoxPattern,"<img src='".$_zb_url."icon/member_image_box/$data[ismember]/\\1.\\2' align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>", stripslashes($memo));
			}
			$subject = cut_str(stripslashes($data['subject']),$textlen)."</font></b>";
			$date = date($datetype, $data['reg_date']);
			$header = str_replace("[notice_memo]",$memo,$header);
			$header = str_replace("[notice_subject]",$subject,$header);
			$header = str_replace("[notice_date]",$date,$header);
		}

		$main_data = "";
		while($data=mysql_fetch_array($result)) {
			$name = stripslashes($data['name']);
			$subject = cut_str(stripslashes($data['subject']),$textlen)."</font></b>";
			$date = date($datetype, $data['reg_date']);
			if($data['total_comment']) $comment = "[".$data['total_comment']."]"; else $comment="";

			$main = $loop;
			$main = str_replace("[name]",$name,$main);
			$main = str_replace("[date]",$date,$main);
			$main = str_replace("[subject]","<a href='".$_zb_url.$target."&no=$data[no]'>".$subject."</a>",$main);
			$main = str_replace("[comment]",$comment,$main);
			$main_data .= "\n".$main;
		}
		$list = $header.$main_data.$footer;
		$list = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$list);
		$list = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);

		echo $list;
	 }

	 // 최근 설문조사 (일반 게시판 형)
	 function print_survey($skinname, $title, $id, $textlen=30) {
		global $_zb_path, $_zb_url, $connect, $t_board, $admin_table;

		if(!$skinname||!$id) return;

		$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
		if(!$str) { 
			echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
			return;
		}

		$tmpResult = zb_query("select use_alllist from $admin_table where name='$id'") or die(zb_error());
		$setup = mysql_fetch_array($tmpResult);
		if($setup['use_alllist']) $target = "zboard.php?id=".$id;
		else $target = "view.php?id=".$id;

		$result = zb_query("select * from $t_board"."_$id order by headnum limit 1", $connect) or die(zb_error());
		$tmpData = mysql_fetch_array($result);
		$no = $tmpData['no'];
		$headnum = $tmpData['headnum'];
		$main_subject="<a href='".$_zb_url.$target."&no=$no'>".stripslashes($tmpData['subject'])."</a>";
		if($tmpData['vote']) $main_vote = "[".$tmpData['vote']."]"; else $main_vote="";

		$result = zb_query("select * from $t_board"."_$id where headnum='$headnum' and arrangenum > 0 order by arrangenum", $connect) or die(zb_error());

		$tmpStr = explode("[loop]",$str);
		$header = $tmpStr[0];
		$tmpStr2 = explode("[/loop]",$tmpStr[1]);
		$loop = $tmpStr2[0];
		$footer = $tmpStr2[1];

		$main_data = "";
		while($data=mysql_fetch_array($result)) {
			$subject = cut_str(stripslashes($data['subject']),$textlen)."</font></b>";
			if($data['vote']) $vote = "[".$data['vote']."]"; else $vote="";
			$main = $loop;
			$main = str_replace("[subject]","<a href='".$_zb_url."apply_vote.php?id=$id&no=$no&sub_no=$data[no]'>".$subject."</a>",$main);
			$main = str_replace("[vote]",$vote,$main);
			$main_data .= "\n".$main;
		}
		$list = $header.$main_data.$footer;
		$list = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$list);
		$list = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);
		$list = str_replace("[main_subject]",$main_subject,$list);
		$list = str_replace("[main_vote]",$main_vote,$list);

		echo $list;
	 }

	 // 갤러리 이미지 뽑아오는 스킨
	 function print_gallery($skinname, $title, $id, $num=10, $xsize=80, $ysize=80, $xnum=10) {
		global $_zb_path, $_zb_url, $connect, $t_board, $admin_table;

		if(!$skinname||!$id) return;

		$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
		if(!$str) { 
			echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
			return;
		}

		$tmpResult = zb_query("select use_alllist from $admin_table where name='$id'") or die(zb_error());
		$setup = mysql_fetch_array($tmpResult);
		if($setup['use_alllist']) $target = "zboard.php?id=".$id;
		else $target = "view.php?id=".$id;

		$result = zb_query("select * from $t_board"."_$id order by no desc limit $num", $connect) or die(zb_error());

		$i = 0;
		while($data=mysql_fetch_array($result)) {
			
			if(eregi("\.gif|\.jpg",$data["file_name1"])) $filename = $_zb_url.$data["file_name1"];
			elseif(eregi("\.gif|\.jpg",$data["file_name2"])) $filename = $_zb_url.$data["file_name2"];
			else $filename="";

			if($filename) $imgList.="<a href='".$_zb_url.$target."&no=$data[no]'><img src='$filename' border=1 style=border-color:black width=$xsize height=$ysize vspacing=10 hspacing=10></a>";
			else $imgList.="<a href='".$_zb_url.$target."&no=$data[no]'><img src='[dir]t.gif' border=1 style=border-color:black width=$xsize height=$ysize vspacing=10 hspacing=10></a>";
			$i++;
			if($i>=$xnum) {
				$imgList.="<br>";
				$i=0;
			} else {
				$imgList.="&nbsp;";
			}
		}
		$str = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$str);
		$str = str_replace("[img]",$imgList,$str);
		$str = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$str);
		echo $str;
	 }
?>
