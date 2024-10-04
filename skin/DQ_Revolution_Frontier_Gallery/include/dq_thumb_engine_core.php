<?php
/**********************************************************************************************************
	■ DQ'Thumb Engine
	최종 수정: 2008-12-18
	제작     : 드림퀘스트(본명:안현우)
	Homepage : http://www.dqstyle.com
	E-Mail   : dqstyle@gmail.com

************************************************************************************************************/
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
	global $dqEngine, $dq_make_thumb_included;

// 중복 인클루드 검사
	if($dq_make_thumb_included) return false;
	else $dq_make_thumb_included = true;
	if (!function_exists("eregi")) {
		function eregi($pattern, $string, &$regs = array()) {
			$pattern = str_replace("\\/", "/", $pattern);
			$pattern = str_replace("/", "\\/", $pattern);
			return preg_match("/" . $pattern . "/i", $string, $regs);
		}
	}
// 설정
	$dqEngine['document_root']	= !empty($dqEngine['document_root'])			? $dqEngine['document_root'] : get_indexDir();
	$dqEngine['using_socket']	= isset($dqEngine['using_socket'])		? $dqEngine['using_socket'] : 0;
	$dqEngine['using_urlImg']	= isset($dqEngine['using_urlImg'])		? $dqEngine['using_urlImg'] : '0';
	$dqEngine['using_usm']		= isset($dqEngine['using_usm'])			? $dqEngine['using_usm']	: 1;
	$dqEngine['usm_option1']	= isset($dqEngine['usm_option1'])		? $dqEngine['usm_option1']	: 60;
	$dqEngine['usm_option2']	= isset($dqEngine['usm_option2'])		? $dqEngine['usm_option2']	: 0.5;
	$dqEngine['usm_option3']	= isset($dqEngine['usm_option3'])		? $dqEngine['usm_option3']	: 1;
	$dqEngine['using_thumbnail']= isset($dqEngine['using_thumbnail'])	? $dqEngine['using_thumbnail'] : 1;
	$dqEngine['thumb_cutpixel']	= isset($dqEngine['thumb_cutpixel'])	? $dqEngine['thumb_cutpixel'] : 5;
	$dqEngine['using_secretImg']= isset($dqEngine['using_secretImg'])	? $dqEngine['using_secretImg']: 1;
	$dqEngine['thumbfile_permit'] = !empty($_SS['uploadfile_permit']) ? $_SS['uploadfile_permit'] : 0755;
	$dqEngine['gd_version']		= get_gdVersion();
	$dqEngine['_thumbnail_quality']	 = 90;

//	$dqEngine['using_bmpIMG_Convert']: 0;
//	$dqEngine['thumbnailNoComp']: 0;
//	$dqEngine['thumb_resize']	: 0;
//	$dqEngine['thumb_color_grey'] = 1;
//	$dqEngine['']	= $_SS[''] ? $_SS[''] : '0';

// 기본 확장자 지정
    $_gd_support = get_support_GD_type();
    if(eregi("\.jpg",$_gd_support))     $dqEngine['defult_ext'] = '.jpg';
    elseif(eregi("\.png",$_gd_support)) $dqEngine['defult_ext'] = '.png';
    elseif(eregi("\.gif",$_gd_support)) $dqEngine['defult_ext'] = '.gif';

// 썸네일 태그 만들기
	function get_thumbTag($data, $x, $y, $dir, $target_file="") {
		global $id, $_SS, $dqEngine;

	// 이미지 없을때
		if(eregi("/$",$dir)) $dir = substr($dir,0,strlen($dir)-1);
		$no_image = !empty($dqEngine['img_noImage']) ? $dqEngine['img_noImage'] : $dir."/images/no_image.jpg";

	// 생성될 썸네일 파일
		$old_thumb_file = 'data/'.$id.'/small_'.$data['no'].'.thumb';
		$thumbnail_dir  = 'data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$data['reg_date']);
		if(!$target_file) $target_file = $thumbnail_dir.'small_'.$data['no'].$dqEngine['defult_ext'];
        
        if(file_exists($old_thumb_file)) {
		  mkdirs($thumbnail_dir,$dqEngine['thumbfile_permit']);
          rename($old_thumb_file,$target_file);
        }

		if(!empty($dqEngine['thumbnailNoComp']) && file_exists($target_file)) $ret = $target_file;
        if(file_exists($target_file) && file_exists($target_file.'.work')) @unlink($target_file.'.work');

	// 썸네일 생성
		if(empty($ret)) {
			$ret = get_zbThumb($data, $x, $y, $target_file);
			if($ret && !eregi(".thumb",$ret)) $org = true;
		}

		if(empty($dqEngine['thumbImgSize'])) {
			if(!empty($ret)) $imginfo = @getimagesize($ret);
			if(isset($imginfo) && ($imginfo[0] > $x || $imginfo[1] > $y)) $dqEngine['thumbImgSize'] = cal_thumb_size($ret,$x,$y);
		}
		$img_size = !empty($dqEngine['thumbImgSize']) ? $dqEngine['thumbImgSize'] : null;
		if(empty($img_size[0])) $img_size[0] = $x;
		if(empty($img_size[1])) $img_size[1] = $y;
		unset($dqEngine['thumbImgSize']);

		$str_docroot = &$dqEngine['document_root'];
		if(empty($ret)) $ret='';
		if(substr($ret,0,strlen($str_docroot)) == $str_docroot) $ret=str_replace($str_docroot,'',$ret);

		$ret_tag[0] = !empty($thumb_border) ? $img_size[0]+$thumb_border : $img_size[0];
		$ret_tag[1] = !empty($thumb_border) ? $img_size[1]+$thumb_border : $img_size[1];
		$ret_tag[2] = "<img src=\"$ret\" width=\"$img_size[0]\" height=\"$img_size[1]\" onFocus=\"blur()\" border=\"0\" class=\"thumb_border\">";
		$ret_tag[3] = $ret;

		return $ret_tag;
	}

// 제로보드 게시물에서 썸네일 추출
	function get_zbThumb($data,$thumb_x,$thumb_y,$target_file="") {
		global $id, $dir, $_SS, $dqEngine, $is_vdel;

	// GD버전 알아내기
		$_GD_VERSION = $dqEngine['gd_version'];

	// 이미지 없을때
		if(eregi("/$",$dir)) $dir = substr($dir,0,strlen($dir)-1);
		$no_image  = !empty($dqEngine['IMG_NOIMAGE']) ? $dqEngine['IMG_NOIMAGE']  : $dir.'/images/no_image';
		$no_image .= ($thumb_x <= 60) ? '_small.jpg' : (empty($dqEngine['IMG_NOIMAGE']) ? '.jpg' : '');

	// 비밀글일때
		$secret_image  = !empty($dqEngine['IMG_IS_SECRET']) ? $dqEngine['IMG_IS_SECRET']  : $dir."/images/secret_image";
		$secret_image .= ($thumb_x <= 60) ? '_small.jpg' : (empty($dqEngine['IMG_IS_SECRET']) ? '.jpg' : '');

	// 이전에 실패한 게시물 일 때
		if(file_exists($target_file.".work")) {
          $images_zero = $no_image;
          $cutPixel = true;
        }

	// 생성될 썸네일 파일
		if(empty($target_file)) {
          $thumbnail_dir  = 'data/_RV_Thumbnail_Files_/'.$id.date('/Y/m/',$data['reg_date']);
          if(!$target_file) $target_file = $thumbnail_dir.'small_'.$data['no'].$dqEngine['defult_ext'];
        }

	// 원본파일 결정
		if($dqEngine['using_secretImg'] && $data['is_secret']) {
			$images_zero  = $secret_image; // 비밀글일때
            $cutPixel = true;
		} elseif(empty($images_zero)) {
		// 업로드된 이미지 목록을 배열로 저장
			$tmp		 = get_uploadImages($data,1,0,0);
			$images		 = $tmp[0];
			if(!empty($tmp[0][0])) $images_zero = $tmp[0][0];
			$s_images	 = $tmp[1];
			$images_size = $tmp[2];
			$is_vdel	 = $tmp['is_vdel'];
			if($is_vdel) { $del = 1; $data['is_vdel'] = 1;}
		}

		if(!empty($images_zero)) $GLOBALS['DQENGINE_THUMB_SRC_IMG'] = $images_zero; else $GLOBALS['DQENGINE_THUMB_SRC_IMG'] = null;

		if(!empty($dqEngine['thumb_source']) && $dqEngine['thumb_source'] == 'member') $del = 0;
		if(!empty($del)) $images_zero = '';	// 가상 삭제된 경우
		if(isset($images_zero) && !preg_match('/.*\.(?:jpe?g|png|gif|bmp)(?:\?\S+)?$/i', $images_zero)) {
			$images_zero  = $no_image;
			$cutPixel = true;
		}

	// 썸네일 생성
		if(empty($cutPixel) && !empty($images_zero)) {
		  $GLOBALS['DQENGINE_THUMB_SRC_IMG'] = $images_zero;
		  $filename=make_thumb($thumb_x,$thumb_y,$images_zero,$target_file);
		} elseif(empty($del) && empty($cutPixel) && !empty($dqEngine['using_urlImg'])) {
		  $prtstr = @get_imgTag($data['memo'],1);
		  if(!empty($prtstr[0])) $GLOBALS['DQENGINE_THUMB_SRC_IMG'] = $prtstr = get_urlPath($prtstr[0]);	  
		  if($prtstr && $_GD_VERSION) $filename = get_ThumbnailFromHTMLTag($thumb_x,$thumb_y,$prtstr,$target_file);
		  if($prtstr && !$filename) $filename=$prtstr;
		}
		if(empty($filename)) 
        {
		  if(empty($images_zero)) $images_zero = $no_image;
          $imgInfo = @getimagesize($images_zero);
          $old_cutPixel = $dqEngine['thumb_cutpixel'];
          $old_resize   = $dqEngine['thumb_resize'];
          $dqEngine['thumb_cutpixel'] = intval(($imgInfo[0] - $thumb_x) / 2);
          $dqEngine['thumb_resize'] = 2;

          $filename = make_thumb($thumb_x, $thumb_y, $images_zero, $target_file);

          $dqEngine['thumb_cutpixel'] = $old_cutPixel;
          $dqEngine['thumb_resize']   = $old_resize;
        }
		return $filename;
	}

// 소스 이미지와 가능한 GD타입 검사
	function chk_GDImageType($src_file) 
    {
        $_gd_support = get_support_GD_type();
        $file_type = chk_ImageFormat($src_file);

		if($file_type && !@eregi($file_type, $_gd_support)) 
		{
			if(eregi("\.jpg",$_gd_support)) return 'jpg';
			elseif(eregi("\.png",$_gd_support)) return 'png';
			elseif(eregi("\.gif",$_gd_support)) return 'gif';
		} 
		else 
		{
			return $file_type;
		}
	}

    function get_support_GD_type() {
		global $dqEngine;

		$_GD_VERSION = $dqEngine['gd_version'];
		unset($_gd_support);
		$_gd_support='';

		$dqEngine['gd_info'] = $gd_info = get_gdinfo();

        if(empty($dqEngine['gd_info']['_GIF_Engine'])) {		
            $dqEngine['gd_info']['_GIF_Engine'] = get_realpath(__FILE__)."/phpthumb.gif.php";
            if(@file_exists($dqEngine['gd_info']['_GIF_Engine'])) 
                $dqEngine['gd_info']['GIF Read Support2'] = true;
        }

		if($_GD_VERSION) {
			if(!empty($gd_info['GIF Read Support']))	$_gd_support .='.gif';
			if(!empty($gd_info['GIF Read Support2']) || !empty($gd_info['GIF Create Support']))	$_gd_support .='.gif';
			if(!empty($gd_info['JPG Support']) || !empty($gd_info['JPEG Support']))			$_gd_support .='.jpg';
			if(!empty($gd_info['PNG Support']))			$_gd_support .='.png';
			if(function_exists('ImageCreateFromBMP_DQ') && empty($dqEngine['imgConvertingMode'])) 
				$_gd_support .=".bmp";
		}
        return $_gd_support;
    }

// 썸네일 생성
	function make_thumb($max_x,$max_y,$src_file,$target_file="",$screen_only=false) {
		global $dqEngine, $setup, $id;

	// 타겟파일 검사/지정
        if(!$screen_only) {
            $_fThumbnail = $target_file;
            $tmp = pathinfo($target_file);

            if(!$_fThumbnail) $_fThumbnail = $tmp['filename'].".thumb";

            if(file_exists($_fThumbnail)) $comp_file=$_fThumbnail; else $comp_file=$src_file;
            if(!empty($dqEngine['thumbnailNoComp'])) return $comp_file;

            $imgCreateCheck = chk_imgfile($comp_file,$max_x,$max_y);
            if(empty($dqEngine['imgConvertingMode']) && (!$imgCreateCheck || !($max_x||$max_y))) return $comp_file;
        }

		if (!file_exists($src_file) || !filesize($src_file)) return;

		$_GD_VERSION = $dqEngine['gd_version'];
		$_support_ImageType = chk_GDImageType($src_file);

		if ($_GD_VERSION && $_support_ImageType) 
		{
			$file_type = $dqEngine['InfoSrcImg'][2];
			$cal_size = cal_thumb_size($src_file,$max_x,$max_y);

			switch($file_type) {
				case "jpg": $src_img=ImageCreateFromJPEG($src_file); break;
				case "gif": 
					if($dqEngine['gd_info']['GIF Read Support']) $src_img=ImageCreateFromGIF($src_file); 
					elseif($dqEngine['gd_info']['GIF Read Support2']) {
						include_once $dqEngine['gd_info']['_GIF_Engine'];
						$src_img=gif_loadFileToGDimageResource($src_file);
					} break;
				case "png": $src_img=ImageCreateFromPNG($src_file); break;
				case "bmp": $src_img=ImageCreateFromBMP_DQ($src_file); break;
			}

			if($_GD_VERSION >= 2) $dst_img=ImageCreateTrueColor(intval($cal_size[0]), intval($cal_size[1]));
			if(!$dst_img) $dst_img=ImageCreate(intval($cal_size[0]), intval($cal_size[1]));
			
			$color = imagecolorallocate($dst_img,255,255,255);
			imagefill($dst_img,1,1,$color);

			$x1 = !empty($cal_size[4]) ? 0 - ($cal_size[4] - $cal_size[0])/2 : 0;
			$y1 = !empty($cal_size[5]) ? 0 - ($cal_size[5] - $cal_size[1])/2 : 0;
			$x2 = !empty($cal_size[4]) ? $cal_size[4] : $cal_size[0];
			$y2 = !empty($cal_size[5]) ? $cal_size[5] : $cal_size[1];

				if(!empty($cal_size[4]) || !empty($cal_size[5])) {
					$cut_pixel = 0;
					$pixel_count = (isset($srcimg_info[0]) && isset($srcimg_info[1])) ? $srcimg_info[0] * $srcimg_info[1] : 0;
					if($pixel_count >= 1600 || $dqEngine['thumb_cutpixel'] > 5) $cut_pixel = $dqEngine['thumb_cutpixel'];
					$sx1=$cut_pixel; $sy1=$cut_pixel;
					$sx2 = $cut_pixel ? ImageSX($src_img)-($cut_pixel*2) : ImageSX($src_img); 
					$sy2 = $cut_pixel ? ImageSY($src_img)-($cut_pixel*2) : ImageSY($src_img);
				} else {
					$sx1=0; $sy1=0;
					$sx2 = ImageSX($src_img);
					$sy2 = ImageSY($src_img);
				}

			if(!empty($dqEngine['thumb_color_grey'])){
				$src_img = imagecolorgrey($src_img);
			}

			if(!empty($dqEngine['upIMG_ResizeMode'])) $_thumbnail_quality = 99;

			if($_GD_VERSION >= 2) $thumb_img=imageCopyResampled(
				$dst_img,$src_img,$x1,$y1,$sx1,$sy1,$x2,$y2,$sx2,$sy2);
			if(!$thumb_img) $thumb_img = imageCopyResized(
				$dst_img,$src_img,$x1,$y1,$sx1,$sy1,$x2,$y2,$sx2,$sy2);

            $target_dir = dirname($target_file);

			if (!file_exists($target_dir)) {
				mkdirs($target_dir,$dqEngine['thumbfile_permit']);
			}

			if($_GD_VERSION >= 2  && !empty($dqEngine['using_usm']) && empty($dqEngine['upIMG_ResizeMode'])) {
				$dst_img = UnsharpMask($dst_img,$dqEngine['usm_option1'],$dqEngine['usm_option2'],$dqEngine['usm_option3']);
			}

			// 이미지 품질
			$_thumbnail_quality = $dqEngine['_thumbnail_quality'];

            if($screen_only) {
                if($_support_ImageType == 'jpg' || $_support_ImageType == 'bmp') 
                    ImageJpeg($dst_img,$_thumbnail_quality);
                elseif($_support_ImageType == 'png') ImagePng($dst_img);
                elseif($_support_ImageType == 'gif') {
                    imagetruecolortopalette($dst_img ,true , 256);
                    ImageGif($dst_img);
                }
            } else {
                if($_support_ImageType == 'jpg' || $_support_ImageType == 'bmp') 
                    if(!file_exists($_fThumbnail)) ImageJpeg($dst_img,$_fThumbnail,$_thumbnail_quality);
                elseif($_support_ImageType == 'png') ImagePng($dst_img,$_fThumbnail);
                elseif($_support_ImageType == 'gif') {
                    imagetruecolortopalette($dst_img ,true , 256);
                    ImageGif($dst_img,$_fThumbnail);
                }
            }

			if(file_exists($_fThumbnail)) @chmod($_fThumbnail,$dqEngine['thumbfile_permit']);
			ImageDestroy($dst_img);
			ImageDestroy($src_img);

//			if(file_exists($_fThumbWorkFile)) unlink($_fThumbWorkFile);
			if(file_exists($_fThumbnail)) return $_fThumbnail;
			else return $src_file;
		} 
		return $src_file;
	}

// HTML 태그를 분석하여 썸네일 생성
	function get_ThumbnailFromHTMLTag($thumb_x,$thumb_y, $tag_str, $target_file) {
		global $_SERVER, $dqEngine;

		if(!$dqEngine['using_urlImg']) return '';

		if(!chk_imgfile($target_file,$thumb_x,$thumb_y)) {
			if(file_exists($target_file)) return $target_file;
			else return;
		}
/*
	  // 링크 이미지가 로컬서버 내에 존재할때
		if(substr($_SERVER['HTTP_HOST'],0,4)=="www." && substr($_SERVER['REQUEST_URI'],0,2)!="/~")
			$HH = substr($_SERVER['HTTP_HOST'],4,strlen($_SERVER['HTTP_HOST'])); else $HH = $_SERVER['HTTP_HOST'];

		if (eregi('revol_getimg.php?id=',$tag_str) && $tag_str && eregi($HH, $tag_str) && (eregi('://'.$HH,$tag_str) || eregi('://www.'.$HH,$tag_str))){
		  // 경로나 호스트에 www.가 포함되었을때의 처리
			if(!@eregi("www.",$_SERVER['HTTP_HOST']) && eregi("www.",$tag_str)) {
				$tag_str=str_replace("www.","",$tag_str);
				$tag_str=$dqEngine['document_root']."/".eregi_replace($HH."/","",eregi_replace("http://","",$tag_str));
			} elseif(eregi("www.",$_SERVER['HTTP_HOST']) && !eregi("www.",$tag_str)) {
				$tag_str=$dqEngine['document_root']."/".eregi_replace($HH."/","",eregi_replace("http://","",$tag_str)); 
			} else $tag_str=$dqEngine['document_root']."/".eregi_replace($_SERVER['HTTP_HOST']."/","",eregi_replace("http://","",$tag_str));

			if(file_exists($tag_str)) 
				 $filename = make_thumb($thumb_x,$thumb_y,$tag_str,$target_file);
			else $filename = "";
			if(file_exists($filename)) return($filename); else return("");
		}
*/
		if($dqEngine['gd_version']) {

			$_fThumbWorkFile = $target_file.".work";
            $_fThumbWorkDir  = dirname($_fThumbWorkFile);
            if(!file_exists($_fThumbWorkDir)) mkdirs($_fThumbWorkDir);
			$fpw = fopen($_fThumbWorkFile, "w");
   			fwrite($fpw, "Get remote image works file");

			if($dqEngine['using_socket']) {
			  // 소켓 방식으로 시도
				if(!$str_info = parse_url($tag_str)) dqerr("파싱할 수 없는 URL 입니다.","이미지의 주소를 정확히 사용하지 않아서 발생한 에러입니다.<br />URL 주소의 잘못된 사용은 시스템에 치명적인 문제를 일으킬 수 있으므로 주의 하셔야 합니다.");

				set_time_limit(30);
				if($str_info['query']) $str_info['path'] = $str_info['path']."?".$str_info['query'];
				$fp=@fsockopen($str_info['host'], 80, $errno, $errstr, 10);

                if($fp) {
					$put  = 'GET '.$str_info['path'].' HTTP/1.0'."\r\n"; 
					$put .= 'Host: '.$str_info['host']."\r\n"; 
					//$put .= 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)'."\r\n";
        			$put .= 'Connection: Close'."\r\n\r\n";
                    fwrite($fp,$put);

					while(trim($buffer = fgets($fp,128)) != "") {
						if(eregi('Content-Type: ',$buffer)) $MIMEType = $buffer;
						$header .= $buffer;
					}
					fputs($fpw, $header);
					if (!eregi("200 OK",$header) || !$MIMEType) dqerr("썸네일 생성을 위해 URL이미지를 소켓으로 읽던 중 <b>$str_info[host]</b> 서버에서 거부했습니다.<br />타 사이트에서 링크하는 이미지의 사용은 모든 상황에서 가능하다는 보장이 없으므로 문제가 발생하는 서버에서의 링크는 가급적 지양해야 합니다.<br />아래는 요청한 이미지 파일의 서버측 해더정보입니다.<br /><br />","Host: $str_info[host]<br />Path: $str_info[path]<br />*<br />".nl2br($header));

					$urlfile_is_image = TRUE;
					if(phpversion() >= '4.3.0') stream_set_timeout($fp,10);
					while(!feof($fp)) {
						$urlFile .= fgets($fp,1024);
					}
                    if(phpversion() >= '4.3.0') {
                      $info = stream_get_meta_data($fp);
                      if($info['timed_out']) echo "\nConnection timed out!\n";
                    }
				}
			} else {
			// url_fopen 으로 시도
				$fp=fopen($tag_str, "r");
				$urlfile_is_image = TRUE;
				if($fp) {
					while(!feof($fp)) {
						$urlFile .= $tmp = fread($fp,1024);
					}
				}
			}

			if($fp) fclose($fp);
			fclose($fpw);
			set_time_limit(30);
			unlink($_fThumbWorkFile);

		// 임시파일 저장
			if($fp && $urlfile_is_image) {
				$_thumb_temp = tempnam("./data", "thumb_temp_");

				$fp = fopen($_thumb_temp, "w");
				fwrite($fp, $urlFile);
				fclose($fp);
				unset($urlFile);

				$filename = make_thumb($thumb_x,$thumb_y,$_thumb_temp,$target_file);
				if (!file_exists($filename)) $filename="";
				$rt_str = $filename;
			}

			if(file_exists($_thumb_temp)) @unlink($_thumb_temp);
		} else $rt_str = &$tag_str; //if $dqEngine['gd_version']
		return $rt_str;
	}

// 생성될 썸네일 이미지의 크기계산
	function cal_thumb_size($src_file, $max_x,$max_y) {
		global $dqEngine;

		static $oldInfo = array();
		if(!isset($oldInfo[0])) $oldInfo[0]='';
		if(!isset($oldInfo[1])) $oldInfo[1]='';
		if(!isset($oldInfo[2])) $oldInfo[2]='';
		if(!isset($oldInfo[3])) $oldInfo[3]='';
		if($src_file == $oldInfo[3] && $max_x == $oldInfo[0] && $max_y == $oldInfo[1]) {
			$cal_size = $oldInfo;
			return $cal_size;
		}

		$img_info = @getimagesize ($src_file);
		$sx = $img_info[0];
		$sy = $img_info[1];

	// 원본 이미지에 문제가 있다면 중단
		if(!$src_file || !$sx || !$sy) return false;

		if(!$dqEngine['gd_version'] && $dqEngine['thumb_resize'] > 2) $dqEngine['thumb_resize'] = 1;
		
		if(empty($dqEngine['thumb_resize'])) $dqEngine['thumb_resize']=null;
		switch($dqEngine['thumb_resize']) {
		case 0: // 원본의 비율대로 대칭 리사이즈
			if($max_x != 0 && $max_y != 0) {
				if($sx>$sy) {
						$cal_size[1]=ceil(($sy*$max_x)/$sx);
						$cal_size[0]=$max_x;
						if($cal_size[1] > $max_y) {
							$cal_size[0]=ceil($sx*$max_y/$sy);
							$cal_size[1]=$max_y;
						} 
				}else {
						$cal_size[0]=ceil($sx*$max_y/$sy);
						$cal_size[1]=$max_y;
						if($cal_size[0] > $max_x) {
							$cal_size[1]=ceil($sy*$max_x/$sx);
							$cal_size[0]=$max_x;
						} 
				}
			}

			if($max_x==0 || $max_y==0) {
				$tmp_y=ceil(($sy*$max_x)/$sx);
				$tmp_x=ceil(($sx*$max_y)/$sy);
				if($max_x>$max_y) {
					if($sy>$tmp_y) $cal_size[1]=$tmp_y; else $cal_size[1]=$sy;
					if($sx>$max_x) $cal_size[0]=$max_x; else $cal_size[0]=$sx;
				}else {
					if($sx>$tmp_x) $cal_size[0]=$tmp_x; else $cal_size[0]=$sx;
					if($sy>$max_y) $cal_size[1]=$max_y; else $cal_size[1]=$sy;
				}
			}
			break;

		case 1:  // 지정된 크기로 리사이즈 한다.
			$cal_size[0] = $max_x;
			$cal_size[1] = $max_y;
			break;

		case 2:  // 원본리사이즈를 하면서 지정한 사이즈에 꽉 차는 이미지를 만들고 나머지는 잘라낸다.
			$cal_size[0] = $max_x;
			$cal_size[1] = $max_y;
			if($sx == $sy) {
				if($max_x>$max_y) $cal_size[5] = $max_x; 
				else $cal_size[4] = $max_y;
			} else {
				if($sx>$sy && $max_x>$max_y) {$org_y=$max_y; $max_y = 0;}
				elseif($sx<$sy && $max_x<$max_y) {$org_x=$max_x; $max_x = 0;}
				else {
					if($sx>$sy) {$org_x=$max_x; $max_x = 0;}
					if($sx<$sy) {$org_y=$max_y; $max_y = 0;}
				}

				if($max_x==0 || $max_y==0) {
					$tmp_y=ceil(($sy*$max_x)/$sx);
					$tmp_x=ceil(($sx*$max_y)/$sy);
					
					if(empty($org_y)) $org_y=null;
					if($tmp_y < $org_y) {
						$tmp_y = $org_y;
						$org_x=$max_x; $max_x = 0;
						$tmp_x=ceil(($sx*$org_y)/$sy);
					} elseif($tmp_x < $org_x) {
						$tmp_x = $org_x;
						$org_y=$max_y; $max_y = 0;
						$tmp_y=ceil(($sy*$org_x)/$sx);
					}
					if($max_x>$max_y) {
						if($sy>$tmp_y || $max_y<$tmp_y) $cal_size[5]=$tmp_y; else $cal_size[5]=$sy;
						if($sy<$tmp_y) $cal_size[5]=$tmp_y;
						if($sx<$max_x) $cal_size[4]=$tmp_x;
					}else {
						if($sx>$tmp_x || $max_x<$tmp_x) $cal_size[4]=$tmp_x; else $cal_size[4]=$sx;
						if($sx<$tmp_x) $cal_size[4]=$tmp_x;
						if($sy<$tmp_y) $cal_size[5]=$tmp_y;
					}
				}
				break;
			}
		}

		$cal_size[3]=$src_file;
		$oldInfo = $cal_size;
		$dqEngine['thumbImgSize'] = $cal_size;
		return $cal_size;
	}

// 썸네일을 생성해야 할 파일인지 검사
	function chk_imgfile($src_file,$thumb_x,$thumb_y) {
		$new_file=true;
		$tmp=0;
		if (file_exists($src_file)) {
			$old_img = @getimagesize($src_file);
			$cal_size = cal_thumb_size($src_file, $thumb_x, $thumb_y);
			if ($old_img[0]!=$cal_size[0]) $tmp++;
			if ($old_img[1]!=$cal_size[1]) $tmp++;
			if ($tmp>0) $new_file=true; else $new_file=false;

			if(!$old_img[0] || !$old_img[1]) $new_file=true;
		}
		$workFile = $src_file.".work";
		if(file_exists($workFile)) $new_file = false;
		return $new_file;
	}

// 문서에서 제로보드 그림창고 태그 변환하기
	function convt_imagebox($tmp, $ismember) {
		$_zb_url = get_zbURL();

		$imageBoxPattern = "/\[img\:(.+?)\.(jpg|gif|bmp|psd|jpeg)\,align\=([a-z]){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
		$tmp=preg_replace($imageBoxPattern,"<img src=\"$_zb_url"."icon/member_image_box/$ismember/\\1.\\2\">", stripslashes($tmp));
		//$tmp=str_replace("src='icon/member_image_box/","src='$_zb_url"."icon/member_image_box/",$tmp);

		return $tmp;
	}

// 문서에서 이미지태그 추출
	function get_imgTag($tmp, $ismember, $num='1', $urlOnly=false) {
		$flag=null;
		$j=0;
		$tmp=convt_imagebox($tmp, $ismember);
		$prtstr=array();

		for($i=0; $i<$num; $i++) {
			for($j=$j; $j<strlen($tmp); $j++){ 
				if($flag==0 && $tmp[$j] == '<' && strtolower(substr($tmp,$j+1,4)) == 'img ') $flag=1; 
				if($flag==0 && $tmp[$j] == '<' && strtolower(substr($tmp,$j+1,6)) == 'image ') $flag=1; 
				if($flag==1 && $tmp[$j] != '>') $prtstr[$i] = $tmp[$j]; 
				if($flag==1 && $tmp[$j] == '>') {
                  $prtstr[$i] .= $tmp[$j]; 
                  if($urlOnly) {
                    $prtstr[$i] = get_urlPath($prtstr[$i]);
                    $prtstr[$i] = str_replace(get_zbURL(),'',$prtstr[$i]);
                  }
                  $j++;	
                  break;
                }
			}
			$flag=0;
		}
		if(!empty($prtstr)) return $prtstr;
	}

// 문자열에서 url경로 추출
	function get_urlPath($str) {
		if(eregi("\.jpg",$str))  $_file_type = '.jpg';
		if(eregi("\.jpeg",$str)) $_file_type = '.jpeg';
		if(eregi("\.gif",$str))  $_file_type = '.gif';
		if(eregi("\.png",$str))  $_file_type = '.png';
		if(eregi("\.bmp",$str))  $_file_type = '.bmp';
		if(eregi("\.wmf",$str))  $_file_type = '.wmf';

		$old_autoResize_text   = ' name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)';
		$str = str_replace($old_autoResize_text,'',$str);
		$str = str_replace('&nbsp;',' ',$str);
		if(!empty($_file_type)) $str = substr($str,0,strpos(strtolower($str),$_file_type)+(strlen($_file_type)+1));

		if(!eregi('\?',$str)) 
		{
			$str = str_replace(' ','_DQ_TEMP_STRING_',$str);
			$str = str_replace('%20','_DQ_TEMP_STRING_',$str);
		}

		//$link_pattern = ";(http|https|ftp)://([-/.a-zA-Z0-9_~#%$?&=:200-377()]+);si";
		$link_pattern = ";src( *?)=( *?)(\"|\')?((http|https|ftp)://)?([/.?\xA1-\xFEa-zA-Z0-9:_\-]+[.][/?\xA1-\xFEa-zA-Z0-9,:\;&#=_~%()\[\]?\/.,+\*\-]+);i";
		preg_match($link_pattern,$str,$ret);
		if(empty($ret[4])) $ret[4]='';
		if(empty($ret[6])) $ret[6]='';
		$str = $ret[4].$ret[6];
		
		$_zb_url = get_zbURL();
		//$server_os  = get_serverOS();
		if(!eregi($_zb_url,$str)) $str = str_replace("_DQ_TEMP_STRING_","%20",$str);
		$str = str_replace("_DQ_TEMP_STRING_"," ",$str);
		if(eregi("^/",$str)) $str = 'http://'.$GLOBALS['_SERVER']['HTTP_HOST'].$str;

		return $str;
	}

// url을 절대경로로 반환
	function get_url2realpath($str) {
		$_http_host_url = $_SERVER['HTTP_HOST'];

		if(substr($_http_host_url,0,4)!="www.") {
			$_http_host1 = 'http://'.$_http_host_url;
			$_http_host2 = 'http://www.'.$_http_host_url;
		} else {
			$_http_host1 = 'http://'.substr($_http_host_url,4,strlen($_http_host_url));
			$_http_host2 = 'http://'.$_http_host_url;
		}

		$_getImageURL = str_replace($_http_host1,'',str_replace('www.','',$str));
		//$_getImageURL = str_replace($_http_host2,"",$str);
		if(eregi("^/",$_getImageURL)) $str_chkImage = $dqEngine['document_root'].$_getImageURL; else $str_chkImage = $_getImageURL;

		return $str_chkImage;
	}

// url인코딩
	function dq_urlencode($url_path) {
		global $dqEngine;
		$url_q='';
		if(!$dqEngine['using_urlenc']) return $url_path;

		$url_temp=parse_url(trim($url_path));
		if(!empty($url_temp['query'])) $url_q="?".$url_temp['query'];
		$url=str_replace($url_q,"",trim($url_path));
		$url_temp=str_replace("%3A",":",str_replace("%2F","/",str_replace("%25","%",rawurlencode($url))));
		$url=$url_temp.$url_q;

		return $url;
	}

// PHP 설정 가져오기
	function phpinfo_array() {
		static $phpinfo_array = array();
		if (empty($phpinfo_array)) {
			ob_start();
			phpinfo();
			$phpinfo = ob_get_contents();
			ob_end_clean();
			$phpinfo_array = explode("\n", $phpinfo);
		}
		return $phpinfo_array;
	}

	function get_exif_info() {
		static $exif_info = array();
		if (empty($exif_info)) {
			$exif_info = array(
				'EXIF Support'           => '',
				'EXIF Version'           => '',
				'Supported EXIF Version' => '',
				'Supported filetypes'    => ''
			);
			$phpinfo_array = phpinfo_array();
			foreach ($phpinfo_array as $line) {
				$line = trim(strip_tags($line));
				foreach ($exif_info as $key => $value) {
					if (strpos($line, $key) === 0) {
						$newvalue = trim(str_replace($key, '', $line));
						$exif_info[$key] = $newvalue;
					}
				}
			}
		}
		return $exif_info;
	}

	function get_GDVersion($fullstring=0) {
		static $cache_gd_version = array();
		if (empty($cache_gd_version)) {
			$gd_info = get_GDInfo();
			if (substr($gd_info['GD Version'], 0, strlen('bundled (')) == 'bundled (') {
				$cache_gd_version[1] = $gd_info['GD Version'];
				$cache_gd_version[0] = (float) substr($gd_info['GD Version'], strlen('bundled ('), 3);
			} else {
				$cache_gd_version[1] = $gd_info['GD Version'];
				$cache_gd_version[0] = (float) substr($gd_info['GD Version'], 0, 3);
			}
		}
		return $cache_gd_version[intval($fullstring)];
	}

	function get_GDInfo() {
		if (function_exists('gd_info')) {
			return gd_info();
		}

		static $gd_info = array();
		if (empty($gd_info)) {
			$gd_info = array(
				'GD Version'         => '',
				'FreeType Support'   => false,
				'FreeType Linkage'   => '',
				'T1Lib Support'      => false,
				'GIF Read Support'   => false,
				'GIF Create Support' => false,
				'JPG Support'        => false,
				'PNG Support'        => false,
				'WBMP Support'       => false,
				'XBM Support'        => false
			);

			$phpinfo_array = phpinfo_array();
			foreach ($phpinfo_array as $line) {
				$line = trim(strip_tags($line));
				foreach ($gd_info as $key => $value) {
					if (strpos($line, $key) === 0) {
						$newvalue = trim(str_replace($key, '', $line));
						$gd_info[$key] = $newvalue;
					}
				}
			}

			if (empty($gd_info['GD Version'])) {
				if (function_exists('ImageTypes')) {
					$imagetypes = ImageTypes();
					if ($imagetypes & IMG_PNG) {
						$gd_info['PNG Support'] = true;
					}
					if ($imagetypes & IMG_GIF) {
						$gd_info['GIF Create Support'] = true;
					}
					if ($imagetypes & IMG_JPG) {
						$gd_info['JPG Support'] = true;
					}
					if ($imagetypes & IMG_WBMP) {
						$gd_info['WBMP Support'] = true;
					}
				}
				if (function_exists('ImageCreateFromGIF')) {
					if ($tempfilename = tempnam(null, '_thumb_')) {
						if ($fp_tempfile = @fopen($tempfilename, 'wb')) {
							fwrite($fp_tempfile, base64_decode('R0lGODlhAQABAIAAAH//AP///ywAAAAAAQABAAACAUQAOw=='));
							fclose($fp_tempfile);
							$gd_info['GIF Read Support'] = (bool) @ImageCreateFromGIF($tempfilename);
						}
						unlink($tempfilename);
					}
				}
				if (function_exists('ImageCreateTrueColor') && @ImageCreateTrueColor(1, 1)) {
					$gd_info['GD Version'] = '2.0.1 or higher (assumed)';
				} elseif (function_exists('ImageCreate') && @ImageCreate(1, 1)) {
					$gd_info['GD Version'] = '1.6.0 or higher (assumed)';
				}
			}
		}
		return $gd_info;
	}

    function revolution_cache_clear() {
        global $dqEngine, $s_data, $data;
        $_cacheFile = $dqEngine['document_root'].'/_indexcache/indexpage.dat';
        if(file_exists($_cacheFile)) unlink($_cacheFile);
        $member = !empty($s_data['ismember']) ? $s_data['ismember'] : $data['ismember'];
        $_cacheFile = $dqEngine['document_root'].'/_commentcache/'.$member.'.dat';
        if(file_exists($_cacheFile)) unlink($_cacheFile);
    }
?>
