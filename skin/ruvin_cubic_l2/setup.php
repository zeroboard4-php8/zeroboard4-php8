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

<script language=JavaScript>
var seq = "";
function show(down){
	if(seq != down){
		if(seq !=""){
			seq.style.display = "none";
		}
		down.style.display = "block";
		seq = down;
	}
	else{
		down.style.display = "none";
		seq = "";
	}
}
</script>

<body oncontextmenu="return false">
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
<td height=10 colspan=3></td>
</tr>

<tr>
<td valign=bottom align=left class=cub>&nbsp;<span class=top></span></td>
<td valign=bottom align=right class=cub><span class=v7><font title="회원가입"><?=$a_member_join?>*&nbsp;&nbsp;</font></a><font title="정보수정"><?=$a_member_modify?>*&nbsp;&nbsp;</font></a><font title="쪽지사용"><?=$a_member_memo?>*&nbsp;&nbsp;</font></a><font title="로그인"><?=$a_login?>*&nbsp;&nbsp;</font></a><font title="로그아웃"><?=$a_logout?>*&nbsp;&nbsp;</font></a><font title="관리자"><?=$a_setup?>*&nbsp;</font></a></span></td>
<?=$hide_category_start?><td align=right height=26>&nbsp;<?=$a_category?>&nbsp;</td><?=$hide_category_end?>
</tr>
</table>