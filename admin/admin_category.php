<?php
  if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) exit;
  $group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));

  if($member['is_admin']>2&&!eregi($no.",",$member['board_name'])) error("사용 권한이 없습니다");

  $no = isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) ? $_REQUEST['no'] : '';
  $page_num = isset($_REQUEST['page_num']) && is_numeric($_REQUEST['page_num']) ? $_REQUEST['page_num'] : 10;
  $table_data=mysql_fetch_array(zb_query("select name from $admin_table where no='$no'"));

  $result=zb_query("select * from $t_category"."_$table_data[name] order by no",$connect);
  $total_category=mysql_num_rows($result);
  $csrf_category = generate_csrf_token();
?>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=5><img src=images/admin_webboard.gif></td></tr>
<Tr height=30><td bgcolor=white colspan=5 align=right style=font-family:Tahoma;font-size:8pt;>
그룹 이름 : <b><?=$group_data['name']?></b> , 게시판 이름 : <b><a href=zboard.php?id=<?=$table_data['name']?> target=_blank><?=$table_data['name']?></a></b> &nbsp;&nbsp;&nbsp;
    <input type=button value='게시판관리' class=input style=width=100px onclick=location.href="<?=$_SERVER['PHP_SELF']?>?exec=view_board&group_no=<?=$group_no?>&exec2=modify&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">
    <input type=button value='권한설정' class=input style=width=100px onclick=location.href="<?=$_SERVER['PHP_SELF']?>?exec=view_board&group_no=<?=$group_no?>&exec2=grant&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">
&nbsp;&nbsp;&nbsp;
</td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=5><img src=images/t.gif height=1></td></tr>
<form method=post action=<?=$_SERVER['PHP_SELF']?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec value=view_board>
<input type=hidden name=exec2 value=category_move>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=csrf_token value=<?=$csrf_category?>>
<tr height=23 align=center bgcolor=#a0a0a0>
    <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>선택</td>
    <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>카테고리명</td>
    <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>등록된 갯수</td>
    <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>수정</td>
    <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>삭제</td>
  </tr>
<?php
  while($data=mysql_fetch_array($result))
  {
   $temp=mysql_fetch_array(zb_query("select count(*) from $t_board"."_$table_data[name] where category='$data[no]'",$connect));
   $total_num=$temp[0];
?>

  <tr height=23 align=center bgcolor=#e0e0e0>
    <td><input type=checkbox name=c[] value=<?php echo $data['no'];?>></td>
    <td><img src=images/t.gif height=3><br><?php echo $data['name'];?></td>
    <td style=font-family:Tahoma;font-size:8pt><?php echo $total_num;?></td>
    <?="<td style=font-family:Tahoma;font-size:8pt><a href={$_SERVER['PHP_SELF']}?exec=view_board&no=$no&exec2=modify_category&group_no=$group_no&page=$page&page_num=$page_num&category_no=$data[no]>Modify</a></td>"?>
    <td style=font-family:Tahoma;font-size:8pt>
<?php
  if(!$total_num&&$total_category>1)
     echo"<a href={$_SERVER['PHP_SELF']}?exec=view_board&no=$no&exec2=del_category_ok&group_no=$group_no&page=$page&page_num=$page_num&category_no=$data[no]>Delete</a>"; else echo "&nbsp;";
?>
    </td>
  </tr>

<?php
  }
?>
  <tr height=28 align=center>
    <td colspan=5 ><table border=0 cellpadding=2 cellspacing=0><tr><td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>
      선택된 카테고리의 게시물을 일괄 이동 : </td><td><img src=images/t.gif height=2><br><select name=movename class=input> 
<?php
  $temp2=zb_query("select * from $t_category"."_$table_data[name] order by no desc",$connect);
  while($data2=mysql_fetch_array($temp2))
  {
   echo "<option value=$data2[no]>$data2[name]</option>";
  }
?>
  </select></td><td>
  <input type=submit value=' 이동 ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;> </td></tr></table>
 </td>
</form>
</tr>
</table>
<form method=post action=<?=$_SERVER['PHP_SELF']?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec value=view_board>
<input type=hidden name=exec2 value=category_add>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=csrf_token value=<?=$csrf_category?>>
<table border=0 cellpadding=2 cellspacing=0>
<tr><td style=font-size:8pt;font-family:Tahoma;color:#ffffff;font-weight:bold>
      카테고리 추가</td><td><input type=text size=10 name=name></td><td><input type=submit value=' 추가 ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;></td></tr></table><br><br>
 <input type=button value=' 게시판 목록 보기 ' onclick="location.href='<?=$_SERVER['PHP_SELF']?>?exec=view_board&group_no=<?=$group_no?>&page=<?=$page?>&page_num=<?=$page_num?>'" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;>
  </form>
</div>
