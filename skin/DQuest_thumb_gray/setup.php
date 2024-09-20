<?php 
if(!eregi("Zeroboard",$a_login)) $a_login= str_replace(">","><font class=thumb_han>",$a_login)."&nbsp;";
if(!eregi("Zeroboard",$a_logout)) $a_logout= str_replace(">","><font class=thumb_han>",$a_logout)."&nbsp;";
if(!eregi("Zeroboard",$a_setup)) $a_setup= str_replace(">","><font class=thumb_han>",$a_setup)."&nbsp;";
if(!eregi("Zeroboard",$a_member_join)) $a_member_join= str_replace(">","><font class=thumb_han>",$a_member_join)."&nbsp;";
if(!eregi("Zeroboard",$a_member_modify)) $a_member_modify= str_replace(">","><font class=thumb_han>",$a_member_modify)."&nbsp;";
if(!eregi("Zeroboard",$a_member_memo)) $a_member_memo= str_replace(">","><font class=thumb_han>",$a_member_memo)."&nbsp;";
?>

<?php 
//GD 설치유무와 필요한 함수가 로드되었는지 판단
if (extension_loaded("gd")) {
	$_gd_on=true;
	$get_f = get_extension_funcs ("gd");
	if (in_array("imagecreatetruecolor",$get_f)) $_gd2=true; else $_gd2=false;
} else $_gd_on=false;
if (function_exists('exif_read_data')) $_exif_loaded=true; else $_exif_loaded=false;

//////GD 설정을 수동으로 하고싶을때 수정(비누넷은 필수)///////
//$_gd_on=true; //GD라이브러리를 사용할지 선택 [true, false]
//$_gd2=false;  //GD라이브러리 2.0 전용함수를 사용할지의 유무 [true, false]
//////////////////////////////////////////////////////////////
?>


<?php /*----------- 수정해야할 부분 -----------------------
섬네일 파일을 제거하실때는 관리자모드의 '첨부파일 정리'기능에 있는 '쓰레기파일 제거'기능을 이용하면 말끔히 제거됩니다.
*/

//가로정렬은 "center", "left" 옵션 사용
//수직정렬은 "middle", "top" 옵션 사용

$_dq_imagex = 120;	//섬네일 이미지의 최대 가로폭
$_dq_imagey = 120;	//섬네일 이미지의 최대 수직폭
$_hcount = 3;		//목록보기에서 출력될 섬네일 이미지의 가로 갯수
$_hsize  = 240;		//목록보기에서 출력될 섬네일이 들어갈 공간의 가로폭(사진정보가 표시될 최대폭)
$_thumb_area_hmargin = 10; //목록보기에서 섬네일들이 나오는 전체 영역의 가로 여백
$_thumb_area_align = "left"; //목록보기에서 전체 섬네일의 가로정렬 방법

$_pic_width = $width; //사진이 나오는 영역의 가로폭, 제로보드의 설정을 따르려면 값을 $width 로 한다. !주의 %지정시 "기호로 둘러싼다.
$_thumb_align = "center";//목록보기에서 섬네일과 사진정보의 가로정렬 방법
$_thumb_valign = "top";	 //목록보기에서 섬네일의 세로정렬 방법
//$_thumb_hspace = $_dq_imagey+22;	 //목록보기에서 섬네일이 세로로 차지하는 공간
$_thumb_hspace = "";	 //목록보기에서 섬네일이 세로로 차지하는 공간
$_memo_align = "center"; //게시물 보기에서 $memo의 내용을 출력할때의 정렬방법
$_memo_width = "100%";		 //게시물 보기에서 $memo의 내용을 출력할 영역의 가로폭 크기지정
$_textlen = 23;			 //목록보기에서 출력될 게시물 제목의 최대 문자갯수

$_auto_resize = true;		// 사진의 가로폭이 게시판의 가로폭보다 클때 자동으로 리사이즈 할지를 선택 [true, false]
$_exif_error_check = false; //true:exiflist 프로그램의 실행중 오류가 발생하는지의 검사, false:검사안함
$_exif_on = true;	//true: 디카로 촬영한 사진의 경우 저장된 exif정보를 출력, false:출력안함

$_show_name = true; //true:리스트보기에서 올린이 이름 나오게, false:올린이의 이름 안나오게
$_name_style = "사진가";	//글쓴이를 어떻게 표시할지 지정
$_write_style = "사진등록"; //글쓰기 버턴의 표기
$_comment_guide = ":: 로그인 하셔야만 사진에 대한 의견을 남기실수 있습니다. ::"; //레벨제한으로 코멘트를 달수 없을때의 안내멘트

/*-----------------------------------------------------*/
if ($setup['use_alllist']) $use_alllist=true;
$colspanNum = $_hcount+1;
if(!$setup['use_category']) $colspanNum--;
if ($_gd_on) include $dir."/make_thumb.php"; else include $dir."/make_thumb_nogd.php";
?>
