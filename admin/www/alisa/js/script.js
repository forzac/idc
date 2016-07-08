$(document).ready(function() {
	var menu = new MainPages({
		wrapper: '#wrapper',
		menu: '.menu',
		rightSitebar: '.rightSitebar',
		linkMainMenu: '.linkMainMenu',
		goToMenu: '.goToMenu',
		wrappMenu: '.wrappMenu',
		productCategory: '.productCategory',
		linkMenu: '.linkMenu',
		submenu: '.submenu',
		linkSubmenu: '.linkSubmenu',
		checkLang: '.checkLang',
		activeLang: '.activeLang',
		lang1: '.lang',
		social: '.social'

	});
});


function MainPages(obj) {
	this.variables(obj);
	this.events();
	this.mainMenuPosition();
}

MainPages.prototype.variables = function(obj) {
	this.wrapper = obj.wrapper;
	this.menu = obj.menu;
	this.rightSitebar = obj.rightSitebar;
	this.linkMainMenu = obj.linkMainMenu;
	this.goToMenu = obj.goToMenu;
	this.wrappMenu = obj.wrappMenu;
	this.productCategory = obj.productCategory;
	this.linkMenu = obj.linkMenu;
	this.submenu = obj.submenu;
	this.linkSubmenu = obj.linkSubmenu;
	this.checkLang = obj.checkLang;
	this.activeLang = obj.activeLang;
	this.lang1 = obj.lang1;
	this.social = obj.social;
};

MainPages.prototype.events = function() {
	var that = this;
	$(window).on('resize', function() {
		that.mainMenuPosition(this);
	});
	$(this.linkMainMenu).on('click', function() {
		that.showMenu(this);
	});

	$(this.linkMenu).on('click', function() {
		that.showSubMenu(this);
	});

	$(this.lang1).on('click', function() {
		that.checkLanguage(this);
	});
};

MainPages.prototype.showMenu = function(that) {
	if ($(that).hasClass(this.goToMenu.replace('.', ''))) {

		if (!$(that).hasClass('openMenu')) {
			$(that).addClass('openMenu');

			if ($(window).width() > 959 || ($(window).width() < 960 && $(window).width() > $(window).height())) {
				$(this.wrappMenu).css({
					'display': 'table'
				}).animate({
					left: $('.rightSitebar').outerWidth()
				}, 300, function() {
					$(this.wrappMenu).css('zIndex', '2');
				}.bind(this));

				$(this.productCategory).animate({
					marginRight: -$(this.wrappMenu).outerWidth()
				}, 300);
			} else {
				$(this.wrappMenu).css({
					'display': 'table',
					'left': -$(this.wrappMenu).outerWidth()
				});

				$('#wrapper').animate({
					left: $(this.wrappMenu).outerWidth()
				}, 300, function() {
					$(this.wrappMenu).css('zIndex', '2');
				}.bind(this));
			}
		} else {
			this.hideMenu(that);
		}
	}
};

MainPages.prototype.hideMenu = function(that) {
	$(this.goToMenu).removeClass('openMenu');
	if ($(window).width() > 959 || ($(window).width() < 960 && $(window).width() > $(window).height())) {
		$(this.wrappMenu).css('zIndex', '-1').animate({
			right: 0,
		}, 200, function() {
			$(this.wrappMenu).hide();
		});

		$(this.productCategory).animate({
			marginRight: 0
		}, 200);
	} else {
		$(this.wrapper).animate({
			left: 0
		}, 300, function() {
			$(this.wrappMenu).css('zIndex', '2');
		}.bind(this));
	}
};

MainPages.prototype.showSubMenu = function(that) {
	if (!$(that).hasClass(this.linkSubmenu.replace('.', '')) && $(that).parent().find(this.submenu).length > 0) {


		if ($(that).parent().parent().find('.openSubmenu').length && $(that).parent().parent().find('.activeSubmenu').length) {

			if ($(that).hasClass('openSubmenu') && $(that).hasClass('openSubmenu')) {
				$(that).removeClass('openSubmenu');
				$(that).parent().find(this.submenu).removeClass('activeSubmenu').hide().css({
					'opacity': 0
				});
			} else {
				$(that).parent().parent().find('.openSubmenu').removeClass('openSubmenu');
				$(that).parent().parent().find('.activeSubmenu').removeClass('activeSubmenu').hide().css({
					'opacity': 0
				});

				$(that).addClass('openSubmenu');
				$(that).parent().find(this.submenu).addClass('activeSubmenu').show().animate({
					'opacity': 1
				}, 10);
			}
		} else {
			$(that).addClass('openSubmenu');
			$(that).parent().find(this.submenu).addClass('activeSubmenu').show().animate({
				'opacity': 1
			}, 10);
		}
	} else {
		$(that).closest(this.menu).find('.activeMenuItem').removeClass('activeMenuItem');
		$(that).addClass('activeMenuItem');
		this.hideMenu(that);
	}

};

MainPages.prototype.mainMenuPosition = function(that) {
	if ($(window).width() < 960 && $(window).width() < $(window).height()) {
		$(this.goToMenu).removeClass('openMenu');
		$(this.wrappMenu).css({
			'zIndex': '-1',
			'right': '0'
		}).hide();
		$(this.productCategory).css({
			marginRight: 0
		});

		$(this.wrapper).addClass('mobile');
		$(this.rightSitebar).addClass('mobile');
		$(this.productCategory).addClass('mobile');
		$(this.social).addClass('mobile');
		$(this.checkLang).addClass('mobile');
	} else {
		$(this.goToMenu).removeClass('openMenu');
		$(this.wrapper).css({
			left: 0
		});
		$(this.wrappMenu).css('zIndex', '-1');

		$(this.wrapper).removeClass('mobile');
		$(this.rightSitebar).removeClass('mobile');
		$(this.productCategory).removeClass('mobile');
		$(this.social).removeClass('mobile');
		$(this.checkLang).removeClass('mobile');
	}
};

MainPages.prototype.checkLanguage = function(that) {
	$(that).closest(this.checkLang).find(this.activeLang).removeClass(this.activeLang.replace('.', ''));
	$(that).addClass(this.activeLang.replace('.', ''));
};