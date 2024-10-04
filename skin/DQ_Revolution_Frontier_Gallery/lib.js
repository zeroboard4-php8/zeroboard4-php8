var rv = {
  using_pixelLimit : false,
  pixelLimitValue : 300,
  zbMember : null,
  ie : (document.all && !window.opera),
  safari : /Safari/.test(navigator.userAgent),
  geckoMac : /Macintosh.+rv:1\.[0-8].+Gecko/.test(navigator.userAgent),
  firefox : (new RegExp(/Firefox/).test(navigator.userAgent)),
  ieVersion : function () {
      var arr = navigator.appVersion.split("MSIE");
      return arr[1] ? parseFloat(arr[1]) : null;
  },
  xmlHttp : false,
  ajaxInit : function() {
    try {
      this.xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        this.xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e2) {
        this.xmlHttp = false;
      }
    }
    if (!this.xmlHttp && typeof XMLHttpRequest != 'undefined') {
      this.xmlHttp = new XMLHttpRequest();
    }
  },
  clipboardCopy : function(text,msg) {
      window.clipboardData.setData('text', text);
      if(msg) alert("클립보드에 복사되었습니다.");
  },
  fadeIn : function(element, opacity, max) {
      var reduceOpacityBy = 10;
      var rate = 30;	// 15 fps
      
      if(!max) max = 100;

      if (opacity < max) {
          opacity += reduceOpacityBy;
          if (opacity > max) {
              opacity = max;
          }
          rv.setOpacity(element,opacity,max);
      }

      if (opacity < max) {
          setTimeout(function () {
              rv.fadeIn(element, opacity, max);
          }, rate);
      }
  },
  setOpacity : function(el, opacity, max) {
      if(!max) max = 100;
      if (el.filters) {
          try {
              el.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
          } catch (e) {
              el.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
          }
      } else {
          limit = max / 100;
          if(opacity/max > limit) return;
          el.style.opacity = opacity / max;
      }
  },
  arraySearch : function(array, val) {
       var len = array.length;
       for (var i=0; i < len; i++) {
              if (array[i] == val) return i;
       }
       return -1;
  },

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
  },
  
  addEvent : function(obj, type, fn) {
      if (obj.addEventListener)
          obj.addEventListener(type, fn, false);
      else if (obj.attachEvent)
      {
          obj["e"+type+fn] = fn;
          obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
          obj.attachEvent("on"+type, obj[type+fn]);
      }
  },
  removeEvent : function(obj, type, fn) {
      if (obj.removeEventListener)
          obj.removeEventListener(type, fn, false);
      else if (obj.detachEvent)
      {
          obj["e"+type+fn] = fn;
          obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
          obj.detachEvent("on"+type, obj[type+fn]);
      }
  },
  fireEvent : function (obj, evt, args) {
      return obj && obj[evt] ? (obj[evt](obj, args) !== false) : true;
  },
  chk_rightClickOnImage : function (e) { 
      var isRightButton = 0;
      var src;
      var chk_mrbtLimit = rv.SS.mrbt_clickLimit;

      if(window.event) src = window.event.srcElement;
      else if(e) src = e.target;

      if (window.event) e = window.event;
      if (e.which  ==3) isRightButton = true;
      if (e.button ==2) isRightButton = true;

      if ( rv.using_pixelLimit && isRightButton && src.tagName == "IMG" && (src.width >= rv.SS.mrbt_pixelValue || src.height >= rv.SS.mrbt_pixelValue) )
      { 
          alert('사진에는 마우스 오른쪽 버튼을 사용할 수 없습니다.');
          return false;
      }
  },
  loadScript : function (src) {
    document.writeln('<script type="text/JavaScript" src="'+src+'"></script>');
  }
};

rv.ajaxInit();


// -----------------------------------------------------------------------------------------------------
// JSON Library
// -----------------------------------------------------------------------------------------------------

if (!this.JSON) {

    JSON = function () {

        function f(n) {
            return n < 10 ? '0' + n : n;
        }

        Date.prototype.toJSON = function (key) {

            return this.getUTCFullYear()   + '-' +
                 f(this.getUTCMonth() + 1) + '-' +
                 f(this.getUTCDate())      + 'T' +
                 f(this.getUTCHours())     + ':' +
                 f(this.getUTCMinutes())   + ':' +
                 f(this.getUTCSeconds())   + 'Z';
        };

        var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
            escapeable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
            gap,
            indent,
            meta = {    // table of character substitutions
                '\b': '\\b',
                '\t': '\\t',
                '\n': '\\n',
                '\f': '\\f',
                '\r': '\\r',
                '"' : '\\"',
                '\\': '\\\\'
            },
            rep;


        function quote(string) {

            escapeable.lastIndex = 0;
            return escapeable.test(string) ?
                '"' + string.replace(escapeable, function (a) {
                    var c = meta[a];
                    if (typeof c === 'string') {
                        return c;
                    }
                    return '\\u' + ('0000' +
                            (+(a.charCodeAt(0))).toString(16)).slice(-4);
                }) + '"' :
                '"' + string + '"';
        }


        function str(key, holder) {

            var i,          // The loop counter.
                k,          // The member key.
                v,          // The member value.
                length,
                mind = gap,
                partial,
                value = holder[key];

            if (value && typeof value === 'object' &&
                    typeof value.toJSON === 'function') {
                value = value.toJSON(key);
            }

            if (typeof rep === 'function') {
                value = rep.call(holder, key, value);
            }

            switch (typeof value) {
            case 'string':
                return quote(value);

            case 'number':

                return isFinite(value) ? String(value) : 'null';

            case 'boolean':
            case 'null':

                return String(value);

            case 'object':

                if (!value) {
                    return 'null';
                }

                gap += indent;
                partial = [];

                if (typeof value.length === 'number' &&
                        !(value.propertyIsEnumerable('length'))) {

                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null';
                    }

                    v = partial.length === 0 ? '[]' :
                        gap ? '[\n' + gap +
                                partial.join(',\n' + gap) + '\n' +
                                    mind + ']' :
                              '[' + partial.join(',') + ']';
                    gap = mind;
                    return v;
                }

                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        k = rep[i];
                        if (typeof k === 'string') {
                            v = str(k, value, rep);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                } else {

                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = str(k, value, rep);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v);
                            }
                        }
                    }
                }

                v = partial.length === 0 ? '{}' :
                    gap ? '{\n' + gap +
                            partial.join(',\n' + gap) + '\n' +
                            mind + '}' :
                          '{' + partial.join(',') + '}';
                gap = mind;
                return v;
            }
        }


        return {
            stringify: function (value, replacer, space) {

                var i;
                gap = '';
                indent = '';

                if (typeof space === 'number') {
                    for (i = 0; i < space; i += 1) {
                        indent += ' ';
                    }

                } else if (typeof space === 'string') {
                    indent = space;
                }

                rep = replacer;
                if (replacer && typeof replacer !== 'function' &&
                        (typeof replacer !== 'object' ||
                         typeof replacer.length !== 'number')) {
                    throw new Error('JSON.stringify');
                }

                return str('', {'': value});
            },


            parse: function (text, reviver) {

                var j;

                function walk(holder, key) {

                    var k, v, value = holder[key];
                    if (value && typeof value === 'object') {
                        for (k in value) {
                            if (Object.hasOwnProperty.call(value, k)) {
                                v = walk(value, k);
                                if (v !== undefined) {
                                    value[k] = v;
                                } else {
                                    delete value[k];
                                }
                            }
                        }
                    }
                    return reviver.call(holder, key, value);
                }


                cx.lastIndex = 0;
                if (cx.test(text)) {
                    text = text.replace(cx, function (a) {
                        return '\\u' + ('0000' +
                                (+(a.charCodeAt(0))).toString(16)).slice(-4);
                    });
                }

                if (/^[\],:{}\s]*$/.
test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').
replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

                    j = eval('(' + text + ')');

                    return typeof reviver === 'function' ?
                        walk({'': j}, '') : j;
                }

                throw new SyntaxError('JSON.parse');
            }
        };
    }();
}

/*
if (!Object.prototype.toJSONString) {
    Object.prototype.toJSONString = function (filter) {
        return JSON.stringify(this, filter);
    };
    Object.prototype.parseJSON = function (filter) {
        return JSON.parse(this, filter);
    };
}
*/

function get_revolution_config()
{
    sync = isIE ? false : true;
/*    
    rv.xmlHttp.open('GET', rv.configQueryString+'&config=SS',false);
    rv.xmlHttp.onreadystatechange = function() {
		if (rv.xmlHttp.readyState == 4) {
		  rv.SS  = JSON.parse(rv.xmlHttp.responseText);
          rv.LNG = rv.SS.strLanguage;
          hs.graphicsDir = rv.SS.zbSkin_dir + '/plug-ins/highslide/graphics/';
		}
	}
*/
    rv.xmlHttp.open('GET', rv.configQueryString+'&config=SS',false);
    rv.xmlHttp.send(null);
    rv.SS  = JSON.parse(rv.xmlHttp.responseText);
    rv.LNG = rv.SS.strLanguage;
    hs.graphicsDir = rv.SS.zbSkin_dir + '/plug-ins/highslide/graphics/';
}
