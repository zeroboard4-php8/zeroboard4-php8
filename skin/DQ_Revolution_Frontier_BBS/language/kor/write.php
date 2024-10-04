<?php 
// 그림창고
	$bt_imgbox = '<b>'.$a_imagebox.'-그림창고</a></b>';

// 미리보기
	$bt_preview = '<b>'.$a_preview.'-미리보기</a></b>&nbsp;&nbsp;';

// 업로드필드 추가
	$bt_addfield = '[<b class=han2>업로드필드 추가하기</b>]';



//---- option ----------------------------------

	$_leftframe_width = '90';


//---- text ----------------------------------


	$_strSkin['title']		= '새로운 글 등록';
	$_strSkin['modify']		= '수정하기';
	$_strSkin['reply']		= '답글 쓰기';
	$_strSkin['name']		= '<b>이름(별명)</b>';
	$_strSkin['password']	= '<b>비밀번호</b>';
	$_strSkin['email']		= '이메일';
	$_strSkin['homepage']	= '홈페이지';
	$_strSkin['subject']	= '제목';
	$_strSkin['memo1']		= '내용';	// 업로드필드 아래에 "설명첨부"가 가능 할때
	$_strSkin['memo2']		= '내용';	// 업로드필드 아래에 "설명첨부"가 불가능 할때
	$_strSkin['bgm']		= '배경음악 링크';
	$_strSkin['link']		= 'URL 링크';
	$_strSkin['file']		= '업로드 파일';
	$_strSkin['option']		= '선택사항 ';
	$_strSkin['use_notice']	= '공지사항 ';
	$_strSkin['use_html']	= 'HTML 사용 ';
	$_strSkin['use_secret']	= '비밀글 ';
	$_strSkin['use_reply']	= '답변을 이메일로도 받습니다.';
	$_strSkin['is_vdel']	= '가상으로 삭제';
	$_strSkin['category']	= '분류선택';
	$_strSkin['descript']	= '설명첨부';
	$_strSkin['up_size']	= '업로드할 수 있는 파일 하나의 용량은 최대 [upload_size] 입니다.';
	$_strSkin['use_thumb']	= '섬네일로만 사용';
	$_strSkin['upfile_cnt']	= '업로드할 파일을 [upfile_cnt]개 더 추가 하실수 있습니다.';
	$_strSkin['add_upfield']= '업로드필드 추가하기';
	$_strSkin['guide_bgm']	= '음악파일의 URL(주소)만 넣으십시오. 예: [host_url]';
	$_strSkin['exp_memo']	= '글칸크기 늘리기';
	$_strSkin['org_memo']	= '글칸크기 원래대로';
	$_strSkin['no_html']	= 'HTML 태그는 사용하실 수 없습니다.';
	$_strSkin['all_html']	= '모든 HTML 태그를 사용하실 수 있습니다.';
	$_strSkin['sum_html']	= 'HTML 태그 중 [avoid_tag] 만 사용하실 수 있습니다.';
	$_strSkin['write_ok']	= '작성완료';
	$_strSkin['cancel']		= '취소하기';
	$_strSkin['wAgreement'] = '위 내용을 확인 하였습니다.';

    $_strSkin['marketModeMemo2'] = '추가내용'; // 장터 모드에서 글 수정을 하면 원래내용 뒤에 추가되는 내용
    $_strSkin['standby']    = '업로드 대기열'; // 파일을 여러개 선택해서 업로드 할 때 업로드 순서칸에 쌓인 파일들
    $_strSkin['use_weditor']= 'WYSIWYG 에디터 사용';
    $_strSkin['up_size']	= '&bull; 업로드할 수 있는 파일 하나의 용량은 최대 [size] 이며, 업로드 가능한 파일 갯수는 최대 [count]개 입니다.';
	$_strSkin['up_size_ul']	= '&bull; 업로드할 수 있는 파일 하나의 용량은 최대 [size] 이며, 업로드 가능한 파일 갯수에는 제한이 없습니다.';
    $_strSkin['download_guide'] = '&bull; 다운로드용 파일은 맨 앞에 배치하셔야 하며 2개 까지만 인식됩니다.<br />&bull; 여러개의 파일을 다운로드 용도로 사용하려 할 경우엔 각각의 파일을 수동 조작으로 본문에 삽입하셔야 합니다.';
	$_strSkin['use_thumbImgOnly'] = '첫 번째 이미지 파일은 썸네일 용도로만 사용 합니다.'; // 여러개의 파일을 업로드 했을때 그 중 첫번째 화일은 사진 감상시 보여주지 않고 목록의 썸네일을 꾸미는 용도로만 사용함
    $_strSkin['swuCommentInsert'] = '사진설명 추가'; // 각각의 사진에 남기는 주석(부연설명)
    $_strSkin['swuCommentConfirm']= '확인';
    $_strSkin['swuCommentCancel'] = '취소';
    $_strSkin['swuFileBrowse']    = '파일 찾아보기...';
    $_strSkin['swuFileAllCancel'] = '모든 업로드 취소'; // 업로드 대기열의 모든 작업을 취소함
    $_strSkin['inputSecretCode']  = '보안코드 입력';    // 스팸 방지용 보안코드 텍스트 입력
    $_strSkin['secretCodeNotice'] = '스팸글 방지를 위해 보안코드를 필요로 합니다.<br />위 그림에 보이는 글자를 아래 칸에 입력하세요.';
    $_strSkin['site_url']         = '사이트 주소';   // 북마크 게시판으로 사용할때 사이트 주소 입력
    $_strSkin['site_descript']    = '사이트 설명';
    $_strSkin['site_title']       = '사이트 이름';
    $_strSkin['viewer_level']     = '레벨 지정';
    $_strSkin['viewer_level2']    = '이 게시물을 열람하기 위한 회원레벨을 지정합니다.';
?>
