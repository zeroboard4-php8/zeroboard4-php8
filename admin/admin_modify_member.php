<?php
  $group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));

  $member_data=mysql_fetch_array(zb_query("select * from $member_table where no='$no'"));

  if($member['is_admin']>1&&$member['no']!=$member_data['no']&&$member_data['level']<=$member['level']&&$member_data['is_admin']<=$member['is_admin']) error("선택하신 회원의 정보를 변경할 권한이 없습니다");

  $check['']='';
  $check[0]='';
  $check[1]="checked";
  $get_string='';
  $__manager_board_name='';
	if(!isset($page)) $page = '';
	if(!isset($keykind)) $keykind = '';
	if(!isset($keyword)) $keyword = '';
	if(!isset($like)) $like = '';
	if(!isset($group_no)) $group_no = '';
	if(!isset($exec)) $exec = '';
	if(!isset($page_num)) $page_num = '';
	if(!isset($exec2)) $exec2 = '';
?>

<script>
 function check_submit()
 {
  if(write.password.value!=write.password1.value) {alert("패스워드가 일치하지 않습니다.");write.password.value="";write.password1.value=""; write.password.focus(); return false;}
  if(!write.name.value) { alert("이름을 입력하세요"); write.name.focus(); return false; }

<?php if(!empty($group_data['use_birth']))
   { ?>

    if ( write.birth_1.value < 1000 || write.birth_1.value <= 0 )  {
         alert('생년이 잘못입력되었습니다.');
         write.birth_1.value='';
         write.birth_1.focus();
        return false;
    }
    if ( write.birth_2.value > 12 || write.birth_2.value <= 0 ) {
         alert('생월이 잘못입력되었습니다.');
         write.birth_2.value='';
         write.birth_2.focus();
        return false;
    }
    if ( write.birth_3.value > 31 || write.birth_3.value <= 0 )  {
         alert('생일이 잘못입력되었습니다.');
         write.birth_3.value='';
         write.birth_3.focus();
        return false;
    }
<?php } ?>

  return true;
  }


  function add_board_manager() {

	var myindex=document.write.board_name.selectedIndex;
	var no=document.write.board_name.options[myindex].value;

	if(no) {
		location.href="<?=$PHP_SELF?>?exec=view_member&exec2=add_member_board_manager&group_no=<?=$group_no?>&member_no=<?=$no?>&page=<?=$page?>&keyword=<?=$keyword?>&keykind=<?=$keykind?>&like=<?=$like?>&board_num="+ no;
	}
  }

</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_webboard.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>
<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=view_member>
<input type=hidden name=exec2 value=modify_member_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=member_no value=<?=$no?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keykind value=<?=$keykind?>>
<input type=hidden name=keyword value=<?=$keyword?>>
<input type=hidden name=like value=<?=$like?>>
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>

  <tr height=22 align=center><td height=30 colspan=2><b><?=$member_data['name']?></b> 회원 설정 변경</td></tr>

  <tr height=22 align=center bgcolor=#e0e0e0>
     <td width=25% align=right bgcolor=#a0a0a0 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>아이디&nbsp;&nbsp;</td>
     <td align=left>&nbsp;<?=$member_data['user_id']?> &nbsp;(<?=date("Y년 m월 d일 H시 i분",$member_data['reg_date'])?>에 가입)</td>
  </tr>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>비밀번호&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=password name=password size=20 maxlength=20 class=input style=border-color:#b0b0b0> 확인 : <input type=password name=password1 size=20 maxlength=20 class=input style=border-color:#b0b0b0></td>
  </tr>

<?php
  $locking = "";
  if($member['no']==$no) $locking = "disabled";
  $select[1]='';
  $select[2]='';
  $select[3]='';

  if($member['is_admin']==1)
  {
   $select[$member_data['is_admin']]="selected";
?>
  <tr height=22 align=center>  
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>관리자 레벨&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<select name=is_admin <?=$locking?>>
                          <option value=3 <?=$select[3]?>>일반사용자</option>
                          <option value=2 <?=$select[2]?>>그룹관리자</option>
                          <option value=1 <?=$select[1]?>>최고관리자</option>
                          </select> (관리자 레벨은 일반 레벨에 우선합니다)</td>
  </tr>
<?php
  }
?>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>레벨&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<select name=level <?=$locking?>>
<?php
  for($i=$member['level'];$i<=10;$i++) if($i==$member_data['level']) echo"<option value=$i selected>$i</option>"; else echo "<option value=$i>$i</option>";
?>
                    </select></td>
  </tr>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>이름&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=name size=20 maxlength=20 value="<?=$member_data['name']?>" class=input style=border-color:#b0b0b0></td>
  </tr>

<?php                                                                                                  
  if($member_data['is_admin']>2)                                                                          
  {                                                                                                 

   if(trim($member_data['board_name'])) {
	   $manager_board_temp = split(",",$member_data['board_name']);
	   $get_string .= " (no = '$manager_board_temp[0]') ";
	   for($__k=1;$__k<count($manager_board_temp);$__k++){
	   	if(trim($manager_board_temp[$__k])) $get_string .= " or (no = '$manager_board_temp[$__k]') ";
	   }
	   $manager_board_list = zb_query("select * from $admin_table where $get_string",$connect) or die(zb_error());
	   while($__manager_data = mysql_fetch_array($manager_board_list)) {
	   $__manager_board_name .= "&nbsp;".stripslashes($__manager_data['name'])." &nbsp; <a href='$PHP_SELF?exec=view_member&exec2=modify_member_board_manager&group_no=$group_no&member_no=$no&page=$page&keyword=$keyword&board_num=$__manager_data[no]' onclick=\"return confirm('권한을 취소시키시겠습니까?')\">[권한취소]</a><br><img src=images/t.gif border=0 height=4><br>";

	   }
   }

   $select[$member_data['board_name']]="selected";                                                      
   $board_list=zb_query("select no,name from $admin_table where group_no='$group_data[no]'") or error(zb_error());
?>                                                                                                  
  <tr height=22 align=center>                                                                       
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>게시판 관리자 지정&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>
     <?=isset($__manager_board_name)?$__manager_board_name:''?>
     &nbsp;<select name=board_name>
     <option value="">게시판관리자 지정</option>
<?php
while($board_data_list=mysql_fetch_array($board_list))
{
 if(!eregi($board_data_list['no'].",",$member_data['board_name']))echo"<option value='$board_data_list[no]'>$board_data_list[name]</option>";
}
?>
     </select> <input type=button value="게시판 관리 권한 추가" onclick="add_board_manager()" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;>
     </td>
  </tr>
<?php                                                                                                  
  }
?> 

<?php if(!empty($group_data['use_birth'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>생일&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=birth_1 size=4 maxlength=4 value="<?=date("Y",$member_data['birth'])?>" class=input style=border-color:#b0b0b0> 년 
                    &nbsp;<input type=text name=birth_2 size=2 maxlength=2 value="<?=date("m",$member_data['birth'])?>" class=input style=border-color:#b0b0b0> 월
                    &nbsp;<input type=text name=birth_3 size=2 maxlength=2 value="<?=date("d",$member_data['birth'])?>" class=input style=border-color:#b0b0b0> 일 
  </tr>
<?php } ?>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>E-mail&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=email size=50 maxlength=255 value="<?=$member_data['email']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>홈페이지&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=homepage size=50 maxlength=255 value="<?=$member_data['homepage']?>" class=input style=border-color:#b0b0b0></td>
  </tr>

<?php if(!empty($group_data['use_icq'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>ICQ&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=icq size=20 maxlength=20 value="<?=$member_data['icq']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_aol'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>AIM(AOL)&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=aol size=20 maxlength=20 value="<?=$member_data['aol']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_msn'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>MSN&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=msn size=20 maxlength=20 value="<?=$member_data['msn']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_hobby'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>취미&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=hobby size=50 maxlength=50 value="<?=$member_data['hobby']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_job'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>직업&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=job size=20 maxlength=20 value="<?=$member_data['job']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_home_address'])) { ?> 
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>집 주소&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=home_address size=50 maxlength=255 value="<?=$member_data['home_address']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_home_tel'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>집 전화번호&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=home_tel size=20 maxlength=20 value="<?=$member_data['home_tel']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_office_address'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>회사 주소&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=office_address size=50 maxlength=255 value="<?=$member_data['office_address']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_office_tel'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>회사 전화번호&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=office_tel size=20 maxlength=20 value="<?=$member_data['office_tel']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_handphone'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>핸드폰&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=text name=handphone size=20 maxlength=20 value="<?=$member_data['handphone']?>" class=input style=border-color:#b0b0b0></td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_mailing'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>메일링리스트 가입&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=checkbox name=mailing value=1 <?=$check[$member_data['mailing']]?>></td>
  </tr>
<?php } ?>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>정보 공개 여부&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=checkbox name=openinfo value=1 <?=$check[$member_data['openinfo']]?>></td>
  </tr>

<?php if(!empty($group_data['use_picture'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>사진&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<input type=file name=picture size=37 maxlength=255 class=input style=border-color:#b0b0b0>
                 <?php if($member_data['picture']) echo"<br>&nbsp;<img src='$member_data[picture]' border=0>"; ?>
     </td>
  </tr>
<?php } ?>

<?php if(!empty($group_data['use_comment'])) { ?>
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>소갯말&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<textarea cols=50 rows=4 name=comment class=textarea style=border-color:#b0b0b0><?=$member_data['comment']?></textarea></td>
  </tr>
<?php } ?>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>Point&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<?=($member_data["point1"]*10+$member_data["point2"])?> 점 ( 작성글수 : <?=$member_data["point1"]?>, 코멘트 : <?=$member_data["point2"]?> )</td>
  </tr>

  <tr height=22 align=center>
     <td colspan=2 bgcolor=#a0a0a0 style=font-family:Tahoma;font-size:8pt;font-weight:bold; align=center>관리자 고유권한</td>
  </tr>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>Image Box 용량 지정&nbsp;&nbsp;</td>
	 <td align=left bgcolor=#e0e0e0>&nbsp;<?php
	 	$maxDirSize = zReadFile("icon/member_image_box/".$no."_maxsize.php");
		if($maxDirSize) {
			$maxDirSize = str_replace("<?php /*","",$maxDirSize);
			$maxDirSize = str_replace("*/?>","",$maxDirSize);
			$maxDirSize = (int)($maxDirSize / 1024);
		} else {
			$maxDirSize = 100;
		}?><input type=input name=maxdirsize value="<?=$maxDirSize?>" size=10 maxlength=20 class=input> KByte &nbsp; 이미지 창고의 사용 용량을 지정해 줄수 있습니다.</td>
  </tr>

  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>마크 그림&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<?php 
	$private_icon = get_private_icon($member_data['no'],1);
	if($private_icon) {
?>
		<img src='<?=$private_icon?>' border=1>
		<input type=checkbox value=1 name=delete_private_icon > Delete
<?php
	} else echo"<img src=images/t.gif border=1 width=16 height=15>";
?>
			<br>
			&nbsp;<input type=file name=private_icon value="" size=20 maxlength=20 class=input >
			<br>
			<img src=images/t.gif border=0 height=5><br>
	 		* 정해진 회원의 이름 앞에만 나타나는 아이콘입니다. <br>
			<font color=#e0e0e0>* </font>(GIF 파일만 가능합니다. 16x16px 정도로 해주세요)
	 </td>
  </tr>
	
  <tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>이름 그림&nbsp;&nbsp;</td>
     <td align=left bgcolor=#e0e0e0>&nbsp;<?php 
	$private_name = get_private_icon($member_data['no'],2);
	if($private_name) {
?>
		<img src='<?=$private_name?>' border=1>
		<input type=checkbox value=1 name=delete_private_name > Delete
<?php
	} else echo"<img src=images/t.gif border=1 width=16 height=15>";
?>
			<br>
			&nbsp;<input type=file name=private_name value="" size=20 maxlength=20 class=input >
			<br>
			<img src=images/t.gif border=0 height=5><br>
	 		* 정해진 회원의 이름을 대신해서 나타나는 아이콘입니다. <br>
			<font color=#e0e0e0>* </font>스킨에 따라서 오동작을 일으킬수 있으니 확인을 꼭 하여주세요<br>
			<font color=#e0e0e0>* </font>(GIF 파일만 가능합니다. 세로길이는 16px 정도로 해주세요)
	 </td>
  </tr>
<tr height=22 align=center>
     <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold;>관리자 비밀번호를 입력해주세요&nbsp;&nbsp;</td>
	 <td align=left bgcolor=#e0e0e0>&nbsp;<input type=password  name=admin_passwd value='' size=40 maxlength=255 class=input style="border: 2px solid #ff0000;"></td>
  </tr>
  <tr height=22 align=center><td colspan=2><input type=submit value='  변경 완료  ' style=font-weight:bold;border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px;>
                                 <input type=button value='  변경 취소  ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px; onclick=location.href="<?="$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like"?>">
  </td></tr>
  </form>
</table>
