<?php
// 간단한 답글의 데이타를 가지고옴
        $no = $data['no'];
        $_dbTimeStart = getmicrotime();
        $view_comment_result=zb_query("select * from $t_comment"."_$id where parent='$no' order by no asc");
        $_dbTime += getmicrotime()-$_dbTimeStart;
?>

<tr>
<td colspan=2 height=1 bgcolor=#F5F5F5></td>
</tr>
<tr>
<td colspan=2 height=15></td>
</tr>
<tr>
 <td align=center width=100% style='word-break:break-all;'>&nbsp;&nbsp;<b><?=$subject?></b></td>
 <td align=right><?=$a_modify?><img src=<?=$dir?>/images/modify.gif align=middle border=0></a>&nbsp;&nbsp;<?=$a_delete?><img src=<?=$dir?>/images/delete.gif align=middle border=0></a></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td style='word-break:break-all;padding:10' valign=top align="center">
 <center>
 <?=$upload_image1?></center>
 <table border=0 cellspacing=0 cellpadding=0>
 <tr><td height=5></td></tr></table>
 <center>
 <?=$upload_image2?></center>
 <table border=0 cellspacing=0 cellpadding=0 align="center">
 <tr><td height=4></td></tr></table>
 <center><?=$memo?></center>
</td>
</tr>
<tr>
 <td height=1 bgcolor=#F5F5F5></td>
</tr>
</form>
</table>
<?php
 // 로그인이 되어 있으면 코멘트 비밀번호를 안 나타나게..
  if($member['no']) {$c_name=$member['name']; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; }
  else $c_name="<input type=text name=name size=8 maxlength=10 class=input value=\"$zetyx[name]\">";

// 코멘트 출력부분
        if($setup['use_comment']) {
                while($c_data=mysql_fetch_array($view_comment_result)) {
                        $comment_name=stripslashes($c_data['name']);
                        $temp_name = get_private_icon($c_data['ismember'], "2");
                        if($temp_name) $comment_name="<img src='$temp_name' border=0 align=absmiddle>";
                        $c_memo=trim(stripslashes($c_data['memo']));
                        //$c_memo=trim($c_data['memo'])
                        $c_reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초",$c_data['reg_date'])."'>".date("Y/m/d",$c_data['reg_date'])."</span>";
                        if($c_data['ismember']) {
                                if($c_data['ismember']==$member['no']||$is_admin||$member['level']<=$setup['grant_delete']) $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";
                                else $a_del="&nbsp;<Zeroboard ";
                        } else $a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]'>";

                        // 이름앞에 붙는 아이콘 정의
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
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td height=1>
<!-- list_head.php의 form테크 다시 시작 -->
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
</td></tr>