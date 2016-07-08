$(document).ready(function() {
	var param = {
		widthModal: '500',
		heightModal: '300',
		scroll: true,
		activePanel: true,
		titleModalText: 'Заголовок',
		modalContents: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga doloribus nam laudantium fugiat sequi, possimus, beatae similique eligendi nulla pariatur modi aliquam natus! A adipisci esse unde, aliquam optio nam.'
	};

	var param2 = {
		widthModal: '300',
		heightModal: '400',
		scroll: true,
		activePanel: true,
		titleModalText: 'Заголовок2',

	};

	$('.showModal').on('click', function() {
		(new ModalWindow).showModal(param);
		(new ModalWindow).showModal(param2);
	});

});

function ModalWindow() {

	this.widthModal = 600;
	this.heightModal = 300;
	this.scroll = false;
	this.activePanel = true;
	this.titleModalText = 'Это заголовок';
	this.save = function() {
		return false;
	};
	this.close = function() {
		return false;
	};
	this.themeCss = 'default';
	this.modalContents = 'This content text';

	this.generateId = function(title) {
		return Math.round(new Date().getTime() / parseInt(Math.random() * 1000000)) + title;
	};

	this.events = function(obj) {
		$(document).on('click', '#' + obj + ' .saveModal', this._save.bind(this));
		$(document).on('click', '#' + obj + ' .closeModal', this._close.bind(this));
		$(document).on('click', '#' + obj + ' .overlayModal', this._close.bind(this));
	};

	this.init = function(param) {
		$.each(param, function(key, val) {
			if (typeof(this[key]) !== 'undefined') {
				this[key] = val;
			}
		}.bind(this));

	};

	this.createDomWindow = function() {
		this.mainModal = $('<div>').attr({
			'class': 'modal',
			'id': this.generateId('modal')
		});
		this.overlayModal = $('<div>').attr({
			'class': 'overlayModal'
		});
		this.boxModal = $('<div>').attr({
			'class': 'boxModal'
		});
		this.headerModal = $('<div>').attr({
			'class': 'headerModal'
		});
		this.titleModal = $('<div>').attr({
			'class': 'titleModal'
		});
		this.iconTitle = $('<div>').attr({
			'class': 'iconTitle'
		});
		this.titleText = $('<p>').attr({
			'class': 'title'
		});
		this.controlModal = $('<div>').attr({
			'class': 'controlModal'
		});
		this.boxControlRefresh = $('<div>').attr({
			'class': 'boxControl'
		});
		this.refresh = $('<div>').attr({
			'class': 'refresh'
		});
		this.boxControlSave = $('<div>').attr({
			'class': 'boxControl'
		});
		this.saveModal = $('<div>').attr({
			'class': 'saveModal'
		});
		this.boxControlClose = $('<div>').attr({
			'class': 'boxControl'
		});
		this.closeModal = $('<div>').attr({
			'class': 'closeModal'
		});
		this.contentModal = $('<div>').attr({
			'class': 'contentModal'
		});
		return this.mainModal.append(this.boxModal.append(this.headerModal.append(this.titleModal.append(this.iconTitle).append(this.titleText)).append(this.controlModal.append(this.boxControlRefresh.append(this.refresh)).append(this.boxControlSave.append(this.saveModal)).append(this.boxControlClose.append(this.closeModal)))).append(this.contentModal)).append(this.overlayModal);

	};

	this.styleModalWindow = function() {
		$(this.boxModal).css({
			width: this.widthModal,
			height: this.heightModal,
			marginTop: -this.heightModal / 2,
			marginLeft: -this.widthModal / 2
		});
		$(this.titleText).text(this.titleModalText);
		$(this.iconTitle).addClass('iconFontWs').html('&#0047;');
		$(this.refresh).addClass('iconFontWs').html('&#0087;');
		$(this.saveModal).addClass('iconFontWs').html('&#244;');
		$(this.closeModal).addClass('iconFontWs').html('&#204;');
		$(this.contentModal).html(this.modalContents);
		if (this.scroll === false) {
			$(this.contentModal).css({
				overflow: 'hidden'
			});
		} else {
			$(this.contentModal).css({
				overflow: 'auto'
			});
		}
		if (this.activePanel === false) {
			$(this.controlModal).css({
				display: 'none'
			});
			$(this.titleModal).css({
				width: '100%'
			});
		}
	};

	this.showModal = function(param) {
		this.init(param);
		var obj = this.createDomWindow();
		this.styleModalWindow();
		$('body').append(obj);
		this.events($(obj).attr('id'));

	};

	this._close = function() {
		this.close();
		$(this.mainModal).remove();
	};

	this._save = function() {
		this.save();
	};

}