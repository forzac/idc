$(document).ready(function() {
	var topInfoWindow = new InfoMessage('E', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0);
	$('.boxRemove').on('click', function() {
		topInfoWindow.hideWindow();
	});
	$('.showBoxInfo').on('click', function() {
		topInfoWindow.showWindow();
	});

});

function InfoMessage(typeWindow, messageWindow, autohideWindow) {
	this.typeWindow = typeWindow;
	this.messageWindow = messageWindow;
	this.autohideWindow = autohideWindow;
	this.hideBox;
	this.errorFlag = false;

	if (this.typeWindow === 'I' || this.typeWindow === 'N' || this.typeWindow === 'E') {
		$('.boxInfo').css({
			marginTop: -($('.boxInfo').outerHeight() + $('.boxRemove').outerHeight())
		});
		if (this.typeWindow === 'I') {
			$('.boxInfo').addClass('ifo').find('.icon').html('&#xf05a;');
			$('.boxInfo .boxRemove').css({'backgroundColor': $('.boxInfo.ifo').css('backgroundColor')});
		} else if (this.typeWindow === 'E') {
			$('.boxInfo').addClass('error');
			$('.boxInfo').addClass('ifo').find('.icon').html('&#xf06a;');
			$('.boxInfo .boxRemove').css({'backgroundColor': $('.boxInfo.error').css('backgroundColor')});
		} else if (this.typeWindow === 'N') {
			$('.boxInfo').addClass('noErron');
			$('.boxInfo').addClass('ifo').find('.icon').html('&#xf078;');
			$('.boxInfo .boxRemove').css({'backgroundColor': $('.boxInfo.noErron').css('backgroundColor')});
		}
		$('.boxInfo').find('.messageText').text(messageWindow);
		$('.boxInfo .boxRemove').css({'borderRadius': $('.boxInfo .boxRemove').css('fontSize'), 'marginLeft': -parseInt($('.boxInfo .boxRemove').css('fontSize').replace('px', ''))/2});
	} else {
		this.errorFlag = true;
	}

	this.styleWindow = function() {
		if (this.typeWindow === 'I' || this.typeWindow === 'N' || this.typeWindow === 'E') {
			$('.boxInfo').css({
				marginTop: -($('.boxInfo').outerHeight() + $('.boxRemove').outerHeight())
			});
			if (this.typeWindow === 'I') {
				$('.boxInfo').addClass('ifo');
			} else if (this.typeWindow === 'E') {
				$('.boxInfo').addClass('error');
			} else if (this.typeWindow === 'N') {
				$('.boxInfo').addClass('noErron');
			}
			$('.boxInfo').find('.messageText').text(messageWindow);
		} else {
			return false;
		}
	};

	this.hideWindow = function() {
		clearTimeout(this.hideBox);
		$('.boxInfo').stop().animate({
			marginTop: -($('.boxInfo').outerHeight() + $('.boxRemove').outerHeight())
		}, 1000);
	};

	this.showWindow = function() {
		clearTimeout(this.hideBox);
		if (this.errorFlag) {
			return false;
		}
		$('.boxInfo').css({
			marginTop: -($('.boxInfo').outerHeight() + $('.boxRemove').outerHeight())
		});
		$('.boxInfo').show().stop().animate({
			marginTop: '0'
		}, 1000);

		if (parseFloat(this.autohideWindow) !== 0) {
			this.hideBox = setTimeout(function() {
				$('.boxInfo').stop().animate({
					marginTop: -($('.boxInfo').outerHeight() + $('.boxRemove').outerHeight())
				}, 1000);
			}, parseFloat(this.autohideWindow) * 1000);
		}
	};

}