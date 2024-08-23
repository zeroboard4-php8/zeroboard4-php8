<?php
	if(!isset($s_que)) $s_que='';
	if($cart) {
		$temp=explode("||",$cart);
		$s_que=" and ( no='$temp[1]' ";
		for($i=2;$i<count($temp);$i++)
		$s_que.=" or no='$temp[$i]' ";
		$s_que.=" )";
	}
	// 직접 선택이 없을때
	else {
		$s_que=stripslashes($s_que); 
		$s_que = str_replace("where","and", $s_que);
	}

	$temp=mysql_fetch_array(zb_query("select count(*) from $member_table where group_no='$group_no' $s_que",$connect));
	$total_member=$temp[0];

	if($total_member==0) Error("선택된 회원이 없습니다");
?>

<script>
 function check_submit()
 {
  if(!write.from.value) {alert("보내는 이의 메일주소를 입력하세요");write.from.focus();return false;}
  if(!write.name.value) {alert("보내는 이의 이름을 입력하세요");write.name.focus();return false;}
  if(!write.subject.value) {alert("메일의 제목을 입력하세요");write.subject.focus();return false;}
  if(!write.comment.value) {alert("내용을 입력하세요");write.comment.focus();return false;}
  if(confirm("<?=$total_member?>명의 회원에게 메일을 보내겠습니까?\n\n메일양식을 제대로 선택하였는지를 확인하세요"))
  {
    history.back();
    return true;
  }
  else { return false; }
 }
</script>

<table border=0 cellpadding=4 cellspacing=1 width=100% bgcolor=e0e0e0>
<form method=post action=admin_sendmail_ok.php target=_blank name=write onsubmit="return check_submit();">
<input type=hidden name=group_no value="<?=$group_no?>">
<input type=hidden name=cart value="<?=$cart?>">
<input type=hidden name=s_que value="<?=$s_que?>">
<input type=hidden name=exec2 value="">

<tr align=center bgcolor=a0a0a0 height=30>
<td colspan=2><b><?php echo number_format($total_member);?> 명의 멤버에게 메일링 보내기</td>
</tr>

<tr>
  <td bgcolor=bbbbbb style=font-family:Tahoma;font-size:8pt; align=right width=100><b>E-Mail&nbsp;</td>
  <td >&nbsp; <input type=text name=from size=50 class=input style=border-color:#b0b0b0></td>
</tr>

<tr>
  <td bgcolor=bbbbbb style=font-family:Tahoma;font-size:8pt; align=right width=100><b>Name&nbsp;</td>
  <td >&nbsp; <input type=text name=name size=20 class=input style=border-color:#b0b0b0> &nbsp; <input type=radio value=1 name=html checked> HTML+&lt;BR&gt;&nbsp; <input type=radio value=2 name=html> HTML&nbsp; <input type=radio value=0 name=html> Text</td>
</tr>


<tr>
  <td bgcolor=bbbbbb style=font-family:Tahoma;font-size:8pt; align=right width=100><b>Subject&nbsp;</td>
  <td >&nbsp; <input type=text name=subject size=70 class=input style=width:95%;border-color:#b0b0b0></td>
</tr>

<tr>
  <td bgcolor=bbbbbb style=font-family:Tahoma;font-size:8pt; align=right width=100><b>Content&nbsp;</td>
  <td >&nbsp; <textarea name=comment cols=71 rows=20 style='width:95%; border:1 solid black;border-color:#b0b0b0'></textarea></td>
</tr>

<tr>
  <td bgcolor=bbbbbb style=font-family:Tahoma;font-size:8pt; align=right width=100><b>Size</b>&nbsp;</td>
  <td>&nbsp; <select name=sendnum><option value=1>1</optoin><option value=10>10</option><option value=100 selected>100</option><option value=200>200</option><option value=300>300</option><option value=400>400</option><option valut=500>500</option></select> 명 단위로 잘라서 메일을 보냅니다</td>
</tr>

<tr bgcolor=bbbbbb>
  <td align=center colspan=2>
      <input type=submit value="메일보내기" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px;>&nbsp;&nbsp;
      <input type=button value=" 이전 화면 " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px; onclick=history.back()>
  </td>
      
</tr>
</form>
<table>
