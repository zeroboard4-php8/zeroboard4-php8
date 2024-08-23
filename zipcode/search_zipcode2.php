<?php
	if(!isset($_POST['address'])) {
?>
		<script>
			alert("우편번호를 입력하셔야 합니다");
			history.back();
		</script>
<?php
		exit;
	}

	$url=preg_replace("/search_zipcode.php\?/i","search_zipcode3.php",$_SERVER['HTTP_REFERER']);
	$url=preg_replace("/num=1/i","",$url);
	$url=preg_replace("/num=2/i","",$url);
	header("location:http://zeroboard.com/zipcode/search_zipcode2.html?num=$num&url=$url&address=$address");
?>
