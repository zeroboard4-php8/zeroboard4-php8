<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td align=right style='font-family:Tahoma; font-size:8pt'>
    <?=$a_login?>&nbsp;Login&nbsp;</a>
    <?=$a_member_join?>&nbsp;Join&nbsp;</a>
    <?=$a_member_modify?>&nbsp;modifyINFO&nbsp;</a>
    <?=$member_memo_icon?><?=$a_member_memo?>&nbsp;memobox&nbsp;</a>
    <?=$a_logout?>&nbsp;logout&nbsp;</a>
    <?=$a_setup?>&nbsp;setup&nbsp;</a>
    &nbsp;
  </td>
</tr>
</table>
  
<?php 
  // 방명록 사용시 아래줄을 삭제 하면 안됩니다. 꼭!! 
  include "include/write.php";
?>
