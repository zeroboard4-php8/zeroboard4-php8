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
<!-- HTML 시작 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?><tr>
<td valign=bottom align=right><div class=t7_gray>    <?=$a_member_memo?><?=$member_memo_icon?></span><?=$a_member_join?>Join</a>
    <?=$a_member_modify?>&nbsp;my info&nbsp;</a>
    <?=$a_member_memo?>&nbsp;memo&nbsp;</a>
    <?=$a_login?>&nbsp;Login&nbsp;</a>
    <?=$a_logout?>&nbsp;logout&nbsp;</a>
    <?=$a_setup?>&nbsp;setup&nbsp;</a></div>
  </td>
</tr>
</table>
