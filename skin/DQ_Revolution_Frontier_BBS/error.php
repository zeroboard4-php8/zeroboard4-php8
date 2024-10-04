<?php 
if(eregi(basename(__FILE__),$_SERVER['PHP_SELF'])) die('정상적인 접근이 아닙니다.');
//스킨 환경설정 읽어옴
	if(!$dir) $dir = '.';
	include $dir."/get_config.php";
?>
<table width="<?=$setup['table_width']?>" border="0" cellpadding="0" cellspacing="0">
<tr><td align="center">
	<br><br><br>
	<table border="0" cellspacing="2">
	<tr><td class="info_bg">
		<table border="0" cellpading="0" cellspacing="0" cellpadding="0">
		<tr><td align="center" height="25"><b class="han">알립니다.</b></td></tr>
		<tr><td class="lined"><img src="<?=$dir?>/t.gif" height="1px"></td></tr>
		<tr><td align="center" class="han" style="padding:15px;line-height:160%"><?=$message?></td></tr>
		<tr><td class="lined"><img src="<?=$dir?>/t.gif" height="1px"></td></tr>
		<tr><td height="30px">
		<?php if(!$url){ ?>
		  <div align="center">
          <a href="javascript:history.back()"><font class="han">[이전 화면]</font></a></div>
		<?php } else { ?>
		  <div align="center"><a href="javascript:location.href='<?=$url?>'"><font class="han">[페이지 이동]</font></a></div>

		<?php }?>
		</td></tr>
		</table>
	</td></tr></table>
	<br><br><br>
  </td>
<tr><td class="lined"><img src="<?=$dir?>/t.gif" height="1px"></td></tr>
</tr>
</table>
</form>
