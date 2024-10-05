<?php 
	$comment_name = str_replace(">","><font class=list_main>",$comment_name);
	if($is_admin) $show_comment_ip = "<font class=list_main>| ".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>

<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?>>
<tr>	
 <td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td>
</tr>
<tr>
<td height=13></td>
</tr>
</table>

<table cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=1></col><col width=15></col><col width=90></col><col width=3></col><col width=10></col><col width=></col><col width=80></col><col width=15></col><col width=7></col>

<tr valign=top>
<td class=title_bodyleft>
</td>	   
<td></td>	
<td style='word-break:break-all;'>		

   <table border=0 cellspacing=0 cellpadding=0 width=100%>		 
      
       <tr>			
        <td style='word-break:break-all;'> 
           &nbsp;<NOBR><?=$c_face_image?><?=$comment_name?></b></NOBR>
        </td>		
       </tr>		

   </table>	

</td>	

<td class=line1 bgcolor=#FCFCFC>
</td>	

<td> </td>	

<td style='word-break:break-all;'><font class=list_han><?=nl2br($c_memo)?></font>
</td>	

<td align=right>
   <font class=thm7pt><?=date("Y-m-d",$c_data['reg_date'])?></font><br>
   <font class=thm7pt><?=$a_del?>del</font></a> 
</td>
<td></td>
<td class=title_bodyright>
</td>	
</tr>

<tr valign=top>
<td class=title_bodyleft></td>	   
<td height=15></td>	
<td></td>	
<td></td>	
<td></td>	
<td></td>	
<td></td>
<td></td>
<td class=title_bodyright></td>	
</tr>
</table>
