<?php 
function get_memberPicture($member_no,$dir='',$_user_imagex=70,$_user_imagey=0) {
	global $setup, $skin_setup, $id, $member_table;

	if(!$_user_imagex) $_user_imagex = 70;
	if(!$_user_imagey) $_user_imagey = 0;

	if($_user_imagex==50||$_user_imagex==60||$_user_imagex==70||$_user_imagex==80||$_user_imagex==90||$_user_imagex==100)
		$faceImagePixel = '_'.$_user_imagex;

	$dir = 'skin/'.$setup['skinname'].'/images/';
	$noface = $dir.'no_face'.$faceImagePixel.'.jpg';

	$target_noface  = 'icon/dq_revol_no_face.thumb';
	$src_file       = $noface;
	$target         = $target_noface;

	$addAttrib = '';

	if($member_no) {

		$temp = @zb_query("select is_admin,open_picture,picture from $member_table where no = '$member_no'");
		$data = @mysql_fetch_array($temp);

		if(!$data) return '<img src="'.$dir.'no_face'.$faceImagePixel.'.jpg" '.'/>';

        $_gd_support = get_support_GD_type();
        if(eregi("\.jpg",$_gd_support)) $ext = '.jpg';
        elseif(eregi("\.png",$_gd_support)) $ext = '.png';
        elseif(eregi("\.gif",$_gd_support)) $ext = '.gif';

        $target_dir = 'icon/';
		$dqbasenamedatapic = dq_basename($data['picture']);
		$target_mb  = !empty($dqbasenamedatapic) ? explode(".",dq_basename($data['picture'])) : null;
		if(!isset($target_mb)) $target_mb[0]='';
		$old_target = $target_dir.$target_mb[0].".thumb";
		$target_mb  = $target_dir.$target_mb[0].'_small'.$ext;
        if(file_exists($old_target)) @unlink ($old_target);
		
		if(isset($data['picture']) && !file_exists($data['picture'])) $data['picture'] = '';
		if($data['is_admin'] == 3 && (!$data['open_picture'] || !$data['picture'])) {
			$target = &$target_noface;
		}

		if(!empty($share)) $target="";

		if($data['picture']) { 
			$src_file=$data['picture']; 
			$target=$target_mb;
			$addAttrib .= "onClick=\"return hs.expand(this,{outlineType:'drop-shadow',src:'".dq_urlencode($data['picture'])."',slideshowGroup:'".uniqid(0)."',dimmingOpacity:0,align:''})\" style=\"cursor:pointer\" ";
		}
	}

	if((!$_user_imagex || !$_user_imagey) && file_exists($target)) {
		$img_size = @getimagesize($target);
		if($_user_imagex && $img_size[0] != $_user_imagex) @unlink($target);
		if($_user_imagey && $img_size[1] != $_user_imagex) @unlink($target);
	}
	$ret = make_thumb($_user_imagex,$_user_imagey,$src_file,$target);
	$img_size = $GLOBALS['dqEngine']['thumbImgSize'];
	unset($GLOBALS['dqEngine']['thumbImgSize']);
	if(!$GLOBALS['dqEngine']['gd_version']) $addAttrib .= 'onLoad="call_AlphaImageLoader(this)" ';
	$retImg = '<img src="'.$ret.'" '.$addAttrib.'/>';
	return $retImg;
}
		

function get_memberInfo($member_no) {
	$temp = @zb_query("select * from $member_table where no = '$member_no'");
	$data = @mysql_fetch_array($temp);

	if($data['openinfo'] && $data['comment']) return $data;
}
?> 
