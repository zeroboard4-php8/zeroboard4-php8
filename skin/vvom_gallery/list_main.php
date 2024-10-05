<?php 
 unset($s_info);
 $_srcname="";
 $_xsize=100;
 $_ysize=100;
 $_alink="";

if($data['file_name2'])
{
  if($file_name1&&file_exists($data['file_name1'])) 
  {
    $s_info = @getimagesize($data['file_name1']);

        if($s_info[2]>0&&$s_info[2]<4)
        {
                $_wsize = $s_info[0];
                $_hsize = $s_info[1];

                if($_hsize >= $_wsize)
                {
                  if($_ysize >= $_wsize)
                  {
                    $_xsize=$_wsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="height=$_ysize";
		  }
                }
                else
                {
                  if($_xsize >= $_hsize)
                  {
                    $_xsize=$_hsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="width=$_xsize";
		  }
                }
                   $_srcname = $data['file_name1'];
                   $_alink="<a href=view.php?$href$sort&no={$data['no']}>";
        }
 }
 elseif(!empty($data['file_name2']))
 {
    $s_info = @getimagesize($data['file_name2']);

        if($s_info[2]>0&&$s_info[2]<4)
        {
                $_wsize = $s_info[0];
                $_hsize = $s_info[1];

                if($_hsize >= $_wsize)
                {
                  if($_ysize >= $_wsize)
                  {
                    $_xsize=$_wsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="height=$_ysize";
		  }
                }
                else
                {
                  if($_xsize >= $_hsize)
                  {
                    $_xsize=$_hsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="width=$_xsize";
		  }
                }
                   $_srcname = $data['file_name2'];
                   $_alink="<a href=view.php?$href$sort&no={$data['no']}>";
        }
 }
}
elseif(!empty($data['sitelink1']))
{
  if($data['sitelink1']) 
  {
    $s_info = @getimagesize($data['sitelink1']);

        if($s_info[2]>0&&$s_info[2]<4)
        {
                $_wsize = $s_info[0];
                $_hsize = $s_info[1];

                if($_hsize >= $_wsize)
                {
                  if($_ysize >= $_wsize)
                  {
                    $_xsize=$_wsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="height=$_ysize";
		  }
                }
                else
                {
                  if($_xsize >= $_hsize)
                  {
                    $_xsize=$_hsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="width=$_xsize";
		  }
                }
                   $_srcname = $data['sitelink1'];
                   $_alink="<a href=view.php?$href$sort&no={$data['no']}>";
        }
 }
 elseif(!empty($data['sitelink2']))
 {
    $s_info = @getimagesize($data['sitelink2']);

        if(!empty($s_info)&&$s_info[2]>0&&$s_info[2]<4)
        {
                $_wsize = $s_info[0];
                $_hsize = $s_info[1];

                if($_hsize >= $_wsize)
                {
                  if($_ysize >= $_wsize)
                  {
                    $_xsize=$_wsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="height=$_ysize";
		  }
                }
                else
                {
                  if($_xsize >= $_hsize)
                  {
                    $_xsize=$_hsize;
                    $_picsize="width=$_xsize";
                  }
		  else
		  {
                    $_picsize="width=$_xsize";
		  }
                }
                   $_srcname = $data['sitelink2'];
                   $_alink="<a href=view.php?$href$sort&no={$data['no']}>";
        }
 }
}
$_x ++;
$_temp = $_x % $_h_num;


$data['subject'] = stripslashes($data['subject']);

$count = strlen($data['subject']); 

if($count >= $max) { 

for ($pos=$max;$pos>0 && ord($new['subject'][$pos-1])>=127;$pos--); 

if (($max-$pos)%2 == 0) 

$subcut1 = substr($data['subject'], 0, $max) . ".."; 

else 

$subcut1 = substr($data['subject'], 0, $max+1) . ".."; 

} 

else { 

$subcut1 = $data['subject']; 

}

$subcut2="<a href=view.php?$href$sort&no={$data['no']} >$subcut1</a>";
?>

<!-- 목록 부분 시작 -->

<?php if($_temp==1){?>
<tr>
<?php }?>

<td valign=top align=center>
<br>

<!-- 갤러리 출력 부분 -->
<Table border=0 cellspacing=0 cellpadding=0 width=<?=$_h2size?> style='border-top-width:1; border-right-width:1; border-bottom-width:1; border-left-width:1; border-color:#E7E7E7; border-style:dotted;'>  
<tr align=center bgcolor=<?=$_color1?>>
	<td valign=middle align=center style='padding-left:5; padding-top:2; padding-right:5; padding-bottom:2;' width=<?=$_h2size?> height=<?=$_w2size?>><?=$_alink?><img src=<?=$_srcname?> border=0 <?=$_picsize?>></a>
	</td>
</tr>
<tr>
</table>
<Table border=0 cellspacing=0 cellpadding=0 width=<?=$_h2size?>>
<tr bgcolor=<?=$_color2?>>
	<td valign=middle align=left style='word-break:break-all;' width=<?=$_h2size?> height=20>
	<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?> <?=$hide_category_start?>[<b><?=$category_name?></b>]<br><?=$hide_category_end?> <?=$subcut2?> <?=$comment_num?></font>
	</td>
</tr>
</table>
<br> 

</td>

<?php if(!$_temp){?>
</tr>
<tr>
	<td height=1 colspan=<?=$_h_num?> background=<?=$dir?>/images/dot.gif><img src=<?=$dir?>/images/dot.gif border=0 height=1></td>
</tr>
<?php 
	}
?>

