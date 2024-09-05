<?php 
	$colspanNum = 8;
	if($setup['use_cart']) $colspanNum--;
	if(!$setup['use_alllist']) {
		$hide_category_start="<!--";
		$hide_category_end="-->";
		$setup['use_category']=false;
	}
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function zb_formresize(obj) {
		obj.rows += 3; 
	}
// -->
</SCRIPT>


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


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>><?=$memo_on_sound?>
<tr>
	<td <?php if(!$setup['use_category']) echo"align=right";?>>
		 <?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)"><?=$member_memo_icon?></span></a>
		<?=$a_login?><img src=<?=$dir?>/images/setup_login.gif border=0></a>
		<?=$a_member_join?><img src=<?=$dir?>/images/setup_signin.gif border=0></a>
		<?=$a_member_modify?><img src=<?=$dir?>/images/setup_myinfo.gif border=0></a>
		<?=$a_member_memo?><img src=<?=$dir?>/images/setup_memo.gif border=0></a>
		<?=$a_logout?><img src=<?=$dir?>/images/setup_logout.gif border=0></a>
		<?=$a_setup?><img src=<?=$dir?>/images/setup_config.gif border=0></a>
	</td>
	<?=$hide_category_start?>
	<td align=right><table border=0 cellspacing=0 cellpadding=0><tr><td><img src=<?=$dir?>/images/h_category.gif border=0></td><td><?=$a_category?></td></tr></table></td>
	<?=$hide_category_end?>
</tr>
</table>
