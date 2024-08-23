<?php
	if(!defined("_zb_lib_included")) return;
	if(eregi(":\/\/",$dir)||eregi("\.\.",$dir)) $dir ="./";

	// 쿠키값을 이용;;
	$name=$zetyx['name'];
	$email=$zetyx['email'];
	$homepage=$zetyx['homepage'];

	// 회원일때는 기본 입력사항 안보이게;;
	if($member['no']) { $hide_start="<!--"; $hide_end="-->"; }

	// 비밀글 사용;;
	if(!$setup['use_secret']) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

	// 공지기능 사용하는지 않하는지 표시;;
	if(!$is_admin||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

	include $dir."/write.php";
?>
