<html>
<head>
<title>DQ'Style Skin Configuration</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head> 
<body>
<?php 
$id = !empty($_GET['id']) ? $_GET['id'] : '';
$mode = 'css';
if($mode="css") {
	if(!file_exists($id.'css_info.php')) {
		echo "정상적인 접근이 아닙니다.";
		die();
	}
	include $id."css_info.php";
	$css = $match_bgColor;
	$css2 = $match_overColor;
	//echo "<SCRIPT LANGUAGE=\"JavaScript\">parent.match_css.innerHTML=\"".$css."\";</SCRIPT>\n";
}

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
if(parent.document.getElementById('match_css')) {
	parent.match_css.innerHTML="<?=$css?>";
}
if(parent.document.getElementById('match_overcss')) {
	parent.match_overcss.innerHTML="<?=$css2?>";
}
//-->
</SCRIPT>
</body>
</html>

