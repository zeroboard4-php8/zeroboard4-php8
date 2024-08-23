<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/json2/20160511/json2.min.js"></script>
<script>
var myver0 = '<?=$zb_php8_version?>';
var myver = myver0.split('-')[1];
var newver;
var github;
var request;
if (window.XMLHttpRequest) {
    request = new XMLHttpRequest();
} else {
    request = new ActiveXObject("Microsoft.XMLHTTP");
}
request.onreadystatechange = function() {
    if (request.readyState === request.DONE) {
        if (request.status === 200 || request.status === 201) {
            github = JSON.parse(request.responseText);
            newver = github[0].name.split('-')[1];
            if(newver > myver) {
                document.getElementById("newverspan").innerHTML = github[0].name;
                document.getElementById("oldverspan").innerHTML = myver0;
                document.getElementById('updatenotice').setAttribute('style', '');
                setInterval("blink()", 900);
            }
        }
    }
};
request.open('GET', 'https://api.github.com/repos/zeroboard4-php8/zeroboard4-php8/releases');
request.send();

function blink() {
    if(document.getElementById('updatenotice_bg').getAttribute('bgcolor')=="dff0d8") {
        document.getElementById('updatenotice_bg').setAttribute('bgcolor', 'c4f0b2');
    } else {
        document.getElementById('updatenotice_bg').setAttribute('bgcolor', 'dff0d8');
    }
}
</script>
<table border=0 cellspacing=0 cellpadding=15 bgcolor=#efefef width=100% height=100%>
<Tr>
<td valign=top style=line-height:160%>
<table id="updatenotice" style="display:none;" border="0" cellspacing="1" cellpadding="15" bgcolor="aaaaaa" width="100%">
<tr>
<td id="updatenotice_bg" bgcolor="dff0d8" colspan="2"><h2>업데이트가 있습니다.</h2><span id="newverspan">new</span> 버전이 새로 출시되었으며 현재 버전은 <span id="oldverspan">old</span> 입니다.
&nbsp;<a href="https://github.com/zeroboard4-php8/zeroboard4-php8" target="_blank" style="text-decoration:underline">github 저장소 방문</a></td>
</tr>
</table>
<pre>
<b>제로보드 <?=$zb_version?> 관리자 페이지입니다.</b>
공개형 무료 게시판 제로보드의 전체적인 관리를 할수 있는 관리자 페이지입니다.
관리자 페이지에서는 그룹 추가, 설정, 게시판 관리, 회원관리를 할수 있습니다.
다음은 간단한 설명입니다. (자세한 설명은 <a href=http://zeroboard.com target=_blank><b>http://zeroboard.com/CGI</b></a> 에서 확인하십시오)
</pre>
<table border=0 cellspacing=1 cellpadding=5 bgcolor=444444 width=100%>
<col width=100></col><col width=></col>
<tr>
	<td bgcolor=aaaaaa align=center colspan=2><b>목 &nbsp;  &nbsp;  &nbsp; 차</b></td>
</tr>
<tr valign=top>
	<td bgcolor=dddddd width=100 style=line-height:160% nowrap>
		1. <a href=#help1>기본 설정</a><br>
		2. <a href=#help2>회원 관리</a><br>
		3. <a href=#help3>그룹 관리</a><br>
		4. <a href=#help4>게시판 관리</a><br>
		5. <a href=#help5>외부 로그인</a><br>
	</td>
	<td bgcolor=white>
		<pre style=line-height:160%>
<a name=help1><b>1. 기본 설정</b></a>
    기본 설정은 제로보드를 운영할때 가장 기본이 되는 설정을 의미합니다.
    기본 설정은 DB에 데이타가 저장되는 것이 아닌 제로보드 디렉토리 내의 setup.php 파일에 저장이 되어 있습니다.
    <b>처음 제로보드를 설치할때 기본적인 내용으로 설정되어 있으므로 꼭 확인을 하셔야 합니다.</b>
    다음은 현재 설정된 기본 설정 내용입니다.
    * E-mail, url, sitename은 꼭 확인하세요
    <font color=red>- 관리자 E-mail : <?=$_zbDefaultSetup['email']?>

    - 사이트 url : <?=$_zbDefaultSetup['url']?>

    - 사이트 이름 : <?=$_zbDefaultSetup['sitename']?></font>

    - 세션 경로 : <?=$_zbDefaultSetup['session_path']?>

    - 게시물 조회 로그 저장 크기 : <?=$_zbDefaultSetup['session_view_size']?>

    - 게시판 추천 로그 저장 크기 : <?=$_zbDefaultSetup['session_vote_size']?>

    - 로그인 유효 시간 : <?=$_zbDefaultSetup['login_time']?>

    - 현재 접속자 검사 : <?=$_zbDefaultSetup['nowconnect_enable']?>

    - 현재 접속자 갱신시간 : <?=$_zbDefaultSetup['nowconnect_refresh_time']?>

    - 현재 접속자 검사시간 : <?=$_zbDefaultSetup['nowconnect_time']?>

    - 한글 아이디 사용 : <?=$_zbDefaultSetup['enable_hangul_id']?>

    - E-Mail 유효 검사 : <?=$_zbDefaultSetup['check_email']?>

    - 쪽지 보관일수 : <?php if(intval($_zbDefaultSetup['memo_limit_time'])===0) echo '무제한'; else echo (int)($_zbDefaultSetup['memo_limit_time']/(60*60*24)).' 일'; ?>

    * 자세한 내용은 <a href=http://zeroboard.com target=_blank>http://zeroboard.com</a>에서 매뉴얼을 보세요


<a name=help2><b>2. 회원 관리</b></a>
    회원은 크게 최고관리자, 그룹관리자, 게시판 관리자, 일반 멤버로 구분되어 있습니다.
    (게시판 관리자는 회원정보에서 관리할수 있는 게시판을 선택해주면 됩니다)
    그리고 각 멤버마다 1~10 까지의 레벨이 있습니다.
    레벨은 설정 권한과는 상관없는 읽기, 쓰기, 삭제, 수정, 답글, 간단한 답글, 비밀글 읽기, html사용등에서
    설정한 레벨과 관계가 있습니다. (각 게시판의 권한설정)
    회원은 각 그룹마다 가입을 받을수 있으며 해당 그룹을 비공개로 할시 다른 그룹의 회원과 격리됩니다.
    회원 가입항목은 각 그룹마다 다양하게 선택할수 있으며, 게시판에 글쓴이의 회원/ 비회원 구분은 
    아이콘이나 Bold 체등으로 구분할수 있고, 구분하지 않을수도 있습니다. 
    회원의 정보중 비밀번호와 주민등록번호는 MySQL의 Encryption으로 암호화 됩니다.
    회원탈퇴는 각 회원이 개인정보변경에서 직접 탈퇴할수 있거나 관리자가 탈퇴시킬수 있습니다.
    하지만 아이디나 비밀번호 분실시 비밀번호를 알수 없으므로 관리자가 직접 다른 비밀번호로 수정하여서
    메일로 통보해주어야 합니다.

    메일링 리스트 사용은 검색한 회원들만 대상으로 하여 메일링을 보낼수 있습니다.
    

<a name=help3><b>3. 그룹 관리</b></a>
    <font color=444444><b>제일 처음에는 그룹이 설정되어 있지 않으므로 하나를 설정해 주셔야 합니다</b></font>
    제로보드에서의 그룹은 일반 커뮤니티 싸이트처럼 서로 다른 그룹에 각각 가입하는 방식이 아닙니다.
    초기 가입한 그룹이 자신의 그룹이며 이는 관리자가 수정하지 않는한 수정할수 없습니다.
    일반 개인싸이트에서는 그룹을 하나만 설정하면 됩니다.
    만약 특수 그룹이 필요할시 임시 그룹을 만들어서 그 쪽으로 회원가입을 받고 원하는 회원만
    해당 그룹으로 이동시켜 주는 방식을 쓰는것이 좋습니다.

<a name=help4><b>4. 게시판 관리</b></a>
    게시판을 초기 생성할때 사용할 스킨을 잘 지정해주셔야 합니다.
    그리고 방명록등의 게시판형태가 아닌 스킨일 경우 전체리스트 체크, 답글 안보이기 해제등을 하셔야 하는데
    Skin Kind 항목에서 버튼을 클릭하시면 됩니다.
    일반 공개형 게시판이 아닐경우 권한설정을 유의하여 설정하여 주시면 됩니다.
    기타 게시판 관리는 직관적으로 알수 있습니다.

<a name=help5><b>5. 외부로그인</b></a>
    제로보드 4 pl7 버젼부터는 자체적으로 외부로그인을 지원하고 있습니다.
    외부로그인에 대한 자세한 방법은 <a href=http://zeroboard.com target=_blank>http://zeroboard.com</a> 에서 매뉴얼중 외부로그인 페이지를 참고하세요

    * 외부로그인에서 사용할수 있는 정보중 절대 경로는 다음과 같이 입력하세요.
    <font color=red>$_zb_path = "<?=str_replace("\\","/", $config_dir)?>";</font>

		</pre>
	</td>
</tr>
</table>

</td>
</tr>
</table>
