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

<?php 
if(!eregi("Zeroboard",$a_login)) $a_login= str_replace(">","><font class=list_han>",$a_login)."&nbsp;";
if(!eregi("Zeroboard",$a_logout)) $a_logout= str_replace(">","><font class=list_han>",$a_logout)."&nbsp;";
if(!eregi("Zeroboard",$a_setup)) $a_setup= str_replace(">","><font class=list_han>",$a_setup)."&nbsp;";
if(!eregi("Zeroboard",$a_member_join)) $a_member_join= str_replace(">","><font class=list_han>",$a_member_join)."&nbsp;";
if(!eregi("Zeroboard",$a_member_modify)) $a_member_modify= str_replace(">","><font class=list_han>",$a_member_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_member_memo)) $a_member_memo= str_replace(">","><font class=list_han>",$a_member_memo)."&nbsp;";
?>
<BR>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=25 align=center>
<col width=50%></col><col width=50%></col>
<tr>
  <td>
    <font size=3>&nbsp;</font><b><?=$setup['total_article']?></b> 개의 글
    <?php if($setup['total_article']!=$total)echo" (<font color=red>$total</font> searched) ";?>&nbsp;/&nbsp;전체 <b><?=$total_page?></b> 페이지   <?=$memo_on_sound?>
  </td>
  <td align=right>
    <?=$a_login?>로그인</a>
    <?=$a_member_join?>회원가입</a>
    <?=$a_member_modify?>정보수정</a>
    <?=$a_member_memo?>쪽지보기</a>
    <?=$a_logout?>로그아웃</a>
    <?=$a_setup?>관리자</a>
    <font size=3>&nbsp;</font>
  </td>
</tr>
</table>

