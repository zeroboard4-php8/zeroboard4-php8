<?php /////////////////////////////////////////////////////////////////////////
  /*
  이 파일은 리스트의 상단 부분을 보여주는 곳입니다
  <?=$a_ 로 시작되는 항목은 HTML의 <a 라고 생각하시면 됩니다.
  뒤에 </a>를 붙여주면 되죠;
  다음은 스킨 제작시 만들수 있는 변수 입니다. 그대로 사용하시면 됩니다;;;;

  <?=$face_image?> : 현재 쓰인 글의 글쓴이 얼굴 아이콘;;

  <?=$width?> : 게시판의 가로크기
  <?=$dir?> : 스킨디렉토리를 가리킵니다.
  <?=$a_download1?> : 첫번째 파일의 다운로드
  <?=$a_download2?> : 두번째 파일의 다운로드
  <?=$a_email?> : 메일링크
  <?=$a_homepage?> : 홈페이지 링크

  <?=$a_write?> : 글쓰기 버튼
  <?=$a_list?> : 목록보기 버튼
  <?=$a_reply?> : 답글쓰기 버튼
  <?=$a_delete?> : 글삭제 버튼
  <?=$a_vote?> : 추천버튼
  <?=$a_modify?> : 글수정 버튼

  바구니와 카테고리의 경우 사용하지 않는 수가 있으므로 숨겨놓을때 쓰는 변수;;
  <?=$hide_cart_start?> 내용 <?=$hide_cart_end?> : start 와 end 사이에는 사라짐;; 바구니
  <?=$hide_category_start?> 내용 <?=$hide_category_end?> : Start와 end 사이에는 사라짐;; 바구니
  <?=$hide_sitelink1_start?> 내용 <?=$hide_sitelink1_end?> : 사이트링크 표시 #1
  <?=$hide_sitelink2_start?> 내용 <?=$hide_sitelink2_end?> : 사이트링크 표시 #2
  <?=$hide_download1_start?> 내용 <?=$hide_download1_end?> : 다운로드 표시 #1
  <?=$hide_download2_start?> 내용 <?=$hide_download2_end?> : 다운로드 표시 #2
  <?=$hide_homepage_start?> 내용 <?=$hide_homepage_end?> : 홈페이지 표시
  <?=$hide_email_start?> 내용 <?=$hide_email_end?> : Email 표시

  -- 간단한 답글 관련
  <?=$hide_comment_start?> <?=$hide_comment_end?> : 간단한 답글 쓰기 보여주기/ 숨기기


  <?=$name?> : 메일이 링크되어 있는 이름 * 원래 그대로 <?=$data['name']?>
  <?=$email?> : 메일.. 거의 직접 쓸일은 없음;; 메일만 있는 변수 <?=$data['email']?>
  <?=$subject?> : 제목  * 원래 그대로 <?=$data['suject']?>
  <?=$memo?> : 내용 부분
  <?=$homepage?> : 링크가 걸린 홈페이지 * 홈페이지 주소만 : <?=$data['homepage']?>
  <?=$hit?> : 조회수
  <?=$vote?> : 추천수
  <?=$ip?> : 아피주소
  <?=$comment_num?> : 간단한 답글 수
  <?=$reg_date?> : 글쓴 날자
  <?=$category_name?> : 카테고리 이름
  <?=$insert?> : 답글일경우 한칸씩 들어가는 깊이를 출력합니다.
  <?=$icon?>   : 현재 글의 상태에 따라서 아이콘을 출력합니다.
  <?=$a_file_link1?> : 다운로드 파일이 있을시 파일링크 #1
  <?=$a_file_link2?> : 다운로드 파일이 있을시 파일링크 #2
  <?=$file_name1?> : 다운로드 파일이 있을시 파일이름 #1
  <?=$file_name2?> : 다운로드 파일이 있을시 파일이름 #2
  <?=$file_size1?> : 다운로드 파일이 있을시 파일크기 #1
  <?=$file_size2?> : 다운로드 파일이 있을시 파일크기 #2
  <?=$file_download1?> : 다운로드받은 회수 #1;
  <?=$file_download2?> : 다운받은 회수 #2
  <?=$sitelink1?> : 사이트 링크(링크 걸린것) #1
  <?=$sitelink2?> : 사이트 링크(링크 걸린것) #2

  <?=$upload_image1?> : 이미지가 업로드되었을때 그림파일이름;; #1
  <?=$upload_image2?> : 이미지가 업로드되었을때 그림파일이름;; #2

  참고: old_head.gif : 원본글이면서 12시간이 넘은 글의 아이콘
       new_head.gif : 12시간에 적히 모든 글. 원본/답글 상관없이
       reply_head.gif : 12시간이 지난 답글의 아이콘
       notice_head.gif : 공지사항일때 아이콘
       arror.gif : 현재 리스트에서 선택되어 있는 글 앞에 붙는 아이콘

  --- 이전/ 이후글 링크 ---
  <?=$a_prev?> : 이전글 링크
  <?=$a_next?> : 다음글 링크

  <?=hide_prev_start?> <?=$hide_prev_end?> : 이전글 나타나기/ 숨기기
  <?=hide_next_start?> <?=$hide_next_end?> : 다음글 나타나기/ 숨기기
 
  기타 제목이나 글쓴이등은 위의 데이타에서 앞에 prev_ , next_ 를 덧 붙인것임;
  ex) 이전글 제목 : <?=$prev_subject?>
  
  */ 
///////////////////////////////////////////////////////////////////////////// ?>


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

<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
  <tr align=left><td width=165><img src=<?=$dir?>/images/view1.gif></td>
<?php /// 화면상단 정보표시 시작 ///?>
  <td valign=bottom style=font-family:Tahoma;font-size:6pt;font-weight:bold;padding-bottom:1 width=99%>
    <a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))><img src=<?=$dir?>/images/setup_logedmember.gif align=absmiddle border=0></a><?=$total_connect?>
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
<?php /// 화면상단 정보표시 끌 ///?>
  </tr>
  <tr align=center>
   <td width=185><table width=185 border=0 cellspacing=0 cellpadding=0><tr><td><img src=<?=$dir?>/images/view2.gif></td></tr></table></td>
   <td width=100% colspan=2>
   <table width=100% height=16 border=0 cellspacing=0 cellpadding=0 background=<?=$dir?>/images/bg.gif>
  <tr>
    <td style=font-family:Matchworks,Tahoma;font-size:8pt;color:#FFFFFF align=right nowrap><img src=<?=$dir?>/images/logo.gif></td>
  </tr>
</table>
</td>
</tr>

</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> bgcolor=<?=$sC_light1?>>
<tr>
  <td height=35 background=<?=$dir?>/images/view3.gif bgcolor=#000000>&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"></td>
  <td align=right background=<?=$dir?>/images/view4.gif bgcolor=#000000 valign=bottom>
  <?=$a_modify?><img src=<?=$dir?>/images/btn_modify.gif border=0 align=absmiddle></a>
  <?=$a_delete?><img src=<?=$dir?>/images/btn_delete.gif border=0 align=absmiddle></a>
  </td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>Name&nbsp;&nbsp;</b></td>
 <td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><img src=images/t.gif height=3></td></tr><tr><td>&nbsp;&nbsp;</td><td><?=$face_image?> <?=$name?>&nbsp;<?php if($data['email']) { ?> <font style=font-size:7pt;font-family:Tahoma;font-weight:normal>[<a href=mailto:<?=$data['email']?>><?=$data['email']?></a>]</font><?php } ?></td></tr></table></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_start?>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>Homepage&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$homepage?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_end?>

<?=$hide_download1_start?>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>File #1&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download1?></b></font></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>File #2&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download2?></b></font></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>Link #1&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$sitelink1?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style=color:#ffffff><b>Link #2&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$sitelink2?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_end?>

<tr height=23>
 <td align=right class=thm8 width=100 bgcolor=<?=$sC_dark0?> style='word-break:break-all;color:#ffffff'><b>Subject&nbsp;&nbsp;</b></td>
 <td><img src=images/t.gif height=3><br>&nbsp;&nbsp; <b><?=$subject?></b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td style='word-break:break-all;padding:10px;' bgcolor=#ffffff height=100 valign=top>
     <span style=line-height:160%>
     <?=$upload_image1?>
     <?=$upload_image2?>
     <?=$memo?>
     <br>
     <div align=right style=font-family:Tahoma;font-size:7pt;><?=$ip?></div>
     </span>
 </td>
</tr>
<tr>
<td bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td>
</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>
