<br>

<table align=center border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

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

<tr>
<td>

<table align=center border=0 cellspacing=0 cellpadding=0 width=100%>
<?=$hide_start?>
<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>name</td>
  <td width=100% align=left><input type=text name=name value="<?=$name?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>pass</td>
  <td width=100% align=left><input type=password name=password class=input2 style="width:100%;height:21;">
  </td>
</tr>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>e-mail</td>
  <td width=100% align=left><input type=text name=email value="<?=$email?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>home</td>
  <td width=100% align=left><input type=text name=homepage value="<?=$homepage?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>

<?=$hide_end?>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>option</td>
  <td width=100% align=left class=ver7><?=$category_kind?>
<?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1>notice<?=$hide_notice_end?>
<?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1>html<?=$hide_html_end?> 
<?=$hide_secret_start?><input type=checkbox name=is_secret <?=$secret?> value=1>secret</td><?=$hide_secret_end?>
</tr>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>subject</td>
  <td width=100% align=left><input type=text name=subject value="<?=$subject?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>

<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>contents</td>
  <td width=100% align=left valign=top><textarea name=memo class=input style="width:100%;height:200;"><?=$memo?></textarea>
  </td>
</tr>

<?=$hide_sitelink1_start?>
<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>link # 1</td>
  <td width=100% align=left><input type=text name=sitelink1 value="<?=$sitelink1?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
  <td nowrap align=right style="padding-right:5;" class=ver7>link # 2</td>
  <td width=100% align=left><input type=text name=sitelink2 value="<?=$sitelink2?>" class=input2 style="width:100%;height:21;">
  </td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr>
  <td nowrap>&nbsp;</td>
  <td width=100% aling=left height=21 style="padding-top:3;" class=ver7>upload size : <?=$upload_limit?></td>
</tr>

<tr>
  <td nowrap align=right valign=top style="padding-right:5;" class=ver7>image</td>
  <td width=100% align=left><input type=file name=file1 class=input2 style="width:100%;height:21;"><?=$file_name1?>
  </td>
</tr>

<tr>
  <td nowrap align=right valign=top style="padding-right:5;" class=ver7>file</td>
  <td width=100% align=left><input type=file name=file2 class=input2 style="width:100%;height:21;"><?=$file_name2?>
  </td>
</tr>
<?=$hide_pds_end?>

<tr><td height=5 colspan=2></td></tr>

<tr>
<td width=100% colspan=2 align=right>
 <input onfocus='this.blur()' type=submit value='write' align=center class=button>&nbsp;
<input onfocus='this.blur()' type=button value='back' align=center class=button onclick="history.go(-1)">
</td>
</tr>

</table>

</td>
</tr>
</table>

<br>