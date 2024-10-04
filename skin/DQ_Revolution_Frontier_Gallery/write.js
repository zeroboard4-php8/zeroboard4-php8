browserName = navigator.appName;
browserVer = parseInt(navigator.appVersion);
var isIE = (browserName.match('Microsoft')) ? 1: 0;

function zb_formresize(obj) {
	obj.rows += 3;
}

function revolg_check_submit(use_category,member,using_empty) 
{
	var mode = document.getElementById('mode').value;
	var textAreaId = (mode == 'modify' && market_mode) ? 'memo2' : 'memo';
    var btnSwfuCancel = document.getElementById('btnSwfuCancel');

    if(btnSwfuCancel && !btnSwfuCancel.disabled) { // swfupload 검사
      alert("아직 파일 업로드가 진행중입니다.");
      return false;
    }

	if(document.check_attack.check.value > 10) {
       var digital=new Date();
       var time = (digital.getHours()*3600)+(digital.getMinutes()*60)+digital.getSeconds();
	   if(document.check_attack.check.value + 5 < time) {
         alert(document.check_attack.check.value+'/'+time);
         document.check_attack.check.time = time;
         return false;
       } 
	}
	if(use_category == 1) {
	  var myindex=document.zbform.category[1].selectedIndex;
	  if (myindex<1)
	  {
	   alert('카테고리를 선택하여 주십시요');
	   return false;
	  }
	}

	if(document.zbform.agreement && !document.zbform.agreement.checked) {
		alert("게시물 등록 공지에 동의 하셔야만 글 작성을 완료할 수 있습니다.");
		return false;
	}		

	if(document.zbform.notice && document.zbform.notice.checked && using_secretonly == 1) document.zbform.is_secret.value = '0'

	var chk_mbPassword = document.getElementById('mbPassword');
	if(chk_mbPassword && chk_mbPassword.style.display != 'none' && !document.zbform.password.value) {
	   alert('비밀번호를 입력하여 주세요.');
	   document.zbform.password.focus();
	   return false;
	}

	if(member < 1) {
	  if(!document.zbform.password.value) {
	   alert('비밀번호를 입력하여 주세요.');
	   document.zbform.password.focus();
	   return false;
	  }

	  if(!document.zbform.name.value) {
	   alert('이름을 입력하여 주세요.');
	   document.zbform.name.focus();
	   return false;
	  }
	}

    var edCheck = document.getElementById('use_weditor');

	if(using_empty != 1 && edCheck && !edCheck.checked) 
    {
      if(!document.zbform.subject.value) {
         alert('제목을 입력하여 주세요.');
         document.zbform.subject.focus();
         return false;
      }
      var memo = document.getElementById(textAreaId);
      if(!memo.value || !memo.value.replace(/<.*?>/gi,""))  {
       alert('내용을 입력하여 주세요.');
       memo.focus();
       return false;
      }
	}
	
	if(edCheck && edCheck.checked && using_empty != 1) {
      if ( typeof( FCKeditorAPI ) != 'undefined' )
          var weditor_contents = FCKeditorAPI.GetInstance(textAreaId).GetXHTML();
		
		weditor_contents = weditor_contents.replace(/&nbsp;| /gi,"");
		weditor_contents = weditor_contents.replace(/<.*?>/gi,"");
		if(!weditor_contents)  {
			alert('내용을 입력하여 주세요.');
			return false;
		}
	}

    var need_secretCodeBox = document.getElementById('need_secretCode');
    if(need_secretCodeBox) 
    {
        if(need_secretCodeBox.style.display == '')
        { 
          need_secretCodeBox.style.display = 'block';
          var pageSize = rv.getPageSize();
          need_secretCodeBox.style.left = pageSize.width /2 - 150 + 'px';
          need_secretCodeBox.style.top  = pageSize.height/2 - 150 + pageSize.scrollTop + 'px';
          document.zbform.secret_code.focus();
          return false;
        }
        var chk_secCode = document.getElementById('secret_code');
        if(chk_secCode && !chk_secCode.value) {
           alert('보안코드를 입력하여 주세요.');
           document.zbform.secret_code.focus();
           return false;
        }
    }

	//document.zbform.memo.select();
    //document.execCommand('copy');

    var digital=new Date();
    var time = (digital.getHours()*3600)+(digital.getMinutes()*60)+digital.getSeconds();
    document.check_attack.check.value=time;

    if(edCheck && edCheck.checked) document.getElementById('use_html').value='2';
    show_waiting();
    hideImageBox();

    return true;
}

// 에디터 토글
  var strOriginalMemo;
  function wEditorCall() 
  {
	  var mode = document.getElementById('mode').value;
	  var textAreaId = (mode == 'modify' && market_mode) ? 'memo2' : 'memo';
      var edCheck = document.getElementById('use_weditor');
      var htCheck = document.getElementById('use_html');
      var eMemo_controller = document.getElementById('eMemo_controller');
      var memo_textarea = document.getElementById(textAreaId);
	  var oForm = document.getElementById('zbform');

      var frameElement  = document.getElementById(textAreaId+'___Frame');
      var configElement = document.getElementById(textAreaId+'___Config');

      if(edCheck.checked && !frameElement)
      {
        edCheck.disabled = true;
        // 에디터 생성
        var oFCKeditor = new FCKeditor( textAreaId ) ;
        var expander = typeof(swu)!='undefined' ? 250 : 170;
        oFCKeditor.BasePath	= rv.SS.WEditor_dir;
        oFCKeditor.Config['CustomConfigurationsPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/fckeditor.config.js';
        oFCKeditor.Height = memo_textarea ? memo_textarea.rows * 15 + expander : 250;
        oFCKeditor.ToolbarSet = 'dqbasic';
        oFCKeditor.Config['StylesXmlPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/fckstyles.xml';
	    oFCKeditor.Config['SkinPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/' +  rv.SS.fckSkin_dir;
	    oFCKeditor.Config['SmileyPath'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/emoticon/';

    	oFCKeditor.Config['EditorAreaCSS'] = rv.SS.zbURL + rv.SS.zbSkin_dir + '/'+ rv.SS.css_dir  + '/fckeditorarea.css';
        if(htCheck && htCheck.value != 2 && memo_textarea) memo_textarea.value = memo_textarea.value.replace(/\n/gi,"<br />");
	    if(strOriginalMemo && memo_textarea) memo_textarea.value = '';
        if(memo_textarea) oFCKeditor.ReplaceTextarea();
        else oFCKeditor.Create();
        eMemo_controller.style.display = 'none';
        if(htCheck) {
          htCheck.checked = true;
          htCheck.value   = 2;
        }
      } 
      else { // 에디터 숨김
        var oEditor ;
        oEditor = FCKeditorAPI.GetInstance(textAreaId) ;

        try { 
          if(oEditor.EditMode) memo_textarea.value = oEditor.GetXHTML(oEditor.Config.FormatSource);
          else memo_textarea.value = oEditor.GetXHTML();
          oFCK.Tools.RemoveEventListener( oEditor.GetParentForm(), 'submit', oEditor.UpdateLinkedField );
        }
        catch (e) { 
          //return false 
        }

        eMemo_controller.style.display = '';
        memo_textarea.style.display = '';
        memo_textarea.focus();

        configElement.parentNode.removeChild(configElement);
        frameElement.parentNode.removeChild(frameElement);
        delete FCKeditorAPI.Instances[textAreaId];
        delete FCKeditorAPI.__Instances[textAreaId];

        if(htCheck) htCheck.checked = false;
      }
  }

var oFCK;
function FCKeditor_OnComplete( editorInstance ){
  oFCK = editorInstance;
  oFCK.Tools = oFCK.EditorWindow.parent.FCKTools;
  if(strOriginalMemo) oFCK.SetHTML(strOriginalMemo);
  edCheck.disabled = false;
}

function toggle_mbPasswd() {
	var tr = document.getElementById('mbPassword');
	if (tr.style.display == 'none') {
		tr.style.display = '';
		document.zbform.password.focus();
	}
	else tr.style.display = 'none';
}

var rv = {
    ie : (document.all && !window.opera),
    safari : /Safari/.test(navigator.userAgent),
    geckoMac : /Macintosh.+rv:1\.[0-8].+Gecko/.test(navigator.userAgent),

  getPageSize : function () {
      var d = document, w = window, iebody = d.compatMode && d.compatMode != 'BackCompat' 
          ? d.documentElement : d.body;
      
      var width = rv.ie ? iebody.clientWidth : 
              (d.documentElement.clientWidth || self.innerWidth),
          height = rv.ie ? iebody.clientHeight : self.innerHeight;

      return {
          width: width,
          height: height,		
          scrollLeft: rv.ie ? iebody.scrollLeft : pageXOffset,
          scrollTop: rv.ie ? iebody.scrollTop : pageYOffset
      }
  },

  getPosition : function(el)	{
      var p = { x: el.offsetLeft, y: el.offsetTop };
      while (el.offsetParent)	{
          el = el.offsetParent;
          p.x += el.offsetLeft;
          p.y += el.offsetTop;
          if (el != document.body && el != document.documentElement) {
              p.x -= el.scrollLeft;
              p.y -= el.scrollTop;
          }
      }
      return p;
  }
}
