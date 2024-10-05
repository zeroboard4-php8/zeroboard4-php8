<?php 
  include "$dir/value.php3";
	$_hsize = 100; // 가로 크기
	$_wsize = 100; // 세로 크기
	$_h2size = 115; // 테두리가로 크기
	$_w2size = 115; // 테두리세로 크기
	$_h_num = 4; // 가로 갯수

	$_hsize2 = 550; // 본문 가로 크기

	$max = 18; // 제목 길이

	// 연한색깔 (사진 테두리)
	$_color1="white";

	// 진한색깔 (사진 내용)
	$_color2="white";

	$_x = 0; // 계산시 필요한 변수

?>

<table border=0 cellspacing=1 cellpadding=3 width=<?=$width?> bgcolor=#E7E7E7>
<tr>
	<td bgcolor=#FFFFFF height=25>                       

        </td>
</tr>
<tr>
	<td bgcolor=#FFFFFF height=2>
</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td bgcolor=#FFFFFF height=2></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<tr>
<td align=center valign=middle>

    <table border=0 cellspacing=0 cellpadding=0 width=99%>
      <tr>
         <td><?php include "include/print_category.php"; ?></td>
      </tr>
    </table>

</td>
</tr>
<tr>
<td height=1 bgcolor=#F1F1F1></td>
</tr>
</table>
