<!-- 
------------------------------------------------------------------------------------
■ DQ Engine ver 1.2    제작: 드림퀘스트(dwander@netian.com / http://www.dqstyle.com)
------------------------------------------------------------------------------------

이 모듈은 제로보드용 스킨에서 GD라이브러리를 이용하여 섬네일을 생성하기위한 함수를 정의한것입니다.
소스를 수정하여 재배포 하거나 일부를 발췌하여 사용하기 위해서는 제작자인 "드림퀘스트"의 사전 허락를 받아야 합니다.
이점 숙지하시기 바라며 본 스킨을 사용하시는 것은 이에 동의하는것으로 간주합니다.
이 파일을 수정없이 다른스킨의 모듈로써 사용하는것은 자유롭습니다만 스킨의 라이센스 부분에
"<a href=http://www.dqstyle.com target=_blank>DQ Engine Used</a>", 혹은 "Thumb Engine by <a href=http://www.dqstyle.com target=_blank>드림퀘스트</a>"를 추가해 주셔야 합니다.
이 라이센스 문구는 삭제불가 입니다.

-->

<?php 
function make_thumb($max_x,$max_y,$src_file,$memo="") {
	global $id, $cal_size;
	if (file_exists($src_file)) {
		cal_thumb_size($src_file, $max_x, $max_y);
		if (eregi($_SERVER['DOCUMENT_ROOT'],$src_file)) $src_file=eregi_replace($_SERVER['DOCUMENT_ROOT'],"",$src_file);
		return($src_file);
	}
}

function cal_thumb_size($src_file, $max_x,$max_y) {
	global $cal_size;

	$img_info = getimagesize ($src_file);
	$sx = $img_info[0];
	$sy = $img_info[1];

	if ($sx>$max_x || $sy>$max_y) {
		if ($sx>$sy) {
				$cal_size[1]=ceil(($sy*$max_x)/$sx);
				$cal_size[0]=$max_x;
		} else {
				$cal_size[0]=ceil(($sx*$max_y)/$sy);
				$cal_size[1]=$max_y;
		}
	} else {
		$cal_size[1]=$sy;
		$cal_size[0]=$sx;
	}
	$cal_size[3]=$src_file;
	return $cal_size;
}

function chk_imgfile($src_file,$_dq_imagex,$_dq_imagey) {
	unset($new_file);

	if (file_exists($src_file)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
		$old_img = getimagesize($src_file);
		$cal_size = cal_thumb_size($src_file, $_dq_imagex, $_dq_imagey);
		if($old_img[0] != $cal_size[0]) $new_file=true; else $new_file=false;
		if($old_img[1] != $cal_size[1]) $new_file=true; else $new_file=false;
	} else {
		$new_file=true;
	}
	return $new_file;
}

function chk_imgtag($_dq_imagex,$_dq_imagey,$memo) {
	global $data, $id, $HTTP_HOST, $PHP_SELF;

	//글 내용의 태그를 분석하여 이미지 링크를 찾아 섬네일로 만들기
	$_dq_oldFile="data/$id/urlFile_".$memo['no'].".thumb";
	if (!file_exists($_dq_oldFile)) {
		$_zboard_url = "http://".$HTTP_HOST.eregi_replace(basename($PHP_SELF),"",$PHP_SELF);
		$tmp = $memo['memo'];
		$flag = 0; 
		unset($prtstr);
		$imageBoxPattern = "/\[img\:(.+?)\.(jpg|gif)\,align\=([a-z]){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
		$tmp=preg_replace($imageBoxPattern,"<img src='$_zboard_url"."icon/member_image_box/{$memo['ismember']}/\\1.\\2' align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>", stripslashes($tmp));

		for ($_j = 0; $_j<=strlen($tmp); $_j++) { 
			if($flag==0 && $tmp[$_j] == '<' && strtolower(substr($tmp,$_j+1,3)) == 'img') $flag=1; 
			if($flag==1 && $tmp[$_j] != '>') $prtstr.=$tmp[$_j]; 
			if($flag==1 && $tmp[$_j] == '.' && strtolower(substr($tmp,$_j+1,3)) == 'jpg') $_file_type=substr($tmp,$_j,4); 
			if($flag==1 && $tmp[$_j] == '.' && strtolower(substr($tmp,$_j+1,3)) == 'gif') $_file_type=substr($tmp,$_j,4); 
			if($flag==1 && $tmp[$_j] == '.' && strtolower(substr($tmp,$_j+1,3)) == 'png') $_file_type=substr($tmp,$_j,4); 
			if($flag==1 && $tmp[$_j] == '>') { $prtstr.=$tmp[$_j]; break; } 
		} 
		if (!empty($prtstr)) {
			$prtstr=strstr(stripslashes($prtstr),"=");
			$prtstr=trim(str_replace("=","",str_replace("\"","",str_replace("'","",$prtstr))));
			$prtstr=str_replace(strstr($prtstr,$_file_type),"",$prtstr).$_file_type;

			$_thumb_temp = $_dq_oldFile;
			if (strtolower($_file_type)==".gif") $_thumb_temp=$_dq_oldFile;

			if (eregi($HTTP_HOST, $prtstr) && $prtstr){
				$prtstr=$_SERVER['DOCUMENT_ROOT'].eregi_replace($HTTP_HOST,"",eregi_replace("http://","",$prtstr));
				$filename = make_thumb($_dq_imagex,$_dq_imagey,$prtstr,$memo);
				return ($filename);
			} elseif ($_thumb_temp == $_dq_oldFile && file_exists($_dq_oldFile)) {
				cal_thumb_size($_dq_oldFile, $_dq_imagex, $_dq_imagey);
				return ($_dq_oldFile);
			} elseif (!empty($prtstr)) {
				$fp = fopen($prtstr, "r");
				while(!feof($fp) && connection_status()==0) {
					$urlFile = $urlFile.fread ($fp, 1024*8);
					flush();
				}
				fclose($fp);

				$fp = fopen($_thumb_temp, "w");
				fwrite($fp, $urlFile);
				fclose($fp);
				//$filename = make_thumb($_dq_imagex,$_dq_imagey,$_thumb_temp,$memo);
				//unlink($_thumb_temp);
				//return ($filename);
			}
		}
	} 
	//====== no_GD 전용 ============================================
	if (file_exists($_dq_oldFile)) {
		cal_thumb_size($_dq_oldFile, $_dq_imagex,$_dq_imagey);
		return($_dq_oldFile);
	}
	//====== no_GD 전용 ============================================
}
?>
