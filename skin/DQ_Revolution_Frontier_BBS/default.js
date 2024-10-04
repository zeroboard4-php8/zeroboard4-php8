//document.zb_get_table_width.height = 0;
//document.zb_target_resize[0].height = 0;
browserName = navigator.appName;
browserVer = parseInt(navigator.appVersion);
var isIE = (browserName.match('Microsoft')) ? 1: 0;

function soTools_onoff(name) 
{
	var dir = rv.SS.zbSkin_dir + '/'+ rv.SS.css_dir;

    sn_on=new Image;
    sn_off=new Image;
    sn_on.src= dir+"name_on.gif";
    sn_off.src= dir+"name_off.gif";

    ss_on=new Image;
    ss_off=new Image;
    ss_on.src= dir+"subject_on.gif";
    ss_off.src= dir+"subject_off.gif";

    sc_on=new Image;
    sc_off=new Image;
    sc_on.src= dir+"content_on.gif";
    sc_off.src= dir+"content_off.gif";

    if(document.search[name].value=='on')
    {
    document.search[name].value='off';
    ImgSrc=eval(name+"_off.src");
    document[name].src=ImgSrc;
    }
    else
    {
    document.search[name].value='on';
    ImgSrc=eval(name+"_on.src");
    document[name].src=ImgSrc;
    }
	return false;
}

function soTools_togle(e) {
	soTools = document.getElementById('search_options_tool');
	imgSearch_toggle = document.getElementById('imgSearch_toggle');
	search_intext = document.getElementById('search_intext');
	if(soTools.style.display == 'block') {
		soTools.style.display = 'none';
		imgSearch_toggle.src = imgSearch_toggle.src.replace('search_ar2','search_ar1');
        dq_setCookie('dqRevolution_searchOption','hide',1)
	} else {
		soTools.style.display = 'block';
		imgSearch_toggle.src = imgSearch_toggle.src.replace('search_ar1','search_ar2');
        dq_setCookie('dqRevolution_searchOption','show',1)
	}
    src = (typeof(getEventSource(e)) != 'undefined');
	if(src) search_intext.focus();
}

function addEvent(obj, type, fn)
{
    if (obj.addEventListener)
        obj.addEventListener(type, fn, false);
    else if (obj.attachEvent)
    {
        obj["e"+type+fn] = fn;
        obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
        obj.attachEvent("on"+type, obj[type+fn]);
    }
}

function copyrightAlert() 
{
    if(copyrightAlertMsg) alert(copyrightAlertMsg); 
    return false;
}

function chk_resizeImages(){
    var a     = document.getElementsByTagName('IMG');
    var count = a.length;
    var i;
    for (i=0; i<=count ;i++ )
    {
      if(a[i] && a[i].id && a[i].id.match('dqResizedImg')) {
        if(!a[i].width) {
            window.setTimeout(chk_resizeImages,100);
            return;
        }
        imageResize(a[i]);
      }
    }
}

function view_orgimg(el,x,y)
{
    var target = document.getElementById('dqResizedvImg0');
	var newUrl = el.src.replace(rv.SS.zbSkin_dir+'/thumbnail.php','revol_getimg.php');

	if(rv.old_slide_thumbnail) rv.old_slide_thumbnail.className = 'slide_thumb_img';
	rv.old_slide_thumbnail = el;
	el.className = 'slide_thumb_img_over';

	if(!target || typeof(target) == 'undefined') return;
	if(newUrl == target.src) return;
	if(newUrl == target.org_src) return;

    target.src = newUrl;
	target.org_src = '';
    el.style.cursor = "url("+rv.SS.zbSkin_dir+"/plug-ins/highslide/graphics/zoomin.cur), pointer";

    if(x || y) {
		target.width  = x;
		target.height = y;
		call_AlphaImageLoader(target);
	} else {
		var tmpImg = new Image(); 
		tmpImg.src = target.src;
		tmpImg.onload = function() {
			target.width  = tmpImg.width;
			target.height = tmpImg.height;
			delete(tmpImg);
		}
	}
}

function GetImageSize(el) 
{ 
    src = el.src;
    if(el.naturalWidth) {
      width  = el.naturalWidth;
      height = el.naturalHeight;
    } else {
      var TmpImg = new Image();
      TmpImg.src = src; 
      width  = TmpImg.width; 
      height = TmpImg.height;
      delete TmpImg;
    }
    return { src : src, width : width, height : height }; 
} 

function imageResize(obj) 
{
	if(obj.org_src) return;
	var tmpImg = new Image();
    tmpImg.src = obj.src;

    rv.addEvent(tmpImg,"load", function() 
    {
      if(rv.ie && (tmpImg.readyState != 'complete' || obj.readyState != 'complete')) {
        setTimeout(function(){imageResize(obj)},50);
        delete tmpImg;
        return;
      }

      // 리사이즈가 필요한지 검사
      var chkResize = false;
      if(!obj.isResize) {
        if(resize_widthOnly) chkResize = tmpImg.width > rv.SS.pic_overLimit1 ? true : false;
        else chkResize = (tmpImg.width > rv.SS.pic_overLimit1 || tmpImg.height > rv.SS.pic_overLimit1) ? true : false;
      }

      if(chkResize)
      {
        if(resize_widthOnly) {
          y = tmpImg.height * rv.SS.pic_overLimit2 / tmpImg.width;
          x = rv.SS.pic_overLimit2;
          obj.width  = x;
          obj.height = y;
        }
        else {
          if(tmpImg.width > tmpImg.height) 
          {
              y = tmpImg.height * rv.SS.pic_overLimit2 / tmpImg.width;
              x = rv.SS.pic_overLimit2;
              if(y > rv.SS.pic_overLimit2) 
              {
                  x = tmpImg.width * rv.SS.pic_overLimit2 / tmpImg.height;
                  y = rv.SS.pic_overLimit2;
              } 
              obj.width  = x;
              obj.height = y;
          } 
          else 
          {
              x = tmpImg.width * rv.SS.pic_overLimit2 / tmpImg.height;
              y = rv.SS.pic_overLimit2;
              if(y > rv.SS.pic_overLimit2) 
              {
                  y = tmpImg.height * rv.SS.pic_overLimit2 / tmpImg.width;
                  x = rv.SS.pic_overLimit2;
              } 
              obj.width  = x;
              obj.height = y;
          }
        }
        obj.isResize = true;
      }

      // 리사이즈 필요없는 경우(원본이 1x1픽셀인 이미지를 정상 크기로 복구)
      else if(!obj.isResize) {
          obj.parentNode.className = null;
          if(tmpImg.width > rv.SS.pic_overLimit1 || !obj.width || obj.width <= 1) 
          {
              obj.width  = (tmpImg.width > rv.SS.pic_overLimit1)? rv.SS.pic_overLimit2 : tmpImg.width;
              obj.height = (tmpImg.width > rv.SS.pic_overLimit1)? tmpImg.height*rv.SS.pic_overLimit2/tmpImg.width : tmpImg.height;
          }
          if(isIE && rv.ieVersion() < 7 && obj.src.match("\.png$")) call_AlphaImageLoader(obj); 
      }
      if(obj.isResize) {
          if(!imageNavigatorOn) obj.style.cursor = "url("+rv.SS.zbSkin_dir+"/plug-ins/highslide/graphics/zoomin.cur), pointer";
          if(!imageNavigatorOn) obj.title = "";
          if(isIE) {
              if(obj.readyState == 'complete') call_AlphaImageLoader(obj); 
              else obj.onload = call_AlphaImageLoader(obj);
          }
      }

      // 하단 마진과 테두리 지정
      if(tmpImg.height > 300) {
        //obj.style.marginBottom = rv.SS.pic_vSpace+'px';
        if(rv.SS.using_picBorder) obj.className = 'pic_border';
        else obj.style.border = '0';
      }
      
      delete tmpImg;
    });

    tmpImg.src = obj.src;
}

var AlphaImageCount = 0;
function call_AlphaImageLoader(obj) 
{
	if(!isIE || AlphaImageCount > 9 || rv.ieVersion() > 7 || obj.org_src || obj.src.match("%")) return;
	if(obj.src.match("\.gif$")) return;
	obj.org_src = obj.src;
	obj.org_width  = obj.width;
	obj.org_height = obj.height;
	obj.src = 'images/t.gif';
   	obj.width  = obj.org_width;
    obj.height = obj.org_height;
	if(obj.readyState != 'complete') 
      obj.onload = function() 
      {
        obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+obj.org_src+"', sizingMethod='scale')";
      }
	obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+obj.org_src+"', sizingMethod='scale')";
    AlphaImageCount++;
}

function view_linkImg(obj) 
{
	tmpImg.src = obj.src;
	if(tmpImg.width > pic_overLimit1 || tmpImg.width != obj.width) view_img(obj);
	else return false;
}

function view_imgIconMode(obj,mbno) 
{
	iconClickViewMode = true;
	view_img(obj,mbno);
	iconClickViewMode = false;
}

function preloadImages() 
{
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

var imageNaviURL;

function imageNaviHide(e) 
{
    var naviArrow_top   = document.getElementById('floatNaviArrow_top');
    var naviArrow_left  = document.getElementById('floatNaviArrow_left');
    var naviArrow_right = document.getElementById('floatNaviArrow_right');
	naviArrow_top.style.display   = 'none';
	naviArrow_left.style.display  = 'none';
	naviArrow_right.style.display = 'none';

	src = getEventSource(e);

    if(src.isResize) 
    {
        thisToolbox = document.getElementById('dqResizedvImg_tools');
        if(thisToolboxMouseover == false) window.setTimeout("imgToolboxHide()",200);
    }
}

var thisToolboxMouseover = false;
var thisToolbox;
function imgToolboxHide() 
{
    if(!thisToolboxMouseover) thisToolbox.style.display = 'none';
}

function imgToolboxOn(e) 
{
    thisToolboxMouseover = true;
    src = getEventSource(e);
    addEvent(src,'mouseout',imgToolboxOut);
}

function imgToolboxOut() 
{
    thisToolboxMouseover = false;
}

var proc_fade_out;
function showThumbNaviSelector(el)
{
	var thumbNaviSelector = document.getElementById('thumbNaviSelector');
    thumbNaviSelector.style.display = 'block';
    if(isIE) thumbNaviSelector.alpha = 60;
    else thumbNaviSelector.alpha = 0.60;
    proc_fade_out = setTimeout("fadeout()");
}

function fadeout(el)
{
	var el = document.getElementById('thumbNaviSelector');
    var intervalTime;
    if(el.alpha > 0){
      if(isIE){
        el.alpha -= 5;
        if(el.alpha>0) el.style.filter = "alpha(opacity="+parseInt(el.alpha)+")";
        intervalTime = 20;
      } else {
        el.alpha -= 0.05;
        if(el.alpha>0.1) el.style.opacity = el.alpha;
        intervalTime = 20;
      }
      proc_fade_out = setTimeout("fadeout()",intervalTime);

    } else {
        el.alphain = 0;
        el.style.display = 'none';
    }
}
function ThumbNaviOut(obj){
  obj.style.cursor='default';
}

var idCounter = 0;
function addTempId(el){
    if(el.id) return;
    idCounter++;
    el.id = 'revolTempID_'+idCounter;
}
function onImageNavigator(obj,e,thumbNavi) 
{
    if(thumbNavi) obj = obj.firstChild;

    if (!obj.complete) return;
    var imgDevine		= Math.round(obj.width/3);
    var imgMpoint		= Math.round(obj.height/2);
    var img3point		= Math.round(obj.height/3);
    var pic_top			= document.getElementById('pic_top');
    var oFrame			= obj.parentNode.parentNode.parentNode.parentNode;
    var mouseX			= isIE ? e.offsetX : (e.clientX - obj.x + pageXOffset)+1;
    var mouseY			= isIE ? e.offsetY : (e.clientY - obj.y + pageYOffset)+1;
    var imgCenter		= obj.width/2;
    var naviArrow_top   = document.getElementById('floatNaviArrow_top');
    var naviArrow_left  = document.getElementById('floatNaviArrow_left');
    var naviArrow_right = document.getElementById('floatNaviArrow_right');
    naviArrow_top.style.display   = 'none';
    naviArrow_left.style.display  = 'none';
    naviArrow_right.style.display = 'none';

    p = rv.getPosition(obj);
    startX = p.x;
    startY = p.y;

    if(thumbNavi)
	{
    	var thumbNaviSelector = document.getElementById('thumbNaviSelector');
        innerBorderSize = (isIE && document.compatMode && document.compatMode == "BackCompat")? 6 : 8;
        
		if(mouseY < img3point*2) {
            if(thumbNaviSelector.currentCursor == obj.id+'1') return;
            obj.style.cursor = "url("+rv.SS.zbSkin_dir+"/plug-ins/highslide/graphics/zoomin.cur), pointer";
            thumbNaviSelector.style.cursor = obj.style.cursor;
            thumbNaviSelector.firstChild.style.cursor = obj.style.cursor;
            obj.naviMode = 1;
            thumbNaviSelector.style.left  = p.x + 'px';
            thumbNaviSelector.style.top   = p.y + 'px';
            thumbNaviSelector.style.width  = obj.width   - 6 + 'px';
            thumbNaviSelector.style.height = img3point*2 - 6 + 'px';
            thumbNaviSelector.firstChild.style.width  = obj.width   - innerBorderSize + 'px';
            thumbNaviSelector.firstChild.style.height = img3point*2 - innerBorderSize + 'px';
            showThumbNaviSelector(obj);
        }
		if(mouseY > img3point*2) {
            if(thumbNaviSelector.currentCursor == obj.id+'2') return;
            obj.style.cursor = 'pointer';
            thumbNaviSelector.style.cursor = obj.style.cursor;
            thumbNaviSelector.firstChild.style.cursor = obj.style.cursor;
            obj.naviMode = 2;
            thumbNaviSelector.style.left  = p.x + 'px';
            thumbNaviSelector.style.top   = p.y + img3point*2 + 'px';
            thumbNaviSelector.style.width  = obj.width - 6 + 'px';
            thumbNaviSelector.style.height = img3point - 6 + 'px';
            thumbNaviSelector.firstChild.style.width  = obj.width - innerBorderSize + 'px';
            thumbNaviSelector.firstChild.style.height = img3point - innerBorderSize + 'px';
            showThumbNaviSelector(obj);
            rv.addEvent(obj,"mouseup",function() { obj.isFocus = 1 });
        }
        addTempId(obj);
        thumbNaviSelector.currentCursor = obj.id+obj.naviMode;
    } 
    else 
    {
	    obj.style.cursor    = "pointer";

		// left
		if(mouseX < (imgCenter - (imgDevine/2)))
		{
			if(go_prev) 
			{
				imageNaviURL = go_prev;
				this.arrow_x = startX - 25;
				naviArrow_left.style.top  = startY + imgMpoint - 21 + 'px';
				naviArrow_left.style.left = (this.arrow_x < 1) ? 1 + 'px' : this.arrow_x + 'px';
				naviArrow_left.style.display = 'block';
			} 
			else 
			{
				imageNaviURL = null;
				obj.style.cursor = "default";
			}
		}
		// right
		if(mouseX > (imgCenter + (imgDevine/2)))
		{
			if(go_next) {
				imageNaviURL = go_next;
				naviArrow_right.style.top  = startY + imgMpoint - 21 + 'px';
				naviArrow_right.style.left = startX + obj.width + (obj.offsetWidth-obj.width) + 3 + 'px';
				naviArrow_right.style.display = 'block';
			}
			else 
			{
				imageNaviURL = null;
				obj.style.cursor = "default";
			}
		}
		// center
		if(mouseX > (imgCenter - (imgDevine/2)) && (mouseX < (imgCenter + (imgDevine/2))))
		{
			imageNaviURL = go_list;
			this.arrow_y = startY - 25;
			naviArrow_top.style.top  = (this.arrow_y < 1) ? 1 + 'px' : this.arrow_y + 'px';
			naviArrow_top.style.left = startX + (obj.width/2) + (obj.offsetWidth-obj.width)/2 - 20 + 'px';
			naviArrow_top.style.display = 'block';
		}

		if(obj.isResize) 
		{
		  var imgToolbox = document.getElementById('dqResizedvImg_tools');
		  if(imgToolbox) 
		  {
			  imgToolbox.style.left = p.x + obj.width  - 42 + 'px';
			  imgToolbox.style.top  = p.y + obj.height - 42 + 'px';
			  imgToolbox.style.display = 'block';
              imgToolbox.fullSizeImage = obj;
		  }
		}
	}
}

function gotoURL(e) 
{
    var isLeftButton;
    if(e.which==1) isLeftButton = true;
    if(e.button==1) isLeftButton = true;
    if(isLeftButton && imageNaviURL) location.href = imageNaviURL;
    else return true;
}

function callLightbox(obj, opt) 
{
    //라이트박스(Highslide JS)의 중간 리사이즈를 생략
    if(rv.zbViewMode) hs.allowSizeReduction = false;

    if(typeof(obj) == 'string') obj = document.getElementById(obj);
    if(obj.tagName=='IMG') 
    {
        if(!obj.isResize) return;
        src = obj.org_src ? obj.org_src : obj.src;
    } 
    else if(obj.tagName=='A') 
    {
        src = obj.href;
        obj.blur();
    }
    if(!obj.firstChild || !obj.firstChild.naviMode || obj.firstChild.naviMode == 1) {
        if( !opt ) return hs.expand(obj,{dimmingOpacity: 0.75, src: src});
        else return hs.expand(obj,opt);
    } else {
        document.location = opt.gotoUrl;
        return false;
    }
}

function dq_setCookie( name, value, expiredays )
{
  var todayDate = new Date();
  todayDate.setDate( todayDate.getDate() + expiredays );
  document.cookie = name + '=' + escape( value ) + '; path=/; expires=' + todayDate.toGMTString() + ';'
  return;
}

function dq_getCookie( name )
{
  var nameOfCookie = name + "=";
  var x = 0;
  while ( x <= document.cookie.length )
  {
     var y = (x+nameOfCookie.length);
     if ( document.cookie.substring( x, y ) == nameOfCookie ) {
       if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
         endOfCookie = document.cookie.length;
       return unescape( document.cookie.substring( y, endOfCookie ) );
     }
     x = document.cookie.indexOf( " ", x ) + 1;
     if ( x == 0 ) break;
  }
  return "";
}

function getEventSource(e) 
{
    var src;
    if(window.event) src = window.event.srcElement;
    else if(e) src = e.target;
    if(src) return src;
}

function movePage(e) 
{
	if(hs.getExpander()) return false;

	if(window.event) {
		e = window.event;
		var EventStatus = e.srcElement.tagName;
	} else {
		var EventStatus = e.target.tagName;
	}
	if(EventStatus!='INPUT'&&EventStatus!='TEXTAREA') {
		if (go_prev  && e.keyCode=='37') location.href=go_prev;
		if (go_next  && e.keyCode=='39') location.href=go_next;
		if (!go_prev && e.keyCode=='37') alert("맨 처음입니다.");
		if (!go_next && e.keyCode=='39') alert("맨 끝입니다.");
	}
}

hs.Expander.prototype.onInit = function (sender) {
    hs.runningExpander = true;
}
hs.Expander.prototype.onBeforeClose = function (sender) {
    hs.runningExpander = false;
}

hs.Expander.prototype.onAfterExpand = function( sender ) {
	exp = sender;
	obj = hs.getExpander();
	obj.content.isMember = obj.isMember;
	if(hs.ie && obj.contentType=='image' && exp.x.full > exp.x.size) 
	{
		call_AlphaImageLoader(obj.content);
    }
}

// 최대 크기로 확대 되었을때 t.gif를 원래 파일로 바꿈
hs.Expander.prototype.onDoFullExpand = function (sender) {
    if(hs.ie) {
    	exp = sender;
	    obj = hs.getExpander();
        if(obj.content.org_src) obj.content.src = obj.content.org_src;
    }
}

hs.expand_dq = function(a, params, custom) 
{
    if(typeof(obj) == 'string') obj = document.getElementById(obj);
    if(a.tagName=='IMG') 
    {
        if(!a.isResize) return;
        src = a.org_src ? obj.org_src : obj.src;
    } 
    else if(a.tagName=='A') 
    {
        src = a.href;
        a.blur();
    }
    else if(a.tagName=='DIV')
    {
        a.href = params.href;
        src = a.href;
        a.blur();
    }

    if(!a.firstChild || !a.firstChild.naviMode || a.firstChild.naviMode == 1) {
        if( !params ) return hs.expand(a,{dimmingOpacity: 0.75, src: src});
        else { 
          if (a.getParams) return params;
          try {
              start = params.gotoUrl.search('no=')+3;
              url   = params.gotoUrl.substring(start,params.gotoUrl.length);

              if(rv.SS.member_no == params.isMember) rv.using_pixelLimit = false;
              else rv.using_pixelLimit = true;

              rv.xmlHttp.open('GET', rv.SS.zbSkin_dir+'/view_count.php?no='+url, true);
              rv.xmlHttp.send(null);
              new hs.Expander(a, params, custom);
              return false;		
          } catch (e) { return false; }
        }
    } else if(!hs.runningExpander && a.firstChild.isFocus == 1) {
        a.firstChild.isFocus = 0;
        document.location = params.gotoUrl;
    }
    return false;
}
hs.addSlideshow_dq = function(group) {
    hs.addSlideshow({slideshowGroup:group,interval:3000,useControls:true,overlayOptions:{opacity:0.7,position:'bottom right',hideOnMouseOut:true}});
}

function nogrant(el) 
{ //글 읽기 권한 없을때 경고창 띄움
  rv.addEvent(el,"click",function() {
    if(!rv.SS.member_no) {
      if(confirm(rv.LNG.no_grant1)) 
        document.location = "login.php?id="+rv.SS.id;
    }
    else alert(rv.LNG.no_grant2);
  });
  el.style.cursor = "pointer";
}
