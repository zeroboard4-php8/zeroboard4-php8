<?php 
function exiflist($exif_file) {
  global $dir,$_exif_error_check;
  $_exif_filenames = $exif_file;

  if(file_exists($_exif_filenames)) {
    if(eregi("\.jpg|\.jpeg",$_exif_filenames)) {
		$Flash = array('Did not fire','Fired');
		$Exposure = array('자동','수동','프로그램','조리개우선','셔터우선','정물사진모드','스포츠모드','인물사진모드','풍경사진모드');
		$Metering = array('','평균평가측광','중앙부중점측광','스팟측광','멀티스팟측광','패턴측광','부분측광');
		$_exif_info = exif_read_data($_exif_filenames, 'IFD0');
		if ($_exif_info) {
			$ImgInfo = "<b>&nbsp;&nbsp;</b>";
			$ImgInfo = isset($_exif_info['DateTimeOriginal']) ? $ImgInfo."촬영일시: ".$_exif_info['DateTimeOriginal']."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['Model']) ? $ImgInfo."카메라 모델: ".$_exif_info['Make'].' '.$_exif_info['Model']."<br><b>&nbsp;&nbsp;</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['ExposureTime']) ? $ImgInfo."노출 시간: ".$_exif_info['ExposureTime']."초"."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['COMPUTED']['ApertureFNumber']) ? $ImgInfo."F 번호: ".$_exif_info['COMPUTED']['ApertureFNumber']."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['ISOSpeedRatings']) ? $ImgInfo."ISO 속도: "."ISO-".$_exif_info['ISOSpeedRatings']."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['FocalLength']) ? $ImgInfo."초점길이: ".$_exif_info['FocalLength']."<br>"."<b>&nbsp;&nbsp;</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['Flash']) ? $ImgInfo."플래쉬: ".$Flash[($_exif_info['Flash'] & 1) != 0]."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['ExposureProgram']) ? $ImgInfo."프로그램 모드: ".$Exposure[$_exif_info['ExposureProgram']]."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['MeteringMode']) ? $ImgInfo."측광모드: ".$Metering[$_exif_info['MeteringMode']]."<b>&nbsp;&nbsp;ㆍ</b>" : $ImgInfo.'';
			$ImgInfo = isset($_exif_info['ExposureBiasValue']) ? $ImgInfo."노출보정: ".$_exif_info['ExposureBiasValue'] : $ImgInfo.'';

			//return $ImgInfo;
			if (strcmp($ImgInfo, '<b>&nbsp;&nbsp;</b>') !== 0) {
				echo "<table cellpadding=0 cellspacing=0 border=0>";
				echo "<tr><td height=1 class=line2 style=height:1px><img src=$dir/t.gif border=0 height=1></td></tr>";
				echo "<tr class=exif_bg><td style=padding-right:10px;><font class=thumb_han>$ImgInfo</font></td></tr>";
				echo "<tr><td height=5><img src=$dir/t.gif border=0 height=5></td></tr></table>";
			}
		}
//		else {
//			$ImgInfo = $ImgInfo."<font color=#999999>촬영정보가 없는 이미지입니다.</font>";
//		}
	}
}	

}

?>
