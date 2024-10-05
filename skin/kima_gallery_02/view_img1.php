<html>
<head>
<title>Gallery View</title>
<SCRIPT LANGUAGE="JavaScript">
<!--

var isNav4, isIE4;
if (parseInt(navigator.appVersion.charAt(0)) >= 4) {   
isNav4 = (navigator.appName == "Netscape") ? 1 : 0;
isIE4 = (navigator.appName.indexOf("Microsoft") != -1) ? 1 : 0;
}
function FW() {
if (isNav4) {
window.innerWidth = document.layers[0].document.images[0].width;
window.innerHeight = document.layers[0].document.images[0].height;
}
if (isIE4) {
window.resizeTo(500, 500);
width = 500 - (document.body.clientWidth - document.images[0].width);
height = 500 - (document.body.clientHeight - document.images[0].height);
window.resizeTo(width, height);
   }
}

//-->
</SCRIPT>
<meta http-equiv="imagetoolbar" content="no">
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' onLoad="FW()">
<DIV style="position:absolute; left:0px; top:0px">
<span style="cursor:hand"><img src=<?=isset($_GET['file'])?urldecode($_GET['file']):''?> border=0 alt='창닫기' onClick="javascript:self.close()" onfocus="this.blur()"></a></span>
</body></DIV>
</body>
</html>

</html>
