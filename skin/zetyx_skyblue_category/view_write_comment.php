<?php 
 /* 간단한 답글 쓰기 표시

  -- 간단한 답글 관련
  <?=$hide_comment_start?> <?=$hide_comment_end?> : 간단한 답글 쓰기 보여주기/ 숨기기
  <?=$hide_c_password_start?> <?=$hide_c_password_end?> : 간단한 답글시 비밀번호 입력 보여주기/ 숨기기;;

  <?=$c_name?> : 코멘트시 이름 입력하는 곳;;

  ** view.php 제일 아래쪽에 간답한 답글이 시작하는 <table>태그 시작부분이 있습니다.
     그리고 간단한 답글이 있으면 view_comment_view.php 파일에서 출력을 합니다.

 */
?>


<!-- 간단한 답변글 쓰기 -->
<tr><td bgcolor=<?=$sC_dark0?> colspan=10><img src=images/t.gif height=1></td></tr>
<tr align=center height=30>
<td width=0>
<form method=post name=write action=comment_ok.php>
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
</td>
 <td align=center height=70>
 <table border=0 cellspacing=0 cellpadding=1 bgcolor=<?=$sC_dark0?>>
 <tr bgcolor=white>
  <td class=thm8><b>Name&nbsp;&nbsp;</b></td>
  <td class=thm8><b>Memo&nbsp;&nbsp;</b></td>
<?=$hide_c_password_start?>
  <td class=thm8><b>Password&nbsp;&nbsp;</b></td>
<?=$hide_c_password_end?>
  <td bgcolor=white valign=bottom class=thm8 rowspan=2><img src=images/t.gif height=3><br>&nbsp;<input type=image border=0 align=absmiddle src=<?=$dir?>/images/btn_confirm.gif><br><img src=images/t.gif height=3></td>
 </tr>
 <tr bgcolor=white>
  <td><img src=images/t.gif height=3 nowrap width=50><br><?=$c_name?></td>
  <td><img src=images/t.gif height=3><br><input type=text name=memo <?=size(30)?> maxlength=100 class=input></td>
<?=$hide_c_password_start?>
  <td><img src=images/t.gif height=3><br><input type=password name=password <?=size(10)?> maxlength=20 class=input></td>
<?=$hide_c_password_end?>
  </tr>
  </table>
 </td>
</tr>
</form>
</table>
