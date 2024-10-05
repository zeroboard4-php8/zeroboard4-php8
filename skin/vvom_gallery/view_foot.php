<?php 
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=thm7pt>",$a_list);
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=thm7pt>",$a_reply);
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=thm7pt>",$a_modify);
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=thm7pt>",$a_delete);
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=thm7pt>",$a_write);
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=thm7pt>",$a_vote);
?>

<img src=/images/t.gif border=0 height=4><br>

<table width=<?=$width?> cellspacing=0 cellpadding=0>
 <tr>
  <td height=30>
     &nbsp;<?=$a_delete?><img src="<?=$dir?>/dasom_img/delete.gif" border=0></a>  <?=$a_modify?><img src="<?=$dir?>/dasom_img/modify.gif" border=0></a>  <?=$a_reply?><img src="<?=$dir?>/dasom_img/reply.gif" border=0></a>  
 </td>
  <td align=right>
    <?=$a_vote?><img src="<?=$dir?>/dasom_img/vote.gif" border=0></a> <?=$a_write?><img src="<?=$dir?>/dasom_img/write.gif" border=0></a>  <?=$a_list?><img src="<?=$dir?>/dasom_img/list.gif" border=0></a> &nbsp;
  </td>
 </tr>
</table>
<br>