<br>
<?php
if(!$mode||$mode=="write") {
 $mode = "write";
 unset($no);
}
 if ($mode=="reply") {
	$oldmemo=str_replace(">", "<br>", $memo);
  	$memo = "";
    	$oldmemo="[원본글]".$oldmemo; 
}
?>
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?>>
<tr>
 <td width=1>
<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
<form method=post name=write action=write_ok.php enctype=multipart/form-data>
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
 <td align=center>
    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
             <tr> 
               <td> 
  <table  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
      <td align="center" class="verdana"><img src=<?=$dir?>/guest.gif border=0 <br><br><br>
                       Welcome to<br>
                       my homepage<br>
                     </td>
                   </tr>
                 </table>
           </td>
<td align=center>
 <table>
<tr>
  <td colspan=2> <?=$category_kind?>
     <?=$hide_html_start?> <input type=hidden name=use_html <?=$use_html?> value=1 checked><?=$hide_html_end?>
     <input type=hidden name=subject value='Guest' <?=size(34)?> maxlength=200 class=input>
  </td>
</tr>

<?=$hide_start?>
<tr>
  <td align=right><font class=info>Name</font></td>
  <td><input type=text name=name value="<?=$name?>" <?=size(10)?> maxlength=10 class=input> </td>
</tr>

<tr>
  <td align=right><font class=info>Pass</font></td>
  <td><input type=password name=password value="<?=$password?>" <?=size(10)?> maxlength=10 class=input> </td>
</tr>

<tr>
  <td align=right><font class=info>E-mail</font></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(25)?> maxlength=200 class=input></td>
</tr>

<tr>
  <td align=right><font class=info>Homepage</font></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(30)?> maxlength=200 class=input></td>

</tr>
<?=$hide_end?>

  <tr>
   <td colspan=2>
<?php if ($mode=="reply") {?>
<table width=100% border="1" cellpadding="5" cellspacing="0" bordercolor="#D2B48C" bordercolordark="white" bordercolorlight="white">
<td><?=$oldmemo?></td>
</table>
<?php } ?>   
   </td>
  </tr>

<tr>
  <td align=right ></td>
  <td><textarea name=memo <?=size2(50)?> rows=7 class=textarea><?=$memo?></textarea></td>

</tr>

<tr>
  <td colspan=2 align=right>
    <?=$hide_notice_start?>
	<input type=checkbox name=notice <?=$notice?> value=1><font class=submit>NOTICE 
	<?=$hide_notice_end?>　
	<?=$hide_start?>
	<?=$hide_end?>
	<input type=submit value="WRITE" class=submit>
    <input type=button value="BACK" class=submit onclick=history.back()>
</td>
</tr>

</table>

</td>
</tr>
</form>
<tr>
  <td colspan=2>
    <table border=0 cellspacing=0 cellpadding=0 width=100%><br>
      <tr><td><center><img src="<?=$dir?>/f-line.gif" border=0 ></td></tr>
    </table>
  </td>
</tr>
</table></td></tr></table> 
<br>
