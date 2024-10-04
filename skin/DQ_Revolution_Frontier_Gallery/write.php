<?php
// 보안검사
	if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

//스킨 환경설정 읽어옴
	include $dir."/get_config.php";
	include $dir."/".$skin_setup['language_dir']."write.php";

// 스킨 경로 환경변수 재설정
	$dir = 'skin/'.$setup['skinname'];
    $bt_imgbox  = ''; // 이미지박스 버튼 제거
    $bt_preview = ''; // 미리보기 버튼 제거

// 엔진 가져오기
	$_inclib_01 = $dir."/include/dq_thumb_engine2.";
	if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) include_once $_inclib_01.'php';
	else include_once $_inclib_01.'zend';

// 업로드제한
	if($mode!="modify") include $dir."/include/write_limit.php";

// 설정
	if($mode=="reply") $title=$_strSkin['reply'];
	elseif($mode=="modify") $title=$_strSkin['modify'];
	else $title=$_strSkin['title'];

	$a_preview = str_replace(">","><font class=eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=eng>",$a_imagebox)."&nbsp;&nbsp;";

	if(!$skin_setup['using_upload2'] && $data['file_name2']) {
		$skin_setup['using_upload2'] = "1";
		$skin_setup['upload_number'] = $skin_setup['upload_number'] -1;
	}

	$text_row_size = 13; // 내용 입력칸의 세로크기
	if(!isset($skin_setup['using_emptyArticle'])) $skin_setup['using_emptyArticle']=null;
	$chkSubmit = "revolg_check_submit('$setup[use_category]','$member[no]','$skin_setup[using_emptyArticle]')";

	if($mode == 'modify' && $notice) {
		// 공지사항 수정일때는 '장터' 기능 끔
		$skin_setup['using_market'] = 0;
        // 공지사항 수정일때는 '비밀글로만 작성' 기능 끔
		$skin_setup['using_secretonly'] = 0;
	}
	if(!empty($skin_setup['using_market']) && $mode == 'modify') {
		$objActive = " disabled";
		$market_mode = '1';
		$skin_setup['using_emptyArticle'] = '1';
		$text_row_size = 10;
	}

	if(eregi('msie',$_SERVER['HTTP_USER_AGENT'])) $ie=1; else $ie=0;
	if(!$ie) $skin_setup['using_preview_img'] = '';

    if(!empty($skin_setup['using_siteLink'])) {
      $_strSkin['memo2']   = $_strSkin['site_descript'];
      $_strSkin['subject'] = $_strSkin['site_title'];
    }

// 보안코드를 입력 받아야 할지 결정
    if($mode!='modify' && !empty($_SS['using_secretCode'])) {
      if(!$member['no']) $need_secretCode = true;
      else {
        if($_SS['using_secretCodeValue1'] && $_SS['using_secretCodeValue1'] <= $member['level']) $need_secretCode = true;
        $_totalPoint = ($member['point1']*10) + $member['point2'];
        if($_SS['using_secretCodeValue2'] && $_SS['using_secretCodeValue2'] >= $_totalPoint ) $need_secretCode = true;
      }
    }

// 미리입력된 글쓰기 양식 가져옴
	$skin_setup['write_form'] = trim($skin_setup['write_form']);
	if($mode=='write' && $skin_setup['write_form']) $memo = stripslashes($skin_setup['write_form']);

//자료실 기능을 사용할수 있을때...
	if($setup['use_pds'] && $mode!='reply') {
		$start_image = 2;
		if($skin_setup['using_upload2']) $start_image++;
		$total_image = 0;
		$max_image = intval($skin_setup['upload_number']) + ($start_image-1);

		//$using_preview_img = $skin_setup['using_preview_img'] ? 1 : 0;
		$file_colspan = 2;

		//업로드파일 설명 가져옴
		$file_descript = ($mode=='modify')? get_fileDescript($id, $no) : '';

        //업로드 확장기에 의한 파일목록 가져옴
		unset($m_data);
		if($mode == "modify") {
            if(chk_table_name('zetyx_upload')) {
                $tMutiupload = mysql_fetch_array(zb_query("select sfilename from zetyx_upload where sid='$id' and sno='$data[no]' order by no asc limit 0,1"));
            }
            if(!empty($tMutiupload['sfilename'])) {
                $t_result = zb_query("select * from zetyx_upload where sid='{$id}' and sno='{$no}' order by no asc");
                while($tm_data = mysql_fetch_array($t_result)) {
                    $tmp_ttrFiles        .= "data/mutiupload/{$id}/".$tm_data['sfilename'].',';
                    $tmp_sttrFiles       .= $tm_data['sfileorgname'].',';
                }
            }

            $m_data=mysql_fetch_array(zb_query("select * from dq_revolution where  zb_id='$id' and zb_no='$no'"));
            if(!empty($tmp_ttrFiles)) {
              $m_data['file_names'] = $tmp_ttrFiles . $m_data['file_names'];
              $m_data['s_file_names'] = $tmp_sttrFiles . $m_data['s_file_names'];
            }

			// 가상 삭제기능
			if(!empty($m_data['is_vdel']) && $is_admin) $is_vdel = 'checked';
			if(!$is_admin) $is_vdel = $m_data['is_vdel'];

			if(!empty($m_data['file_names'])) {
				$tmp_files = explode(",",$m_data['file_names']);
				$tmp_sfiles = explode(",",$m_data['s_file_names']);
				for($i=0; $i<=99; $i++) {
					if($tmp_files[$i]) {
						$images[$i] = $tmp_files[$i];
						$s_images[$i] = $tmp_sfiles[$i];
						$count++;
						$max_files = $i+1 ;
					}
				}
				$old_start = $start_image;
				if($count) {
					$total_image = $max_files;
				}
                unset($count);
			}
		}

		if($skin_setup['using_upload2'] || $skin_setup['upload_number'] || count($images) > 1) $once_upload = "1";

      // 업로드파일 목록을 SWFUpload 용도로 변환
	  if(!isset($file_realName)) $file_realName='';
	  if(!isset($file_virtName)) $file_virtName='';
	  if(!isset($m_data['file_descript'])) $m_data['file_descript']='';
	  if(!isset($m_data['s_file_names'])) $m_data['s_file_names']='';
        if(!empty($data['file_name2'])) {
          $num  = $data['file_name1'] ? 1 : 0;
          $file = 'revol_getimg.php?id='.$id.'&no='.$no.'&num='.$num.'&fc='.md5($data['file_name1']);
          $file_virtName = $file_virtName ? $file.','.$file_virtName : $file;
          $file_realName = $file_realName ? $data['s_file_name2'].','.$file_realName : $data['s_file_name2'];
		  $count = !empty($count)? $count : 0;
          $count++;
        }
        if(!empty($data['file_name1'])) {
          $file = 'revol_getimg.php?id='.$id.'&no='.$no.'&num=0&fc='.md5($data['file_name1']);
          $file_virtName = $file_virtName ? $file.','.$file_virtName : $file;
          $file_realName = $file_realName ? $data['s_file_name1'].','.$file_realName : $data['s_file_name1'];
		  $count = !empty($count)? $count : 0;
          $count++;
        }
		
		if(!isset($m_data['file_names'])) $m_data['file_names']='';
        $tmp = explode(',',$m_data['file_names']);
        $len = count($tmp);
        $count = !empty($count)? $count : 0;
        for($i=0; $i<$len; $i++) {
          if($tmp[$i]) {
            $tmp[$i] = 'revol_getimg.php?id='.$id.'&no='.$no.'&num='.$count.'&fc='.md5($tmp[$i]);
            $count++;
          }
        }
        $m_data['file_names'] = implode(',',$tmp);

        if($count && $m_data['file_names']) $file_virtName .= ','; $file_realName .= ',';
        $file_descript = str_replace('[use]','',$m_data['file_descript']);
        $file_virtName .= $m_data['file_names'];
        $file_realName .= $m_data['s_file_names'];
        $file_virtName = ereg_replace(",+$",'',$file_virtName);
        $file_realName = ereg_replace(",+$",'',$file_realName);
    }

// 스킨 설정에 따라 제목과 내용 타이틀의 굵기 결정
	if(!empty($once_upload)) $memo_text1 = $_strSkin['memo1']; else $memo_text1 = $_strSkin['memo2'];
	if(!$skin_setup['using_emptyArticle']) {
		$memo_text = '<b>'.$memo_text1.'</b>';
		$subject_text = '<b>'.$_strSkin['subject'].'</b>';
	} else {
		$memo_text = $memo_text1;
		$subject_text = $_strSkin['subject'];
	}
	
	if(eregi("msie",getenv("HTTP_USER_AGENT"))) $cols_size=50*0.6; else $cols_size=50;
	if(!isset($market_mode)) $market_mode=0;
?>

<?php if(!empty($skin_setup['using_weditor']) && !empty($skin_setup['WEditor_dir'])) { ?>
<script type="text/JavaScript" src="<?=$skin_setup['WEditor_dir']?>fckeditor.js" charset="UTF-8"></script>
<?php } ?>
<script src="<?=$dir?>/write.js" type="text/JavaScript"></script>
<script src="<?=$dir?>/lib.js" type="text/JavaScript"></script>
<script type="text/JavaScript">
    var cols_size   = <?=$cols_size?>;
    var _leftframe_width = "<?=$_leftframe_width?>";
    var market_mode = "<?=$market_mode?>";
    <?php if(!empty($skin_setup['using_wAgreement'])) echo "var using_wAgreement = 1;\n"; else echo "var using_wAgreement = 0;\n";?>
</script>
<?php
	require 'setup.js.php';
?>
<form method="post" name="zbform" id="zbform" action="revol_write_ok.php" onsubmit="return <?=$chkSubmit?>" enctype="multipart/form-data" style="display:inline;ime-mode:active">
<table border="0" width="<?=$width?>" cellspacing="0" cellpadding="0" class="info_bg">
<tr><td colspan="2">
	<table border="0" width="100%" cellspacing="2" cellpadding="0" style="table-layout:fixed">
     <input type="hidden" name="file_virtName" value="<?=$file_virtName?>" />
     <input type="hidden" name="file_realName" value="<?=$file_realName?>" />
     <input type="hidden" name="file_descript" value="<?=$file_descript?>" />
	 <input type="hidden" name="page" value="<?=$page?>" />
	 <input type="hidden" name="id" value="<?=$id?>" />
	 <input type="hidden" name="no" value="<?=$no?>" />
	 <input type="hidden" name="select_arrange" value="<?=$select_arrange?>" />
	 <input type="hidden" name="desc" value="<?=$desc?>" />
	 <input type="hidden" name="page" value="<?=$page?>" />
	 <input type="hidden" name="page_num" value="<?=$page_num?>" />
	 <input type="hidden" name="keyword" value="<?=$keyword?>" />
	 <input type="hidden" name="category" value="<?=$category?>" />
	 <input type="hidden" name="sn" value="<?=$sn?>" />
	 <input type="hidden" name="ss" value="<?=$ss?>" />
	 <input type="hidden" name="sc" value="<?=$sc?>" />
	 <input type="hidden" name="su value="<?=$su?>" />
	 <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
     <input type="hidden" name="uniqNo" value="<?=$uniqNo=$member['no']?$member['no']:uniqid(rand())?>" />
     <?php if($mode=="modify" && !$is_admin) draw_is_vdel(2,$is_vdel,$_strSkin)?>
<?php if(!empty($skin_setup['using_secretonly'])){
  echo "<script type=\"text/javascript\">var using_secretonly = 1;</script>\n";
  echo "<input type=\"hidden\" name=\"is_secret\" value=\"1\">\n";
} else echo "<script>var using_secretonly = 0;</script>\n";?>
	<tr><td colspan="2" height="8px"></td></tr>
	<tr>
		<td align="left" colspan="2" style="padding-left:20px">
			<b class="wArticle"><?=$title?></b>
		</td>
	</tr>
	<?php if($skin_setup['write_guide']){?>
	<tr>
		<td align="left" colspan="2" class="han" style="padding:5px 5px 10px 35px;line-height:160%;"><?=stripslashes($skin_setup['write_guide'])?>&nbsp;</td>
	</tr>
	<tr><td colspan="2" class="lined"></td></tr>
	<?php }?>
    </table>
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="table-layout:fixed">
	<col width="<?=$_leftframe_width?>px"></col><col align="left"></col>
	<?=$hide_start?>
	<tr><td colspan="2" style="height:15px"></td></tr>
	<tr>
	  <td width="<?=$_leftframe_width?>px" align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['password']?></font></td>
	  <td  align="left" style="padding-bottom:5px"><input type="password" name="password" <?=size(20)?> maxlength="20" class="input2"></td>
	</tr>

	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['name']?></font></td>
	  <td  align="left" style="padding-bottom:5px"><input type="text" name="name" value="<?=$name?>" <?=size(20)?> maxlength="20" class="input2"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['email']?></font></td>
	  <td  align="left" style="padding-bottom:5px"><input type="text" name="email" value="<?=$email?>" <?=size(40)?> maxlength="200" class="input2"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>

	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['homepage']?></font></td>
	  <td align="left"><input type="text" name="homepage" value="<?=$homepage?>" <?=size(40)?> maxlength="200" class="input2"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>
    <?=$hide_end?>

	<tr><td colspan="2" style="height:15px"></td></tr>
	<tr>
	  <td width="<?=$_leftframe_width?>px" align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['option']?></font></td>
	  <td class="han" align="left">
		   <?=str_replace('<option>Category</option>','<option>'.$_strSkin['category'].'</option>',$category_kind)?>
		   <?=$hide_notice_start?> <input type="checkbox" name="notice" <?=$notice?> value="1"><?=$_strSkin['use_notice']?><?=$hide_notice_end?>
		   <?=$hide_html_start?> <input type="checkbox" name="use_html" id="use_html" <?=$use_html?> value="1"><?=$_strSkin['use_html']?><?=$hide_html_end?>
		   <?php if(empty($skin_setup['using_secretonly']) && $setup['use_secret']){?><input type="checkbox" name="is_secret" <?=$secret?> value="1"<?php if(!empty($_SS['inputPWD_mbSecretArticle']) && $member['no']) {?> onclick="toggle_mbPasswd()"<?php }?>><?=$_strSkin['use_secret']?><?php }?>
		   <?php if($mode=="modify" && $is_admin) draw_is_vdel(1,!empty($is_vdel)?$is_vdel:'',$_strSkin)?>
	  </td>
	</tr>
	</table>
	<!--
<?php if($dqrevolutionType == "Gallery" && $setup['use_pds']) include $dir."/plug-ins/swfupload/swfupload.php" ?>
-->
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="table-layout:fixed">
	<col width="<?=$_leftframe_width?>px"></col><col align="left"></col>
	<tr><td colspan="2" style="height:15px"></td></tr>
	<?php if(!empty($_SS['inputPWD_mbSecretArticle']) && $member['no']) { ?>
	<tr id="mbPassword" style="<?php if(!$data['is_secret']) echo 'display:none;'?>padding-bottom:10px">
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['password']?></font></td>
	  <td><input type="password" name="password" size="20" maxlength="20" class="input2"></td>
	</tr>
	<?php } ?>
	<?php if(!empty($_SS['using_viewer_level'])) { ?>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['viewer_level']?></font></td>
	  <td style="padding-right:10px">
        <select name="viewer_level" id="viewer_level">
        <?php
        $viewer_level = get_StrValue($sitelink2,2);
        for($i=$setup['grant_view']; $i > 0; $i--) {
          $select = $viewer_level == $i ? ' selected' : ''; 
          echo '<option value="'.$i.'"'.$select.'>'.$i.'</option>'."\n";
        }
        ?>
        </select>
        <?=$_strSkin['viewer_level2']?>
      </td>
	</tr>
	<tr><td colspan="2" style="height:10px"></td></tr>
	<?php } ?>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$subject_text?></font></td>
	  <td style="padding-right:10px"><input type="text" name="subject" value="<?=$subject?>" <?=size(60)?> maxlength="200" style="width:99%" class="input2"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>
	<tr><td colspan="2" style="height:10px"></td></tr>
	<?=$hide_sitelink1_start?>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['bgm']?></font></td>
	  <td class="han" style="padding-right:10px"><input type="text" name="sitelink1" value="<?=str_replace("\"","&quot;",$sitelink1)?>" <?=size(62)?> maxlength="200" class="input2" style="width:99%"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td class="han" align="left" height="20"><?=str_replace('[host_url]','http://'.getenv('HTTP_HOST').'/music.wma',$_strSkin['guide_bgm'])?></td>
	</tr>
	<?=$hide_sitelink1_end?>
	<?=$hide_sitelink2_start?>
    <?php if(!empty($skin_setup['using_siteLink'])) {?>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['site_url']?></font></td>
	  <td class="han" style="padding-right:10px"><input type="text" name="sitelink2" value="<?=get_StrValue($sitelink2,0)?>" <?=size(62)?> maxlength="200" class="input2" style="width:99%"<?=!empty($objActive)?$objActive:''?>></td>
	</tr>
    <?php } ?>
	<?=$hide_sitelink2_end?>

	<?php if(!empty($skin_setup['using_weditor']) && $skin_setup['WEditor_dir']) {?><tr><td></td><td id="write_options" align="left"><br/><input type="checkbox" name="use_weditor" id="use_weditor" value="1" onClick="wEditorCall()"><?=$_strSkin['use_weditor']?></td></tr><?php } ?>

	<tr>
	  <td align="right" style="padding-top:12px;padding-right:10px" valign="top">
	    <font class="han"><?=$memo_text?></font>
		<?php if(empty($market_mode)) {?><br><br><br>
		<span id="eMemo_controller">
		<font class="taSizeBT" onclick="document.zbform.memo.rows=<?=$text_row_size?>;document.zbform.memo.focus();" title="<?=$_strSkin['org_memo']?>">-</font><br>
		<font class="taSizeBT" onclick="document.zbform.memo.rows=document.zbform.memo.rows+4;document.zbform.memo.focus();" title="<?=$_strSkin['exp_memo']?>">+</font>
		</span>
		<?php } ?>
	  </td>
	  <td style="padding:8px 10px 8px 0" id="editor_area"><textarea name="memo" id="memo" <?=size2(90)?> rows="<?=$text_row_size?>" class="textarea" style="width:98%;line-height:180%"<?=!empty($objActive)?$objActive:''?>><?php 
		if(!empty($market_mode) || (!empty($data['use_html']) && $data['use_html'] != 2) || $memo == strip_tags($memo) || ((!empty($data['use_html']) && $data['use_html'] == 2) && (empty($skin_setup['using_weditor']) || empty($skin_setup['WEditor_dir'])))) echo $memo;
	  ?></textarea></td>
	</tr>

<?php if(!empty($market_mode)) {?>
	<tr>
	  <td align="right" style="padding-top:12px;padding-right:10px;" valign="top">
	    <b class="han"><?=$_strSkin['marketModeMemo2']?></b>
		<br><br><br>
		<span id="eMemo_controller">
		<font class="taSizeBT" onclick="document.zbform.memo2.rows=<?=$text_row_size?>;document.zbform.memo2.focus();" title="<?=$_strSkin['org_memo']?>">-</font><br>
		<font class="taSizeBT" onclick="document.zbform.memo2.rows=document.zbform.memo2.rows+4;document.zbform.memo2.focus();" title="<?=$_strSkin['exp_memo']?>">+</font>
		</span>
	  </td>
	  <td style="padding:8px 10px 8px 0" id="editor_area">
		  <textarea name="memo2" id="memo2" <?=size2(90)?> rows="<?=($text_row_size)?>" class="textarea" style="width:98%"></textarea>
	  </td>
	</tr>
<?php } ?>

	<tr>
	  <td>&nbsp;</td>
	  <td class="han" align="left">
          <input type="checkbox" name="reply_mail" <?=$reply_mail?> value="1"><?=$_strSkin['use_reply']?>
	  </td>
	</tr>
	<?php
	 // 게시물 등록약관 동의
	  if(!empty($skin_setup['using_wAgreement'])) {?>
  	  <tr><td colspan="2" style="height:15px"></td></tr>
	  <tr><td colspan="2" class="separator1" height="1"></td></tr>
	  <tr>
	    <td class="han" style="padding:10px">&nbsp;</td>
		<td class="han" style="padding:10px;line-height:160%"><?=stripslashes($skin_setup['write_agreement'])?><?=draw_wAgreement(1)?></td>
	  </tr>
	  <?php }?>
	</table>
	<?=$hide_pds_start?>
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="table-layout:fixed">
	<col width="<?=$_leftframe_width?>px"></col><col align="left"></col>
	<tr><td colspan="2" style="height:15px"></td></tr>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['file']?>1</font></td>
	  <td class="han" style="padding-right:10px"><input type=file name=file1 <?=size(50)?> maxlength=255 class=input></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td class="han" align="left" height="20"><?=!empty($file_name1)?str_replace("<br>","",$file_name1):''?></td>
	</tr>
	<tr>
	  <td align="right" style="padding-right:10px;"><font class="han"><?=$_strSkin['file']?>2</font></td>
	  <td class="han" style="padding-right:10px"><input type=file name=file2 <?=size(50)?> maxlength=255 class=input></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td class="han" align="left" height="20"><?=!empty($file_name2)?str_replace("<br>","",$file_name2):''?></td>
	</tr>
	</table>
	<?=$hide_pds_end?>
	<!--
<?php if($dqrevolutionType == "BBS" && $setup['use_pds']) include $dir."/plug-ins/swfupload/swfupload.php" ?>
-->
    <?php if(!empty($need_secretCode)){?>
    <div id="need_secretCode">
        <div style="background-color:#505050;color:#DDD;padding:10px;font-weight:bold"><?=$_strSkin['inputSecretCode']?></div>
        <div align="center" style="margin:10px 0 10px 0">
          <img src="<?=$dir?>/plug-ins/kcaptcha/?<?=session_name()?>=<?=session_id()?>&uniqNo=<?=$uniqNo?>" />
        </div>
        <div><?=$_strSkin['secretCodeNotice']?></div>
        <div style="padding-top:5px" align="center">
          <div style="width:100px;padding:5px;border:2px solid #707070;background-color:#FFF">
            <input type="text" name="secret_code" size="12" style="border:0;background-color:#FFF;color:#000;text-align:center;font-weight:bold;" />
          </div>
          <div style="margin-top:10px;border-top:2px solid #b0b0b0;padding-top:5px"><input type="submit" value="확인" style="padding:5px" /></div>
        </div>
    </div>
    <?php }?>

	<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
	<tr><td colspan="3" style="height:15px"></td></tr>
	<tr><td colspan="3" class="lined"></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<tr>
	  <td style="padding-left:38px" align="left"><?php if(empty($skin_setup['using_weditor'])){?><?=$bt_preview?><?=$bt_imgbox?><?php }?></td>
	  <td align="right" valign="bottom" width="20">
		<?php if(!eregi("\.gif",$_strSkin['write_ok'])){?><input type="submit" value="<?=$_strSkin['write_ok']?>" class="submit_w" accesskey="s" onClick="javascript:document.zbform.action='revol_write_ok.php'">
		<?php } else {?><input type="image" src="<?=$_strSkin['write_ok']?>" accesskey="s" onClick="javascript:document.zbform.action='revol_write_ok.php'"><?php } ?>
	  </td>
	  <td align="right" valign="bottom" width="20" style="padding: 0 10px 0 10px">
		<?php if(!eregi('.gif',$_strSkin['cancel'])){?><input type="button" value="<?=$_strSkin['cancel']?>" class="button" onclick="history.back()">
		<?php } else {?><img src="<?=$_strSkin['cancel']?>" onclick="history.back()" onFocus="blur()" style="cursor:pointer"><?php } ?>
	  </td>
	</tr>
	</table>
	</form>
	<br>
</td></tr></table>

<?php if(!empty($tMutiupload['sfilename'])) { ?>
  <script type="text/javascript">
    ret = confirm('타 스킨에서 작성된 멀티업로드 데이터가 포함된 게시물입니다.\n\n이 게시물을 수정하면 예전 스킨의 데이터가 지금 스킨의 데이터로 변환 저장되어 예전 스킨에서는 사용할 수 없게 됩니다.\n\n그래도 계속 하시겠습니까?');
    if(!ret) window.history.go(-1);
  </script>
<?php } ?>

<?php if(!empty($skin_setup['using_weditor']) && !empty($skin_setup['WEditor_dir'])) {?>
<script type="text/javascript">
  if(!market_mode) var memo = document.getElementById('memo');
  else var memo = document.getElementById('memo2');
  var edCheck = document.getElementById('use_weditor');
  var htCheck = document.getElementById('use_html');

  if(htCheck && htCheck.value==2 && memo.value=='') 
  {
      edCheck.checked = true;
	  if(!market_mode) strOriginalMemo = "<? if($data['use_html'] == 2 || $memo <> strip_tags($memo)) echo addSlashes4JSw($memo) ?>";
      wEditorCall();
  }
<?php if($skin_setup['using_weDefault']) {?>
  if(edCheck.checked == false) 
  {
      edCheck.checked = true;
      wEditorCall();
  }
<?php }?>
</script>
<?php } 

function addSlashes4JSw($str) 
{
	//$str = htmlSpecialChars($str,ENT_QUOTES);
	$str = addslashes($str);
//	$str = nl2br($str);
	$str = str_replace("\r","",$str);
	$str = str_replace("\n","",$str);
	return $str;
}
?>