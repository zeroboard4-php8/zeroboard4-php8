<?php
// 이 파일은 제틱스 보드에서 사용하는 테이블의 스키마정보를 가지고 있습니다.
// 이 파일을 수정시에는 조심하여 주시기바랍니다.

$member_table = "zetyx_member_table";  // 회원들의 데이타가 들어 있는 직접적인 테이블
$group_table = "zetyx_group_table";   // 그룹테이블
$admin_table = "zetyx_admin_table";     // 게시판의 관리자 테이블
if(!isset($table_name)) $table_name = "";

///////////////////////////////////////////////////////////////////////////
// Division Table
//////////////////////////////////////////////////////////////////////////
$division_table_schema = "
create table zetyx_division_$table_name (
   no int(10) not null auto_increment primary key ,
   division int(10) not null default 1,
   num int(10) not null default 0,
   key division(division,num)) ";

////////////////////////////////////////////////////////////////////////////
// 회원관리 테이블
///////////////////////////////////////////////////////////////////////////

$member_table_schema = "

  create table $member_table (
    no int(20) not null auto_increment primary key ,
    group_no int(20) null,
    user_id char(20) not null ,
    password char(41) not null,
    board_name char(255) null default '',
    name char(20) not null,
    level int(2) not null default 10,
    email char(255),
    homepage char(255),
    icq char(20),
    aol char(20),
    msn char(20),
    jumin char(41),
    comment text,
    point1 int(20) default 0,
    point2 int(20) default 0,
    job char(50),
    hobby char(50),
    home_address char(255),
    home_tel char(20),
    office_address char(255),
    office_tel char(20),
    handphone char(20),
    mailing char(1) default 0,
    birth int(13),
    picture char(255),
    reg_date int(13),
    openinfo char(1) default 1,
    is_admin char(1) default 3,
    new_memo char(1) default 0,

    open_email char(1) default 1,
    open_homepage char(1) default 1,
    open_icq char(1) default 1,
    open_aol char(1) default 1,
    open_msn char(1) default 1,
    open_comment char(1) default 1,
    open_job char(1) default 1,
    open_hobby char(1) default 1,
    open_home_address char(1) default 1,
    open_home_tel char(1) default 1,
    open_office_address char(1) default 1,
    open_office_tel char(1) default 1,
    open_handphone char(1) default 1,
    open_birth char(1) default 1,
    open_picture char(1) default 1,

    KEY group_no (group_no),
    KEY user_id (user_id),
    KEY password (password),
    KEY name (name)
    )


   ";

///////////////////////////////////////////////////////////////////////////
// 그룹들의 내용을 저장하는 테이블
///////////////////////////////////////////////////////////////////////////

$group_table_schema = "

  create table $group_table (
    no int(20) not null auto_increment primary key ,

    name char(20) not null,

    header_url char(255),
    header text,
    footer_url char(255),
    footer text,

    is_open char(1) not null default 1,
    icon char(255),
    use_join char(1) not null default 1,
    use_icon char(1) not null default 0,
    join_return_url char(255),
    member_num int(20) not null default 0,
    board_num int(20) not null default 0,

    join_level char(2) default 9,
    use_icq char(1) default 1,
    use_aol char(1) default 0,
    use_msn char(1) default 0,
    use_jumin char(1) default 0,
    use_comment char(1) default 1,
    use_job char(1) default 0,
    use_hobby char(1) default 0,
    use_home_address char(1) default 0,
    use_home_tel char(1) default 0,
    use_office_address char(1) default 0,
    use_office_tel char(1) default 0,
    use_handphone char(1) default 0,
    use_mailing char(1) default 1,
    use_birth char(1) default 0,
    use_picture char(1) default 0,

    KEY name (name), 
    KEY member_num (member_num), 
    KEY board_num (board_num), 
    KEY is_open (is_open)
    )

    ";

//////////////////////////////////////////////////////////////////////////
// 게시판 관리자 테이블
//////////////////////////////////////////////////////////////////////////

$admin_table_schema = "

  create table $admin_table (

   no int(11) not null auto_increment primary key,
   group_no int(20) unsigned not null,

   name char(40) not null,

   total_article int(20) default 0 not null,

   skinname char(255),

   header text,
   footer text,
   title char(255),
   header_url char(255),
   footer_url char(255),

   bg_image char(255),
   bg_color char(255) default '#ffffff',
   table_width int(4) default 95 not null,
   memo_num int(3) default 15 not null,
   page_num int(3) default 8 not null,

   only_board char(1) default 1 not null,

   cut_length int(11) default 0 not null,

   use_category char(1) default 0 not null,
   use_html char(1) default 1 not null,
   use_filter char(1) default 1 not null,
   use_status char(1) default 1 not null,

   max_upload_size int(11) default 2097152,

   use_pds char(1) default 0,
   pds_ext1 char(255) default '',
   pds_ext2 char(255) default '',

   use_homelink char(1) default 0 not null,
   use_filelink  char(1) default 0 not null,
   use_cart char(1) default 0 not null,
   use_autolink char(1) default 1 not null,
   use_showip char(1) default 0 not null,
   use_comment char(1) default 1 not null,
   use_formmail char(1) default 1 not null,
   use_showreply char(1) default 1 not null,
   use_secret char(1) default 1 not null,
   use_alllist char(1) default 0  not null,

   grant_html int(2) default 2 not null,
   grant_list int(2) default 10 not null,
   grant_view int(2) default 10 not null,
   grant_comment int(2) default 10 not null,
   grant_write int(2) default 10 not null,
   grant_reply int(2) default 10 not null,
   grant_delete int(2) default 1 not null,
   grant_notice int(2) default 1 not null,
   grant_view_secret int(2) default 1 not null,

   filter text,
   avoid_tag text,
   avoid_ip text,

   KEY group_no (group_no), 
   KEY total_article (total_article), 
   KEY name (name)
   )

  ";


///////////////////////////////////////////////////////////////////////////
// 게시판 본체 테이블
///////////////////////////////////////////////////////////////////////////

$board_table_main_schema = "

  create table zetyx_board_$table_name (

    no int(20) unsigned not null auto_increment primary key,
    division int(10) default 1 not null,
    headnum int(20) default 0 not null,
    arrangenum int(20) default 0 not null,
    depth int(10) unsigned default 0 not null,

    prev_no int(20) default 0 not null,
    next_no int(20) default 0 not null, 

    father int(20) default 0 not null,
    child int(20) default 0 not null,

    ismember int(20) default 0 not null,
    islevel int(2) default 10 not null,

    memo text,

    ip char(15),
    password char(41),
    name char(20) not null,
    homepage char(255),
    email char(255),
    subject char(250) not null,
    use_html char(1) default 0,
    reply_mail char(1) default 0,
    category int(11) default 1 not null,
    is_secret char(1) not null default 0,
    sitelink1 char(255),
    sitelink2 char(255),
    file_name1 char(255),
    file_name2 char(255),
    s_file_name1 char(255),
    s_file_name2 char(255),

    download1 int(11) default 0 not null,
    download2 int(11) default 0 not null,
    reg_date int(13) not null default 0,
    hit int(11) not null default 0,
    vote int(11) not null default 0,

    total_comment int(11) not null default 0,

    x char(255),
    y char(255),
    KEY headnum (division, headnum,arrangenum),
    KEY depth (depth),
    KEY father (father),
    KEY prev_no (prev_no),
    KEY next_no (next_no),
    KEY name (name),
    KEY reg_date (reg_date),
    KEY hit (hit),
    KEY vote (vote),
    KEY download1 (download1),
    KEY download2 (download2),
    KEY category (category)
  )

  ";


/////////////////////////////////////////////////////////////////////////////////
// 간단한 답글 테이블 
/////////////////////////////////////////////////////////////////////////////////

$board_comment_schema = "

  create table zetyx_board_comment_$table_name (
    no int(11) not null auto_increment primary key ,
    parent int(11) not null,
    ismember int(20) default 0 not null,
    name char(20),
    password char(41),
    memo text,
    ip char(15),
    reg_date int(13),

    KEY parent (parent)
  )

";

//////////////////////////////////////////////////////////////////////////////
// 카테고리 테이블
//////////////////////////////////////////////////////////////////////////////

$board_category_table = "
  create table zetyx_board_category_$table_name (
    no int(11) not null auto_increment primary key ,
    num int(11) default 0 not null,
    name char(100) not null,
    KEY name (name)
  )

";

///////////////////////////////////////////////////////////////////////////
// 쪽지 테이블
///////////////////////////////////////////////////////////////////////////

$get_memo_table_schema = "
  create table zetyx_get_memo (
    no int(20) not null auto_increment primary key ,
    member_no int(13) not null,
    member_from int(13) not null,
    subject char(200) not null,
    memo text not null,
    readed char(1) default 0 not null,
    reg_date int(13) not null,
    key user_id(member_no),
    key member_from(member_from),
    key readed (readed),
    key reg_date (reg_date))";

$send_memo_table_schema = "
  create table zetyx_send_memo (
    no int(20) not null auto_increment primary key ,
    member_no int(13) not null,
    member_to int(13) not null,
    subject char(200) not null,
    memo text not null,
    readed char(1) default 0 not null,
    reg_date int(13) not null,
    key user_id(member_no),
    key readed (readed),                                                                          
    key reg_date (reg_date))";
