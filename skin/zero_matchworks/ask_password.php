<?php
  /*
  글을 삭제하거나 할때 비밀번호를 물어보는 부분입니다
 
  <?=$target?> : 실행파일을 가리킵니다. 수정하지 마세요;;;
  <?=$title?> : 타이틀을 출력합니다

  <?=$a_list?> : 목록보기 링크
  <?=$a_view?> : 내용보기 링크

  <?=$invisible?> : 멤버나 관리자가 삭제시 삭제 버튼만 보입니다;;

  <?=$input_password?> : 비밀번호를 물어보는 input=text 출력 
  */
?>

<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
 <td><img src=<?=$dir?>/h_left.gif border=0></td>
 <td background=<?=$dir?>/h_bg.gif width=100%><img src=<?=$dir?>/h_bg.gif border=0></td>
 <td><img src=<?=$dir?>/h_right.gif border=0></td>
</tr>
</table>
<table border=0 width=250>
<form method=post name=delete action=<?=$target?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
   <td align=center><b><?=$title?></b></td>
</tr>
<tr height=50>
   <td align=center>
     <?=$input_password?> 
     <br><br><input type=image src=<?=$dir?>/i_confirm.gif border=0>
     <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0></a>
     <a href=javascript:void(history.back())><img src=<?=$dir?>/i_back.gif border=0></a>
   </td>
</tr>
</table>
</form>

