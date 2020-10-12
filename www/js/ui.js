$(function(){
	$.fn.gnb = function(d1, d2, d3) {
		var gnbWrap = $(this)
			,btnMenu = gnbWrap.find('.btnMenu')
			,closeMenu = gnbWrap.find('.closeMenu')
			,gnbNav = gnbWrap.find('.menuNav')
			,depth1Menu = gnbNav.find('> li > a')
			,depth2 = gnbNav.find('.depth2')
			,depth2Menu = depth2.find('> ul > li > a')
			,currentD1 = d1 -1
			,currentD2 = d2 -1
			,currentD3 = d3 -1;
		
		gnbNav.find('> li').eq(currentD1).addClass('current');
		gnbNav.find('> li').eq(currentD1).find('.depth2 > ul > li').eq(currentD2).addClass('current');
		gnbNav.find('> li').eq(currentD1).find('.depth2 > ul > li').eq(currentD2).find('.depth3 > ul > li').eq(currentD3).addClass('current');
		if ($('#snb').length > 0) {
			var d1Text = gnbNav.find('> .current > a')
				,d2Text = gnbNav.find('.depth2 > ul > .current > a')
				,d2List = d1Text.next().find('ul').html()
				,snbCurrent = 0;

			$('#snb > h2').text(d1Text.text());
			$('#snb > ul').append(d2List);

			$('#snb > ul li').ready(function(){
				snbCurrent = $(this).find('#snb .current').position();
				$('#snb .deco').css('top',snbCurrent.top);
			});
			$('#snb li a').bind('mouseenter', function(){
				var _this = $(this)
					,thisPos = _this.parent().position();
				$('#snb .deco').stop().animate({top:thisPos.top},200);
			});
			$('#snb').bind('mouseleave', function(){
				$('#snb .deco').stop().animate({top:snbCurrent.top},200);
			});
		}
		if ($('.locMenu').length > 0) {
			var locBtn = $('.locMenu').find('button') 
				,locMenu = $('.locMenu').find('ul') 
				,d1Text = gnbNav.find('> .current > a')
				,d1List = gnbNav.html()
				,d2Text = gnbNav.find('.depth2 > ul > .current > a')
				,d2List = d1Text.next().find('ul').html();
			$('.locDepth1 > button').text(d1Text.text());
			$('.locDepth1 > ul').append(d1List);
			$('.locDepth1 > ul').find('.depth2').remove();
			if (d3 > 0) {
				var d3Text = gnbNav.find('.depth3 > ul > .current > a')
					,d3List = d2Text.next().find('ul').html();
				$('.locDepth2').show();
				$('.locDepth2 > button').text(d2Text.text());
				$('.locDepth2 > ul').append(d2List);
				$('.locDepth2 > ul').find('.depth3').remove();
				$('.currentDepth > button').text(d3Text.text());
				$('.currentDepth > ul').append(d3List);
			} else {
				$('.currentDepth > button').text(d2Text.text());
				$('.currentDepth > ul').append(d2List);
				$('.currentDepth > ul').find('.depth3').remove();
			}
			locBtn.click(function(e){
				e.stopPropagation();
				var _this = $(this);
				if (_this.hasClass('on')) {
					locBtn.removeClass('on');
					locMenu.stop().slideUp(200);
				} else {
					locBtn.removeClass('on');
					_this.addClass('on');
					locMenu.stop().slideUp(200);
					_this.next().slideDown(200);
				}
			});
			$('body').click(function(){
				locBtn.removeClass('on');
				locMenu.stop().slideUp(200);
			});
		}
		btnMenu.click(function(){
			$('body').addClass('menuOn');
			$('body').bind('touchmove', function(e){e.preventDefault()});
			$('.menuNav').bind('touchmove', function(e){e.stopPropagation()});
		});
		closeMenu.bind('click', function(){
			$('body').removeClass('menuOn');
			$('body').unbind('touchmove');
		});
		depth1Menu.on({
			focusin : function() {
				var _this = $(this)
					,winW = $(window).width();
				if (winW > 1024) {
					depth1Menu.parent().removeClass('on');
					_this.parent().addClass('on');
					depth2.slideDown(200);
				}
			},
			mouseenter : function() {
				var _this = $(this)
					,winW = $(window).width();
				if (winW > 1024) {
					depth1Menu.parent().removeClass('on');
					_this.parent().addClass('on');
					depth2.slideDown(200);
				}
			},
			click : function() {
				var _this = $(this);
				if (_this.parent().hasClass('on')) {
					depth1Menu.parent().removeClass('on');
					depth2.stop().slideUp(200);
				} else {
					depth1Menu.parent().removeClass('on');
					_this.parent().addClass('on');
					depth2.stop().slideUp(200);
					_this.next().stop().slideDown(200);
				}
				return false;
			}
		});
		depth2.on('mouseenter',function(){
			var _this = $(this);
			depth1Menu.parent().removeClass('on');
			_this.parent().addClass('on');
		})
		depth2Menu.on({
			focusin : function() {
				var _this = $(this);
				depth2Menu.parent().removeClass('on');
				_this.parent().addClass('on');
			},
			mouseenter : function() {
				var _this = $(this);
				depth2Menu.parent().removeClass('on');
				_this.parent().addClass('on');
			}
		});

		gnbWrap.bind('mouseleave', function(){
			depth2.stop().slideUp(200);
			depth1Menu.parent().removeClass('on');
			depth2Menu.parent().removeClass('on');
		});
	}

	$('.topBtn').click(function(){
		$('html, body').animate({scrollTop : 0},200);
	});

	/* intro02 view accordian */


	/* tab */
	$.fn.tabMenu = function() {
		this.each(function(){
			var tabWrap = $(this)
				,tabList = tabWrap.find('ul')
				,tabMenu = tabWrap.find('ul li a')
				,tabLength = tabMenu.length
				,tabW = Math.floor((100/tabLength)*100)/100
				,tabBtn = tabWrap.find('button')
				,listIdx = tabList.find('> .on').index();

			tabMenu.parent().css('width',tabW+'%');
			tabBtn.text(tabList.find('> .on').text());
			if (tabWrap.next().hasClass('tabCont')) {
				tabWrap.next().find('> div').removeClass('current');
				tabWrap.next().find('> div').eq(listIdx).addClass('current');
			}
			tabMenu.click(function(){
				var _this = $(this)
					,winW = $(window).width()
					,tabIdx = _this.parent().index();
				
				tabList.find('li').removeClass('on');
				_this.parent().addClass('on');
				
				if (winW <= 760) {
					$('.mobBtn button').removeClass('on');
					tabList.slideUp(200);
					tabBtn.text(tabList.find('> .on').text());
				}
				
				if (tabWrap.next().hasClass('tabCont')) {
					tabWrap.next().find('> div').removeClass('current');
					tabWrap.next().find('> div').eq(tabIdx).addClass('current');
					return false;
				}
			});
			tabBtn.click(function(){
				var _this = $(this);
				if (_this.hasClass('on')) {
					tabList.stop().slideUp(200);
					_this.removeClass('on');
				} else {
					$('.mobBtn button').removeClass('on');
					$('.tabList, .depth4List').slideUp(200);
					tabList.slideDown(200);
					_this.addClass('on');
				}
			});
		});
	}
	$('.tab').tabMenu();

	$.fn.mainTab = function() {
		var tabWrap = $(this)
			,tabMenu = tabWrap.find('.tabList a')
			,tabCont = tabWrap.find('.tabCont > div');

		tabMenu.click(function(){
			var _this = $(this)
				,listIdx = _this.parent().index();
			tabMenu.parent().removeClass('on');
			_this.parent().addClass('on');
			tabCont.removeClass('current');
			tabCont.eq(listIdx).addClass('current');
			return false;
		});
	}
	$('.mainTab').mainTab();

	/* accordian */
	$.fn.accordian = function(obj) {
		this.each(function(){
			var _this = $(this),
				menuTit = _this.find('.tit'),
				menuCont = _this.find('.cont');

			menuTit.click(function(){
				var _this = $(this)
					,headerH = $('#header').height();
				if (_this.hasClass('on') != 1) {
					menuTit.removeClass('on');
					_this.addClass('on');
					menuCont.stop().slideUp(300);
					_this.next().stop().slideDown(300);
					setTimeout(function(){
						$('html, body').animate({scrollTop : _this.offset().top - headerH},300)
					},300);
				} else {
					_this.next().slideUp(300);
					menuTit.removeClass('on');
				}
				return false;
			});
		});
	}
	$('.accordianCont').accordian();

	/* select */
	$.fn.select = function(obj) {
		this.each(function(){
			var _this = $(this),
				label = _this.find('label'),
				sel = _this.find('select');
			label.bind('focusin', function(){
				sel.focus();
			});
			sel.bind('keyup change', function(){
				var selTxt = $(this).find('option').filter(':selected').text();
				sel.prev('label').text(selTxt);
				$(this).prev().addClass('on');
			});
		})
	}
	$('.selectBox').select();

	/* input file */
	$('.fileBtn input').bind('change',function(){
		var val = $(this).val();
		$(this).parent().prev('.txt').val(val);
	});

	/* resize */
	var reszieEvent = 'orientationchange' in window ? 'orientationchange' : 'resize',
		resizeTimer;

	$(window).bind(reszieEvent, function() {
		var winW = $(this).width();
		var winH = $(this).height();

		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function(){
		},300);
	});

	/* ie 버전 체크 */
	function getInternetVersion(ver) {
		var rv = -1; // Return value assumes failure.
		var ua = navigator.userAgent;
		var re = null;
		if(ver == "MSIE"){
			re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		}else{
		re = new RegExp(ver+"/([0-9]{1,}[\.0-9]{0,})");
			}
		if (re.exec(ua) != null){
			rv = parseFloat(RegExp.$1);
		}
		return rv;
	}
	// Check the Browser Type and Version
	function browserCheck() {
		var ver = 0; // Browser Version
		if(navigator.appName.charAt(0) == "M"){
			ver = getInternetVersion("MSIE");
			if (ver < "9"){
				$('body').prepend(
					'<div id="version"><p>고객님께서는 현재 Explorer 구형버전으로 접속 중이십니다. 이 사이트는 Explorer 최신버전에 최적화 되어 있습니다. <a href="http://windows.microsoft.com/ko-kr/internet-explorer/download-ie" target="_blank">Explorer 업그레이드 하기</a></p> <button type="button" class="versionClose">X</button></div>'
				)
			}
		}
	}
	browserCheck();

	$('#version').on('click','.versionClose',function(){
		$('#version').hide();
	});
});
