<?php /////////////////////////////////////////////////////////////////////////
 /*
 목록을 출력하는 부분입니다.
 목록은 여러개이기 때문에 이 파일을 계속 읽어서 출력합니다.
 순환이 되도록 잘 작성하셔야 합니다.
 아래는 HTML 안에 그대로 사용해주시면 순환을 하면서 출력을 합니다.

 <?=$number?> : 가상번호. 즉 순서대로 나오는 번호
 * <?=$data[no]?> : 절대번호, 절대 바뀌지 않는 번호..
 * <?=$loop_number?> : 현재 선택되어 있는 글이라도 번호로 나오게
 <?=$name?> : 메일이 링크되어 있는 이름 * 원래 그대로 <?=$data[name]?>
 <?=$email?> : 메일.. 거의 직접 쓸일은 없음;;
 <?=$subject?> : 링크가 되어 있는 제목  * 원래 그대로 <?=$data[suject]?>
 <?=$memo?> : 내용 부분 
 <?=$hit?> : 조회수
 <?=$vote?> : 추천수
 <?=$ip?> : 아피주소
 <?=$comment_num?> : 간단한 답글 수 [ ] 가 둘러싸여 있는것;; <?=$data[comment_num]?> 은 숫자만;;
 <?=$reg_date?> : 글쓴 날자
 <?=$category_name?> : 카테고리 이름

 <?=$face_image?> : 현재 회원상태의 아이콘;;

 <?=$insert?> : 답글일경우 한칸씩 들어가는 깊이를 출력합니다.
 <?=$icon?>   : 현재 글의 상태에 따라서 아이콘을 출력합니다.

 바구니와 카테고리의 경우 사용하지 않는 수가 있으므로 숨겨놓을때 쓰는 변수;;
 <?=$hide_cart_start?> 내용 <?=$hide_cart_end?> : start 와 end 사이에는 사라짐;; 바구니
 <?=$hide_category_start?> 내용 <?=$hide_category_end?> : Start와 end 사이에는 사라짐;; 바구니

                
 참고: old_head.gif : 원본글이면서 12시간이 넘은 글의 아이콘
       new_head.gif : 12시간에 적히 모든 글. 원본/답글 상관없이
       reply_head.gif : 12시간이 지난 답글의 아이콘
       reply_new_head.gif : 12시간이 지나지 않은 답글의 아이콘;;
       notice_head.gif : 공지사항일때 아이콘
       secret_head.gif : 비밀글을때 나타나는 아이콘
       arrow.gif : 현재 리스트에서 선택되어 있는 글 앞에 붙는 아이콘
 */

 unset($s_info);
 $_srcname="$dir/noscreenshot.gif";
 $_xsize=100;
 $_ysize=100;
 $_alink="";
 /*** 갤러리 스킨에서 계산하는 부분.. 지우지 마세요. ^^;; ****/
 if($data['file_name1'])
 {
  $s_info = @getimagesize($data['file_name1']);

	if($s_info[2]>0&&$s_info[2]<4)
	{
		$_xsize = $s_info[0];
		if($_xsize>$_hsize) $_xsize=$_hsize;
		$_srcname = $data['file_name1'];
		$_alink="<a href=javascript:void(window.open('$dir/show_pic.php?file=$data[file_name1]','$data[no]','width=$s_info[0],height=$s_info[1],resizable=yes,toolbars=no,scrollbars=auto')) onfocus=blur()>";
	}
 }

 $_x ++;
 $_temp = $_x % $_h_num;

?>

<!-- 목록 부분 시작 -->
<?php if($_temp==1){?>
<tr>
<?php }?>

<td valign=top align=center>
<br>

<!-- 갤러리 출력 부분 -->
<Table border=0 cellspacing=0 cellpadding=0 width=<?=$_hsize?>>  
<tr align=center bgcolor=<?=$_color1?>>
	<td align=center width=<?=$_hsize?> style=padding:5px valign=top><?=$_alink?><img src=<?=$_srcname?> border=0 width=<?=$_xsize?>></a></td>
</tr>
<tr>
	
	<td>
	<Table border=0 cellspacing=0 cellpadding=5 width=100% bgcolor=<?=$_color2?>>  
	<tr>
		<td style='word-break:break-all;'>
			<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?> <?=$hide_category_start?>[<b><?=$category_name?></b>]<br><?=$hide_category_end?> <?=$subject?> <font style=font-family:굴림;font-size:6pt><?=$comment_num?></font>
		</td>
	</tr>
	</table>

	</td>

</tr>
</table>
<br> 

</td>

<?php if(!$_temp){?>
</tr>
<tr>
	<td height=1 colspan=<?=$_h_num?> background=<?=$dir?>/dot.gif><img src=<?=$dir?>/dot.gif border=0 height=1></td>
</tr>
<?php
	}
?>
 
