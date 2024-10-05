<table border=0 cellspacing=1 cellpadding=3 width=<?=$width?> bgcolor=#E7E7E7>
<tr>
	<td bgcolor=#FFFFFF height=25>
</td>
</tr>
<tr>
	<td bgcolor=#FFFFFF height=2>
</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td bgcolor=#FFFFFF height=2></td>
</tr>
</table>

<?php 
if($mode=="reply") $title="답글 쓰기"; elseif($mode=="modify") $title="수정 하기"; else $title="새글 쓰기"; 
$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
?>
<SCRIPT LANGUAGE="JavaScript">
<!-- function zb_formresize(obj) {	obj.rows += 3; } // --> 
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
 
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

<col width=80 align=right style=padding-right:10px;height:28px class=list1></col><col class=list0 style=padding-left:10px;height:28px width=></col>
 <tr>
   <td colspan=2 align=center>&nbsp;&nbsp;<b><?=$title?></b></td>
 </tr>
  
 <?=$hide_start?>
 <tr>
   <td><font class=list_eng>비밀번호</font></td> 
   <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
 </tr>
 <tr>
  <td><font class=list_eng>이름</font></td>
  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
 </tr>

 <tr>
  <td><font class=list_eng>이메일</font></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
 </tr>

 <tr>
  <td><font class=list_eng>홈페이지</font></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
 </tr>
  
 <?=$hide_end?>
 <tr>
  <td><font class=list_eng>체크박스</font></td>
  <td class=list_eng>
     <?=$category_kind?>
     <?=$hide_notice_start?> <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1> HTML 사용 </td>
 </tr>
 <tr valign=top>
  <td><font class=list_eng>제목</font></td>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input></td>
 </tr>
 <tr>
  <td onclick=document.write.memo.rows=document.write.memo.rows+4 style=cursor:hand><font class=list_eng><b>내용</b></font> <font class=list_eng>▼</font></td>
  <td style=padding-top:8px;padding-bottom:8px;><textarea name=memo <?=size2(90)?> rows=18 class=textarea style=width:99%><?=$memo?></textarea></td>
 </tr>

 <?=$hide_pds_start?> 
 <tr>
  <td><font class=list_eng>스크린샷</td>
  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name2?></td>
 </tr>
 <?=$hide_pds_end?>

</table>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
 <tr>
    <td colspan=2>
		<table border=0 cellspacing=1 cellpadding=2 width=100% height=40>
		<tr>
			<td>&nbsp;</td>
                        <td align=right>
				<input type=submit value="확인" class=vvom_submit accesskey="s">
				<input type=button value="취소" class=vvom_button onclick=history.back()>
			</td>
                </tr>
         	</table>
     </td>
  </tr>
</table>
<br>