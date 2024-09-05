<!-- 로그인하지 않았을때 링크 걸리지 않게 했습니다 (modified by heybuba)-->

<?php 
   if($member['is_admin'] == ""){
     $a_delete = "<a href=\"#\">";
   }
?>

  <table border="0" width="<?=$width?>" cellspacing="0" cellpadding="0">
                <tr>
               
<td  width="10%" align=left><?=$a_delete?><?php echo "<font color={$data['sitelink2']}>" ?><?=stripslashes($data['name'])?></a></td>
<td width="75%"align=left>&nbsp;<?php echo "
<font color={$data['sitelink2']}>" ?><?=stripslashes($data['memo'])?></td>
<td width="5%"align=right><?=$date=date("m/d",$data['reg_date'])?></td>
                </tr>
                </table>
