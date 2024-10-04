<?php 
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	$_empty_value_str = !empty($skin_setup['info_emptyValue']) ? $skin_setup['info_emptyValue'] : '';

	$tInfo = stripslashes(trim($skin_setup['article_info']));

	if(!empty($skin_setup['using_pGallery']) && eregi("[name]",$tInfo) && $su!="on")
		$_tPg = "&nbsp;&nbsp;<a href=zboard.php?id=$id&su=on&keyword={$data['ismember']}>[이 사진가의 전체 사진보기]</a>";
	else
		$_tPg = '';
	
	if(!isset($number)) $number='';
	$tInfo = str_replace("[no]",$number,$tInfo);

	$tInfo = str_replace("[IP]",$strShowIP,$tInfo);
	$tInfo = str_replace("","&nbsp;",$tInfo);

	if(!empty($is_vdel) && !$is_admin) $data['subject'] = '';

	if($data['subject'] != "." && $data['subject'] != "") {
		$tInfo = str_replace("[subj_start]","",$tInfo);
		$tInfo = str_replace("[subj_end]","",$tInfo);
		$tInfo = str_replace("[subj]","<font class=\"view_title2\">$subject</font>",$tInfo);
	} else {
		$tInfo = ereg_replace("\[subj_start\].*\[subj_end\]","",$tInfo);
		$tInfo = str_replace("[subj]","",$tInfo);
	}


	if($setup['use_category']) {
		$tInfo = str_replace("[cate_start]","",$tInfo);
		$tInfo = str_replace("[cate_end]","",$tInfo);
		$tInfo = str_replace("[cate]","<font class=\"view_cate\">$category_name</font>",$tInfo);
	} else {
		$tInfo = ereg_replace("\[cate_start\].*\[cate_end\]","",$tInfo);
		$tInfo = str_replace("[cate]","",$tInfo);
	}

	if($su != "on") {
		$tInfo = str_replace("[name_start]","",$tInfo);
		$tInfo = str_replace("[name_end]","",$tInfo);
		$tInfo = str_replace("[name]",$this_name.$homepage.$_tPg,$tInfo);
	} else {
		$tInfo = ereg_replace("\[name_start\].*\[name_end\]","",$tInfo);
		$tInfo = str_replace("[name]","",$tInfo);
	}

	$ppoint1=0; $ppoint=0;
	$ppoint1 = $data['total_comment']+1;
	if($data['vote'] && $data['hit']) $ppoint = ceil((100*($data['vote']*$ppoint1)/$data['hit'])+($data['hit']/3));
    else $ppoint = '';

	if($hit||$vote||$data['total_comment']||$ppoint) {
		$tInfo = str_replace("[info1_start]","",$tInfo);
		$tInfo = str_replace("[info1_end]","",$tInfo);
	} else {
		$tInfo = preg_replace("/\[info1_start\].*\[info1_end\]/s","",$tInfo);
	}


	if($ppoint) {
		$tInfo = str_replace("[point_start]","",$tInfo);
		$tInfo = str_replace("[point_end]","",$tInfo);
		$tInfo = str_replace("[point]",$ppoint,$tInfo);
	} else {
		$tInfo = ereg_replace("\[point_start\].*\[point_end\]","",$tInfo);
		$tInfo = str_replace("[point]",$_empty_value_str,$tInfo);
	}

	if($hit) {
		$tInfo = str_replace("[hit_start]","",$tInfo);
		$tInfo = str_replace("[hit_end]","",$tInfo);
		$tInfo = str_replace("[hit]",$hit,$tInfo);
	} else {
		$tInfo = ereg_replace("\[hit_start\].*\[hit_end\]","",$tInfo);
		$tInfo = str_replace("[hit]",$_empty_value_str,$tInfo);
	}

	if($data['total_comment']) {
		$tInfo = str_replace("[comment_start]","",$tInfo);
		$tInfo = str_replace("[comment_end]","",$tInfo);
		$tInfo = str_replace("[comment]",$data['total_comment'],$tInfo);
	} else {
		$tInfo = ereg_replace("\[comment_start\].*\[comment_end\]","",$tInfo);
		$tInfo = str_replace("[comment]",$_empty_value_str,$tInfo);
	}

	if($vote && $skin_setup['using_vote']) {
		$tInfo = str_replace("[vote_start]","",$tInfo);
		$tInfo = str_replace("[vote_end]","",$tInfo);
		$tInfo = str_replace("[vote]",$vote,$tInfo);
	} else {
		$tInfo = ereg_replace("\[vote_start\].*\[vote_end\]","",$tInfo);
		$tInfo = str_replace("[vote]",$_empty_value_str,$tInfo);
	}

	$tInfo = str_replace("[regdate]",date("Y-m-d H:i",$data['reg_date']),$tInfo);

    if(!empty($skin_setup['using_vote']) && eregi("[vote_user]",$tInfo) && !empty($vote_users[2])) {

        $tInfo = str_replace("[vote_user_start]","",$tInfo);
        $tInfo = str_replace("[vote_user_end]","",$tInfo);

        $vote_user_tmp = "<span class=\"han2\">추천하신 분들</span><span class=\"han\">(".$vote_users[2]."명)</span><div style=\"white-space:normal\">".$vote_users[0]."</div>\n";
        $tInfo = str_replace("[vote_user]","[spacer]<br>[spacer]<br>".$vote_user_tmp,$tInfo);
    } else {
        $tInfo = ereg_replace("\[vote_user_start\].*\[vote_user_end\]","",$tInfo);
        $tInfo = str_replace("[vote_user]","",$tInfo);
    }

	if(eregi("\[file\]|\[link1\]|\[link2\]",$tInfo)) {

		// 업로드된 파일 목록을 모두 배열로 저장
		$tmp = get_uploadImages($data,'',true,1);
		$is_vdel = $tmp['is_vdel'];
		if(!$is_vdel) {
			$images			= $tmp[0];
			$s_images		= $tmp[1];
			$images_size	= $tmp[2];
			$images_count	= $tmp[3];
		}
		$_chk_uploadImages = true;

		if($is_admin) $is_vdel = '';
		if(!$is_vdel) {
			if(get_StrValue($data['sitelink1'],0) && !is_mediafile($data['sitelink1'])) $link1 = true;
			if(get_StrValue($data['sitelink2'],0)) $link2 = true;

			if(!empty($link1) || !empty($link2)) {
				$tInfo = str_replace("[link_start]","",$tInfo);
				$tInfo = str_replace("[link_end]","",$tInfo);

				if(!empty($link1)) {
					$tInfo = str_replace("[link1_start]","",$tInfo);
					$tInfo = str_replace("[link1_end]","",$tInfo);
					$tInfo = str_replace("[link1]",autolink(get_StrValue($data['sitelink1'],0)),$tInfo);
				} else {
					$tInfo = ereg_replace("\[link1_start\].*\[link1_end\]","",$tInfo);
					$tInfo = str_replace("[link1]",$_empty_value_str,$tInfo);
				}

				if(!empty($link2)) {
					$tInfo = str_replace("[link2_start]","",$tInfo);
					$tInfo = str_replace("[link2_end]","",$tInfo);
					$tInfo = str_replace("[link2]",autolink(get_StrValue($data['sitelink2'],0)),$tInfo);
				} else {
					$tInfo = ereg_replace("\[link2_start\].*\[link2_end\]","",$tInfo);
					$tInfo = str_replace("[link2]",$_empty_value_str,$tInfo);
				}
			} else {
				$tInfo = str_replace("[link_start]","<!-- ",$tInfo);
				$tInfo = str_replace("[link_end]","-->",$tInfo);
			}
			
			//파일이름 표시
			if(eregi("[file]",$tInfo) && $images) {
				$tt='';
				$more = null;
				$tInfo = str_replace("[file_start]","",$tInfo);
				$tInfo = str_replace("[file_end]","",$tInfo);

                $download_link_max = !empty($_SS['download_link_number']) ? $_SS['download_link_number'] : 2;

				$font1 = "<font class=\"eng\">";
				$font2 = "</font><br>\n";
				for($i=0;$i<count($images); $i++) {
					if($i == $download_link_max) {
						$more = true;
						$font1 = "";
						$font2 = "\n";
						$tt .= "[spacer]<br><span class=\"eng\" style=\"cursor:pointer\" title=\"";
					}

//					unset($exif1);
					$dlink='';
					unset($addClipboardText);

					if($i == count($images)-1 && $more) $font2 = "";
//					if($i<2 && $skin_setup['using_exif']) $exif1 = exiflist($images[$i]);

					if(empty($more) && !eregi("\.gif$|\.jpg$|\.png$|\.bmp$",$s_images[$i]))
                      $dlink="revol_download.php?id=$id&no={$data['no']}&filenum=".($i+1);
					if($dlink) {
						if(is_mediafile($images[$i])) $addClipboardText = "onclick=\"rv.clipboardCopy('".get_zburl()."$images[$i]',1)\" style=\"cursor:pointer\"";
						if($i==0) $dfile = $data['download1']; else $dfile = $data['download2'];
						$dlink = "x$dfile&nbsp;&nbsp;<a href=\"$dlink\">$bt_download</a>";
					}

					$sFileInfo = pathinfo($s_images[$i]);
					$sFileInfo['basename'] = dq_basename($s_images[$i]);
					$scr_images[$i] = cut_str(str_replace('.'.$sFileInfo['extension'],'',$sFileInfo['basename']),40).'.'.$sFileInfo['extension'];
					if(!empty($addClipboardText)) $tt .= 
						$font1.'<span '.$addClipboardText.'>'.$scr_images[$i]." (".$images_size[$i].")".'</span>'.$dlink.$font2;
					else $tt .= $font1.$scr_images[$i]." (".$images_size[$i].")".$dlink.$font2;

//					if($exif1) $tt .= "$exif1\n";
					if($i == count($images)-1 && $more) $tt .= "\">More files(".(count($images)-$download_link_max).")...</span>";
				}
			$tInfo = str_replace("[file]",$tt,$tInfo);
			} else {
				$tInfo = ereg_replace("\[file_start\].*\[file_end\]","",$tInfo);
				$tInfo = str_replace("[file]","",$tInfo);
			}
		} else { //가상으로 삭제 되었을때
			$tInfo = ereg_replace("\[link_start\].*\[link_end\]","",$tInfo);
			$tInfo = ereg_replace("\[file_start\].*\[file_end\]","",$tInfo);
			$tInfo = str_replace("[file]","",$tInfo);
			$tInfo = ereg_replace("\[vote_user_start\].*\[vote_user_end\]","",$tInfo);
			$tInfo = str_replace("[vote_user]","",$tInfo);
		}
	}
	$tInfo = str_replace("[spacer]","<img src=\"$dir/t.gif\" height=\"5px\" width=\"5px\" />",$tInfo);

?>
