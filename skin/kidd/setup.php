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
?>

<!-- HTML 시작 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td width=1></td>
  <td style=font color=000000 style=font-family:tahoma;font-size:7pt>
     <img src=<?=$dir?>/h_total.gif align=absmiddle><?=$total?>,  <img src=<?=$dir?>/h_page.gif align=absmiddle><?=$page?>/<?=$total_page?>,     <a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes')) onfocus=this.blur()>logged members&nbsp;</a><?=$total_connect?>
  </td>
  <td align=right>
    <?=$a_member_join?><img src=<?=$dir?>/s_signup.gif border=0 alt="회원가입"></a>
    <?=$a_member_modify?><img src=<?=$dir?>/s_myinfo.gif border=0 alt="정보수정"></a>
    <!--<?=$member_memo_icon?>-->
    <?=$a_member_memo?><img src=<?=$dir?>/s_memobox.gif border=0 alt="쪽지사용"></a>
    <?=$a_login?><img src=<?=$dir?>/s_login.gif border=0 alt="로그인"></a>
    <?=$a_logout?><img src=<?=$dir?>/s_logout.gif border=0 alt="로그아웃"></a>
    <?=$a_setup?><img src=<?=$dir?>/s_setup.gif border=0 alt="설정"></a>
  </td>
</tr>
</table>

  