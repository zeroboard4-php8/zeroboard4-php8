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
  <?=$a_member_memo?> : 쪽지
  <?=$member_memo_icon?> : 쪽지아이콘
  <?=$memo_on_sound?> : 쪽지가 왔을때 소리 나오는 변수 memo_on.swf

  <?=$total_connect?> : 현재 전체 회원 로그인수
  <?=$group_connect?> : 현재 그룹 로그인수

  * 쪽지아이콘은 member_memo_on.gif, member_memo_off.gif 파일이 있습니다. (기본)
    member_memo_on.gif는 새로운 쪽지가 있을때, 글고 member_memo_off.gif는 새쪽지가 없을때입니다;;

  */
  include "$dir/value.php3";

	/*************************************************************
	*
	* Gray 갤러리 스킨 (ver 1)
	*                 - by gray
	*
	* 아래 변수에 해당하는 값을 조절하시면 됩니다.
	*
	**************************************************************/
	$_hsize = 100; // 가로 크기
	$_wsize = 100; // 세로 크기
	$_h2size = 115; // 테두리가로 크기
	$_w2size = 115; // 테두리세로 크기
	$_h_num = 3; // 가로 갯수

	$_hsize2 = 550; // 본문 가로 크기

	$max = 18; // 제목 길이

	// 연한색깔 (사진 테두리)
	$_color1="white";

	// 진한색깔 (사진 내용)
	$_color2="white";

	$_x = 0; // 계산시 필요한 변수

?>

<!-- HtML 시작 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td class=thm7 nowrap>
    <img src=<?=$dir?>/images/setup_total.gif border=0 width=28 height=7> <?=$total?> <img src=<?=$dir?>/images/setup_articles.gif border=0 width=41 height=7>&nbsp;&nbsp;<?=$page?>/<?=$total_page?> <img src=<?=$dir?>/images/setup_page.gif width=22 height=7>
    <?=$memo_on_sound?>
  </td>
  <td width=100% align=right>
    <?=$a_member_join?><img src=<?=$dir?>/images/member_join.gif width=19 height=7 border=0></a>
    <?=$a_login?><img src=<?=$dir?>/images/member_login.gif width=24 height=7 border=0></a>
    <?=$a_member_modify?><img src=<?=$dir?>/images/member_modify.gif width=31 height=7 border=0></a>
    <?=$a_member_memo?><?=$member_memo_icon?></a>
	<?=$a_logout?><img src=<?=$dir?>/images/member_logout.gif width=34 height=7 border=0></a>
    <?=$a_setup?><img src=<?=$dir?>/images/member_admin.gif width=25 height=7 border=0></a>
  </td>
</tr>
</table>

<?php 
if($setup['use_category'])
{
?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr valign=top>
  <td width=100><?php include "include/print_category.php"; ?></td>
  <td align=right width=100%>
  <?php 
   $width="98%";
  }
?>
