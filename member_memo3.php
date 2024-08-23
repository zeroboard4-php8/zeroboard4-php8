<?php
// 라이브러리 함수 파일 인크루드
	require "lib.php";
	
// DB 연결
	$connect=dbConn();

// 멤버정보 구하기
	$member=member_info();

	if(!isset($member['no'])) Error("로그인된 회원만이 사용할수 있습니다","window.close");

	if(!isset($page)&&!isset($status)) $status=1;
	if(empty($status)) $status='';
	if(empty($keyword)) $keyword='';

// 그룹데이타 읽어오기;;
	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$member[group_no]'"));

// 검색어 처리;;
	if(!empty($keyword)) {
		if(!$status) $s_que=" where user_id like '%$keyword%' or name like '%$keyword%' ";
	}

// 전체 회원의 수
	if(!isset($s_que)) $s_que = '';
	$temp2=mysql_fetch_array(zb_query("select count(*) from $member_table  $s_que"));
	$total_member=$temp2[0];

	if(!empty($status)) {
		$_str = trim(zReadFile("data/now_member_connect.php"));
		if($_str) {
			$_str = str_replace("<?php die('Access Denied');/*","",$_str);
			$_str = str_replace("*/?>","",$_str);
			$_connector = explode(":",$_str);
			
			$total = count($_connector);
		}
	} else $total=$total_member;

// 페이지 계산
	$page_num=10;
	$total_page=(int)(($total-1)/$page_num)+1; // 전체 페이지 구함

	if(!isset($page)) $page=1;
	if($page>$total_page) $page=1; // 페이지가 전체 페이지보다 크면 페이지 번호 바꿈
 
	$start_num=($page-1)*$page_num; // 페이지 수에 따른 출력시 첫번째가 될 글의 번호 구함



// 데이타 뽑아오는 부분

// 오프라인 멤버
	if(empty($status)) {
		$que="select * from $member_table $s_que order by no desc limit $start_num,$page_num";
		$result=zb_query($que) or Error(zb_error());
// 온라인 멤버
	} else {
		$endnum = $start_num + $page_num;
		if($endnum>$total) $endnum=$total;
		unset($s_que);
		for($i=$start_num;$i<$endnum;$i++) {
			$member_no = substr($_connector[$i],12);
			if(isset($s_que)) $s_que .= " or no = '$member_no' "; else $s_que = " where no = '$member_no' ";
		}
		$que = "select * from $member_table $s_que";
		$result=zb_query($que) or Error(zb_error());

	}

// 페이지 계산  $print_page 라는 변수에 저장 
	$print_page="";
	$show_page_num=10;
	$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
	$i=1;

	if($page>$show_page_num) {
		$prev_page=$start_page;
		$print_page="<a href=$PHP_SELF?page=$prev_page&status=$status&keyword=$keyword>[Prev]</a> ";
		$print_page.="<a href=$PHP_SELF?page=1&status=$status&keyword=$keyword>[1]</a>..";
	}
	
	while($i+$start_page<=$total_page&&$i<=$show_page_num) {
		$move_page=$i+$start_page;
		if($page==$move_page) $print_page.=" <b>$move_page</b> ";
		else $print_page.="<a href=$PHP_SELF?page=$move_page&status=$status&keyword=$keyword>[$move_page]</a>";
		$i++;
	}

	if($total_page>$move_page) {
		$next_page=$move_page+1;
		$print_page.="..<a href=$PHP_SELF?page=$total_page&status=$status&keyword=$keyword>[$total_page]</a>";
		$print_page.=" <a href=$PHP_SELF?page=$next_page&status=$status&keyword=$keyword>[Next]</a>";
	}
   
	head("bgcolor=white");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_topleft.gif" width="15" height="50"></td>
    <td background="images/memo_topbg.gif">
      <img src="images/t.gif" width="10" height="2"><br>
      <font style=font-size:11pt;font-weight:bold>&nbsp;쪽지보내기</font></td>
    <td width="15"><img src="images/memo_topright.gif" width="156" height="50"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
 <td>&nbsp;&nbsp;&nbsp;<a href=member_memo.php><img src=images/vi_B_inbox.gif border=0></a> <a href=member_memo2.php><img src=images/vi_B_sent.gif border=0></a> <a href=member_memo3.php><img src=images/vi_B_write.gif border=0></a></td>
    <td align=right><font color="#666666">전체회원수 : <?=$total?></font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_listtopleft.gif" width="17" height="17"></td>
    <td background="images/memo_listtop.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listtopright.gif" width="17" height="17"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17" background="images/memo_listleftbg.gif"><img src="images/t.gif" width="17" height="10"></td>
    <td>

<script>
 function check_status()
 {
 	if(document.list.status.checked) {
		if(document.list.keyword.value) {
			alert("온라인 상태에서는 검색할수가 없습니다");
			return false;
		}
	}
	return true;
 }
</script>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<form method=post action=<?=$PHP_SELF?> name=list onsubmit="return check_status()">
<input type=hidden name=page value=<?=$page?>>
<tr align=center height=15>
  <td width=35%><img src=images/memo_level.gif></td>
  <td width=25%><img src=images/memo_id.gif></td>
  <td width=25%><img src=images/memo_name.gif></td>
  <?php if($status){?><td width=15%><img src=images/memo_status.gif></td><?php }?>
</tr>

<?php
// 출력
	$loop_number=$total-($page-1)*$page_num;
	while($data=mysql_fetch_array($result)) {
		$name=stripslashes($data['name']);
		
		$temp_name = get_private_icon($data['no'], "2");
		if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>";
		$temp_name = get_private_icon($data['no'], "1");
		if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>&nbsp;".$name;

		
		$user_id=stripslashes($data['user_id']);
		//$check=mysql_fetch_array(zb_query("select count(*) from $now_table where user_id='$data['user_id']'"));
		if(isset($check[0])) $stat="<img src=images/memo_online.gif>";
		else $stat="<img src=images/memo_offline.gif>";
		if($data['is_admin']==1) $kind="<font color=#aa0000 style=font-family:Tahoma;font-size:8pt;><b>Super Administrator</b>($data[level])</font>";
		elseif($data['is_admin']==2) $kind="<font color=#0000aa style=font-family:Tahoma;font-size:8pt;><b>Group Administrator</b>($data[level])</font>";
		else $kind="<font style=font-family:Tahoma;font-size:8pt;><b>Member</b>($data[level])</font>";

		echo"
        <tr>
          <td colspan=5 bgcolor=#EBD9D9 align=center><img src=images/t.gif width=10 height=1></td>
        </tr>
   <tr align=center height=23 onMouseOver=this.style.backgroundColor=\"#FFF5F5\" onMouseOut=this.style.backgroundColor=\"\" style=cursor:hand; onclick=location.href=\"javascript:void(window.open('view_info.php?member_no=$data[no]','view_info','width=400,height=510,toolbar=no,scrollbars=yes'))\">
      <td style='word-break:break-all;'>$kind</td>
      <td style='word-break:break-all;'><img src=images/t.gif width=10 height=3><br><a href=javascript:void(window.open('view_info.php?member_no=$data[no]','view_info','width=400,height=510,toolbar=no,scrollbars=yes'))>$user_id</a></td>
      <td style='word-break:break-all;'><img src=images/t.gif width=10 height=3><br>$name</td>";
      if($status) echo"<td style='word-break:break-all;'><img src=images/memo_online.gif></td>";
	  echo"
   </tr>
     ";
 		$loop_number--;
	}
?>
        <tr>
          <td colspan=5 bgcolor=#EBD9D9 align=center><img src=images/t.gif width=10 height=1></td>
        </tr>

<tr align=center>
<?php $checked[$status]="checked"; ?>
  <td colspan=5 height=30>
     <table border=0 align=center cellpadding=0 cellspacing=0>
     <tr>
     <td><input type=text name=keyword value="<?=isset($keyword)?$keyword:''?>" size=20 style=font-size:9pt;width:100px;height:20px;></td>
     <td><input type=checkbox value=1 name=status <?=isset($checked[1])?$checked[1]:''?>></td>
     <td><img src=images/memo_online.gif align=absmiddle style=cursor:hand >&nbsp;&nbsp;&nbsp;</td>
     <td><input type=image border=0 src=images/memo_search.gif align=absmiddle>&nbsp;</td>
     <td><a href=<?=$PHP_SELF?>?page=<?=$page?>><img src=images/memo_cancel.gif border=0></a></td>
     </tr>
     </table>
  
  </td>
</tr>
</form>
</table>
    </td>
    <td width="17" background="images/memo_listrightbg.gif"><img src="images/t.gif" width="17" height="10"></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15"><img src="images/memo_listbottomleft.gif" width="17" height="17"></td>
    <td background="images/memo_listbottom.gif"><img src="images/t.gif" width="10" height="5"></td>
    <td width="15"><img src="images/memo_listbottomright.gif" width="17" height="17"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<font style=font-family:Tahoma;font-size:7pt;color:#cc0000><?=$print_page?></font></td>
    <td align="right">
      <a href=JavaScript:window.close()><img src="images/memo_close.gif" width="69" height="25" border="0"></a> </td>
  </tr>
</table>

<?php
// MySQL 닫기 
	if($connect) mysql_close($connect);

	foot();
?>
