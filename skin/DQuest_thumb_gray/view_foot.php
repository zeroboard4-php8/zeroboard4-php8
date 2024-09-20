
<?php 
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_list)."&nbsp;&nbsp;";
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_reply)."&nbsp;&nbsp;";
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_modify)."&nbsp;&nbsp;";
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_delete)."&nbsp;&nbsp;";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_write)."&nbsp;&nbsp;";
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=thumb_han2 style=font-weight:bold>",$a_vote)."&nbsp;&nbsp;";
?>

<?php if($member['level']>$setup['grant_comment']){?>
<table border=0 cellspacing=0 cellpadding=5 height=5 width=<?=$width?>>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr class=thumb_bg>
  <td align=center>
    <font class=thumb_han2><?=$_comment_guide?></font>  <?=$a_login?>[로그인]</a><?php ?>
  </td>
</tr>
</table>
<?php }?>

<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?> class=thumb_bg>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>
<table width=<?=$width?> cellspacing=0 cellpadding=0 class=thumb_bg>
<tr><td height=3><img src=<?=$dir?>/t.gif border=0 height=3></td></tr>
<tr>
 <td height=30>
    <?=$a_reply?>답글달기</a>
    <?=$a_modify?>수정하기</a>
    <?=$a_delete?>삭제하기</a>
    <?php //자신의 글에 추천하는것을 방지
	if ($member['no'] != $data['ismember']) {?><?=$a_vote?>추천하기</a>
	<?php }?>
	
 </td>
 <td align=right>
    <?=$a_list?>목록보기</a>
    <?=$a_write?><?=$_write_style?></a><img src=<?=$dir?>/t.gif width=10>
 </td>
</tr>
<tr><td colspan=2 height=1 class=line2 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td colspan=2 height=1 class=line3 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>

