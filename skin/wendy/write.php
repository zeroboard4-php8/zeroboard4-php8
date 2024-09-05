<div align=center><table border=0 cellspacing=0 cellpadding=0 class=writewidth> <tr>  <td width=1>   
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
   <form method=post name=write action=write_ok.php enctype=multipart/form-data>
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
   <!----------------------------------------------->  
   </td>
   </tr> 
   <tr>  
   <td align=center colspan=2> <?=$title?> 
   </td>
   </tr>    
   <tr>     
   <td valign=top>      
   <table border=0 cellsapcing=0 cellpadding=0 width=100% height=100% align=center>      
   <tr>
   <td><input type=hidden name=subject value="Guest" <?=size(34)?> maxlength=200 class=input></td></tr>      
   <?=$hide_start?>       
   <tr>
   <td class=small>&nbsp&nbsp&nbsp닉네임&nbsp;<input type=text name=name value="<?=$name?>" <?=size(15)?> maxlength=20 class=input>       
   </td>
   </tr>       
   <tr>
   <td class=small>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp비번&nbsp;<input type=password name=password <?=size(15)?> maxlength=20 class=input>
   </td>
   </tr>   
   <tr>
   <td class=small>&nbsp&nbsp&nbsp이메일&nbsp;<input type=text name=email value="<?=$email?>" <?=size(30)?> maxlength=200 class=input>
   </td>
    </tr>
   <tr>
   <td class=small>홈페이지&nbsp;<input type=text name=homepage value="<?=$homepage?>" <?=size(30)?> maxlength=200 class=input>       
   </td>
   </tr>       
   <?=$hide_end?>       
   <tr>        
   <td>
   <table border=0 cellspacing=0 cellpadding=0 width=100%>
   <tr>
   <td align=center width=190 class=small>
   <?=$hide_notice_start?>
   <input type=checkbox name=notice <?=$notice?> value=1><img src=<?=$dir?>/notice.gif border=0> <?=$hide_notice_end?>
   <?=$hide_html_start?>
   <input type=checkbox name=use_html <?=$use_html?> value=1><img src=<?=$dir?>/html.gif border=0> <?=$hide_html_end?>
   <input type=checkbox name=reply_mail <?=$reply_mail?> value=1><img src=<?=$dir?>/rmail.gif border=0></td>
   </td>
   </tr>
   </table>        
   </td>
   </tr>       
   <tr><td><table border=0 cellspacing=0 cellpadding=1 width=100%>
   <tr>
   <td><textarea name=memo <?=size2(30)?> rows=13 class=textarea><?=$memo?></textarea></td>
   </tr>
   </table>
   </td>
   </tr>       
   <tr>        
   <td align=center height=18 valign=bottom>
   <input type=image src=<?=$dir?>/confirm_l.gif border=0 onfocus=blur()>
   <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/back_l.gif border=0></a>  
   </td>       
   </tr>      
   </table>  
   </td> 
   </tr>
   </form>
   </table>
   </div>