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
<?=$memo_on_sound?>
<tr>
  <td height=30 class=ssuk_setup1><a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes')) onfocus='this.blur()'><img src=<?=$dir?>/setup_loged.gif border=0 valign=bottom>&nbsp;<?=$total_connect?></a></td>
  <td class=ssuk_setup1><img src=<?=$dir?>/setup_total.gif valign=bottom>&nbsp;<?=$total?>&nbsp;<img src=<?=$dir?>/setup_page.gif valign=bottom>&nbsp;<?=$total_page?>&nbsp;/&nbsp;<?=$page?></td>
  <td align=right width=100%>
    <?=$a_member_join?><img src=<?=$dir?>/setup_join.gif border=0 alt='JOIN'></a><?=$a_member_modify?><img src=<?=$dir?>/setup_info.gif border=0 alt='MYINFO'></a><?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)" title='MEMOBOX'><?=$member_memo_icon?></span></a><?=$a_login?><img src=<?=$dir?>/setup_login.gif border=0 alt='LOGIN'></a><?=$a_logout?><img src=<?=$dir?>/setup_logout.gif border=0 alt='LOGOUT'></a><?=$a_setup?><img src=<?=$dir?>/setup_config.gif border=0 alt='CONFIG'></a></td>
</tr>
</table>
  
<?php 
if($setup['use_category'])
{
?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr valign=top>
  <td width=100><?php include "include/print_category.php"; ?></td>
  <td align=right width=100%>
  <?php 
   $width="98%";
  }
?>
