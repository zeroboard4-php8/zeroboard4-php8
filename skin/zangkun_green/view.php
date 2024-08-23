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

  -- 간단한 답글 관련
  <?=$hide_comment_start?> <?=$hide_comment_end?> : 간단한 답글 쓰기 보여주기/ 숨기기


  <?=$name?> : 메일이 링크되어 있는 이름 * 원래 그대로 <?=$data['name']?>
  <?=$subject?> : 제목  * 원래 그대로 <?=$data['suject']?>
  <?=$memo?> : 내용 부분
  <?=$homepage?> : 링크가 걸린 홈페이지 * 홈페이지 주소만 : <?=$data['homepage']?>
  <?=$hit?> : 조회수
  <?=$vote?> : 추천수
  <?=$ip?> : 아피주소
  <?=$comment_num?> : 간단한 답글 수
  <?=$reg_date?> : 글쓴 날자
  <?=$date?> : 글쓴 날자 (상세하게)
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
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> bgcolor=white>
<tr><td colspan=3 height=3 bgcolor=#66CC33>
 </td>
</tr>

<tr>
 <td align=right><img src=<?=$dir?>/w_name.gif border=0>&nbsp;&nbsp;</td>
 <td align=left width=100%><?=$face_image?> <?=$name?><td align=right nowrap><font style=font-size:8pt;font-family:tahoma>(<?=$date?>, Hit : <?=$hit?>)</font></td>
</tr>

<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>

<?=$hide_homepage_start?>
<tr>
 <td align=right ><img src=<?=$dir?>/w_homepage.gif border=0>&nbsp;&nbsp;</td>
 <td ><?=$homepage?></td>
</tr>
<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
<?=$hide_homepage_end?>

<?=$hide_download1_start?>
<tr>
 <td align=right ><img src=<?=$dir?>/w_upload1.gif border=0>&nbsp;&nbsp;</td>
 <td ><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></td>
</tr>
<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr>
 <td align=right ><img src=<?=$dir?>/w_upload2.gif border=0>&nbsp;&nbsp;</td>
 <td ><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></td>
</tr>
<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr>
 <td align=right ><img src=<?=$dir?>/w_sitelink1.gif border=0>&nbsp;&nbsp;</td>
 <td ><?=$sitelink1?></td>
</tr>
<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
 <td align=right ><img src=<?=$dir?>/w_sitelink2.gif border=0>&nbsp;&nbsp;</td>
 <td ><?=$sitelink2?></td>
</tr>
<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
<?=$hide_sitelink2_end?>

<tr>
 <td align=right  style='word-break:break-all;'><img src=<?=$dir?>/w_subject.gif border=0>&nbsp;&nbsp;</td>
 <td style='word-break:break-all;'><?=$subject?></td>
</tr>

<tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td colspan=2 style='word-break:break-all;padding:10' height=80 bgcolor=f4f4f4>
     <span style=line-height:160%>
     <?=$upload_image1?>
     <?=$upload_image2?>
     <?=$memo?>
<br><tr><td height=1 colspan=6 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td>
     </span>
 </td>
</tr>
</table>
<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
</table>
<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?>>
<tr valign=top>
 <td><img src=<?=$dir?>/c_name.gif border=0>
 <td width=100%>&nbsp;&nbsp;<img src=<?=$dir?>/c_memo.gif border=0></td>
 <td><img src=<?=$dir?>/c_date.gif border=0>
 <td>&nbsp;</td>
</tr>
<?=$hide_comment_end?>