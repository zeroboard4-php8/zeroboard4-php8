<?php 
    $image_id = isset($_GET['file']) ? $_GET['file'] : false;
	$no = isset($_REQUEST['no']) ? $_REQUEST['no'] : null;
	$file = isset($_GET['file']) ? $_GET['file'] : null;
	$realname = isset($_GET['realname']) ? $_GET['realname'] : null;	

    //라이브러리 인클루드
    $current_dir = getcwd();
    chdir('../../../../');
    //require 'lib.php';
	@session_start();
    $_inclib_01 = $current_dir.'/../../include/dq_thumb_engine2.';
    if(file_exists($_inclib_01.'php') && filesize($_inclib_01.'php')) require $_inclib_01.'php';
    else require $_inclib_01.'zend';
	
    if ($image_id === false || ($no && intval($no) < 1)) {
		header("HTTP/1.1 500 Internal Server Error");
		exit(0);
	} elseif(!eregi("^data",$image_id) && !eregi('revol_getimg.php',$image_id)) {
      $uploadDir = './data/__DQ_Revolution_MultiUpload_TempDir__/';
      $_ufile_session = get_uploadFileSession($uploadDir);
      $image_id = $uploadDir.$_ufile_session[$image_id];
    }
    
    if(eregi('revol_getimg.php',$image_id)) 
    {
      require_once 'lib.php';
      dbconn();
      $result = zb_query("select * from $t_board"."_$id where no=$no") or die(zb_error());
      $data   = mysql_fetch_array($result);

      //업로드된 파일 목록을 배열로 저장
      $tmp       = @get_uploadImages($data,999,1,0);
      $images	 = $tmp[0];
      $image_id  = $images[$num];
    }

    if (!file_exists($image_id)) {
        header("HTTP/1.1 404 Not found");
		exit(0);
	}

    $target_width  = 90;
    $target_height = 90;

    $imginfo  = @getimagesize($image_id);
    $pathInfo = pathinfo($realname);
    $iconFile = realpath(dirname(__FILE__)).'/fileicon/'.strtolower($pathInfo['extension']).'.png';
    if(!file_exists($iconFile)) $iconFile = realpath(dirname(__FILE__)).'/fileicon/binary.png';
    if(!$imginfo[0]) {
      $image_id = $iconFile;
      $imginfo  = getimagesize($image_id);
      $color    = 1;
    }

    switch($imginfo[2]) {
      case 1 :
        $img = @imagecreatefromgif($image_id);
        break;
      case 2 :
        $img = @imagecreatefromjpeg($image_id);
        break;
      case 3 :
        $img = @imagecreatefrompng($image_id);
        break;
      case 6 :
        $img = @ImageCreateFromBMP2($image_id);
        break;
    }
    if (!$img) {
        /*
        header("HTTP/1.1 500 Internal Server Error");
        echo "could not create image handle";
        exit(0);
        */
        $iconFile = realpath(dirname(__FILE__)).'/fileicon/'.strtolower($pathInfo['extension']).'.png';
        $image_id = $iconFile;
        $color    = 1;
        $img = @imagecreatefrompng($image_id);
    }

    $width  = imageSX($img);
    $height = imageSY($img);

    if (!$width || !$height) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Invalid width or height";
        exit(0);
    }

    $target_ratio  = $target_width / $target_height;

    $img_ratio = $width / $height;

    if ($target_ratio > $img_ratio) {
        $new_height = $target_height;
        $new_width = $img_ratio * $target_height;
    } else {
        $new_height = $target_width / $img_ratio;
        $new_width = $target_width;
    }

    if ($new_height > $target_height) {
        $new_height = $target_height;
    }
    if ($new_width > $target_width) {
        $new_height = $target_width;
    }

    $new_img = ImageCreateTrueColor($target_width, $target_height);
    $color = !empty($color) ? imagecolorallocate($new_img,255,255,255) : 0;
    if (!@imagefilledrectangle($new_img, 0, 0, $target_width-1, $target_height-1, $color)) 
    {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Could not fill new image";
        exit(0);
    }

    if (!@imagecopyresampled($new_img, $img, ($target_width-$new_width)/2, ($target_height-$new_height)/2, 0, 0, $new_width, $new_height, $width, $height)) {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Could not resize image";
        exit(0);
    }

    ob_start();
    imagejpeg($new_img,'',90);
    $imagevariable = ob_get_contents();
    ob_end_clean();
    echo $imagevariable;
//    usleep(round(rand(0, 100)*1000)); //0-100 miliseconds;

    exit(0);

	function ImageCreateFromBMP2($filename)
	{
	   if (! $f1 = fopen($filename,"rb")) return FALSE;

	   $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
	   if ($FILE['file_type'] != 19778) return FALSE;

	   $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
					 '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
					 '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
	   $BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
	   if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
	   $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
	   $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
	   $BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
	   $BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
	   $BMP['decal'] = 4-(4*$BMP['decal']);
	   if ($BMP['decal'] == 4) $BMP['decal'] = 0;

	   $PALETTE = array();
	   if ($BMP['colors'] < 16777216)
	   {
	   $PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
	   }

	   $IMG = fread($f1,$BMP['size_bitmap']);
	   $VIDE = chr(0);

	   $res = imagecreatetruecolor($BMP['width'],$BMP['height']);
	   $P = 0;
	   $Y = $BMP['height']-1;
	   while ($Y >= 0)
	   {
	   $X=0;
	   while ($X < $BMP['width'])
	   {
		 if ($BMP['bits_per_pixel'] == 24)
		   $COLOR = unpack("V",substr($IMG,$P,3).$VIDE);
		 elseif ($BMP['bits_per_pixel'] == 16)
		 {  
		   $COLOR = unpack("n",substr($IMG,$P,2));
		   $COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 8)
		 {  
		   $COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
		   $COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 4)
		 {
		   $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
		   if (($P*2)%2 == 0) $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);
		   $COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 1)
		 {
		   $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
		   if    (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;
		   elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;
		   elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;
		   elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;
		   elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8)>>3;
		   elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4)>>2;
		   elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2)>>1;
		   elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);
		   $COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 else
		   return FALSE;
		 imagesetpixel($res,$X,$Y,$COLOR[1]);
		 $X++;
		 $P += $BMP['bytes_per_pixel'];
	   }
	   $Y--;
	   $P+=$BMP['decal'];
	   }

	   fclose($f1);

	 return $res;
	}
?>
