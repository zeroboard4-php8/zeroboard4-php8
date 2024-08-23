<!-- 간단한 답글을 위해서 제로보드 소스에서 따온 부분 by miracle(삭제하지마세요)-->
<?php
// 간단한 답글의 데이타를 가지고옴;;
	$no = $data['no'];
	$_dbTimeStart = getmicrotime();
	$view_comment_result=zb_query("select * from $t_comment"."_$id where parent='$no' order by no asc");
	$_dbTime += getmicrotime()-$_dbTimeStart;
?>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
  <td width=85% align=left class=list-foot-h>
    <?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?>
    <b>Read</b> : <?=$hit?>
  </td>
  <td width=25% align=right class=list-foot-h><?=$a_modify?>modify</a> <?=$a_delete?>delete</a></td>
  </td>
  </tr>
  <tr>
    <td colspan=2 height=1  border=0 width=1 height=1 class=line></td>
  </tr>
    <tr>
    <td  height="17" valign=center>&nbsp;<?=$insert?><?=$icon?><b><?=$subject?></b>     </td>
    <td width=20% align=right nowrap class=reg-date valign=center>
      <b><?=$reg_date?></b>
    </td>
  </tr>
  <tr>
     <td colspan=2 height=1 border=0 width=1 height=1 class=line></td>
  </tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
  <td>
    <table width=100% cellpadding=0 cellspacing=0 border=0>
     <tr>
     <td colspan=2 border=0 width=1 height=15></td>
  </tr>
	 <tr>
       <td colspan=2 valign=top align=center width=100% ><p align=center><?=$upload_image1?></a></p></td>
     </tr>
     <tr>
       <td width=25></td>      	
	<td valign=top style='word-break:break-all; padding-top:5; padding-right:10'><p  align=center><?=$memo?></p></td>
     </tr>
	 <tr>
	
		<td colspan=2 height=25></td>
	 </tr>
	 </table>
  </td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0 >
<?php
 // 회원로그인이 되어 있으면 코멘트 비밀번호를 안 나타나게;;
  if($member['no']) {$c_name=$member['name']; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; }
  else $c_name="<input type=text name=name size=8 maxlength=10 class=input value=\"$zetyx[name]\">";
?>

<!-- list_head.php에서 시작되는 form테크 마침 (코멘트에도 from테그가 들어가므로 겹치지않게함) -->
</form> 
<table border="0" cellpadding="0" cellspacing="0" align="center" width=95% >
<?php
// 코멘트 출력;;
	if($setup['use_comment']) {
		while($c_data=mysql_fetch_array($view_comment_result)) {
			$comment_name=stripslashes($c_data['name']);
			$temp_name = get_private_icon($c_data['ismember'], "2");
			if($temp_name) $comment_name="<img src='$temp_name' border=0 align=absmiddle>";
			$c_memo=trim(stripslashes($c_data['memo']));
			//$c_memo=trim($c_data['memo']);
			$c_reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초",$c_data['reg_date'])."'>".date("Y/m/d",$c_data['reg_date'])."</span>";
			if($c_data['ismember']) {
				if($c_data['ismember']==$member['no']||$is_admin||$member['level']<=$setup['grant_delete']) $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";
				else $a_del="&nbsp;<Zeroboard ";
			} else $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";

			// 이름앞에 붙는 아이콘 정의;;
			$c_face_image=get_face($c_data);

			if($is_admin) $show_ip=" title='$c_data[ip]' "; else $show_ip="";    

			if($setup['use_formmail']&&check_zbLayer($c_data)) {
				$comment_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible')\" style=cursor:hand>$comment_name</span>";
			} else {
				if($c_data['ismember']) $comment_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$c_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$comment_name</a>";
				else $comment_name="<div $show_ip>$comment_name</div>";
			}

			$_skinTimeStart = getmicrotime();
			include $dir."/list_comment.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;
		}
		if($member['level']<=$setup['grant_comment']) {
			$_skinTimeStart = getmicrotime();
			include "$dir/list_write_comment.php";
			$_skinTime += getmicrotime()-$_skinTimeStart;
		}
	}
?>

<!-- list_head.php의 form테크 다시 시작함 -->
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">