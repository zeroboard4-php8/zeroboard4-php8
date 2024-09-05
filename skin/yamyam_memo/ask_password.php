
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
<div align=center>
 
  <table border=0 cellspacing=0 cellpadding=0 width=300>
<tr>
  <td><img src=<?=$dir?>/img/trans.gif border=0 width=23 height=1><img src=<?=$dir?>/img/b.gif width="52" height="34" border="0"></td>
   <td nowrap align=right><img src=<?=$dir?>/img/trans.gif height=1 width=1></td>
	  </tr>
	  <tr>
   <td background=<?=$dir?>/img/line.gif width="8" height="6" border="0">

  </td>
<td background=<?=$dir?>/img/line.gif width="8" height="6" border="0" align=right>

</td>
	   </tr>
   </table>
   
	

<table border=0 width=300 cellpadding=0 cellspacing=0>
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
  <td colspan=2 height=30>&nbsp;&nbsp;진짜로 삭제 하실려구요?^^;;</td>
</tr>

<tr>
   <td align=center height=40><?=$input_password?></td></td>
</tr>

  <tr>
   <td background=<?=$dir?>/img/line.gif width="8" height="6" border="0">

  </td>
<td background=<?=$dir?>/img/line.gif width="8" height="6" border="0" align=right>

</td>
	   </tr>
<tr height=30>
  <td colspan=2 align=right>
     <input type=image border=0 src=<?=$dir?>/img/btn_confirm.gif onfocus=blur()> <?=$a_list?><img src=<?=$dir?>/img/i_list.gif border=0></a> <?=$a_view?><img src=<?=$dir?>/img/btn_back.gif border=0></a>
  </td>
</tr>
</table>
<br><br>
