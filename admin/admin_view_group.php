<?php
  /////////////////////////////////////////////////////
  // 현재 지정된 그룹의 내용을 보는 곳입니다
  /////////////////////////////////////////////////////
 
  // 그룹의 정보를 뽑아옴
  $result=zb_query("select * from $group_table where no='$group_no'") or Error("그룹선택시 에러가 발생하였습니다");
  $data=mysql_fetch_array($result);
?>

<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_groupproperties.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>
  <tr><td>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr><td style=padding:0px;>
<Table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
  <tr align=right bgcolor=#e0e0e0><td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold; width=40%>그룹 이름&nbsp;&nbsp;</font></td><td align=left width=80%><img src=images/t.gif height=3><br>&nbsp;<?=$data['name']?></td></tr>
  <tr align=right bgcolor=#e0e0e0><td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>그룹 공개 여부&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;>&nbsp;<?php if($data['is_open']==1) echo"공개"; else echo"비공개";?></td></tr>
  <tr align=right bgcolor=#e0e0e0><td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>회원가입 허용&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;>&nbsp;<?php if($data['use_join']) echo"허용"; else echo"금지";?></td></tr>
  <tr align=right bgcolor=#e0e0e0><td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>그룹 아이콘&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;>&nbsp;<?php if($data['icon']) echo "<img src=icon/$data[icon] border=0 align=absmiddle>";?></td></tr>
  <tr align=right bgcolor=#e0e0e0><td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>회원 구분형식&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;>&nbsp;<?php if($data['use_icon']==1) echo"진한이름"; elseif($data['use_icon']==2) echo"구분없음"; else echo"레벨별 아이콘으로 구분";?></td></tr>
  <tr align=right bgcolor=#e0e0e0>
     <td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>
         회원가입후 이동할 페이지&nbsp;&nbsp;</td>
     <td align=left style=font-family:Tahoma;font-size:8pt;>
         &nbsp;<?php if($data['join_return_url']) echo"<a href=$data[join_return_url] target=_blank>$data[join_return_url]</a>";?>
     </td>
  </tr>
  <tr align=right bgcolor=#e0e0e0>
     <td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>
         회원수&nbsp;&nbsp;</td>
     <td align=left style=font-family:Tahoma;font-size:8pt;>
         &nbsp;<b><?=$data['member_num']?></b> 명
     </td>
  </tr>
  <tr align=right bgcolor=#e0e0e0>
     <td height=25 style=font-family:Tahoma;font-size:8pt;font-weight:bold;>
         생성된 게시판수&nbsp;&nbsp;</td>
     <td align=left style=font-family:Tahoma;font-size:8pt;>
         &nbsp;<b><?=$data['board_num']?></b>
     </td>
  </tr>
</table>
</td>
<td width=150 valign=top bgcolor=#3d3d3d>
<table border=0 width=100% cellpadding=3 cellspacing=0 height=100%>
  <?php
   if($member['is_admin']==1||($member['is_admin']==2&&$member['group_no']==$group_no))
    {echo"
     <tr height=33><td align=center bgcolor=#3d3d3d><a href=$PHP_SELF?group_no=$group_no&exec=modify_group><img src=images/t_admin_editgroup.gif border=0></a></td></tr> 
     <tr height=33><td align=center bgcolor=#3d3d3d><a href=$PHP_SELF?exec=modify_member_join&group_no=$group_no><img src=images/t_admin_memberjoin.gif border=0></a></td></tr>
     <tr height=33><td align=center bgcolor=#3d3d3d><a href=$PHP_SELF?exec=view_member&group_no=$group_no><img src=images/t_admin_membermanage.gif border=0></a></td></tr>
     <tr height=33><td align=center bgcolor=#3d3d3d><a href=$PHP_SELF?exec=view_board&group_no=$group_no><img src=images/t_admin_webboard.gif border=0></a></td></tr>";}
  ?>
  <?php
   if($member['is_admin']==1) echo"<tr height=31><td align=center bgcolor=#3d3d3d><a href=$PHP_SELF?group_no=$group_no&exec=del_group><img src=images/t_admin_deletegroup.gif border=0></a></tD></tr>";
  ?>
</table>
</td></tr></table>

