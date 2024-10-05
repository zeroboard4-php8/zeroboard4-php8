</table>

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

<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?> class=robin_viewform>
<tr>
  <td>
	    <table border=0 cellspacing=0 cellpadding=4 width=100% height=100>
          <col width=80></col><col width=></col><col width=80></col> 
          <tr valign=top> 
            <td nowrap height=80> <img src=<?=$dir?>/name_on.gif>
              <?=$c_name?>
              <?=$hide_c_password_start?>
   
              <img src=images/t.gif border=0 height=10><br>
              <font style=font-family:Verdana;font-size:8pt;letter-spacing:-1px;><b><img src=<?=$dir?>/w_password.gif></b></font>
              <input type=password bgcolor=transparent name=password <?=size(8)?> maxlength=20 class=input>
              <?=$hide_c_password_end?>
            </td>
            <td align="center"> 
              <textarea name=memo <?=size(50)?> rows=5 class=textarea></textarea>
            </td>
            <td align="center"> 
              <input type=submit <?php if($browser){?>class=submit<?php }?> value='comment' accesskey="s" style="font-size:8pt;height:75" border=0>
		    </td>
          </tr>
        </table>
  </td>
</tr>
</table>
</form>
