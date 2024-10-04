<?php 
	if(!file_exists(getcwd().'/zboard.php')) die("정상적인 접근이 아닙니다.");

// 코멘트 재설정
	$css = (get_newComment($data['no']))? 'list_comment2' : '';
	$comment_num = ($comment_num) ? '<font class="'.$css.'">'.$data['total_comment'].'</font>' : '';

// 제목 재설정
	$chk_subj	= cut_str($data['subject'],$setup['cut_length']);
	$subject	= str_replace(" >$chk_subj"," ><span class=\"thumb_list_title\">$chk_subj</span>",$subject);

// 이름 재설정
	$name = str_replace('<div ','<span ',str_replace('/div>','/span>',$name));
	$name = str_replace('>'.$data['name'].'<','><span class="thumb_list_name" style="font-weight:normal">'.$data['name'].'</span><',$name);

// 카테고리 재설정
	$category_name = "<span class=\"thumb_list_cate\">".str_replace('</font>','</span>',$category_name);

// 제로보드 링크파일 결정
	if(!$setup['use_alllist']) $_zb_exec="view.php"; else $_zb_exec="zboard.php";

	if(!empty($_notice_visible)) {
		echo "<img src=\"$dir/t.gif\" border=\"0\" height=\"10\" />\n";
		$_notice_visible = false;
	}
	if($su=="on" && $keyword) {
		$show_name_old=$_SS['show_name'];
		$_SS['show_name']=false;
	}

	unset($thumb_x);
	unset($thumb_y);
	
	if(empty($_xx)) $_xx=0;
	if(empty($_hcol)) $_hcol=0;
	$_xx++;
	$_hcol++;

	if(!empty($_SS['thumb_hcount'])) $_temp = ($_xx) % $_SS['thumb_hcount'];

	if($_SS['thumb_hcount'] == '1') $_temp = '1';

	if ($_temp==1) {?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
<?php }

	if($_SS['thumb_hcount'] == '1') $_temp = '0';

// 썸네일 설정
	$dqEngine['thumb_resize'] = isset($_SS['thumb_resize'])? $_SS['thumb_resize']	: 0;

// 섬네일 생성
	$thumb_tag = get_thumbTag($data,$_SS['thumb_imagex'],$_SS['thumb_imagey'],$dir);
	$thumb_frame = !empty($_SS['thumb_frame_width']) ? $_SS['thumb_frame_width']+2 : 2;
	$thumb_bPadding = ($thumb_frame == 1)? 0 : $thumb_frame;
	if($thumb_frame) {
		$border_tag = '<div class="thumb_frame" style="width:'.$thumb_tag[0].'px;height:'.$thumb_tag[1].'px;padding:'.$thumb_bPadding.'px">[THUMB_TAG]</div>';
	}

// 섬네일이 들어가는 셀의 크기계산
	if(!empty($_SS['thumb_hcount'])) $_ta_width = 100/$_SS['thumb_hcount'];

// 섬네일 세로정렬에 따른 셀 높이 계산
	if(!isset($add_bPixel)) $add_bPixel=null;
	if($_SS['thumb_valign'] != "top") $th_height = $_SS['thumb_imagey']+$add_bPixel+($thumb_bPadding*2);

// 썸네일 세로 간격
    if(!isset($_SS['thumbnail_hSpace'])) $_SS['thumbnail_hSpace'] = 30;

// ----------------------------------------------

	$tmp = get_uploadImages($data,999,1);
    $data['is_vdel'] = $tmp['is_vdel'];

    $viewer_lvLower = false;
    if(!empty($_SS['using_viewer_level']) && get_StrValue($data['sitelink2'],0) && get_StrValue($data['sitelink2'],0) < $member['level']) $viewer_lvLower = true;

    if(!$is_admin && ($setup['grant_view'] < $member['level'] || $data['is_vdel'] || $viewer_lvLower))
		$_thumbnail_tag = str_replace('>','class="no_grant" onload="nogrant(this)" />',$thumb_tag[2]);
	elseif(!$data['is_secret'])
	{

	// 새 창으로 띄우기 위한 원본 이미지파일 결정
		if(!empty($_SS['using_newWindow'])) {
			if(!$_zb_url) $_zb_url = str_replace(basename($_SERVER['PHP_SELF']),'',$_SERVER['PHP_SELF']);
        
        // 슬라이드 초기화
            unset($slidescript_put);
            unset($tfile);
            unset($hfile);
            unset($file_descript);

			if($tmp[0][0]) {
              $fileDescript = get_fileDescript($id, $data['no']);
              $imgCount = 0;
              for($i=0; $i < count($tmp[0]); $i++){
                  $ImgInfo[$i] = getimagesize($tmp[0][$i]);
                  if($ImgInfo[$i][2]) {
                    $tfile[$imgCount] = $_zb_url."revol_getimg.php?id=$id&no={$data['no']}&num=$i&fc=".md5($tmp[1][$i]);
                    $file_descript[$imgCount] = str_replace('[use]','',$fileDescript[$tmp[3][$i]]);
                    $imgCount++;
                  }
              }
			  //if(count($fileDescript)==1 && count($tmp[0])==1) $file_descript[0] = trim(ereg_replace("\*.+게시물 (이동|복사)되었습니다..+$","",strip_tags($data['memo'])));
            } else $tfile = "";


        // 업로드파일이 없을경우 HTML태그 분석
			if(!$hfile) {
				$hfile = get_imgTag($data['memo'],$data['ismember'],99);
                if($hfile[0]) {
                  for($i=0; $i < count($hfile); $i++){
                    $hfile[$i] = get_urlPath($hfile[$i]);
                    $hfile[$i] = dq_urlencode($hfile[$i]); 
                  }
                $tfile = $tfile ? array_merge($tfile,$hfile) : $hfile;
                }
			}

        // 이미지 파일을 못찾았을때
			if(!$tfile) $_thumbnail_tag = $thumb_tag[2];
		// 이미지 파일을 찾았을때
			else {
              //if(!$_SS['show_thumbInfo']) {
                $strThumbAdd1 = "onMouseMove=\"onImageNavigator(this,event,1)\"";
                $strThumbAdd2 = "gotoUrl:'$_zb_exec?no={$data['no']}&$href&$sort',isMember:{$data['ismember']}";
              //}
              $file_descript[0] = str_replace('[use]','',$file_descript[0]);

              $captionText = $file_descript[0] ? ',captionText:\''.addSlashes4JS($file_descript[0]).'\'' : '';
              $_thumbnail_tag = '<a href="'.$tfile[0].'" '.$strThumbAdd1.' onclick="return hs.expand_dq(this,{slideshowGroup:'.$data['no'].$captionText.','.$strThumbAdd2.'})">'.$thumb_tag[2].'</a>';

              if(count($tfile)>1) {
                for($i=1; $i <= count($tfile); $i++) 
                  if($tfile[$i]) 
                  {
                    $captionText = $file_descript[$i] ? ',captionText:\''.addSlashes4JS($file_descript[$i]).'\'' : '';
                    $hiddenSlide1 .= "<a href=\"".$tfile[$i]."\" onclick=\"return hs.expand(this,{slideshowGroup:".$data['no'].$captionText."})\"></a>\n";
                    if(!$slidescript_put) $hiddenSlide2 .= 'hs.addSlideshow_dq('.$data['no'].");\n";
                    $slidescript_put = true;
                  }
              }
            }

		} else {
          $link_site_url = get_StrValue($data['sitelink2'],0);
          if(!empty($skin_setup['using_siteLink']) && !empty($link_site_url)) { //사이트 링크
            if(!eregi("^http://",$link_site_url)) $link_site_url = 'http://'.$link_site_url;
			$_thumbnail_tag = '<a href="'.$link_site_url.'" onfocus="blur()" target="_blank">'.$thumb_tag[2].'</a>';
          } else {
			$_thumbnail_tag = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\">$thumb_tag[2]</a>";
          }
		}
	} 
    if($data['is_secret']) {
		$_thumbnail_tag = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\">$thumb_tag[2]</a>";
    }

	if($thumb_frame) {
		$_thumbnail_tag = str_replace('[THUMB_TAG]',$_thumbnail_tag,$border_tag);
	}
?>
		<td width="<?=$_ta_width?>%" valign="top">
		  <table border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;" width="100%">
		  <tr><td height="<?=$th_height?>px" align="<?=$_SS['thumb_align']?>" valign="<?=$_SS['thumb_valign']?>"><?=$_thumbnail_tag?></td>
		  </tr>
	<?php 
		if($_SS['show_thumbInfo']) {
		  include $dir."/include/analysis_01.php";
	?>
		  <tr align="<?=$_SS['thumb_align']?>">
			<td style="padding-top:6px;line-height:120%">
			<?=$tInfo?>
			</td></tr>
	<?php } ?>

		  </table>
		</td>
	<?php if (!$_temp) {?>
	  </tr>
	<?php if ($_SS['thumbnail_hSpace']) {?>
	  <tr><td colspan="<?=$_hcol?>" height="<?=$_SS['thumbnail_hSpace']?>px" class="thumb_area_bg"></td></tr>
    <?php }?>
	</table>
	<?php $_hcol=0;?>
	<?php 
	  }

	if($su=="on" && $keyword) {
		$_SS['show_name']=$show_name_old;
	}

// 썸네일 설정
	$dqEngine['thumb_resize'] = '';
?>
