<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 리스트의 상단 부분을 보여주는 곳입니다
  <?=$a_ 로 시작되는 항목은 HTML의 <a 라고 생각하시면 됩니다.
  뒤에 </a>를 붙여주면 되죠;
  다음은 스킨 제작시 만들수 있는 변수 입니다. 그대로 사용하시면 됩니다;;;;

  <?=$width?> : 게시판의 가로크기
  <?=$dir?> : 스킨디렉토리를 가리킵니다.
  <?=$print_page?> : 페이지를 보여줍니다
  <?=$a_status?> : 통계링크
  <?=$a_login?> : 로그인 버튼
  <?=$a_logout?> : 로그오프버튼
  <?=$a_no?> : 원래순서.. 즉 순서대로 정렬
  <?=$a_subject?> : 제목정렬
  <?=$a_name?> : 이름정렬
  <?=$a_hit?> : 조회수 정렬
  <?=$a_vote?> : 추천수 정렬
  <?=$a_date?> : 날자별 정렬
  <?=$a_download1?> : 첫번재 항목의 자료 다운로드 순서 정렬
  <?=$a_download2?> : 두번째 항목의 자료 다운로드 순서 정렬
  <?=$a_cart?> : 바구니 선택 링크
  <?=$a_category?> : 카테고리 정렬

  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_modify?> : 글수정 버튼
  <?=$a_delete_all?> : 관리자일때 나타나는 선택된 글 삭제 버튼;;

  바구니와 카테고리의 경우 사용하지 않는 수가 있으므로 숨겨놓을때 쓰는 변수;;
  <?=$hide_cart_start?> 내용 <?=$hide_cart_end?> : start 와 end 사이에는 사라짐;; 바구니
  <?=$hide_category_start?> 내용 <?=$hide_category_end?> : Start와 end 사이에는 사라짐;; 바구니
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
  <td width=70 cellspacing=0 cellpadding=0 valign=bottom><img src=<?=$dir?>/images/coke.gif></td>
  <td width=1></td>
  <td valign=bottom style=font-family:Tahoma;font-size:6pt;font-weight:bold;>
    <a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))><img src=<?=$dir?>/images/setup_logedmember.gif align=absmiddle border=0></a><?=$total_connect?><br>
    <img src=<?=$dir?>/images/setup_total.gif align=absmiddle> <?=$total?><img src=<?=$dir?>/images/setup_articles.gif align=absmiddle> <?=$total_page?><img src=<?=$dir?>/images/setup_pages_nowpage.gif align=absmiddle> <?=$page?>
  </td>
  <td valign=bottom nowrap width=5%>
    <?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)"><?=$member_memo_icon?></span></a><br>
    <?=$a_member_join?><img src=<?=$dir?>/images/setup_signin.gif border=0 align=absmiddle></a>
    <?=$a_member_modify?><img src=<?=$dir?>/images/setup_userinfo.gif border=0 align=absmiddle></a>
    <?=$a_member_memo?><img src=<?=$dir?>/images/setup_memobox.gif border=0 align=absmiddle></a>
    <?=$a_login?><img src=<?=$dir?>/images/setup_login.gif border=0 align=absmiddle></a>
    <?=$a_logout?><img src=<?=$dir?>/images/setup_logout.gif border=0 align=absmiddle></a>
    <?=$a_setup?><img src=<?=$dir?>/images/setup_config.gif border=0 align=absmiddle></a>
  </td>
</tr>
</table>
<!-- HTML 끝 -->

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td width=1>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
</td></tr><tr><td width=100%>

<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr align=center>
   <td>
   <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt;color:black align=center nowrap><img src=/images/t.gif width=3>&nbsp;<?=$a_no?><font color=FFFFFF>no</a>&nbsp;</td>
  </tr>
</table>
   </td>

<?=$hide_cart_start?>
   <td>
   <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center nowrap><img src=/images/t.gif width=3>&nbsp;<?=$a_cart?><font color=FFFFFF>C</a>&nbsp;</td>
  </tr>
</table>
   </td>
<?=$hide_cart_end?>

<?=$hide_category_start?>
   <td align=center><img src=images/t.gif border=0 height=1 border=0><br><?=$a_category?></td>
<?=$hide_category_end?>

   <td width=100%>
       <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center><img src=/images/t.gif width=3>&nbsp;<?=$a_subject?><font color=FFFFFF>subject</font></a>&nbsp;</td>
  </tr>
</table>
  </td>
   <td>
       <table width=70 border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center style='word-break:break-all;'><img src=/images/t.gif width=3>&nbsp;<?=$a_name?><font color=FFFFFF>name</font></a>&nbsp;</td>
  </tr>
</table>
  </td>

   <td>
       <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center><img src=/images/t.gif width=3>&nbsp;<?=$a_date?><font color=FFFFFF>date</font></a>&nbsp;</td>
  </tr>
</table>
  </td>
   <td>
       <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center><img src=/images/t.gif width=3><?=$a_hit?><font color=FFFFFF>&nbsp;hit&nbsp; </font></a></td>
  </tr>
</table>
  </td>
     <td>
       <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#CF0000 bordercolorlight=#950000 bordercolordark=#FFFFFF>
  <tr>
    <td height=18 style=font-family:Matchworks,Tahoma;font-size:8pt; align=center><img src=/images/t.gif width=3><?=$a_vote?><font color=FFFFFF>&nbsp;vote&nbsp;</font></a></td>
  </tr>
</table>
  </td>
</tr>
</tr>
