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
<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td valign=bottom class=setup style=font-family:Tahoma;font-size:6pt;font-weight:bold;><a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))><img src=<?=$dir?>/images/i_loged_members.gif align=absmiddle border=0></a>&nbsp;<?=$total_connect?><br> 
    <img src=<?=$dir?>/images/i_total.gif border=0>&nbsp;<?=$setup['total_article']?>&nbsp;
<img src=<?=$dir?>/images/i_articles.gif border=0>&nbsp;
    <?php if($setup['total_article']!=$total)echo" (<font color=red>$total</font> searched) ";?><?=$page?> <img src=<?=$dir?>/images/i_pages.gif border=0 >&nbsp;<?=$total_page?>
    <?=$memo_on_sound?>
  </td>
  <td align=right>
  <?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)"><?=$member_memo_icon?></span></a><br>
    <?=$a_login?><img src=<?=$dir?>/images/i_login.gif border=0 align=absmiddle></a>
    <?=$a_member_join?><img src=<?=$dir?>/images/i_signin.gif border=0 hspace=2 align=absmiddle></a>
    <?=$a_member_modify?><img src=<?=$dir?>/images/i_myinfo.gif border=0 align=absmiddle></a>
    <?=$a_member_memo?><img src=<?=$dir?>/images/i_memobox.gif border=0 align=absmiddle></a>
    <?=$a_logout?><img src=<?=$dir?>/images/i_logout.gif border=0 align=absmiddle></a>
    <?=$a_setup?><img src=<?=$dir?>/images/i_config.gif border=0 align=absmiddle></a></td>
</tr>
</table>


  
