<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
function mmplay($filename, $id="", $playcount='99') {
	global $member;

	if(eregi("msie",getenv("HTTP_USER_AGENT"))) $ie="1"; else $ie="0";

	if(!is_mediafile($filename)) return "";

	$music = explode("@",$filename);
	if(substr($music[0],0,7)=='http://') $music[0] = dq_urlencode($music[0]);

	if(eregi("\.swf",$music[0])) {?>
	  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="0" height="0"><param name="menu" value="false"><param name="wmode" value="transparent"><param name="movie" value="<?=$music[0]?>"><param name="quality" value="low"><param name="LOOP" value="false"><embed src="<?=$music[0]?>" quality="low" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="0" height="0" loop="false" wmode="transparent" menu="false"></embed></object>
	<? } else {?>
		<embed src="<?=$music[0]?>" id="<?=$id?>"<?php if($ie){?> playcount="<?=$playcount?>" autostart="<?php if(!is_null($member['music_play']) &&  $member['music_play']==0){?>0<?php }else{?>1<?php }?>"<?php }?> style="width:0px; height:0px"></embed>
<?php	}
}


function is_mediafile($string) {
	$info = explode("@",$string);
	if(ereg("\.mid|\.mp3|\.wma|\.asf|\.asx|\.wmv|\.mpa|\.wav|/link_player\.aspx|bugs\.co\.kr|\.swf", strtolower($info[0]))) return true;
}

function chk_previmage($string) {
	if(ereg("\.jpg|\.gif|\.png", strtolower($string))) 
		return "preview_write.jpg";
	else return "preview_app.gif";
}

function get_musicinfo($string) {
	$info = explode("@",$string);
	return $info;
}

function get_voteUsers($id,$no,$view_info) {
	global $member, $connect;
	$result = zb_query("select vote_users from dq_revolution where zb_id='$id' and zb_no='$no'",$connect);
	$vote_users = mysql_fetch_row($result);
	if(empty($vote_users[0])) return;

	$vote_users = trim($vote_users[0]);
	$tmp = explode("<",$vote_users);
	$v_users[0] = '';
	$v_users[2] = count($tmp)-1;

	$v_users[1] = ",";
	for($i=1; $i<count($tmp); $i++) {
		if($i>20) {$v_users[0] .= " , ..."; break;}
		if($i>1) $v_users[0] .= " , ";

		$tmp2 = explode(">",$tmp[$i]);

		if($member['no'] && $view_info) $v_users[0] .= "<span onClick=\"window.open('view_info2.php?member_no=$tmp2[0]','view_info','width=400,height=510,toolbar=no,scrollbars=yes');\" style=\"cursor:pointer\" title=\"회원정보 보기\">".stripslashes($tmp2[1])."</span>";
		else $v_users[0] .= stripslashes($tmp2[1]);

		$v_users[1] .= $tmp2[0].",";
	}
	return $v_users;
}

function get_newComment($no) {
	global $t_comment, $id, $skin_setup;
	$dtime = time()-(60 * $skin_setup['cmtTimeAlertValue']);
	$data=@mysql_fetch_array(zb_query("select count(no) from $t_comment"."_$id where parent='$no' and reg_date > $dtime order by no"));
	return $data[0];
}

function getFileIcon() 
{
	global $data, $dir, $setup, $member, $id;

// 업로드된 이미지 목록을 배열로 저장
	$tmp = get_uploadImages($data,1);
	$filenum='';
    if(!empty($data['is_vdel']) || !empty($data['is_secret'])) return;
	
	$tmp00 = isset($tmp[0][0]) ? $tmp[0][0] : '';
	$filename = $data['file_name1'] ? $data['file_name1'] : ($data['file_name2'] ? $data['file_name2'] : $tmp00);
    $filename = dq_urlencode($filename);

	if($filename) {
		$fileInfo = pathinfo(strtolower($filename));
		if(file_exists($dir.'/file_icon/'.$fileInfo['extension'].'.gif')) $ret = $fileInfo['extension'];
	}
	$ret = !empty($ret) ? $dir.'/file_icon/'.$ret : '';
	if($filename && !$ret) $ret = $dir.'/file_icon/'.'unknown';
	if($ret) $ret = '<img src="'.$ret.'.gif'.'" border="0" />';
	if($setup['grant_view'] >= $member['level'] || $is_admin) {
		if($data['file_name1']) $filenum = '1';
		elseif($data['file_name2']) $filenum = '2';
		$dlink="revol_download.php?id=$id&no=$data[no]&filenum=$filenum";
		if($filenum && !eregi("jpe?g|bmp|gif|png|wmf",$fileInfo['extension'])) 
			$ret = '<a href="'.$dlink.'">'.$ret.'</a>';
		else {
			if(is_array($tmp00)) {
				$filenum = count($tmp00) - 1;
			} else {
				$filenum = 0;
			}
			$ret = str_replace('/>', 'onClick="return hs.expand(this,{src:\''.get_zbURL()."revol_getimg.php?id=$id&no=$data[no]&num=$filenum".'\'})" style="cursor:pointer" />', $ret);
		}
	}
	return $ret;
}

function is_vdel($zbid, $zbno) {
	$result = mysql_fetch_array(zb_query("select is_vdel from dq_revolution where zb_id='$zbid' and zb_no='$zbno'"));
	$result = $result[0];
	return $result;
}

// cgi 관련 파일인지 검사
	function chk_cgifile($filename) {
		$no_names = "\.htaccess$|\.php$|\.html$|\.inc$|\.phtm$|\.htm$|\.shtm$|\.ztx$|\.dot$|\.asp$|\.cgi$|\.pl$";
		if(eregi($no_names,$filename)) error("HTML,CGI 관련파일은 업로드할 수 없습니다.");
	}

	function addSlashes4JS($str) 
	{
		$str = htmlSpecialChars($str);
		$str = addslashes($str);
		$str = nl2br($str);
		$str = str_replace("\r","",$str);
		$str = str_replace("\n","",$str);
		return $str;
	}

function json_encode_dq($_SS) {
    static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
    $JSON = '{';
    foreach ( $_SS as $key => $value ) 
    {
      if(!empty($flag)) $JSON .= ',';
      if (is_string($value)) $value = str_replace($jsonReplaces[0], $jsonReplaces[1], $value);

      if(is_array($value)) $JSON .= '"'.$key.'":'.json_encode_dq($value);
      else $JSON .= '"'.$key.'":"'.$value.'"';
      $flag = 1;
    }
    $JSON .= '}';
    return $JSON;
}

if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

// exif 추출
function exiflist($image_file, $return = false) 
{
  global $_zb_path, $dir, $_LIBS_include_dir;

  if(!file_exists($image_file) || !eregi("\.jpe?g$",$image_file)) return;
  if(!function_exists('exif_read_data')) return;

  if(eregi("windows",get_serveros())) {
    $image_file= str_replace("/","\\",$_zb_path).str_replace("/","\\",$image_file); 
  } else {
    $image_file = $_zb_path.$image_file;
  }

  $exif_info = exif_read_data($image_file, 'IFD0');;
  if(empty($exif_info['Model'])) return;

  $spacer = "<b class=\"exif_spacer\"> | </b>";
  $ExMode = array('Auto exposure','Manual exposure','Auto bracket');
  $Exposure = array('자동','수동','프로그램','조리개우선','셔터우선','정물사진모드','스포츠모드','인물사진모드','풍경사진모드');
  $Metering = array('','평균평가측광','중앙부중점측광','스팟측광','멀티스팟측광','패턴측광','부분측광');
  $WB = array('WB Auto','WB Manual');
  $Flash = array('Flash did not fire','Flash fired');
  
  if(!empty($exif_info['Make']))				$ImgInfo = $exif_info['Make'].$spacer;
  if(!empty($exif_info['Model']))				$ImgInfo = $ImgInfo.$exif_info['Model'].$spacer;
  if(!empty($exif_info['DateTimeOriginal']))	$ImgInfo = $ImgInfo.preg_replace("/:/", "/", $exif_info['DateTimeOriginal'], 2).'<br>';

  if(!empty($exif_info['ExposureProgram']))	$ImgInfo .= $Exposure[$exif_info['ExposureProgram']];
  if(!empty($exif_info['MeteringMode']))		$ImgInfo .= $spacer.$Metering[$exif_info['MeteringMode']];
  if(!empty($exif_info['WhiteBalance']))		$ImgInfo .= $spacer.$WB[$exif_info['WhiteBalance']];
  if(!empty($exif_info['ExposureTime(sec)']))	$ImgInfo .= $spacer.$exif_info['ExposureTime(sec)'].'s';
  if(!empty($exif_info['COMPUTED']['ApertureFNumber']))			$ImgInfo .= $spacer.$exif_info['COMPUTED']['ApertureFNumber'];
  if(!empty($exif_info['ExposureBiasValue']))	$ImgInfo .= $spacer.'노출보정 '.$exif_info['ExposureBiasValue'];
  if(!empty($exif_info['ISOSpeedRatings']))			$ImgInfo .= $spacer.'ISO-'.$exif_info['ISOSpeedRatings'];
  if(!empty($exif_info['FocalLength']))	$ImgInfo .= $spacer.$exif_info['FocalLength'].'mm';
  if(!empty($exif_info['FocalLengthIn35mmFilm'])) $ImgInfo .= $spacer.'35mm equiv '.$exif_info['FocalLengthIn35mmFilm'].'mm';
  if(!empty($exif_info['Flash'])){ 
    $flashfired = ($exif_info['Flash'] & 1) != 0;
    $ImgInfo .= $spacer.$Flash[$flashfired];
  }

  if(empty($ImgInfo)) return;

  $ret = "\r<div class=\"exif_bg\" align=\"left\">";
  $ret .= $ImgInfo;
  $ret .= "</div>\n";
  return $ret;
}

function array_iconv($arr,$s, $t) {
    foreach( $arr as $k => $var ) {
      if(is_array($var)) $str[$k] = array_iconv($var,$s, $t);
      else $str[$k] = iconv($s,$t,$var);
    }
    return $str;
}

if (!function_exists('iconv'))
{ // iconv 명령어가 없을때 대체하는 php코드 불러오기
  require realpath(dirname(__FILE__)).'/iconv.php';
}
?>
