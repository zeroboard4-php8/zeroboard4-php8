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
<tr><td height=3></td></tr>
<tr>
<td align=right><img src=<?=$dir?>/trans.gif border=0 width=10 height=1><img src=<?=$dir?>/ruvin_fine.gif border=0 height=33></td></tr>
<tr>
<td nowrap  align=right>
<?=$hide_category_start?><?=$a_category?><?=$hide_category_end?>
  <?=$a_member_join?><img src=<?=$dir?>/setup_dot.gif border=0 alt="회원가입"></a>
<?=$a_member_modify?><img src=<?=$dir?>/setup_dot.gif border=0 alt="정보수정"></a>
<?=$a_member_memo?><img src=<?=$dir?>/setup_dot.gif border=0 alt="쪽지사용"></a>
<?=$a_login?><img src=<?=$dir?>/setup_dot.gif border=0 alt="로그인"></a>
<?=$a_logout?><img src=<?=$dir?>/setup_dot.gif border=0 alt="로그아웃"></a>
<?=$a_setup?><img src=<?=$dir?>/setup_dot.gif border=0 alt="설정"></a>
</td>
</tr>
</table>