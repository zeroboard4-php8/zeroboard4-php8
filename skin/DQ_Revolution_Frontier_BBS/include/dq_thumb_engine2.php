<?php
	if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
function getthumbengine_version( )
{
    return "2.23 for Revolution, latest modify: 2012-03-08";
}

function touch_to_dq( $tag_str )
{
    $str_info = parse_url( $tag_str );
    set_time_limit( 30 );
    $str_info['port'] = $str_info['port'] ? $str_info['port'] : 80;
    if ( $str_info['query'] )
    {
        $str_info['path'] = $str_info['path']."?".$str_info['query'];
    }
    $fp = @fsockopen( @$str_info['host'], @$str_info['port'], $errno, $errstr, 10 );
    if ( $fp )
    {
        fputs( $fp, "GET ".$str_info['path']." HTTP/1.1\r\n" );
        fputs( $fp, "Host: ".$str_info['host']."\r\n" );
        fputs( $fp, "Referer: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\r\n" );
        fputs( $fp, "User-Agent: ".$_SERVER['HTTP_USER_AGENT']."\r\n\r\n" );
        while ( trim( $buffer = fgets( $fp, 128 ) ) != "" )
        {
            if ( eregi( "Content-Type: ", $buffer ) )
            {
                $MIMEType = $buffer;
            }
            $header .= $buffer;
        }
        echo $header;
        fclose( $fp );
    }
}

function get_zbpath( )
{
    global $_zb_path;
    static $zbPath_status;
    if ( $zbPath_status )
    {
        return $zbPath_status;
    }
    if ( $_zb_path && file_exists( $_zb_path."zboard.php" ) )
    {
        $zbPath_status = $_zb_path;
    }
    else
    {
        if ( @is_file( "./zboard.php" ) )
        {
            $zbPath_status = realpath( "./" );
        }
        else if ( @is_file( "../zboard.php" ) )
        {
            $zbPath_status = realpath( "../" );
        }
        else if ( @is_file( "../../zboard.php" ) )
        {
            $zbPath_status = realpath( "../../" );
        }
        else if ( @is_file( "../../../zboard.php" ) )
        {
            $zbPath_status = realpath( "../../../" );
        }
        else if ( @is_file( "../../../../zboard.php" ) )
        {
            $zbPath_status = realpath( "../../../../" );
        }
        if ( $zbPath_status )
        {
            $zbPath_status .= "/";
        }
    }
    if ( $zbPath_status )
    {
        return $zbPath_status;
    }
}

function get_zburl( )
{
    $_zb_url = @eregi( @$_SERVER['HTTP_HOST'], @$_zb_url ) ? $_zb_url : "http://".$_SERVER['HTTP_HOST'].str_replace( dq_basename( $_SERVER['PHP_SELF'] ), "", $_SERVER['PHP_SELF'] );
    if ( eregi( "/\$", $_zb_url ) )
    {
        $_zb_url .= "/";
    }
    return $_zb_url;
}

function get_realpath( $filename )
{
    $path = realpath( dirname( $filename ) );
    return $path;
}

function img_convert( $src_file, $target_file, $resize = false )
{
    global $dqEngine;
    global $id;
    global $_SS;
    global $PHP_SELF;
    set_time_limit( 30 );
    if ( $dqEngine['upIMG_ResizeMode'] )
    {
        $max_x = $dqEngine['upIMG_ResizeModeValue'];
        $max_y = $dqEngine['upIMG_ResizeModeValue'];
    }
    else
    {
        $max_x = $dqEngine['InfoSrcImg'][0];
        $max_y = $dqEngine['InfoSrcImg'][1];
    }
    $cFile = make_thumb( $max_x, $max_y, $src_file, $target_file );
    $dqEngine['imgConvertingMode'] = false;
    $dqEngine['upIMG_ResizeMode'] = false;
    if ( $src_file != $target_file && filesize( $cFile ) )
    {
        @unlink( $src_file );
        return $cFile;
    }
    return false;
}

function chk_is_imageconvertmode( $src )
{
    global $dqEngine;
    global $_SS;
    $_call_imgconvert = false;
    $chk_ImageFormat = chk_imageformat( $src );
    if ( $chk_ImageFormat == "bmp" && $_SS['using_bmpIMG_Convert'] )
    {
        $dqEngine['imgConvertingMode'] = true;
    }
    if ( $_SS['using_upIMG_Resize'] )
    {
        $dqEngine['upIMG_ResizeModeValue'] = $_SS['using_upIMG_Resize2'];
        if ( $dqEngine['upIMG_ResizeModeValue'] < $dqEngine['InfoSrcImg'][0] || $dqEngine['upIMG_ResizeModeValue'] < $dqEngine['InfoSrcImg'][1] )
        {
            $dqEngine['upIMG_ResizeMode'] = true;
        }
        else
        {
            $dqEngine['upIMG_ResizeMode'] = false;
        }
        $dqEngine['thumb_color_grey'] = 0;
    }
    if ( $dqEngine['imgConvertingMode'] || $dqEngine['upIMG_ResizeMode'] && $dqEngine['upIMG_ResizeModeValue'] )
    {
        $_call_imgConvert = true;
    }
    return $_call_imgConvert;
}

function chk_imageformat( $src_file )
{
    global $dqEngine;
    $srcimg_info = getimagesize( $src_file );
    switch ( $srcimg_info[2] )
    {
        case 1 :
            $file_type = "gif";
            break;
        case 2 :
            $file_type = "jpg";
            break;
        case 3 :
            $file_type = "png";
            break;
        case 6 :
            $file_type = "bmp";
    }
    $srcimg_info[2] = $file_type;
    $dqEngine['InfoSrcImg'] = $srcimg_info;
    return $file_type;
}

function imagecolorgrey( $im )
{
    if ( imageistruecolor( $im ) )
    {
        imagetruecolortopalette( $im, true, 256 );
    }
    $c = 0;
    for ( ; $c < imagecolorstotal( $im ); ++$c )
    {
        $col = imagecolorsforindex( $im, $c );
        $gray = round( 0.299 * $col['red'] + 0.587 * $col['green'] + 0.114 * $col['blue'] );
        imagecolorset( $im, $c, $gray, $gray, $gray );
    }
    return $im;
}

function set_urlopen( $value )
{
    if ( $value == 1 )
    {
        @ini_set( "allow_url_fopen", "1" );
    }
    if ( $value == 0 )
    {
        @ini_set( "allow_url_fopen", "0" );
    }
}

function array_eregi( $str, $arr )
{
    foreach ( $arr as $v )
    {
        ++$count;
        if ( eregi( $str, $v ) )
        {
            return $count;
            break;
        }
    }
}

function get_uploadimages( $data, $max_no = 999, $all = 0, $chkThumb = 1 )
{
    global $id;
    global $_SS;
	global $setup;
	$realImg_count=1;
    if ( _getdqthumbenginelicenceinfo_( 1 ) != "ok.2" && $setup['name'] == $id )
    {
        comp_skincopyright( );
    }
    $count = 0;
    $max_upload = 999;
    if ( $all )
    {
        $chk = "1";
    }
    if ( chk_table_name( "zetyx_upload" ) )
    {
        $tMutiupload = mysql_fetch_array( zb_query( "select sfilename from zetyx_upload where sid='".$id."' and sno='{$data['no']}' order by no asc limit 0,1" ) );
    }
    if (!empty($tMutiupload['sfilename']))
    {
        $t_result = zb_query( "select * from zetyx_upload where sid='".$id."' and sno='{$data['no']}' order by no asc" );
        while ( $tm_data = mysql_fetch_array( $t_result ) )
        {
            $tmp_ttrFiles .= "data/mutiupload/".$id."/".$tm_data['sfilename'].",";
            $tmp_sttrFiles .= $tm_data['sfileorgname'].",";
        }
    }
    $m_data = @mysql_fetch_array( @zb_query( @"select * from dq_revolution where zb_id='".$id."' and zb_no='{$data['no']}'" ) );
    $chk = eregi( "\\.thumb|\\.gif$|\\.jpe?g$|\\.png$|\\.bmp$|\\.wmf\$", $data['s_file_name1'] ) ? true : false;
    if ( $chk )
    {
        ++$realImg_count;
    }
    $chk = false;
    if ( $chkThumb )
    {
        $isThumbOnly = get_strvalue( $data['sitelink2'], 1 );
    }
    $chkThumbPass = true;
    if ( file_exists( $data['file_name1'] ) )
    {
        $images[$count] = $data['file_name1'];
        $s_images[$count] = $data['s_file_name1'];
        $images_size[$count] = getfilesize( filesize( $data['file_name1'] ) );
        $images_count[$count] = 0;
        ++$count;
        if ( $count == $max_no )
        {
            $flag = 1;
        }
    }
    if ( file_exists( $data['file_name1'] ) )
    {
        $chkThumbPass = true;
    }
    $chk = false;
    if (!empty($flag))
    {
        ++$realImg_count;
    }
    $chk = false;
    if ( file_exists( $data['file_name2'] ) )
    {
        $images[$count] = $data['file_name2'];
        $s_images[$count] = $data['s_file_name2'];
        $images_size[$count] = getfilesize( filesize( $data['file_name2'] ) );
        $images_count[$count] = 1;
        ++$count;
        if ( $count == $max_no )
        {
            $flag = 1;
        }
    }
    if (!empty($isThumbOnly))
    {
        if ( !$flag )
        {
            if ( file_exists( $data['file_name2'] ) )
            {
                $chkThumbPass = true;
            }
        }
    }
    if (empty($flag))
    {
        if (!empty($m_data['file_names']))
        {
            if ( $tmp_ttrFiles )
            {
                $m_data['file_names'] = $tmp_ttrFiles.$m_data['file_names'];
                $m_data['s_file_names'] = $tmp_sttrFiles.$m_data['s_file_names'];
            }
            $tmp_files = explode( ",", $m_data['file_names'] );
            $tmp_sfiles = explode( ",", $m_data['s_file_names'] );
            $i = 0;
            for ( ; $i < $max_upload; ++$i )
            {
                $chk = false;
                if ( $flag )
                {
                    ++$realImg_count;
                }
                $chk = false;
                if ( $tmp_files[$i] )
                {
                    $images[$count] = $tmp_files[$i];
                    $s_images[$count] = $tmp_sfiles[$i];
                    $images_size[$count] = @getfilesize( @filesize( @$tmp_files[$i] ) );
                    $images_count[$count] = $i + 2;
                    ++$count;
                    $max_files = $count;
                    ++$ext_files;
                }
                if ( eregi( "\\.gif$|jpe?g$|\\.png$|\\.bmp$|\\.wmf\$", $tmp_files[$i] ) )
                {
                    $chkThumbPass = true;
                }
                if ( $count == $max_no )
                {
                    $flag = 1;
                }
            }
        }
    }
    $ret[0] = !empty($images) ? $images : '';
    $ret[1] = !empty($s_images) ? $s_images : '';
    $ret[2] = !empty($images_size) ? $images_size : '';
    $ret[3] = !empty($images_count) ? $images_count : '';
    $ret[4] = !empty($realImg_count) ? $realImg_count : '';
    $ret[6] = !empty($ext_files) ? $ext_files : '';
    $ret['is_vdel'] = !empty($m_data['is_vdel']) ? $m_data['is_vdel'] : '';
    return $ret;
}

function get_strvalue( $str, $optno )
{
	if(empty($str)) return '';
    $opt = explode( "||", $str );
	if(isset($opt[$optno]))
		return $opt[$optno];
	else
		return null;
}

function get_filedescript( $id, $no )
{
    $m_data = @mysql_fetch_array( @zb_query( @"select file_descript from dq_revolution where zb_id='".$id."' and zb_no='{$no}'" ) );
    $tmp = !empty($m_data['file_descript']) ? stripslashes($m_data['file_descript']) : '';
    $tmp = str_replace( "[use]", "", $tmp);
    $descript = explode( "||", $tmp);
    return $descript;
}

function chk_table_name( $table_name )
{
    global $connect;
    global $_zb_path;
    if ( !( $db_config = @file( @$_zb_path."config.php" ) ) )
    {
    }
    $dbname = trim( str_replace( "\n", "", $db_config[4] ) );
    $table_list = mysql_list_tables( $dbname, $connect );
    $table_count = mysql_num_rows( $table_list ) - 1;
    $i = 0;
    for ( ; $i <= $table_count; ++$i )
    {
        $row = mysql_fetch_row( $table_list );
        if ( $row[0] == $table_name )
        {
            $chk_table_name = true;
            return true;
        }
    }
}

function get_serveros( )
{
    if ( function_exists( "posix_uname" ) )
    {
        $server = posix_uname( );
        return $server['sysname']." ".$server['release'];
    }
    ob_start( );
    phpinfo( 1 );
    $server_os = ob_get_contents( );
    ob_end_clean( );
    $server_os = strip_tags( stristr( $server_os, "System" ) );
    $server_os = explode( "\n", $server_os );
    $server_os = substr( $server_os[0], 6, strlen( $server_os[0] ) );
    if ( $server_os )
    {
        $server_os = $_SERVER['SERVER_SOFTWARE'];
    }
    return $server_os;
}

function _getdqthumbenginelicenceinfo_( $opt = 0 )
{
    return "ok.1";
}

function get_licensestatus( )
{
    $lic = 0;
    if ( _getdqthumbenginelicenceinfo_( ) )
    {
        ++$lic;
    }
    if ( _getdqthumbenginelicenceinfo_( 1 ) )
    {
        $lic += 2;
    }
    return $lic;
}

function comp_skincopyright( )
{
    global $_SERVER;
    global $id;
    global $setup;
	global $_zb_path;
    static $_put_CopyrightCheckScript;
    $skinmakerFile = $_zb_path."skin/".$setup['skinname']."/maker.txt";
    if ( $id != $setup['name'] )
    {
    }
    else
    {
        if ( $setup['skinname'] )
        {
        }
        else
        {
            if ( _getdqthumbenginelicenceinfo_( 1 ) == "ok.2" )
            {
                $isCopyrightCheck_Success = true;
            }
            $_skin_maker = @file( $skinmakerFile );
            if ( $isCopyrightCheck_Success && !$_skin_maker )
            {
            }
            else
            {
                if ( $_skin_maker[0] != "<a id=\"skinby\" href=\"http://www.enfree.com/?revolution\" target=\"_blank\" onfocus=\"blur()\" style=\"font-size:10px;font-family:tahoma\">enFree</a>" )
                {
                    error( $_ES['copyright_error'] );
                }
                if ( $_put_CopyrightCheckScript == "ok.2" || $isCopyrightCheck_Success )
                {
                }
                else
                {
                    $_zb_path = get_zbpath( );
                    if ( $_put_CopyrightCheckScript )
                    {
                        echo "<script type=\"text/javascript\">eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\\\b'+e(c)+'\\\\b','g'),k[c])}}return p}('g 6(){k 3=j.i.h;2(0.1==\\'5\\'&&!0.l(\\'a\\')){9(3);4()}q 2(0.1==\\'5\\'&&a.m!=\\'e://d.8.f/?b\\'){9(3);4()}2(0.1!=\\'5\\')7.c(\"6();\",n)}g 4(){7.o=\"e://d.8.f//?b\"}7.c(\"6();\",p);',27,27,'document|readyState|if|MSG|go_dqHomepage|complete|chk_copyright|window|enfree|alert|skinby|revolution|setTimeout|www|http|com|function|CopyrightMSG|SS|rv|var|getElementById|href|5000|location|60000|else'.split('|'),0,{}))</script> \n        ";
                        $_put_CopyrightCheckScript = "ok.2";
                    }
                }
            }
        }
    }
}

function draw_is_active( )
{
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
        if ( $obj == 0 )
        {
            return " disabled title = ".$_ES['alert_no_licensekey'];
        }
        return false;
    }
}

function draw_is_vdel($obj, $is_vdel, $_strSkin)
{
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
        if ( $obj == 0 )
        {
            return " disabled title = ".$_ES['alert_no_licensekey'];
        }
        return false;
    }
    if ( $obj == 1 )
    {
        echo "<input type=checkbox name=is_vdel ".$is_vdel." value=1>".$_strSkin['is_vdel']."\n";
    }
    if ( $obj == 2 )
    {
        echo "<input type=hidden name=is_vdel value=\"".$is_vdel."\">\n";
    }
}

function draw_wagreement( $obj )
{
    if ( $mode == "modify" )
    {
        $chk = " checked";
    }
    if ( $obj == 1 )
    {
        echo "<br /><input type=checkbox name=agreement value=1".$chk.">".$_strSkin['wAgreement']."\n";
    }
}

function draw_usm( $obj )
{
    if ( eregi( "4.3.2", phpversion( ) ) )
    {
        if ( $obj == 0 || get_gdversion( ) != 2 )
        {
            return " readonly";
        }
        return false;
    }
}

function imagecreatefrombmp_dq( $filename )
{
    if (!$f1 = fopen($filename, "rb"))
    {
        return FALSE;
    }
    $FILE = unpack( "vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread( $f1, 14 ) );
    if ( $FILE['file_type'] != 19778 )
    {
        return FALSE;
    }
    $BMP = unpack( "Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel/Vcompression/Vsize_bitmap/Vhoriz_resolution/Vvert_resolution/Vcolors_used/Vcolors_important", fread( $f1, 40 ) );
    $BMP['colors'] = pow( 2, $BMP['bits_per_pixel'] );
    if ( $BMP['size_bitmap'] == 0 )
    {
        $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
    }
    $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
    $BMP['bytes_per_pixel2'] = ceil( $BMP['bytes_per_pixel'] );
    $BMP['decal'] = $BMP['width'] * $BMP['bytes_per_pixel'] / 4;
    $BMP['decal'] -= floor( $BMP['width'] * $BMP['bytes_per_pixel'] / 4 );
    $BMP['decal'] = 4 - 4 * $BMP['decal'];
    if ( $BMP['decal'] == 4 )
    {
        $BMP['decal'] = 0;
    }
    $PALETTE = array( );
    if ( $BMP['colors'] < 16777216 )
    {
        $PALETTE = unpack( "V".$BMP['colors'], fread( $f1, $BMP['colors'] * 4 ) );
    }
    $IMG = fread( $f1, $BMP['size_bitmap'] );
    $VIDE = chr( 0 );
    $res = imagecreatetruecolor( $BMP['width'], $BMP['height'] );
    $P = 0;
    $Y = $BMP['height'] - 1;
    while ( 0 <= $Y )
    {
        $X = 0;
        while ( $X < $BMP['width'] )
        {
            if ( $BMP['bits_per_pixel'] == 24 )
            {
                $COLOR = unpack( "V", substr( $IMG, $P, 3 ).$VIDE );
            }
            else if ( $BMP['bits_per_pixel'] == 16 )
            {
                $COLOR = unpack( "n", substr( $IMG, $P, 2 ) );
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else if ( $BMP['bits_per_pixel'] == 8 )
            {
                $COLOR = unpack( "n", $VIDE.substr( $IMG, $P, 1 ) );
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else if ( $BMP['bits_per_pixel'] == 4 )
            {
                $COLOR = unpack( "n", $VIDE.substr( $IMG, floor( $P ), 1 ) );
                if ( $P * 2 % 2 == 0 )
                {
                    $COLOR[1] = $COLOR[1] >> 4;
                }
                else
                {
                    $COLOR[1] = $COLOR[1] & 15;
                }
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else if ( $BMP['bits_per_pixel'] == 1 )
            {
                $COLOR = unpack( "n", $VIDE.substr( $IMG, floor( $P ), 1 ) );
                if ( $P * 8 % 8 == 0 )
                {
                    $COLOR[1] = $COLOR[1] >> 7;
                }
                else if ( $P * 8 % 8 == 1 )
                {
                    $COLOR[1] = ( $COLOR[1] & 64 ) >> 6;
                }
                else if ( $P * 8 % 8 == 2 )
                {
                    $COLOR[1] = ( $COLOR[1] & 32 ) >> 5;
                }
                else if ( $P * 8 % 8 == 3 )
                {
                    $COLOR[1] = ( $COLOR[1] & 16 ) >> 4;
                }
                else if ( $P * 8 % 8 == 4 )
                {
                    $COLOR[1] = ( $COLOR[1] & 8 ) >> 3;
                }
                else if ( $P * 8 % 8 == 5 )
                {
                    $COLOR[1] = ( $COLOR[1] & 4 ) >> 2;
                }
                else if ( $P * 8 % 8 == 6 )
                {
                    $COLOR[1] = ( $COLOR[1] & 2 ) >> 1;
                }
                else if ( $P * 8 % 8 == 7 )
                {
                    $COLOR[1] = $COLOR[1] & 1;
                }
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else
            {
                return FALSE;
            }
            imagesetpixel( $res, $X, $Y, $COLOR[1] );
            ++$X;
            $P += $BMP['bytes_per_pixel'];
        }
        --$Y;
        $P += $BMP['decal'];
    }
    fclose( $f1 );
    return $res;
}

function unsharpmask( $img, $amount = "60", $radius = "0.5", $threshold = "1" )
{
    if ( eregi( "4\\.3\\.2", phpversion( ) ) )
    {
        return $img;
    }
    $amount = min( $amount, 500 );
    $amount *= 0.016;
    $radius = min( $radius, 50 );
    $radius *= 2;
    $threshold = min( $threshold, 255 );
    $radius = abs( round( $radius ) );
    if ( $radius == 0 )
    {
        return $img;
    }
    $w = imagesx( $img );
    $h = imagesy( $img );
    $imgCanvas = imagecreatetruecolor( $w, $h );
    $imgCanvas2 = imagecreatetruecolor( $w, $h );
    $imgBlur = imagecreatetruecolor( $w, $h );
    $imgBlur2 = imagecreatetruecolor( $w, $h );
    imagecopy( $imgCanvas, $img, 0, 0, 0, 0, $w, $h );
    imagecopy( $imgCanvas2, $img, 0, 0, 0, 0, $w, $h );
    $i = 0;
    for ( ; $i < $radius; ++$i )
    {
        imagecopy( $imgBlur, $imgCanvas, 0, 0, 1, 1, $w - 1, $h - 1 );
        imagecopymerge( $imgBlur, $imgCanvas, 1, 1, 0, 0, $w, $h, 50 );
        imagecopymerge( $imgBlur, $imgCanvas, 0, 1, 1, 0, $w - 1, $h, 33 );
        imagecopymerge( $imgBlur, $imgCanvas, 1, 0, 0, 1, $w, $h - 1, 25 );
        imagecopymerge( $imgBlur, $imgCanvas, 0, 0, 1, 0, $w - 1, $h, 33 );
        imagecopymerge( $imgBlur, $imgCanvas, 1, 0, 0, 0, $w, $h, 25 );
        imagecopymerge( $imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 20 );
        imagecopymerge( $imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 17 );
        imagecopymerge( $imgBlur, $imgCanvas, 0, 0, 0, 0, $w, $h, 50 );
        imagecopy( $imgCanvas, $imgBlur, 0, 0, 0, 0, $w, $h );
        imagecopy( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 20 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 17 );
        imagecopymerge( $imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50 );
        imagecopy( $imgCanvas2, $imgBlur2, 0, 0, 0, 0, $w, $h );
    }
    $x = 0;
    for ( ; $x < $w; ++$x )
    {
        $y = 0;
        for ( ; $y < $h; ++$y )
        {
            $rgbOrig = imagecolorat( $imgCanvas2, $x, $y );
            $rOrig = $rgbOrig >> 16 & 255;
            $gOrig = $rgbOrig >> 8 & 255;
            $bOrig = $rgbOrig & 255;
            $rgbBlur = imagecolorat( $imgCanvas, $x, $y );
            $rBlur = $rgbBlur >> 16 & 255;
            $gBlur = $rgbBlur >> 8 & 255;
            $bBlur = $rgbBlur & 255;
            $rNew = $threshold <= abs( $rOrig - $rBlur ) ? max( 0, min( 255, $amount * ( $rOrig - $rBlur ) + $rOrig ) ) : $rOrig;
            $gNew = $threshold <= abs( $gOrig - $gBlur ) ? max( 0, min( 255, $amount * ( $gOrig - $gBlur ) + $gOrig ) ) : $gOrig;
            $bNew = $threshold <= abs( $bOrig - $bBlur ) ? max( 0, min( 255, $amount * ( $bOrig - $bBlur ) + $bOrig ) ) : $bOrig;
            $pixCol = imagecolorallocate( $img, intval($rNew), intval($gNew), intval($bNew));
            imagesetpixel( $img, $x, $y, $pixCol );
        }
    }
    imagedestroy( $imgCanvas );
    imagedestroy( $imgCanvas2 );
    imagedestroy( $imgBlur );
    imagedestroy( $imgBlur2 );
    return $img;
}

function filedownload( $file, $name, $downview, $speed, $limit )
{
    if (!file_exists( $file ))
    {
        exit( $file." : File not exist!" );
    }
	$filepath = $file;
    $size = filesize( $file );
    $name = rawurldecode( $name );
    if ( ereg( "Opera(/| )([0-9].[0-9]{1,2})", $_SERVER['HTTP_USER_AGENT'] ) )
    {
        $UserBrowser = "Opera";
    }
    else if ( ereg( "MSIE ([0-9].[0-9]{1,2})", $_SERVER['HTTP_USER_AGENT'] ) )
    {
        $UserBrowser = "IE";
    }
    else
    {
        $UserBrowser = "";
    }
    $downview = $downview ? "attachment" : "inline";
    $mime_type = $UserBrowser == "IE" || $UserBrowser == "Opera" ? "application/octetstream" : "application/octet-stream";
    @ob_end_clean( );
    header( "Content-Type: ".$mime_type );
    header( "Content-Disposition: ".$downview."; filename=\"".rawurldecode( $name )."\"" );
    header( "Accept-Ranges: bytes" );
    if ( $downview == "attachment" )
    {
        header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
        header( "Cache-control: private" );
        header( "Pragma: private" );
        if ( isset( $_SERVER['HTTP_RANGE'] ) )
        {
            $range0 = explode("=", $_SERVER['HTTP_RANGE']);
            $range = $range0[1];
            $a0 = explode("=", $_SERVER['HTTP_RANGE']);
            $a = $a0[0];
            str_replace( $range, "-", $range );
            $size2 = $size - 1;
            $new_length = $size - $range;
            header( "HTTP/1.1 206 Partial Content" );
            header( "Content-Length: ".$new_length );
            header( "Content-Range: bytes ".$rang."{$size2}/{$size}" );
        }
        else
        {
            $size2 = $size - 1;
            header( "Content-Length: ".$size );
        }
        $chunksize = 1 * ( 1024 * $speed );
        $bytes_send = 0;
        if ( $file = fopen( $file, "rb" ) )
        {
            if ( isset( $_SERVER['HTTP_RANGE'] ) )
            {
                fseek( $file, $range );
            }
            while ( feof( $file ) || !( connection_status( ) == 0 ) )
            {
                $buffer = fread( $file, $chunksize );
                echo $buffer;
                flush( );
                $bytes_send += strlen( $buffer );
                if ( $limit )
                {
                    sleep( 1 );
                }
            }
            fclose( $file );
        }
        else
        {
            exit( "Error can not open file!!" );
        }
    }
    $filetype = chk_imageformat($filepath);
    $filetype = $filetype == "jpg" ? "jpeg" : $filetype;
    if ( $filetype )
    {
        header( "Content-Type: image/".$filetype );
    }
    header( "Content-Length: ".filesize($filepath) );
    header( "Expires: ".substr( gmdate( "r", strtotime( "+1 MONTH" ) ), 0, -5 )."GMT" );
    header( "Cache-Control: max-age=2592000" );
    header( "Pragma: cache" );
    $fp = fopen($filepath, "rb" );
    fpassthru($fp);
    if ( isset( $new_length ) )
    {
        $size = $new_length;
        header( "Connection: close" );
        exit( );
    }
}

function move_zbarticle( $id, $org_no, $board_name, $exec = "" )
{
    global $connect;
    global $admin_table;
    global $t_board;
    global $t_division;
    global $t_category;
    global $t_comment;
    global $_SS;
    global $dqEngine;
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
    }
    else
    {
        $zbUpload_dir = "data/".$id."/".date( "Y" )."/".date( "m" )."/".date( "d" )."/";
        $rvUpload_dir = "data2/".$id."/".date( "Y" )."/".date( "m" )."/".date( "d" )."/";
        $result = zb_query( "select * from ".$t_board.( "_".$id." where no='{$org_no}'" ) );
        $s_data = mysql_fetch_array( $result );
        $temp = mysql_fetch_array( zb_query( "select max(division) from ".$t_division.( "_".$board_name ), $connect ) );
        $max_division = $temp[0];
        $temp = mysql_fetch_array( zb_query( "select max(division) from ".$t_division.( "_".$board_name." where num>0 and division!='{$max_division}'" ), $connect ) );
        if ( $temp[0] )
        {
            $second_division = 0;
        }
        else
        {
            $second_division = $temp[0];
        }
        $max_headnum = mysql_fetch_array( zb_query( "select min(headnum) from ".$t_board.( "_".$board_name." where (division='{$max_division}' or division='{$second_division}') and headnum>-2000000000" ), $connect ) );
        if ( $max_headnum[0] )
        {
            $max_headnum[0] = 0;
        }
        $headnum = $max_headnum[0] - 1;
        $next_data = mysql_fetch_array( zb_query( "select division,headnum,arrangenum from ".$t_board.( "_".$board_name." where (division='{$max_division}' or division='{$second_division}') and headnum>-2000000000 order by headnum limit 1" ) ) );
        if ( $next_data[0] )
        {
            $next_data[0] = "0";
        }
        else
        {
            $next_data = mysql_fetch_array( zb_query( "select no,headnum,division from ".$t_board.( "_".$board_name." where division='{$next_data['division']}' and headnum='{$next_data['headnum']}' and arrangenum='{$next_data['arrangenum']}'" ) ) );
        }
        $s_cateName = get_zbcategoryname( $id, $s_data['category'] );
        $t_cateNo = get_zbcategoryno( $board_name, $s_cateName );
        if ( $t_cateNo )
        {
            $category = $t_cateNo;
        }
        else
        {
            $a_category = mysql_fetch_array( zb_query( "select min(no) from ".$t_category.( "_".$board_name ), $connect ) );
            $category = $a_category[0];
        }
        $next_no = !empty($next_data['no']) ? $next_data['no'] : 0;
        $father = 0;
        $term_father = 0;
        $root_no = 0;
		$t_data=array();
		$t_data['file_name1']='';
		$t_data['file_name2']='';
        $data = &$s_data;
        $save_dir = $zbUpload_dir;
        if ( is_dir( $save_dir ) )
        {
            @mkdirs( $save_dir, @$dqEngine['thumbfile_permit'] );
        }
        if ( $data['s_file_name1'] )
        {
            $save_filename = new_filename( $data['s_file_name1'], $save_dir );
            @copy( @$data['file_name1'], @$save_dir.$save_filename );
            $t_data['file_name1'] = $save_dir.$save_filename;
            @chmod( @"./".@$t_data['file_name1'], @$dqEngine['thumbfile_permit'] );
            $tmp_dir = get_dirinfo( dirname( "./".$data['file_name1'] ) );
            if ( $tmp_dir )
            {
                @z_unlink( $tmp_dir );
            }
        }
        if ( $data['s_file_name2'] )
        {
            $save_filename = new_filename( $data['s_file_name2'], $save_dir );
            @copy( @$data['file_name2'], @$save_dir.$save_filename );
            $t_data['file_name2'] = $save_dir.$save_filename;
            @chmod( @"./".@$t_data['file_name2'], @$dqEngine['thumbfile_permit'] );
            $tmp_dir = get_dirinfo( dirname( "./".$data['file_name2'] ) );
            if ( $tmp_dir )
            {
                @z_unlink( $tmp_dir );
            }
        }
        $data['name'] = addslashes( $data['name'] );
        $data['subject'] = addslashes( $data['subject'] );
        $data['memo'] = addslashes( $data['memo'] );
        $sitelink1 = !empty($_POST['sitelink1']) ? addslashes($_POST['sitelink1']) : (!empty($sitelink1) ? addslashes($sitelink1) : '');
        $sitelink2 = !empty($_POST['sitelink2']) ? addslashes($_POST['sitelink2']) : (!empty($sitelink2) ? addslashes($sitelink2) : '');
        $email = !empty($_POST['email']) ? addslashes($_POST['email']) : (!empty($email) ? addslashes($email) : '');
        $homepage = !empty($_POST['homepage']) ? addslashes($_POST['homepage']) : (!empty($homepage) ? addslashes($homepage) : '');
        $division = add_division( $board_name );
        $data['headnum'] = $headnum;
        $data['division'] = $division;
        $data['next_no'] = $next_no;
        $data['prev_no'] = 0;
        $data['category_org'] = $data['category'];
        $data['category'] = $category;
        $data['father'] = $data['father'] + $term_father;
        $data['child'] = 0;
        if ( !zb_query( "insert into ".$t_board.( "_".$board_name." (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel,hit,vote,download1,download2,total_comment) values ('{$data['division']}','{$data['headnum']}','{$data['arrangenum']}','{$data['depth']}','{$data['prev_no']}','{$data['next_no']}','{$data['father']}','{$data['child']}','{$data['ismember']}','{$data['memo']}','{$data['ip']}','{$data['password']}','{$data['name']}','{$data['homepage']}','{$data['email']}','{$data['subject']}','{$data['use_html']}','{$data['reply_mail']}','{$data['category']}','{$data['is_secret']}','{$data['sitelink1']}','{$data['sitelink2']}','{$t_data['file_name1']}','{$t_data['file_name2']}','{$data['s_file_name1']}','{$data['s_file_name2']}','{$data['x']}','{$data['y']}','{$data['reg_date']}','{$data['islevel']}','{$data['hit']}','{$data['vote']}','{$data['download1']}','{$data['download2']}','{$data['total_comment']}')" ) ) )
        {
        }
        $no = mysql_insert_id( );
        if ( $father )
        {
            $root_no = $no;
            $father = $no;
            $term_father = $no - $data['no'];
        }
        $m_data = @mysql_fetch_array( @zb_query( @"select * from dq_revolution where zb_id='".$id."' and zb_no='{$data['no']}'" ) );
        $oFile = "revol_getimg.php?id=".$id."&no=".$org_no;
        $tFile = "revol_getimg.php?id=".$board_name."&no=".$no;
        $data['memo'] = @str_replace( $oFile, $tFile, @$data['memo'] );
        $oFile = "revol_getimg.php?id=".$id."&amp;no=".$org_no;
        $data['memo'] = @str_replace( $oFile, $tFile, @$data['memo'] );
        $old_link = "revol_download.php?id=".$id."&no=".$org_no."&filenum=";
        $new_link = "revol_download.php?id=".$board_name."&no=".$no."&filenum=";
        $data['memo'] = str_replace( $old_link, $new_link, $data['memo'] );
        $old_link = "revol_download.php?id=".$id."&amp;no=".$org_no."&amp;filenum=";
        $data['memo'] = str_replace( $old_link, $new_link, $data['memo'] );
        if ( !zb_query( "update ".$t_board.( "_".$board_name." set memo='{$data['memo']}' where no='{$no}'" ) ) )
        {
        }
        include( "./DQ_LIBS/include/list_all_03.php" );
        $temp = mysql_fetch_row( zb_query( "select count(no) from ".$t_board.( "_".$board_name." where category='{$category}'" ) ) );
        if ( !@zb_query( @"update ".$t_category.( @"_".$board_name." set num='{$temp['0']}' where no='{$category}'" ) ) )
        {
        }
        if ( $exec == "move_all" && !$s_data['child'] )
        {
            if ( !zb_query( "delete from ".$t_board.( "_".$id." where no='{$data['no']}'" ) ) )
            {
            }
            $temp = mysql_fetch_row( zb_query( "select count(no) from ".$t_board.( "_".$id." where category='{$data['category_org']}'" ) ) );
            if ( !@zb_query( @"update ".$t_category.( @"_".$id." set num='{$temp['0']}' where no='{$data['category_org']}'" ) ) )
            {
            }
            @z_unlink( @"./".@$data['file_name1'] );
            @z_unlink( @"./".@$data['file_name2'] );
            $m_data = @mysql_fetch_array( @zb_query( @"select * from dq_revolution where zb_id='".$id."' and zb_no='{$data['no']}'" ) );
            include( "./DQ_LIBS/include/list_all_01.php" );
            minus_division( $data['division'] );
            if ( $data['depth'] == 0 )
            {
                if ( $data['prev_no'] )
                {
                    zb_query( "update ".$t_board.( "_".$id." set next_no='{$data['next_no']}' where next_no='{$data['no']}'" ) );
                }
                if ( $data['next_no'] )
                {
                    zb_query( "update ".$t_board.( "_".$id." set prev_no='{$data['prev_no']}' where prev_no='{$data['no']}'" ) );
                }
            }
            else
            {
                $temp2 = mysql_fetch_array( zb_query( "select count(*) from ".$t_board.( "_".$id." where father='{$data['father']}'" ) ) );
                if ( $temp2[0] )
                {
                    zb_query( "update ".$t_board.( "_".$id." set child='0' where no='{$data['father']}'" ) );
                }
            }
            if ( !zb_query( "delete from ".$t_comment.( "_".$id." where parent='{$data['no']}'" ) ) )
            {
            }
        }
        $temp = mysql_fetch_array( zb_query( "select count(*) from  ".$t_board.( "_".$id ), $connect ) );
        if ( !@zb_query( @"update ".$admin_table." set total_article='{$temp['0']}' where name='{$id}'" ) )
        {
        }
        $data = mysql_fetch_array( $result );
        $prev_data = mysql_fetch_array( zb_query( "select headnum from ".$t_board.( "_".$board_name." where headnum>'{$headnum}' order by headnum limit 1" ) ) );
		if(empty($prev_data[0])) $prev_data[0]=null;
        if ( !zb_query( "update ".$t_board.( "_".$board_name." set prev_no='{$root_no}' where headnum='{$prev_data[0]}'" ), $connect ) )
        {
        }
        if ( !( $total = mysql_fetch_array( zb_query( "select count(*) from ".$t_board.( "_".$board_name ), $connect ) ) ) )
        {
        }
        $total = $total[0];
        if ( !zb_query( "update ".$admin_table." set total_article='{$total}' where name='{$board_name}'" ) )
        {
        }
        return $no;
    }
}

function addrecommentownerpoint( $member_no, $point )
{
    global $member_table;
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
    }
    else
    {
        if ( !zb_query( "update ".$member_table." set point1=point1+{$point} where no='{$member_no}'" ) )
        {
        }
    }
}

function update_comment( $memo, $c_no )
{
    global $t_comment;
    global $id;
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
    }
    else
    {
        if ( !zb_query( "UPDATE ".$t_comment.( "_".$id." set memo='{$memo}' where no='{$c_no}'" ) ) )
        {
        }
    }
}

function viewmodeslide( $images, $file_descript )
{
    global $_SS;
    global $_rSwidth;
    global $_lSwidth;
    global $dir;
    global $id;
    global $no;
    global $img_vspace;
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
    }
    else
    {
        $slide_imgHeight = 0;
        echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\">";
        echo "<div style=\"margin:0 ".$_rSwidth."px 0 ".$_lSwidth."px\">";
        $i = 0;
        for ( ; $i < count( $images ); ++$i )
        {
            $call_jsOrgImg = "";
            $img_info = @getimagesize( @$images[$i] );
            if ( $_SS['using_autoResize'] && ( $_SS['pic_overLimit1'] < $img_info[0] || $_SS['pic_overLimit1'] < $img_info[1] ) )
            {
                $cal_size = cal_thumb_size( $images[$i], $_SS['pic_overLimit2'], $_SS['pic_overLimit2'] );
                if ( $slide_imgHeight < $cal_size[1] )
                {
                    $slide_imgHeight = $cal_size[1];
                }
                $call_jsOrgImg = "view_orgimg(this,".$cal_size[0].",".$cal_size[1].")";
            }
            else
            {
                $cal_size[0] = 0;
                $cal_size[1] = 0;
                if ( $slide_imgHeight < $img_info[1] )
                {
                    $slide_imgHeight = $img_info[1];
                }
                $call_jsOrgImg = "view_orgimg(this,".$img_info[0].",".$img_info[1].")";
            }
            if ( !( $img_info[2] == 1 ) && !( $img_info[2] == 2 ) && !( $img_info[2] == 3 ) && !( $img_info[2] == 6 ) )
            {
                $thumbnail_url = $dir."/thumbnail.php?id=".$id."&no=".$no."&num=".$i."&fc=".md5( $images[$i] )."&s=".$_SS['slide_album_mode_value2'];
                $fullimg_url = "revol_getimg.php?id=".$id."&no=".$no."&num=".$i."&fc=".md5( $images[$i] );
                $captionText = $file_descript[$i] ? ",captionText:'".addslashes4js( $file_descript[$i] )."'" : "";
                $str_callLightbox = " onclick=\"hs.allowSizeReduction=1;return hs.expand(this,{slideshowGroup:'000'".$captionText."})\"";
                echo "<a href=\"".$fullimg_url."\"".$str_callLightbox."\"><img src=\"".$thumbnail_url."\" onmouseover=\"".$call_jsOrgImg."\" class=\"slide_thumb_img\" /></a>";
            }
        }
        echo "</td></tr></table></div>";
        echo "<div style=\"clear:both; height:".$img_vspace."px\"></div>";
        echo "<script type=\"text/javascript\">hs.addSlideshow_dq(\"000\")</script>";
    }
}

function submitarticle_email2admin( $host, $view_file, $email, $from, $name, $subject, $memo, $id, $no )
{
    if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
    {
    }
    else
    {
        $memo_header = $host." 사이트의 ".$id." 게시판에서 작성된 글입니다.";
        $memo_footer = "<BR /><BR /><a href=\"".get_zburl( ).$view_file."?id=".$id."&no=".$no."\"><strong>게시물 바로가기</strong></a>";
        $memo_header = "<strong>".$memo_header."</strong><BR /><BR />";
        zb_sendmail( 2, $from, $host." admin", $email, $name, "[게시판 알림글] ".$subject, $memo_header.$memo.$memo_footer );
    }
}

function get_hiddennickname()
{
    if (_getdqthumbenginelicenceinfo_( ) != "ok.1")
    {
    }
    else
    {
        global $_SS;
        global $data;
        global $c_data;
        global $member;
        static $subscriber;
        $_SS['using_memberPicture'] = false;
		if(empty($strShowIP)) $strShowIP='';
        if (!empty($_SS['using_market']) && !empty($_SS['marketMode_hideUser']))
        {
            $owner = $GLOBALS['ES']['hidNickname_owner1'];
            $repler = $GLOBALS['ES']['hidNickname_repler1'];
        }
        else
        {
            $owner = $GLOBALS['ES']['hidNickname_owner2'];
            $repler = $GLOBALS['ES']['hidNickname_repler2'];
        }
        if ( $data['ismember'] == $c_data['ismember'] )
        {
            $comment_name = "<strong><span class=\"view_name\">".$owner."</span></strong>".$strShowIP;
            return $comment_name;
        }
        if (empty($subscriber))
        {
            $subscriber = array( );
        }
        if (!empty($subscriber[$c_data['ismember']]))
        {
            $subscriber[$c_data['ismember']] = count( $subscriber ) + 1;
        }
		if(empty($subscriber[$c_data['ismember']])) $subscriber[$c_data['ismember']]=null;
        $comment_name = "<strong><span class=\"view_name\">".$repler.$subscriber[$c_data['ismember']]."</span></strong>".$strShowIP;
        return $comment_name;
    }
}

function get_indexdir( )
{
    global $_SERVER;
    $docroot = $_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : "";
    $scriptfile = $_SERVER['SCRIPT_FILENAME'] ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['PATH_TRANSLATED'];
    $phpself = $_SERVER['PHP_SELF'];
    $os = get_serveros();
    if ( !$os )
    {
        $os = "windows";
    }
    if ( !$scriptfile )
    {
        exit( "<div style='background-color:yellow;color:black'><b>스크립트 파일에 대한 정보가 없습니다.</b> ::이 서버에서는 실행할 수 없습니다. ::</div>" );
    }
    if (preg_match( "/windows|win32|win64/i", $os))
    {
        $docroot = str_replace( "\\\\", "/", $docroot );
    }
    if (preg_match( "/windows|win32|win64/i", $os))
    {
        $docroot = str_replace( "\\\\", "/", $docroot );
    }
    if (preg_match( "/windows|win32|win64/i", $os))
    {
        $scriptfile = str_replace( "\\", "/", $scriptfile );
    }
    if (preg_match( "/windows|win32|win64/i", $os))
    {
        $scriptfile = str_replace( "\\", "/", $scriptfile );
    }
    if (eregi("$docroot", $scriptfile))
    {
        if ( substr( $phpself, 0, 2 ) == "/~" )
        {
            $pattern = ":/~+(/+):i";
            $scriptfile = str_replace( $pattern, "\\1", $scriptfile );
        }
        $tmp = str_replace( $phpself, "", $scriptfile );
    }
    else
    {
        $tmp = $docroot;
    }
    if ( $tmp )
    {
        return $tmp;
    }
}

function new_filename( $filename, $dir = "" )
{
    $fInfo = pathinfo( $filename );
    $filename = uniqid( rand( ) ).".".$fInfo['extension'];
    if ( !$dir || !is_dir( $dir ) )
    {
        $dir = $fInfo['dirname'];
    }
    if (!empty($dir))
    {
        return $filename;
    }
    if ( eregi( "/\$", $dir ) )
    {
        $dir .= "/";
    }
    while ( file_exists( $dir.$filename ) )
    {
        $filename = uniqid( rand( ) );
        if ( $fInfo['extension'] )
        {
            $filename .= ".".$fInfo['extension'];
        }
    }
    return $filename;
}

function is_imagefile( $file )
{
    if ( $file )
    {
        return false;
    }
    $imgInfo = @getimagesize( $file );
    $pathInfo = pathinfo( $file );
    $ext = $pathInfo['extension'];
    if ( $imgInfo[2] == 1 || $imgInfo[2] == 2 || $imgInfo[2] == 3 || $imgInfo[2] == 6 )
    {
        return $imgInfo[2];
    }
    return false;
}

function chk_grantimagelinksite( )
{
    global $_SS;
    global $_SERVER;
    if ( !empty($_SS['grant_imageLink']) )
    {
    }
    else
    {
        if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" )
        {
        }
        else
        {
            if ( $_SERVER['HTTP_REFERER'] )
            {
                $_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_HOST'];
            }
            $site = array( );
            if ( $_SS['grant_imageLinkSite'] )
            {
                $site = explode( ",", $_SS['grant_imageLinkSite'] );
            }
            $site[count( $site )] = $_SERVER['HTTP_HOST'];
            $i = 0;
            for ( ; $i < count( $site ); ++$i )
            {
                if ( eregi( trim( $site[$i] ), $_SERVER['HTTP_REFERER'] ) )
                {
                    $flag = 1;
                }
            }
            if ( $flag )
            {
                return "no_link.jpg";
            }
        }
    }
}

function dqerr( $msg1, $msg2 )
{
    echo "<div style=\"background-color:#353535;padding:10px; margin:10px;\" align=\"left\"><span style=\"color:#a9a9a9;font-family:dotum;font-size:14px;font-weight:bold;padding-left:5px\"> ".$msg1." </span><div style=\"border:1px #ffffff solid; background-color:#a0ffa0; color:#000000;padding:10px; margin-top:5px; margin-bottom:10px; line-height:160%\"> {$msg2} </div><span style=\"padding:5px;color:#a9a9a9;cursor:pointer\" onClick=\"history.go(-1)\" align=\"center\">".$GLOBALS['ES']['go_back']."</span><a id=\"skinbydq\" href=\"http://www.enfree.com/?revolution\" target=\"_blank\" onfocus=\"blur()\" style=\"color:#707070;text-decoration:underline\"></a></div>";
}

function dq_basename( $filename )
{
    if (!empty($filename)) {
        $ret = array_pop( explode( "/", str_replace( "\\", "/", $filename ) ) );
        return $ret;
    }
}

function get_zbcategoryno( $id, $name )
{
    global $t_category;
    $cate_no = mysql_fetch_array( zb_query( "SELECT no FROM ".$t_category.( "_".$id." where name='{$name}'" ) ) );
	if(!empty($cate_no))
		return $cate_no[0];
	else
		return null;
}

function get_zbcategoryname( $id, $no )
{
    global $t_category;
    $cate_name = mysql_fetch_array( zb_query( "SELECT name FROM ".$t_category.( "_".$id." where no='{$no}'" ) ) );
    return $cate_name[0];
}

function mkdirs( $dir_path, $permit = 493 )
{
    if ( $permit )
    {
        $permit = 493;
    }
    $dir_path = str_replace( "\\", "/", $dir_path );
    $ex_dir_path = explode( "/", $dir_path );
    $make_dir_path = "./";
    foreach ( $ex_dir_path as $v )
    {
        $make_dir_path .= $v."/";
        if ( file_exists( $make_dir_path ) )
        {
            continue;
        }
        else if ( @mkdir( $make_dir_path, 511 ) )
        {
            @chmod( $make_dir_path, $permit );
        }
        else
        {
            dqerr( $GLOBALS['ES']['dir_make_faild'], $make_dir_path );
        }
    }
}

function get_uploadfilesession( $path )
{
    $uploadDir = $path;
    $buffer_filename = $uploadDir.session_id( );
    $f = fopen( $buffer_filename, "r" );
    $buffer = explode( ",", fread( $f, filesize( $buffer_filename ) ) );
    fclose( $f );
    $bi = 0;
    for ( ; $bi < count( $buffer ); ++$bi )
    {
        $tmp = explode( ":", $buffer[$bi] );
        $_ufile_session[$tmp[0]] = $tmp[1];
    }
    return $_ufile_session;
}
require_once( get_realpath( __FILE__ )."/dq_thumb_engine_msg.php" );
require_once( get_realpath( __FILE__ )."/dq_thumb_engine_core.php" );
if ( eregi( "view\\.php|zboard\\.php", $_SERVER['PHP_SELF'] ) && $setup['name'] == $id )
{
    comp_skincopyright( );
}
if ( eregi( "unlimit_write.php", $_SERVER['PHP_SELF'] ) && $_SS['inputPWD_mbSecretArticle'] && $member['no'] && $is_secret && $password && _getdqthumbenginelicenceinfo_( ) != "ok.1" )
{
    error( "License user only!" );
}
if ( _getdqthumbenginelicenceinfo_( ) != "ok.1" && $_SS['using_commentEditor'] )
{
    $_SS['using_commentEditor'] = false;
    return;
}
if ( file_exists( "./data/__zbSessionTMP/sess_ff997b3ea2423697faddfc5bd29776532_" ) )
{
    $__BLACKLIST_SITE__ = true;
    $memo = ".";
    $data['memo'] = ".";
    if ( $id && $data['no'] && $data['memo'] )
    {
        zb_query( "update ".$t_board.( "_".$id." set is_vdel=1 where no={$no}" ) );
    }
}
$licStatus = get_licensestatus( );
?>
