<?php

if(!preg_match("/Zeroboard/i",$a_login)) $a_login= str_replace(">","><font class=list_han>",$a_login)."&nbsp;";

if(!preg_match("/Zeroboard/i",$a_logout)) $a_logout= str_replace(">","><font class=list_han>",$a_logout)."&nbsp;";

if(!preg_match("/Zeroboard/i",$a_setup)) $a_setup= str_replace(">","><font class=list_han>",$a_setup)."&nbsp;";

if(!preg_match("/Zeroboard/i",$a_member_join)) $a_member_join= str_replace(">","><font class=list_han>",$a_member_join)."&nbsp;";

if(!preg_match("/Zeroboard/i",$a_member_modify)) $a_member_modify= str_replace(">","><font class=list_han>",$a_member_modify)."&nbsp;";

if(!preg_match("/Zeroboard/i",$a_member_memo)) $a_member_memo= str_replace(">","><font class=list_han>",$a_member_memo)."&nbsp;";

?>



<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<?=$memo_on_sound?>

<tr>

	<td <?php if(!$setup['use_category']) echo"align=right";?>>

		<?=$a_login?>로그인</a>

		<?=$a_member_join?>회원가입</a>

		<?=$a_member_modify?>정보수정</a>

		<?=$a_member_memo?>메모박스</a>

		<?=$a_logout?>로그아웃</a>

		<?=$a_setup?>설정변경</a>

		
	</td>

</tr>

</table>

