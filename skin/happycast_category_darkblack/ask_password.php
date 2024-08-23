<?php include "$dir/value.php3"; ?>
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
<table width=300 border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>><tr><td><img src=images/t.gif height=3></td></tr></table>

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
  <td colspan=2 height=30>&nbsp;&nbsp;<font class=view_title1>Enter</font> <font class=view_title2>Password</font></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
<tr bgcolor=<?=$view_left_header_color?>>
   <td align=center height=40><?=$input_password?></td></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>

<tr height=30>
  <td colspan=2 align=right>
     <input type=image border=0 src=<?=$dir?>/btn_confirm.gif onfocus=blur()> <?=$a_list?><img src=<?=$dir?>/i_list.gif border=0></a> <?=$a_view?><img src=<?=$dir?>/btn_back.gif border=0></a>
  </td>
</tr>
</table>
<br><br>
