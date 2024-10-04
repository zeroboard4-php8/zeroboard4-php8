<script>
	function zb_login_check_submit() {
		if(!document.zb_login.user_id.value) {
			alert("ID를 입력하여 주십시요");
			document.zb_login.user_id.focus();
			return false;
		}
		if(!document.zb_login.password.value) {
			alert("Password를 입력하여 주십시요");
			document.zb_login.password.focus();
			return false;
		}  
		return true;
	} 
	
	function check_autologin() { 
		if (document.zb_login.auto_login.checked==true) {
			var check;  
			check = confirm("자동 로그인 기능을 사용하시겠습니까?\n\n자동 로그인 사용시 다음 접속부터는 로그인을 하실필요가 없습니다.\n\n단, 게임방, 학교등 공공장소에서 이용시 개인정보가 유출될수 있으니 주의해주세요");
			if(check==false) {document.zb_login.auto_login.checked=false;}
		}                               
	}  
</script>
