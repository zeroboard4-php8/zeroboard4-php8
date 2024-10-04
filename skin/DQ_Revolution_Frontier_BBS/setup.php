<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다');

// 스킨 환경설정 읽어옴
	require $dir."/get_config.php";

// 스킨 환경파일 검사
	if(($is_admin && isset($skin_setup['version']) && $skin_setup['version'] != $skin_version) || !file_exists($_zb_path.'revol_write_ok.php') || !file_exists($_LIBS_include_dir.'list_all_03.php') || !file_exists($_SKIN_config_file)) {
		require $dir.'/include/lib_copy.php';
	}
	require_once $dir."/include/member_info.php";

// 환경설정값 최적화
	if(!eregi("%|px",$width)) $width .= 'px';
    $blank_Image = '<img src="images/t.gif" height="1px" />';

// 구형 PHP서버의 호환성을 위한 처리
	if (substr(phpversion(),0,5) < '4.1.0') {
		global $_SERVER, $_REQUEST;
		$_SERVER  = $HTTP_SERVER_VARS;
		$_REQUEST = $HTTP_GET_VARS;
	}

// 관리자이고, 스킨설정을 저장하지 않은 상태라면 스킨 설정창을 띄운다.
	if($is_admin && isset($skin_setup['config_id']) != $id && empty($cfg_linkFile)) echo "<script language='JavaScript'>window.open('$dir/skin_config_".$dqrevolutionType.".php?id=$id&mode=modify','DQStyle','width=850,height=650,toolbars=no,resizable=yes,scrollbars=yes,status=yes,menubar=yes,location=yes,url=yes');</script>\n";
	if(!empty($is_admin)) {
?>
<!-- 
■ Skin Version: DQ Revolution <?=$dqrevolutionType?> <?=$skin_version?> , gd:<?=get_gdVersion(1)?> , php:<?=phpversion()?> 
■ ThumbnailEngine Version: <?=getThumbEngine_version()?> 
-->
<?php
	}
?>

<script type="text/JavaScript">
var id="<?=$id?>", no="<?=$no?>", page="<?=$page?>", select_arrange="<?=$select_arrange?>", desc="<?=$desc?>", page_num="<?=$page_num?>", keyword="<?=$keyword?>", category="<?=$category?>", sn="<?=$sn?>", ss="<?=$ss?>", sc="<?=$sc?>", su="<?=$su?>", url="<?=$REQUEST_URI?>";
</script>
<script src="<?=$dir?>/lib.js" type="text/JavaScript"></script>
<?php if(eregi("\/view.php|\/zboard\.php",$_SERVER['PHP_SELF'])){?>
<script type="text/javascript" src="<?=$dir?>/plug-ins/highslide/highslide-frontier.packed.js"></script>
<?php require 'setup.js.php'; }?>
<?php if(!empty($skin_setup['using_weditor']) && $skin_setup['WEditor_dir'] && eregi("\/view\.php$|\/write\.php$|\/zboard\.php$",$_SERVER['PHP_SELF'])) {?>
<script type="text/javascript" src="<?=$skin_setup['WEditor_dir']?>fckeditor.js"></script>
<?php }?>
<script src="<?=$dir?>/default.js" type="text/JavaScript"></script>
<div id="floatNaviArrow_top" class="floatNaviArrow"><img src="<?=$dir?>/<?=$skin_setup['css_dir']?>/garrow_top.gif" /></div>
<div id="floatNaviArrow_left" class="floatNaviArrow"><img src="<?=$dir?>/<?=$skin_setup['css_dir']?>/garrow_left.gif" /></div>
<div id="floatNaviArrow_right" class="floatNaviArrow"><img src="<?=$dir?>/<?=$skin_setup['css_dir']?>/garrow_right.gif" /></div>
