// var search_a;
// var searched;
// var check = 0;
// var ntf_time;
// var my_timer;

// (function () {
//     function o(e) {
//         this._n = e
//     }

//     function u(e, t, n) {
//         var r = Math.pow(10, t), i;
//         i = (Math.round(e * r) / r).toFixed(t);
//         if (n) {
//             var s = new RegExp("0{1," + n + "}$");
//             i = i.replace(s, "")
//         }
//         return i
//     }

//     function a(e, t) {
//         var n;
//         t.indexOf("$") > -1 ? n = l(e, t) : t.indexOf("%") > -1 ? n = c(e, t) : t.indexOf(":") > -1 ? n = h(e, t) : n = d(e, t);
//         return n
//     }

//     function f(e, t) {
//         if (t.indexOf(":") > -1)e._n = p(t); else if (t === i)e._n = 0; else {
//             var s = t;
//             n[r].delimiters.decimal !== "." && (t = t.replace(/\./g, "").replace(n[r].delimiters.decimal, "."));
//             var o = new RegExp(n[r].abbreviations.thousand + "(?:\\)|(\\" + n[r].currency.symbol + ")?(?:\\))?)?$"), u = new RegExp(n[r].abbreviations.million + "(?:\\)|(\\" + n[r].currency.symbol + ")?(?:\\))?)?$"), a = new RegExp(n[r].abbreviations.billion + "(?:\\)|(\\" + n[r].currency.symbol + ")?(?:\\))?)?$"), f = new RegExp(n[r].abbreviations.trillion + "(?:\\)|(\\" + n[r].currency.symbol + ")?(?:\\))?)?$"), l = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], c = !1;
//             for (var h = 0; h <= l.length; h++) {
//                 c = t.indexOf(l[h]) > -1 ? Math.pow(1024, h + 1) : !1;
//                 if (c)break
//             }
//             e._n = (c ? c : 1) * (s.match(o) ? Math.pow(10, 3) : 1) * (s.match(u) ? Math.pow(10, 6) : 1) * (s.match(a) ? Math.pow(10, 9) : 1) * (s.match(f) ? Math.pow(10, 12) : 1) * (t.indexOf("%") > -1 ? .01 : 1) * Number((t.indexOf("(") > -1 ? "-" : "") + t.replace(/[^0-9\.'-]+/g, ""));
//             e._n = c ? Math.ceil(e._n) : e._n
//         }
//         return e._n
//     }

//     function l(e, t) {
//         var i = t.indexOf("$") <= 1 ? !0 : !1, s = "";
//         if (t.indexOf(" $") > -1) {
//             s = " ";
//             t = t.replace(" $", "")
//         } else if (t.indexOf("$ ") > -1) {
//             s = " ";
//             t = t.replace("$ ", "")
//         } else t = t.replace("$", "");
//         var o = a(e, t);
//         if (i)if (o.indexOf("(") > -1 || o.indexOf("-") > -1) {
//             o = o.split("");
//             o.splice(1, 0, n[r].currency.symbol + s);
//             o = o.join("")
//         } else o = n[r].currency.symbol + s + o; else if (o.indexOf(")") > -1) {
//             o = o.split("");
//             o.splice(-1, 0, s + n[r].currency.symbol);
//             o = o.join("")
//         } else o = o + s + n[r].currency.symbol;
//         return o
//     }

//     function c(e, t) {
//         var n = "";
//         if (t.indexOf(" %") > -1) {
//             n = " ";
//             t = t.replace(" %", "")
//         } else t = t.replace("%", "");
//         e._n = e._n * 100;
//         var r = a(e, t);
//         if (r.indexOf(")") > -1) {
//             r = r.split("");
//             r.splice(-1, 0, n + "%");
//             r = r.join("")
//         } else r = r + n + "%";
//         return r
//     }

//     function h(e, t) {
//         var n = Math.floor(e._n / 60 / 60), r = Math.floor((e._n - n * 60 * 60) / 60), i = Math.round(e._n - n * 60 * 60 - r * 60);
//         return n + ":" + (r < 10 ? "0" + r : r) + ":" + (i < 10 ? "0" + i : i)
//     }

//     function p(e) {
//         var t = e.split(":"), n = 0;
//         if (t.length === 3) {
//             n += Number(t[0]) * 60 * 60;
//             n += Number(t[1]) * 60;
//             n += Number(t[2])
//         } else if (t.lenght === 2) {
//             n += Number(t[0]) * 60;
//             n += Number(t[1])
//         }
//         return Number(n)
//     }

//     function d(e, t) {
//         var s = !1, o = !1, a = "", f = "", l = "", c = Math.abs(e._n);
//         if (e._n === 0 && i !== null)return i;
//         if (t.indexOf("(") > -1) {
//             s = !0;
//             t = t.slice(1, -1)
//         }
//         if (t.indexOf("a") > -1) {
//             if (t.indexOf(" a") > -1) {
//                 a = " ";
//                 t = t.replace(" a", "")
//             } else t = t.replace("a", "");
//             if (c >= Math.pow(10, 12)) {
//                 a += n[r].abbreviations.tillion;
//                 e._n = e._n / Math.pow(10, 12)
//             } else if (c < Math.pow(10, 12) && c >= Math.pow(10, 9)) {
//                 a += n[r].abbreviations.billion;
//                 e._n = e._n / Math.pow(10, 9)
//             } else if (c < Math.pow(10, 9) && c >= Math.pow(10, 6)) {
//                 a += n[r].abbreviations.million;
//                 e._n = e._n / Math.pow(10, 6)
//             } else if (c < Math.pow(10, 6) && c >= Math.pow(10, 3)) {
//                 a += n[r].abbreviations.thousand;
//                 e._n = e._n / Math.pow(10, 3)
//             }
//         }
//         if (t.indexOf("b") > -1) {
//             if (t.indexOf(" b") > -1) {
//                 f = " ";
//                 t = t.replace(" b", "")
//             } else t = t.replace("b", "");
//             var h = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"], p, d;
//             for (var v = 0; v <= h.length; v++) {
//                 p = Math.pow(1024, v);
//                 d = Math.pow(1024, v + 1);
//                 if (e._n >= p && e._n < d) {
//                     f += h[v];
//                     p > 0 && (e._n = e._n / p);
//                     break
//                 }
//             }
//         }
//         if (t.indexOf("o") > -1) {
//             if (t.indexOf(" o") > -1) {
//                 l = " ";
//                 t = t.replace(" o", "")
//             } else t = t.replace("o", "");
//             l += n[r].ordinal(e._n)
//         }
//         if (t.indexOf("[.]") > -1) {
//             o = !0;
//             t = t.replace("[.]", ".")
//         }
//         var m = e._n.toString().split(".")[0], g = t.split(".")[1], y = t.indexOf(","), b = "", w = !1;
//         if (g) {
//             if (g.indexOf("[") > -1) {
//                 g = g.replace("]", "");
//                 g = g.split("[");
//                 b = u(e._n, g[0].length + g[1].length, g[1].length)
//             } else b = u(e._n, g.length);
//             m = b.split(".")[0];
//             b.split(".")[1].length ? b = n[r].delimiters.decimal + b.split(".")[1] : b = "";
//             o && Number(b) === 0 && (b = "")
//         } else m = u(e._n, null);
//         if (m.indexOf("-") > -1) {
//             m = m.slice(1);
//             w = !0
//         }
//         y > -1 && (m = m.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1" + n[r].delimiters.thousands));
//         t.indexOf(".") === 0 && (m = "");
//         return (s && w ? "(" : "") + (!s && w ? "-" : "") + m + b + (l ? l : "") + (a ? a : "") + (f ? f : "") + (s && w ? ")" : "")
//     }

//     function v(e, t) {
//         n[e] = t
//     }

//     var e, t = "1.4.5", n = {}, r = "en", i = null, s = typeof module != "undefined" && module.exports;
//     e = function (t) {
//         e.isNumeral(t) ? t = t.value() : Number(t) || (t = 0);
//         return new o(Number(t))
//     };
//     e.version = t;
//     e.isNumeral = function (e) {
//         return e instanceof o
//     };
//     e.language = function (t, i) {
//         if (!t)return r;
//         t && !i && (r = t);
//         (i || !n[t]) && v(t, i);
//         return e
//     };
//     e.language("en", {
//         delimiters: {thousands: ",", decimal: "."},
//         abbreviations: {thousand: "k", million: "m", billion: "b", trillion: "t"},
//         ordinal: function (e) {
//             var t = e % 10;
//             return ~~(e % 100 / 10) === 1 ? "th" : t === 1 ? "st" : t === 2 ? "nd" : t === 3 ? "rd" : "th"
//         },
//         currency: {symbol: "$"}
//     });
//     e.zeroFormat = function (e) {
//         typeof e == "string" ? i = e : i = null
//     };
//     e.fn = o.prototype = {
//         clone: function () {
//             return e(this)
//         }, format: function (t) {
//             return a(this, t ? t : e.defaultFormat)
//         }, unformat: function (t) {
//             return f(this, t ? t : e.defaultFormat)
//         }, value: function () {
//             return this._n
//         }, valueOf: function () {
//             return this._n
//         }, set: function (e) {
//             this._n = Number(e);
//             return this
//         }, add: function (e) {
//             this._n = this._n + Number(e);
//             return this
//         }, subtract: function (e) {
//             this._n = this._n - Number(e);
//             return this
//         }, multiply: function (e) {
//             this._n = this._n * Number(e);
//             return this
//         }, divide: function (e) {
//             this._n = this._n / Number(e);
//             return this
//         }, difference: function (e) {
//             var t = this._n - Number(e);
//             t < 0 && (t = -t);
//             return t
//         }
//     };
//     s && (module.exports = e);
//     typeof ender == "undefined" && (this.numeral = e);
//     typeof define == "function" && define.amd && define([], function () {
//         return e
//     })
// }).call(this);
// function tab(a, b) {
//     c = jQuery("#tab_" + a + "_" + b);
//     d = jQuery("#tab_ct_" + a + "_" + b);
//     jQuery("#" + a + " .tabs li, #" + a + " .tab_ct").removeClass("c");
//     c.addClass('c');
//     d.addClass('c');
// }
// function remove_special_char(str) {
//     str = str.trim();
//     str = str.toLowerCase();
//     str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
//     str = str.replace(/č/g, "c");
//     str = str.replace(/ď|đ/g, "d");
//     str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ě/g, "e");
//     str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
//     str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
//     str = str.replace(/ň/g, "n");
//     str = str.replace(/ř/g, "r");
//     str = str.replace(/š/g, "s");
//     str = str.replace(/ť/g, "t");
//     str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ů/g, "u");
//     str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
//     str = str.replace(/ž/g, "z");
// //str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,"-");
// //str= str.replace(/-+-/g,"-");
// //str= str.replace(/^\-+|\-+$/g,"");
//     return str;

// }
// function loading_pos(id) {
//     var page_offset = $(id).offset().top;
//     var footer = $('#footer').outerHeight();
//     var w_h = $(window).height();
//     var page = $(document).height();
//     var ct_h = $(id).outerHeight();
//     var l_h = $(id + ' .loading-page .msg').outerHeight();
//     var top = $(document).scrollTop();
//     if (top < page_offset) w_visible = page_offset - top + (w_h - page_offset + top - l_h) * 0.5;
//     else if (top + w_h > page - footer) w_visible = (page - top - footer - l_h) * 0.5;

//     else w_visible = (w_h - l_h) * 0.5;
//     //else if (w_h > page_offset-footer) w_visible = (top+w_h-footer)*0.5;
//     $(id + ' .loading-page .msg').css({'top': w_visible, 'left': $(id).offset().left, 'width': $(id).outerWidth()});
// }
// function toggle_show(obj) {
//     if ($(obj).hasClass('h') === false) {
//         $(obj).addClass('h')
//     }
//     else $(obj).removeClass('h')
// }
// function executeFunctionByName(functionName, context, args) {
//     var args = Array.prototype.slice.call(arguments).splice(2);
//     var namespaces = functionName.split(".");
//     var func = namespaces.pop();
//     for (var i = 0; i < namespaces.length; i++) {
//         context = context[namespaces[i]];
//     }
//     return context[func].apply(this, args);
// }

// function show_invoice(id) {
//     var a = $('#invoice_' + id);
//     if (a.hasClass('show') === true) {
//         a.removeClass('show');
//         $('#list_invoice_' + id).removeClass('show');
//     }
//     else {
//         a.addClass('show');
//         $('#list_invoice_' + id).addClass('show');
//     }
// }

// function update_cart_listen(obj) {

//     oldval = parseFloat(obj.attr('data-incart'));
//     s_price = parseFloat(obj.attr('data-price'));
//     c_total = parseFloat($('#cart').attr('data-total'));
//     recalculate(c_total);
//     $('#cart form.change input[type=text]').not(obj).each(function (index, element) {
//         $(this).parent().parent().removeClass('change');
//         $(this).val($(this).attr('data-incart'));
//         $(this).parentsUntil('.info', '.desc').find('div.price_tt span.n').html(
//             currency_format($(this).attr('data-incart') * $(this).attr('data-incart'))
//         );
//     });

//     newval = obj.val();
//     if (newval != oldval && check_quantity(obj, 1) === true) {
//         obj.parent().parent().addClass('change');
//         obj.parentsUntil('.add2cart', '.updatecart-form').addClass('change');
//         obj.parentsUntil('.info', '.desc').find('div.price_tt .n').html(
//             currency_format(newval * s_price)
//         );

//         recalculate(c_total - oldval * s_price + newval * s_price);
//     }
//     else {
//         obj.parent().parent().removeClass('change');
//         obj.parentsUntil('.info', '.desc').find('.price_tt span.n').html(
//             currency_format(oldval * s_price)
//         );
//         recalculate(c_total);
//     }

//     $(document).mousedown(function () {
//         obj.parent().parent().removeClass('change');
//         obj.val(obj.attr('data-incart'));
//         obj.parentsUntil('.info', '.desc').find('.price_tt span.n').html(
//             currency_format(oldval * s_price)
//         );
//         recalculate();
//     });

//     obj.parentsUntil('.add2cart').mousedown(function (event) {
//         event.stopPropagation();
//     });

//     obj.parentsUntil('.add2cart').find('button').addClass('1')
//     $(document).mousedown(function (event) {
//         event.stopPropagation();
//     });
// }

// function check_quantity(obj, check) {
//     if (!check) check = 0;
//     min = 1;
//     var oldValue = obj.val();

//     if (isInt(oldValue) === false) {
//         inline_error(obj, 'Bạn phải nhập số');
//         obj.val(min);
//     }
//     if (oldValue < min) {
//         inline_error(obj, 'Bạn chỉ được chọn số lượng tối thiểu là ' + min);
//         if (check == 0) obj.val(min);
//         return false;
//     }else {
//         rm_inline_error(obj);
//         return true;
//     }
// }
// function isInt(n) {
//     return n % 1 === 0;
// }

// function close_confirm_box() {
//     $('#confirm-box').remove();
//     $('body').removeClass('confirm');
// }
// function confirm_box(func, attr, msg, ok, cancel) {
//     if (!msg) msg = 'Bạn có muốn thực hiện tác vụ này không?';
//     if (!ok) ok = 'Có';
//     if (!cancel) cancel = 'Không';
//     $('#confirm-box').remove();
//     check = 0;
//     $('body').addClass('confirm');
//     c_ct = '<div id="confirm-box" class="page-ovl"><div class="va"></div><div class="container box"><div class="msg">' + msg + '</div><p><button class="primary">' + ok + '</button> <button class="cancel">' + cancel + '</button></p></div></div>';
//     $c_ct = $(c_ct);
//     $('body').append($c_ct);
//     c = $c_ct.find('button');
//     c.click(function () {
//         close_confirm_box();
//         b = $(this);
//         if (b.hasClass('primary') === true) {
//             check = 1;
//             executeFunctionByName(func, window, attr);
//             return true;
//         }
//         else {
//             check = 0;
//             return false;
//         }

//     });
//     $('#confirm-box').perfectScrollbar();
// }
// function inline_error(obj, msg) {
//     //rm_inline_error();
//     if(my_timer) {
//         clearTimeout(my_timer);
//         my_timer = null;
//     }
//     offset = obj.offset();

//     $('#inline-error').html(msg);
//     $('#inline-error').show();
//     $('#inline-error').css({
//         'top': offset.top - $('#inline-error').outerHeight() - 5,
//         'left': offset.left - ($('#inline-error').outerWidth() / 2) + obj.outerWidth() * 0.5
//     });
//     //obj.addClass('error');
//     //obj.addClass('inline-error');
//     //alert('e');

//     my_timer = setTimeout(function () {
//         $('#inline-error').hide();
//     }, 2000);
// }
// function rm_inline_error(obj) {

// }

// function do_search(value, page) {
//     if (typeof search_a !== "undefined") {
//         search_a.abort();
//     }
    
//     search_a = $.ajax({
//         url: "/search/autocomplete", data: {keywords: value, page: page}, cache: false, success: function (data) {

//             $('#search-result').html(data + '<button class="close" onclick="close_search()"></button>');
//             show_search();
//             searched=value;
//         }
//     })
// }
// function close_search() {
//     $('#search').removeClass('a');
//     $('body').removeClass('q_search');
// }
// function show_search() {
//     $('#search').addClass('a');
//     $('body').addClass('q_search');
//     if ($('#search-ovl').length == 0)$('body').append('<div id="search-ovl"></div>');
//     $('#search-ovl').click(function () {
//         close_search()
//     })
// }
// function pos_cart() {
//     if ($('#breadcrumb').length) {
//         var offset = $('#breadcrumb').offset().top;
//         a = $('#header #cart');
//         if (a.length) {
//             footer = $('#footer').height();
//             page_w = $('#header .wrap').width();
//             items = $('#cart div.items').height();
//             head = $('#cart div.header').height();
//             foot = $('#cart div.footer').height();
//             var view = $(window).height();
//             var bodyHeight = $('body').height();
//             var page = $(document).height();
//             var top = $(document).scrollTop();
//             var larger = top < offset ? top : offset;
//             var shorter;
//             if (top > page - view - footer) {
//                 shorter = footer - (page - top - view);
//             } else {
//                 shorter = 0;
//             }
//             var height = view - offset - head - foot + larger - shorter;
//             if (bodyHeight < view) {
//                 height -= view - bodyHeight;
//             }
//             $('#cart div.items').height(height-32 + "px");
//             if (offset < top) {
//                 a.addClass('fixed');

//                 a.css('margin-left', $('#cart_pos').offset().left - $(document).scrollLeft());
//             } else {
//                 a.removeClass('fixed');
//                 a.css('margin-right', 0);
//             }
//             $('#cart div.items').perfectScrollbar({
//                 suppressScrollX: true,
//                 wheelPropagation: true
//             });
//         }
//         $('#quick_contact').css('margin-left',$('#cart_pos').offset().left-$(document).scrollLeft());
//     }
// }
// function close_ntf() {
//     clearTimeout(ntf_time);
//     $('#notification').removeClass('show');
//     $('#notification').css('margin-bottom', 1);
//     $('body').removeClass('show-ntf');
//     $('body').animate({marginTop: 0}, 500);
// }
// function show_ntf(data, type, time) {
//     options = {
//         html: data,
//         cssClass: 'warning'
//     }

//     if (typeof type != 'undefined') {
//         options.cssClass = type;
//     }

//     if (typeof time != 'undefined') {
//         options.delay = time;
//     }
    
//     $.notifyBar(options);
// }
// function show_scr_t() {
//     var top = $(document).scrollTop();
//     if (top > 50) $('#scrollTop').addClass('show')
//     else $('#scrollTop').removeClass('show')
// }
// function hide_q_contact() {
//     $('#quick_contact').removeClass('show');
//     $('#quick_contact').css({'margin-top': -32 + 'px'});
//     $('#contact_form').removeClass('h');
//     $('#message-contact').remove();
// }
// function show_q_contact() {
//     $('#quick_contact').addClass('show');
//     $('#quick_contact').css({'margin-top': -($('#quick_contact').outerHeight())});
// }
// jQuery(function ($) {

//     //$('select.ui').selectmenu();
//     $('#quick_contact .header a').click(function (event) {
//         event.preventDefault();
//         if ($('#quick_contact').hasClass('show') === true) {
//             hide_q_contact();
//         }
//         else {
//             show_q_contact();
//         }
//     })
//     $(document).on("click", "a.ajax", function (event) {
//         event.preventDefault();
//         var fav = $(event.target);

//         $.ajax({
//             url: fav.attr('href'),
//             cache: false,
//             success: function (data) {
//                 if (data == 0) // chưa login
//                 {

//                 }
//                 else {
//                     $('#temp').html(data);
//                 }
//             }
//         });
//     });

//     $('#search-value').focus(function () {
//         s_vl = $(this).val();
//         if (s_vl == searched) show_search();
//         else {
//             $('#search-value').keyup(function () {
//                 s_vl2 = $(this).val();
//                 if (s_vl2 != "" && s_vl2.length > 2) do_search($('#search-value').val());
//                 else close_search();

//             });
//         }
//     });

// });
// (function( $ ){

//   // plugin variables
//   var months = {
//     "short": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
//     "long": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"] },
//       todayDate = new Date(),
//       todayYear = todayDate.getFullYear(),
//       todayMonth = todayDate.getMonth() + 1,
//       todayDay = todayDate.getDate();


//   $.fn.birthdaypicker = function( options ) {

//     var settings = {
//       "maxAge"        : 120,
//       "minAge"        : 0,
//       "futureDates"   : false,
//       "maxYear"       : todayYear,

//       "placeholder"   : true,
//       "defaultDate"   : false,
//       "hiddenDate"    : true,
//       "onChange"      : null,
//       "tabindex"      : null,
//       "fieldName"     : "birthdate",
//       "fieldId"       : "birthdate",
//     };

//     return this.each(function() {

//       if (options) { $.extend(settings, options); }

//       // Create the html picker skeleton
//       var $fieldset = $("<fieldset class='birthday-picker'></fieldset>"),
//             $year = $("<select class='birth-year "+$(this).find("input[name='birth[year]']").attr('class')+"' name='birth[year]'></select>"),
//           $month = $("<select class='birth-month "+$(this).find("input[name='birth[month]']").attr('class')+"' name='birth[month]'></select>"),
//           $day = $("<select class='birth-day "+$(this).find("input[name='birth[date]']").attr('class')+"' name='birth[day]'></select>");

      

//       var tabindex = settings["tabindex"];

//       // Deal with the various Date Formats
      
//         //$fieldset.append($month).append($day).append($year);
//         if (tabindex != null) {
//           $month.attr('tabindex', tabindex);
//           $day.attr('tabindex', tabindex++);
//           $year.attr('tabindex', tabindex++);
//         }
     

//       // Add the option placeholders if specified
//       if (settings["placeholder"]) {
//         $("<option value=''>Năm</option>").appendTo($year);
//         $("<option value=''>Tháng</option>").appendTo($month);
//         $("<option value=''>Ngày</option>").appendTo($day);
//       }

//       var hiddenDate;
      
//     dd  = $(this).find("input[name='birth[date]']").val();
//     dm  = $(this).find("input[name='birth[month]']").val();
//     dy  = $(this).find("input[name='birth[year]']").val();
//     defaultDate = dy + '-'+dm+'-'+dd;
        
//         var defDate = new Date(defaultDate + "T00:00:00"),
//         defYear = defDate.getFullYear(),
//         defMonth = defDate.getMonth() + 1,
//         defDay = defDate.getDate();
//         if (defMonth<10) defMonth="0"+defMonth;
//         if (defDay<10) defDay="0"+defDay;
//         hiddenDate = defYear + "-" + defMonth + "-" + defDay;
      

//       // Create the hidden date markup
//       if (settings["hiddenDate"]) {
//         $("<input type='hidden' name='" + settings["fieldName"] + "'/>")
//             .attr("id", settings["fieldId"])
//             .val(hiddenDate)
//             .appendTo($(this));
//       }

//       // Build the initial option sets
//       var startYear = todayYear - settings["minAge"];
//       var endYear = todayYear - settings["maxAge"];
//       if (settings["futureDates"] && settings["maxYear"] != todayYear) {
//         if (settings["maxYear"] > 1000) { startYear = settings["maxYear"]; }
//         else { startYear = todayYear + settings["maxYear"]; }
//       }
//       for (var i=startYear; i>=endYear; i--) { $("<option></option>").attr("value", i).text(i).appendTo($year); }
//       for (var j=0; j<12; j++) { $("<option></option>").attr("value", j+1).text(j+1).appendTo($month); }
//       for (var k=1; k<32; k++) { $("<option></option>").attr("value", k).text(k).appendTo($day); }
//       $(this).wrap($fieldset);
//       $(this).find("input[name='birth[date]']").hide().removeClass('required').after($day);
//         $(this).find("input[name='birth[month]']").hide().removeClass('required').after($month);
//         $(this).find("input[name='birth[year]']").hide().removeClass('required').after($year);
//       // Set the default date if given
//         var date = new Date(defaultDate + "T00:00:00");
//         $year.val(date.getFullYear());
//         $month.val(date.getMonth() + 1);
//         $day.val(date.getDate());
//         if (isNaN (date.getFullYear())){
//         	$year.find("option:first").attr('selected','selected');
//         	$month.find("option:first").attr('selected','selected');
//         	$day.find("option:first").attr('selected','selected');
//         }
      

//       // Update the option sets according to options and user selections
//      $(this).find('select').change(function() {
//             // todays date values
//         var todayDate = new Date(),
//             todayYear = todayDate.getFullYear(),
//             todayMonth = todayDate.getMonth() + 1,
//             todayDay = todayDate.getDate(),
//             // currently selected values
//             selectedYear = parseInt($year.val(), 10),
//             selectedMonth = parseInt($month.val(), 10),
//             selectedDay = parseInt($day.val(), 10),
//             // number of days in currently selected year/month
//             actMaxDay = (new Date(selectedYear, selectedMonth, 0)).getDate(),
//             // max values currently in the markup
//             curMaxMonth = parseInt($month.children(":last").val()),
//             curMaxDay = parseInt($day.children(":last").val());

//         // Dealing with the number of days in a month
//         // http://bugs.jquery.com/ticket/3041
//         if (curMaxDay > actMaxDay) {
//           while (curMaxDay > actMaxDay) {
//             $day.children(":last").remove();
//             curMaxDay--;
//           }
//         } else if (curMaxDay < actMaxDay) {
//           while (curMaxDay < actMaxDay) {
//             curMaxDay++;
//             $day.append("<option value=" + curMaxDay + ">" + curMaxDay + "</option>");
//           }
//         }

//         // Dealing with future months/days in current year
//         // or months/days that fall after the minimum age
//         if (!settings["futureDates"] && selectedYear == startYear) {
//           if (curMaxMonth > todayMonth) {
//             while (curMaxMonth > todayMonth) {
//               $month.children(":last").remove();
//               curMaxMonth--;
//             }
//             // reset the day selection
//             $day.children(":first").attr("selected", "selected");
//           }
//           if (selectedMonth === todayMonth) {
//               while (curMaxDay > todayDay) {
//                   $day.children(":last").remove();
//                   curMaxDay -= 1;
//               }
//           }
//         }

//         // Adding months back that may have been removed
//         // http://bugs.jquery.com/ticket/3041
//         if (selectedYear != startYear && curMaxMonth != 12) {
//           while (curMaxMonth < 12) {
//             $month.append("<option value=" + (curMaxMonth+1) + ">" + months[settings["monthFormat"]][curMaxMonth] + "</option>");
//             curMaxMonth++;
//           }
//         }

//         // update the hidden date
//         if ((selectedYear * selectedMonth * selectedDay) != 0) {
//           if (selectedMonth<10) selectedMonth="0"+selectedMonth;
//           if (selectedDay<10) selectedDay="0"+selectedDay;
//           hiddenDate = selectedYear + "-" + selectedMonth + "-" + selectedDay;
//           $(this).find('#'+settings["fieldId"]).val(hiddenDate);
//           if (settings["onChange"] != null) {
//             settings["onChange"](hiddenDate);
//           }
//         }
//       });
//     });
//   };
// })( jQuery );
// function validateEmail(elementValue){        
//    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
//    return emailPattern.test(elementValue);   
// }

// function validatePhone(elementValue){        
//    var phonePattern = /^[\d\s]+$/;
   
//    return (phonePattern.test(elementValue)) &&  Boolean(14 > elementValue.length);
// }

// function error_input(obj, msg)
// {
//     obj.closest(':has(em.message)').find('em.message').html(msg);
//     obj.closest(':has(em.message)').addClass('error');
// }
// function error_input_clear(obj)
// {
//     if(obj)
//     {
//         obj.each(function()
//         {
//             $(this).closest(':has(em.message)').find('em.message').html('&nbsp');
//             $(this).closest(':has(em.message)').removeClass('error');
            
//         })
        
//     }
// }
// jQuery(function ($) {
//     $(document).on( "focusout", "form input.required, form textarea.required, form select.required", function(event)
//     {
//         ip = $( event.target );
//         if (ip.hasClass('validate-email')) {
//             if (!validateEmail(ip.val())) {
//                 ip.closest(':has(em.message)').addClass('error');
//                 $(this).closest(':has(em.message)').find('em.message').html('Email không đúng định dạng');
//             }
//         } else if (ip.hasClass('validate-phone')) {
//             if (!validatePhone(ip.val())) {
//                 ip.closest(':has(em.message)').addClass('error');
//                 $(this).closest(':has(em.message)').find('em.message').html('Phone không đúng định dạng');
//             }
//         } else {
//             if(ip.val()=="" || $(this).val() === null)
//             {
//                 ip.closest(':has(em.message)').addClass('error');
//                 $(this).closest(':has(em.message)').find('em.message').html('Phần này không được để trống');
//             }
//         }
//     });
        
//     $(document).on( "submit", "form", function(event){
//         var f = $( event.target );
        
//         form_c = f.serializeArray();
//         var error = 0;
//         if(f.hasClass('validate') === true)
//         {
//             $.each(f.find('input.required, select.required'),function(){
//                 if ($(this).hasClass('validate-email')) {
//                     if (!validateEmail($(this).val())) {
//                         error = 1;
//                         $(this).trigger('focusout');
//                     }
//                 } else if ($(this).hasClass('validate-phone')) {
//                     if (!validatePhone($(this).val())) {
//                         error = 1;
//                         $(this).trigger('focusout');
//                     }
//                 } else {
//                     if($(this).val() == "" || $(this).val() === null) {
//                         error = 1;
//                         $(this).trigger('focusout');
                        
//                     }
//                 }
//             });
//             $.each(f.find('textarea.required'),function(){
//                 if($(this).val() == "") {
//                     error = 1;
//                     $(this).trigger('focusout')
//                 }
//             });
//         }
//         if(error == 1) {
//         	event.preventDefault();
//         }
//         else
//         {
//             if (f.attr('data-call-back')) {
//                 window[f.attr('data-call-back')]();
//                 event.preventDefault();
//             }    

//             if(f.hasClass('ajax') === true)
//             {
//                 event.preventDefault();
//                 if (f.hasClass("isLoading") == false){
// 	                f.addClass("isLoading");
// 	                c = $.ajax({
// 	                    url: f.attr('action'),
// 	                    type:f.attr('method'),
// 	                    data:form_c,
// 	                    success: function(data)
// 	                    {
// 	                    	f.removeClass("isLoading");
// 	                    	$("#temp").append(data);
// 	                        if (f.attr('data-call-success')) {
// 	                            window[f.attr('data-call-success')](data);
// 	                        }  
// 	                    },
// 	                    error : function(){
// 	                    	f.removeClass("isLoading");
// 	                    }
// 	                });
//                 }
//             }
// 			if (f.attr('data-call-loading')) {
// 				window[f.attr('data-call-loading')]();
// 			}
//         }
//     });
//     $(document).on( "focus", "form input.required, form textarea.required, form select.required", function(event)
//     {
//         $(this).closest(':has(em.message)').find('em.message').html('&nbsp');
//         //ip.addClass('error');
//         $(this).closest(':has(em.message)').removeClass('error');
        
//     })

//     $('.cate-hide-btn').click(function() {
//         e = $('.cate-introduce .desc');
//         if (e.hasClass('hide-cate')) {
//             e.removeClass('hide-cate');
//             $(this).text(lang.hide_cate_description);
//         } else {
//             e.addClass('hide-cate');
//             $(this).text(lang.show_cate_description);
//         }
//     })

//     $('.lp a').click(function () {
//         a = this; 
//         li = $(this).closest("li");
//         ul = $(this).closest('.lp');
        
//         url = '/index.php?route=product/product/json&product_id='+li.attr("data-product_id");
//         $.ajax({
//             url: url,
//             method: "get",
//             dataType: "json",
//             success: function (product) {
//                 product.href = a.href;
//                 product.list = ul.attr('data-list');
//                 product.position = li.index();
//                 clickProduct(product);
//             }
//         });
//         return false;
//     })
// })

// function subscribe (gender) {
//     jQuery("form#subscriber input[name='gender']").val(gender);
//     jQuery.ajax({
//         'url': jQuery("form#subscriber").attr("action"),
//         'method': jQuery("form#subscriber").attr("method"),
//         'data': jQuery("form#subscriber").serializeArray(),
//         'success': function(data) {
//             jQuery('body').append(data);
//         }
//     });
// }

// function vConfirm(data){
// 	var _id = "confirm_" + Math.floor((Math.random() * 1000) + 1);
// 	var html = '<div class="modal fade confirm-pop" id="' + _id + '"  tabindex="-1" role="dialog"">'
// 			 + '<div class="modal-dialog" role="document">'
// 			 + '<div class="modal-content">'
// 			 + '<div class="modal-body">'
// 			 + '<p>' + data.text + '</p>'
// 			 + '<div class="btn-row">'
// 			 + '<a href="javascript:void(0)" class="btn callYes" style="margin-right: 15px;">' + (data.textYes ? data.textYes : "Có") + '</a>'
// 			 + '<a href="javascript:void(0)" class="btn callNo">' + (data.textNo ? data.textNo : "Không") + '</a>'
// 			 + '</div>'
// 			 + '</div>'
// 			 + '</div>'
// 			 + '</div></div>';
// 	$("body").append(html);
// 	$("#" + _id).modal('show');
// 	$("#" + _id).find(".callYes").bind('click' , function(){
// 		$("#" + _id).modal('hide');
// 		$("#" + _id).remove();
// 		if (data.callYes){
// 			data.callYes();
// 		}
// 	});
// 	$("#" + _id).find(".callNo").bind('click' , function(){
// 		$("#" + _id).modal('hide');
// 		$("#" + _id).remove();
// 		if (data.callNo){
// 			data.callNo();
// 		}
// 	})
	
// }