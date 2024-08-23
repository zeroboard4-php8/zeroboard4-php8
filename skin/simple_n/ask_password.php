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
<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></a></tr>
<tr>
	<td align=center bgcolor=fafafa height=25 class=yeinsub><b>Error Messege</b></td>
</tr>
<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></td></tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=250>
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
   <td align=center><br><b><?=$title?></b><br><br></td>
</tr>

<tr height=30>
	<td align=center>
		<?=$input_password?>
	</td>
</tr>

<tr><td bgcolor=#D8D8D8><img width=1 height=1 border=0></td></tr>

<tr>
	<td height=40 align=center>
     <input type=submit border=0 value="O.K" onfocus=blur() align=absmiddle class=yeinsubmit>
     <input type=button value="BACK" onfocus=blur() align=absmiddle border=0 onclick=history.go(-1) class=yeinsubmit>
	</td>
</tr>

</table>
</form>

