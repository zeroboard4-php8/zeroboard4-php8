* 제로보드 외부로그인 파일 설명서

1. 로그인 파일 : login.html

	login.html 파일은 외부로그인 사용시 출력될 로그인 폼입니다.

	다음 세부분은 절대 수정하지 마세요.

	<form name=zb_login method=post action="[action]" onsubmit="return zb_login_check_submit();">
	<input type=hidden name=s_url value="[s_url]">
	<form>

	위의 3줄을 제외한 나머지는 마음껏 수정하셔도 됩니다.

	다음은 각 표시에 해당하는 내용입니다.
	[action] : 로그인 하는 페이지 
	[s_url] : 현재 페이지

	위의 3 표시는 그대로 사용하셔야 합니다.

	i_login.gif : 로그인 버튼
	i_join.gif : 회원가입 버튼
	i_help.gif : 비밀번호 분실 버튼

2. 로그인 되었을 때 : logged.html

	로그인 되었을때의 화면입니다.
 
	[name] : 이름을 표시합니다. (쪽지함의 링크까지 되어 있습니다)
	[memo] : 쪽지 화면 표시입니다. 
	[logout] : 로그아웃 버튼입니다.
	[level] : 회원의 레벨 표시입니다.
	[info] : 정보수정 표시입니다.
	[point] : 회원의 포인트 입니다
	[write_num] : 지금까지 쓴 글의 숫자입니다.
	[write_comment] : 지금까지 쓴 코멘트의 숫자입니다.
	[join_date] : 가입일입니다.
	[admin] : 관리자일경우 관리자 버튼입니다.

	위의 8가지 항목을 원하는 곳에 넣으시면 됩니다.

	그리고 아래 5개의 이미지 및 1개의 flash파일은 꼭 같은 이름으로 outlogin_skin/images 디렉토리에 있어야 합니다.

	i_memo_on.gif : 쪽지가 왔을때 반짝이는 아이콘
	i_memo_off.gif : 쪽지가 오지 않았을때 가만 있는 아이콘
	i_logout.gif : 로그아웃 아이콘
	i_info.gif : 정보 수정 아이콘
	i_admin.gif : 관리자 페이지 접근 아이콘
	i_memo.swf: 쪽지가 도착함을 알리는 목소리

	로그인 폼을 고치실때 위의 아이콘도 고치시면 됩니다

3. 로그인/로그아웃 상관없는 코드
	
	[total_member_connect] : 현재 접속해 있는 회원수입니다.
	[total_guest_connect] : 현재 접속해 있는 비회원수입니다.
	[total_connect] : 현재 접속해 있는 총 접속자수입니다.
	[dir] : 외부로그인 스킨의 경로입니다.
	        외부로그인 스킨 자료실에 데이타를 넣고 <img src=[dir]a.gif> 라고 하시면 자동으로 경로를 찾아서 바꿉니다.
