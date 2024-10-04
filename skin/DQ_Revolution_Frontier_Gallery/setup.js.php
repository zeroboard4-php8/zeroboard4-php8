<?php 
    $_SS['id']           = !empty($id) ? $id : null;
    $_SS['no']           = !empty($no) ? $no : null;
    $_SS['member_no']    = !empty($member['no']) ? $member['no'] : null;
    $_SS['member_level'] = !empty($member['no']) ? $member['no'] : null;
    $_SS['member_admin'] = !empty($is_admin) ? $is_admin : null;
    $_SS['grant_view']   = !empty($setup['grant_view']) ? $setup['grant_view'] : null;
    $_SS['CopyrightMSG'] = '게시판 하단의 스킨제작자 표기가 훼손되었거나 출력되지 않았습니다.';
	if(empty($_SS['zbSkin_dir'])) $_SS['zbSkin_dir']='';

//    $_lang_dir = @str_replace(getcwd().'/','',$_lang_dir);
    if(!eregi("\/write\.php$",$_SERVER['PHP_SELF'])) {
        if(empty($a_prev)) $a_prev='';
        if(empty($a_next)) $a_next='';
        if(empty($a_del)) $a_del='';
        if(empty($a_subj)) $a_subj='';
        if(empty($a_cate)) $a_cate='';
        if(empty($view_once)) $view_once='';
        require $_lang_dir.'view.php';
        require $_lang_dir.'comment.php';
        require $_lang_dir.'list.php';
        $_SS['strLanguage']['no_grant1']    = $_strSkin['no_grant1'];
        $_SS['strLanguage']['no_grant2']    = $_strSkin['no_grant2'];
        $_SS['strLanguage']['exp_memo']     = $_strSkin['exp_memo'];
        $_SS['strLanguage']['org_memo']     = $_strSkin['org_memo'];
        $_SS['strLanguage']['save_comment'] = $_strSkin['save_comment'];
        $_SS['strLanguage']['name']         = $_strSkin['name'];
        $_SS['strLanguage']['password']     = $_strSkin['password'];
        $_SS['strLanguage']['ctEdit']       = $_strSkin['ctEdit'];
        $_SS['strLanguage']['ctReply']      = $_strSkin['ctReply'];
        $_SS['strLanguage']['bt_cClose']    = $_strSkin['bt_cClose'];
        $_SS['strLanguage']['cUseWeditor']  = $_strSkin['cUseWeditor'];
        $_strSkin = null;
    }
    $_SS_JSON = json_encode_dq($_SS);
    // $_SS_JSON = json_encode_dq(array_iconv($_SS, "CP949","UTF-8"));
?>
<script type="text/javascript">
    rv.SS  = <?=$_SS_JSON?>;
    rv.LNG = rv.SS.strLanguage;
    rv.SS.zbSkin_dir  = "<?=$dir?>";
    rv.SS.zbURL       = "<?=get_zbURL()?>";
    rv.SS.dqCss_dir   = "<?=$_SS['zbSkin_dir'].'/'.$_SS['css_dir']?>";
    rv.SS.fckSkin_dir = "<?=!empty($_SS['fckSkin_dir'])?$_SS['fckSkin_dir']:''?>";
<?php if(!eregi("\/write\.php$",$_SERVER['PHP_SELF'])) {?>
    hs.graphicsDir    = rv.SS.zbSkin_dir + "/plug-ins/highslide/graphics/";
    //hs.outlineType    = 'rounded-white';
    hs.outlineType = 'beveled';
<?php } ?>
<?php if(!empty($_SS['mrbt_clickLimit']) && (!$is_admin && (empty($member['no']) || $member['level'] > $_SS['mrbt_passLevel']))) { ?>
    rv.using_pixelLimit = true;
    if(rv.ie) rv.addEvent(document, "mousedown", rv.chk_rightClickOnImage);
    else {
      document.body.oncontextmenu = function() {return false};
      rv.addEvent(document, "mousedown", rv.chk_rightClickOnImage);
    }
<?php } ?>
</script>
