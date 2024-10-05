<?php 
	$a_member_join= str_replace(">","><font class=icon title=회원가입>",$a_member_join);
	$a_member_modify= str_replace(">","><font class=icon title=정보수정>",$a_member_modify);
	$a_member_memo= str_replace(">","><font class=icon title=쪽지>",$a_member_memo);
	$a_login= str_replace(">","><font class=icon title=로그인>",$a_login);
	$a_member_join= str_replace(">","><font class=icon title=회원가입>",$a_member_join);
	$a_logout= str_replace(">","><font class=icon title=로그아웃>",$a_logout);
	$a_setup= str_replace(">","><font class=icon title=게시판설정>",$a_setup);
	?>
<script language=JavaScript>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
<script language=JavaScript>
function findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
function swapImage() {
  var i,j=0,x,a=swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr><td width=100%  colspan=10>
<table border=0  cellspacing=0 cellpadding=0 width=100%>
<tr><td  width=100% align=left valign=bottom style='padding: 0 0 3 20;' height=30 class='travel_list3'>
<span style='font-family:tahoma,돋음;font-size:9pt;color:silver;font-weight:bold;'><font color=silver></font>&nbsp;&nbsp;</span>
</td><td aligh=right valign=bottom  style='word-break:break-all;padding:0 10 0 0;' nowrap>
    <?=$a_member_join?>*&nbsp;</a><?=$a_member_modify?>*&nbsp;</a><?=$a_member_memo?>*&nbsp;</a><?=$a_login?>*&nbsp;</a><?=$a_logout?>*&nbsp;</a><?=$a_setup?>*&nbsp;</a></td>
    <?=$hide_category_start?><td align=right valign=bottom><img src=<?=$dir?>/trans.gif height=3><?=$a_category?>&nbsp;&nbsp;</td>
<?=$hide_category_end?>
</tr></table></td></tr>
</table>