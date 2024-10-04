<?php 
// 섬네일 생성
  // 글 작성자의 프로필 사진 가져오기
	if($skin_setup['using_mpicThumb']) {
		if($data['ismember']) {
            $data_copy = $data;
			$nofaceImg = $dir.'/images/no_face.jpg';
			$tmp  = @mysql_fetch_array(zb_query("select is_admin,open_picture,picture from $member_table where no = '{$data_copy['ismember']}'"));
			if($tmp) { 
				$data_copy = array_merge($data_copy,$tmp);
				if($tmp['picture']) {
					$data_copy['file_name1']   = $tmp['picture'];
					$data_copy['s_file_name1'] = dq_basename($tmp['picture']);
				} else {
					$data_copy['file_name1']   = $nofaceImg;
					$data_copy['s_file_name1'] = 'no_face.jpg';
				}
			} else {
				$data_copy['file_name1']   = $nofaceImg;
				$data_copy['s_file_name1'] = 'no_face.jpg';
			}
		} else {
			$data_copy['file_name1']   = $nofaceImg;
			$data_copy['s_file_name1'] = 'no_face.jpg';
		}
		$tmp = $dqEngine['thumb_source'];
		$dqEngine['thumb_source'] = 'member';
		$thumb_tag = get_thumbTag($data_copy,$skin_setup['thumb_imagex'],$skin_setup['thumb_imagey'],$dir);
		$dqEngine['thumb_source'] = $tmp;

	} else {
		$thumb_tag = get_thumbTag($data,$skin_setup['thumb_imagex'],$skin_setup['thumb_imagey'],$dir);
	}


// 섬네일에 여백주기
//	if($skin_setup['thumb_align'] == 'left')   $margin = "0 ".($skin_setup['thumb_imagex']-$thumb_tag[0]+3)."px 0 3px";
//	if($skin_setup['thumb_align'] == 'right')  $margin = "0 3px 0 ".($skin_setup['thumb_imagex']-$thumb_tag[0]+3).'px';

	$thumb_tag[2] = str_replace(">"," style=\"margin:".$margin.";\" align=\"absmiddle\">",$thumb_tag[2]);

	if($skin_setup['thumb_align'] == 'center') {
//		$_thumbnailBorderWidth = '6px'; // 썸네일 테두리 두께 x 2
		$_thumb_area_width  = $skin_setup['thumb_imagex']+$_thumbnailBorderWidth;
		$_thumb_area_height = $skin_setup['thumb_imagey']+$_thumbnailBorderWidth;
		$thumb_tag[2] = str_replace(" class=\"thumb_border\"","",$thumb_tag[2]);
		$border_tag[1] = "<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"$_thumb_bgcolor\" width=\"".$_thumb_area_width."\" height=\"".$_thumb_area_height."\"><tr><td align=\"center\" class=\"thumb_border\">";
		$border_tag[2] = "</td></tr></table>";

		$_line_height = $skin_setup['thumb_imagey']+10;
	} else {
		$_thumb_area_width = $thumb_tag[0]+10;
		$_line_height      = $thumb_tag[1];
	}


// 새 창으로 띄우기 위한 원본 이미지파일 결정
	$tmp = get_uploadImages($data,999,1);
    $data['is_vdel'] = $tmp['is_vdel'];

    $viewer_lvLower = false;
    if($_SS['using_viewer_level'] && get_StrValue($data['sitelink2'],2) && get_StrValue($data['sitelink2'],2) < $member['level']) $viewer_lvLower = true;

    if(!$is_admin && ($setup['grant_view'] < $member['level'] || $data['is_vdel'] || $viewer_lvLower))
        $_thumbnail_tag = $thumb_tag[2];
    elseif(!$data['is_secret']);
    {
        if($_SS['using_newWindow']) {
            if(!$_zb_url) $_zb_url = str_replace(basename($PHP_SELF),"",$PHP_SELF);
        
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
                $strThumbAdd2 = "gotoUrl:'$_zb_exec?no={$data['no']}&$href&$sort'";
              //}
              $file_descript[0] = str_replace('[use]','',$file_descript[0]);

              $captionText = $file_descript[0] ? ',captionText:\''.addSlashes4JS($file_descript[0]).'\'' : '';
              $_thumbnail_tag = '<a href="'.$tfile[0].'" '.$strThumbAdd1.' onclick="return hs.expand_dq(this,{slideshowGroup:'.$data['no'].$captionText.','.$strThumbAdd2.'})">'.$thumb_tag[2].'</a>';

              if(count($tfile)>1) {
                for($i=1; $i <= count($tfile); $i++) 
                  if($tfile[$i]) 
                  {
                    $captionText = $file_descript[$i] ? ',captionText:\''.addSlashes4JS($file_descript[$i]).'\'' : '';
                    $hiddenSlide1 .= "<a href=\"$tfile[$i]\" onclick=\"return hs.expand(this,{slideshowGroup:".$data['no'].$captionText."})\"></a>\n";
                    if(!$slidescript_put) $hiddenSlide2 .= 'hs.addSlideshow_dq('.$data['no'].");\n";
                    $slidescript_put = true;
                  }
              }
            }
        } elseif($setup['grant_view'] >= $member['level'] || $is_admin) {
            $_thumbnail_tag = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\">$thumb_tag[2]</a>";
        }
	} 
    if($data['is_secret']) {
		$_thumbnail_tag = "<a href=\"$_zb_exec?$href&$sort&no={$data['no']}\" onfocus=\"blur()\">$thumb_tag[2]</a>";
    }
?>
