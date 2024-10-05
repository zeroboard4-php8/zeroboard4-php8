</table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td bgcolor=#ffffff>
<img src=<?=$dir?>/t.gif border=0 height=3><br>
</td>
</tr>
<tr>
<td height=1 bgcolor=#F1F1F1></td>
</tr>
<tr>
<td bgcolor=#ffffff>
<img src=<?=$dir?>/t.gif border=0 height=3><br>
</td>
</tr>

          </form>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

<?php 
if(!eregi("Zeroboard",$a_login)) $a_login= str_replace(">","><font class=thm7pt>",$a_login); 
if(!eregi("Zeroboard",$a_logout)) $a_logout= str_replace(">","><font class=thm7pt>",$a_logout);
if(!eregi("Zeroboard",$a_setup)) $a_setup= str_replace(">","><font class=thm7pt>",$a_setup);
if(!eregi("Zeroboard",$a_member_join)) $a_member_join= str_replace(">","><font class=thm7pt>",$a_member_join);
if(!eregi("Zeroboard",$a_member_modify)) $a_member_modify= str_replace(">","><font class=thm7pt>",$a_member_modify);
if(!eregi("Zeroboard",$a_member_memo)) $a_member_memo= str_replace(">","><font class=thm7pt>",$a_member_memo);
$print_page = str_replace("<font style=font-size:8pt>","<font class=thm7pt>",$print_page);	
$print_page = str_replace("계속 검색","<font class=list_main>계속 검색",$print_page);	
$print_page = str_replace("이전 검색","<font class=list_main>계속 검색",$print_page);
?>
<form method=post name=search action=<?=$PHP_SELF?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=sn value="on">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">
<input type=hidden name=category value="<?=$category?>">

<col width=></col><col width=></col><col width=></col>

<tr valign=top>
<td align=left valign=top class=thm7pt>
&nbsp; <?=$a_setup?><img src="<?=$dir?>/dasom_img/setup.gif" border=0></a> <?=$a_member_join?><img src="<?=$dir?>/dasom_img/join.gif" border=0></a> <?=$a_logout?><img src="<?=$dir?>/dasom_img/logout.gif" border=0></a> <?=$a_login?><img src="<?=$dir?>/dasom_img/login.gif" border=0></a>	
</td>

<td align=center valign=middle>
<font class=thm7pt><?=$a_prev_page?>{prev}</a>&nbsp;<?=$print_page?>&nbsp;<?=$a_next_page?>{next}</a></font><br><br>
<input type=text name=keyword value="<?=$keyword?>" class=input_vvom size=10><input onfocus=blur() type=image border=0 src=<?=$dir?>/dasom_img/search_ok.gif border=0><?=$a_cancel?><img src=<?=$dir?>/dasom_img/cancle.gif border=0></a>
</td>

<td align=right valign=top>				
        <table border=0 cellspacing=0 cellpadding=0>		
          <tr>			  
               <td align=right valign=top class=thm7pt>
                <?=$a_delete_all?><img src="<?=$dir?>/dasom_img/admin.gif" border=0></a> <?=$a_write?><img src="<?=$dir?>/dasom_img/write.gif" border=0></a> <?=$a_list?><img src="<?=$dir?>/dasom_img/list.gif" border=0></a> &nbsp;
               </td>		
          </tr>				
        </table>	

</td>
</tr>
</table>
<br>