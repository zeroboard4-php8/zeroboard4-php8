<?php
	$filename = urldecode($_GET['filename']);
?>
<html>
<head>
<title>원본 사이즈 이미지 보기</title>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' oncontextmenu="return false" ondragstart="return false">
<a href=# onclick=window.close() title='클릭하면 창이 닫힙니다' onfocus=blur()><img src=../../<?=$filename?> border=0></a>
</body>
</html>
