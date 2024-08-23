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
  include "$dir/value.php3";
?>

<table><td height=33></td></table>
<div align=center>
<table border=0 cellpadding=0 cellspacing=0 width=250>
<tr>
<td width=1 bgcolor='<?=$head_border?>'><img width=1 height=33></td>
<td background=<?=$dir?>/images/head_bg.gif><img width=1 height=13></td>
<td width=1 bgcolor='<?=$head_border?>'><img width=1 height=33></td>
</tr>
</table>
<table border=0 width=250>
<form method=post name=delete action=<?=$target?>><input type=hidden name=page v
alue=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=c_no value=<?=$c_no?>>
<tr>
<td align=center height=50>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr align=right>
<td><span style="font-size:9pt;">비밀번호</span></td>
<td width=140><?=$input_password?></td>
</tr>
</table>
</td>
<tr><td height=1 bgcolor='<?=$all_foot_line?>'></td></tr>
<tr><td height=5></td></tr>
</tr>
<tr>
<td colspan=2 align=right><input type=image src=<?=$dir?>/images/i_confirm.gif><img width=10 height=1><a href=javascript:history.go(-1)><img src=<?=$dir?>/images/i_back.gif border=0></a></td>
</tr>
</table>
