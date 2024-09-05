<?php /////////////////////////////////////////////////////////////////////////
  /*
  write.php 는 글쓰기 폼입니다.
  아래 변수를 사용합니다.

  회원일때 나타나지 않는 부분을 처리하는 부분입니다. 감싸주면 회원일때는 나타나지 않습니다.
  <?=$hide_start?> : 회원일때 글쓰기등을 나타나지 않게 하는 부분입니다; 회원일때는 자동 주석(!--)이 들어갑니다.  
  <?=$hide_end?>  : 회원일때 보이지 않게 합니다. <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.

  <?=$hide_sitelink1_start?>, <?=$hide_sitelink1_end?> : 싸이트링크 1번을 사용하는지 않하는지 표시
  <?=$hide_sitelink2_start?>, <?=$hide_sitelink2_end?> : 싸이트링크 2번을 사용하는지 않하는지 표시
  <?=$hide_pds_start?>, <?=$hide_pds_end?> : 자료실을 사용하는지 않하는지 표시
  <?=$hide_html_start?>, <?=$hide_html_end?> : HTML 체크박스 표시 


  <?=$title?> : 신규, 수정, 답글일때의 제목 표시

  아래변수는 해당폼에 있는것을 그대로 놔두시면 됩니다.
  <?=$name?> : 원본 이름입니다.
  <?=$subject?> : 원본 제목입니다.
  <?=$email?> : 원본 메일입니다.
  <?=$homepage?> : 홈페이지입니다.
  <?=$memo?> : 원본 내용입니다.
  <?=$sitelink1?> : 싸이트 링크 1번입니다
  <?=$sitelink2?> : 싸이트 링크 2번입니다
  <?=$file_name1?> : 업로드된 파일 1번입니다.
  <?=$file_name2?> : 업로드된 파일 2번입니다.
  <?=$category_kind?> : 카테고리 셀렉트 박스
  <?=$use_html?> : HTML 체크 표시;; 즉 html체크였을때(수정) checked 가 들어가 있음;;
  <?=$reply_mail?> : 답변메일 체크 표시;;
  <?=$secret?> : 비밀글 표시
  <?=$upload_limit?> : 업로드 용량


  <?=$a_imabebox?> : 그림창고 사용 하는 링크
  <?=$a_preview?> : 미리보기 사용 하는 링크
  */
  include "$dir/value.php3";

  if($mode=="reply") $title="<font class=ssuk-write2>Post a </font> <font class=ssuk-write1>R e p l y</font>";
  elseif($mode=="modify") $title="<font class=ssuk-write1>M o d i f y </font> <font class=ssuk-write2>Article</font>";
  else $title="<font class=ssuk-write1>N e w </font> <font class=ssuk-write2>Article</font>";
///////////////////////////////////////////////////////////////////////////// ?>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
function formresize1(obj1) { 
                obj1.rows += 3; // 늘어나는 rows 수치 
        } 
function formresize2(obj2) { 
                obj2.rows = 10; // 원래 textarea rows 
        } 

// --> 
</SCRIPT>
<br>
<table width=450 border=0 cellspacing=0 cellpadding=0>
<tr>
   <td width=10 height=10 background=<?=$dir?>/bg_1.gif valign=top></td>
   <td width=430 background=<?=$dir?>/bg_2.gif valign=top ></td>
   <td width=10 height=10 background=<?=$dir?>/bg_3.gif valign=top></td>
</tr>
<tr>
   <td width=10></td>
   <td width=430 >&nbsp;&nbsp;<?=$title?></td>
   <td width=10></td>
</tr>
</table>

<table border=0 cellspacing=1 cellpadding=0 width=450>
<tr>
  <td colspan=2 height=10>
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
  <input type=hidden name=mode value="<?=$mode?>"></td>
</tr>
</table>
 
<table border=0 width=450 cellspacing=1 cellpadding=0>
<col width=57></col><col width=></col>
<?=$hide_start?>
<tr>
  <td colspan=2>
     <table border=0 cellspacing=0 cellpadding=0 width=100%>
     <tr>
        <td width=57 align=right class=ssuk_num><b>Name&nbsp;</b></td>
        <td class=ssuk_num><img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<?=$name?>" <?=size(25)?> maxlength=20 class=ssuk_input2><b>&nbsp;&nbsp;Password&nbsp;</b><input type=password name=password <?=size(24)?> maxlength=20 class=ssuk_input2></td>
     </tr>
     </table>
  </td>
</tr>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td width=57 align=right class=ssuk_num><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(60)?> maxlength=200 class=ssuk_input2> </td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num><b>Homepage&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(60)?> maxlength=200 class=ssuk_input2> </td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr>
  <td align=right class=ssuk_num width=57><img src=images/t.gif border=0 width=57 height=1><br><b>Special&nbsp;</b></td>
  <td> 
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td><?=$category_kind?></td>
    <td><?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1></td><td class=ssuk_num>&nbsp;Notice &nbsp;<?=$hide_notice_end?></td>
    <td><?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=ssuk_num>&nbsp;Html &nbsp;<?=$hide_html_end?></td>
    <td><input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=ssuk_num>&nbsp;Reply Mail&nbsp;</td>  
    <td><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1></td><td class=ssuk_num>&nbsp;Secret&nbsp;<?=$hide_secret_end?></td>
  </tr>
  </table>
  </td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=ssuk_input2> </td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num rowspan=2><b>Contents&nbsp;</b></td>
  <td valign=top class=ssuk_num>
  <b>Contents form control</b> : <a href="#a" onclick=formresize1(document.write.memo) onfocus='this.blur()'><img src=<?=$dir?>/rows_down.gif border=0 alt='글쓰기 칸 늘이기'></a></a>
  </td>
</tr>
<tr>
  <td valign=top>
  <textarea name=memo <?=size2(61)?> rows=10 class=ssuk_input2><?=$memo?></textarea>
  </td>
</tr>

<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>

<?=$hide_sitelink1_start?>
<tr>
  <td align=right class=ssuk_num><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=ssuk_input2></td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
  <td align=right class=ssuk_num><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=ssuk_input2> </td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>
<tr>
  <td>&nbsp;</td>
  <td class=ssuk_num><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num><b>File #1&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(45)?> maxlength=257 class=ssuk_input2> <?=$file_name1?></td>
</tr>
<tr><td bgcolor=#282828 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num><b>File #2&nbsp;</b></td>
  <td> <input type=file name=file2 <?=size(45)?> maxlength=257 class=ssuk_input2> <?=$file_name2?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=#282828><img src=images/t.gif height=1></td></tr>
<?=$hide_pds_end?>

</table>

<img src=images/t.gif border=0 height=5><br>

<div align=center>
<table border=0 width=450 height=20>
<tr>
	<td><?=$a_preview?><img src=<?=$dir?>/s_preview.gif border=0 accesskey=p></a><?=$a_imagebox?><img src=<?=$dir?>/s_imagebox.gif border=0 accesskey=i></a></td>
	<td align=right valign="baseline"><input type=image border=0 src="<?=$dir?>/s_write.gif" accesskey="s" onfocus=blur()><a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/s_list.gif border=0></a>
</tr>
</table>
</div>
