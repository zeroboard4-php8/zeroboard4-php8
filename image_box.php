<?php
/***************************************************************************
 * 회원마다 업로드된 이미지를 보여주는 페이지
 **************************************************************************/
	include_once "_head.php";

	if(!isset($id)) die("<Script>\nalert('게시판 이름을 입력하셔야 합니다');\nwindow.close();\n</Script>");

	$setup['header']="";
	$setup['footer']="";
	$setup['header_url']="";
	$setup['footer_url']="";
	$group['header']="";
	$group['footer']="";
	$group['header_url']="";
	$group['footer_url']="";
	$setup['skinname']="";
	$exec = isset($_REQUEST['exec']) && in_array($_REQUEST['exec'], array('upload','delete')) ? $_REQUEST['exec'] : null;

	if(!$member['no']) error("회원만 <br>사용가능합니다","window.close");
	if($setup['grant_write']<$member['level']&&!$is_admin) Error("사용 권한이 없습니다","window.close");
	if($setup['grant_imagebox']<$member['level']) Error("사용 권한이 없습니다","window.close");

// icon 디렉토리에 member_image_box 디렉토리가 없을경우 디렉토리 생성
	$path = "icon/member_image_box";
	if(!is_dir($path)) {
		@mkdir($path,0707);
		@chmod($path,0707);
	}

// 회원의 Path 지정
	$path .="/".$member['no'];

// 회원의 디렉토리가 생성이 안되어 있으면 생성
	if(!is_dir($path)) {
		@mkdir($path,0707);
		@chmod($path,0707);
	}

// 회원의 이미지 창고 전체 용량 계산하기
	$d = dir($path);
	while($entry = $d->read()) {
		if ($entry != "." && $entry != "..") {
			$image_list[] = $entry;
			$image_list_time[] = filemtime($path."/".$entry);
		}
	}

    if (isset($image_list_time) && isset($image_list)){
	    @array_multisort ($image_list_time, SORT_DESC, SORT_NUMERIC,
                         $image_list, SORT_STRING, SORT_DESC);
    }
	
	$dirSize = 0;
	if(!isset($image_list)) $image_list = array();
	for($i=0;$i<count($image_list);$i++) $dirSize += filesize($path."/".$image_list[$i]); 

// 회원의 허용 용량 구하기
	$maxDirSize = zReadFile($path."_maxsize.php");
	if(!$maxDirSize) {
		// 기본으로 10kb 의 용량을 제공
		$maxDirSize = 100*1024; 
	} else {
		// 파일의 주석처리 제거
		$maxDirSize = str_replace("<?php /*","",$maxDirSize);
		$maxDirSize = str_replace("*/?>","",$maxDirSize);
	}

// 입력된 이미지가 있으면 upload 시킴
	if(isset($exec) && $exec=="upload") {
		if(!eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])) Error("정상적으로 업로드를 하여 주시기 바랍니다.","window.close");
		if(!eregi("image_box.php",$_SERVER['HTTP_REFERER'])) Error("정상적으로 업로드를 하여 주시기 바랍니다.","window.close");
		if($_SERVER['REQUEST_METHOD'] == 'GET' ) Error("정상적으로 업로드를 하여 주시기 바랍니다","window.close");

		$num = (int)count($_FILES['upload']['name']);
		for($i=0;$i<$num;$i++) {
			$upload[$i] = $_FILES['upload']['tmp_name'][$i];
			$upload_name[$i]  = $_FILES['upload']['name'][$i];
			$upload_size[$i]  = $_FILES['upload']['size'][$i];
			$upload_type[$i]  = $_FILES['upload']['type'][$i];

			if($upload_name[$i]) {

				if(file_exists($path."/".$upload_name[$i])) Error("같은 이름의 파일이 존재합니다.<br>다른 이름으로 입력하여 주시기 바랍니다");

				$filesize = filesize($upload[$i]);
	
				// 업로드 용량 체크
				if($maxDirSize < $filesize + $dirSize) Error("이미지 창고 사용 용량을 초과하였습니다.");

				if($filesize) {
					if(!is_uploaded_file($upload[$i])) Error("정상적인 방법으로 업로드 해주세요","window.close");
					if(!eregi("\.gif\$",$upload_name[$i])&&!eregi("\.jpg\$",$upload_name[$i])&&!eregi("\.jpeg\$",$upload_name[$i])&&!eregi("\.png\$",$upload_name[$i])) Error("이미지는 gif, png 또는 jpg 파일을 올려주세요");
					$size=GetImageSize($upload[$i]);
					if(!$size[2]) Error("이미지 파일을 올려주시기 바랍니다");
					if(!@move_uploaded_file($upload[$i] , $path."/".$upload_name[$i])) Error("이미지 업로드가 제대로 되지 않았습니다");
				}

			}

		}

		movepage("{$_SERVER['PHP_SELF']}?id=$id&image_page=$image_page");
		exit();
	}

// 삭제 명령 실행시
	if(isset($exec) && $exec=="delete"&&strlen($no)&&$id) {
		if(!z_unlink($path."/".$image_list[$no])) die("에러"); 
		movepage("{$_SERVER['PHP_SELF']}?id=$id&image_page=$image_page");
		exit();
	}

// 한페이지에 출력될 그림 갯수 지정
	$listnum = 18;

// 전체갯수와 전체 페이지 수 구함
	$total = count($image_list);
	$total_page=(int)(($total-1)/$listnum)+1; // 전체 페이지 구함

// 페이지 지정
	if(empty($image_page)) $image_page = 1;

// 페이지가 전체 페이지보다 크면 페이지 번호 바꿈
	if($image_page>$total_page) $image_page=$total_page; 

// 이미지의 출력 크기 지정
	$x_size = 75;
	$y_size = 75;

// 한 줄에 나올 이미지 수 지정
	$h_num = 6;


	head();
?>

<script>
function imagecheck(str,iwidth,iheight) {
	document.imageList.i_filename.value=str;
	document.imageList.i_width.value=iwidth;
	document.imageList.i_height.value=iheight;
	var obj=document.all['inputTable'];
	obj.style.visibility='visible';
}
function putStr() {
	var img_str="";
	var img_filename="";
	var img_align="";
	var img_width="";
	var img_height="";
	var img_vspace="";
	var img_hspace="";
	var img_border="";
	if(opener.window.document.all["write"]&&opener.window.document.all["write"].subject) {
		img_filename=document.imageList.i_filename.value;
		img_width=document.imageList.i_width.value;
		img_height=document.imageList.i_height.value;
		img_vspace=document.imageList.i_vspace.value;
		img_hspace=document.imageList.i_hspace.value;
		img_align=document.imageList.i_align.value;
		img_border=document.imageList.i_border.value;
		img_str = "[img:"+img_filename+",align="+img_align+",width="+img_width+",height="+img_height+",vspace="+img_vspace+",hspace="+img_hspace+",border="+img_border+"]";
		if(img_align=="") {
			img_str = "\n"+img_str;
		}
		opener.document.write.memo.value = opener.document.write.memo.value + img_str;
	} else {
		alert ("글쓰기 화면에서만 사용하실수 있습니다");
	}
	var obj=document.all['inputTable'];
	obj.style.visibility='hidden';
}
function alignset(str) {
	document.imageList.i_align.value=str;
}
</script>

<div align=center>

<form method=post action="<?=$_SERVER['PHP_SELF']?>" ENCTYPE="multipart/form-data" name=imageList>
<input type=hidden name=exec value="upload">
<input type=hidden name=page value="<?=$image_page?>">
<input type=hidden name=id value="<?=$id?>">
<input type=hidden name=i_align value="">
	<img src=images/t.gif border=0 height=10><Br>
	<table border=0 width=98% cellspacing=0 cellpadding=0>
	<tr>
		<td align=left><img src=images/im_title_left.gif border=0></td>
		<td width=100% background=images/im_title_back.gif><img src=images/im_title_back.gif></td>
		<td align=right onmouseover=zbHelp.style.visibility='visible'><img src=images/im_title_right.gif border=0></td>
	</tr>
	</table>
	<table border=0 width=98% cellspacing=0 cellpadding=5>
	<tr>
		<td align=left>&nbsp;<font color=444444 style=font-family:tahoma;font-size:7pt><b>Total : <?=$total?> ( <?=getfilesize($dirSize)?> / <?=getfilesize($maxDirSize)?>)</td>
		<td align=right><font color=444444 style=font-family:tahoma;font-size:7pt><b><?=$image_page?>/<?=$total_page?> Pages</td>
	</tr>
	</table>
	<br>

<div id='inputTable' style='position:absolute; left:50px; top:120px; width:500px; height: 250; z-index:1; visibility: hidden'>
	<table border=0 width=98% cellspacing=1 cellpadding=3 bgcolor=black>
	<tr>
		<td bgcolor=#F9F9F9>
			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td><b>그림파일</b> : <input type=input value="" size=25 class=input name=i_filename style=height:16px></td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td><b>정렬기준</td>
				<td>
					<table border=0 cellspacing=0 cellpadding=0 width=100%>
					<col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col>
					<tr>
						<td><img src=images/im_i_normal.gif border=0></td>
						<td><img src=images/im_i_top.gif border=0></td>
						<td><img src=images/im_i_center.gif border=0></td>
						<td><img src=images/im_i_bottom.gif border=0></td>
						<td><img src=images/im_i_left.gif border=0></td>
						<td><img src=images/im_i_right.gif border=0></td>
					</tr>
					<tr>
						<td><input type=radio name=aligncheck checked onclick=alignset('')> 일 반</td>
						<td><input type=radio name=aligncheck onclick=alignset('top')> 위</td>
						<td><input type=radio name=aligncheck onclick=alignset('middle')> 중간</td>
						<td><input type=radio name=aligncheck onclick=alignset('bottom')> 아래</td>
						<td><input type=radio name=aligncheck onclick=alignset('left')> 왼쪽</td>
						<td><input type=radio name=aligncheck onclick=alignset('right')> 오른쪽</td>
					</tr>
					</table>

				</td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td nowrap height=30><b>크기지정</td>
				<td width=100%>
					가로 : <input type=input value="" size=3 class=input name=i_width style=height:16px> &nbsp;
					세로 : <input type=input value="" size=3 class=input name=i_height style=height:16px> &nbsp;
				</td>
				<td align=right nowrap><b>테두리두께</b> : <input type=input name=i_border size=2 class=input value="1" style=height:16px> px</td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td nowrap><b>여백지정</td>
				<td width=100%>
					수평 : <input type=input value="0" size=3 class=input name=i_hspace style=height:16px> px &nbsp;
					수직 : <input type=input value="0" size=3 class=input name=i_vspace style=height:16px> px &nbsp;
				</td>
				<td nowrap><a href="javascript:void(putStr())"><img src=images/im_input.gif border=0></a> <a href=# onclick=inputTable.style.visibility='hidden'><img src=images/im_close.gif border=0></a></td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>
		</td>
	</tr>
	</table>
	<table border=0 width=95% bgcolor=888888 height=3 cellspacing=0 cellpadding=0><tr><td></td><tr></table>

</div>

	<br>

	<table border=0 width=98% cellspacing=0 cellpadding=2>
<?php
	$_t_width = (int)(100 / $h_num);
	for($i=0;$i<$h_num;$i++) echo"<col width=$_t_width"."%></col>";
?>

<?php
	$_x = 1;

	$startNum = ($image_page-1)*$listnum;
	$endNum = $startNum+$listnum;
	if($endNum>$total) $endNum = $total;
	for($i=$startNum;$i<$endNum;$i++) {
		$size=GetImageSize($path."/".$image_list[$i]);

		if($size[0]>$x_size) {
			$_width=$x_size;
			$_div = (int)($size[0]/$x_size);
			$_height=(int)($size[1]/$_div);
		} elseif($size[1]>$y_size) {
			$_height=$y_size;
			$_div = (int)($size[1]/$y_size);
			$_width=(int)($size[0]/$_div);
		} else {
			$_width=$size[0];
			$_height=$size[1];
		}

		if($_width) $image_size = " width=$_width ";
		elseif($_height) $image_size = " height=$_height ";

		if($_x<=1) echo "<tr bgcolor=white>";

		
?>
		<td align=center valign=top height=75>
			<table border=0 cellspacing=1 cellpadding=2 width=100% height=100% bgcolor=666666>
			<tr>
				<td bgcolor=white align=center >
					<a href="javascript:void(imagecheck('<?=$image_list[$i]?>','<?=$size[0]?>','<?=$size[1]?>'))"><img src="<?=$path?>/<?=$image_list[$i]?>" border=0 <?=$image_size?>></a>
				</td>
			</tr>
			<tr>
				<td bgcolor=eeeeee height=20 align=center>
					<img src=images/t.gif border=0 height=2><br>
					<a href="javascript:void(window.open('<?=$path?>/<?=$image_list[$i]?>','imageBoxViewer','width=<?=$size[0]+20?>,height=<?=$size[1]+40?>,toolbars=no'))"><font color=555555 style=font-size:7pt;font-family:verdana>[<b>view</b>]</font></a>
					<a href=<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&exec=delete&no=<?=$i?>&image_page=<?=$image_page?> onclick="return confirm('삭제하시겠습니까?')"><font color=555555 style=font-size:7pt;font-family:verdana>[<b>del</b>]</font></a>
					<img src=images/t.gif border=0 height=6><br>
				</td>
			</tr>
			</table>
		</td>
<?php
		$_x ++;
		if($_x > $h_num) {
			$_x = 1;
			echo "</tr>";
		}
	}
	if($_x < $h_num) {
		for($i=$_x;$i<=$h_num;$i++)  echo "<td bgcolor=white>&nbsp;</td>";
		echo "</tr>";
	}
?>

	</table>
	<br><br>
	<table border=0 width=98% cellspacing=1 cellpadding=2>
	<tr>
		<td align=center nowrap>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=submit value="업로드" class=submit style= width=100%;height:18px><br>
			<img src=images/t.gif border=0 height=3><br>
			(<b><?=getfilesize($maxDirSize)?></b> 사용가능, <b><?=getfilesize($dirSize)?></b> 사용중, <b><?=getfilesize($maxDirSize-$dirSize)?></b> 업로드 가능)</td>
	</tr>
	<tr>
		<td align=center height=40>
			<a href=<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&image_page=1>[First]</a><?php
	$startPageNum = $image_page - 5;
	if($startPageNum<0) $startPageNum=1;
	$endPageNum = $image_page + 5 ;
	if($endPageNum>=$total_page) $endPageNum=$total_page;
	for($i=$startPageNum;$i<=$endPageNum;$i++) {
		if($i==$image_page) echo"&nbsp;<b>$i</b>&nbsp;";
		else echo"<a href={$_SERVER['PHP_SELF']}?id=$id&image_page=$i>[$i]</a>";
	}
?><a href=<?=$_SERVER['PHP_SELF']?>?id=<?=$id?>&image_page=<?=$total_page?>>[Last]</a>
		</td>
	</tr>
	</table>
</form>

<div id='zbHelp' style='position:absolute; left:5px; top:5px; width:99%; height: 100%; z-index:1; visibility: hidden' onmousedown=this.style.visibility='hidden'>
	<table border=0 width=98% cellspacing=1 cellpadding=3 bgcolor=black height=250>
	<tr>
		<td bgcolor=white style=line-height:160% valign=top>
			<b>Image Box ?</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					Image Box 는 회원들만의 이미지 저장창고입니다.<br>
					웹상의 게시판에서 게시물을 작성할 경우 이미지를 포함하는 게시물의 경우 따로 자신의 계정에 파일을 올려서 링크하는 방식을 많이 사용하지만, 여러번 작업해야 하는 불편함이 있습니다.<br>
					Image Box 는 관리자가 허용한 용량까지 이미지 자료를 창고에 넣고 게시물의 원하는 곳에 추가할수 있습니다.
				</td>
			</tr>
			</table>
			<br>
			<b>사용법</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					원하는 이미지를 업로드 하시고 이미지를 클릭하시면 게시판에 이미지를 추가할수 있는 메뉴가 나타납니다.<br>
					원하는 형식을 지정하시고 입력을 누르시면 게시물에는 특정한 코드가 들어갑니다.<br>
				</td>
			</tr>
			</table>
			<br>
			<b>코드의 구성</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					[img:파일이름,align=,width=500,height=375,vspace=0,hspace=0,border=1]<Br>
					<br>
					HTML의 img 태그와 비슷하지만 위의 형식만 사용하실수 있습니다.<br>
					각 속성은 , (콤마)로 연결되어 있으며 직접 수정하셔도 되지만 위의 형식에 어긋나면 제대로 출력이 되지 않습니다.<br>
				</td>
			</tr>
			</table>
			<br>
			<div align=right>* 클릭하시면 도움말이 닫힙니다</div>
		</td>
	</tr>
	</table>
</div>

<?php
	include "_foot.php";
?>
