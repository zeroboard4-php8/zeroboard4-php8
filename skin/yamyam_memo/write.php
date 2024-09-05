

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

<?php 
  /*
  write.php 는 글쓰기 폼입니다.
  아래 변수를 사용합니다.

  회원일때 나타나지 않는 부분을 처리하는 부분입니다. 감싸주면 회원일때는 나타나지 않습니다.
  <?=$hide_start?> : 회원일때 글쓰기등을 나타나지 않게 하는 부분입니다;; 회원일때는 자동 주석(<!--)이 들어갑니다.
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
  */
?>
<script language="javascript">
function Change (target,classname,type)
        {
        if ( target.value == target.defaultValue && type==0)        target.value = '';
        if ( !target.value && type==1)        target.value = target.defaultValue;
        target.className=classname;
        }
</script>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> nowrap>

<tr>
<td width=0>
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
<input type=hidden name=subject value="M<?=$subject?>">
<input type=hidden name=password value="Knucles<?=$password?>">
<!----------------------------------------------->
</td>

<?php $memo="모두 행복하세요!"; ?>

<td>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> height=26 nowrap>
<tr><td width=10></td>
<td height=26 nowrap align=right>
 <table border=0 cellpadding=0 cellspacing=0 height=26 nowrap>
  <tr>
  <td><input class=input2 type=text name=name value="<?=$name?>" <?=size(8)?> maxlength=8 onFocus="Change(this,'input2',0)" onBlur="Change(this,'input2',1)">&nbsp;&nbsp;<td>
  <td> <input class=input type=text name=memo value="<?=$memo?>" <?=size(50)?> maxlength=150 onFocus="Change(this,'input',0)" onBlur="Change(this,'input',1)">&nbsp;&nbsp;</td>
  <td><input type=image src=<?=$dir?>/img/i_write.gif border=0 onfocus='this.blur()' accesskey="s">&nbsp;  </td>
  <td width=5></td>
<?php 
{
echo"
  <tr>
     <td colspan='3' align=right>
	<input type='radio' name='sitelink2' value='#008080' checked><img src='$dir/img/color4.gif' border='0'>
	<input type='radio' name='sitelink2' value='#5F9EA0'><img src='$dir/img/color1.gif' border='0'>
       <input type='radio' name='sitelink2' value='#87C6C8'><img src='$dir/img/color2.gif' border='0'>
       <input type='radio' name='sitelink2' value='#9BDADC'><img src='$dir/img/color3.gif' border='0'>
       <input type='radio' name='sitelink2' value='#FF9E9B'><img src='$dir/img/color5.gif' border='0'>
       <input type='radio' name='sitelink2' value='#FFB6C1'><img src='$dir/img/color6.gif' border='0'>
       <input type='radio' name='sitelink2' value='#FF7DB4'><img src='$dir/img/color7.gif' border='0'>
       <input type='radio' name='sitelink2' value='#87CEFA'><img src='$dir/img/color8.gif' border='0'>

	 </td>
  </tr>
";
}
?>

  </tr>
  </table>
</td></tr></table>

        <script language="javascript">
        document.write.name.focus();
        </script>
