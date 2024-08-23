<html>
<head>
<title>Search ZipCode</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="style.css" type="text/css">

<script>
<!--
function postaddr(var1)
{
<?php if($num==1){?>
 opener.document.write.home_address.value=var1;
<?php } else{?>
 opener.document.write.office_address.value=var1;
<?php }?>
 window.close();
}
-->
</script>

</head>

<body bgcolor=white leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?php
 echo urldecode(stripslashes($_POST['memo']));
?>
<br>
<div align=center><a href=# onclick=history.go(-2)><font color=black>뒤로가기</a> <font color=bbbbbb>|</font> <a href=# onclick=window.close()><font color=black>창 닫기</a>


</body>
</html>

