<?php 
unset($size);
   $size[0]=$size[1]=0;
   $x_size=$img_w;
   $y_size=$img_h;
   $img_name=$dir."/no_img.gif";
   $view_img="<a href='#none' onFocus='this.blur()'>";

if (!empty($data['file_name1'])&&file_exists($data['file_name1'])&&preg_match("/\.(gif|jpe?g|png|bmp|webp|heic)$/i",$data['file_name1'])) {
   $size_factor=0;
   $size=@getimagesize($data['file_name1']);
   if($size[0] == 0 ) $size[0]=1;
   if($size[1] == 0 ) $size[1]=1;
   if($size[0]>$size[1]) { $per=$size_factor / $size[0]; }
    else                 { $per=$size_factor / $size[1]; }
   $x_size=$size[0]*$per;
   $y_size=$size[1]*$per;
   $img_name=$data['file_name1'];
   $win_width = $size[0] + 10;
   $win_height = $size[1] + 50;
   $view_img="<a 
     href='#' onclick=\"new_win=window.open('$dir/view_img.php?file={$data['file_name1']}','img_win','left=0,top=0,width=0, height=0, resizable=no, scrollbar=no,status=no'); new_win.resizeTo($win_width,$win_height); new_win.focus(); return false;\" onFocus='this.blur()'>";
	
}

?>

<tr align=center>
<td width=35 nowrap align=center class=ver7><?=$number?></td>
<td nowrap align=center style='padding:10 10 10 0;' valign=top><?=$view_img?><img src=<?=$img_name?> width=<?=$img_w?>  height=<?=$img_h?> border=0></a></td>
<td align=left valign=top colspan=2>
  <table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr>
  <td height=30 width=100% align=left style="padding-left:10; padding-top:3;"><?=$insert?><?=$subject?>&nbsp;&nbsp;<?php $comment_num=$data['total_comment'];
if($data['total_comment']==0) {
  $comment_num="";}
echo "<span class=color2>$comment_num</span>";?>&nbsp;<?=$icon?></td>
  <td nowrap align=left style="padding-top:3; padding-left:5; padding-right:10;"><?=$face_image?><?=$name?> </td>
  <td nowrap width=40 align=center class=thm7 style="padding-top:2;"><?=$date=date("y-m-d",$data['reg_date'])?></td>
  <td nowrap width=25 align=center class=thm7 style="padding-top:2;"><?=$hit?></td>
  <?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
  </tr>
  <tr><td colspan=5 height=1 class=line></td></tr>
  <tr>
  <td colspan=5 width=100% style='padding:10;'><?php 
	// 내용추출 
	$_memo = stripslashes(str_replace("\n","<br>",$data['memo'])); 
	$_memo = cut_str($_memo, 105); // 내용 길이 조절하는 곳입니다
	// 내용출력 
	echo $_memo; 
	?> </td>
  </tr>
  </table>
</td>

</tr>
<tr><td colspan=4 height=1 class=line></td></tr>