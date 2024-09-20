<?php
/***************************************************************************
 * 게시판 기본 기능 수정 페이지
 **************************************************************************/

	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));

	if($exec2=="add") $data=mysql_fetch_array(zb_query("select * from $admin_table where no='$no'"));
	if($member['is_admin']>=3 && !eregi($no.",",$member['board_name'])) error("게시판 설정을 변경할 권한이 없습니다");
	
	$no = isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) ? $_REQUEST['no'] : '';
	$page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 10;
	$data = mysql_fetch_array(zb_query("select * from $admin_table where no='$no'"));

	if(empty($data['bg_color'])) $data['bg_color']="white";
	if(empty($data['table_width'])) $data['table_width']="95";
	if(empty($data['cut_length'])) $data['cut_length']="0";
	if(empty($data['page_num'])) $data['page_num']="10";
	if(empty($data['header'])) $data['header']="<div align=center>";
	if(empty($data['footer'])) $data['footer']="</div>";
	if(empty($data['memo_num'])) $data['memo_num']=20;
	if(empty($no)) $no='';
	if(empty($page)) $page='';
	if(empty($page_num)) $page_num='';
?>

<script>
 function check_submit()
 {
  if(!write.table_width.value) {alert("게시판 가로크기을 입력하여 주십시오");write.table_width.focus();return false;}
  if(!write.memo_num.value) {alert("목록수를 입력하여 주십시오");write.memo_num.focus();return false;}
  if(!write.page_num.value) {alert("페이지수를 입력하여 주십시오");write.page_num.focus();return false;}
  return true;
 }
</script>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
<col width=150></col><col width=></col>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_webboard.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>
<tr height=30 bgcolor=white>
   <td align=right colspan=8 style=font-family:Tahoma;font-size:8pt;>
    그룹이름 : <b><?=$group_data['name']?></b> , 게시판 이름 : <b><a href=zboard.php?id=<?=$data['name']?> target=_blank><?=$data['name']?></a></b> &nbsp;&nbsp;&nbsp;
    <input type=button value='카테고리관리' class=input style=width=100px onclick=location.href="<?=$_SERVER['PHP_SELF']?>?exec=view_board&group_no=<?=$group_no?>&exec2=category&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">
    <input type=button value='권한설정' class=input style=width=100px onclick=location.href="<?=$_SERVER['PHP_SELF']?>?exec=view_board&group_no=<?=$group_no?>&exec2=grant&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">

    &nbsp;&nbsp;&nbsp;</td></tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=10><img src=images/t.gif height=1></td></tr>
<form method=post action=<?=$_SERVER['PHP_SELF']?> name=write onsubmit="return check_submit();">
<input type=hidden name=no value=<?php echo $data['no'];?>>
<input type=hidden name=exec value=view_board>
<input type=hidden name=exec2 value=<?php if($no) echo"modify_ok"; else echo"add_ok";?>>
<input type=hidden name=page value=<?=isset($page)?$page:''?>>
<input type=hidden name=s_page_num value=<?=isset($page_num)?$page_num:''?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=name value=<?=$data['name']?>>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
</tr>
<!-- 기본설정 -->
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 이름 &nbsp;</td>
  <td style=font-family:Tahoma;font-size:8pt;>&nbsp;&nbsp;&nbsp; <b><a href=zboard.php?id=<?php echo $data['name'];?> target=_blank><?php echo $data['name'];?></a></b></td>
</tr>
<!-- 스킨 설정 -->
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>스킨 &nbsp;</td>
  <td >&nbsp;&nbsp; <select name=skinname>
<?php
 // /skin 디렉토리에서 디렉토리를 구함
 $skin_dir="skin";
 $handle=opendir($skin_dir);
 while ($skin_info = readdir($handle))
 {
  if(!eregi("\.",$skin_info))
  {
   if($skin_info==$data['skinname']) $select="selected"; else $select="";
   echo"<option value=$skin_info $select>$skin_info</option>";
  }
 }
 closedir($handle);
?>
     </select>
  </td>
</tr>

<script>
function check1()
{
 write.use_showreply.checked=true;
 write.only_board.checked=true;
 write.use_alllist.checked=false;
}


function check2()
{
 write.use_alllist.checked=true;
 write.use_showreply.checked=false;
 write.use_secret.checked=false;
 write.only_board.checked=false;
}
</script>

<tr height=70 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>스킨 형식 설정 &nbsp;</td>
  <td>&nbsp;&nbsp; 
<?php unset($check);$check[$data['only_board']]="checked";?>
       <input type=checkbox name=only_board value=1 <?php echo isset($check[1]) ? $check[1] : '' ?>> 게시판으로만 사용시 선택하여 주십시오. (스킨처리 속도가 줄어듭니다)<br>
       &nbsp;&nbsp; <input type=button class=input onclick=check1() style=border-color:#b0b0b0;height=18px value="게시판 형태"> 내용이 목록에 나오지 않는 게시판 형태의 스킨
       <br>
       <img src=images/t.gif border=0 height=4><br>&nbsp;&nbsp;
       <input type=button class=input onclick=check2() style=border-color:#b0b0b0;height=18px value="방명록 형태"> 내용이 목록에 나오는 방명록 형태의 스킨
  </td>
</tr>

<!-- 게시판 속성 설정  -->
<tr height=25 bgcolor=bbbbbb><td  colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>기본 설정</b></td></tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>배경 그림 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=bg_image value='<?php echo $data['bg_image'];?>' size=50 maxlength=255 class=input style=width:95%;border-color:#b0b0b0>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>배경 색상 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=bg_color value='<?php echo $data['bg_color'];?>' size=20 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 가로 크기 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=table_width value='<?php echo $data['table_width'];?>' size=4 maxlength=4 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
     게시판 가로크기 (100이하이면 %로 설정)
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>목록에서 제목 글자 제한&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=cut_length value='<?php echo $data['cut_length'];?>' size=11 maxlength=11 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
     지정된 길이 이상의 제목글은 ... 로 나머지 표시 (0:사용안함)
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>페이지당 목록 수&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=memo_num value='<?php echo $data['memo_num'];?>' size=3 maxlength=3 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
     한페이지당 출력될 목록의 수 (1~999)
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>페이지 표시 수&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text name=page_num value='<?php echo $data['page_num'];?>' size=3 maxlength=3 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
     목록의 아래부분에 표시될 페이지의 갯수 (1~999)
  </td>
</tr>


<!-- 헤더, 푸터  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>게시판 상, 하단에 표시될 내용 설정</td></tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>타이틀 지정&nbsp;</td>
  <td height=40>&nbsp;&nbsp;
     <input type=text  name=title value='<?php echo stripslashes($data['title']);?>' size=20 maxlength=250 class=input style=width:95%;border-color:#b0b0b0><br>
	 &nbsp;&nbsp; 브라우저 상단의 타이틀을 지정
  </td>
</tr>


<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에&nbsp;<br>불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp; <input type=text  name=header_url value='<?php echo $data['header_url'];?>' size=40 maxlength=255 class=input style=width:95%;border-color:#b0b0b0>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>게시판 상단에&nbsp;<br>출력할 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=header cols=70 rows=10 class=textarea style=width:95%;border-color:b0b0b0><?php echo stripslashes($data['header']);?></textarea>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에&nbsp;<br>불러올 파일&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=footer_url value='<?php echo stripslashes($data['footer_url']);?>' size=40 maxlength=255 class=input style=width:95%;border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>게시판 하단에&nbsp;<br>출력할 내용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=footer cols=70 rows=10 class=textarea style=width:95%;border-color:#b0b0b0><?php echo stripslashes($data['footer']);?></textarea>
  </td>
</tr>

<!-- 기능 선택  -->

<tr height=25 bgcolor=#bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>추가 기능 설정</b></td></tr>

<?php unset($check);$check[0]='';$check[1]='';$check[$data['use_alllist']]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>전체 목록 출력&nbsp;<br>(글내용 보기)&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox name=use_alllist value='1' <?php echo $check[1];?>> 글내용볼때 아래에 전체 리스트 기능&nbsp;
  </td>
</tr>

<?php unset($check);$check[0]='';$check[1]='';$check[$data['use_category']]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>카테고리 사용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox name=use_category value='1' <?php echo $check[1];?>> 카테고리 기능사용 &nbsp;
  </td>
</tr>

<?php unset($check);$check[0]='';$check[1]='';$check[2]='';$check[$data['use_html']]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>HTML 사용여부&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=radio name=use_html value='0' <?php echo $check[0];?>> 모두막기 &nbsp;
     <input type=radio name=use_html value='1' <?php echo $check[1];?>> 부분허용 &nbsp;
     <input type=radio name=use_html value='2' <?php echo $check[2];?>> 모두허용 &nbsp;
  </td>
</tr>

<?php unset($check);if($data['use_showreply']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>답변글을 목록에 출력&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_showreply value='1' <?php echo $check;?>> 답글보여주기
  </td>
</tr>

<?php if($data['use_filter']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>불량단어 필터링 사용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_filter value='1' <?php echo $check;?>>
     욕/비방글등에 대한 필터기능 사용
  </td>
</tr>

<?php if($data['use_status']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>미리보기 기능&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_status value='1' <?php echo $check;?>>
	 미리보기 기능 사용 (제목에 간단하게 내용 요약 나오는 기능)
  </td>
</tr>

<?php if($data['use_homelink']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>관련 사이트 링크 #1&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_homelink value='1' <?php echo $check;?>>
    링크 기능 사용
  </td>
</tr>

<?php if($data['use_filelink']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>관련 사이트 링크 #2&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_filelink value='1' <?php echo $check;?>>
     링크 기능 사용
  </td>
</tr>


<?php if($data['use_pds']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>자료실 기능&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_pds value='1' <?php echo $check;?>>
     자료실 기능 사용
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>첨부파일 #1의&nbsp;<Br>허용 확장자&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=pds_ext1 value='<?php echo stripslashes($data["pds_ext1"]);?>' size=50 maxlength=250 class=input style=width:95%;border-color:#b0b0b0><br>&nbsp;&nbsp; 1번 업로드 가능 확장자 지정 (공백시 검사하지않음. 쉼표(,)로 구분)
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>첨부파일 #2의&nbsp;<br>허용 확장자&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text  name=pds_ext2 value='<?php echo stripslashes($data["pds_ext2"]);?>' size=50 maxlength=250 class=input style=width:95%;border-color:#b0b0b0><br>&nbsp;&nbsp; 2번 업로드 가능 확장자 지정 (공백시 검사하지않음. 쉼표(,)로 구분)
  </td>
</tr>


<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>최고 업로드 가능 용량&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=text name=max_upload_size value="<?=$data['max_upload_size']?>" size=10  class=input style=border-color:#b0b0b0> byte &nbsp;&nbsp; (최고한도 : <?php echo get_cfg_var("upload_max_filesize"); ?> byte)
  </td>
</tr>


<?php if($data['use_cart']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>바구니 기능&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_cart value='1' <?php echo $check;?>>
     바구니 기능 사용
  </td>
</tr>

<?php if($data['use_autolink']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>자동링크 기능&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_autolink value='1' <?php echo $check;?>>
     자동링크 기능 사용
  </td>
</tr>

<?php if($data['use_showip']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>Image Box 기능 사용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_showip value='1' <?php echo $check;?>>
	 Image Box 기능의 사용 유무를 선택
  </td>
</tr>

<?php if($data['use_comment']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>간단한 답글 기능&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_comment value='1' <?php echo $check;?>>
     간단한 답글 기능 사용
  </td>
</tr>

<?php if($data['use_formmail']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>글쓴이 서브메뉴 사용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_formmail value='1' <?php echo $check;?>>
	 허용시 글쓴이의 이름 클릭시 서브 레이어 메뉴 표시
  </td>
</tr>

<?php if($data['use_secret']) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>비밀글 사용&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=checkbox  name=use_secret value='1' <?php echo $check;?>>
     비밀글 기능사용. 관리자와 비번 아는 사람만 볼수 있음
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>불량단어 등록 &nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=filter cols=70 rows=6 class=textarea style=width:95%;border-color:#b0b0b0><?=$data['filter']?></textarea><br> &nbsp;&nbsp;
     불량단어 필터링 목록입니다. <b>, (콤마)</b> 로 연결하세요
<?php if($member['is_admin']==1||$member['is_admin']==2){?>
	 <br> &nbsp;&nbsp;<input type=checkbox name=applyall_filter value=1 onclick="alert('모든 게시판의 불량단어 내용이 위의 내용으로 변경됩니다')"> 모든 게시판에 적용하기
<?php }?>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>허용할 HTML태그&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=avoid_tag cols=70 rows=6 class=textarea style=width:95%;border-color:#b0b0b0><?=$data['avoid_tag']?></textarea><br> &nbsp;&nbsp; HTML을 부분허용했을때 허용하여 주는 태그입니다.<br>
       &nbsp;&nbsp; &lt;,&gt;를 뺀 태그 이름만을 입력하세요.<br>
       &nbsp;&nbsp; <b>, (콤마)</b> 로 연결하세요
<?php if($member['is_admin']==1||$member['is_admin']==2){?>
	 <br> &nbsp;&nbsp;<input type=checkbox name=applyall_tag value=1 onclick="alert('모든 게시판의 허용 HTML 태그 내용이 위의 내용으로 변경됩니다')"> 모든 게시판에 적용하기
<?php }?>
  </td>
</tr>

<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>IP 차단&nbsp;</td>
  <td >&nbsp;&nbsp;
     <textarea name=avoid_ip cols=70 rows=4 class=textarea style=width:95%;border-color:#b0b0b0><?=$data['avoid_ip']?></textarea>
	 <br> &nbsp;&nbsp; 차단을 원하는 특정 아이피가 있을때 등록하세요.&nbsp;&nbsp; <b>, (콤마)</b> 로 연결하세요
	 <br> &nbsp;&nbsp; 만약 123.456.789.* 등 123.456.789로 시작하는 IP 차단을 원하시면 123.456.789 만 적어주시면 됩니다
<?php if($member['is_admin']==1||$member['is_admin']==2){?>
	 <br> &nbsp;&nbsp;<input type=checkbox name=applyall_ip value=1 onclick="alert('모든 게시판의 IP차단 내용이 위의 내용으로 변경됩니다')"> 모든 게시판에 적용하기
<?php }?>
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>관리자 비밀번호 입력&nbsp;</td>
  <td >&nbsp;&nbsp;
     <input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;">
  </td>
</tr>


<!-- Submit  -->

<tr height=30 bgcolor=#ffffff>
   <td colspan=2 align=right ><img src=images/t.gif height=5><br>
   <input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;
   <img src=images/button_cancel.gif border=0 onClick=reset() style=cursor:hand>&nbsp;&nbsp;&nbsp;
   </td>
</form>
</tr>
</table>
</div>

