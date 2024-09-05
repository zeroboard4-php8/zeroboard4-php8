<SCRIPT LANGUAGE="JavaScript">
<!--
function formresize(mode) {
        if (mode == 0) {
                document.write.memo.cols  = 80;
                document.write.memo.rows  = 20; }
        if (mode == 1) {
                document.write.memo.cols += 5; }
        if (mode == 2) {
                document.write.memo.rows += 3; }
}
// -->
</SCRIPT>

<br><br><?php include "$dir/value.php3"; ?>
<?php 
  if($mode=="reply") $title="";
  elseif($mode=="modify") $title="";
  else $title="";
?><table cellpadding="0" cellspacing="0" width="530">
    <tr>
        <td width="530" colspan="2" height=1>
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
<type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<!----------------------- ------------------------>

        </td>
    </tr>
    <?=$hide_start?>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>N</span>AME
        </td>
        <td width="433" align="right">
            <table cellpadding="0" cellspacing="0" width="432">
                <tr>
                    <td width="154">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
<td>
                                    <input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="278">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="35" align="right" class="ver7" style="padding-right:7;">
                                    <span class=color>P</span>ASS
                                </td>
                                <td>
                                    <input type=password name=password <?=size(13)?> maxlength=20 class=input>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>E</span>-MAIL 
        </td>
        <td width="433">
            <input type=text name=email value="<?=$email?>" <?=size(74)?> maxlength=200 class=input>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>H</span>OMEPAGE 
        </td>
        <td width="433">
            <input type=text name=homepage value="<?=$homepage?>" <?=size(74)?> maxlength=200 

class=input>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <?=$hide_end?>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>O</span>PTIONS 
        </td>
        <td width="433">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding-right:5;">
                        <?=$category_kind?>
                    </td>
		    <td style="padding-right:5;" class=ver7>
                        <?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1><span class=color>H</span>TML<?=$hide_html_end?>
                    </td>
		    <td style="padding-right:5;" class=ver7>
                        <input type=checkbox name=reply_mail <?=$reply_mail?> value=1>R</span>.MAIL
                    </td>
		    <td style="padding-right:5;" class=ver7>
                        <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1><span class=color>S</span>ECRET<?=$hide_secret_end?>
                    </td>
		    <td class=ver7>
                    <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1><span class=color>N</span>OTICE<?=$hide_notice_end?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>S</span>UBJECT 
        </td>
        <td width="433">
            <input type=text name=subject value="<?=$subject?>" <?=size(74)?> maxlength=200 class=input>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>C</span>ONTENTS 
        </td>
        <td width="433">
            <table cellpadding="0" cellspacing="0" width="433">
                <tr>
                    <td height=1 colspan=3 background=<?=$dir?>/dot.gif></td>
                </tr>
                <tr>
                    <td background=<?=$dir?>/dot2.gif width="1"><img src=<?=$dir?>/t.gif width="1"></td>
                    <td>
<textarea name=memo <?=size2(73)?> rows=20 class=textarea><?=$memo?></textarea>
                    </td>
<td background=<?=$dir?>/dot2.gif width="1"><img src=<?=$dir?>/t.gif width="1"></td>
                </tr>
                <tr>
                    <td height=1 colspan=3 background=<?=$dir?>/dot.gif></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <?=$hide_sitelink1_start?>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>L</span>INK #1 
        </td>
        <td width="433">
           <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(74)?> maxlength=200 

class=input>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <?=$hide_sitelink1_end?>
    <?=$hide_sitelink2_start?>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>L</span>INK #2 
        </td>
        <td width="433">
            <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(74)?> maxlength=200 

class=input>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <?=$hide_sitelink2_end?>
    <?=$hide_pds_start?>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;"></td>
        <td width="433" class=ver7>
            <span class=color>M</span>AXIMUM FILE SIZE : <span class=color><?=$upload_limit?></span>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>F</span>ILE #1 
        </td>
        <td width="433">
            <input type=file name=file1 <?=size(59)?> maxlength=255 class=input> <?=$file_name1?>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
     <tr>
        <td width="90" align="right" class="ver7" style="padding-right:7;">
            <span class=color>F</span>ILE #2 
        </td>
        <td width="433">
            <input type=file name=file2 <?=size(59)?> maxlength=255 class=input> <?=$file_name2?>
        </td>
    </tr>
    <tr><td height=7 colspan=2></td></tr>
    <?=$hide_pds_end?>
        <tr><td height=9 colspan=3></td></tr>
     <tr>
        <td colspan=2 align=right>
<input type=image src=<?=$dir?>/w.gif border=0 onfocus=blur()> <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/b.gif border=0></a> </td>
    </tr>
            <tr><td height=9 colspan=7></td></tr>
</table>

