<?php /////////////////////////////////////////////////////////////////////////
 /*
아래는 그라데이션 효과를 나타내는 루틴이다.
반복되야 하기 때문에 잘못수정하면 한줄로 일반 게시판과 같이 나오게된다.
그라데이션 효과를 내야 하기 때문에 글 등록부분이 글라데이션 구문 아래에 위치한다.
 */
///////////////////////////////////////////////////////////////////////// ?>

<?php 
  $memo_loop++;
  $arr=$max_show_memo-1;
  $scale=$max_show_memo;
  $end=$max_show_memo-$memo_loop-1;
  $color1_r = hexdec(substr($color1,0,2)); // 색1 Red 
  $color1_g = hexdec(substr($color1,2,2)); // 색1 Green
  $color1_b = hexdec(substr($color1,4,2)); // 색1 Blue
  $color2_r = hexdec(substr($color2,0,2)); // 색2 Red
  $color2_g = hexdec(substr($color2,2,2)); // 색2 Green
  $color2_b = hexdec(substr($color2,4,2)); // 색2 Blue

  $gradation1  = abs((int)(($color2_r-$color1_r)/$scale)); // Red   증가치&감소치 구함
  $gradation2  = abs((int)(($color2_g-$color1_g)/$scale)); // Green 증가치&감소치 구함
  $gradation3  = abs((int)(($color2_b-$color1_b)/$scale)); // Blue  증가치&감소치 구함
  $k=$scale;
  for($i=$arr; $i >$end; $i--){
  $gc_1 = ($color1_r>$color2_r) ? $color1_r-($gradation1*$k) : $color1_r+($gradation1*$k); // 색1값이 색2값보다 큰지 작은지 판단해 증가치&감소치 계산
  $gc_2 = ($color1_g>$color2_g) ? $color1_g-($gradation2*$k) : $color1_g+($gradation2*$k); // 색1값이 색2값보다 큰지 작은지 판단해 증가치&감소치 계산
  $gc_3 = ($color1_b>$color2_b) ? $color1_b-($gradation3*$k) : $color1_b+($gradation3*$k); // 색1값이 색2값보다 큰지 작은지 판단해 증가치&감소치 계산
  $gcolor = sprintf("%02x%02x%02x",$gc_1,$gc_2,$gc_3); // 10진수를 16진수 형태로 변환해 저장
  $k--;
  }//for
?>
<font color=<?=$gcolor?>><?=$data['memo']=ereg_replace("<br>","","{$data['memo']}");?> -by <?=$data['name']?><font style=font-family:matchworks,tahoma;font-size:7pt><?=$reg_date?><?php if($is_admin) echo"$a_delete"."x";?></a></font></font>&nbsp;&nbsp;
<?php 
  if($memo_loop>=$max_show_memo) 
  {
     echo"</td>
       	</tr>
	";
     $memo_loop=0;
  }
?>
