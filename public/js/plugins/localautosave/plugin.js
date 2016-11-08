/**
 * LAS - Local Auto Save Plugin
 * localautosave/plugin.min.js
 *
 * Released under The MIT License (MIT)
 *
 * License: https://github.com/valtlfelipe/TinyMCE-LocalAutoSave/blob/master/LICENSE.md
 * Plugin info: http://valtlfelipe.github.io/TinyMCE-LocalAutoSave/
 * Author: Felipe Valtl de Mello
 *
 * Version: 0.4.5 released 02/05/2016
 *
 *
 * Modified by Diego Valerio Camarda
 * https://github.com/dvcama/TinyMCE-LocalAutoSave
 *
 */

tinymce.PluginManager.requireLangPack('localautosave');
tinymce.PluginManager.add("localautosave", function(editor, url) {

	/**
	 * ########################################
	 *     Plugin Variables
	 * ########################################
	 */
	var $form = $(editor.formElement);

	var $useLocalStorage = false;

	var $useSessionStorage = false;

	var $editorID = editor.id;

	var $busy = false;

	var $storage = localStorage;

	var $lastKey = null;

	var cookieEncodeKey = {
		"%" : "%1",
		"&" : "%2",
		";" : "%3",
		"=" : "%4",
		"<" : "%5"
	};
	var cookieDecodeKey = {
		"%1" : "%",
		"%2" : "&",
		"%3" : ";",
		"%4" : "=",
		"%5" : "<"
	};
	var settings = {
		seconds : editor.getParam('las_seconds') || 6,
		keyName : editor.getParam('las_keyName') || 'LocalAutoSave',
		callback : editor.getParam('las_callback'),
		/* las_nVersions number of versions of the text we want to store */
		versions : editor.getParam('las_nVersions') || 15
	};
	var cookieFilter = new RegExp("(?:^|;\\s*)" + settings.keyName + $editorID + "=([^;]*)(?:;|$)", "i");

	setStyle();
	/**
	 * ########################################
	 *     Verify which save method
	 *     the browser supports
	 * ########################################
	 */
	try {
		$storage.setItem('LASTest', "OK");
		if ($storage.getItem('LASTest') === "OK") {
			$storage.removeItem('LASTest');
			$useLocalStorage = true;
		}
	} catch (error) {

		try {
			$storage = sessionStorage;
			$storage.setItem('LASTest', "OK");

			if ($storage.getItem('LASTest') === "OK") {
				$storage.removeItem('LASTest');
				$useSessionStorage = true;
			}
		} catch (error) {
			$storage = null;
		}
	}

	/**
	 * ########################################
	 *     Create Restore Button
	 * ########################################
	 */
	var button = editor.addButton("localautosave", {
		text : "",
		icon : 'restoredraft',
		tooltip : 'localautosave.restoreContent',
		onclick : function() {
			save();
			while (!$busy) {
				restore();
			}

		}
	});

	/**
	 * ########################################
	 *     Encodes special characters to
	 *     save in browsers cookie
	 * ########################################
	 */
	function encodeCookie(str) {
		return str.replace(/[\x00-\x1f]+|&nbsp;|&#160;/gi, " ").replace(/(.)\1{5,}|[%&;=<]/g, function(c) {
			if (c.length > 1) {
				return ("%0" + c.charAt(0) + c.length.toString() + "%");
			}
			return cookieEncodeKey[c];
		});
	}

	/**
	 * ########################################
	 *     Decode special characters from
	 *     browsers cookie to display in editor
	 * ########################################
	 */
	function decodeCookie(str) {
		return str.replace(/%[1-5]|%0(.)(\d+)%/g, function(c, m, d) {
			var a, i, l;

			if (c.length == 2) {
				return cookieDecodeKey[c];
			}

			for ( a = [], i = 0, l = parseInt(d); i < l; i++) {
				a.push(m);
			}

			return a.join("");
		});
	}

	/**
	 * ########################################
	 *     Encodes special characters to
	 *     save in browsers Storage
	 * ########################################
	 */
	function encodeStorage(str) {
		return str.replace(/,/g, "&#44;");
	}

	/**
	 * ########################################
	 *     Decode special characters from
	 *     browsers storage to display in editor
	 * ########################################
	 */
	function decodeStorage(str) {
		return str.replace(/&#44;/g, ",");
	}

	/**
	 * ########################################
	 *     List contents available for an area
	 * ########################################
	 */
	function list() {
		var contents = [];
		if ($storage) {
			for (var i = 0, j = $storage.length; i < j; i++) {
				var key = $storage.key([i]);
				if (key.indexOf(settings.keyName + $editorID) == 0) {
					contents.push($storage.getItem(key));
				}
			};
		} else {
			//TODO: "manage cookie mode"
		}
		contents.sort();
		return contents.reverse();
	}

	/**

	 * ########################################
	 *     List keys available for an area
	 * ########################################
	 */
	function listKeys(excedingQuota) {
		var keys = [];
		if ($storage) {
			for (var i = 0, j = $storage.length; i < j; i++) {
				var key = $storage.key([i]);
				if (key.indexOf(settings.keyName + $editorID) == 0) {
					keys.push(key);
				}
			};
		} else {
			//TODO: "manage cookie mode"
		}
		keys.sort(function(a, b) {
			return $storage.getItem(a) > $storage.getItem(b);
		});
		keys.reverse();
		if (excedingQuota > 0) {
			/* return only keys that are exceeding the quota (las_nVersions)*/
			var tmpKeys = keys;
			keys = [];
			if (excedingQuota < tmpKeys.length) {
				for (var i = excedingQuota, j = tmpKeys.length; i < j; i++) {
					keys.push(tmpKeys[i]);
				};
			}
		}
		return keys;
	}

	/**
	 * ########################################
	 *     remove contents in array
	 * ########################################
	 */
	function clearAll(keys) {
		if ($storage) {
			for (var i = 0, j = keys.length; i < j; i++) {
				$storage.removeItem(keys[i]);
			};
		} else {
			//TODO: "manage cookie mode"
		}
	}

	/**
	 * ########################################
	 *     get formated date for restore
	 * ########################################
	 */
	function getFormatedDate(date) {
		var yyyy = now.getFullYear(),
			mm = (now.getMonth()+1),
			dd = now.getDate(),
			hh = now.getHours(),
			min = now.getMinutes(),
			ss = now.getSeconds();

		if(mm < 10) {
			mm = "0"+mm;
		}
		if(dd < 10) {
			dd = "0"+dd;
		}
		if(hh < 10) {
			hh = "0"+hh;
		}
		if(min < 10) {
			min = "0"+min;
		}
		if(ss < 10) {
			ss = "0"+ss;
		}

		return yyyy+"-"+mm+"-"+dd+" "+hh+":"+min+":"+ss;
	}

	/**
	 * ########################################
	 *     Save content action
	 * ########################################
	 */
	var save = function() {
		if (!$busy && editor.isDirty()) {
			$busy = true;
			content = editor.getContent();
			is = editor.editorManager.is;
			var saved = false;
			if (is(content, "string") && (content.length > 0)) {
				now = new Date();
				exp = new Date(now.getTime() + (20 * 60 * 1000));
				var key = settings.keyName + $editorID;
				if (settings.versions > 0) {
					key = key + md5(content);
				}
				if (settings.versions === 0 || $lastKey != key) {
					try {
						if ($storage) {
							if (!$storage.getItem(key)) {
								$storage.setItem(key, getFormatedDate(now) + "," + encodeStorage(content));
							}
						} else {
							/*TODO: manage cookie mode*/
							a = key + "=";
							b = "; expires=" + exp.toUTCString();
							document.cookie = a + encodeCookie(content).slice(0, 4096 - a.length - b.length) + b;
						}
						saved = true;
					} catch (error) {
						console.error(error);
					}

					if (saved) {
						obj = new Object();
						obj.content = content;
						obj.time = now.getTime();
						if (settings.callback) {
							settings.callback.call(obj);
						}
						var btn = getButtonByName('localautosave');
						//$(btn).find('i').replaceWith('<i class="mce-ico mce-i-none" style="background: url(\'' + url + '/img/progress.gif\') no-repeat;"></i>');
						$(btn).find('i').addClass('las-spin');
						var t = setTimeout(function() {
							$(btn).find('i').removeClass('las-spin');
						}, 2000);
					}
				}
				if (saved) {
					$lastKey = key;
				}
				if (settings.versions > 0) {
					clearAll(listKeys(settings.versions));
				}

			}
		}

		$busy = false;
	};
	/**
	 * ########################################
	 *    Set save interval
	 * ########################################
	 */
	var interval = setInterval(save, settings.seconds * 1000);

	/**
	 * ########################################
	 *     Restore content action
	 * ########################################
	 */
	function restore() {
		var content = null, is = editor.editorManager.is;
		/* saving last version */
		if (editor.getContent().replace(/<\/?[a-z]+[^>]*>/gi, '').length > 0) {
			save();
		}
		$busy = true;
		try {
			if ($storage) {

				var contents = list();

				if (contents.length === 0) {
					editor.windowManager.alert('localautosave.noContent');
				} else {
					if (contents.length === 1 && editor.getContent().replace(/\s|&nbsp;|<\/?p[^>]*>|<br[^>]*>/gi, "").length === 0) {
						editor.setContent(decodeStorage(contents[0].substring(contents[0].indexOf(",") + 1)));
						$busy = false;
					} else {
						var divContent = "<div class='localautosave_cnt' id=\"" + $editorID + "-popup-localautosave\"><ul id='localautosave_list'>";
						for (var i = 0, j = contents.length; i < j; i++) {
							var aContent = decodeStorage(contents[i].substring(contents[i].indexOf(",") + 1));
							var aKey = contents[i].substring(0, contents[i].indexOf(","));
							divContent += "<li class='clearfix'><label>" + aKey + "</label> <tt>(" + aContent.replace(/<\/?[a-z]+[^>]*>/gi, '').length + " " + tinymce.translate('localautosave.chars') + ")</tt><span>" + aContent + "</span></li>";
						};
						divContent += "</ul></div>";
						editor.windowManager.open({
							width : 380,
							height : 240,
							scrollbars : true,
							title : 'localautosave.chooseVersion',
							html : divContent,
							buttons : [{
								text : 'localautosave.clearAll',
								onclick : function() {
									clearAll(listKeys());
									tinyMCE.activeEditor.windowManager.close();
								}
							}, {
								text : 'Cancel',
								onclick : 'close'
							}]
						});
						var choose = $("#" + $editorID + "-popup-localautosave").find('li');
						$('.localautosave_cnt:first').height($('.localautosave_cnt:first').parent().height() - 40);
						choose.click(function() {
							tinyMCE.activeEditor.setContent($(this).children('span').html());
							tinyMCE.activeEditor.windowManager.close();
						});
					}
				}
			} else {
				/* TODO: manage cookie mode*/
				m = cookieFilter.exec(document.cookie);
				if (m) {
					content = decodeCookie(m[1]);
				}

			}
		} catch (error) {
			console.error(error);
			$busy = false;
		}
	}

	/**
	 * ########################################
	 *     Get DOM for an toolbar button
	 * ########################################
	 */
	function getButtonByName(name, getEl) {
		var ed = editor, buttons = ed.buttons, toolbarObj = ed.theme.panel.find('toolbar *'), un = 'undefined';

		if ( typeof buttons[name] === un)
			return false;

		var settings = buttons[name], result = false, length = 0;

		tinymce.each(settings, function(v, k) {
			if(k == 'icon' || k == 'text' || k == 'tooltip' || k == 'type') {
				length++;
			}
		});

		tinymce.each(toolbarObj, function(v, k) {
			if (v.type != 'button' || typeof v.settings === un)
				return;

			var i = 0;

			tinymce.each(v.settings, function(v, k) {
				if ((k == 'icon' || k == 'text' || k == 'tooltip' || k == 'type') && settings[k] == v)
					i++;
			});

			if (i != length)
				return;

			result = v;

			if (getEl != false)
				result = v.getEl();

			return false;
		});

		return result;
	}

	function setStyle() {
		var style = ".mce-container .localautosave_cnt , .mce-container * .localautosave_cnt , .mce-widget .localautosave_cnt , .mce-widget * .localautosave_cnt {padding:20px;overflow: auto;} ";
		style += "#localautosave_list li {list-style:none;cursor:pointer;line-height:30px;border-bottom:1px solid #ddd;} ";
		style += "#localautosave_list li:hover {background-color:#ddd;} ";
		style += "#localautosave_list li span{display:none;} ";
		style += "#localautosave_list li tt{float:right;line-height: 30px;} ";
		style += "#localautosave_list li label{float:left;line-height: 30px;} ";
		style += "#localautosave_list .clearfix:before, #localautosave_list .clearfix:after { display: table; content: \" \"; } #localautosave_list .clearfix:after { clear: both; }";
		style += ".las-spin{-webkit-animation:las-spin 1s infinite linear;animation:las-spin 1s infinite linear;-webkit-animation-direction:reverse;animation-direction:reverse}@-webkit-keyframes las-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}@keyframes las-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}";
		$('head').append("<style type='text/css'>" + style + "</style>");
	}

	/**
	 * ########################################
	 *     	including md5 functions
	 * 		to handle diff. between versions
	 * 		http://www.myersdaily.org/joseph/javascript/md5-text.html
	 * ########################################
	 */

	function md5cycle(x, k) {
		var a = x[0], b = x[1], c = x[2], d = x[3];

		a = ff(a, b, c, d, k[0], 7, -680876936);
		d = ff(d, a, b, c, k[1], 12, -389564586);
		c = ff(c, d, a, b, k[2], 17, 606105819);
		b = ff(b, c, d, a, k[3], 22, -1044525330);
		a = ff(a, b, c, d, k[4], 7, -176418897);
		d = ff(d, a, b, c, k[5], 12, 1200080426);
		c = ff(c, d, a, b, k[6], 17, -1473231341);
		b = ff(b, c, d, a, k[7], 22, -45705983);
		a = ff(a, b, c, d, k[8], 7, 1770035416);
		d = ff(d, a, b, c, k[9], 12, -1958414417);
		c = ff(c, d, a, b, k[10], 17, -42063);
		b = ff(b, c, d, a, k[11], 22, -1990404162);
		a = ff(a, b, c, d, k[12], 7, 1804603682);
		d = ff(d, a, b, c, k[13], 12, -40341101);
		c = ff(c, d, a, b, k[14], 17, -1502002290);
		b = ff(b, c, d, a, k[15], 22, 1236535329);

		a = gg(a, b, c, d, k[1], 5, -165796510);
		d = gg(d, a, b, c, k[6], 9, -1069501632);
		c = gg(c, d, a, b, k[11], 14, 643717713);
		b = gg(b, c, d, a, k[0], 20, -373897302);
		a = gg(a, b, c, d, k[5], 5, -701558691);
		d = gg(d, a, b, c, k[10], 9, 38016083);
		c = gg(c, d, a, b, k[15], 14, -660478335);
		b = gg(b, c, d, a, k[4], 20, -405537848);
		a = gg(a, b, c, d, k[9], 5, 568446438);
		d = gg(d, a, b, c, k[14], 9, -1019803690);
		c = gg(c, d, a, b, k[3], 14, -187363961);
		b = gg(b, c, d, a, k[8], 20, 1163531501);
		a = gg(a, b, c, d, k[13], 5, -1444681467);
		d = gg(d, a, b, c, k[2], 9, -51403784);
		c = gg(c, d, a, b, k[7], 14, 1735328473);
		b = gg(b, c, d, a, k[12], 20, -1926607734);

		a = hh(a, b, c, d, k[5], 4, -378558);
		d = hh(d, a, b, c, k[8], 11, -2022574463);
		c = hh(c, d, a, b, k[11], 16, 1839030562);
		b = hh(b, c, d, a, k[14], 23, -35309556);
		a = hh(a, b, c, d, k[1], 4, -1530992060);
		d = hh(d, a, b, c, k[4], 11, 1272893353);
		c = hh(c, d, a, b, k[7], 16, -155497632);
		b = hh(b, c, d, a, k[10], 23, -1094730640);
		a = hh(a, b, c, d, k[13], 4, 681279174);
		d = hh(d, a, b, c, k[0], 11, -358537222);
		c = hh(c, d, a, b, k[3], 16, -722521979);
		b = hh(b, c, d, a, k[6], 23, 76029189);
		a = hh(a, b, c, d, k[9], 4, -640364487);
		d = hh(d, a, b, c, k[12], 11, -421815835);
		c = hh(c, d, a, b, k[15], 16, 530742520);
		b = hh(b, c, d, a, k[2], 23, -995338651);

		a = ii(a, b, c, d, k[0], 6, -198630844);
		d = ii(d, a, b, c, k[7], 10, 1126891415);
		c = ii(c, d, a, b, k[14], 15, -1416354905);
		b = ii(b, c, d, a, k[5], 21, -57434055);
		a = ii(a, b, c, d, k[12], 6, 1700485571);
		d = ii(d, a, b, c, k[3], 10, -1894986606);
		c = ii(c, d, a, b, k[10], 15, -1051523);
		b = ii(b, c, d, a, k[1], 21, -2054922799);
		a = ii(a, b, c, d, k[8], 6, 1873313359);
		d = ii(d, a, b, c, k[15], 10, -30611744);
		c = ii(c, d, a, b, k[6], 15, -1560198380);
		b = ii(b, c, d, a, k[13], 21, 1309151649);
		a = ii(a, b, c, d, k[4], 6, -145523070);
		d = ii(d, a, b, c, k[11], 10, -1120210379);
		c = ii(c, d, a, b, k[2], 15, 718787259);
		b = ii(b, c, d, a, k[9], 21, -343485551);

		x[0] = add32(a, x[0]);
		x[1] = add32(b, x[1]);
		x[2] = add32(c, x[2]);
		x[3] = add32(d, x[3]);

	}

	function cmn(q, a, b, x, s, t) {
		a = add32(add32(a, q), add32(x, t));
		return add32((a << s) | (a >>> (32 - s)), b);
	}

	function ff(a, b, c, d, x, s, t) {
		return cmn((b & c) | ((~b) & d), a, b, x, s, t);
	}

	function gg(a, b, c, d, x, s, t) {
		return cmn((b & d) | (c & (~d)), a, b, x, s, t);
	}

	function hh(a, b, c, d, x, s, t) {
		return cmn(b ^ c ^ d, a, b, x, s, t);
	}

	function ii(a, b, c, d, x, s, t) {
		return cmn(c ^ (b | (~d)), a, b, x, s, t);
	}

	function md51(s) {
		txt = '';
		var n = s.length, state = [1732584193, -271733879, -1732584194, 271733878], i;
		for ( i = 64; i <= s.length; i += 64) {
			md5cycle(state, md5blk(s.substring(i - 64, i)));
		}
		s = s.substring(i - 64);
		var tail = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		for ( i = 0; i < s.length; i++)
			tail[i >> 2] |= s.charCodeAt(i) << ((i % 4) << 3);
		tail[i >> 2] |= 0x80 << ((i % 4) << 3);
		if (i > 55) {
			md5cycle(state, tail);
			for ( i = 0; i < 16; i++)
				tail[i] = 0;
		}
		tail[14] = n * 8;
		md5cycle(state, tail);
		return state;
	}

	/* there needs to be support for Unicode here,
	 * unless we pretend that we can redefine the MD-5
	 * algorithm for multi-byte characters (perhaps
	 * by adding every four 16-bit characters and
	 * shortening the sum to 32 bits). Otherwise
	 * I suggest performing MD-5 as if every character
	 * was two bytes--e.g., 0040 0025 = @%--but then
	 * how will an ordinary MD-5 sum be matched?
	 * There is no way to standardize text to something
	 * like UTF-8 before transformation; speed cost is
	 * utterly prohibitive. The JavaScript standard
	 * itself needs to look at this: it should start
	 * providing access to strings as preformed UTF-8
	 * 8-bit unsigned value arrays.
	 */
	function md5blk(s) {/* I figured global was faster.   */
		var md5blks = [], i;
		/* Andy King said do it this way. */
		for ( i = 0; i < 64; i += 4) {
			md5blks[i >> 2] = s.charCodeAt(i) + (s.charCodeAt(i + 1) << 8) + (s.charCodeAt(i + 2) << 16) + (s.charCodeAt(i + 3) << 24);
		}
		return md5blks;
	}

	var hex_chr = '0123456789abcdef'.split('');

	function rhex(n) {
		var s = '', j = 0;
		for (; j < 4; j++)
			s += hex_chr[(n >> (j * 8 + 4)) & 0x0F] + hex_chr[(n >> (j * 8)) & 0x0F];
		return s;
	}

	function hex(x) {
		for (var i = 0; i < x.length; i++)
			x[i] = rhex(x[i]);
		return x.join('');
	}

	function md5(s) {
		return hex(md51(s));
	}

	/* this function is much faster,
	 so if possible we use it. Some IEs
	 are the only ones I know of that
	 need the idiotic second function,
	 generated by an if clause.  */

	function add32(a, b) {
		return (a + b) & 0xFFFFFFFF;
	}

	if (md5('hello') != '5d41402abc4b2a76b9719d911017c592') {
		function add32(x, y) {
			var lsw = (x & 0xFFFF) + (y & 0xFFFF), msw = (x >> 16) + (y >> 16) + (lsw >> 16);
			return (msw << 16) | (lsw & 0xFFFF);
		}

	}
	function md5cycle(x, k) {
		var a = x[0], b = x[1], c = x[2], d = x[3];

		a = ff(a, b, c, d, k[0], 7, -680876936);
		d = ff(d, a, b, c, k[1], 12, -389564586);
		c = ff(c, d, a, b, k[2], 17, 606105819);
		b = ff(b, c, d, a, k[3], 22, -1044525330);
		a = ff(a, b, c, d, k[4], 7, -176418897);
		d = ff(d, a, b, c, k[5], 12, 1200080426);
		c = ff(c, d, a, b, k[6], 17, -1473231341);
		b = ff(b, c, d, a, k[7], 22, -45705983);
		a = ff(a, b, c, d, k[8], 7, 1770035416);
		d = ff(d, a, b, c, k[9], 12, -1958414417);
		c = ff(c, d, a, b, k[10], 17, -42063);
		b = ff(b, c, d, a, k[11], 22, -1990404162);
		a = ff(a, b, c, d, k[12], 7, 1804603682);
		d = ff(d, a, b, c, k[13], 12, -40341101);
		c = ff(c, d, a, b, k[14], 17, -1502002290);
		b = ff(b, c, d, a, k[15], 22, 1236535329);

		a = gg(a, b, c, d, k[1], 5, -165796510);
		d = gg(d, a, b, c, k[6], 9, -1069501632);
		c = gg(c, d, a, b, k[11], 14, 643717713);
		b = gg(b, c, d, a, k[0], 20, -373897302);
		a = gg(a, b, c, d, k[5], 5, -701558691);
		d = gg(d, a, b, c, k[10], 9, 38016083);
		c = gg(c, d, a, b, k[15], 14, -660478335);
		b = gg(b, c, d, a, k[4], 20, -405537848);
		a = gg(a, b, c, d, k[9], 5, 568446438);
		d = gg(d, a, b, c, k[14], 9, -1019803690);
		c = gg(c, d, a, b, k[3], 14, -187363961);
		b = gg(b, c, d, a, k[8], 20, 1163531501);
		a = gg(a, b, c, d, k[13], 5, -1444681467);
		d = gg(d, a, b, c, k[2], 9, -51403784);
		c = gg(c, d, a, b, k[7], 14, 1735328473);
		b = gg(b, c, d, a, k[12], 20, -1926607734);

		a = hh(a, b, c, d, k[5], 4, -378558);
		d = hh(d, a, b, c, k[8], 11, -2022574463);
		c = hh(c, d, a, b, k[11], 16, 1839030562);
		b = hh(b, c, d, a, k[14], 23, -35309556);
		a = hh(a, b, c, d, k[1], 4, -1530992060);
		d = hh(d, a, b, c, k[4], 11, 1272893353);
		c = hh(c, d, a, b, k[7], 16, -155497632);
		b = hh(b, c, d, a, k[10], 23, -1094730640);
		a = hh(a, b, c, d, k[13], 4, 681279174);
		d = hh(d, a, b, c, k[0], 11, -358537222);
		c = hh(c, d, a, b, k[3], 16, -722521979);
		b = hh(b, c, d, a, k[6], 23, 76029189);
		a = hh(a, b, c, d, k[9], 4, -640364487);
		d = hh(d, a, b, c, k[12], 11, -421815835);
		c = hh(c, d, a, b, k[15], 16, 530742520);
		b = hh(b, c, d, a, k[2], 23, -995338651);

		a = ii(a, b, c, d, k[0], 6, -198630844);
		d = ii(d, a, b, c, k[7], 10, 1126891415);
		c = ii(c, d, a, b, k[14], 15, -1416354905);
		b = ii(b, c, d, a, k[5], 21, -57434055);
		a = ii(a, b, c, d, k[12], 6, 1700485571);
		d = ii(d, a, b, c, k[3], 10, -1894986606);
		c = ii(c, d, a, b, k[10], 15, -1051523);
		b = ii(b, c, d, a, k[1], 21, -2054922799);
		a = ii(a, b, c, d, k[8], 6, 1873313359);
		d = ii(d, a, b, c, k[15], 10, -30611744);
		c = ii(c, d, a, b, k[6], 15, -1560198380);
		b = ii(b, c, d, a, k[13], 21, 1309151649);
		a = ii(a, b, c, d, k[4], 6, -145523070);
		d = ii(d, a, b, c, k[11], 10, -1120210379);
		c = ii(c, d, a, b, k[2], 15, 718787259);
		b = ii(b, c, d, a, k[9], 21, -343485551);

		x[0] = add32(a, x[0]);
		x[1] = add32(b, x[1]);
		x[2] = add32(c, x[2]);
		x[3] = add32(d, x[3]);

	}

	function cmn(q, a, b, x, s, t) {
		a = add32(add32(a, q), add32(x, t));
		return add32((a << s) | (a >>> (32 - s)), b);
	}

	function ff(a, b, c, d, x, s, t) {
		return cmn((b & c) | ((~b) & d), a, b, x, s, t);
	}

	function gg(a, b, c, d, x, s, t) {
		return cmn((b & d) | (c & (~d)), a, b, x, s, t);
	}

	function hh(a, b, c, d, x, s, t) {
		return cmn(b ^ c ^ d, a, b, x, s, t);
	}

	function ii(a, b, c, d, x, s, t) {
		return cmn(c ^ (b | (~d)), a, b, x, s, t);
	}

	function md51(s) {
		txt = '';
		var n = s.length, state = [1732584193, -271733879, -1732584194, 271733878], i;
		for ( i = 64; i <= s.length; i += 64) {
			md5cycle(state, md5blk(s.substring(i - 64, i)));
		}
		s = s.substring(i - 64);
		var tail = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		for ( i = 0; i < s.length; i++)
			tail[i >> 2] |= s.charCodeAt(i) << ((i % 4) << 3);
		tail[i >> 2] |= 0x80 << ((i % 4) << 3);
		if (i > 55) {
			md5cycle(state, tail);
			for ( i = 0; i < 16; i++)
				tail[i] = 0;
		}
		tail[14] = n * 8;
		md5cycle(state, tail);
		return state;
	}

	/* there needs to be support for Unicode here,
	 * unless we pretend that we can redefine the MD-5
	 * algorithm for multi-byte characters (perhaps
	 * by adding every four 16-bit characters and
	 * shortening the sum to 32 bits). Otherwise
	 * I suggest performing MD-5 as if every character
	 * was two bytes--e.g., 0040 0025 = @%--but then
	 * how will an ordinary MD-5 sum be matched?
	 * There is no way to standardize text to something
	 * like UTF-8 before transformation; speed cost is
	 * utterly prohibitive. The JavaScript standard
	 * itself needs to look at this: it should start
	 * providing access to strings as preformed UTF-8
	 * 8-bit unsigned value arrays.
	 */
	function md5blk(s) {/* I figured global was faster.   */
		var md5blks = [], i;
		/* Andy King said do it this way. */
		for ( i = 0; i < 64; i += 4) {
			md5blks[i >> 2] = s.charCodeAt(i) + (s.charCodeAt(i + 1) << 8) + (s.charCodeAt(i + 2) << 16) + (s.charCodeAt(i + 3) << 24);
		}
		return md5blks;
	}

	var hex_chr = '0123456789abcdef'.split('');

	function rhex(n) {
		var s = '', j = 0;
		for (; j < 4; j++)
			s += hex_chr[(n >> (j * 8 + 4)) & 0x0F] + hex_chr[(n >> (j * 8)) & 0x0F];
		return s;
	}

	function hex(x) {
		for (var i = 0; i < x.length; i++)
			x[i] = rhex(x[i]);
		return x.join('');
	}

	function md5(s) {
		return hex(md51(s));
	}

	/* this function is much faster,
	 so if possible we use it. Some IEs
	 are the only ones I know of that
	 need the idiotic second function,
	 generated by an if clause.  */

	function add32(a, b) {
		return (a + b) & 0xFFFFFFFF;
	}

	if (md5('hello') != '5d41402abc4b2a76b9719d911017c592') {
		function add32(x, y) {
			var lsw = (x & 0xFFFF) + (y & 0xFFFF), msw = (x >> 16) + (y >> 16) + (lsw >> 16);
			return (msw << 16) | (lsw & 0xFFFF);
		}

	}

});
