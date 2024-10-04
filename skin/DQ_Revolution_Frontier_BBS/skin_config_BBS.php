<?php
// register_globals가 off일때를 위해 변수 재 정의
	@extract($_GET); 

// 제로보드 라이브러리 가져옴
	$_zb_path = realpath("../../")."/";
	include $_zb_path."lib.php";

// DB 연결정보와 회원정보 가져옴
	$connect = dbConn();
	$member  = member_info();

// 게시판 설정을 가져옴
	$setup=get_table_attrib($id);
	if(!$setup['no']) error("board not found!.","window.close");
    require dirname(__FILE__).'/skin_version.php';
    $set_charset = ($dqrevolutionCharType == 'utf8')? 'utf-8' : 'euc-kr';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>레볼루션 환경설정</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$set_charset?>">
<link rel="StyleSheet" HREF="css/config.css" type="text/css" title="style">
</head>
<script language="JavaScript">
function onoff_chk(obj1, obj2) {
	if(obj1.checked) obj2.checked = '';
	//if(obj1.checked) obj2.disabled = '1'; else obj2.disabled = '';
}

function showhide2(obj1, obj2) {
	obj2.style.display = (obj2.style.display == 'none')? '' : 'none';
	obj1.innerHTML = (obj2.style.display == 'none')? obj1.innerHTML.replace('-','+') : obj1.innerHTML.replace('+','-');
}

function showhide(obj1,obj2) {
	obj2.style.display = (!obj1.checked)? 'none': '';
}
</script>

<body style="margin:0;" class="info_bg">

<?php
// 회원인지 검사
	if(!$member['no']) Error("관리자만 접근 가능합니다.","window.close");

// 관리권한이 있는지 검사
	if($member['is_admin'] >= 3 && !$member['board_name']) Error("관리자만 접근 가능합니다.","window.close");
	elseif($member['is_admin'] >= 3 && !check_board_master($member,$setup['no'])) error("관리자만 접근 가능합니다.","window.close");

// 스킨 환경설정 읽어옴
	$skinConfigMode = $mode;
	$_put_css = true;
	include "get_config.php";

if($mode=="modify") 
{
// 검사
	$_mbPic_config_file = $_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php";
	if(!file_exists($_mbPic_config_file)) {
		copy("skinconfig_mbpic_default.php",$_mbPic_config_file);
		chmod ($_mbPic_config_file, 0707);
		include $_mbPic_config_file;
	}

// 엔진 가져오기
	$_inclib_01 = "./include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
	else include_once $_inclib_01.'zend';

// 라이센스 유형
	$licStatus = get_licenseStatus();

// 서버환경 알아냄 (OS는 exif프로그램 구동확인을 위해, GD는 썸네일 생성기능을 위해)
	$server_os  = get_serverOS();
	$_gd_version = get_gdVersion(1);
	$gd_version = get_gdVersion();
	if(!isset($pos)) $pos='0';

// 플러그인 검사
	if(file_exists("plug-ins/pgallery_header.php")) $plug_PG = 1;
//	if(file_exists("plug-ins/mrbt_limit.php")) $plug_ML = 1;
	if(function_exists('exif_read_data')) $plug_EX = 1;

	if($gd_version != 2) $skin_setup['using_usm'] = '';

// 설정
	$tabshow = 'none';

// New 아이콘
    $strNewIcon = '<img src="images/icon_new.gif" />';
?>
	<IFRAME name=get_css scrolling=no frameborder=0 width=0 height=0 src="get_cssconfig.php?id=<?=$skin_setup['css_dir']?>&mode=css" style="display:none">
	</IFRAME>
	<table width="100%" height="100%"  border="0" cellpadding="5" cellspacing="0" class=info_bg>
	  <form action="<?=basename($PHP_SELF)."?id=$id&mode=write&pos=$pos"?>" onSubmit="javascript:getScroll_pos()" method="post" enctype="multipart/form-data" name="config" id="config">
	  <input type=hidden name=pos id=pos value=<?=$pos?>>
	  <input type=hidden name=gd_version id=gd_version value=<?=$gd_version?>>
	  <tr>
		<td valign="top" class="info_bg" style="padding:5px;">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height=28 class="line2" style="font-size:13pt;font-weight:bold;">&nbsp;&nbsp;레/볼/루/션/ 환경설정 1.4</td>
		  </tr>
		  <tr>
		    <td class=line2 style="padding:5px">
			  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="18" width="100" align="right" class="line2"><b>서버OS</b></td>
                <td>:
                    <?=$server_os?></td>
              </tr>
              <tr>
                <td height="18" width="100" align="right" class="line2"><b>PHP버전</b></td>
                <td>: <?=phpversion()?></td>
              </tr>
              <tr>
                <td height="18" align="right" valign="top"><b>GD버전</b></td>
                <td>:
                    <?php if($_gd_version) echo $_gd_version; else echo "<font class=han2>서버에 GD라이브러리가 설치되어 있지 않습니다. 썸네일을 생성하지 않고 원본을 보여줍니다.</font><br>&nbsp;&nbsp;원본을 사용할 경우 썸네일 퀄리티가 좋지 않으며 트래픽 문제가 생길수도 있습니다."?>
					<?php if(get_gdVersion()<2) echo "&nbsp;&nbsp;GD 1.x 버전은 썸네일 퀄리티가 좋지 않습니다. 썸네일에서 보이는 계단현상은 정상입니다."?>				</td>
              </tr>
              <tr>
                <td height="18" align="right"><b>스킨버전</b></td>
                <td>: <?=$dqrevolutionType.' '.$skin_version?></td>
                </tr>
              <tr>
                <td height="18" align="right"><b>라이센스키</b></td>
                <td>: <?php if(!$licStatus) echo "설치안됨"; else echo "유형 $licStatus"?></td>
              </tr>
            </table></td>
		  </tr>
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10 5 10 5">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
              <tr>
                <td width="100" align="left" valign="top"><b>기본설정</b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <div  onClick="showhide2(this,gen)" style="cursor:pointer;padding:0 0 5px 10px;">+ CSS테마, 언어묶음, 설정파일 관리와 같은 전반적인 기능과 관련된 설정들</div>
				  <div id='gen' style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td>&nbsp;</td>
                    <td>스타일시트(CSS) 선택 </td>
                    <td><input type=hidden name=css_sel id=css_sel value="">
                        <SCRIPT LANGUAGE="JavaScript">
				<!--
				function chk_css (obj) {
					<?php include $skin_setup['css_dir']."css_info.php";?>
					var myindex=obj.selectedIndex;
					get_css.location="get_cssconfig.php?id="+obj.options[myindex].value+"&mode=css";
				}
				//-->
			      </SCRIPT>
                        <select name=css_dir onChange=chk_css(this)>
                          <?php
	 $css_dir="./css/";
	 $handle=opendir($css_dir);
	 while ($css_info = readdir($handle)) {
	   if(!ereg("\.",$css_info)) {
		 $css_info = "css/".$css_info."/";
		 if($css_info==$skin_setup['css_dir']) $select="selected"; else $select="";
		 include $css_info."css_info.php";
		 echo "<option value=$css_info $select>$css_name</option>";
	   }
	 }
	 closedir($handle);
	?>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>언어묶음 선택 </td>
                    <td><input type=hidden name=lang_sel id=lang_sel value="">
                        <select name=language_dir>
                          <?php
	 $lang_dir="./language/";
	 $handle=opendir($lang_dir);
	 while ($lang_info = readdir($handle)) {
	   if(!ereg("\.",$lang_info)) {
		 $lang_info = "language/".$lang_info."/";
		 if($lang_info==$skin_setup['language_dir']) $select="selected"; else $select="";
		 include $lang_info."lang_info.php";
		 echo "<option value=$lang_info $select>$lang_name</option>";
	   }
	 }
	 closedir($handle);
	?>
                      </select></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>설정 가져오기 </td>
                    <td><select name=copy_file id="copy_file">
                        <option value="">가져오지(연결하지) 않음</option>
                        <?php
	 $handle=opendir($_SKIN_config_dir);
	 while ($cfg_file = readdir($handle)) {
	   if(substr($cfg_file,0,4)=="cfg_" && $cfg_file!="cfg_$id".".php") {
		 $cfg_file_id = substr($cfg_file,4,strlen($cfg_file)-8);

		 $ftmp = file($_SKIN_config_dir.$cfg_file);
		 $is_linkCfg = false;
		 for($i=0; $i<count($ftmp); $i++) {
			 if(eregi("cfg_linkFile",$ftmp[$i])) {
				 $is_linkCfg = true;
				 break;
			 }
		 }

		 if(!$is_linkCfg) {
			 if(empty($cfg_linkFile)) $cfg_linkFile='';
			 if($cfg_file==$cfg_linkFile) {
				 $select=" selected";
				 $cfg_linkCheck = true;
			 } else $select="";
			 echo "<option value=$cfg_file $select>$cfg_file_id</option>";
		 }
	   }
	 }
	 closedir($handle);
	?>
                      </select>
      이 설정에서 &nbsp;&nbsp;<input type="radio" name="cfg_link" value="1"<?php if(!empty($cfg_linkCheck)) echo " checked"?>>
      연결하기 &nbsp;&nbsp;<input type="radio" name="cfg_link" value="2"<?php if(empty($cfg_linkCheck)) echo " checked"?>>가져오기</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                        <input name="save_as" type="checkbox" id="save_as" value="1" onClick=showhide(this,show_save)>
      다른이름으로 저장 <span name="show_save" id="show_save" style="display:none">
      <input name="save_file" type="text" class="input" id="save_file" size="20" maxlength="40">
      <input name="submit4" type="submit" class="submit" value="저장" style="width:50px;">
    </span> </td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td>게시판 배경색 지정 </td>
                    <td><input name="board_bgColor" type="text" class="input" id="board_bgColor" value="<?=$setup['bg_color']?>" size="20" maxlength="20">
      현재 CSS와 어울리는 배경색 : <font id=match_css class=han2><?php
					  include $skin_setup['css_dir']."css_info.php";
					  echo "$match_bgColor";
					?></font>&nbsp;&nbsp<span style="cursor:pointer;" onClick="board_bgColor.value=match_css.innerHTML">[바꾸기]</span> </td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td>게시물 제목 마우스오버 색 </td>
                    <td><input name="over_color" type="text" class="input" id="over_color" value="<?=$skin_setup['over_color']?>" size="20" maxlength="20">
      현재 CSS와 어울리는 오버색 : <font id=match_overcss class=han2><?php
						include $skin_setup['css_dir']."css_info.php";
						echo "$match_overColor";
					?></font>&nbsp;&nbsp <span style="cursor:pointer;" onClick="over_color.value=match_overcss.innerHTML">[바꾸기]</span></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="using_pGallery" value="1"<?php if(empty($plug_PG)) echo " disabled"?><?php if(!empty($skin_setup['using_pGallery'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">개인갤러리
                        사용<?php if(empty($plug_PG)) echo " <font class=han2>(플러그인이 설치되지 않음)</font>"?></td>
                  </tr>
                  <tr>
                    <td><input name="using_market" type="checkbox" id="using_market" value="1"<?php if(!empty($skin_setup['using_market'])) echo " checked"?>></td>
                    <td colspan="2">장터기능 사용 (글 작성 후 수정과 삭제 불가능, 수정시 원문이 보존되고 새 글이 추가됨) </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="marketMode_hideUser" type="checkbox" id="marketMode_hideUser" value="1"<?php if(!empty($skin_setup['marketMode_hideUser'])) echo " checked"?><?=draw_is_active()?>> 장터기능 사용시 댓글 닉네임을 판매자,예약자+숫자로 표시<br /><br /></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="using_memberPicture" value="1"<?php if(!empty($skin_setup['using_memberPicture'])) echo " checked"?>></td>
                    <td>회원사진 사용 </td>
                    <td>*회원사진 크기 - 가로방향:
                      <input name="member_picture_x" type="text" class="input" id="member_picture_x" value="<?=isset($skin_setup['member_picture_x'])?$skin_setup['member_picture_x']:''?>" size="5" maxlength="5">
픽셀, 세로방향:
<input name="member_picture_y" type="text" class="input" id="member_picture_y" value="<?=isset($skin_setup['member_picture_y'])?$skin_setup['member_picture_y']:''?>" size="5" maxlength="5">
픽셀 </td>
                  </tr>
                  <tr>
                    <td><input name="using_secretCode" type="checkbox" id="using_secretCode" value="1"<?php if(!empty($skin_setup['using_secretCode'])) echo " checked"?>></td>
                    <td colspan="2">스팸글 방지용 보안코드 입력받음</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">보안코드 입력 대상 : 비회원과 레벨 <input name="using_secretCodeValue1" type="text" class="input" id="using_secretCodeValue1" value="<?=!empty($skin_setup['using_secretCodeValue1'])?$skin_setup['using_secretCodeValue1']:''?>" size="2" maxlength="2"> 이하의 회원 또는 포인트 <input name="using_secretCodeValue2" type="text" class="input" id="using_secretCodeValue2" value="<?=!empty($skin_setup['using_secretCodeValue2'])?$skin_setup['using_secretCodeValue2']:''?>" size="6" maxlength="6"> 이하의 회원  <br />
                    <span style="margin-left:115px">(공백 또는 0 이면 적용안함)</span>
                    </td>
                  </tr>
                  <tr>
                    <td><input name="using_moveTrash" type="checkbox" id="using_moveTrash" value="1"<?php if(!empty($skin_setup['using_moveTrash'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">
                      글을 삭제하면 
                      <select name="using_moveTrashValue" id="using_moveTrashValue"<?=draw_is_active()?>>
                      <?php
                          $result=zb_query("select name from $admin_table order by name");
                          while($data=mysql_fetch_array($result)) {
							  if(empty($skin_setup['using_moveTrashValue'])) $skin_setup['using_moveTrashValue']='';
                              if($data['name'] == $skin_setup['using_moveTrashValue']) $select=' selected';
                              echo "<option value='$data[name]'$select>$data[name]</option>\n";
                              $select="";
                          }
                      ?>
                      </select> 
                      게시판으로 이동시켜 보관
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"><input type="checkbox" name="grant_imageLink" value="1"<?php if(!empty($skin_setup['grant_imageLink'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td valign="top">이미지 링크 차단</td>
                    <td><textarea name="grant_imageLinkSite" cols="100" rows="5" wrap="VIRTUAL" class="textarea" id="grant_imageLinkSite" style="width:99%"<?=draw_is_active()?>><?=!empty($skin_setup['grant_imageLinkSite'])?$skin_setup['grant_imageLinkSite']:''?></textarea>
                    <div>이미지 링크를 허용할 주소를 입력하세요.<br />여러개의 주소를 입력할때는 <b>,</b> (콤마)로 구분합니다.</div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                </table>
				  </span></td>
              </tr>
            </table></td>
		  </tr>

		  
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <col width=100>
              <col>
              <tr>
                <td width="100" align="left" valign="top"><b>썸네일 출력</b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <div  onClick="showhide2(this,thumbnail)" style="cursor:pointer;padding:0 0 10 10;">+ 썸네일 생성과 관련된 설정</div>
				  <div id=thumbnail style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input name="using_thumbnail" type="checkbox" id="using_thumbnail" value="1"<?php if(!empty($skin_setup['using_thumbnail'])) echo " checked"?>></td>
                    <td colspan="2">리스트에 썸네일 기능 사용 </td>
                    </tr>
                  <tr>
                    <td><input name="using_urlImg" type="checkbox" id="using_urlImg" value="1"<?php if(!empty($skin_setup['using_urlImg'])) echo " checked"?>></td>
                    <td colspan="2">외부링크에서 썸네일 생성 (HTML 태그를 분석하여 썸네일을 생성)</td>
                  </tr>
                  <tr>
                    <td><input name="viewSecretImg" type="checkbox" id="viewSecretImg" value="1"<?php if(!empty($skin_setup['viewSecretImg'])) echo " checked"?>></td>
                    <td colspan="2">비밀글도 썸네일 보여줌 <span class="descript">→ 기존 생성된 비밀글 아이콘 썸네일은 직접 삭제해야 합니다.</span></td>
                  </tr>
                  <tr>
                    <td><input name="using_mpicThumb" type="checkbox" id="using_mpicThumb" value="1"<?php if(!$gd_version) echo" disabled"?><?php if(!empty($skin_setup['using_mpicThumb'])) echo " checked"?>></td>
                    <td colspan="2">사진 대신 회원사진을 썸네일로 사용함 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>X축 최대 크기</td>
                    <td><input name="thumb_imagex" type="text" class="input" value="<?=$skin_setup['thumb_imagex']?>" size="4" maxlength="4">
      픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Y축 최대 크기</td>
                    <td><input name="thumb_imagey" type="text" class="input" value="<?=$skin_setup['thumb_imagey']?>" size="4" maxlength="4">
      픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>가로방향 정렬</td>
                    <td><input type="radio" name="thumb_align" value="left"<?php if($skin_setup['thumb_align']=="left") echo " checked"?>>
      왼쪽
        <input type="radio" name="thumb_align" value="center"<?php if($skin_setup['thumb_align']=="center") echo " checked"?>>
      가운데
      <input type="radio" name="thumb_align" value="right"<?php if($skin_setup['thumb_align']=="right") echo " checked"?>>
      오른쪽 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>리사이즈 방식 </td>
                      <td><input type="radio" name="thumb_resize" value="0"<?php if($skin_setup['thumb_resize']=="0") echo " checked"?>>원본비율 유지함
  <input type="radio" name="thumb_resize" value="1"<?php if($skin_setup['thumb_resize']=="1") echo " checked"?>>원본비율 유지하지 않음
<input type="radio" name="thumb_resize" value="2"<?php if($skin_setup['thumb_resize']=="2") echo " checked"?>>원본비율 유지하면서 Crop </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input name="using_usm" type="checkbox" id="using_usm" value="1"<?php if($skin_setup['using_usm']) echo " checked"?><?=draw_usm(0)?>></td>
                    <td>UnSharp Mask 사용 </td>
                    <td><?php if($gd_version == 2) {?>
						Amount:<input name="usm_option1" type="text" class="input" id="usm_option1" value="<?=$skin_setup['usm_option1']?>" size="4" maxlength="4"<?=draw_usm(0)?>>
						Radius:<input name="usm_option2" type="text" class="input" id="usm_option2" value="<?=$skin_setup['usm_option2']?>" size="4" maxlength="4"<?=draw_usm(0)?>>
						Threshold:<input name="usm_option3" type="text" class="input" id="usm_option3" value="<?=$skin_setup['usm_option3']?>" size="4" maxlength="4"<?=draw_usm(0)?>>
					    <?php } else echo "<font class=han2>2.0 이상의 GD가 필요합니다.</font>"?></td>
                  </tr>
                  <tr>
                    <td><input name="thumb_color_grey" type="checkbox" id="thumb_color_grey" value="1"<?php if(!empty($skin_setup['thumb_color_grey'])) echo " checked"?><?php if(substr(phpversion(),0,5) <= '4.3.1') echo " disabled"?>></td>
                    <td colspan="2">
                    흑백(B&W) 썸네일 생성
                    <?php if(substr(phpversion(),0,5) <= '4.3.1') echo "<span class=\"descript\">→php 4.3.1 이상에서 사용할 수 있는 기능입니다.</span>"?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>

		  
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>본문 내용 #1</td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <div  onClick="showhide2(this,body1)" style="cursor:pointer;padding:0 0 5px 10px;">+ 게시물보기를 했을때 나오는 본문 내용중 게시물 정보와 관련된 설정, 내용편집기 설정</div>
				  <div id=body1 style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input name="show_articleInfo" type="checkbox" id="show_articleInfo" value="1"<?php if($skin_setup['show_articleInfo']) echo " checked"?>></td>
                    <td>게시물 정보 보여줌 </td>
                    <td valign="bottom" style="padding:0px;">:: 내용편집기</td>
                  </tr>
                  <tr>
                    <td rowspan="5">&nbsp;</td>
                    <td rowspan="5" valign="top"><p><br>
						제목 [subj]<br>
						카테고리 [cate]<br>
						이름 [name]<br>
						IP [IP]<br>
						---- info1_start ----<br>
						조회 [hit]<br>
						추천 [vote]<br>
						코멘트 [comment]<br>
						게시물 점수 [point]<br>
						---- info1_end -----<br>
						등록시간 [regdate] <br>
						등록파일 [file]<br>
						링크 [link]<br>
						추천인 목록 [vote_user] <br>
						5픽셀공백 [spacer]</p></td>
                    <td valign="top"><textarea name="article_info" cols="100" rows="11" wrap="VIRTUAL" class="textarea" id="textarea2" style="width:99%"><?=stripslashes($skin_setup['article_info'])?></textarea></td>
                  </tr>
                  <tr>
                    <td valign="top"><input name="show_subj" type="checkbox" id="show_subj" value="1"<?php if(!empty($skin_setup['show_subj'])) echo " checked"?>>사진 상단(최상단) 에 제목 보여줌 </td>
                  </tr>
                  <tr>
                    <td valign="top"><input name="using_bmode" type="checkbox" id="using_bmode" value="1"<?php if(!empty($skin_setup['using_bmode'])) echo " checked"?>>게시물 정보를 글 보기 화면 최상단에 배치 / 해제시 하단으로 이동 </td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>

		  
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>본문 내용 #2</td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <span  onClick="showhide2(this,body2)" style="cursor:pointer;padding:0 0 5px 10px;">+ 본문내용 볼때의 정렬, 이미지 보호와 리사이즈 등의 세부설정</span>
				  <div id=body2 style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input type="checkbox" name="slide_album_mode" value="1"<?php if(!empty($skin_setup['slide_album_mode'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">
                      슬라이드 앨범 사용
                      <span class="descript">→ 본문의 연작사진을 썸네일로 출력하고 썸네일에 슬라이드 기능을 결합</span>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">
                      첨부된 사진이 <input name="slide_album_mode_value1" type="text" class="input" id="slide_album_mode_value1" value="<?=$skin_setup['slide_album_mode_value1']?>" size="4" maxlength="4">개 보다 많을 경우 미리보기 기능을 끄고 썸네일만 보여줌
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">
                      썸네일 크기 : <input name="slide_album_mode_value2" type="text" class="input" id="slide_album_mode_value2" value="<?=$skin_setup['slide_album_mode_value2']?>" size="4" maxlength="4"> 픽셀 (가로x세로 Crop 이미지 생성)<hr>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;* </td>
                    <td colspan="2">
                      파일 다운로드 링크의 최대출력 갯수 :
                      <input name="download_link_number" type="text" class="input" id="download_link_number" value="<?=!empty($skin_setup['download_link_number'])?$skin_setup['download_link_number']:''?>" size="3" maxlength="3"> 개 <?=$strNewIcon?>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="no_hideImgDir" value="1"<?php if(!empty($skin_setup['no_hideImgDir'])) echo " checked"?>></td>
                    <td colspan="2">
                      본문 보기시 이미지의 실제경로 숨기기 기능을 사용하지 않음
                      <br><span class="descript">→ 다량의 이미지가 업로드된 게시물에서 X박스 현상이 발생하는 서버환경에서 사용.<br>주의: 실제경로를 빼내서 링크한 이미지는 링크차단 기능이 적용되지 않음.</span>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="using_autoResize" value="1"<?php if(!empty($skin_setup['using_autoResize'])) echo " checked"?>></td>
                    <td colspan="2">
      사진크기 자동조절 : <input name="pic_overLimit1" type="text" class="input" id="pic_overLimit1" value="<?=$skin_setup['pic_overLimit1']?>" size="4" maxlength="4"> 픽셀 이상일 경우 <input name="pic_overLimit2" type="text" class="input" id="pic_overLimit2" value="<?=$skin_setup['pic_overLimit2']?>" size="4" maxlength="4"> 픽셀로 리사이즈
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">
                      <input type="checkbox" name="resize_widthOnly" value="1"<?php if(!empty($skin_setup['resize_widthOnly'])) echo " checked"?>>리사이즈 여부를 이미지의 가로 픽셀 검사로만 결정함 (체크 해제하면 가로+세로를 검사함)
                    </td>
                  </tr>
                  <tr>
                    <td><input name="mrbt_clickLimit" type="checkbox" id="mrbt_clickLimit" value="1"<?php if(!empty($skin_setup['mrbt_clickLimit'])) echo " checked"?>></td>
                    <td colspan="2" > <input name="mrbt_pixelValue" type="text" class="input" id="mrbt_pixelValue" value="<?=$skin_setup['mrbt_pixelValue']?>" size="4" maxlength="4"> 픽셀 이상의 모든 이미지에 대해 마우스 우측버튼 클릭을 차단함</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" >게시물 주인과 관리자, 그리고 레벨
                      <input name="mrbt_passLevel" type="text" class="input" id="mrbt_passLevel" value="<?=!empty($skin_setup['mrbt_passLevel'])?$skin_setup['mrbt_passLevel']:''?>" size="1" maxlength="2"> 이상의 회원은 마우스 우측버튼 차단 작동안함 </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="using_exif" value="1"<?php if(empty($plug_EX)) echo " disabled"; elseif(!empty($skin_setup['using_exif'])) echo " checked"?>></td>
                    <td colspan="2">EXIF 출력
                        <?php if(empty($plug_EX)) echo "(<span class=han2>실행모듈이 없거나 동작하지 않습니다. 제작자 홈페이지의 FAQ를 참고하세요.</span>)"?>
                    </td>
                  </tr>
                  <tr>
                    <td><input name="using_shutter" type="checkbox" id="using_shutter" value="1"<?php if(!empty($skin_setup['using_shutter'])) echo " checked"?>></td>
                    <td>책넘김 소리 사용 </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input name="using_bodyBtTool2" type="checkbox" id="using_bodyBtTool2" value="1"<?php if(!empty($skin_setup['using_bodyBtTool2'])) echo " checked"?>></td>
                    <td colspan="2">페이지 하단의 버튼모음 사용 </td>
                  </tr>
                  <tr>
                    <td><input name="using_picBorder" type="checkbox" id="using_picBorder" value="1"<?php if(!empty($skin_setup['using_picBorder'])) echo " checked"?>></td>
                    <td colspan="2">사진 테두리 사용</td>
                    </tr>
                  <tr>
                    <td><input name="using_bgmPlayer" type="checkbox" id="using_bgmPlayer" value="1"<?php if(!empty($skin_setup['using_bgmPlayer'])) echo " checked"?>></td>
                    <td colspan="2">BGM플레이어 제어기 사용</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">레벨
                      <input name="bgmPlayerLevel" type="text" class="input" id="bgmPlayerLevel" value="<?=$skin_setup['bgmPlayerLevel']?>" size="2" maxlength="2">
이상의 회원만 음악 재생 가능 </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>사진 정렬</td>
                    <td><input type="radio" name="pic_align" value="left"<?php if($skin_setup['pic_align']=="left") echo " checked"?>>
      왼쪽
        <input type="radio" name="pic_align" value="center"<?php if($skin_setup['pic_align']=="center") echo " checked"?>>
      가운데
      <input type="radio" name="pic_align" value="right"<?php if($skin_setup['pic_align']=="right") echo " checked"?>>
      오른쪽 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>사진 출력공간 가로폭 </td>
                    <td><input name="pic_width" type="text" class="input" id="pic_width" value="<?=$skin_setup['pic_width']?>" size="5" maxlength="5">
      픽셀(100 보다 작으면 %로 인식, 0이면 게시판설정 적용) </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>사진 사이의 세로방향 간격 </td>
                    <td><input name="pic_vSpace" type="text" class="input" id="pic_vSpace" value="<?=$skin_setup['pic_vSpace']?>" size="5" maxlength="5">
      픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="using_pictureDescript" type="checkbox" id="using_pictureDescript" value="1"<?php if(!empty($skin_setup['using_pictureDescript'])) echo " checked"?>> 연작 사진에 번호 붙이기</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>본문글 정렬 </td>
                    <td><input type="radio" name="memo_align" value="left"<?php if($skin_setup['memo_align']=="left") echo " checked"?>>
      왼쪽
        <input type="radio" name="memo_align" value="center"<?php if($skin_setup['memo_align']=="center") echo " checked"?>>
      가운데
      <input type="radio" name="memo_align" value="right"<?php if($skin_setup['memo_align']=="right") echo " checked"?>>
      오른쪽 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>본문글 가로폭 </td>
                    <td><input name="memo_width" type="text" class="input" id="memo_width" value="<?=$skin_setup['memo_width']?>" size="5" maxlength="5">
      픽셀(100 보다 작으면 %로 인식, 0이면 글 수에 따라 자동) </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>본문하단 여백</td>
                    <td><input name="memo_bMargin" type="text" class="input" id="memo_bMargin" value="<?=$skin_setup['memo_bMargin']?>" size="3" maxlength="3"> 픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>좌측 여백 </td>
                    <td><input name="view_lSwidth" type="text" class="input" id="view_lSwidth" value="<?=$skin_setup['view_lSwidth']?>" size="5" maxlength="5"> 픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>우측 여백 </td>
                    <td><input name="view_rSwidth" type="text" class="input" id="view_rSwidth" value="<?=$skin_setup['view_rSwidth']?>" size="5" maxlength="5"> 픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>이전,다음사진 썸네일 크기</td>
                    <td>
						X: <input name="PNthumbnailSize_x" type="text" class="input" id="PNthumbnailSize_x" value="<?=!empty($skin_setup['PNthumbnailSize_x'])?$skin_setup['PNthumbnailSize_x']:''?>" size="5" maxlength="5">픽셀 , 
						Y: <input name="PNthumbnailSize_y" type="text" class="input" id="PNthumbnailSize_y" value="<?=!empty($skin_setup['PNthumbnailSize_y'])?$skin_setup['PNthumbnailSize_y']:''?>" size="5" maxlength="5">픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>

		  
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>글(게시물) 등록</b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <span  onClick="showhide2(this,posting)" style="cursor:pointer;padding:0 0 5px 10px;">+ 글쓰기 기능과 관련된 설정들</span>
				  <div id=posting style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input name="using_imageUpOnly" type="checkbox" id="using_imageUpOnly" value="1"<?php if(!empty($skin_setup['using_imageUpOnly'])) echo " checked"?>></td>
                    <td colspan="2">이미지 파일만 업로드 가능하게함<span class="descript">→갤러리로만 사용하는 게시판일때 설정하세요</span></td>
                  </tr>
                  <tr>
                    <td align="center">*</td>
                    <td colspan="2" >파일 업로드 최대 갯수 :
                      <input name="upload_number" type="text" class="input" value="<?=$skin_setup['upload_number']?>" size="3" maxlength="4"> 개 <span class="descript">→ '0' 이면 무제한입니다.<?php if(!$setup['use_pds']){?><span style="color:red"> (사용 하시려면 게시판 설정에서 '자료실' 기능을 활성화 하세요)</span><?php }?></span>
                      </td>
                  </tr>
                  <tr>
                    <td><input name="using_writeLimit" type="checkbox" id="using_writeLimit" value="1"<?php if(!empty($skin_setup['using_writeLimit'])) echo " checked"?>></td>
                    <td>게시물 등록 제한</td>
                    <td><input name="upload_limit1" type="text" class="input" value="<?=$skin_setup['upload_limit1']?>" size="5" maxlength="8">
      분에
        <input name="upload_limit2" type="text" class="input" value="<?=$skin_setup['upload_limit2']?>" size="4" maxlength="4">
      개 까지 (1일: 60분x24=1440분) </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>게시물 등록 무제한 회원</td>
                    <td><input name="admin_upLimit_Pass" type="checkbox" id="admin_upLimit_Pass" value="1"<?php if(!empty($skin_setup['admin_upLimit_Pass'])) echo " checked"?>>
      관리자, 레벨
        <input name="upLimit_Pass_Level" type="text" class="input" id="upLimit_Pass_Level" value="<?=$skin_setup['upLimit_Pass_Level']?>" size="2" maxlength="2">
      이상의 회원</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>게시물 등록 제한 시간 </td>
                    <td>게시물 등록후
                        <input name="upload_limit3" type="text" class="input" value="<?=$skin_setup['upload_limit3']?>" size="4" maxlength="8">
      분이 지나야 다음 게시물 등록 가능 </td>
                  </tr>
                  <tr>
                    <td><input name="ImgUpLimit" type="checkbox" id="ImgUpLimit" value="1"<?php if(!empty($skin_setup['ImgUpLimit'])) echo " checked"?>></td>
                    <td>이미지 크기 제한 </td>
                    <td><input name="ImgUpLimit2" type="text" class="input" id="ImgUpLimit2" value="<?=$skin_setup['ImgUpLimit2']?>" size="4" maxlength="4">
                      만 화소 이상은 업로드를 제한함 </td>
                  </tr>
                  <tr>
                    <td><div align="center">*</div></td>
                    <td>글쓰기 버튼 표기 </td>
                    <td><input name="write_buttonName" type="text" class="input" value="<?=$skin_setup['write_buttonName']?>" size="30" maxlength="30"></td>
                  </tr>
				  <tr>
                    <td><input name="using_bmpIMG_Convert" type="checkbox" id="using_bmpIMG_Convert" value="1"<?php if(!empty($skin_setup['using_bmpIMG_Convert'])) echo " checked"?>></td>
                    <td colspan="2">*.BMP 포멧은 강제변환(jpeg->png->gif 순서로 시도)</td>
                  </tr>
                  <tr>
                    <td><input name="using_upIMG_Resize" type="checkbox" id="using_upIMG_Resize" value="1"<?php if(!empty($skin_setup['using_upIMG_Resize'])) echo " checked"?>></td>
                    <td colspan="2">리사이즈 후 업로드(저장) : 
                      <input name="using_upIMG_Resize2" type="text" class="input" id="using_upIMG_Resize2" value="<?=$skin_setup['using_upIMG_Resize2']?>" size="4" maxlength="4">
                      픽셀 이상일 경우 변환</td>
                  </tr>
                  <tr>
                    <td><input name="using_emptyArticle" type="checkbox" id="using_emptyArticle" value="1"<?php if(!empty($skin_setup['using_emptyArticle'])) echo " checked"?>></td>
                    <td colspan="2">&quot;제목, 내용&quot; 없이 게시물 등록가능</td>
                  </tr>
                  <tr>
                    <td><input name="using_secretonly" type="checkbox" id="using_secretonly" value="1"<?php if(!empty($skin_setup['using_secretonly'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">비밀글로만 등록 </td>
                  </tr>
                  <tr>
                    <td><input name="inputPWD_mbSecretArticle" type="checkbox" id="inputPWD_mbSecretArticle" value="1"<?php if(!empty($skin_setup['inputPWD_mbSecretArticle'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">
                    로그인 상태로 글 쓰면서 비밀글에 체크하면 비밀번호 입력받음<br />
                    <span class="descript">→비밀번호를 아는 사람은 열람가능</span>
                    </td>
                  </tr>
                  <tr>
                    <td><input name="write_nopoint" type="checkbox" id="write_nopoint" value="1"<?php if(!empty($skin_setup['write_nopoint'])) echo " checked"?>></td>
                    <td colspan="2">글 작성시 얻는 회원 점수를 적용하지 않음(코멘트에도 동시적용)</td>
                  </tr>
                  <tr>
                    <td><input name="using_attacguard" type="checkbox" id="using_attacguard" value="1"<?php if(!empty($skin_setup['using_attacguard'])) echo " checked"?>></td>
                    <td colspan="2">도배방지, 중복글 방지 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td colspan="2">글 작성자에게 글 작성 포인트 <input name="writePointValue" type="text" class="input" id="writePointValue" value="<?=$skin_setup['writePointValue']?>" size="2" maxlength="2">을 부여함(포인트 1당 10점으로 계산됨)</td>
                  </tr>
                  <tr>
                    <td><input name="check_imageFileFound" type="checkbox" id="check_imageFileFound" value="1"<?php if(!empty($skin_setup['check_imageFileFound'])) echo " checked"?>></td>
                    <td colspan="2">이미지 파일을 하나 이상 업로드 해야만 글쓰기 성공함</td>
                  </tr>
                  <tr>
                    <td><input name="using_viewer_level" type="checkbox" id="using_viewer_level" value="1"<?php if(!empty($skin_setup['using_viewer_level'])) echo " checked"?>></td>
                    <td colspan="2">
                      열람(읽기)가능한 회원레벨을 글 작성시 게시물에 개별적으로 설정<br />
                      <span class="descript">→게시판 권한설정의 범위내에서 설정 가능합니다.</span>
                    </td>
                  </tr>
                  <tr>
                    <td><input name="using_submitArticle_eMail2Admin" type="checkbox" id="using_submitArticle_eMail2Admin" value="1"<?php if(!empty($skin_setup['using_submitArticle_eMail2Admin'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">새 글이 등록되면 관리자 이메일로 알리기</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">관리자 메일 주소 : <input name="adminEmailAdress" type="text" class="input" id="adminEmailAdress" value="<?=!empty($skin_setup['adminEmailAdress'])?$skin_setup['adminEmailAdress']:''?>" size="20" maxlength="128"></td>
                  </tr>
                  <tr>
                    <td><input name="using_weditor" type="checkbox" id="using_weditor" value="1"<?php if(!empty($skin_setup['using_weditor'])) echo " checked"?>></td>
                    <td colspan="2">WYSIWYG 에디터 사용 (<a href="http://www.fckeditor.net" target="_blank">FCKeditor</a>)</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">에디터가 설치된 경로 :
                      <input name="WEditor_dir" type="text" class="input" id="WEditor_dir" value="<?=$skin_setup['WEditor_dir']?>" size="30" maxlength="256"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>FCKeditor 스킨 선택</td>
                    <td>
                        <select name=fckSkin_dir>
                          <?php
	 $fckSkin_dir="./fck_skins/";
	 $handle=opendir($fckSkin_dir);
	 while ($dir = readdir($handle)) {
	   if(!ereg("\.",$dir)) {
		 $dir = "fck_skins/".$dir."/";
		 if(empty($skin_setup['fckSkin_dir'])) $skin_setup['fckSkin_dir']='';
		 if($dir==$skin_setup['fckSkin_dir']) $select="selected"; else $select="";
		 include $dir."skin_info.php";
		 echo "<option value=$dir $select>$skin_name</option>";
	   }
	 }
	 closedir($handle);
	?>
                      </select></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>


          <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>짧은답글<br>
                  &nbsp;&nbsp;&nbsp;&nbsp;+<br>
                  추천기능</b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <span  onClick="showhide2(this,comment)" style="cursor:pointer;padding:0 0 5px 10px;">+ 짧은답글(코멘트)과 추천 기능에 관련된 설정들</span>
				  <div id=comment style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input name="using_comment" type="checkbox" id="using_comment" value="1"<?php if(!empty($skin_setup['using_comment'])) echo " checked"?>></td>
                    <td colspan="2">코멘트 기능 사용</td>
                  </tr>
                  <tr>
                    <td><input name="using_commentMultiDelete" type="checkbox" id="using_commentMultiDelete" value="1"<?php if(!empty($skin_setup['using_commentMultiDelete'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">게시물내 코멘트의 총갯수가 <input name="commentMD_Value" type="text" class="input" id="commentMD_Value" value="<?=!empty($skin_setup['commentMD_Value'])?$skin_setup['commentMD_Value']:''?>" size="3" maxlength="8"<?=draw_is_active()?>>개 이상일 경우 코멘트 일괄삭제 기능 켜짐(이용불가! 미완성 기능)</td>
                  </tr>
                  <tr>
                    <td><input name="using_hideComment" type="checkbox" id="using_hideComment" value="1"<?php if(!empty($skin_setup['using_hideComment'])) echo " checked"?>></td>
                    <td colspan="2">코멘트 작성권한이 없을경우 코멘트 내용 숨김</td>
                  </tr>
                  <tr>
                    <td><input name="using_commentEditor" type="checkbox" id="using_commentEditor" value="1"<?php if(!empty($skin_setup['using_commentEditor'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">작성한후
                      <input name="using_commentEditor2" type="text" class="input" id="using_commentEditor2" value="<?=$skin_setup['using_commentEditor2']?>" size="3" maxlength="8"<?=draw_is_active()?>>분을 경과하지 않은 짧은답글은 수정할수 있음 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" >작성글 내용의 글자수가 
                      <input name="comment_nopoint2" type="text" class="input" id="comment_nopoint2" value="<?=$skin_setup['comment_nopoint2']?>" size="3" maxlength="5">
                      자 보다 많을때만 점수 추가됨 (영문기준, 한글은 2자로 인식) </td>
                    </tr>
                  <tr>
                    <td><input name="using_vote" type="checkbox" id="using_vote" value="1"<?php if(!empty($skin_setup['using_vote'])) echo " checked"?> onClick="showhide(this,votetype)"></td>
                    <td>추천 기능 사용 </td>
                    <td><div id=votetype<?php if(empty($skin_setup['using_vote'])) echo " style='display:none'"?>><input type="radio" name="vote_type" value="1"<?php if(!empty($skin_setup['vote_type']) && $skin_setup['vote_type']=="1") echo " checked"?>> 일반 추천
  <input type="radio" name="vote_type" value="2"<?php if($skin_setup['vote_type']=="2") echo " checked"?>> 강화된 추천(주의! 비회원은 추천버튼 안보임)</div></td>
                  </tr>
				  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">강화된 추천시 기본 코멘트 달기 방법 <input type="radio" name="coment_select" value="1"<?php if(!empty($skin_setup['coment_select']) && $skin_setup['coment_select']=="1") echo " checked"?>> 추천하기
  <input type="radio" name="coment_select" value="2"<?php if(!empty($skin_setup['coment_select']) && $skin_setup['coment_select']=="2") echo " checked"?>> 글만남김</td>
                  </tr>
                  <tr>
                    <td><input name="poll_day" type="checkbox" id="poll_day" value="1"<?php if(!empty($skin_setup['poll_day'])) echo " checked"?>></td>
                    <td colspan="2">투표(추천) 기간 : 
						<select name="poll_day1" id="poll_day1">
						<?php
						$day = date('Y')-1;
						while($day <= (date('Y')+10)) {
							$select = ($day == $skin_setup['poll_day1'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>년 
						<select name="poll_day2" id="poll_day2">
						<?php
						$day = 1;
						while($day <= 12) {
							$select = ($day == $skin_setup['poll_day2'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>월 
						<select name="poll_day3" id="poll_day3">
						<?php
						$day = 1;
						while($day <= 31) {
							$select = ($day == $skin_setup['poll_day3'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>일 ~ 
						<select name="poll_day4" id="poll_day4">
						<?php
						$day = date('Y');
						while($day <= (date('Y')+10)) {
							$select = ($day == $skin_setup['poll_day4'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>년
						<select name="poll_day5" id="poll_day5">
						<?php
						$day = 1;
						while($day <= 12) {
							$select = ($day == $skin_setup['poll_day5'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>월
						<select name="poll_day6" id="poll_day6">
						<?php
						$day = 1;
						while($day <= 31) {
							$select = ($day == $skin_setup['poll_day6'])? 'selected' : '';
							echo "<option value='$day' $select>$day</option>\n";
							$day++;
						}
						?>
						</select>일 까지 </td>
                    </tr>
                  <tr>
                    <td>
                      <input name="move_vote" type="checkbox" id="move_vote" value="1"<?php if(!empty($skin_setup['move_vote'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">추천수가 
					  <input name="move_vote2" type="text" class="input" id="move_vote2" value="<?=$skin_setup['move_vote2']?>" size="4" maxlength="4"<?=draw_is_active()?>> 
                      이상이면 
                      <select name="move_vote3" id="move_vote3"<?=draw_is_active()?>>
<?php
	$result=zb_query("select name from $admin_table order by name");
	while($data=mysql_fetch_array($result)) {
		if($data['name'] == $skin_setup['move_vote3']) $select=' selected';
		echo "<option value='$data[name]'$select>$data[name]</option>\n";
		$select="";
	}
?>
                      </select> 
                      게시판으로 
                      <select name="move_vote4" id="move_vote4"<?=draw_is_active()?>>
                        <option value="copy_all"<?php if($skin_setup['move_vote4']=='copy_all') echo " selected"?>>복사</option>
                        <option value="move_all"<?php if($skin_setup['move_vote4']=='move_all') echo " selected"?>>이동</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td><input name="using_addRecommentPoint" type="checkbox" id="using_addRecommentPoint" value="1"<?php if(!empty($skin_setup['using_addRecommentPoint'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">추천에 의한 자동 이동시 게시물 작성자에게 글쓰기 포인트 <input name="RecommentPointValue" type="text" class="input" id="RecommentPointValue" value="<?=!empty($skin_setup['RecommentPointValue'])?$skin_setup['RecommentPointValue']:''?>" size="2" maxlength="2"<?=draw_is_active()?>>점 주기</td>
                  </tr>
                  <tr>
                    <td><input name="using_addOwnerPoint" type="checkbox" id="using_addOwnerPoint" value="1"<?php if(!empty($skin_setup['using_addOwnerPoint'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">추천시 원본 글 작성자에게도 코멘트 점수 주기</td>
                  </tr>
                  <tr>
                    <td><input name="using_limitComment" type="checkbox" id="using_limitComment" value="1"<?php if(!empty($skin_setup['using_limitComment'])) echo " checked"?> onClick="onoff_chk(this,using_sendCommentMemo)"></td>
                    <td colspan="2">글 작성 기간이 
                      <input name="using_limitComment2" type="text" class="input" id="using_limitComment2" value="<?=$skin_setup['using_limitComment2']?>" size="3" maxlength="3">
                      일 이상 지났을 경우 짧은답글과 추천을 남길 수 없음 </td>
                  </tr>
                  <tr>
                    <td><input name="using_sendCommentMemo" type="checkbox" id="using_sendCommentMemo" value="1"<?php if(!empty($skin_setup['using_sendCommentMemo'])) echo " checked"?> onClick="onoff_chk(this,using_limitComment)"></td>
                    <td colspan="2">글 작성 기간이 
                      <input name="using_sendCommentMemo2" type="text" class="input" id="using_sendCommentMemo2" value="<?=$skin_setup['using_sendCommentMemo2']?>" size="3" maxlength="3">
                      일 이상 지났을 경우 답글 내용을 글 주인(본문 작성자)에게 쪽지로 알림 </td>
                  </tr>
                  <tr>
                    <td><input name="using_noticecomment" type="checkbox" id="using_noticecomment" value="1"<?php if(!empty($skin_setup['using_noticecomment'])) echo " checked"?>></td>
                    <td colspan="2">공지 게시물에 코멘트 작성할 수 있음</td>
                  </tr>
                  <tr>
                    <td><input name="using_cmOwnerOnly" type="checkbox" id="using_cmOwnerOnly" value="1"<?php if(!empty($skin_setup['using_cmOwnerOnly'])) echo " checked"?>></td>
                    <td colspan="2">자신이 작성한 글이 아니면 코멘트 남길수 없음 (관리자는 영향받지 않음) </td>
                  </tr>
                  <tr>
                    <td><input name="using_cReplyMode" type="checkbox" id="using_cReplyMode" value="1"<?php if(!empty($skin_setup['using_cReplyMode'])) echo " checked"?>></td>
                    <td colspan="2">계층형 코멘트(일명 댓글에 댓글달기) 사용</td>
                  </tr>
                  <tr>
                    <td><input name="using_cmtRanking" type="checkbox" id="using_cmtRanking" value="1"<?php if(!empty($skin_setup['using_cmtRanking'])) echo " checked"?>></td>
                    <td colspan="2">코멘트에 순위(등수) 표시</td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td colspan="2">작성 후&nbsp<input name="cmtTimeAlertValue" type="text" class="input" id="cmtTimeAlertValue" value="<?=$skin_setup['cmtTimeAlertValue']?>" size="4" maxlength="4">분이 지나지 않은 코멘트가 있을경우 진하게 표시<br />(목록의 코멘트 합계와 본문 보기시 코멘트 순위 표시에 적용)</td>
                  </tr>
                  <tr>
                    <td><input name="using_hideNickname" type="checkbox" id="using_hideNickname" value="1"<?php if(!empty($skin_setup['using_hideNickname'])) echo " checked"?><?=draw_is_active()?>></td>
                    <td colspan="2">코멘트 작성자 닉네임을 익명으로 변환하여 보여줌</td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td colspan="2">코멘트 작성자에게 코멘트 작성 포인트 <input name="commentPointValue" type="text" class="input" id="commentPointValue" value="<?=$skin_setup['commentPointValue']?>" size="2" maxlength="2">을 부여함(포인트 1당 1점으로 계산됨)</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">※주의※<br /><b>추천과 관련된 기능들은 '강화된 추천' 사용시에만 동작합니다.<br />일반추천은 제로보드 고유의 추천기능입니다.</b></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>
		  
		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>네비게이션<br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
                  <br> 
                  &nbsp;&nbsp;글목록</b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <span  onClick="showhide2(this,navi)" style="cursor:pointer;padding:0 0 5px 10px;">+ 글 목록 볼때의 인터페이스 설정과 전체 네비게이션 설정</span>
				  <div id=navi style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="10" style="padding-top:0px">
                  <col width="150" style="padding-top:4px;">
                  <col width="">
                  <tr>
                    <td><input name="using_pageNumber" type="checkbox" id="using_pageNumber" value="1"<?php if($skin_setup['using_pageNumber']) echo " checked"?>></td>
                    <td>페이지 번호 사용 </td>
                    <td>정렬방법:
                        <input type="radio" name="pageNum_align" value="left"<?php if($skin_setup['pageNum_align']=="left") echo " checked"?>>
      왼쪽
      <input type="radio" name="pageNum_align" value="center"<?php if($skin_setup['pageNum_align']=="center") echo " checked"?>>
      가운데
      <input type="radio" name="pageNum_align" value="right"<?php if($skin_setup['pageNum_align']=="right") echo " checked"?>>
      오른쪽</td>
                  </tr>
                  <tr>
                    <td><input name="using_pageNavi" type="checkbox" id="using_pageNavi" value="1"<?php if($skin_setup['using_pageNavi']) echo " checked"?>></td>
                    <td>페이지 이동버튼 사용 </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input name="using_search" type="checkbox" id="using_search" value="1"<?php if($skin_setup['using_search']) echo " checked"?>></td>
                    <td colspan="2">검색창 사용 </td>
                  </tr>
                  <tr>
                    <td><input name="disable_login" type="checkbox" id="disable_login" value="1"<?php if($skin_setup['disable_login']) echo " checked"?>></td>
                    <td colspan="2">로그인/회원가입/메모 버튼 숨김</td>
                  </tr>
                  <tr>
                    <td><input name="using_category" type="checkbox" id="using_category" value="1"<?php if($skin_setup['using_category']) echo " checked"?>></td>
                    <td>카테고리 출력함</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">카테고리 출력 가로 개수가
                        <input name="cate_limit" type="text" class="input" id="cate_limit" value="<?=$skin_setup['cate_limit']?>" size="2" maxlength="2">개 이상이면 다음줄로 넘어감 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>카테고리 출력방법 </td>
                    <td><input type="radio" name="category_type" value="col"<?php if($skin_setup['category_type']=="col") echo " checked"?>>
      가로방향 나열 [<input type="radio" name="category_type" value="row"<?php if($skin_setup['category_type']=="row") echo " checked"?>>
      셀렉트박스 - 위치:
      <input type="radio" name="category_pos" value="1"<?php if($skin_setup['category_pos']=="1") echo " checked"?>>
      왼쪽
      <input type="radio" name="category_pos" value="2"<?php if($skin_setup['category_pos']=="2") echo " checked"?>>
      오른쪽
      <input type="radio" name="category_pos" value="3"<?php if($skin_setup['category_pos']=="3") echo " checked"?>>
      타이틀바 ]</td>
                  </tr>
                  <tr>
                    <td><input name="using_keyNavi" type="checkbox" id="using_keyNavi" value="1"<?php if(!empty($skin_setup['using_keyNavi'])) echo " checked"?>></td>
                    <td colspan="2">키보드네비게이션 사용</td>
                  </tr>
                  <tr>
                    <td><input name="using_imageNavi" type="checkbox" id="using_imageNavi" value="1"<?php if(!empty($skin_setup['using_imageNavi'])) echo " checked"?>></td>
                    <td colspan="2">이미지네비게이션 사용</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="using_newWindow" value="1"<?php if(!empty($skin_setup['using_newWindow'])) echo " checked"?>></td>
                    <td colspan="2">썸네일 클릭시 라이트박스로 원본 이미지 보여줌 사용</td>
                  </tr>
                  <tr>
                    <td><input name="using_titlebar" type="checkbox" id="using_titlebar" value="1"<?php if(!empty($skin_setup['using_titlebar'])) echo " checked"?>></td>
                    <td>글 목록 상단 타이틀 바 </td>
                    <td style="font-family:dotum,돋움;font-size:11px"><input name="using_titlebar1" type="checkbox" id="using_titlebar1" value="1"<?php if(!empty($skin_setup['using_titlebar1'])) echo " checked"?>>번호,
<input name="using_titlebar2" type="checkbox" id="using_titlebar2" value="1"<?php if(!empty($skin_setup['using_titlebar2'])) echo " checked"?>>분류,
<input name="using_titlebar3" type="checkbox" id="using_titlebar3" value="1"<?php if(!empty($skin_setup['using_titlebar3'])) echo " checked"?> disabled>제목,
<input name="using_titlebar8" type="checkbox" id="using_titlebar8" value="1"<?php if(!empty($skin_setup['using_titlebar8'])) echo " checked"?>>파일
<input name="using_titlebar4" type="checkbox" id="using_titlebar4" value="1"<?php if(!empty($skin_setup['using_titlebar4'])) echo " checked"?>>글쓴이,
<input name="using_titlebar5" type="checkbox" id="using_titlebar5" value="1"<?php if(!empty($skin_setup['using_titlebar5'])) echo " checked"?>>등록일,
<input name="using_titlebar6" type="checkbox" id="using_titlebar6" value="1"<?php if(!empty($skin_setup['using_titlebar6'])) echo " checked"?>>추천수,
<input name="using_titlebar7" type="checkbox" id="using_titlebar7" value="1"<?php if(!empty($skin_setup['using_titlebar7'])) echo " checked"?>>조회수</td>
                  </tr>
                  <tr>
                    <td><input name="move_name" type="checkbox" id="move_name" value="1"<?php if(!empty($skin_setup['move_name'])) echo " checked"?>></td>
                    <td>글쓴이를 제목앞으로 배치 </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input name="using_shortmemo" type="checkbox" id="using_shortmemo" value="1"<?php if(!empty($skin_setup['using_shortmemo'])) echo " checked"?>></td>
                    <td colspan="2">글 목록에서 제목 아래에 글 내용 출력 (글자 수 제한:
                      <input name="smemo_maxlen" type="text" class="input" id="smemo_maxlen" value="<?=$skin_setup['smemo_maxlen']?>" size="4" maxlength="4">
      자)</td>
                    </tr>
                  <tr>
                    <td><input name="using_subjicon" type="checkbox" id="using_subjicon" value="1"<?php if(!empty($skin_setup['using_subjicon'])) echo " checked"?>></td>
                    <td colspan="2">글 목록에서 제목앞에 아이콘 사용 </td>
                  </tr>
                  <tr>
                    <td><input name="using_newicon" type="checkbox" id="using_newicon" value="1"<?php if(!empty($skin_setup['using_newicon'])) echo " checked"?>></td>
                    <td colspan="2">최근
                      <input name="using_newicon2" type="text" class="input" id="using_newicon2" value="<?=$skin_setup['using_newicon2']?>" size="2" maxlength="2">시간 안에 등록된 글의
                      제목 뒤에는 New 아이콘 사용(글 목록)</td>
                  </tr>
                  <tr>
                    <td><input name="using_shortinfo" type="checkbox" id="using_shortinfo" value="1"<?php if(!empty($skin_setup['using_shortinfo'])) echo " checked"?>></td>
                    <td colspan="2">제목 아래에 간단한 게시물 정보 출력 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;*</td>
                    <td colspan="2">글 목록의 글쓴이 공간 가로폭 : <input name="namedsp_width" type="text" class="input" id="namedsp_width" value="<?=$skin_setup['namedsp_width']?>" size="3" maxlength="3">픽셀</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top"><input name="submit2" type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
				  </div></td>
              </tr>
            </table></td>
		  </tr>

		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left" valign="top"><b>안내 멘트 </b></td>
                <td width=1 class=line2></td>
                <td width=1 class=line1></td>
                <td valign="top" style="padding:2px;">
				  <span  onClick="showhide2(this,guide)" style="cursor:pointer;padding:0 0 5px 10px;">+ 각종 안내문구의 내용 설정</span>
				  <div id=guide style='display:<?=$tabshow?>'>
				  <table width="100%"  border="0" cellpadding="3" cellspacing="0">
                  <col width="170" style="padding-top:0px">
                  <col>
				  <tr><td height=1><img src="t.gif" width=170 height=1></td><td></td>
				  </tr>
                  <tr>
                    <td colspan="2">글쓰기 안내 <br>(글쓰기 화면 상단)</td>
                    <td><textarea name="write_guide" cols="100" rows="5" wrap="VIRTUAL" class="textarea" style="width:99%"><?=trim(stripslashes($skin_setup['write_guide']))?></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2">게시물 등록 약관<br><input name="using_wAgreement" type="checkbox" id="using_wAgreement" value="1"<?php if(!empty($skin_setup['using_wAgreement'])) echo " checked"?>>사용함</td>
                    <td><textarea name="write_agreement" cols="100" rows="5" wrap="VIRTUAL" class="textarea" style="width:99%"><?=trim(stripslashes($skin_setup['write_agreement']))?></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2">코멘트 제한 안내<br>(코멘트 레벨제한시)</td>
                    <td><textarea name="comment_grant_guide" cols="100" rows="2" class="textarea" style="width:99%"><?=trim(stripslashes($skin_setup['comment_grant_guide']))?></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2">코멘트 달기 안내 </td>
                    <td><textarea name="comment_guide" cols="100" rows="2" class="textarea" style="width:99%"><?=trim(stripslashes($skin_setup['comment_guide']))?></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2">글쓰기 양식 미리 작성하기<br>(장터, Q&amp;A 게시판에 적합함) </td>
                    <td><textarea name="write_form" cols="100" rows="5" wrap="VIRTUAL" class="textarea" id="write_form" style="width:99%"><?=$skin_setup['write_form']?></textarea></td>
                  </tr>
                </table></div></td>
			  </tr>
            </table></td>
		  </tr>

		  <tr><td class="lined" style="height:1px"><img src="t.gif" height="1"></td></tr>
		  <tr>
		    <td class="han2" style="padding:10px 5px 10px 5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td width="100" align="left">&nbsp;</td>
                <td align="right" class=info_bg>
				<br><input type="submit" class="submit" value="설정 저장" style="width:100px;">&nbsp;&nbsp;<input name="cancel52" type="button" class="button" value="취소(닫기)" style="width:100px;" onClick="window.close()">&nbsp;&nbsp;&nbsp;</td>
			  </tr>
            </table></td>
		  </tr>


		  </table>
	    </td>
	  </tr>
	  <tr><td height=10></td></tr>
	</form>
	</table>

<SCRIPT LANGUAGE="JavaScript">
<!--
//폼값이 전송되기 전의 스크롤 위치로 되돌려 주는 스크립트
	function getScroll_pos() {
	 var pos = document.body.scrollTop;
	 document.config.pos.value = pos;
	}

	if(document.config.pos.value) {
		window.scrollTo(0,document.config.pos.value);
		opener.document.location.reload();
		//opener.window.history.go(0);
	}
//-->
</SCRIPT>
<?php
} //수정모드
	
// if($mode == "copy") $mode = "write";
if($mode == "write") {

	include "include/write_config.php";
	
	if(!empty($_POST['save_as'])) $save_as = 1;
	if(!empty($_POST['save_file'])) $save_file = $_POST['save_file'];
	if(!empty($save_as) && !empty($save_file)) $_SKIN_config_file = $_SKIN_config_dir."cfg_".str_replace(" ","_",$save_file).".php";

	$fp = fopen($_SKIN_config_file, "w");
	fwrite($fp, $_CONFIG_STR);
	fclose($fp);
	//chmod($_SKIN_config_file, 0707);

	//회원사진 설정 저장
	$_SKIN_config_file = $_LIBS_include_dir."member_picture_config_".$setup['group_no'].".php";
	$fp = fopen($_SKIN_config_file, "w");
	fwrite($fp, $_CONFIG_MBPIC_STR);
	fclose($fp);
	//chmod($_SKIN_config_file, 0707);

	if(!empty($_POST['board_bgColor'])) {
		@zb_query("update zetyx_admin_table set bg_color='{$_POST['board_bgColor']}' where no='$setup[no]'") or die("제로보드DB수정중 요류발생<br>게시판 배경색 설정에서 발생했습니다.");
	}
	if(!empty($_POST['thumb_vcount'])) {
		$thumb_total = $_POST['thumb_hcount']*$_POST['thumb_vcount'];
		@zb_query("update zetyx_admin_table set memo_num='$thumb_total' where no='$setup[no]'") or die("제로보드DB수정중 요류발생<br>페이지당 게시물 수 설정에서 발생했습니다.");
	}
	if(!empty($_POST['grant_html'])) {
		@zb_query("update zetyx_admin_table set grant_html='{$_POST['grant_html']}' where no='$setup[no]'") or die("제로보드DB수정중 요류발생<br>HTML사용 레벨권한 설정에서 발생했습니다.");
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=skin_config_<?=$dqrevolutionType?>.php?id=<?=$id?>&mode=modify&pos=<?=$pos?>">

<?php
}
?>

</body>
</html>
