<?php include "$dir/value.php3"; ?>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=450>
  <tr>
 <td align=center><?=$write_str?></td>
</tr>

</table>
<table border=0 cellspacing=1 cellpadding=0 width=90% style='margin-top:10'>
  <tr>
 <td width=1>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
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
    <Td>
      <table width=450 border=0 cellpadding=0 cellspacing=0 align="center">
        <tr> 
          <td colspan=2 bgcolor=<?=$sC_line02?>><img src=<?=$dir?>/images/t.gif border=0 align=absmiddle width=1 height=1></td>
        </tr>
        <tr> 
          <td colspan=2 height=5 bgcolor=<?=$sC_color?>></td>
        </tr>
        <?=$hide_start?>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_name.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=name value="<?=$name?>" <?=size(19)?>  maxlength=20 class=input>
            　<img src=<?=$dir?>/images/w_pass.gif border=0 align=absmiddle>
            <input type=password name=password <?=size(18)?> maxlength=20 class=input>
          </td>
        </tr>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_mail.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=email value="<?=$email?>" <?=size(30)?> style='width:85%; height:18px' maxlength=200 class=input >
          </td>
        </tr>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_homepage.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=homepage value="<?=$homepage?>" <?=size(30)?> style='width:85%; height:18px' maxlength=200 class=input>
          </td>
        </tr>
        <?=$hide_end?>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_subject.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=subject value="<?=$subject?>" <?=size(30)?> style='width:85%; height:18px' maxlength=200 class=input>
          </td>
        </tr>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
	 <?=$hide_category_start?>
	<tr> 
	<td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_ca.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
              <?=$category_kind?>
          </td>
        </tr>
	<?=$hide_category_end?>	 
       
	<tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_special.gif border=0 align=absmiddle></td>
          <td align=left  CLASS=VER7 bgcolor=<?=$sC_color?>> 
                 
	    <?=$hide_notice_start?>
            <input type=checkbox name=notice <?=$notice?> value=1>
            notice　
            <?=$hide_notice_end?>
            
	    <?=$hide_html_start?>
            <input type=checkbox name=use_html <?=$use_html?> value=1>
            html　
            <?=$hide_html_end?>
            
	    <input type=checkbox name=reply_mail <?=$reply_mail?> value=1>
            reply email　 
            
	    <?=$hide_secret_start?>
            <input type=checkbox name=is_secret <?=$secret?> value=1>
            secret　
            <?=$hide_secret_end?>
          </td>
        </tr>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_content.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>>
            <textarea name=memo <?=size2(50)?> rows=12 class=textarea><?=$memo?></textarea>
          </td>
        </tr>
        
	<?=$hide_sitelink1_start?>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_link1.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(30)?> style='width:85%; height:18px' maxlength=200 class=input>
          </td>
        </tr>
        <?=$hide_sitelink1_end?>

	<?=$hide_sitelink2_start?>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT CLASS=VER7><img src=<?=$dir?>/images/w_link2.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?>> 
            <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(30)?> style='width:85%; height:18px' maxlength=200 class=input>
          </td>
        </tr>
        <?=$hide_sitelink2_end?>
        
	<?=$hide_pds_start?>
        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT  CLASS=VER7><img src=<?=$dir?>/images/w_upload1.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?> CLASS=VER7> 
            <input type=file name=file1 <?=size(25)?> maxlength=200 class=input>
            <?=$file_name1?>
          </td>
        </tr>
      

        <tr> 
          <td colspan=2 height=2 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td width=80  bgcolor=<?=$sC_color?> align=RIGHT  CLASS=VER7><img src=<?=$dir?>/images/w_upload2.gif border=0 align=absmiddle></td>
          <td  bgcolor=<?=$sC_color?> CLASS=VER7> 
            <input type=file name=file2 <?=size(25)?> maxlength=200 class=input>
            <?=$file_name2?>
          </td>
        </tr>
         <?=$hide_pds_end?>



        <tr> 
          <td colspan=2 height=8 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td  bgcolor=<?=$sC_color?> colspan=2 align=center> 
            <input type=submit value="Save" class=submit name="submit">
            &nbsp; 
            <input type=button value="Back" onClick=history.go(-1) class=submit name="button">
          </td>
        </tr>
        <tr> 
          <td colspan=2 height=5 bgcolor=<?=$sC_color?>></td>
        </tr>
        <tr> 
          <td colspan=2 bgcolor=<?=$sC_line02?>><img src=<?=$dir?>/images/t.gif border=0 align=absmiddle width=1 height=1></td>
        </tr>
      </table>
    </td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=450 style='margin-top:7'>
<tr>
 <td></td>
</tr>
</table>
