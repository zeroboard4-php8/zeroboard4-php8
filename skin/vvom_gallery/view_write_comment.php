
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=1></col><col width=20></col><col width=></col><col width=20></col><col width=7></col>

   <tr>  
       <td class=title_bodyleft></td>	   
       <td></td>
       <td>			
                 <script>			function check_comment_submit(obj) {				if(obj.memo.value.length<10) {					alert("코멘트는 10자 이상 적어주세요");					obj.memo.focus();					return false;				}				return true;			}		</script>		
                 <form method=post name=write action=comment_ok.php onsubmit="return check_comment_submit(this)">
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

                    <table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor=#FFFFFF>
                    <tr>
                      <td align=right>
                        <table border=0 cellpadding=0 cellspacing=0>
                        <tr>
                        <td align=right valign=bottom>
                         <font class=thm7pt><b>Name&nbsp;</b></font><?=$face_image?><?=$c_name?><?=$hide_c_password_start?>&nbsp;<font class=thm7pt><b>Pass&nbsp;</b></font>&nbsp;<input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?>
                        &nbsp;<input type=image src=<?=$dir?>/dasom_img/dasomver3_ok.gif border=0>
                      </td>
                    </tr>
                    <tr>
                      <td align=right>
                        <textarea name=memo cols=40 rows=4 class=textarea></textarea>
                      </td>
                      <td>
                      </td>
                    </tr>
                    </table> 
                      </td>
                    </tr>
                    </table> 
         <br><br>
       </td>
       <td bgcolor=#FFFFFF></td>
       <td class=title_bodyright></td>	
  </tr>
