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
</script><?php 
	$colspanNum = 8;
	if($setup['use_cart']) $colspanNum--;
	if(!$setup['use_alllist']) {
		$hide_category_start="<!--";
		$hide_category_end="-->";
		$setup['use_category']=false;
	}
?><table border="0" cellpadding="0" cellspacing="0" height="38" align="center" width=<?=$width?>><tr>
<td width="113" align="left" background="<?=$dir?>/sakura01.gif" height="38" valign="bottom">
<img src="<?=$dir?>/t.gif" width="113" height="1" border="0"><br>
<span class=v9> <font title=회원가입><?=$a_member_join?>*</a> <font title=정보수정><?=$a_member_modify?>*</a> <font title=쪽지함><?=$a_member_memo?>*</a> <font title=로그인><?=$a_login?>*</a> <font title=로그아웃><?=$a_logout?>*</a> <font title=관리자><?=$a_setup?>*</a><?=$memo_on_sound?></span></td>
<td height="38" width=<?=$width?>></td>
<td width="105" height="38" style="padding-bottom:3px;" background="<?=$dir?>/sakura02.gif" valign="bottom"><img src="<?=$dir?>/t.gif" width="105" height="1" border="0"><br><?=$hide_category_start?><?=$a_category?><?=$hide_category_end?></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" height="5" align="center" width=<?=$width?>>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<tr align="center"><td width="122" background="<?=$dir?>/sakura03.gif" height="5"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="105" height="5" background="<?=$dir?>/sakura04.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td></tr></table>
<?php 
if($a_cart) {
$no = "<td height=24 width=60 background=$dir/bg_no1.gif align=center valign=middle><span style=font-size:8pt;><font face=Verdana color=#919191>$a_no no</a></font></span></td>";
$subbg = "$dir/bg_sub1.gif";
} else {
$no = "<td height=24 width=60 background=$dir/bg_no2.gif align=center valign=middle><span style=font-size:8pt;><font face=Verdana color=#919191>$a_no no</a></font></span></td>";
$subbg = "$dir/bg_sub2.gif";}
?>
<table border="0" cellpadding="0" cellspacing="0" height="24" align="center" width=<?=$width?>>
<tr align="center"><?=$hide_cart_start?><td width="30" height="24" background="<?=$dir?>/bg_c.gif" align="center" valign="middle">
<span class=v81><?=$a_cart?>c</a></span></td><?=$hide_cart_end?>
<?=$no?><td height="24" style="background-image:url('<?=$subbg?>'); background-repeat:no-repeat; background-attachment:fixed; background-position:0px 0px;" align="center" valign="middle">
<span class=v81><?=$a_subject?>subject</a></span></td>
<td height="24" width="120" align="center" valign="middle">
<span class=v81><?=$a_name?>name</a></span></td>
<td height="24" width="100" background="<?=$dir?>/bg_name.gif" align="center" valign="middle">
<span class=v81><?=$a_date?>date</a></span></td>
<td height="24" width="60" background="<?=$dir?>/bg_hit.gif" align="center" valign="middle">
<span class=v81><?=$a_hit?>hit</a></span></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" height="5" align="center" width=<?=$width?>
<tr align="center"><td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td>
<td width="86" height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/sakura07.gif" width="19"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td height="5" background="<?=$dir?>/bg1.gif"><img src="<?=$dir?>/t.gif" width="5" height="5" border="0"></td>
<td width="1" height="5"><img src="<?=$dir?>/bg2.gif" width="1" height="5" border="0"></td></tr></table>