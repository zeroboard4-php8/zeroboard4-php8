<?php 
// 제로보드의 이미지 리사이즈 기능을 차단
	$old_autoResize_text   = " name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)";
	$using_autoResize_text = " galleryimg=\"no\"";
	$data['memo']=str_replace($old_autoResize_text,$using_autoResize_text,$data['memo']);

// IE6
    $isIE6 = eregi('MSIE 6.',$_SERVER['HTTP_USER_AGENT']) ? true : false;

// 이미지태그 가져오기
	if(!$_linkImage) $_linkImage = get_imgTag($data['memo'], $data['ismember'], 99);

// 얻어진 이미지태그를 이용해서 이미지 사이즈 재정렬
	if($_linkImage[0]) {

		unset($tmp);

		for($tmp=0; $tmp<count($_linkImage);$tmp++) 
		{
          $addAttrib = '';
		  $_getImageURL  = get_urlPath($_linkImage[$tmp]);
		  $tmp_str = str_replace($_getImageURL,dq_urlEncode($_getImageURL),$_linkImage[$tmp]);
		  $tmp_str = ereg_replace("( /)?>"," galleryimg=\"no\" />",$tmp_str);
		  //$tmp_str = str_replace("/>", "style=\"margin-bottom:".$skin_setup['pic_vSpace']."px\" />",$tmp_str);
		  
		  if(!$skin_setup['using_picBorder'] && !eregi(" border.?=",$tmp_str)) {
			  if(!eregi("border.?=",$tmp_str)) $tmp_str = str_replace("/>", "border=\"0\" />",$tmp_str);
		  }
	// 이미지 네비게이션
		if($onImageNavigator && ($go_prev || $go_next)) $addAttrib .= " onMouseMove=\"onImageNavigator(this,event)\"  onMouseOut=\"imageNaviHide(event)\" onMouseUp=\"gotoURL(event)\"";
	
	  // 제한한 사이즈보다 큰 이미지라면 리사이즈 하고, 새 창 띄우는 기능 켬
		  if($skin_setup['using_autoResize']) {
            if(!$isIE6) {
			  $tmp_str    = preg_replace("/ width( *?)=(.*?)([0-9]*)(.*?) /i"," ",$tmp_str);
			  $tmp_str    = preg_replace("/(width|height)( *?):(.*?)([0-9]*)(.*?)(px?)(\;?)/i","",$tmp_str);
			  $addAttrib .= " onload=\"imageResize(this)\" width=\"1px\" height=\"1px\"";
            }
            $addAttrib .= " id=\"dqResizedImg".$tmp."\"";
            if(!$onImageNavigator) $addAttrib .= " onClick=\"return callLightbox(this)\"";
            if($onImageNavigator) echo "\n<div id=\"dqResizedImg".$tmp."_tool\" class=\"imageToolbox\" align=\"right\" onmouseover=\"imgToolboxOn(event)\">\n<img src=\"$dir/plug-ins/highslide/graphics/fullexpand.gif\" border=\"0\" title=\"크게 보기\" onclick=\"callLightbox('dqResizedImg".$tmp."')\" />\n</div>\n";
		  }

		  $tmp_str = str_replace("/>","$addAttrib />",$tmp_str);
          $img_vspace = &$skin_setup['pic_vSpace'];

          //$data['memo'] = "\r<table cellspacing=\"0\" cellpadding=\"0\" style=\"margin:0 0 ".$img_vspace."px 0\"><tr><td align=\"".$skin_setup['pic_align']."\">".str_replace($_linkImage[$tmp],$tmp_str, $data['memo'])."</td></tr></table>";
          $data['memo'] = "\r".str_replace($_linkImage[$tmp],$tmp_str, $data['memo']);
		} //for
	}
?>
