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
<script language="javascript">
function Change (target,classname,type)
	{
	if ( target.value == target.defaultValue && type==0)	target.value = '';
	if ( !target.value && type==1)	target.value = target.defaultValue;
	target.className=classname;
	}
</script>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> nowrap>
<tr>
<td align=center>
<table border=0 cellspacing=0 cellpadding=0 width=100% nowrap>
<tr>
<td align=center class=td_top>
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
<input type=hidden name=subject value="M<?=$subject?>">
<input type=hidden name=password value="Knucles<?=$password?>">
<!----------------------------------------------->
<table border=0 cellpadding=0 cellspacing=0   nowrap align=center width=100%>
<tr>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%> 
&nbsp;
</td>
  <td nowrap height=26 class=td_top VALIGN="top"> 
<TT>이름</TT>&nbsp;</td>
  <td nowrap height=26 class=td_top width=40% VALIGN="top"> 
<input class=input type=text name=name value="<?=$name?>" <?=size(15)?> maxlength=16>
</td>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%>
</td>
   </tr><tr>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%> 
&nbsp;
</td>
  <td nowrap height=26 class=td_top VALIGN="top"> 
<TT>내용</TT>&nbsp;</td>
  <td nowrap height=26 class=td_top width=40% VALIGN="top"> 
<textarea name=memo class=input2></textarea>
</td>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%>
</td>
   </tr>
<tr>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%> 
&nbsp;
</td>
  <td nowrap height=26 class=td_top VALIGN="top"> 
&nbsp;</td>
  <td nowrap height=26 class=td_top width=40% ALIGN="center"> 
<input type=submit value=monologue class=input style="WIDTH: 85px; HEIGHT: 19px" size=19 onmouseover="this.style.backgroundColor= 'd0d0d0'" onmouseout="this.style.backgroundColor='ffffff'"><BR><BR>
</td>
  <td nowrap height=26 class=td_top ALIGN="right"  width=30%>
</td>
   </tr>
  </table>
</td>
   </tr>
  </table>
</td>
      </tr></table>
	<script language="javascript">
	document.write.name.focus();
	</script>