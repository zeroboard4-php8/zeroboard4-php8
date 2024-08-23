<?php /////////////////////////////////////////////////////////////////////////
 /*
 목록을 출력하는 부분입니다.
 목록은 여러개이기 때문에 이 파일을 계속 읽어서 출력합니다.
 순환이 되도록 잘 작성하셔야 합니다.
 아래는 HTML 안에 그대로 사용해주시면 순환을 하면서 출력을 합니다.

 <?=$number?> : 가상번호. 즉 순서대로 나오는 번호
 * <?=$data['no']?> : 절대번호, 절대 바뀌지 않는 번호..
 * <?=$loop_number?> : 현재 선택되어 있는 글이라도 번호로 나오게
 <?=$name?> : 메일이 링크되어 있는 이름 * 원래 그대로 <?=$data['name']?>
 <?=$email?> : 메일.. 거의 직접 쓸일은 없음;;
 <?=$subject?> : 링크가 되어 있는 제목  * 원래 그대로 <?=$data['suject']?>
 <?=$memo?> : 내용 부분
 <?=$hit?> : 조회수
 <?=$vote?> : 추천수
 <?=$ip?> : 아피주소
 <?=$comment_num?> : 간단한 답글 수 [ ] 가 둘러싸여 있는것;; <?=$data['comment_num']?> 은 숫자만;;
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
///////////////////////////////////////////////////////////////////////// ?>
<?php 

unset($temp); 
$img_name = "$dir/noimage.gif"; // 업로드된 이미지가 없을때 보여줄 파일...$dir 은 스킨 폴더 
$img_width = 40; // 위 파일 width 
$img_height = 40; // 위 파일 height 

$bbs_width = 40; // width 제한 크기 
$bbs_height = 40; // height 제한

if($data['file_name1']) 
	{ // 이미지가 있을때 
         
        $img_name = $data['file_name1']; // 업로드된 이미지 파일명 추출 

        $temp = @GetImageSize($img_name); // 화면에 표시할 그림파일 크기 정보 얻고 

        if($temp[0] > $bbs_height ) { // 지정된 게시판 가로크기보다 클경우 

        $ratio = $bbs_height/$temp[1]; // 게시판 height에 대한 그림파일의 height 비율 계산. 
        $img_width = $temp[1]*$ratio; // 그림파일의 width와 height에 동일 ratio 적용. 
        $img_height = $temp[1]*$ratio; 
        } 
         
        else { 
                $img_width = $temp[0]; // 지정된 크기보다 작을경우 원사이즈대로 출력 
                $img_height = $temp[1]; 
        } 
} 


$view_img="<a href='#'  onclick=\"window.open('$dir/show_pic.php?file=$data[file_name1]','img','left=10,top=10,width=$temp[0],height=$temp[1],scrollbar=no,status=no')\">";
?><!-- 목록 부분 시작 -->
<?php
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);
?>
<tr align=center onMouseOver=this.style.backgroundColor="#F9F9F9" onMouseOut=this.style.backgroundColor="">
  <td nowrap><p style=line-height:180%;><font style=font-family:tahoma;font-size:7pt><?=$number?></td>
<?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?><td height=25 valign=middle nowrap><?=$view_img?><img src=<?=$img_name?> width=<?=$img_width?> height=<?=$img_height?>  border=0></a></td>
  <td align=left style='word-break:break-all;'>&nbsp;<?=$insert?><?=$icon?><?=$subject?>&nbsp;<font style=font-family:tahoma;font-size:7pt><?=$comment_num?></font></td>
  <td nowrap><font style=font-family:tahoma;font-size:9pt><?=$face_image?>&nbsp;&nbsp;<?=$name?>&nbsp;&nbsp;</div></td>
  <td nowrap><font style=font-family:tahoma;font-size:7pt>&nbsp;<?=$reg_date?>&nbsp;</td>
  <td nowrap><font style=font-family:tahoma;font-size:7pt><?=$hit?></td>
</tr>
<tr><td height=1 colspan=7 background=<?=$dir?>/dot2.gif><img src=<?=$dir?>/dot2.gif border=0 height=1></td></tr>



 
