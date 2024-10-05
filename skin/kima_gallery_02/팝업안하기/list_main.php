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
   $view_img="<a href='view.php?id=$id&no=$data['no']' onFocus='this.blur()'>";
	
}

$sub="<font title='$data['subject']'>$subject</font>";
?>

<td width=<?php echo (100 / $max_show_image);?>% valign=top align=center style='padding:15 5 0 5;'>
   <table align=center border=0 cellpadding=0 cellspacing=0>
   <tr valign=top>
   <td>
       <table align=center border=0 cellpadding=0 cellspacing=0 width=<?=$img_w?>>
       <tr>
       <td align=center style='padding:5;' class=input><a href=view.php?id=<?=$id?>&no=<?=$data['no']?> onfocus=this.blur()><img src=<?=$img_name?> width=<?=$img_w?>  height=<?=$img_h?> border=0></a></td>
       </tr>
       <tr>
       <td width=<?=$img_w?> style='padding-top:5;' align=center><?=$sub?><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?></td>
       </tr>
       </table>
   </td>
   </tr>
   </table>
</td>

<?php 
  $image_loop++;
  if($image_loop>=$max_show_image)
  {
     echo"
       	</tr>
	<tr align=center>";
     $image_loop=0;
  }
?>