<?php if ($_temp) { //섬네일 이미지가 가로 갯수만큼 채워지지 않았을때 ?>
  </tr>
  <tr><td colspan=<?=$_hcol?> height=10 class=thumb_area_bg><img src=<?=$dir?>/t.gif border=0 height=10></td></tr>
</table>
</div>
</td></tr></table>
<?php }?>

</td>
<tr><td height=10 class=thumb_area_bg><img src=<?=$dir?>/t.gif border=0 height=10></td></tr>
</tr></table>

</td></tr>
</form>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> class=thumb_bg>

<?php if(!eregi("<Zeroboard",$a_login)||!eregi("<Zeroboard",$a_logout)||!eregi("<Zeroboard",$a_setup)||!eregi("<!--",$hide_category_start)) $show_line=true;?>

<?php if($show_line){?>
<tr><td height=0 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td height=2><img src=<?=$dir?>/t.gif border=0 height=2></td></tr>
<tr>
  <td>
    <table border=0 cellpadding=0 cellspacing=0 width=100% class=thumb_bg>
		<tr>
			<td style=padding-left:4px>
				<?=$a_login?>로그인</a>
				<?=$a_member_join?>회원가입</a>
				<?=$a_member_modify?>정보수정</a>
				<?=$a_member_memo?>메모박스</a>
				<?=$a_logout?>로그아웃</a>
				<?=$a_setup?>설정변경(관리자용)</a>
			</td>
		<?=$hide_category_start?>
			<td align=right valign=top style="padding-right:5px;"><nobr><?=$a_category?></nobr></td>
		<?=$hide_category_end?>
		<tr><td height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
		</tr>
	</table>
  </td>
</tr>
<?php }?>

<tr><td height=1 class=line2 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>

<?php 
	if(isset($a_list) && !eregi("Zeroboard",$a_list) && !eregi("&nbsp;&nbsp;",$a_list))
		$a_list = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_list)."&nbsp;&nbsp;";
	if(isset($delete_all) && !eregi("Zeroboard",$delete_all) && !eregi("&nbsp;&nbsp;",$delete_all))
		$a_delete_all = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_delete_all)."&nbsp;&nbsp;";
	if(isset($a_1_prev_page) && !eregi("Zeroboard",$a_1_prev_page) && !eregi("&nbsp;&nbsp;",$a_1_prev_page))
		$a_1_prev_page = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_1_prev_page)."&nbsp;&nbsp;";
	if(isset($a_1_next_page) && !eregi("Zeroboard",$a_1_next_page) && !eregi("&nbsp;&nbsp;",$a_1_next_page))
		$a_1_next_page = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_1_next_page)."&nbsp;&nbsp;";
	if(isset($a_write) && !eregi("Zeroboard",$a_write) && !eregi("&nbsp;&nbsp;",$a_write))
		$a_write = str_replace(">","><font class=thumb_han2 style=font-weight:bold>",$a_write)."&nbsp;&nbsp;";
	if(isset($a_prev_page) && !eregi("Zeroboard",$a_prev_page) && !eregi("&nbsp;&nbsp;",$a_prev_page))
		$a_prev_page = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_prev_page)."&nbsp;&nbsp;";
	if(isset($a_next_page) && !eregi("Zeroboard",$a_next_page) && !eregi("&nbsp;&nbsp;",$a_next_page))
		$a_next_page = str_replace(">","><font class=thumb_han style=font-weight:bold>",$a_next_page)."&nbsp;&nbsp;";
	$print_page = str_replace("<font style=font-size:8pt>","<font class=thumb_han>",$print_page);
	$print_page = str_replace("계속 검색","<font class=list_han>계속 검색</font>",$print_page);
	$print_page = str_replace("이전 검색","<font class=list_han>계속 검색</font>",$print_page);
?>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> class=thumb_bg>
<tr><td height=5><img src=<?=$dir?>/t.gif border=0 height=5></td></tr>
<tr valign=top>
	<td><nobr>
		<?=$a_list?>목록보기</a>
		<?=$a_delete_all?>게시물정리</a>
		<?=$a_1_prev_page?>이전페이지</a>
		<?=$a_1_next_page?>다음페이지</a>
		<?=$a_write?><?=$_write_style?></a>
		</nobr>
	</td>
</tr>
<tr valign=top>
	<td align=right style="padding-right:5px;"><nobr>
		<?=$a_prev_page?>[이전 <?=$setup['page_num']?>개]</a></font> <?=$print_page?> <?=$a_next_page?>[다음 <?=$setup['page_num']?>개]</font></a></nobr></td>
</tr>
	</form>
<tr>
	<td align=right colspan=2 style="padding-right:5px;">
		<table border=0 cellspacing=0 cellpadding=0>
		<form method=get name=search action=<?=$PHP_SELF?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="off"><input type=hidden name=category value="<?=$category?>">
		<tr>
			<td><nobr>
				<a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>&nbsp;
				<a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>&nbsp;&nbsp;
				<a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>&nbsp;&nbsp;
				</nobr>
			</td>
			<td><input type=text name=keyword value="<?=$keyword?>" class=input size=20></td>
			<td><input type=submit class=submit value="검색"></td>
			<td><input type=button class=button value="취소" onclick="location.href='zboard.php?id=<?=$id?>'"></td>
		</tr>
		</form>
		</table>
		</nobr>
	</td>
</tr>
<tr><td colspan=2 height=7><img src=<?=$dir?>/t.gif border=0 height=7></td></tr>
<tr><td colspan=2 height=1 class=line2 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td colspan=2 height=1 class=line3 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
</table>
