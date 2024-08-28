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


<?php
 /* 간단한 답변글 쓰기  */
?>
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

<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> >
<tr>
  <td>	
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr><td height=20></td></tr>
		<tr>
		<td class=ver7>&nbsp;<img src=<?=$dir?>/co_name.gif border=0 align=absmiddle>&nbsp; <?=$c_name?>&nbsp;&nbsp;
		<?=$hide_c_password_start?><img src=<?=$dir?>/co_pass.gif border=0 align=absmiddle>&nbsp; 
		<input type=password name=password <?=size(8)?> maxlength=20 class=input>
		<?=$hide_c_password_end?></b>
		</td>
		</tr>
		<tr>
		<td><textarea name="memo" class="pqbig-textarea" style="width:100%; height:50px;" style='overflow:auto'></textarea></td>
		</tr>
		<tr>
		<td align=right>
		<input type=image src=<?=$dir?>/co_comment.gif border=0 onfocus=blur() accesskey="s" style="cursor:hand">&nbsp;
		</td>
		</tr>
		</table>




  </td>
</tr>
</table>
</form>
</div> 