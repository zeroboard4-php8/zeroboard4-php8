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

</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td align='<?=$comment_write_align?>' bgcolor='<?=$comment_write_bg?>' style='padding:10 5'>

<table border=0 cellspacing=0 cellpadding=0>
<form method=post name=write action=comment_ok.php><input type=hidden name=page value=<?=$page?>>
<tr>
  <td colspan=2><textarea name=memo rows=<?=$comment_write_height?> class=textarea style=width:<?=$comment_write_width?>></textarea></td>
</tr>
<tr>
  <td><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value="<?=$mode?>"><img src=<?=$dir?>/images/write_name.gif width=22 height=5> <font class=thm7>:</font>  <?=$c_name?><?=$hide_c_password_start?>&nbsp; <img src=<?=$dir?>/images/write_password.gif width=49 height=5> <font class=thm7>:</font> <input type=password name=password <?=size(10)?> maxlength=20 class=input><?=$hide_c_password_end?></td>
  <td align=right><input type=submit value="Comment" accesskey="s" class=submit style="font-size:7pt;height:18"></td>  
</tr>
</form>
</table>

</td>
</tr>
</table>

<?=$hide_comment_end?>