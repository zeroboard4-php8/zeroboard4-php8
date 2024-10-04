function wEditorCall(woID,obj) {
  var w   = document.getElementById('memo');
  var chk = obj;
  var resizing_width = w.style.width;

  if(!woID) {
	  woID = "memo";
	  memo_controller = document.getElementById('cMemo_controller');
  } else {
	  memo_controller = document.getElementById('eMemo_controller');
  }

  var memo_textarea = document.getElementById(woID);

  var configElement = document.getElementById(woID+'___Config');
  var frameElement = document.getElementById(woID+'___Frame');

  if(chk.checked && !frameElement)
  {
	// 에디터 생성
	var oFCKeditor = new FCKeditor(woID) ;
	oFCKeditor.BasePath	= rv.SS.WEditor_dir;
	oFCKeditor.Config['CustomConfigurationsPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/fckeditor.config.js';
    oFCKeditor.Height = memo_textarea.rows * 15 + 170;
	oFCKeditor.ToolbarSet = 'dqbasic';
	oFCKeditor.Config['StylesXmlPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/fckstyles.xml';
	oFCKeditor.Config['EditorAreaCSS'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/'+ rv.SS.css_dir  + '/fckeditorarea.css';
    oFCKeditor.Config['SkinPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/' + rv.SS.fckSkin_dir;
    oFCKeditor.Config['SmileyPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/emoticon/';

    memo_textarea.value = memo_textarea.value.replace(/\n/gi,"<br />");
	if(strOriginalMemo) memo_textarea.value = '';
	oFCKeditor.ReplaceTextarea();
	memo_controller.style.display = 'none';
  } 
  else 
  { // 에디터 숨김
      var oEditor ;
      if ( typeof( FCKeditorAPI ) != 'undefined' )
          oEditor = FCKeditorAPI.GetInstance(woID) ;

      try { 
        if(oEditor.EditMode) memo_textarea.value = oEditor.GetXHTML(oEditor.Config.FormatSource);
        else memo_textarea.value = oEditor.GetXHTML();
        oFCK.Tools.RemoveEventListener( oEditor.GetParentForm(), 'submit', oEditor.UpdateLinkedField );
      }
      catch (e) { 
        //return false 
      }

      memo_controller.style.display = '';
      memo_textarea.style.display = '';
      memo_textarea.focus();

      configElement.parentNode.removeChild(configElement);
      frameElement.parentNode.removeChild(frameElement);
      delete FCKeditorAPI.Instances[woID];
      delete FCKeditorAPI.__Instances[woID];
  }
}

function cEditor_close(c_no) {
    var woID = 'cmemo'+c_no;
    var configElement = document.getElementById(woID+'___Config');
    var frameElement = document.getElementById(woID+'___Frame');
    var oEditor;
    if ( typeof( FCKeditorAPI ) != 'undefined' )
        oEditor = FCKeditorAPI.GetInstance(woID) ;

    if (oEditor)
    {
      configElement.parentNode.removeChild(configElement);
      frameElement.parentNode.removeChild(frameElement);
      delete FCKeditorAPI.__Instances[woID];
      delete oEditor;
      window.FCKUnloadFlag = true;
    }

    var cLayer = document.getElementById('cedit_layer'+c_no);
    var ctop   = document.getElementById('ctop');
    if(document.zbform.use_weditor) document.zbform.use_weditor.disabled=false;
    ctop.innerHTML='';

    rv.commentEditMode = false;
}

function reComment_edit(cid,c_no,mode,depth) {

//	if(depth > 10) {
//		alert("10단계 이상의 계층 코멘트는 허용되지 않습니다.");
//		return false;
//	}

	var cTitle = document.getElementById('cTitle'+c_no);
	var table_width = document.getElementById('table_write').offsetWidth;
	var doc_width = document.body.clientWidth;
	cid = document.getElementById(cid);
	var width  = cid.offsetWidth + 85;
	var p      =rv.getPosition(cTitle);
	var left   = p.x - 47;
	var top    = p.y - 155;
	var memo   = (!mode | mode == 0)? cid.innerHTML : '';
	var ctop   = document.getElementById('ctop');
	var noMemberInputHTML = '';

	if(left < 20) left=20;
	body = document.body ? document.body : document.documentElement;
	if(width > (body.clientWidth - left - 20)) width = body.clientWidth - left - 20;

	if(rv.LNG.save_comment.match('.gif')) var saveCommentBt = "<input type=image src='"+rv.LNG.save_comment+"' name='reply_vote' accesskey='s'>";
	else var saveCommentBt = "<input type=submit rows=5 class=submit_c  name='reply_vote' value='"+rv.LNG.save_comment+"' style='height:28px;width:80px'>";

	if(mode == 2) {
		noMemberInputHTML = "<tr><td width=\"<?=$_lSwidth?>px\">&nbsp;</td><td><table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" height=\"100%\" align=\"right\"><tr><td align=\"right\"><b class=\"han\">"+rv.LNG.name+"</b>&nbsp;</td><td><input type=text name=name size=\"12\" maxlength=\"20\" class=input value=\"\"></td><td  align=\"right\">&nbsp;&nbsp;<b class=han>"+rv.LNG.password+"</b>&nbsp;</td><td><input type=\"password\" name=\"password\" size=12  maxlength=\"20\" class=\"input\"></td><td colspan=2 align=right style='width:85px;padding:5px 20px 10px 0'>"+saveCommentBt+"</td></tr></table></tr>";
	} else {
		noMemberInputHTML = "<tr><td colspan=2 align=right style='padding:5px 20px 10px 0'>"+saveCommentBt+"</td></tr>"
	}

	var text = "<div id=\"cedit_layer"+c_no+"\" style=\"position:absolute; visibility:visible; width:"+width+"px; z-index:1; left:"+left+"px; top:"+top+"px\">"
    +"<form method=\"post\" name=\"c_zbform\" action=\"revol_comment.php\" onsubmit=\"return chk_commentSubmit()\">"
	+"<table border=0 width='100%' cellspacing=0 cellpadding=1 class=ce_bg><tr><td style='padding:1px'>"
	+"<table border=0 width='100%' cellspacing=0 cellpadding=0>"
	+"<input type=hidden name=c_no value="+c_no+"><input type=hidden name=ment_type value='reply'><input type=hidden name=page value="+page+"><input type=hidden name=id value="+id+"><input type=hidden name=no value="+no+"><input type=hidden name=select_arrange value="+select_arrange+"><input type=hidden name=desc value="+desc+"><input type=hidden name=page_num value="+page_num+"><input type=hidden name=keyword value="+keyword+"><input type=hidden name=category value="+category+"><input type=hidden name=sn value="+sn+"><input type=hidden name=ss value="+ss+"><input type=hidden name=sc value="+sc+"><input type=hidden name=su value="+su+"><input type=hidden name=url value="+url+"><input type=hidden name=mode value="+mode+"><input type=hidden name=memo_backup id=memo_backup"+c_no+">"
	+"<input type='hidden' name='mother' value='"+c_no+"'>"
	+"<input type='hidden' name='depth' value='"+depth+"'>"
	+"<input type='hidden' name='secret_code' id='secret_code2'>"
	+"<input type='hidden' name='uniqNo' value='"+uniqNo+"'>"
	+"<tr><td style='padding:3px 3px 3px 40px;' height='30px' align='left'>"
	+"<b>"+rv.LNG.ctReply+"</b><span id=cwrite_options></span></td>"
	+"<td align=right style='padding-right:20px'><span style='cursor:pointer' onClick=\"cEditor_close("+c_no+")\">"+rv.LNG.bt_cClose+"</span></td></tr><tr><td valign=top colspan=2><table border=0 cellspacing=0 cellpadding=0 width=100%><tr>"
	+"<td valign='top' style='padding:8px 0 0 0' width='30px' align='right'>"
	+"<span id='eMemo_controller'><font class=bt onclick='document.c_zbform.memo.rows=6;document.c_zbform.memo.focus();' style='cursor:pointer;padding-top:3px;' title='"+rv.LNG.org_memo+"'>■</font><br><font class=bt onclick='document.c_zbform.memo.rows=document.c_zbform.memo.rows+4;document.c_zbform.memo.focus();' style='cursor:pointer;padding-top:3px;' title='"+rv.LNG.exp_memo+"'>▼</font></span>"
	+ "</td><td align=left valign=top style='padding: 0 15px 5px 10px'>"
	+"<textarea name=memo id=cmemo"+c_no+" cols=20 rows=6 class=textarea style=width:100%>"+memo+"</textarea></td></tr>"
	+ noMemberInputHTML
	+"</table></td></tr></table></td></tr></table></form></div>";
 
	ctop.innerHTML = text;
	if(document.getElementById('use_weditor')) {
		var wo = document.getElementById('cwrite_options');
		wo.innerHTML += "<span style=\"padding-left:20px\">&nbsp; | &nbsp; <input type=\"checkbox\" id=\"use_weditor\" name=\"use_weditor\" value=\"1\" onClick=\"wEditorCall('cmemo"+c_no+"',this)\">"+rv.LNG.cUseWeditor+"</span>";
		if(document.zbform.use_weditor) document.zbform.use_weditor.disabled='1';
	}
    rv.commentTextField_id = "cmemo"+c_no;
	return false;
}

var strOriginalMemo;
function comment_edit(cid,c_no,mode) {
	var cTitle = document.getElementById('cTitle'+c_no);
	var table_width = document.getElementById('table_write').offsetWidth;
	var doc_width = document.body.clientWidth;
	cid = document.getElementById(cid);
	var width  = cid.offsetWidth + 85;
	var p      = rv.getPosition(cTitle);
	var left   = p.x - 47;
	var top    = p.y;
	var memo   = cid.innerHTML;
	var ctop   = document.getElementById('ctop');

    rv.commentEditMode = true;

	if(left < 20) left=20;
	body = document.body ? document.body : document.documentElement;
	if(width > (body.clientWidth - left - 20)) width = body.clientWidth - left - 20;

	if(rv.LNG.save_comment.match('.gif')) var saveCommentBt = "<input type=image src='"+rv.LNG.save_comment+"' name='reply_vote' accesskey='s'>";
	else var saveCommentBt = "<input type=submit rows=5 class=submit_c  name='reply_vote' value='"+rv.LNG.save_comment+"' style='height:28px;width:80px'>";

	if(mode == 2) {
		noMemberInputHTML = "<tr><td width=\"<?=$_lSwidth?>px\">&nbsp;</td><td><table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" height=\"100%\" align=\"right\"><tr><td align=\"right\"><b class=\"han\">"+rv.LNG.name+"</b>&nbsp;</td><td><input type=text name=name size=\"12\" maxlength=\"20\" class=input value=\"\"></td><td  align=\"right\">&nbsp;&nbsp;<b class=han>"+rv.LNG.password+"</b>&nbsp;</td><td><input type=\"password\" name=\"password\" size=12  maxlength=\"20\" class=\"input\"></td><td colspan=2 align=right style='width:85px;padding:5px 20px 10px 0'>"+saveCommentBt+"</td></tr></table></tr>";
	} else {
		noMemberInputHTML = "<tr><td colspan=2 align=right style='padding:5px 20px 10px 0'>"+saveCommentBt+"</td></tr>"
	}

    var text = "<div id='cedit_layer"+c_no+"' style='position:absolute; visibility:visible; width:"+width+"px; z-index:1; left:"+left+"px; top:"+top+"px'>"
    +"<form method=\"post\" name=\"c_zbform\" action=\"revol_comment.php\" onsubmit=\"return chk_commentSubmit()\">"
	+"<table border=0 width='100%' cellspacing=0 cellpadding=1 class=ce_bg><tr><td style='padding:1px'>"
	+"<table border=0 width='100%' cellspacing=0 cellpadding=0>"
	+"<input type=hidden name=c_no value="+c_no+"><input type=hidden name=ment_type value='edit'><input type=hidden name=page value="+page+"><input type=hidden name=id value="+id+"><input type=hidden name=no value="+no+"><input type=hidden name=select_arrange value="+select_arrange+"><input type=hidden name=desc value="+desc+"><input type=hidden name=page_num value="+page_num+"><input type=hidden name=keyword value="+keyword+"><input type=hidden name=category value="+category+"><input type=hidden name=sn value="+sn+"><input type=hidden name=ss value="+ss+"><input type=hidden name=sc value="+sc+"><input type=hidden name=su value="+su+"><input type=hidden name=url value="+url+"><input type=hidden name=mother value="+c_no+"><input type=hidden name=mode value="+mode+"><input type=hidden name=memo_backup id=memo_backup"+c_no+">"
	+"<tr><td style='padding:3px 3px 3px 40px;' height='30px' align='left'>"
	+"<b>"+rv.LNG.ctEdit+"</b><span id=cwrite_options></span></td>"
	+"<td align=right style='padding-right:20px'><span style='cursor:pointer' onClick=\"cEditor_close("+c_no+")\">"+rv.LNG.bt_cClose+"</span></td></tr><tr><td valign=top colspan=2><table border=0 cellspacing=0 cellpadding=0 width=100%><tr>"
	+"<td valign=top style='padding:8px 0 0 0' width=30 align=right>"
	+"<span id='eMemo_controller'><font class=bt onclick='document.c_zbform.memo.rows=6;document.c_zbform.memo.focus();' style='cursor:pointer;padding-top:3px;' title='"+rv.LNG.org_memo+"'>■</font><br><font class=bt onclick='document.c_zbform.memo.rows=document.c_zbform.memo.rows+4;document.c_zbform.memo.focus();' style='cursor:pointer;padding-top:3px;' title='"+rv.LNG.exp_memo+"'>▼</font></span>"
	+ "</td><td align=left valign=top style='padding: 0 15px 5px 10px'>"
	+"<textarea name=memo id=cmemo"+c_no+" cols=20 rows=6 class=textarea style=width:100%>"+memo+"</textarea></td></tr>"
	+ noMemberInputHTML
	+"</table></td></tr></table></td></tr></table></form></div>";
 
	ctop.innerHTML = text;
	if(document.getElementById('chk_weditor')) {
		var wo = document.getElementById('cwrite_options');
		wo.innerHTML += "<span style=\"padding-left:20px\">&nbsp; | &nbsp; <input type=\"checkbox\" id=\"use_weditor\" name=\"use_weditor\" value=\"1\" onClick=\"wEditorCall('cmemo"+c_no+"',this)\">"+rv.LNG.cUseWeditor+"</span>";
		if(document.zbform.use_weditor) document.zbform.use_weditor.disabled='1';
		if(memo.replace(/<BR>/gi,"").match(/<.*?>/)) {
		    strOriginalMemo = memo;
			document.getElementById('use_weditor').checked = true;
			wEditorCall('cmemo'+c_no,document.getElementById('use_weditor'));
		} else {
			if(!rv.ie) memo = memo.replace(/\n/gi,"");
            document.getElementById('cmemo'+c_no).value = memo.replace(/<BR>/gi,"\n");
        }
	} else {
		if(!rv.ie) memo = memo.replace(/\n/gi,"");
		document.getElementById('cmemo'+c_no).value = memo.replace(/<BR>/gi,"\n");
	}
    rv.commentTextField_id = "cmemo"+c_no;
	return false;
}


function align_reComment(obj1, obj2, obj3, depthPixel) {
	var src    = document.getElementById('commentHidden'+obj1);
	var mother = document.getElementById('commentHidden'+obj2);
	var depth  = obj3;
	var target = document.getElementById('reComment'+obj2);
  
	if(!mother) {
	  src.style.display = 'block';
	  return;
	}


	if(!depthPixel) depthPixel = 30;
	target.style.marginLeft = depthPixel + 'px';
	target.innerHTML = target.innerHTML + src.innerHTML;
	target.style.display = 'block';

    if ( isIE ) {
        for(i=0; i < target.childNodes.length; i++) {
            if(target.childNodes(i).tagName=="TABLE") targetChild = target.childNodes(i);
        }
        targetChild.style.width = target.firstChild.offsetWidth + 'px';
    } 

	src.style.display = 'none';
	src.innerHTML = '';
}

var oFCK;
function FCKeditor_OnComplete( editorInstance ){
  oFCK = editorInstance;
  oFCK.Tools = oFCK.EditorWindow.parent.FCKTools;
  if(strOriginalMemo) oFCK.SetHTML(strOriginalMemo);
  strOriginalMemo = '';
}

function chk_commentSubmit(elid) 
{
    var edCheck    = document.getElementById('use_weditor');
	var ment_type  = document.getElementsByName('ment_type');
    
	mentPass = (ment_type[0] && ment_type[0].checked)? true : false;
    if(!elid) elid = rv.commentTextField_id;

    if(edCheck && edCheck.checked) 
    {
      if ( typeof( FCKeditorAPI ) != 'undefined' )
          weditor_contents = FCKeditorAPI.GetInstance(elid).GetXHTML();

      if(!mentPass || weditor_contents) {
    	weditor_contents = weditor_contents.replace(/&nbsp;| /gi,"");
	    weditor_contents = weditor_contents.replace(/<.*?>/gi,"");
		if(!weditor_contents)  {
			alert('내용을 입력하여 주세요.');
			return false;
		}
      }
	} else {
      memo = document.getElementById(elid).value;
      if(!mentPass && memo.replace(/(^\s*)|(\s*$)|(\n)/g, "") == "") {
        alert('내용을 입력하여 주세요...');
        return false;
      }
    }

    var need_secretCodeBox = document.getElementById('need_secretCode');
    if(need_secretCodeBox && !rv.commentEditMode) 
    {
        if(need_secretCodeBox.style.display == '')
        { 
          need_secretCodeBox.style.display = 'block';
          var pageSize = rv.getPageSize();
          need_secretCodeBox.style.left = pageSize.width /2 - 150 + pageSize.scrollLeft + 'px';
          need_secretCodeBox.style.top  = pageSize.height/2 - 150 + pageSize.scrollTop + 'px';
          document.zbform.secret_code.focus();
          return false;
        }
        var chk_secCode = document.getElementById('secret_code');
        
        if(document.c_zbform && document.c_zbform.secret_code) 
          document.c_zbform.secret_code.value = document.zbform.secret_code.value;

        if(chk_secCode && !chk_secCode.value) {
          alert('보안코드를 입력하여 주세요.');
          document.zbform.secret_code.focus();
          return false;
        }
        //답글달기 폼을 전송
        if(document.c_zbform && document.c_zbform.secret_code) {
          document.c_zbform.submit();
          return false;
        }
    }
}
