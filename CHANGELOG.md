# 패치 노트

## [php8-2.1] - 2024-10-04
- 스킨 추가
- 버그 수정


## [php8-2.0] - 2024-10-02
- DQ 레볼루션 스킨 추가(내부 스타일시트 변경, 썸네일 생성, 사진 EXIF 정보 출력 정도만 테스트 되었으며 php의 gd 및 exif 라이브러리 활성화가 필요)
- 십시오 -> 십시요로 다시 수정(당시에는 흔히 사용하였던 한글 표현으로 확인)
- 버그 수정


## [php8-1.1] - 2024-09-21
- 스킨 추가
- MySQL 8.0 관련 비밀번호 처리 및 회원가입 수정
- 버그 수정


## [php8-1.0] - 2024-09-20
- register_globals 스타일의 코드를 더 이상 사용하지 않음
- register_globals 형태로 요청이 처리되는 경우 경고 메시지 출력
- 회원 탈퇴 간에 회원 비밀번호를 입력 받도록 개선
- DQuest_thumb_white, gray 섬네일 갤러리 스킨 추가(php의 gd 및 exif 라이브러리 활성화가 필요)
- 버그 수정
- 추가적인 보안 취약점 패치


## [php8-0.6] - 2024-09-05
- 스킨 추가
- 추가적인 보안 취약점 패치


## [php8-0.5] - 2024-09-01
- php 8.x 관련 Warning 및 Fatal error 추가 개선
- cut_str() 함수 개선
- 관리자 종류 별 권한 정리


## [php8-0.4] - 2024-08-29
- 게시판 관리 화면에서 정리(오류복구) 실행 시 게시판 스킨을 자동으로 php 8.x 이상 문법과 UTF-8 인코딩에서 사용 가능하도록 패치하는 기능 추가
- 게시판 스킨 추가


## [php8-0.3] - 2024-08-28
- php 8.1 이상 환경에서 DB 접근 간에 예외가 발생하는 경우 Fatal error가 발생하지 않도록 수정
- 게시판 스킨 추가
- 그룹이 2개 이상인 경우 회원 관리 창에서 최고관리자 계정이 표시되도록 수정
- 추가적인 보안 취약점 패치
- 관리자 페이지 표시되는 총 멤버 수 자동 보정 기능 정상 작동하도록 수정


## [php8-0.2] - 2024-08-23
- old_password() 대응 및 MySQL 8 등에서 password() SQL 함수 사용이 불가한 경우에 대한 대응
- 저장소 링크 변경
- php 8.x 관련 Warning 및 Fatal error 추가 개선
- 게시판 스킨 추가
- 십시요 -> 십시오로 수정
- 추가적인 보안 취약점 패치
- 관리자 페이지 CSRF 동작 개선
- 관리자 페이지에 표시되는 총 게시판 갯수와 총 멤버 수를 자동으로 보정


## [php8-0.1] - 2021-07-07
- 최초 릴리즈
- zb_query(), zb_error() 함수 대신 zb_query(), zb_error() 함수를 사용 (SQL injection 공격에 대응하기 위함)
- 게시판 스킨의 memo_on.swf와 외부로그인 스킨의 i_memo.swf 외에 memo_on.mp3와 i_memo.mp3도 사용 할 수 있도록 변경
- 회원가입 폼에서 우편번호 검색 시 카카오 우편번호 api를 사용하도록 변경
- setup.php에서 memo_limit_time을 0으로 설정할 시 쪽지를 자동으로 삭제하지 않도록 함(기본값으로 변경)