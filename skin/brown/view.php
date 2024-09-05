
<!--테이블 시작-->
 <table cellpadding="0" cellspacing="0" width=<?=$width?> style="table-layout:fixed"> 
<tr>
	  <td background="<?=$dir?>/s_bottom_bg.gif"><img src="<?=$dir?>/s_bottom_bg.gif" border="0"></td>
	</tr>
<tr> 
  <td> <table cellpadding="0" cellspacing="0" width=100% style="table-layout:fixed"> 
    <tr> 
      <td height="30"> <table cellpadding="0" cellspacing="0" width=100%> 
          <tr> 
            <td style='word-break:break-all;'><b> 
              <?=$subject?> 
              </b></td> 
            <td align=right width=100 class="ver7"><?=$reg_date?></td> 
          </tr> 
        </table></td> 
    </tr> 
	<tr>
	  <td background="<?=$dir?>/s_top_bg.gif"><img src="<?=$dir?>/s_top_bg.gif" border="0"></td>
	</tr>
    <tr> 
      <td height="30"> <!--테이블 시작--> 
        <table cellpadding="0" cellspacing="0" width=100%> 
          <tr> 
            <td height="20"> 
              <?=$name?> 님의 글입니다.</td> 
          </tr> 
        </table> 
        <!--테이블 끝--> </td> 
    </tr> 
	<tr>
	  <td background="<?=$dir?>/s_bottom_bg.gif"><img src="<?=$dir?>/s_bottom_bg.gif" border="0"></td>
	</tr>
    <tr> 
      <td height=20></td> 
    </tr> 
    <tr> 
      <td> <?=$upload_image1?><br>
     <?=$upload_image2?>
	<?=$memo?><br>
<?php 
$sign = zReadFile("./icon/sign/$data['ismember']_sign.php");
$sign = stripslashes($sign);
if($sign){
?>
        <!--테이블 시작--> 
        <table border=0 cellspacing=0 cellpadding=0 align=center style='table-layout:fixed' width=100%>  
            <td align=right width=100%> <?=$sign?> </td> 
          </tr> </table> 
        <!--테이블 끝--> 
        <?php }?> </td> 
    </tr> 
    <tr> 
      <td> <!--테이블 시작--> 
        <table cellpadding="0" cellspacing="0" width=100%> 
          <tr> 
            <td width=170 valign=bottom class=color height="15"></td> 
            <td valign=bottom class="ver8" align="right"><?=$hide_sitelink1_start?> 
              <img src=<?=$dir?>/link.gif border=0 align="absmiddle"> 
              <?=$sitelink1?> 
              <br> 
              <?=$hide_sitelink1_end?> 
              <?=$hide_sitelink2_start?> 
              <img src=<?=$dir?>/link.gif border=0 align="absmiddle"> 
              <?=$sitelink2?> 
              <br> 
              <?=$hide_sitelink2_end?> 
              <?=$hide_download1_start?> 
              <img src=<?=$dir?>/download.gif border=0 align="absmiddle"> 
              <?=$a_file_link1?> 
              <?=$file_name1?> 
              ( 
              <?=$file_size1?> 
              )</a> &nbsp; download :
              <?=$file_download1?> 
              <br> 
              <?=$hide_download1_end?> 
              <?=$hide_download2_start?> 
              <img src=<?=$dir?>/download.gif border=0 align="absmiddle"> 
              <?=$a_file_link2?> 
              <?=$file_name2?> 
              ( 
              <?=$file_size2?> 
              )</a> &nbsp; download :
              <?=$file_download2?> 
              <?=$hide_download2_end?></td> 
          </tr> 
        </table> 
        <!--테이블 끝--> </td> 
    </tr> 
    <tr> 
      <td height=5></td> 
    </tr> 
    <tr> 
      <td><!-- 간단한 답글 시작하는 부분 --> 
        <!--테이블 시작--> 
        <table cellpadding="0" cellspacing="0" width="100%"> 
        <?=$hide_comment_start?> 
