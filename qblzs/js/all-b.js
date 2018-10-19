/* 公共前后台数据 */
var sys_exploer = navigator.appName == "Microsoft Internet Explorer" ? "IE" : "FF";
var str_right = '<span style="color:darkblue;">&#8730;</span>';
var str_wrong = '<span style="color:darkred;">&#215;</span>';
var doc_type = (document.documentElement) ? document.documentElement : document.body;
var phpok_data = "";

function get_url(cfd, extend) {
	if (!cfd || cfd == "undefined") {
		return base_url
	}
	var url = base_file + "?";
	var array = cfd.split(",");
	if (array[0] && array[0] != "undefined") {
		url += "c=" + encode_utf8(array[0]) + "&"
	}
	if (array[1] && array[1] != "undefined") {
		url += "f=" + encode_utf8(array[1]) + "&"
	}
	if (array[2] && array[2] != "undefined") {
		url += "d=" + encode_utf8(array[2]) + "&"
	}
	if (extend && extend != "undefined") {
		url += extend + "&"
	}
	return url
}
function getid(id) {
	return document.getElementById(id)
}
function getform(formid, id) {
	if (!formid || formid == "undefined") {
		formid = "form"
	}
	return document.forms[formid].elements[id]
}
function img_load(url, id) {
	var img = new Image();
	getid(id).src = "img/loading.gif";
	img.src = url;
	if (img.complete) {
		getid(id).src = url;
		return true
	}
	img.onload = function() {
		getid(id).src = url
	}
}
function direct(url, frameid, isparent) {
	if (!isparent || isparent == "" || isparent == "undefined") {
		if (frameid) {
			window.frames[frameid].location.href = url
		} else {
			window.location.href = url
		}
	} else {
		if (!frameid || frameid == "" || frameid == "undefined") {
			parent.window.location.href = url
		} else {
			window.parent.frames[frameid].location.href = url
		}
	}
}
function eval_js(time, js) {
	time = parseFloat(time);
	if (time < 0.01) {
		eval(js)
	} else {
		if (time < 10) {
			time = time * 1000
		}
		window.setTimeout(js, time)
	}
}
function url_encode(str) {
	return transform(str)
}
function transform(s) {
	var hex = '';
	var i, j, t;
	j = 0;
	for (i = 0; i < s.length; i += 1) {
		t = hexfromdec(s.charCodeAt(i));
		if (t == '25') {
			t = ''
		}
		hex += '%' + t
	}
	return hex
}
function hexfromdec(num) {
	if (num > 65535) {
		return ("err!")
	}
	first = Math.round(num / 4096 - .5);
	temp1 = num - first * 4096;
	second = Math.round(temp1 / 256 - .5);
	temp2 = temp1 - second * 256;
	third = Math.round(temp2 / 16 - .5);
	fourth = temp2 - third * 16;
	return ("" + getletter(third) + getletter(fourth))
}
function getletter(num) {
	if (num < 10) {
		return num
	} else {
		if (num == 10) {
			return "A"
		}
		if (num == 11) {
			return "B"
		}
		if (num == 12) {
			return "C"
		}
		if (num == 13) {
			return "D"
		}
		if (num == 14) {
			return "E"
		}
		if (num == 15) {
			return "F"
		}
	}
}
function site_url() {
	var siteurl = window.location.href;
	siteurl = siteurl.substring(7, siteurl.indexOf("?"));
	var sitearray = siteurl.split("/");
	var newurl = "http://";
	for (var i = 0; i < (sitearray.length - 1); i += 1) {
		newurl += sitearray[i] + "/"
	}
	return newurl
}
function get_cookie(name) {
	var cookieValue = "";
	var search = name + "=";
	if (document.cookie.length > 0) {
		offset = document.cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if (end == -1) {
				end = document.cookie.length
			}
			cookieValue = unescape(document.cookie.substring(offset, end))
		}
	}
	return cookieValue
}
function set_cookie(cookieName, cookieValue, DayValue) {
	var expire = "";
	var day_value = 1;
	if (DayValue != null) {
		day_value = DayValue
	}
	expire = new Date((new Date()).getTime() + day_value * 86400000);
	expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape(cookieValue) + ";path=/" + expire
}
function del_cookie(cookieName) {
	var expire = "";
	expire = new Date((new Date()).getTime() - 1);
	expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape("") + ";path=/" + expire
}
function kill_error() {
	return true
}
Array.prototype.unique = function() {
	var a = {};
	var len = this.length;
	for (var i = 0; i < len; i += 1) {
		if (typeof a[this[i]] == "undefined") {
			a[this[i]] = 1
		}
	}
	this.length = 0;
	for (var i in a) {
		this[this.length] = i
	}
	return this
};

function join_str(str1, str2) {
	if (str1 == "" && str2 == "") {
		return false
	}
	if (str1 == "") {
		return str2
	}
	if (str2 == "") {
		return str1
	}
	var string = str1 + "," + str2;
	var array = string.split(",");
	var i = 0;
	var n_array = [];
	for (var m = 0; m < array.length; m += 1) {
		if (array[m] != "") {
			n_array[i] = array[m];
			i += 1
		}
	}
	n_array.unique();
	var n_string = n_array.join(",");
	if (n_string) {
		return n_string
	} else {
		return false
	}
}
function encode_utf8(str) {
	return EncodeUtf8(str)
}
function EncodeUtf8(s1) {
	var s = escape(s1);
	var sa = s.split("%");
	var retV = "";
	if (sa[0] != "") {
		retV = sa[0]
	}
	for (var i = 1; i < sa.length; i += 1) {
		if (sa[i].substring(0, 1) == "u") {
			retV += Hex2Utf8(Str2Hex(sa[i].substring(1, 5)));
			if (sa[i].length > 5) {
				retV += sa[i].substring(5)
			}
		} else {
			retV += "%" + sa[i]
		}
	}
	return retV
}
function Str2Hex(s) {
	var c = "";
	var n;
	var ss = "0123456789ABCDEF";
	var digS = "";
	for (var i = 0; i < s.length; i += 1) {
		c = s.charAt(i);
		n = ss.indexOf(c);
		digS += Dec2Dig(eval(n))
	}
	return digS
}
function Dec2Dig(n1) {
	var s = "";
	var n2 = 0;
	for (var i = 0; i < 4; i += 1) {
		n2 = Math.pow(2, 3 - i);
		if (n1 >= n2) {
			s += '1';
			n1 = n1 - n2
		} else {
			s += '0'
		}
	}
	return s
}
function Dig2Dec(s) {
	var retV = 0;
	if (s.length == 4) {
		for (var i = 0; i < 4; i += 1) {
			retV += eval(s.charAt(i)) * Math.pow(2, 3 - i)
		}
		return retV
	}
	return -1
}
function Hex2Utf8(s) {
	var retS = "";
	var tempS = "";
	var ss = "";
	if (s.length == 16) {
		tempS = "1110" + s.substring(0, 4);
		tempS += "10" + s.substring(4, 10);
		tempS += "10" + s.substring(10, 16);
		var sss = "0123456789ABCDEF";
		for (var i = 0; i < 3; i += 1) {
			retS += "%";
			ss = tempS.substring(i * 8, (eval(i) + 1) * 8);
			retS += sss.charAt(Dig2Dec(ss.substring(0, 4)));
			retS += sss.charAt(Dig2Dec(ss.substring(4, 8)))
		}
		return retS
	}
	return ""
}
var Layer = {
	init: function(url, divw, divh, vLeft, vTop) {
		var width = divw >= 950 ? 950 : divw;
		var height = divw >= 527 ? 527 : divh;
		var l_html = "<div id=\"-phpok-window-bg-\" style=\"position: absolute;width: 100%;background: #000;top: 0;left: 0;height:" + $(document).height() + "px;filter:alpha(opacity=0);opacity:0;z-index: 999\"></div>";
		l_html += "<div id=\"-phpok-window-box-\" style='position: fixed;_position: absolute;border: 5px solid #E9F3FD;background: #FFF;text-align: left;'>";
		l_html += "<div id=\"-phpok-window-close-\" style='position: absolute;right:7px;bottom:7px;cursor: pointer;z-index:1000;' onclick='Layer.over();'><img src='img/close.gif' /></div>";
		l_html += "<div id=\"-phpok-window-content-border-\" style='position: relative;border: 1px solid #A6C9E1;padding: 5px;'><div id=\"-phpok-window-content-\" style='position: relative;overflow: auto;'></div></div>";
		l_html += "</div>";
		$("body").append(l_html);
		$("#-phpok-window-content-").ajaxStart(function() {
			$(this).html("<img src='img/loading.gif' style='position: absolute;left:50%;top:50%;margin-left:-8px;margin-top:-8px;' />")
		});
		$.ajax({
			error: function() {
				$("#-phpok-window-content-").html("<p style='text-align:center;height:100px;line-height:100px;'>Load fail...</p>")
			},
			success: function(html) {
				$("#-phpok-window-content-").html("<iframe src=\"" + url + "\" width=\"100%\" height=\"" + parseInt(height) + "px\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" style='display: block;'></iframe>")
			}
		});
		$("#-phpok-window-bg-").show();
		$("#-phpok-window-bg-").animate({
			opacity: "0.8"
		}, "normal");
		$("#-phpok-window-box-").show();
		if (height >= 527) {
			$("#-phpok-window-content-").css({
				width: (parseInt(width) + 17) + "px",
				height: height + "px"
			})
		} else {
			$("#-phpok-window-content-").css({
				width: width + "px",
				height: height + "px"
			})
		}
		var cw = document.documentElement.clientWidth,
			ch = document.documentElement.clientHeight,
			est = document.documentElement.scrollTop;
		var _version = $.browser.version;
		if (_version == 6.0) {
			$("#-phpok-window-box-").css({
				left: "50%",
				top: (parseInt((ch) / 2) + est) + "px",
				marginTop: -((parseInt(height) + 53) / 2) + "px",
				marginLeft: -((parseInt(width) + 32) / 2) + "px",
				zIndex: "9999"
			})
		} else {
			$("#-phpok-window-box-").css({
				left: "50%",
				top: "50%",
				marginTop: -((parseInt(height) + 53) / 2) + "px",
				marginLeft: -((parseInt(width) + 32) / 2) + "px",
				zIndex: "9999"
			})
		}
	},
	over: function() {
		$("#-phpok-window-bg-").remove();
		$("#-phpok-window-box-").fadeOut("slow", function() {
			$(this).remove()
		})
	}
};

function select_all(id) {
	var t = id && id != "undefined" ? $("#" + id + " input[type*=checkbox]") : $("input[type*=checkbox]");
	t.each(function() {
		$(this).attr("checked", true)
	})
}
function select_none(id) {
	var t = id && id != "undefined" ? $("#" + id + " input[type*=checkbox]") : $("input[type*=checkbox]");
	t.each(function() {
		$(this).attr("checked", false)
	})
}
function select_anti(id) {
	var t = id && id != "undefined" ? $("#" + id + " input[type*=checkbox]") : $("input[type*=checkbox]");
	t.each(function() {
		if ($(this).attr("checked") == true) {
			$(this).attr("checked", false)
		} else {
			$(this).attr("checked", true)
		}
	})
}
function join_checkbox(id, type) {
	var cv = id && id != "undefined" ? $("#" + id + " input[type*=checkbox]") : $("input[type*=checkbox]");
	var idarray = [];
	var m = 0;
	cv.each(function() {
		if (type == "all") {
			idarray[m] = $(this).val();
			m += 1
		} else if (type == "unchecked") {
			if ($(this).attr("checked") == false) {
				idarray[m] = $(this).val();
				m += 1
			}
		} else {
			if ($(this).attr("checked") == true) {
				idarray[m] = $(this).val();
				m += 1
			}
		}
	});
	var tid = idarray.join(",");
	return tid
}
function get_ajax(turl, ajax_func, ext) {
	turl = turl.replace(/&amp;/g, "&");
	turl += "&callback=?";
	if (!ajax_func || ajax_func == "undefined" || ajax_func == ajax_success) {
		$.ajax({
			url: turl,
			cache: false,
			async: false,
			dataType: "script",
			success: function(phpok_data) {}
		})
	} else {
		$.ajax({
			url: turl,
			cache: false,
			dataType: "script",
			success: function() {
				ajax_func(phpok_data, ext)
			}
		})
	}
}
function ajax_get(turl, ajax_func) {
	turl = turl.replace(/&amp;/g, "&");
	return $.ajax({
		url: turl,
		cache: false,
		async: false,
		dataType: "text"
	}).responseText
}
function ajax_success(msg, ext) {
	if (!ext || ext == "undefined") {
		ext = window.location.href
	}
	if (msg == "ok") {
		window.location.href = ext;
		return true
	} else {
		if (!msg) {
			msg = "error!"
		}
		return false
	}
}
function over_tr(v) {
	v.className = "tr_over"
}
function out_tr(v) {
	v.className = "tr_out"
}
if (!this.JSON) {
	this.JSON = {}
}(function() {
	function f(n) {
		return n < 10 ? '0' + n : n
	}
	if (typeof Date.prototype.toJSON !== 'function') {
		Date.prototype.toJSON = function(key) {
			return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-' + f(this.getUTCMonth() + 1) + '-' + f(this.getUTCDate()) + 'T' + f(this.getUTCHours()) + ':' + f(this.getUTCMinutes()) + ':' + f(this.getUTCSeconds()) + 'Z' : null
		};
		String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(key) {
			return this.valueOf()
		}
	}
	var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
		escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
		gap, indent, meta = {
			'\b': '\\b',
			'\t': '\\t',
			'\n': '\\n',
			'\f': '\\f',
			'\r': '\\r',
			'"': '\\"',
			'\\': '\\\\'
		},
		rep;

	function quote(string) {
		escapable.lastIndex = 0;
		return escapable.test(string) ? '"' + string.replace(escapable, function(a) {
			var c = meta[a];
			return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4)
		}) + '"' : '"' + string + '"'
	}
	function str(key, holder) {
		var i, k, v, length, mind = gap,
			partial, value = holder[key];
		if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
			value = value.toJSON(key)
		}
		if (typeof rep === 'function') {
			value = rep.call(holder, key, value)
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
				return 'null'
			}
			gap += indent;
			partial = [];
			if (Object.prototype.toString.apply(value) === '[object Array]') {
				length = value.length;
				for (i = 0; i < length; i += 1) {
					partial[i] = str(i, value) || 'null'
				}
				v = partial.length === 0 ? '[]' : gap ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' : '[' + partial.join(',') + ']';
				gap = mind;
				return v
			}
			if (rep && typeof rep === 'object') {
				length = rep.length;
				for (i = 0; i < length; i += 1) {
					k = rep[i];
					if (typeof k === 'string') {
						v = str(k, value);
						if (v) {
							partial.push(quote(k) + (gap ? ': ' : ':') + v)
						}
					}
				}
			} else {
				for (k in value) {
					if (Object.hasOwnProperty.call(value, k)) {
						v = str(k, value);
						if (v) {
							partial.push(quote(k) + (gap ? ': ' : ':') + v)
						}
					}
				}
			}
			v = partial.length === 0 ? '{}' : gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' : '{' + partial.join(',') + '}';
			gap = mind;
			return v
		}
	}
	if (typeof JSON.stringify !== 'function') {
		JSON.stringify = function(value, replacer, space) {
			var i;
			gap = '';
			indent = '';
			if (typeof space === 'number') {
				for (i = 0; i < space; i += 1) {
					indent += ' '
				}
			} else if (typeof space === 'string') {
				indent = space
			}
			rep = replacer;
			if (replacer && typeof replacer !== 'function' && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
				throw new Error('JSON.stringify')
			}
			return str('', {
				'': value
			})
		}
	}
	if (typeof JSON.parse !== 'function') {
		JSON.parse = function(text, reviver) {
			var j;

			function walk(holder, key) {
				var k, v, value = holder[key];
				if (value && typeof value === 'object') {
					for (k in value) {
						if (Object.hasOwnProperty.call(value, k)) {
							v = walk(value, k);
							if (v !== undefined) {
								value[k] = v
							} else {
								delete value[k]
							}
						}
					}
				}
				return reviver.call(holder, key, value)
			}
			cx.lastIndex = 0;
			if (cx.test(text)) {
				text = text.replace(cx, function(a) {
					return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4)
				})
			}
			if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
				j = eval('(' + text + ')');
				return typeof reviver === 'function' ? walk({
					'': j
				}, '') : j
			}
			throw new SyntaxError('JSON.parse')
		}
	}
}());
var Media = {
	init: function(url, width, height, image) {
		if (url) {
			var tmp_u = url.substr(0, 7);
			tmp_u = tmp_u.toLowerCase();
			if (tmp_u != "http://" && tmp_u != "https:/") {
				url = '/' + url
			}
		}
		Media.url = url ? url : "";
		Media.width = width ? width : "400px";
		Media.height = height ? height : "45px";
		if (image && image != "undefined") {
			Media.image = '/' + image;
		}
		return Media.Analysis()
	},
	Analysis: function() {
		var url = Media.url;
		if (!url) {
			return false
		}
		var linktype = [];
		linktype['wma'] = 'wmp';
		linktype['mp3'] = 'wmp';
		linktype['wmv'] = 'wmp';
		linktype['asf'] = 'wmp';
		linktype['mpg'] = 'wmp';
		linktype['mpeg'] = 'wmp';
		linktype['avi'] = 'wmp';
		linktype['asx'] = 'wmp';
		linktype['dat'] = 'wmp';
		linktype['rm'] = 'real';
		linktype['rmvb'] = 'real';
		linktype['ram'] = 'real';
		linktype['ra'] = 'real';
		linktype['swf'] = 'flash';
		linktype['flv'] = 'flv';
		var start = url.lastIndexOf(".");
		var end = url.length;
		var type = url.substring(start + 1, end);
		type = type.toLowerCase();
		var chk_radio = linktype[type];
		if (!chk_radio) {
			return false
		}
		if (chk_radio == "flash") {
			return Media.Flash()
		} else if (chk_radio == "flv") {
			return Media.Flv()
		} else if (chk_radio == "real") {
			return Media.Real()
		} else if (chk_radio == "wmp") {
			return Media.Wmp()
		}
	},
	Flash: function() {
		var string = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" + Media.width + "' height='" + Media.height + "'>";
		string += "<param name='movie' value='" + Media.url + "'>";
		string += "<param name='quality' value='high'>";
		string += "<embed src='" + Media.url + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + Media.width + "' height='" + Media.height + "'></embed>";
		string += "</object>";
		return string
	},
	Flv: function() {
		var string = "<object type='application/x-shockwave-flash' data='img/vcastr/vcastr.swf' width='" + Media.width + "' height='" + Media.height + "'>";
		string += "<param name='movie' value='img/vcastr/vcastr.swf' />";
		string += "<param name='allowFullScreen' value='true' />";
		string += "<param name='FlashVars' value='xml={vcastr}{channel}{item}{source}" + Media.url + "{/source}{duration}{/duration}{title}{/title}{/item}{/channel}{config}{isAutoPlay}false{/isAutoPlay}{isLoadBegin}false{/isLoadBegin}{/config}{plugIns}{beginEndImagePlugIn}{url}img/vcastr/image.swf{/url}{source}" + Media.image + "{/source}{type}beginend{/type}{scaletype}exactFil{/scaletype}{/beginEndImagePlugIn}{/plugIns}{/vcastr}'>";
		string += "</object>";
		return string
	},
	Real: function() {
		var string = "<object classid='clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA' width='" + Media.width + "' height='" + Media.height + "'>";
		string += "<param name='src' value='" + Media.url + "' />";
		string += "<param name='controls' value='Imagewindow' />";
		string += "<param name='console' value='clip1' />";
		string += "<param name='autostart' value='true' />";
		string += "<embed src='' type='audio/x-pn-realaudio-plugin' autostart='true' console='clip1' controls='Imagewindow' width='" + Media.width + "'height='" + Media.height + "' />";
		string += "</embed></object>";
		return string
	},
	Wmp: function() {
		var string = "<object classid='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6' width='" + Media.width + "' height='" + Media.height + "'>";
		string += "<param name='url' value='" + Media.url + "' />";
		string += "<embed type='application/x-mplayer2' src='" + Media.url + "' width='" + Media.width + "' height='" + Media.height + "'></embed>";
		string += "</object>";
		return string
	}
};

function phpok_update_code() {
	var rand = Math.random();
	var msg = '<img src="' + get_url("login,codes") + 'rand=' + rand + '" border="0" align="absmiddle" style="cursor:pointer;" onclick="phpok_update_code()">';
	getid("phpok_update_code").innerHTML = msg
}
function check_code(ths) {
	var rand = Math.random();
	var codeurl = get_url("login,codes") + 'rand=' + rand;
	ths.src = codeurl
}; /* 前台通过JS获取数据来处理PHP信息 */

function func_php(module, func, id) {
	var url = get_url("js", "act=" + module);
	get_ajax(url, func, id)
}
function js_usercp(msg, id) {
	if (msg && msg != "false") {
		getid(id).innerHTML = msg
	}
	return true
}
function logout() {
	var q = confirm("确定要退出吗？");
	if (q != "0") {
		var url = get_url("js", "act=logout");
		get_ajax(url);
		direct(window.location.href)
	}
}
function js_reply(msg, id) {
	if (msg && msg != "false") {
		getid(id).innerHTML = msg
	}
	return true
}
function js_show_digg(msg, id) {
	if (getid(id) && msg != "false" && msg != "clicked" && msg) {
		getid(id).style.display = "";
		getid(id).innerHTML = msg
	} else if (msg == "clicked") {
		var val = "You have clicked on, please do not repeat it.";
		if (getid("clicked_val") && getid("clicked_val").value) {
			val = getid("clicked_val").value
		}
		alert(val);
		return false
	}
	return true
}
function addcart(id) {
	var turl = base_file + "?c=cart&f=ajax_add&id=" + id;
	get_ajax(turl, "", base_file + "?c=cart")
}
function lang_select(val) {
	var url = base_file + "?langid=" + val;
	window.location.href = url
}
function flash(file, width, height, div_id) {
	var fcode = "";
	fcode += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
	fcode += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" ';
	fcode += 'width="' + width + '" height="' + height + '">';
	fcode += '<param name="movie" value="' + file + '" type="application/x-shockwave-flash">';
	fcode += '<embed src="' + file + '" wmode="transparent" quality="high" ';
	fcode += 'pluginspage="http://www.macromedia.com/go/getflashplayer" ';
	fcode += 'type="application/x-shockwave-flash" width="' + width + '" height="' + height + '">';
	fcode += '</embed></object>';
	div_id ? $(div_id).innerHTML = fcode : document.write(fcode)
}; // 动态扩展字段中涉及到的JS信息
/** 这一部分都是图片相关的JS操作 **/
//弹出图片选择器窗口

function phpjs_img(input_id, view_id) {
	var extend = "type=img&input=" + input_id + "&view=" + view_id;
	var url = get_url("open", extend);
	Layer.init(url, 550, 400);
	return true
}
function phpjs_clear_img(input_id, view_id) {
	getid(input_id).value = "";
	getid(view_id).innerHTML = "<img src='img/nopic.gif' />";
	return true
}
function phpjs_video(input_id, view_id) {
	var extend = "type=video&input=" + input_id + "&view=" + view_id;
	var url = get_url("open", extend);
	Layer.init(url, 550, 400);
	return true
}
function phpjs_clear_video(input_id, view_id) {
	getid(input_id).value = "";
	getid(view_id).innerHTML = "";
	return true
}
function phpjs_download(input_id, view_id) {
	var extend = "type=download&input=" + input_id + "&view=" + view_id;
	var url = get_url("open", extend);
	Layer.init(url, 550, 400);
	return true
}
function phpjs_clear_download(input_id, view_id) {
	getid(input_id).value = "";
	getid(view_id).innerHTML = "";
	return true
}
function phpjs_preview(id, pretype) {
	var extend = "id=" + id + "&";
	if (pretype && pretype != "undefined") {
		extend += "pretype=" + pretype + "&"
	}
	var url = get_url("open,preview", extend);
	Layer.init(url, 550, 400);
	return true
}
function phpjs_parent_opt(val, id, fid) {
	if (!id || id == "undefined") {
		return false
	}
	var extend = "fid=" + fid + "&";
	getid(id).value = val;
	if (val && val != "undefined") {
		extend += "val=" + EncodeUtf8(val) + "&"
	}
	var url = get_url("datalink,ajax_opt", extend);
	var msg = ajax_get(url);
	if (!msg) {
		alert("操作有误");
		return false
	}
	var array = JSON.parse(msg);
	if (array["error"]) {
		getid("_opt_parent_" + id).innerHTML = array["error"];
		return true
	}
	if (array["parent"] && array["parent"] != "undefined") {
		getid("_opt_parent_" + id).innerHTML = array["parent"]
	}
	if (array["son"] && array["son"] != "undefined") {
		getid("_opt_son_" + id).innerHTML = array["son"]
	} else {
		getid("_opt_son_" + id).innerHTML = ""
	}
	return true
}
function phpjs_son_opt(val, id) {
	getid(id).value = val;
	return true
}
function phpjs_parent_becate(val, id, fid) {
	if (!id || id == "undefined") {
		return false
	}
	var extend = "fid=" + fid + "&";
	getid(id).value = val;
	if (val && val != "undefined") {
		extend += "val=" + EncodeUtf8(val) + "&"
	}
	var url = get_url("list,ajax_becate", extend);
	var msg = ajax_get(url);
	if (!msg) {
		alert("操作有误");
		return false
	}
	var array = JSON.parse(msg);
	if (array["error"]) {
		getid("_opt_parent_" + id).innerHTML = array["error"];
		return true
	}
	if (array["parent"] && array["parent"] != "undefined") {
		getid("_opt_parent_" + id).innerHTML = array["parent"]
	} else {
		getid("_opt_parent_" + id).innerHTML = ""
	}
	return true
}
function phpjs_son_becate(val, id) {
	getid(id).value = val;
	return true
}
function phpjs_parent_bemod(val, id, fid) {
	if (!id || id == "undefined") {
		return false
	}
	var extend = "fid=" + fid + "&";
	getid(id).value = val;
	if (val && val != "undefined") {
		extend += "val=" + EncodeUtf8(val) + "&"
	}
	var url = get_url("list,ajax_bemod", extend);
	var msg = ajax_get(url);
	if (!msg) {
		alert("操作有误");
		return false
	}
	var array = JSON.parse(msg);
	if (array["error"]) {
		getid("_opt_parent_" + id).innerHTML = array["error"];
		return true
	}
	if (array["parent"] && array["parent"] != "undefined") {
		getid("_opt_parent_" + id).innerHTML = array["parent"]
	} else {
		getid("_opt_parent_" + id).innerHTML = ""
	}
	return true
}
function phpjs_son_bemod(val, id) {
	getid(id).value = val;
	return true
}
function phpjs_fck_img(id) {
	var extend = "fck_id=" + id + "&type=img";
	var url = get_url("open,fck", extend);
	var Editor = FCKeditorAPI.GetInstance(id);
	var EditorType = FCK_EDITMODE_WYSIWYG;
	if (Editor.EditMode != EditorType) {
		alert("请取消源码查看，使用可视化编辑器");
		return false
	}
	Layer.init(url, 550, 400);
	return true
}
function phpjs_fck_download(id) {
	var extend = "fck_id=" + id + "&type=download";
	var url = get_url("open,fck", extend);
	var Editor = FCKeditorAPI.GetInstance(id);
	var EditorType = FCK_EDITMODE_WYSIWYG;
	if (Editor.EditMode != EditorType) {
		alert("请取消源码查看，使用可视化编辑器");
		return false
	}
	Layer.init(url, 550, 400);
	return true
}
function phpjs_fck_video(id) {
	var extend = "fck_id=" + id + "&type=video";
	var url = get_url("open,fck", extend);
	var Editor = FCKeditorAPI.GetInstance(id);
	var EditorType = FCK_EDITMODE_WYSIWYG;
	if (Editor.EditMode != EditorType) {
		alert("请取消源码查看，使用可视化编辑器");
		return false
	}
	Layer.init(url, 550, 400);
	return true
}
function phpjs_viewpic(n_vid, input) {
	var input_view = "_view_" + input;
	if (!n_vid || n_vid == "" || n_vid == "undefined") {
		getid(input_view).innerHTML = "<img src='img/nopic.gif' />";
		return true
	}
	var url = get_url('open,ajax_preview_img') + "idstring=" + n_vid;
	var msg = get_ajax(url);
	if (msg == "empty") {
		phpjs_viewpic("", input_view);
		return true
	}
	var array = JSON.parse(msg);
	var length_array = array.length;
	var p_html = '<table><tr>';
	for (var i = 0; i < length_array; i += 1) {
		var tmp_i = i + 1;
		var srcurl = array[i]["url"];
		if (!srcurl || srcurl == "" || srcurl == "undefined") {
			srcurl = "img/nopic.gif"
		}
		p_html += '<td><img src="' + srcurl + '" class="hand" onclick="phpjs_preview(\'' + array[i]["id"] + '\')" /></td>';
		if (tmp_i % 8 == "") {
			p_html += "</tr><tr>"
		}
	}
	p_html += "</tr></table>";
	getid(input_view).innerHTML = p_html;
	return true
}
function phpjs_viewdown(id, input) {
	var input_view = "_view_" + input;
	if (!id || id == "" || id == "undefined") {
		return false
	}
	var viewhtml = '<input type="button" value="详情" class="button" onclick="phpjs_preview(\'' + id + '\',\'download\')"> 附件ID：' + id + ' <img src="img/download.gif" align="absmiddle" /> ';
	getid(input_view).innerHTML = viewhtml;
	return true
}
function phpjs_viewvideo(id, input) {
	var input_view = "_view_" + input;
	if (!id || id == "" || id == "undefined") {
		return false
	}
	var viewhtml = '<input type="button" value="预览" class="button" onclick="phpjs_preview(\'' + id + '\')"> 影音ID：' + id + ' <img src="img/video.gif" align="absmiddle" /> ';
	getid(input_view).innerHTML = viewhtml;
	return true
}
function phpjs_onepic(vid) {
	var extend = "input=" + vid;
	var url = get_url("open,img", extend);
	Layer.init(url, 550, 400);
	return true
}
function phpjs_onepic_view(vid) {
	var url = getid(vid).value;
	if (!url) {
		alert("没有相关图片信息！");
		return false
	}
	Layer.init(url, 550, 400);
	return true
}
function phpjs_onepic_clear(vid) {
	getid(vid).value = "";
	return true
}; /* layer-v3.1.0 Web弹层组件 MIT License  http://layer.layui.com/  By 贤心 */
;
!
function(e, t) {
	"use strict";
	var i, n, a = e.layui && layui.define,
		o = {
			getPath: function() {
				var e = document.scripts,
					t = e[e.length - 1],
					i = t.src;
				if (!t.getAttribute("merge")) return i.substring(0, i.lastIndexOf("/") + 1)
			}(),
			config: {},
			end: {},
			minIndex: 0,
			minLeft: [],
			btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
			type: ["dialog", "page", "iframe", "loading", "tips"],
			getStyle: function(t, i) {
				var n = t.currentStyle ? t.currentStyle : e.getComputedStyle(t, null);
				return n[n.getPropertyValue ? "getPropertyValue" : "getAttribute"](i)
			},
			link: function(t, i, n) {
				if (r.path) {
					var a = document.getElementsByTagName("head")[0],
						s = document.createElement("link");
					"string" == typeof i && (n = i);
					var l = (n || t).replace(/\.|\//g, ""),
						f = "layuicss-" + l,
						c = 0;
					s.rel = "stylesheet", s.href = r.path + t, s.id = f, document.getElementById(f) || a.appendChild(s), "function" == typeof i && !
					function u() {
						return ++c > 80 ? e.console && console.error("layer.css: Invalid") : void(1989 === parseInt(o.getStyle(document.getElementById(f), "width")) ? i() : setTimeout(u, 100))
					}()
				}
			}
		},
		r = {
			v: "3.1.0",
			ie: function() {
				var t = navigator.userAgent.toLowerCase();
				return !!(e.ActiveXObject || "ActiveXObject" in e) && ((t.match(/msie\s(\d+)/) || [])[1] || "11")
			}(),
			index: e.layer && e.layer.v ? 1e5 : 0,
			path: o.getPath,
			config: function(e, t) {
				return e = e || {}, r.cache = o.config = i.extend({}, o.config, e), r.path = o.config.path || r.path, "string" == typeof e.extend && (e.extend = [e.extend]), o.config.path && r.ready(), e.extend ? (a ? layui.addcss("modules/layer/" + e.extend) : o.link("theme/" + e.extend), this) : this
			},
			ready: function(e) {
				var t = "layer",
					i = "",
					n = (a ? "modules/layer/" : "theme/") + "default/layer.css?v=" + r.v + i;
			},
			alert: function(e, t, n) {
				var a = "function" == typeof t;
				return a && (n = t), r.open(i.extend({
					content: e,
					yes: n
				}, a ? {} : t))
			},
			confirm: function(e, t, n, a) {
				var s = "function" == typeof t;
				return s && (a = n, n = t), r.open(i.extend({
					content: e,
					btn: o.btn,
					yes: n,
					btn2: a
				}, s ? {} : t))
			},
			msg: function(e, n, a) {
				var s = "function" == typeof n,
					f = o.config.skin,
					c = (f ? f + " " + f + "-msg" : "") || "layui-layer-msg",
					u = l.anim.length - 1;
				return s && (a = n), r.open(i.extend({
					content: e,
					time: 3e3,
					shade: !1,
					skin: c,
					title: !1,
					closeBtn: !1,
					btn: !1,
					resize: !1,
					end: a
				}, s && !o.config.skin ? {
					skin: c + " layui-layer-hui",
					anim: u
				} : function() {
					return n = n || {}, (n.icon === -1 || n.icon === t && !o.config.skin) && (n.skin = c + " " + (n.skin || "layui-layer-hui")), n
				}()))
			},
			load: function(e, t) {
				return r.open(i.extend({
					type: 3,
					icon: e || 0,
					resize: !1,
					shade: .01
				}, t))
			},
			tips: function(e, t, n) {
				return r.open(i.extend({
					type: 4,
					content: [e, t],
					closeBtn: !1,
					time: 3e3,
					shade: !1,
					resize: !1,
					fixed: !1,
					maxWidth: 210
				}, n))
			}
		},
		s = function(e) {
			var t = this;
			t.index = ++r.index, t.config = i.extend({}, t.config, o.config, e), document.body ? t.creat() : setTimeout(function() {
				t.creat()
			}, 30)
		};
	s.pt = s.prototype;
	var l = ["layui-layer", ".layui-layer-title", ".layui-layer-main", ".layui-layer-dialog", "layui-layer-iframe", "layui-layer-content", "layui-layer-btn", "layui-layer-close"];
	l.anim = ["layer-anim-00", "layer-anim-01", "layer-anim-02", "layer-anim-03", "layer-anim-04", "layer-anim-05", "layer-anim-06"], s.pt.config = {
		type: 0,
		shade: .3,
		fixed: !0,
		move: l[1],
		title: "&#x4FE1;&#x606F;",
		offset: "auto",
		area: "auto",
		closeBtn: 1,
		time: 0,
		zIndex: 19891014,
		maxWidth: 360,
		anim: 0,
		isOutAnim: !0,
		icon: -1,
		moveType: 1,
		resize: !0,
		scrollbar: !0,
		tips: 2
	}, s.pt.vessel = function(e, t) {
		var n = this,
			a = n.index,
			r = n.config,
			s = r.zIndex + a,
			f = "object" == typeof r.title,
			c = r.maxmin && (1 === r.type || 2 === r.type),
			u = r.title ? '<div class="layui-layer-title" style="' + (f ? r.title[1] : "") + '">' + (f ? r.title[0] : r.title) + "</div>" : "";
		return r.zIndex = s, t([r.shade ? '<div class="layui-layer-shade" id="layui-layer-shade' + a + '" times="' + a + '" style="' + ("z-index:" + (s - 1) + "; ") + '"></div>' : "", '<div class="' + l[0] + (" layui-layer-" + o.type[r.type]) + (0 != r.type && 2 != r.type || r.shade ? "" : " layui-layer-border") + " " + (r.skin || "") + '" id="' + l[0] + a + '" type="' + o.type[r.type] + '" times="' + a + '" showtime="' + r.time + '" conType="' + (e ? "object" : "string") + '" style="z-index: ' + s + "; width:" + r.area[0] + ";height:" + r.area[1] + (r.fixed ? "" : ";position:absolute;") + '">' + (e && 2 != r.type ? "" : u) + '<div id="' + (r.id || "") + '" class="layui-layer-content' + (0 == r.type && r.icon !== -1 ? " layui-layer-padding" : "") + (3 == r.type ? " layui-layer-loading" + r.icon : "") + '">' + (0 == r.type && r.icon !== -1 ? '<i class="layui-layer-ico layui-layer-ico' + r.icon + '"></i>' : "") + (1 == r.type && e ? "" : r.content || "") + '</div><span class="layui-layer-setwin">' +
		function() {
			var e = c ? '<a class="layui-layer-min" href="javascript:;"><cite></cite></a><a class="layui-layer-ico layui-layer-max" href="javascript:;"></a>' : "";
			return r.closeBtn && (e += '<a class="layui-layer-ico ' + l[7] + " " + l[7] + (r.title ? r.closeBtn : 4 == r.type ? "1" : "2") + '" href="javascript:;"></a>'), e
		}() + "</span>" + (r.btn ?
		function() {
			var e = "";
			"string" == typeof r.btn && (r.btn = [r.btn]);
			for (var t = 0, i = r.btn.length; t < i; t++) e += '<a class="' + l[6] + t + '">' + r.btn[t] + "</a>";
			return '<div class="' + l[6] + " layui-layer-btn-" + (r.btnAlign || "") + '">' + e + "</div>"
		}() : "") + (r.resize ? '<span class="layui-layer-resize"></span>' : "") + "</div>"], u, i('<div class="layui-layer-move"></div>')), n
	}, s.pt.creat = function() {
		var e = this,
			t = e.config,
			a = e.index,
			s = t.content,
			f = "object" == typeof s,
			c = i("body");
		if (!t.id || !i("#" + t.id)[0]) {
			switch ("string" == typeof t.area && (t.area = "auto" === t.area ? ["", ""] : [t.area, ""]), t.shift && (t.anim = t.shift), 6 == r.ie && (t.fixed = !1), t.type) {
			case 0:
				t.btn = "btn" in t ? t.btn : o.btn[0], r.closeAll("dialog");
				break;
			case 2:
				var s = t.content = f ? t.content : [t.content || "http://layer.layui.com", "auto"];
				t.content = '<iframe scrolling="' + (t.content[1] || "auto") + '" allowtransparency="true" id="' + l[4] + a + '" name="' + l[4] + a + '" onload="this.className=\'\';" class="layui-layer-load" frameborder="0" src="' + t.content[0] + '"></iframe>';
				break;
			case 3:
				delete t.title, delete t.closeBtn, t.icon === -1 && 0 === t.icon, r.closeAll("loading");
				break;
			case 4:
				f || (t.content = [t.content, "body"]), t.follow = t.content[1], t.content = t.content[0] + '<i class="layui-layer-TipsG"></i>', delete t.title, t.tips = "object" == typeof t.tips ? t.tips : [t.tips, !0], t.tipsMore || r.closeAll("tips")
			}
			if (e.vessel(f, function(n, r, u) {
				c.append(n[0]), f ?
				function() {
					2 == t.type || 4 == t.type ?
					function() {
						i("body").append(n[1])
					}() : function() {
						s.parents("." + l[0])[0] || (s.data("display", s.css("display")).show().addClass("layui-layer-wrap").wrap(n[1]), i("#" + l[0] + a).find("." + l[5]).before(r))
					}()
				}() : c.append(n[1]), i(".layui-layer-move")[0] || c.append(o.moveElem = u), e.layero = i("#" + l[0] + a), t.scrollbar || l.html.css("overflow", "hidden").attr("layer-full", a)
			}).auto(a), i("#layui-layer-shade" + e.index).css({
				"background-color": t.shade[1] || "#000",
				opacity: t.shade[0] || t.shade
			}), 2 == t.type && 6 == r.ie && e.layero.find("iframe").attr("src", s[0]), 4 == t.type ? e.tips() : e.offset(), t.fixed && n.on("resize", function() {
				e.offset(), (/^\d+%$/.test(t.area[0]) || /^\d+%$/.test(t.area[1])) && e.auto(a), 4 == t.type && e.tips()
			}), t.time <= 0 || setTimeout(function() {
				r.close(e.index)
			}, t.time), e.move().callback(), l.anim[t.anim]) {
				var u = "layer-anim " + l.anim[t.anim];
				e.layero.addClass(u).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
					i(this).removeClass(u)
				})
			}
			t.isOutAnim && e.layero.data("isOutAnim", !0)
		}
	}, s.pt.auto = function(e) {
		var t = this,
			a = t.config,
			o = i("#" + l[0] + e);
		"" === a.area[0] && a.maxWidth > 0 && (r.ie && r.ie < 8 && a.btn && o.width(o.innerWidth()), o.outerWidth() > a.maxWidth && o.width(a.maxWidth));
		var s = [o.innerWidth(), o.innerHeight()],
			f = o.find(l[1]).outerHeight() || 0,
			c = o.find("." + l[6]).outerHeight() || 0,
			u = function(e) {
				e = o.find(e), e.height(s[1] - f - c - 2 * (0 | parseFloat(e.css("padding-top"))))
			};
		switch (a.type) {
		case 2:
			u("iframe");
			break;
		default:
			"" === a.area[1] ? a.maxHeight > 0 && o.outerHeight() > a.maxHeight ? (s[1] = a.maxHeight, u("." + l[5])) : a.fixed && s[1] >= n.height() && (s[1] = n.height(), u("." + l[5])) : u("." + l[5])
		}
		return t
	}, s.pt.offset = function() {
		var e = this,
			t = e.config,
			i = e.layero,
			a = [i.outerWidth(), i.outerHeight()],
			o = "object" == typeof t.offset;
		e.offsetTop = (n.height() - a[1]) / 2, e.offsetLeft = (n.width() - a[0]) / 2, o ? (e.offsetTop = t.offset[0], e.offsetLeft = t.offset[1] || e.offsetLeft) : "auto" !== t.offset && ("t" === t.offset ? e.offsetTop = 0 : "r" === t.offset ? e.offsetLeft = n.width() - a[0] : "b" === t.offset ? e.offsetTop = n.height() - a[1] : "l" === t.offset ? e.offsetLeft = 0 : "lt" === t.offset ? (e.offsetTop = 0, e.offsetLeft = 0) : "lb" === t.offset ? (e.offsetTop = n.height() - a[1], e.offsetLeft = 0) : "rt" === t.offset ? (e.offsetTop = 0, e.offsetLeft = n.width() - a[0]) : "rb" === t.offset ? (e.offsetTop = n.height() - a[1], e.offsetLeft = n.width() - a[0]) : e.offsetTop = t.offset), t.fixed || (e.offsetTop = /%$/.test(e.offsetTop) ? n.height() * parseFloat(e.offsetTop) / 100 : parseFloat(e.offsetTop), e.offsetLeft = /%$/.test(e.offsetLeft) ? n.width() * parseFloat(e.offsetLeft) / 100 : parseFloat(e.offsetLeft), e.offsetTop += n.scrollTop(), e.offsetLeft += n.scrollLeft()), i.attr("minLeft") && (e.offsetTop = n.height() - (i.find(l[1]).outerHeight() || 0), e.offsetLeft = i.css("left")), i.css({
			top: e.offsetTop,
			left: e.offsetLeft
		})
	}, s.pt.tips = function() {
		var e = this,
			t = e.config,
			a = e.layero,
			o = [a.outerWidth(), a.outerHeight()],
			r = i(t.follow);
		r[0] || (r = i("body"));
		var s = {
			width: r.outerWidth(),
			height: r.outerHeight(),
			top: r.offset().top,
			left: r.offset().left
		},
			f = a.find(".layui-layer-TipsG"),
			c = t.tips[0];
		t.tips[1] || f.remove(), s.autoLeft = function() {
			s.left + o[0] - n.width() > 0 ? (s.tipLeft = s.left + s.width - o[0], f.css({
				right: 12,
				left: "auto"
			})) : s.tipLeft = s.left
		}, s.where = [function() {
			s.autoLeft(), s.tipTop = s.top - o[1] - 10, f.removeClass("layui-layer-TipsB").addClass("layui-layer-TipsT").css("border-right-color", t.tips[1])
		}, function() {
			s.tipLeft = s.left + s.width + 10, s.tipTop = s.top, f.removeClass("layui-layer-TipsL").addClass("layui-layer-TipsR").css("border-bottom-color", t.tips[1])
		}, function() {
			s.autoLeft(), s.tipTop = s.top + s.height + 10, f.removeClass("layui-layer-TipsT").addClass("layui-layer-TipsB").css("border-right-color", t.tips[1])
		}, function() {
			s.tipLeft = s.left - o[0] - 10, s.tipTop = s.top, f.removeClass("layui-layer-TipsR").addClass("layui-layer-TipsL").css("border-bottom-color", t.tips[1])
		}], s.where[c - 1](), 1 === c ? s.top - (n.scrollTop() + o[1] + 16) < 0 && s.where[2]() : 2 === c ? n.width() - (s.left + s.width + o[0] + 16) > 0 || s.where[3]() : 3 === c ? s.top - n.scrollTop() + s.height + o[1] + 16 - n.height() > 0 && s.where[0]() : 4 === c && o[0] + 16 - s.left > 0 && s.where[1](), a.find("." + l[5]).css({
			"background-color": t.tips[1],
			"padding-right": t.closeBtn ? "30px" : ""
		}), a.css({
			left: s.tipLeft - (t.fixed ? n.scrollLeft() : 0),
			top: s.tipTop - (t.fixed ? n.scrollTop() : 0)
		})
	}, s.pt.move = function() {
		var e = this,
			t = e.config,
			a = i(document),
			s = e.layero,
			l = s.find(t.move),
			f = s.find(".layui-layer-resize"),
			c = {};
		return t.move && l.css("cursor", "move"), l.on("mousedown", function(e) {
			e.preventDefault(), t.move && (c.moveStart = !0, c.offset = [e.clientX - parseFloat(s.css("left")), e.clientY - parseFloat(s.css("top"))], o.moveElem.css("cursor", "move").show())
		}), f.on("mousedown", function(e) {
			e.preventDefault(), c.resizeStart = !0, c.offset = [e.clientX, e.clientY], c.area = [s.outerWidth(), s.outerHeight()], o.moveElem.css("cursor", "se-resize").show()
		}), a.on("mousemove", function(i) {
			if (c.moveStart) {
				var a = i.clientX - c.offset[0],
					o = i.clientY - c.offset[1],
					l = "fixed" === s.css("position");
				if (i.preventDefault(), c.stX = l ? 0 : n.scrollLeft(), c.stY = l ? 0 : n.scrollTop(), !t.moveOut) {
					var f = n.width() - s.outerWidth() + c.stX,
						u = n.height() - s.outerHeight() + c.stY;
					a < c.stX && (a = c.stX), a > f && (a = f), o < c.stY && (o = c.stY), o > u && (o = u)
				}
				s.css({
					left: a,
					top: o
				})
			}
			if (t.resize && c.resizeStart) {
				var a = i.clientX - c.offset[0],
					o = i.clientY - c.offset[1];
				i.preventDefault(), r.style(e.index, {
					width: c.area[0] + a,
					height: c.area[1] + o
				}), c.isResize = !0, t.resizing && t.resizing(s)
			}
		}).on("mouseup", function(e) {
			c.moveStart && (delete c.moveStart, o.moveElem.hide(), t.moveEnd && t.moveEnd(s)), c.resizeStart && (delete c.resizeStart, o.moveElem.hide())
		}), e
	}, s.pt.callback = function() {
		function e() {
			var e = a.cancel && a.cancel(t.index, n);
			e === !1 || r.close(t.index)
		}
		var t = this,
			n = t.layero,
			a = t.config;
		t.openLayer(), a.success && (2 == a.type ? n.find("iframe").on("load", function() {
			a.success(n, t.index)
		}) : a.success(n, t.index)), 6 == r.ie && t.IE6(n), n.find("." + l[6]).children("a").on("click", function() {
			var e = i(this).index();
			if (0 === e) a.yes ? a.yes(t.index, n) : a.btn1 ? a.btn1(t.index, n) : r.close(t.index);
			else {
				var o = a["btn" + (e + 1)] && a["btn" + (e + 1)](t.index, n);
				o === !1 || r.close(t.index)
			}
		}), n.find("." + l[7]).on("click", e), a.shadeClose && i("#layui-layer-shade" + t.index).on("click", function() {
			r.close(t.index)
		}), n.find(".layui-layer-min").on("click", function() {
			var e = a.min && a.min(n);
			e === !1 || r.min(t.index, a)
		}), n.find(".layui-layer-max").on("click", function() {
			i(this).hasClass("layui-layer-maxmin") ? (r.restore(t.index), a.restore && a.restore(n)) : (r.full(t.index, a), setTimeout(function() {
				a.full && a.full(n)
			}, 100))
		}), a.end && (o.end[t.index] = a.end)
	}, o.reselect = function() {
		i.each(i("select"), function(e, t) {
			var n = i(this);
			n.parents("." + l[0])[0] || 1 == n.attr("layer") && i("." + l[0]).length < 1 && n.removeAttr("layer").show(), n = null
		})
	}, s.pt.IE6 = function(e) {
		i("select").each(function(e, t) {
			var n = i(this);
			n.parents("." + l[0])[0] || "none" === n.css("display") || n.attr({
				layer: "1"
			}).hide(), n = null
		})
	}, s.pt.openLayer = function() {
		var e = this;
		r.zIndex = e.config.zIndex, r.setTop = function(e) {
			var t = function() {
					r.zIndex++, e.css("z-index", r.zIndex + 1)
				};
			return r.zIndex = parseInt(e[0].style.zIndex), e.on("mousedown", t), r.zIndex
		}
	}, o.record = function(e) {
		var t = [e.width(), e.height(), e.position().top, e.position().left + parseFloat(e.css("margin-left"))];
		e.find(".layui-layer-max").addClass("layui-layer-maxmin"), e.attr({
			area: t
		})
	}, o.rescollbar = function(e) {
		l.html.attr("layer-full") == e && (l.html[0].style.removeProperty ? l.html[0].style.removeProperty("overflow") : l.html[0].style.removeAttribute("overflow"), l.html.removeAttr("layer-full"))
	}, e.layer = r, r.getChildFrame = function(e, t) {
		return t = t || i("." + l[4]).attr("times"), i("#" + l[0] + t).find("iframe").contents().find(e)
	}, r.getFrameIndex = function(e) {
		return i("#" + e).parents("." + l[4]).attr("times")
	}, r.iframeAuto = function(e) {
		if (e) {
			var t = r.getChildFrame("html", e).outerHeight(),
				n = i("#" + l[0] + e),
				a = n.find(l[1]).outerHeight() || 0,
				o = n.find("." + l[6]).outerHeight() || 0;
			n.css({
				height: t + a + o
			}), n.find("iframe").css({
				height: t
			})
		}
	}, r.iframeSrc = function(e, t) {
		i("#" + l[0] + e).find("iframe").attr("src", t)
	}, r.style = function(e, t, n) {
		var a = i("#" + l[0] + e),
			r = a.find(".layui-layer-content"),
			s = a.attr("type"),
			f = a.find(l[1]).outerHeight() || 0,
			c = a.find("." + l[6]).outerHeight() || 0;
		a.attr("minLeft");
		s !== o.type[3] && s !== o.type[4] && (n || (parseFloat(t.width) <= 260 && (t.width = 260), parseFloat(t.height) - f - c <= 64 && (t.height = 64 + f + c)), a.css(t), c = a.find("." + l[6]).outerHeight(), s === o.type[2] ? a.find("iframe").css({
			height: parseFloat(t.height) - f - c
		}) : r.css({
			height: parseFloat(t.height) - f - c - parseFloat(r.css("padding-top")) - parseFloat(r.css("padding-bottom"))
		}))
	}, r.min = function(e, t) {
		var a = i("#" + l[0] + e),
			s = a.find(l[1]).outerHeight() || 0,
			f = a.attr("minLeft") || 181 * o.minIndex + "px",
			c = a.css("position");
		o.record(a), o.minLeft[0] && (f = o.minLeft[0], o.minLeft.shift()), a.attr("position", c), r.style(e, {
			width: 180,
			height: s,
			left: f,
			top: n.height() - s,
			position: "fixed",
			overflow: "hidden"
		}, !0), a.find(".layui-layer-min").hide(), "page" === a.attr("type") && a.find(l[4]).hide(), o.rescollbar(e), a.attr("minLeft") || o.minIndex++, a.attr("minLeft", f)
	}, r.restore = function(e) {
		var t = i("#" + l[0] + e),
			n = t.attr("area").split(",");
		t.attr("type");
		r.style(e, {
			width: parseFloat(n[0]),
			height: parseFloat(n[1]),
			top: parseFloat(n[2]),
			left: parseFloat(n[3]),
			position: t.attr("position"),
			overflow: "visible"
		}, !0), t.find(".layui-layer-max").removeClass("layui-layer-maxmin"), t.find(".layui-layer-min").show(), "page" === t.attr("type") && t.find(l[4]).show(), o.rescollbar(e)
	}, r.full = function(e) {
		var t, a = i("#" + l[0] + e);
		o.record(a), l.html.attr("layer-full") || l.html.css("overflow", "hidden").attr("layer-full", e), clearTimeout(t), t = setTimeout(function() {
			var t = "fixed" === a.css("position");
			r.style(e, {
				top: t ? 0 : n.scrollTop(),
				left: t ? 0 : n.scrollLeft(),
				width: n.width(),
				height: n.height()
			}, !0), a.find(".layui-layer-min").hide()
		}, 100)
	}, r.title = function(e, t) {
		var n = i("#" + l[0] + (t || r.index)).find(l[1]);
		n.html(e)
	}, r.close = function(e) {
		var t = i("#" + l[0] + e),
			n = t.attr("type"),
			a = "layer-anim-close";
		if (t[0]) {
			var s = "layui-layer-wrap",
				f = function() {
					if (n === o.type[1] && "object" === t.attr("conType")) {
						t.children(":not(." + l[5] + ")").remove();
						for (var a = t.find("." + s), r = 0; r < 2; r++) a.unwrap();
						a.css("display", a.data("display")).removeClass(s)
					} else {
						if (n === o.type[2]) try {
							var f = i("#" + l[4] + e)[0];
							f.contentWindow.document.write(""), f.contentWindow.close(), t.find("." + l[5])[0].removeChild(f)
						} catch (c) {}
						t[0].innerHTML = "", t.remove()
					}
					"function" == typeof o.end[e] && o.end[e](), delete o.end[e]
				};
			t.data("isOutAnim") && t.addClass("layer-anim " + a), i("#layui-layer-moves, #layui-layer-shade" + e).remove(), 6 == r.ie && o.reselect(), o.rescollbar(e), t.attr("minLeft") && (o.minIndex--, o.minLeft.push(t.attr("minLeft"))), r.ie && r.ie < 10 || !t.data("isOutAnim") ? f() : setTimeout(function() {
				f()
			}, 200)
		}
	}, r.closeAll = function(e) {
		i.each(i("." + l[0]), function() {
			var t = i(this),
				n = e ? t.attr("type") === e : 1;
			n && r.close(t.attr("times")), n = null
		})
	};
	var f = r.cache || {},
		c = function(e) {
			return f.skin ? " " + f.skin + " " + f.skin + "-" + e : ""
		};
	r.prompt = function(e, t) {
		var a = "";
		if (e = e || {}, "function" == typeof e && (t = e), e.area) {
			var o = e.area;
			a = 'style="width: ' + o[0] + "; height: " + o[1] + ';"', delete e.area
		}
		var s, l = 2 == e.formType ? '<textarea class="layui-layer-input"' + a + ">" + (e.value || "") + "</textarea>" : function() {
				return '<input type="' + (1 == e.formType ? "password" : "text") + '" class="layui-layer-input" value="' + (e.value || "") + '">'
			}(),
			f = e.success;
		return delete e.success, r.open(i.extend({
			type: 1,
			btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
			content: l,
			skin: "layui-layer-prompt" + c("prompt"),
			maxWidth: n.width(),
			success: function(e) {
				s = e.find(".layui-layer-input"), s.focus(), "function" == typeof f && f(e)
			},
			resize: !1,
			yes: function(i) {
				var n = s.val();
				"" === n ? s.focus() : n.length > (e.maxlength || 500) ? r.tips("&#x6700;&#x591A;&#x8F93;&#x5165;" + (e.maxlength || 500) + "&#x4E2A;&#x5B57;&#x6570;", s, {
					tips: 1
				}) : t && t(n, i, s)
			}
		}, e))
	}, r.tab = function(e) {
		e = e || {};
		var t = e.tab || {},
			n = "layui-this",
			a = e.success;
		return delete e.success, r.open(i.extend({
			type: 1,
			skin: "layui-layer-tab" + c("tab"),
			resize: !1,
			title: function() {
				var e = t.length,
					i = 1,
					a = "";
				if (e > 0) for (a = '<span class="' + n + '">' + t[0].title + "</span>"; i < e; i++) a += "<span>" + t[i].title + "</span>";
				return a
			}(),
			content: '<ul class="layui-layer-tabmain">' +
			function() {
				var e = t.length,
					i = 1,
					a = "";
				if (e > 0) for (a = '<li class="layui-layer-tabli ' + n + '">' + (t[0].content || "no content") + "</li>"; i < e; i++) a += '<li class="layui-layer-tabli">' + (t[i].content || "no  content") + "</li>";
				return a
			}() + "</ul>",
			success: function(t) {
				var o = t.find(".layui-layer-title").children(),
					r = t.find(".layui-layer-tabmain").children();
				o.on("mousedown", function(t) {
					t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0;
					var a = i(this),
						o = a.index();
					a.addClass(n).siblings().removeClass(n), r.eq(o).show().siblings().hide(), "function" == typeof e.change && e.change(o)
				}), "function" == typeof a && a(t)
			}
		}, e))
	}, r.photos = function(t, n, a) {
		function o(e, t, i) {
			var n = new Image;
			return n.src = e, n.complete ? t(n) : (n.onload = function() {
				n.onload = null, t(n)
			}, void(n.onerror = function(e) {
				n.onerror = null, i(e)
			}))
		}
		var s = {};
		if (t = t || {}, t.photos) {
			var l = t.photos.constructor === Object,
				f = l ? t.photos : {},
				u = f.data || [],
				d = f.start || 0;
			s.imgIndex = (0 | d) + 1, t.img = t.img || "img";
			var y = t.success;
			if (delete t.success, l) {
				if (0 === u.length) return r.msg("&#x6CA1;&#x6709;&#x56FE;&#x7247;")
			} else {
				var p = i(t.photos),
					h = function() {
						u = [], p.find(t.img).each(function(e) {
							var t = i(this);
							t.attr("layer-index", e), u.push({
								alt: t.attr("alt"),
								pid: t.attr("layer-pid"),
								src: t.attr("layer-src") || t.attr("src"),
								thumb: t.attr("src")
							})
						})
					};
				if (h(), 0 === u.length) return;
				if (n || p.on("click", t.img, function() {
					var e = i(this),
						n = e.attr("layer-index");
					r.photos(i.extend(t, {
						photos: {
							start: n,
							data: u,
							tab: t.tab
						},
						full: t.full
					}), !0), h()
				}), !n) return
			}
			s.imgprev = function(e) {
				s.imgIndex--, s.imgIndex < 1 && (s.imgIndex = u.length), s.tabimg(e)
			}, s.imgnext = function(e, t) {
				s.imgIndex++, s.imgIndex > u.length && (s.imgIndex = 1, t) || s.tabimg(e)
			}, s.keyup = function(e) {
				if (!s.end) {
					var t = e.keyCode;
					e.preventDefault(), 37 === t ? s.imgprev(!0) : 39 === t ? s.imgnext(!0) : 27 === t && r.close(s.index)
				}
			}, s.tabimg = function(e) {
				if (!(u.length <= 1)) return f.start = s.imgIndex - 1, r.close(s.index), r.photos(t, !0, e)
			}, s.event = function() {
				s.bigimg.hover(function() {
					s.imgsee.show()
				}, function() {
					s.imgsee.hide()
				}), s.bigimg.find(".layui-layer-imgprev").on("click", function(e) {
					e.preventDefault(), s.imgprev()
				}), s.bigimg.find(".layui-layer-imgnext").on("click", function(e) {
					e.preventDefault(), s.imgnext()
				}), i(document).on("keyup", s.keyup)
			}, s.loadi = r.load(1, {
				shade: !("shade" in t) && .9,
				scrollbar: !1
			}), o(u[d].src, function(n) {
				r.close(s.loadi), s.index = r.open(i.extend({
					type: 1,
					id: "layui-layer-photos",
					area: function() {
						var a = [n.width, n.height],
							o = [i(e).width() - 100, i(e).height() - 100];
						if (!t.full && (a[0] > o[0] || a[1] > o[1])) {
							var r = [a[0] / o[0], a[1] / o[1]];
							r[0] > r[1] ? (a[0] = a[0] / r[0], a[1] = a[1] / r[0]) : r[0] < r[1] && (a[0] = a[0] / r[1], a[1] = a[1] / r[1])
						}
						return [a[0] + "px", a[1] + "px"]
					}(),
					title: !1,
					shade: .9,
					shadeClose: !0,
					closeBtn: !1,
					move: ".layui-layer-phimg img",
					moveType: 1,
					scrollbar: !1,
					moveOut: !0,
					isOutAnim: !1,
					skin: "layui-layer-photos" + c("photos"),
					content: '<div class="layui-layer-phimg"><img src="' + u[d].src + '" alt="' + (u[d].alt || "") + '" layer-pid="' + u[d].pid + '"><div class="layui-layer-imgsee">' + (u.length > 1 ? '<span class="layui-layer-imguide"><a href="javascript:;" class="layui-layer-iconext layui-layer-imgprev"></a><a href="javascript:;" class="layui-layer-iconext layui-layer-imgnext"></a></span>' : "") + '<div class="layui-layer-imgbar" style="display:' + (a ? "block" : "") + '"><span class="layui-layer-imgtit"><a href="javascript:;">' + (u[d].alt || "") + "</a><em>" + s.imgIndex + "/" + u.length + "</em></span></div></div></div>",
					success: function(e, i) {
						s.bigimg = e.find(".layui-layer-phimg"), s.imgsee = e.find(".layui-layer-imguide,.layui-layer-imgbar"), s.event(e), t.tab && t.tab(u[d], e), "function" == typeof y && y(e)
					},
					end: function() {
						s.end = !0, i(document).off("keyup", s.keyup)
					}
				}, t))
			}, function() {
				r.close(s.loadi), r.msg("&#x5F53;&#x524D;&#x56FE;&#x7247;&#x5730;&#x5740;&#x5F02;&#x5E38;<br>&#x662F;&#x5426;&#x7EE7;&#x7EED;&#x67E5;&#x770B;&#x4E0B;&#x4E00;&#x5F20;&#xFF1F;", {
					time: 3e4,
					btn: ["&#x4E0B;&#x4E00;&#x5F20;", "&#x4E0D;&#x770B;&#x4E86;"],
					yes: function() {
						u.length > 1 && s.imgnext(!0, !0)
					}
				})
			})
		}
	}, o.run = function(t) {
		i = t, n = i(e), l.html = i("html"), r.open = function(e) {
			var t = new s(e);
			return t.index
		}
	}, e.layui && layui.define ? (r.ready(), layui.define("jquery", function(t) {
		r.path = layui.cache.dir, o.run(layui.$), e.layer = r, t("layer", r)
	})) : "function" == typeof define && define.amd ? define(["jquery"], function() {
		return o.run(e.jQuery), r
	}) : function() {
		o.run(e.jQuery), r.ready()
	}()
}(window);; /* public.js | By thy6415.com */
$(document).ready(function() {
	$("#HeaderNav .parLi").each(function() {
		var me = $(this),
			ol = $(this).find(".sons");
		if (ol.length > 0) {
			$(this).hover(function() {
				me.addClass("hover");
				ol.stop(true, true).show().slideDown();
			}, function() {
				me.removeClass("hover");
				ol.stop(true, true).hide().slideUp();
			})
		}
	});
	J_SideBar();
	$(window).on('resize', function() {
		J_SideBar()
	});

	function J_SideBar() {
		var wrap = $(".SideBar"),
			mid = $(".mid", wrap);
		if (!wrap.hasClass("opened")) {
			wrap.animate({
				"right": "0"
			}).addClass("opened");
		}
		var difH = ($(window).outerHeight() - mid.outerHeight()) / 2;
	}
	listLoad();

	function listLoad() {
		var load = $("#PageLoad"),
			box = $("#PageLoadBox");
		if (load.length > 0 && box.length > 0) {
			if (currentpage < totalpage) {
				load.click(function() {
					$("span", load).html('数据载入中...');
					$.get(window.location.pathname + '?pageid=' + (currentpage + 1) + '&ajax=1', function(data) {
						box.append(data);
						currentpage = currentpage + 1;
						if (currentpage < totalpage) {
							$("span", load).html('点击加载更多');
						} else {
							$("span", load).html('亲，没有更多了');
						}
						if (typeof runCountDown === 'function') {
							runCountDown();
						}
						if (typeof faqListRead === 'function') {
							faqListRead();
						}
					});
				});
			} else {
				$("span", load).html('亲，没有更多了');
			}
		}
	}
	$(".shadowLi li, .TeamList li").hover(function() {
		$(this).addClass("hover")
	}, function() {
		$(this).removeClass("hover")
	});
	$(".MoreTeam li").hover(function() {
		if (!$(this).hasClass("on")) {
			$(this).addClass("on").siblings().removeClass("on")
		}
	});
	$(".CaseInfo .hd li").hover(function() {
		var me = $(this),
			i = me.index();
		if (!me.hasClass("active")) {
			me.addClass("active").siblings("li").removeClass("active");
			$(".CaseInfo .bd .item").eq(i).addClass("active").siblings(".item").removeClass("active");
		}
	});
	$(".table input[type='text'],.table textarea").focus(function() {
		$(this).addClass("focus")
	}).blur(function() {
		$(this).removeClass("focus")
	}).hover(function() {
		$(this).addClass("hover")
	}, function() {
		$(this).removeClass("hover")
	});
	var usePlace = $(".usePlace"),
		usePlace2 = $(".usePlace2");
	if (usePlace.length > 0 || usePlace2.length > 0) {
		usePlaceFun(usePlace);
		usePlaceFun(usePlace2);
	}
	$("#area", usePlace).after('<span class="add_on">㎡</span>');
});

function faqListRead() {
	$(".FaqList .item").each(function() {
		var me = $(this),
			read = $(".read", me),
			txt = $(".txt", me),
			txtboxH = $(".txtbox", txt).outerHeight();
		if (txtboxH > 96) {
			read.show();
			read.unbind().on('click', function() {
				if (me.hasClass("hasOpen")) {
					$("span", read).text("阅读全文");
					txt.animate({
						height: "96px"
					});
					me.removeClass("hasOpen");
				} else {
					$("span", read).text("收起");
					txt.animate({
						height: txtboxH
					}).css({
						"maxHeight": "none"
					});
					me.addClass("hasOpen");
				}
			});
		}
	})
}

function faqListdefOpen(id) {
	var openId = $(".FaqList .defOpenItem");
	if (!openId.length) return false;
	var ofTop = openId.offset().top - 20;
	$("html,body").animate({
		scrollTop: ofTop
	}, 800);
	$(".read", openId).click();
}

function pub_submit(f, isvcode) {
	var formId = $("#" + f),
		isvcode = isvcode ? isvcode : 0,
		form = $("form", formId),
		imgcode = $("#imgcode", formId),
		btn = $("#_phpok_submit", formId),
		module_id = form.attr("action").split("&module_id=")[1],
		module_id = module_id.split("&")[0],
		successTxt = $("#tomsg", formId).val();
	if (btn.hasClass("disabled")) {
		layerAlert('您已经提交过了，感谢您的支持！', 6, 4000);
		return false;
	}
	var contact = formId.find("#contact");
	if (!contact.val() && contact.length) {
		layerTips('请输入您的称呼', contact);
		contact.focus();
		return false;
	}
	var phone = formId.find("#phone");
	if (!(/^1[2-9]\d{9}$/.test(phone.val())) && phone.length) {
		layerTips('手机号码未填写或填写错误', phone);
		phone.focus();
		return false;
	}
	if (module_id == '133') {
		var content = formId.find("#faq");
		if (!content.val() && content.length) {
			layerTips('请输入您留言内容，我们会尽快予以回复', content);
			content.focus();
			return false;
		}
	}
	if (isvcode == '0') {
		var check = formId.find("#sys_check");
		if (!check.val()) {
			layerTips('请输入验证码', check);
			check.focus();
			return false;
		}
		$.get("?c=post&f=ajax_checkcode&sys_check=" + check.val(), function(data) {
			if (data != "success") {
				imgcode.attr("src", get_url("login,codes") + 'rand=' + Math.random());
				layerTips('验证码有误！请重新填写', check);
				check.val('');
				check.focus();
				return false;
			} else {
				$.post(form.attr("action"), form.serialize(), function(data2) {
					layer.closeAll();
					layer.confirm(successTxt, {
						title: '提交成功',
						btn: ['知道了'],
						icon: 1
					});
					imgcode.attr("src", get_url("login,codes") + 'rand=' + Math.random());
					check.val('');
					btn.addClass("disabled");
				});
			}
		});
	} else {
		$.post(form.attr("action"), form.serialize(), function(data2) {
			layer.closeAll();
			layer.confirm(successTxt, {
				title: '提交成功',
				btn: ['知道了'],
				icon: 1
			});
			btn.addClass("disabled");
		});
	}
	return false;
}

function J_ajaxOrderWin(tit, url) {
	$.post(url, function(str) {
		layer.open({
			type: 1,
			title: tit ? tit : '我要预约',
			content: str,
			area: '410px',
			success: function(layero, index) {
				usePlaceFun($(".usePlace"));
			}
		});
	}).error(function() {
		layer.msg('地址错误！', {
			offset: 't'
		})
	});
}

function usePlaceFun(id) {
	$.getScript("tpl/www/images/js/jquery.placeholder.js", function() {
		id.placeholder();
		id.find("input[type='text'],textarea").each(function() {
			var clue_on = $(this).closest(".table").find(".clue_on");
			var ntxt = clue_on.text().replace(/\s/g, "");
			$(this).attr('placeholder', ntxt);
		}).placeholder();
	});
}

function openWin(page) {
	if (!page) {
		return false;
	}
	var pageurl = (page == 'kefu') ? _pubKefu : page;
	window.open(pageurl, "news", "width=600,height=600,scrollbars=1,toolbar=0,Top=50,Left=60,resizable=0");
	return;
}

function openWeixin() {
	var wx = $(".fixedWx");
	wx.addClass("show");
	wx.click(function() {
		wx.removeClass("show")
	});
	return;
}

function layerAlert(ct, icon, time) {
	var icon = icon ? icon : '2',
		time = time ? time : '1000';
	layer.msg(ct, {
		icon: icon,
		shade: .3,
		time: time
	});
}

function layerTips(ct, id) {
	layer.tips(ct, id, {
		tips: [1, '#E60012'],
		time: 2000
	});
	id.focus();
}

function backTop() {
	$('html,body').animate({
		scrollTop: '0px'
	}, 800);
	return;
}