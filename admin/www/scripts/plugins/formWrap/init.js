$(document).ready(function() {

	$('form.formWrapp').each(function(key, elem) {
		var formwrapp = new FormWrapp();
		formwrapp.init($(elem));
	});

	$(document).on('click', '.select_view', function() {
		if ($(this).parent().hasClass('active') == true) {
			$(this).parent().removeClass('active');
			$(this).parent().children('.select_drop').slideUp(300);
		} else {
			$(this).parent().addClass('active');
			$(this).parent().children('.select_drop').slideDown(300);
		}

		var arrSelects = $(".select_view");
		for (var j = 0; j < arrSelects.length; j++) {
			if ($(this).is(arrSelects[j]) == false) {
				$(arrSelects[j]).parent().removeClass('active');
				$(arrSelects[j]).parent().children('.select_drop').slideUp(300);
			}
		}
	});
	$(document).on('click', '.select_drop ul li', function() {
		$(this).parent().children('li').removeClass('selected');
		$(this).addClass(' selected');

		var sel_option = $(this).attr('option');
		var sel_text = $(this).text();
		$(this).parent().parent().parent().children('.selectField').children('option').removeAttr('selected');
		$(this).parent().parent().parent().children('.selectField').children('option[value=' + sel_option + ']').attr('selected', 'selected');
		$(this).parent().parent().parent().children('.select_view').children('.select_text').html(sel_text);

		$(this).parent().parent().parent().removeClass('active');
		$(this).parent().parent('.select_drop').slideUp(300);

		$(this).parent().parent().parent().children('.selectField').change();

	});

	$(document).on('click', function(event) {
		if ($(event.target).closest(".selectBox").length)
			return;
		$(".selectBox").removeClass('active');
		$(".selectBox").children('.select_drop').slideUp(300);
		event.stopPropagation();
	});

});

function FormWrapp() {
	this.radioArr = {};
	this.generateId = function(title) {
		if (!title) {
			title = "";
		}
		return Math.round(new Date().getTime() / parseInt(Math.random() * 1000000)) + title;
	};

	this.init = function(form) {

		$.each(form.children(), function(key, elem) {
			this.wrappField($(elem));
		}.bind(this));

		form.children().wrapAll('<div class="mainBoxForm"></div>');
	};

	this.wrappField = function(field) {
		fieldId = this.generateId('field');
		if (field.hasClass('textField') || field.hasClass('checkField') || field.hasClass('textAreaField')) {
			field.attr('id', fieldId);
			$(field).wrap('<div class="fieldBoxForm" type="' + $(field).attr('type') + '"></div>');
			$('<label for="' + fieldId + '">' + field.attr('title') + '</label>').insertBefore(field);
			$('<div class="errorBox"><p></p></div>').insertAfter(field);
			// console.log(field.attr('title') === undefined);

		} else if (field.hasClass('radioField')) {

			if (this.radioArr[field.attr('name')] == 1) {
				field.insertAfter($('.fieldBoxForm :radio[name="' + field.attr('name') + '"]:last '));
			} else {
				this.radioArr[field.attr('name')] = 1;
				$(field).wrap('<div class="fieldBoxForm" type="' + $(field).attr('type') + '"></div>');
				$('<label>' + field.attr('title') + '</label>').insertBefore(field);
				$('<div class="errorBox"><p></p></div>').insertAfter(field);
			}

		} else if (field.hasClass('fileField')) {

			field.attr('id', fieldId);
			field.css('display', 'none');
			$(field).wrap('<div class="fieldBoxForm" type="' + $(field).attr('type') + '"></div>');
			$('<label for="' + fieldId + '">Загрузка файла</label>').insertBefore(field);
			$('<label for="' + fieldId + '" class="fileImitation"><span class="fileBtn">выбери файл</span> <span class="fileName">ФАЙЛ НЕ ВЫБРАН</span> </label>').insertBefore(field);

		} else if (field.hasClass('submitBtn') || field.hasClass('customBtn') || field.hasClass('btn')) {
			return false;
		} else if (field.hasClass('selectField')) {
			field.attr('id', fieldId);
			$(field).wrap('<div class="fieldBoxForm"></div>').wrap('<div class="selectBox"></div>');
			field.attr('id', fieldId);
			$('<label for="' + fieldId + '">' + field.attr('title') + '</label>').insertBefore(field);
			$('<div class="errorBox"><p></p></div>').insertAfter(field);
			sel_text = $(field).children("option:selected").html();
			sel_perem = "";
			select_html = '<div class="select_view"><span class="select_text">' + sel_text + '</span><span class="select_triangle"></span></div><div class="select_drop"><ul>';
			
			arr_options = $(field).children("option");
			for (var i = 0; i < arr_options.length; i++) {
				if ($(arr_options[i]).is(':selected') == true) {
					sel_perem = "selected";
				} else {
					sel_perem = "";
				}
				select_html = select_html + '<li option="' + $(arr_options[i]).val() + '" class="' + sel_perem + '">' + $(arr_options[i]).html() + '</li>';
			}
			select_html = select_html + '</ul></div>';
			$(select_html).insertAfter($(field));
			$('.select_drop').css('left', $(field).parent().find('label').width());
		}

		if ($(field).attr('required')) {
			$(field).parent().attr('required', 'true');
			$(field).removeAttr('required');
		}
		if ($(field).attr('pattern')) {
			$(field).parent().attr('pattern', $(field).attr('pattern'));
			$(field).removeAttr('pattern');
		}
		if (field.attr('title') === undefined) {
			if (!field.hasClass('fileField')) {
				$(field).parent().find('label').html(" &nbsp ");
			} else {
				return false;
			}
		}

	};

}