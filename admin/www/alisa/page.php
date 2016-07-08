<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alisa</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/bounceInLeft.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div id="wrapper">
	<div class="wrappMenu">
				<ul class="menu">
					<li class="itemMenu">
						<a href="#" class="linkMenu">о компани</a>
						<ul class="submenu bounceInLeft">
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">история компании</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">приемущества</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">пресса о нас</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">производство обуви</a>
							</li>
						</ul>
					</li>
					<li class="itemMenu">
						<a href="#" class="linkMenu">новости</a>
						<ul class="submenu">
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">график выставок</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">статьи</a>
							</li>
						</ul>
					</li>
					<li class="itemMenu">
						<a href="#" class="linkMenu">покупателям</a>
						<ul class="submenu">
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">как купить?</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">оплата и доставка</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">обмен и возврат</a>
							</li>
						</ul>
					</li>
					<li class="itemMenu">
						<a href="#" class="linkMenu">сотрудничество</a>
						<ul class="submenu">
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">почему мы лучше?</a>
							</li>
							<li class="itemMenu itemSubmenu">
								<a href="#" class="linkMenu linkSubmenu">условия</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		<div class="rightSitebar">
			<div class="header">
				<a href="#" class="logo"></a>
			</div>

			<nav class="pageMenu">
				<ul class="mainMenu">
					<li class="itemMainMenu">
						<a href="#" class="linkMainMenu goToMenu"></a>
					</li>
					<li class="itemMainMenu">
						<a href="#" class="linkMainMenu goToLogin"></a>
					</li>
					<li class="itemMainMenu">
						<a href="#" class="linkMainMenu gotoPhone"></a>
					</li>
					<li class="itemMainMenu">
						<a href="#" class="linkMainMenu goToBag"></a>
					</li>
				</ul>
			</nav>

			<div class="boxBottomFix">
				<ul class="checkLang">
					<li class="lang langEn">en</li>
					<li class="lang langRu activeLang">ru</li>
					<li class="lang langUa">ua</li>
				</ul>
				<ul class="social">
					<li class="boxIconSocial"><a href="#" class="socialIcon vkontakte"></a></li>
					<li class="boxIconSocial"><a href="#" class="socialIcon facebook"></a></li>
					<li class="boxIconSocial"><a href="#" class="socialIcon linkedin"></a></li>
					<li class="boxIconSocial"><a href="#" class="socialIcon instagram"></a></li>
				</ul>
			</div>
			
		</div>
		<ul class="productCategory">
			<li class="category">
				<a href="#" class="locationCategory womenBoots"></a>
				<span class="titleCategory">женская <span class="wordWrap">обувь</span></span>
			</li>
			<li class="category">
				<a href="#" class="locationCategory teenBoots"></a>
				<span class="titleCategory">Подростковая <span class="wordWrap">обувь</span></span>
			</li>
			<li class="category">
				<a href="#" class="locationCategory kidBoots"></a>
				<span class="titleCategory">Детская <span class="wordWrap">обувь</span></span>
			</li>
			<li class="category">
				<a href="#" class="locationCategory menBoots"></a>
				<span class="titleCategory">Обувь для <span class="wordWrap">рыбалки и охоты</span></span>
			</li>
		</ul>
	</div>
	<script>

	$('.category').mouseenter(function() {
		var arr = $(this).parent().find('.category');
		$.each(arr, function (index, item) {
			if (item !== this && !$(item).children().hasClass('boxOverlayCategory')) {
				$(item).prepend($('<p></p>').attr({'class': 'boxOverlayCategory'}));
				$('.boxOverlayCategory').css({'width':'100%', 'height':'100%', 'backgroundColor': '#22201d', 'opacity': 0.7, 'position':'absolute', 'top':0, 'left':0, 'zIndex':5});
			} else {
				$(this).children().remove('.boxOverlayCategory');
				$(item).css({'opacity': 1});
			}
			
		}.bind(this));	
	});

	$('.productCategory').mouseleave(function() {
		$(this).children().css({'opacity': 1});
		$(this).find('.boxOverlayCategory').remove('.boxOverlayCategory');
	});

	</script>
</body>
</html>