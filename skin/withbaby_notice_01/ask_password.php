<br /><br /><br />
<form method="post" name="delete" action="<?=$target?>">
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
<input type="hidden" name="c_no" value="<?=$c_no?>" />
<table border="0" width="250">
<tr>
   <td align="center" style="font-family:verdana;font-size:9px;" style="padding:2px"><b><?=$title?></b></td>
</tr>
<?php 
	if(!$member['no']) {
?>
<tr height="40">
   <td style="font-family:verdana;font-size:9px;" align="center">
     <?=$input_password?> 
   </td>
</tr>
<?php 
	}
?>
<tr height="30">
	<td align="center">
				<input onfocus='this.blur()' type=submit value='write' align=center class=button>&nbsp;
                                <input onfocus='this.blur()' type=button value='back' align=center class=button onclick="history.go(-1)">
   </td>
</tr>
</table>
</form>