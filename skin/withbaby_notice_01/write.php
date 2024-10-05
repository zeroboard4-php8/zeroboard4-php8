
<table border="0" width="<?=$width?>" cellspacing="1" cellpadding="0">
<form method="post" name="write" action="write_ok.php" onsubmit="return check_submit();" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="no" value="<?=$no?>" />
<input type="hidden" name="select_arrange" value="<?=$select_arrange?>" />
<input type="hidden" name="desc" value="<?=$desc?>" />
<input type="hidden" name="page_num" value="<?=$page_num?>" />
<input type="hidden" name="keyword" value="<?=$keyword?>" />
<input type="hidden" name="category" value="<?=$category?>" />
<input type="hidden" name="sn" value="<?=$sn?>" />
<input type="hidden" name="ss" value="<?=$ss?>" />
<input type="hidden" name="sc" value="<?=$sc?>" />
<input type="hidden" name="mode" value="<?=$mode?>" />

</table>
<table border="0" width="<?=$width?>" cellspacing="1" cellpadding="0">
<col width="60" /><col width="*" />
<td height="2"><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /></td>
<?=$hide_start?>
<tr>
  <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
  <table cellspacing="0" cellpadding="0" width="100%" height="100%">
  <tr>
  <td align="right" class="ver7">password&nbsp;&nbsp;</td>
 </tr>
 </table>
</td>
  <td><input type="password" name="password" <?=size(20)?> maxlength="20" style="border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;" /></td>
</tr>
<tr>
  <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
  <table cellspacing="0" cellpadding="0" width="100%" height="100%">
  <tr>
  <td align="right" class="ver7">name&nbsp;&nbsp;</td>
  </tr>
 </table>
 </td> 
  <td><input type="text" name="name" value="<?=$name?>" <?=size(20)?> maxlength="20" style="border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;" /></td>
</tr>
<?=$hide_end?>
<tr>
  <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
  <table cellspacing="0" cellpadding="0" width="100%" height="100%">
  <tr>
 <td align="right" class="ver7"></td>
 </tr>
</table>
</td>
  <td class="ver7"><?=$category_kind?></td>
</tr>
 <?=$hide_notice_start?>
<tr>
  <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
  <table cellspacing="0" cellpadding="0" width="100%" height="100%">
  <tr>
 <td align="right" class="subject">*&nbsp;&nbsp;</td>
 </tr>
</table>
</td>
  <td class="ver7"><input type="checkbox" name="notice" <?=$notice?> value="1" /> notice</td>
</tr><?=$hide_notice_end?>
<tr>
  <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
  <table cellspacing="0" cellpadding="0" width="100%" height="100%">
  <tr>
 <td align="right" class="ver7">subject&nbsp;&nbsp;</td>
 </tr>
</table>
</td>
  <td><input type="text" name="subject" value="<?=$subject?>" <?=size(60)?> maxlength="200" style="width:99%;
   border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;" /></td>
</tr>

<tr>
    <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
	<table cellspacing="0" cellpadding="0" width="100%" height="100%">
	<tr>
	<td></td>
   </tr>
   </table>
   </td>
  <td><textarea name="memo" <?=size2(40)?> rows="18" style="width:100%;
  border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;overflow:auto;"><?=$memo?></textarea></td>
</tr>
<?=$hide_pds_start?>
<tr>
    <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
	<table cellspacing="0" cellpadding="0" width="100%" height="100%">
	<tr>
	<td align="right" class="ver7" nowrap="nowrap">image&nbsp;&nbsp;</td>
   </tr>
   </table>
   </td>
  <td class="subject"><input type=file name=file1 <?=size(50)?> maxlength=255 style="width:99%;
   border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;"> <?=$file_name1?></td>
</tr>
<tr>
    <td><img src="<?=$dir?>/t.gif" border="0" height="2" alt="" /><br />
	<table cellspacing="0" cellpadding="0" width="100%" height="100%">
	<tr>
	<td align="right" class="ver7" nowrap="nowrap">file&nbsp;&nbsp;</td>
   </tr>
   </table>
   </td>
  <td class="subject"><input type=file name=file2 <?=size(50)?> maxlength=255 style="width:99%;
   border-width:1px;
   border-color:#f0f0f0;
   border-style:solid;
   background-color:#ffffff;
   font-size:9pt;
   font-family:굴림;
   color:#000000;"> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>
<tr>
	<td colspan="2">
		<table border="0" cellspacing="1" cellpadding="2" width="100%" height="40">
		<tr>
			<td align="right">
				<input onfocus='this.blur()' type=submit value='write' align=center class=button>&nbsp;
                                <input onfocus='this.blur()' type=button value='back' align=center class=button onclick="history.go(-1)">
			</td>
		</tr>
		</table>
	</td>
</tr></form>
</table>