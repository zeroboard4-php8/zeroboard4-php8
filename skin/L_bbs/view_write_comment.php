</table>
<div align=center>
<table border=0 cellspacing=0 width=<?=$width?>>
<col width=1></col><col></col><col width=1></col>
<tr>
<td width=1>
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
</td><tr><td height=1 colspan=6 background=<?=$dir?>/dot.gif height=1></td></tr>
<td align=right>

  <img src=<?=$dir?>/t.gif border=0 height=1><Br>
  <table border=0 cellpadding=0 cellspacing=0  class=kissofgod-write-commentbox>
  <tr>
    <td style='padding-top:5' style='font-family:Lfont'>이름&nbsp;&nbsp;<?=$c_name?>
    <?=$hide_c_password_start?>비밀번호&nbsp;&nbsp;<input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td>
  <tr><td><textarea name=memo cols=60 rows=4 class='TEXTAREA' style='overflow:auto'></textarea></td>
  </tr> 
  <tr>
  <td>
  <input type=submit style=font-family:Lfont class=submit class=height:20px value='                            확    인                           '></td>
  </tr>
  </table>

  </td>
  </tr>
  </form>
  </table>

<img src=images/t.gif border=0 height=20><br>
</div>

<?=$hide_comment_end?>