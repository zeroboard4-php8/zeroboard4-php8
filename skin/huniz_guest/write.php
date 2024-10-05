<div align="center"><br>
<table border="0" cellspacing="0" cellpadding="0" width="550">
  <tr>
    <td width="1">
<!-- 폼태그 부분 수정하지 않는 것이 좋습니다 -->
   <form method="post" name="write" action="write_ok.php" enctype="multipart/form-data">
   <input type="hidden" name=page value=<?=$page?>>
   <input type="hidden" name=id value=<?=$id?>>
   <input type="hidden" name=no value=<?=$no?>>
   <input type="hidden" name=select_arrange value=<?=$select_arrange?>>
   <input type="hidden" name=desc value=<?=$desc?>>
   <input type="hidden" name=page_num value=<?=$page_num?>>
   <input type="hidden" name=keyword value="<?=$keyword?>">
   <input type="hidden" name=category value="<?=$category?>">
   <input type="hidden" name=sn value="<?=$sn?>">
   <input type="hidden" name=ss value="<?=$ss?>">
   <input type="hidden" name=sc value="<?=$sc?>">
   <input type="hidden" name=mode value="<?=$mode?>">
    </td>
  </tr>
  <tr>
    <td valign="top">
      <table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%" align="center">
        <tr>
          <td colspan="2"><input type=hidden name=subject value=" No Subject (guest) " <?=size(30)?> maxlength=200 class=input></td>
        </tr>
        <tr>
          <td>
   	        <table cellpadding="0" cellspacing="0" border="0" style="height:100%;">
            <?=$hide_start?>
			  <tr>
                <td width="50">이&nbsp;&nbsp;&nbsp;름&nbsp;:&nbsp;</td>
                <td><input type="text" name="name" value="<?=$name?>" <?=size(25)?> maxlength="100" class="input">&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td>메&nbsp;&nbsp;&nbsp;일 : </td>
                <td><input type="text" name="emai"l value="<?=$email?>" <?=size(25)?> maxlength="100" class="input"></td>
              </tr>
              <tr>
                <td>사이트 : </td>
                <td><input type="text" name="homepage" value="<?=$homepage?>" <?=size(25)?> maxlength="100" class="input"></td>
              </tr>
              <tr>
                <td>암&nbsp;&nbsp;&nbsp;호 : </td>
                <td><input type="password" name="password" <?=size(25)?> maxlength="100" class="input"></td>
              </tr>
               <?=$hide_end?>
            </table>
          </td>
          <td width="100%"><textarea name="memo" class="textarea" style="width:100%;"><?=!empty($memo)?$memo:''?></textarea></td>
        </tr>
        <tr>
		  <td colspan="3">
		    <table cellpadding="0" cellspacing="0" border="0" width="100%">
		      <tr>
     		    <td valign="middle" width="50%">옵&nbsp;&nbsp;&nbsp;션 : <font class="thm7"><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1><img width="5">NOTICE<img width="5"><?=$hide_notice_end?><?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1><img width="5">HTML<img width="5"><?=$hide_html_end?><input type=checkbox name=reply_mail <?=$reply_mail?> value=1><img width="5">REPLY MAIL</font></td>
                <td align="right" height="23" valign="bottom"><input type="submit" value=" submit " class="submit" style="width:50px;height:20;"></td>
              </tr>
			</table>
		  </td>
		</tr>
      </table>
    </td>
  </tr>
</form>
</table>
</div>