<?php
	if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

	$view_once = true;

	require $dir."/".$_SS['language_dir']."view.php";

// 회원레벨 검사(게시물 개별 설정)
    if(!empty($_SS['using_viewer_level']) && get_StrValue($data['sitelink2'],2) && get_StrValue($data['sitelink2'],2) < $member['level'])
        error($_strSkin['viewer_lvAlert']);

// 설정
	$_zbResizeCheck = false; // 제로보드의 리사이즈 기능을 끔
	$use_alllist = &$setup['use_alllist'];
	if (!$use_alllist) $_zb_exec="view.php"; else $_zb_exec="zboard.php";
	$strShowIP = ereg_replace("(.*\.)(.*\.)(.*\.)(.*)","\\1\\2*.\\4",$data['ip']);

	// 검색어가 있을경우 내용의 키워드를 변경
	if($sc=="on" && $keyword) {
		$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
		$data['memo'] = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $data['memo']);
	}

	if(!$skin_setup['pic_width']) $skin_setup['pic_width'] = $width;
	elseif($skin_setup['pic_width'] <= 100) $skin_setup['pic_width'] .= '%';
	elseif(!eregi("px",$skin_setup['pic_width'])) $skin_setup['pic_width'] .= 'px';

	if(!$skin_setup['memo_width']) $skin_setup['memo_width'] = 'auto';
	elseif($skin_setup['memo_width'] <= 100) $skin_setup['memo_width'] .= '%';
	else $skin_setup['memo_width'] .= 'px';
	$skin_setup['mpic_border_width'] = isset($skin_setup['mpic_border_width'])? $skin_setup['mpic_border_width'] : 5;

	$onImageNavigator = !empty($skin_setup['using_imageNavi']) ? true : false;

	if(!$face_image) $face_image = str_replace('<div align=left>','',$face_image);
	$this_name = $face_image.str_replace('>'.$data['name'],'><font class=view_name>'.$data['name'].'</font>',$name).'</b>';
	$this_name = "<span title=\"$ip\">$this_name</span>";
	if($homepage) $homepage = ' * '.str_replace('_blank>','_blank><font class="eng">',str_replace('</a>','</font></a>',$homepage));
	if(!empty($skin_setup['using_market']) && !$is_admin) $bt_delete = '';

	$bt_delete = isset($bt_delete) ? str_replace('delete.php','revol_delete.php',$bt_delete) : '';

	if(empty($skin_setup['member_picture_x']) && empty($skin_setup['member_picture_y'])) $_mb_picture_share = '1';
	if(!empty($_mb_picture_share)) $c_picWidth = $c_picWidth = 100; else $c_picWidth = $skin_setup['member_picture_x'];

	$data['memo'] = autolink($data['memo']);

// 코멘트관련 날짜 검사
	if(!empty($skin_setup['using_limitComment']) && !empty($skin_setup['using_limitComment2'])) {
		$limitday = $skin_setup['using_limitComment2'];
		$time_count = time()-(60*60*24*$limitday);
		if(date('Ymd',$data['reg_date']) < date('Ymd',$time_count)) {
			$limitCommentOFF = 1;
			$comment_grant_element[] = $limitday.'일 이상 지난 게시물';
			$bt_vote = ''; //추천버튼 제거
		}
	}

// 강화된 추천시 일반추천 버튼 제거
	if($skin_setup['vote_type'] == "2") $bt_vote = '';

// 코멘트 관련 설정
	if($member['level'] > $setup['grant_comment']) $comment_grant_element[] = '권한이 없는 회원레벨';
	//if(!$member[no] && $setup['grant_comment'] < 10) $comment_grant_element[] = '비회원';
	if(!empty($skin_setup['using_cmOwnerOnly']) && !$is_admin && $data['ismember'] && $member['no'] != $data['ismember']) {
			$limitCommentOFF = 1;
			$comment_grant_element[] = '게시물 작성자 혹은 관리자가 아님';
	}		

// 추천 날짜 검사
	if(!empty($skin_setup['poll_day'])) {
		$start_day = mktime(0 ,0 ,0 ,$skin_setup['poll_day2'],$skin_setup['poll_day3'],$skin_setup['poll_day1']);
		$end_day   = mktime(23,59,59,$skin_setup['poll_day5'],$skin_setup['poll_day6'],$skin_setup['poll_day4']);
		if(time() < $start_day || time() > $end_day) {
			$skin_setup['using_vote'] = '';
			$bt_vote = ''; //추천버튼 제거
		}
	}

// 본문 좌,우측 여백지정 변수를 짧게 줄임
	$_lSwidth = &$skin_setup['view_lSwidth'];
	$_rSwidth = &$skin_setup['view_rSwidth'];

// 이미지 하단 여백
    $img_vspace   = &$skin_setup['pic_vSpace'];

// 이미지태그 가져오기
	if(eregi("<img |\[img ", $data['memo'])) $_linkImage = get_imgTag($data['memo'],$data['ismember'], 99);

// 이전글과 이후글의 데이타를 구함;
//	if(!$setup['use_alllist'] && $desc != "desc") $enable_pn_list=true; else $enable_pn_list=false;
//	if($select_arrange && $select_arrange!="headnum") $enable_pn_list=false;
	$enable_pn_list = true;	
    if($select_arrange=='modify_date') 
    {
        if($_GET['prev']) {
    		$prev_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$_GET[prev]'"));
        } else {
    		$prev_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id where modify_date > '$data[modify_date]' order by modify_date asc limit 0,1"));
        }
        if($_GET['next']) {
    		$next_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$_GET[next]'"));
        } else {
    		$next_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id where modify_date < '$data[modify_date]' order by modify_date desc limit 0,1"));
        }
		$data['prev_no'] = ($prev_data['no'] ? $prev_data['no'] : '');
		$data['next_no'] = ($next_data['no'] ? $next_data['no'] : '');
		if($dqrevolutionType = 'Gallery') {
			$bt_vprev = ereg_replace("(.*)(&no=[0-9]*)(.*)","\\1&no=$data[prev_no]\\3",$bt_vprev);
			$bt_vnext = ereg_replace("(.*)(&no=[0-9]*)(.*)","\\1&no=$data[next_no]\\3",$bt_vnext);
		}
	} 
    elseif ($enable_pn_list || (!$data['prev_no'] || !$data['next_no'])) 
    {
        $sque = !empty($s_que) ? $s_que.' and' : 'where';
		$prev_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id $sque no > '$data[no]' order by no asc limit 0,1"));
		$data['prev_no'] = (!empty($prev_data['no']) ? $prev_data['no'] : '');
		$next_data=@mysql_fetch_array(zb_query("select * from $t_board"."_$id $sque no < '$data[no]' order by no desc limit 0,1"));
		$data['next_no'] = (!empty($next_data['no']) ? $next_data['no'] : '');
		if($dqrevolutionType = 'Gallery') {
			$bt_vprev = ereg_replace("(.*)(&no=[0-9]*)(.*)","\\1&no=$data[prev_no]\\3",$bt_vprev);
			$bt_vnext = ereg_replace("(.*)(&no=[0-9]*)(.*)","\\1&no=$data[next_no]\\3",$bt_vnext);
		}
	}

// 추천인 목록 가져오기
	$vote_users = get_voteUsers($id,$no,1);

// 제목 아래의 여백 계산
	$_subject_vSpace = $skin_setup['pic_vSpace'] ? intval($skin_setup['pic_vSpace']) : '20';

// 게시물 정보 출력(상단)	
	if($skin_setup['using_bmode']) include $dir."/include/view_bmode.php";

// 업로드된 이미지 목록을 배열로 저장
    $_SS['linkFilesRemove'] = 2;
	$tmp = get_uploadImages($data,999,1);
    $_SS['linkFilesRemove'] = 0;
	$is_vdel = $tmp['is_vdel'];
	if($is_admin || !$is_vdel) {
		$images			= $tmp[0];
		$s_images		= $tmp[1];
		$images_size	= $tmp[2];
		$images_count	= $tmp[3];
        if($tmp[4] >= $_SS['slide_album_mode_value0'] && $_SS['slide_album_mode']) {
          $realImg_count = 1;
          $orgImg_count  = $tmp[4];
          $_SS['slide_album_mode_on'] = true;
        } else {
          $realImg_count = is_array($images) ? count($images) : 0;
        }
	}
	$_chk_uploadImages = true;

// 가상으로 삭제되었을 경우
	if($is_vdel) {
		$new_memo = "<br><br>----- 관리자에 의해 삭제된 게시물입니다.-----<br><br>";
		$new_memo = "<div>".$new_memo."</div>";
		if($is_admin) $data['memo'] = $data['memo'];
		else $data['memo'] = &$new_memo;
	}

// 업로드파일 설명 가져옴
	if($realImg_count) $file_descript = get_fileDescript($id, $no);

// 네비게이션 링크 생성
	//뒤집기
	if(($select_arrange!='headnum' && $desc == 'asc') || ($select_arrange=='headnum' && $desc == 'desc')) {
		$tmp  = $data['prev_no'];
		$tmpd = $prev_data;
		$data['prev_no'] = $data['next_no'];
		$data['next_no'] = $tmp;
		$prev_data       = $next_data;
		$next_data       = $tmpd;
	}
	$go_prev = $data['prev_no'] ? $target.'?'.$href.$sort.'&no='.$data['prev_no'] : '';
	$go_next = $data['next_no'] ? $target.'?'.$href.$sort.'&no='.$data['next_no'] : '';
	$go_list = 'zboard.php?'.$href.$sort;

// 보안코드 관련
    $uniqNo = $member['no'] ? $member['no'] : uniqid(rand());
?>
<script type="text/JavaScript">
    var resize_widthOnly = "<?=!empty($_SS['resize_widthOnly']) ? '1' : '0'?>";
    var uniqNo  = "<?=$uniqNo?>";
	var go_prev = "<?=$go_prev?>";
	var go_next = "<?=$go_next?>";
	var go_list = "<?=$go_list?>";
	var imageNavigatorOn = <?php echo $onImageNavigator ? 'true':'false' ?>;
<?php if(($member['no'] && $data['ismember'] == $member['no']) || $member['level'] < $_SS['mrbt_passLevel']) { ?>
    rv.using_pixelLimit = false;
<?php } ?>
    rv.zbViewMode = true;
<?php if(!empty($_SS['slide_album_mode_on']) && !empty($_SS['slide_album_mode_value3'])) {?>
    function runAutoSlideShow() {
      if(!rv.firefox) setTimeout(function(){
        if(document.readyState == 'complete' && typeof(slideThumb0) == 'object' ) {
          if(rv.ie) hs.fireEvent(slideThumb0,'click');
          else hs.fireEvent(slideThumb0,'onclick');
        }
        else runAutoSlideShow();
      },500);
      if(rv.firefox) window.load = setTimeout(function(){
        var slideObject = document.getElementById('slideThumb0');
        if(slideObject && typeof(slideObject) == 'object') hs.fireEvent(slideObject,'onclick');
        else runAutoSlideShow();
      },500);
    }
    runAutoSlideShow();
<?php }?>
</script>
<?php if($skin_setup['using_comment']) {?>
<script type="text/javascript" src="<?=$dir?>/comment_editor.js"></script>
<?php }?>

<div id="dqResizedvImg_tools" class="imageToolbox" align="right" onmouseover="imgToolboxOn(event)">
<img src="<?=$dir?>/plug-ins/highslide/graphics/fullexpand.gif" border="0" title="크게 보기" onclick="callLightbox(this.parentNode.fullSizeImage.id)" />
</div>

<?php if (!empty($skin_setup['show_subj']) && $data['subject'] != ".") {
	if(!$images && empty($_linkImage[0])) $skin_setup['pic_align'] = 'left'; 
?>
<table border="0" cellspacing="0" cellpadding="0" width="<?=$skin_setup['pic_width']?>" class="pic_bg" style="padding-top:15px">
<tr>
	<td align="<?=$skin_setup['pic_align']?>">
		<span class="view_title"><?=$subject?></span>
	</td>
</tr>
</table>
<?php }?>

<table border="0" cellspacing="0" cellpadding="0" width="<?=$skin_setup['pic_width']?>" class="pic_bg" id="pic_top">
<tr>
<td align="<?=$skin_setup['pic_align']?>">
<div style="height:<?=$_subject_vSpace?>px;font-size:0px" class="pic_bg">
<?php
// 사진보기 효과음(책넘김음:book_sound.swf, 셔터음:camera_sound.swf)
	if(!empty($skin_setup['using_shutter'])) mmplay($dir."/book_sound.swf",'shutter',1);

// 배경음악 재생
	$tmp = '1';
	if(!empty($skin_setup['bgmPlayerLevel']) && ($skin_setup['bgmPlayerLevel'] < $member['level'] || !$member['no'])) $tmp = '0';
	if(is_mediafile($data['sitelink1']) && $tmp) mmplay($data['sitelink1'],"mmp");
	else $skin_setup['using_bgmPlayer'] = '';
?>
</div>
<?php if($is_admin && $is_vdel) {?>
<div style="padding:15px <?=$_rSwidth?>px 20px <?=$_lSwidth?>px;" align="<?=$skin_setup['pic_align']?>" class="han2">
	----- 관리자에 의해 삭제된 게시물입니다. 아래 내용은 관리자에게만 보입니다. ----
</div>
<?php }?>

<?php
// 슬라이드쇼 썸네일 출력
  $is1stThumbOnly = get_StrValue($data['sitelink2'],1);

  if(!empty($_SS['slide_album_mode_on'])) 
  {
    $slide_imgHeight = 0;
    echo '<table cellpadding="0" cellspacing="0"><tr><td align="left">';
    echo '<div style="margin:0 '.$_rSwidth.'px 0 '.$_lSwidth.'px">';

    for($i=0; $i<count($images); $i++) 
    {
      $call_jsOrgImg = '';
      $img_info = @getimagesize($images[$i]);

      if($skin_setup['using_autoResize'] && ($img_info[0]>$_SS['pic_overLimit1'] || $img_info[1]>$_SS['pic_overLimit1'])) {
        $cal_size = cal_thumb_size($images[$i],$_SS['pic_overLimit2'],$_SS['pic_overLimit2']);
        if($cal_size[1] > $slide_imgHeight) $slide_imgHeight = $cal_size[1];
        $call_jsOrgImg = "view_orgimg(this,".$cal_size[0].",".$cal_size[1].")";
      } else {
        $cal_size[0] = 0; $cal_size[1] = 0;
        if($img_info[1] > $slide_imgHeight) $slide_imgHeight = $img_info[1];
        $call_jsOrgImg = "view_orgimg(this,".$img_info[0].",".$img_info[1].")";
      }
      if(!($img_info[2] == 1 || $img_info[2] == 2 || $img_info[2] == 3 || $img_info[2] == 6)) continue;

      $thi = $is1stThumbOnly ? $i+1 : $i; // 첫 번째 파일이 썸네일 전용이면 건너뜀
      $thumbnail_url = $dir.'/thumbnail.php?id='.$id.'&no='.$no.'&num='.$thi.'&fc='.md5($images[$i]).'&s='.$_SS['slide_album_mode_value2'];
      $fullimg_url   = 'revol_getimg.php?id='.$id.'&no='.$no.'&num='.$thi.'&fc='.md5($images[$i]);

      $captionText = $file_descript[$i] ? ',captionText:\''.addSlashes4JS($file_descript[$i]).'\'' : '';
      $str_callLightbox = ' onclick="hs.allowSizeReduction=1;return hs.expand(this,{slideshowGroup:\'000\''.$captionText.'})"';
      echo '<a id="slideThumb'.$i.'" href="'.$fullimg_url.'" style="float:left"'.$str_callLightbox.'><img src="'.$thumbnail_url.'" onmouseover="'.$call_jsOrgImg.'" class="slide_thumb_img" /></a>';
    }

    echo '</td></tr></table>';
    echo '</div>';
    echo '<div style="clear:both; height:'.$img_vspace.'px"></div>';
    echo '<script type="text/javascript">hs.addSlideshow_dq("000")</script>';

    $slide_imgHeight = 'height="'.($slide_imgHeight+4).'px" ';

    unset($file_descript); // 사진설명 제거
    if($orgImg_count > $_SS['slide_album_mode_value1']) $slideview_only = true;
  }
?>

<?php
// 이미지 출력
if(!empty($images) && empty($slideview_only) && ($is_admin || !$is_vdel))
{ 
	$count=0;
    //태그 가져오기
    $_linkTags = get_imgTag($data['memo'],$data['ismember'],99,1);

    for($ii=0;$ii<$realImg_count; $ii++) 
    {
      //본문에 삽입된 이미지일 경우 건너뜀        
      if($_linkTags && array_eregi('num='.$ii,$_linkTags)) continue;

      //이미지파일(gif,jpg,png,bmp)이 아니면 건너뜀
      $img_info=@getimagesize($images[$ii]);
      if(!($img_info[2] == 1 || $img_info[2] == 2 || $img_info[2] == 3 || $img_info[2] == 6)) continue;

      $addAttrib = '';
      $count++;
      $_total_view = count($images);

      $addAttrib .= " id=\"dqResizedvImg$ii\" galleryimg=\"no\"";
      $addAttrib .= !empty($_SS['using_picBorder']) ? ' class="pic_border"' : ' border="0"';

      if(!empty($skin_setup['using_autoResize'])) { // 자동 리사이즈 기능 사용시
        if(isset($_SS['resize_widthOnly']) && $img_info[0]>$_SS['pic_overLimit1']) {
          $y = $img_info[1] * $_SS['pic_overLimit2'] / $img_info[0];
          $addAttrib .= ' width="'.$_SS['pic_overLimit2'].'" height="'.$y.'"';
          $addAttrib .= ' onload="this.isResize=1;imageResize(this)"';
        } elseif(!isset($_SS['resize_widthOnly']) && ($img_info[0]>$_SS['pic_overLimit1'] || $img_info[1]>$_SS['pic_overLimit1'])) {
          $cal_size = cal_thumb_size($images[$ii],$_SS['pic_overLimit2'],$_SS['pic_overLimit2']);
          $addAttrib .= ' width="'.$cal_size[0].'" height="'.$cal_size[1].'"';
          $addAttrib .= ' onload="this.isResize=1;imageResize(this)"';
        }
        if(!$onImageNavigator) $addAttrib .= " onclick=\"callLightbox(this)\"";
      } else {
        $addAttrib .=  " width=\"$img_info[0]px\" height=\"$img_info[1]px\"";
        $addAttrib .=  eregi("\.png$",$images[$ii])? ' onload="call_AlphaImageLoader(this)"' : '';
      }

      // 이미지 네비게이션
      if($onImageNavigator) $addAttrib .= " onMouseMove=\"onImageNavigator(this,event)\" onMouseUp=\"gotoURL(event)\" onMouseOut=\"imageNaviHide(event)\"";

      // 파일 설명을 출력할것인지 결정
      $show_descript = false;
      unset($img_count);
      if(!empty($file_descript[$images_count[$ii]])) $show_descript = true; 

      // 이미지 파일이 두 개 이상일때는 설명앞에 번호를 붙인다.
      if($realImg_count < 2) unset($img_count); 
      elseif(!empty($_SS['using_pictureDescript'])) {
          $img_count = '<span class="descipt_counter">'.$count.'</span>';
          //if($show_descript) $img_count .= '<br />';
          $show_descript = true;
      }
      if($show_descript) {
          $descript[$images_count[$ii]] = stripslashes(nl2br($file_descript[$images_count[$ii]]));
          $descript_print = "<span class=\"han\">".$img_count.$descript[$images_count[$ii]]."</span>";
      }

      // 이미지 출력
	  if(empty($slide_imgHeight)) $slide_imgHeight='';
      if(empty($skin_setup['no_hideImgDir'])) $imgStreamName = 'revol_getimg.php?id='.$id.'&no='.$no.'&num='.$ii.'&fc='.md5($images[$ii]);
      else $imgStreamName = $images[$ii];
      echo "\r<table cellspacing=\"0\" cellpadding=\"0\" ".$slide_imgHeight."style=\"margin:0 0 ".$img_vspace."px 0\"><tr><td align=\"".$skin_setup['pic_align']."\">";
      if(empty($onImageNavigator) && !empty($skin_setup['using_autoResize'])) 
          echo "\n<img src=\"$imgStreamName\"$addAttrib border=\"0\" />";
      else echo "\n<img src=\"$imgStreamName\"$addAttrib />";

      // EXIF 정보 출력
      if(!empty($skin_setup['using_exif'])) echo exiflist($images[$ii]);

      // 파일설명 출력(본문내용의 폭 크기와 정렬방식을 따른다)
      if($show_descript) 
      {?>
          <table cellpadding="0" sellspacing="0" style="width:<?=$skin_setup['memo_width']?>" class="pic_bg"><tr><td align="<?=$skin_setup['memo_align']?>">
            <?=$descript_print?>
          </td></tr></table>
    <?php }
      echo "</td></tr></table>\n";
    }//for ?>
<?php }?>

<!-- 본문 글 출력 -->
<?php if ($data['memo'] != ".") {
// 본문내용 출력을 재정의
	if(empty($images) && empty($_linkImage[0])) {
		$skin_setup['memo_width'] = '100%';
		//$skin_setup['memo_align'] = 'left';
	}
	$memo_width = $skin_setup['memo_width'] ? $skin_setup['memo_width'] : '';

	$_memo_head = '<table width="'.$memo_width.'" cellpadding="0" cellspacing="0" style="padding:0 '.$_rSwidth.'px 0  '.$_lSwidth.'px"><tr><td align="'.$skin_setup['memo_align'].'" class="han" id="dq_textContents_memo">'."\r";

// 본문 내에 이미지 태그가 있는지 검사하고 처리
	if(!empty($_linkImage[0])) include $dir.'/include/chk_linkimage.php';
	?>
	<?=$_memo_head?>
	<?=$data['memo']?>
	<?="\r</td></tr></table>\r"?>
<?php } ?>

<div class="pic_bg" style="width:<?=$width?>;padding-bottom:<?=$_SS['memo_bMargin']?>px"></div>

<!-- 본문 글 끝 -->
<?php if($skin_setup['using_bgmPlayer'] && is_mediafile($data['sitelink1'])) {
	$music_info = get_musicinfo($data['sitelink1']);
	if($music_info[1]) $_tpadding = "0"; else $_tpadding = "10";
?>
<!-- BGM 플레이어 -->
<div style="width:<?=$width?>;font-family:batang,'바탕',sans-serif;font-size:8pt;padding:<?=$_tpadding?>px <?=$_rSwidth?>px 5px <?=$_lSwidth?>px" align="right" class="pic_bg">
<?php if($music_info[1]){ echo stripslashes($music_info[1]).'<br />'; } ?>
  <font class="mmp">[&nbsp;<b>BGM</b>:&nbsp;</font>
  <span style="cursor:pointer" onClick="javascript:mmp.play();" class="mmp"><b>P</b>lay</span>&nbsp;&nbsp;<span style="cursor:pointer" onClick="mmp.stop()" class="mmp"><b>S</b>top</span>&nbsp;&nbsp;<span style="cursor:pointer" onClick="mmp.pause()" class="mmp"><b>P</b>ause</span><font class="mmp">&nbsp;]</font>
</div>
<!-- BGM 플레이어 끝 -->
<?php }?>
</td></tr></table>

<table border="0" width="<?=$width?>" cellspacing="0" cellpadding="0" class="info_bg">
<tr><td class="lined" colspan="5"><?=$blank_Image?></td></tr>
<tr><td height="5" class="info_bg"></td></tr>
<tr>
 <td width="<?=$_lSwidth?>"><img src="<?=$dir?>/t.gif" width="<?=$_lSwidth?>" height="1px"></td>
 <td height="24px" align="left">
    <?=isset($bt_reply)?$bt_reply:''?><?php if($is_admin || !$is_vdel) {?><?=isset($bt_modify)?$bt_modify:''?><?=isset($bt_delete)?$bt_delete:''?><?php }?>
	<?php if($skin_setup['using_vote']) {?><?=$bt_vote?><?php }?>
 </td>
 <td align="center">&nbsp;</td>
 <td align="right">
	<?php if($dqrevolutionType = 'Gallery' && !empty($skin_setup['using_gmode']) && empty($skin_setup['show_articleInfo']) && empty($setup['use_alllist'])) {
		if($prev_data['no']) echo $bt_vprev;
		if($next_data['no']) echo $bt_vnext;
	  }
	?>
    <?=$bt_list?><?=$bt_write?>
 </td>
 <td width="<?=$_rSwidth?>"><img src="<?=$dir?>/t.gif" width="<?=$_rSwidth?>px" height="1px"></td>
</tr>
</table>
<a name="#articleInfo"></a>
<?php if(!$skin_setup['using_bmode'] && $skin_setup['show_articleInfo']) { ?>
<table width="<?=$width?>" cellspacing="0" cellpadding="0" class="info_bg">
<tr><td height="5px"></td></tr>
<tr><td class="lined"><?=$blank_Image?></td></tr>
<tr><td style="height:15px"></td></tr>
</table>

<?php include $dir."/include/view_gmode.php"?>
<?php } ?>

<?php if(empty($fckeditor_dir) && !empty($enable_pn_list) && !empty($skin_setup['using_keyNavi'])) { ?>
<script type="text/javascript"> addEvent(document,"keyup",movePage) </script>
<?php } 

if($is_vdel && !$is_admin) $skin_setup['using_comment'] = '';

// 코멘트 시작
if($member['level']<=$setup['grant_comment']){?>
<div id="ctop" class="info_bg" style="width:<?=$width?>;height:5px;font-size:1px"></div>
<?php } ?>
<table border="0" width="<?=$width?>" cellspacing="0" cellpadding="0" class="info_bg" style="table-layout:fixed" id="commentbox">
<tr><td style="padding:0 <?=$_rSwidth?>px 0 <?=$_lSwidth?>px" align="left">
