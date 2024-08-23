/*
 * HTML Element Converter 2006.09.06
 * by NHN UII.Gony
 */

// create class
var Class = function(/* definition */){
	var obj = function() {
		if (this.__const) this.__const.apply(this,arguments);
	}
	if (arguments[0]) Class.extend(obj.prototype, arguments[0]);

	return obj;
}

// class inheritance - multiple inheritance supportable
Class.extend = function(superClass/*, subCls1, subCls2, ... */) {
	var obj = superClass;
	for(var i=1; i < arguments.length; i++) {
		if (arguments[i]) {
			for(var x in arguments[i]) {
				obj[x] = arguments[i][x];
			}
		}
	}

	return obj;
}

// global event object
var Event = {
	register : function(oEl, sEvent, pFunc) {
		oEl = $(oEl);
		if (oEl.addEventListener) {
			oEl.addEventListener(sEvent, pFunc, false);
		} else if(oEl.attachEvent) {
			oEl.attachEvent('on'+sEvent, pFunc);
		}
	},
	unregister : function(oEl, sEvent, pFunc) {
		oEl = $(oEl);
		if (oEl.removeEventListener) {
			oEl.removeEventListener(sEvent, pFunc, false);
		} else if(oEl.detachEvent) {
			oEl.detachEvent('on'+sEvent, pFunc);
		}
	},
 	ready : function(evt) {
		var e = evt || window.event;
		var b = document.body;

		Class.extend(e, {
			element : e.target || e.srcElement,
			page_x  : e.pageX || e.clientX+b.scrollLeft-b.clientLeft,
			page_y  : e.pageY || e.clientY+b.scrollTop-b.clientTop,
			key     : {
				alt : e.altKey,
				ctrl : e.ctrlKey,
				shift : e.shiftKey,
				up : [38,104].has(e.keyCode),
				down : [40,98].has(e.keyCode),
				left : [37,100].has(e.keyCode),
				right : [39,102].has(e.keyCode),
				enter : (e.keyCode==13)
			},
			mouse   : {
				left   : (e.which&&e.button==0)||!!(e.button&1),
				middle : (e.which&&e.button==1)||!!(e.button&4),
				right  : (e.which&&e.button==2)||!!(e.button&2)
			},
			stop : function() {
				if (this.preventDefault) {
					this.preventDefault();
					this.stopPropagation();
				} else {
					this.returnValue = false;
					this.cancelBubble = true;
				}
			}
		});

		return e;
	}
}

// global element object
var Element = {
	show : function() {
		[].load(arguments).each(function(v){ $(v).style.display=''; });
	},
	hide : function() {
		[].load(arguments).each(function(v){ $(v).style.display='none'; });
	},
	toggle : function() {
		[].load(arguments).each(function(v){ Element[Element.visible(v)?'hide':'show'](v) });
	},
	visible : function(oEl) {
		return ($(oEl).style.display!='none');
	},
	realPos : function(oEl) {
		if (oEl.offsetParent) {
			var p = this.realPos(oEl.offsetParent);
			return { top: oEl.offsetTop+p.top, left: oEl.offsetLeft+p.left };
		} else {
			return { top: oEl.offsetTop, left:oEl.offsetLeft };
		}
	},
	getCSS : function(oEl, name) {
		return oEl.style[name];
	},
	setCSS : function(oEl, css) {
		Class.extend(oEl.style, css);
	},
	hasClass : function(oEl, className) {
		return $(oEl).className.split(/\s+/).has(className);
	},
	addClass : function(oEl, className) {
		if (!this.hasClass(oEl, className)) ($(oEl).className+=' '+className).replace(/^\s+/,'');
	},
	removeClass : function(oEl, className) {
		$(oEl).className = $(oEl).className.replace(new RegExp('(^|\s+)'+className+'($|\s+)','g'),'');
	}
}

// array extend
Class.extend(Array.prototype, {
	has : function(value) {
		for(var i=0; i<this.length; i++) {
			if (this[i] == value) return true;
		}
		return false;
	},
	load : function(obj) {
		for(var i=0; i<obj.length; i++) {
			this.push(obj[i]);
		}
		return this;
	},
	each : function(iter) {
		for(var i=0; i<this.length; i++) {
			iter(this[i],i);
		}
	},
	filter : function(iter) {
		var ret = [];
		for(var i=0; i<this.length; i++) {
			if (iter(this[i],i)) ret.push(this[i]);
		}
		return ret;
	},
	map : function(iter) {
		for(var i=0; i<this.length; i++) {
			this[i] = iter(this[i],i);
		}
	},
	refuse : function(value) {
		return this.filter(function(v){ return v!=value });
	}
});
if (Array.prototype.forEach) {
	Array.prototype.each = Array.prototype.forEach;
}

// function extend
Class.extend(Function.prototype, {
	bind : function(obj) {
		var f=this, a=[].load(arguments);a.shift();
		return function() {
			return f.apply(obj, a);
		}
	},
	bindForEvent : function(obj) {
		var f=this;
		return function(e) {
			return f.call(obj, Event.ready(e));
		}
	}
});

// get object by id
function $() {
	var ret = [];
	for(var i=0; i < arguments.length; i++) {
		if (typeof arguments[i] == 'string') {
			ret.push(document.getElementById(arguments[i]));
		} else {
			ret.push(arguments[i]);
		}
	}
	return ret[1]?ret:ret[0];
}

// create element
function $c(tag) {
	return document.createElement(tag);
}

// get elements by class name
document.getElementsByClassName = function(className, oParent) {
	var a = [].load(($(oParent) || document.body).getElementsByTagName('*'));
	var r = new RegExp('(^|\\s)'+className+'($|\\s)');
	return a.filter(function(v){ return r.match(v.className); });
}
