  <table width="551" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><img src="<?=$dir?>/box1_top.gif" width="551" height="5"></td>
  </tr>
  <tr>
    <td background="<?=$dir?>/box1_bg.gif" valign=top>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="background-image: url(<?=$dir?>/box1_bottom.gif); background-repeat: no-repeat; background-position: bottom" valign="top"> 

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td valign="top"> 

           <table width="100%" border="0" cellspacing="1" cellpadding="0">
           <tr> 
             <td height="25" bgcolor="#e0e0e0"><img src="<?=$dir?>/t.gif" width="5" height="3"><br>
             &nbsp;&nbsp;&nbsp;<b>[공지사항]</b> <?=stripslashes($data['subject'])?></td>
           </tr>
<?php
 if($sitelink1)
 {
?>
           <tr>
             <td style="font-family:Arial;font-size:7pt;font-weight:bold;">&nbsp;&nbsp;
              Homepage : <a href=<?=$sitelink1?> target=_blank><?=$sitelink1?></a>
             </td>
           </tr>
<?php } ?>

<?php
 if($sitelink2)
 {
?>
           <tr>
             <td style="font-family:Arial;font-size:7pt;font-weight:bold;">&nbsp;&nbsp;
              Link File : <a href=<?=$sitelink2?> target=_blank><?=$sitelink2?></a>
             </td>
           </tr>
<?php } ?>

<?php
 if($file_size1)
 {
?>
           <tr>
             <td style="font-family:Arial;font-size:7pt;font-weight:bold;">&nbsp;&nbsp;
             Download : <?=$a_file_link1?><?=$data[s_file_name1]?></a> (Size : <?=$file_size1?>, Download : <?=$download1?>)</td>
           </tr>

<?php } ?>
           
           <tr> 
             <td style="padding:10px;">

<?php
  if(eregi("\.jpg",$file_name2)||eregi("\.gif",$file_name2)) echo"<img src='data/$data[s_file_name2]' border=1 align=left>";
?>

              <?=$memo?>

             </td>
           </tr>

           </table>

           &nbsp; <?=$a_modify?>[수정]</a><?=$a_delete?>[삭제]</a>
           <br>
           <img src="<?=$dir?>/t.gif" width="5" height="5">

         </td>
       </tr>
    </table>
                        
    </td>
   </tr>
   </table>

  </td>
 </tr>
</table>
<Br>
