<?php
  /*
	  이 파일은 게시판에서 상단의 상태를 보여줍니다.

		<?=$width?> : 게시판의 가로크기
		<?=$dir?> : 스킨디렉토리를 가리킵니다.
		<?=$total?> : 전체 글수
		<?=$total_page?> : 전체 페이지수
		<?=$a_status?> : 통계링크
		<?=$a_login?> : 로그인 버튼
		<?=$a_logout?> : 로그오프버튼
		<?=$page?> : 현재페이지 표시
		<?=$a_member_join?> : 회원가입
		<?=$a_member_modify?> : 회원정보수정
		<?=$a_member_memo?> : 쪽지;;
		<?=$member_memo_icon?> : 쪽지아이콘;;
		<?=$memo_on_sound?> : 쪽지가 왔을때 소리 나오는 변수 memo_on.swf
		<?=$total_connect?> : 현재 전체 회원 로그인수
		<?=$group_connect?> : 현재 그룹 로그인수

		* 쪽지아이콘은 member_memo_on.gif, member_memo_off.gif 파일이 있습니다. (기본)

		member_memo_on.gif는 새로운 쪽지가 있을때, 글고 member_memo_off.gif는 새쪽지가 없을때입니다;;
	*/



	/*************************************************************
	*
	* 제로 갤러리 스킨 (ver 0.1)
	*                 - by zero
	*
	* 아래 변수에 해당하는 값을 조절하시면 됩니다.
	*
	**************************************************************/
	$_hsize = 110; // 가로 크기
	$_h_num = 5; // 가로 갯수

	// 연한색깔 (사진 테두리)
	$_color1="eeeeee";

	// 진한색깔 (사진 내용)
	$_color2="white";

	$_x = 0; // 계산시 필요한 변수

?>



<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td style=font-family:tahoma;font-size:7pt; align=left>
  &nbsp; Total : <b><?=$setup['total_article']?></b><?php if($setup['total_article']!=$total)echo" (<font color=red>$total</font> searched) ";?>, <B><?=$page?></b> / <b><?=$total_page?> pages
  </td>
  <td style=font-family:tahoma;font-size:8pt; align=right height=30>
    <?=$a_member_modify?><img src=<?=$dir?>/s_myinfo.gif border=0></a> &nbsp;
    <?=$a_member_memo?><img src=<?=$dir?>/s_memobox.gif border=0></a> &nbsp;
    <?=$a_logout?><img src=<?=$dir?>/s_logout.gif border=0></a> &nbsp;
    <?=$a_setup?><img src=<?=$dir?>/s_setup.gif border=0></a>
    <?=$a_login?><img src=<?=$dir?>/s_login.gif border=0></a> &nbsp;
    <?=$a_member_join?><img src=<?=$dir?>/s_signup.gif border=0></a> 
    &nbsp;

  </td>
</tr>
<tr><td height=1 colspan=3 background=<?=$dir?>/dot.gif><img src=<?=$dir?>/dot.gif border=0 height=1></td></tr>
</table>
