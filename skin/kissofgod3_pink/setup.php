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
  // 컬러셋을 지정하는 부분
  include "$dir/value.php3";
?>

<script language=JavaScript>
function findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
function swapImage() {
  var i,j=0,x,a=swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>


<!-- HTML 시작 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td valign=bottom class=kissofgod-tahoma7 nowrap><a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes')) onfocus='this.blur()'><img src=<?=$dir?>/member_logged.gif border=0 align=absmiddle alt='접속된 회원 및 총회원 목록보기&#10;&#13;현재 <?=$total_connect?>분께서 회원으로 접속해 있습니다.'><span onfocus='this.blur()'> <?=$total_connect?></span></td>
  <td valign=bottom rowspan=2 align=right width=100%>
    <?=$a_member_join?><img src=<?=$dir?>/member_join.gif border=0 alt='회원가입'></a>
    <?=$a_member_modify?><img src=<?=$dir?>/member_modify.gif border=0 alt='회원정보 수정'></a>
    <?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)" title='쪽지관리'><?=$member_memo_icon?></span></a>
    <?=$a_login?><img src=<?=$dir?>/member_login.gif border=0 alt='회원로그인'></a>
    <?=$a_logout?><img src=<?=$dir?>/member_logout.gif border=0 alt='로그아웃'></a>
    <?=$a_setup?><img src=<?=$dir?>/member_setup.gif border=0 alt='게시판환경바꾸기'></a></td>
</tr>
<tr>
  <td valign=bottom class=kissofgod-tahoma7 nowrap>
    <img src=<?=$dir?>/setup_total.gif> <?=$total?> <img src=<?=$dir?>/setup_articles.gif >　<?=$page?>/<?=$total_page?> <img src=<?=$dir?>/setup_pages_nowpage.gif></td>
</tr>
</table>
