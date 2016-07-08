
$(document).ready(function() {
	var firstGrid = new Grid({nameGrid: '.grid'});
	var secondtGrid = new Grid({nameGrid: '.grid2'});
});

function Grid(option) {
	this.nameGrid = option.nameGrid;
	this.emptyField = false;

	this.events();
}

Grid.prototype.events = function() {
	var that = this;
	$('body').on('click', '.newRow', this.newRow.bind(this));
	$('body').on('click', 'table tr.editableFields td', function(){that.changeTheValue(this);});
	$('body').on('dblclick', 'table'+ this.nameGrid +' tr.editableFields td[type="select"]', function(){that.updatingOption(this);});
	$('body').on('focusout', 'table'+ this.nameGrid +' tr.editableFields td input', function(){that.changeField(this);});
	$('body').on('focusout', 'table'+ this.nameGrid +' tr.editableFields td select', function(){that.changeField(this);});
	$(this.nameGrid).find($('.addNewField :radio')).on('change', this.newSelectField);
};

Grid.prototype.changeTheValue = function(element, e) {
	if ($(this.nameGrid).find('.edit').length) {
		$(this.nameGrid).find('.newSeleOption').css({"backgroundColor":"pink"}).focus();
		alert('У Вас уже редактируется поле');
		return false;
	}
	if ($(element).hasClass('active') || $(element).find('input').length || $(element).find('select').length) {
		return false;
	} else if ( ($(this.nameGrid).find('tbody').find('input').length || $(this.nameGrid).find('tbody').find('select').length) && !$(element).children().hasClass('removeRow') ) {
		$(this.nameGrid).find('tbody').find('input').css({"backgroundColor": "pink"}).focus();
		$(this.nameGrid).find('tbody').find('select').css({"backgroundColor": "pink"}).focus();
		alert("У Вас уже открыто редактируемое поле. Сохраните его и сможете продолжить");
		return false;
	} else {
		$(element).children('.cellVal').text('');
		if ($(element).attr('type') === 'text') {
			$(element).append('<input type="text" placeholder="Введите значение" value="'+ $(element).attr('fieldValue') +'" />');
			$(element).children('input').focus();
			$(element).addClass('active');

		} else if ($(element).attr('type') === 'select') {
			this.generateSelect($(element), $(element).attr('optionVal'));
			$.each($(element).find('option'), function (i, item) {
				if ($(item).text() === $(element).attr('fieldValue')) {
					$(item).attr({"selected":"selected"});
				}
			}.bind(element));
		}
		else if ($(element).children().hasClass('removeRow')) {
			//
				/* For AJAX Request */
			//
			$(element).parent().remove();
		}
	}
};

Grid.prototype.changeField = function(element) {

	this.fieldVal = $(element).val();
	this.selectVal = $(element).find('option:selected').text();

	if ($(element)[0].localName === 'input') {
		
		if($(element).parent().parent().find('.removeRow').is(":hover")) {
			return	false;
		}
		
		if (this.fieldVal === '') {
			$(element).css({"backgroundColor": "pink"});
			alert("Значение не может быть пустым");
			$(element).focus();
			this.emptyField = true;
			return	false;
		}

		$(element).parent().children('.cellVal').text(this.fieldVal);
		$(element).parent().attr('fieldValue', this.fieldVal);
		$(element).parent().removeClass('active');
		this.emptyField = false;


	} else if ($(element)[0].localName === 'select' && this.emptyField === false) {
		
		$(element).parent().children('.cellVal').text(this.selectVal);
		$(element).parent().attr('fieldValue', this.selectVal);
		$(element).parent().removeClass('active');
	}

	if ($(element).parent().hasClass('optionName') && $(element).parent().parent().attr('isnew') === 'true' && this.emptyField === false) {
		this.generateValOption();
	}

	if ($(element).parent().hasClass('valOption') && $(element).parent().parent().attr('isnew') === 'true' && this.emptyField === false) {
		$(element).parent().parent().removeAttr('isnew');
		//
		/* For AJAX Request */
		//
	}
	$(element).remove();
	$(this.nameGrid).find('tbody').find('td').find('input').focus();
	$(this.nameGrid).find('tbody').find('td').find('select').focus();
	
};

Grid.prototype.newRow = function() {
	if (!$(this.nameGrid).find('input:radio:checked').length) {
		$(this.nameGrid).find('.newSeleOption').remove();
		return	false;
	}
	this.row = $('<tr>').attr({"class": "editableFields", "isnew":true});
	this.tdOptionName = $('<td>').attr({"class": "optionName", 'type':"text", "fieldValue":""});
	this.optionNameCellVall = $('<div>').attr({"class": "cellVal"});
	this.optionNameInput = $('<input>').attr({"type": "text", "placeholder":"Введите название Опции"});
	this.tdValOption = $('<td>').attr({"class": "valOption", "fieldValue":"", 'optionVal':""});
	this.valOptionCellVall = $('<div>').attr({"class": "cellVal"});
	this.removeBlock = $('<td>').attr({"class": "removeBlock"});
	this.removeRow = $('<span>').attr({"class": "removeRow iconFontWs"}).html('&#204;');
	this.typeRow = $(this.nameGrid).find('input:radio:checked').val();
	
	if ($(this.nameGrid).find('input:radio:checked').hasClass('updating')) {
		$(this.element).children('.cellVal').text('');
		this.generateSelect($(this.element), $('.newSeleOption').val());
		$(this.element).removeClass('edit').addClass('active');
		$(this.nameGrid).find('input:radio:checked').removeClass('updating');
		$(this.nameGrid).find('input:radio:checked').removeAttr('checked');
		$(this.nameGrid).find('.newSeleOption').remove();
		return false;
	}

	if ($(this.nameGrid).find('tbody').find('input').length || $(this.nameGrid).find('tbody').find('select').length) {
		alert("У Вас уже открыто редактируемое поле. Сохраните его и сможете продолжить");
		return false;
	}
	
	if (this.typeRow) {
		this.newRow = this.row.append(this.tdOptionName.append(this.optionNameCellVall).append(this.optionNameInput)).append(this.tdValOption.append(this.valOptionCellVall)).append(this.removeBlock.append(this.removeRow));
		
		if (this.typeRow === 'T') {
			this.tdValOption.attr({"type":"text"});
		} else if (this.typeRow === 'S') {	
			try {
				JSON.parse($('.newSeleOption').val());
				this.tdValOption.attr({"type":"select", 'optionval': $('.newSeleOption').val()});
			} catch (e){
				alert('Неверный формат данных');
				return false;
			}
		}
		$(this.nameGrid).find($('tbody')).append(this.newRow);
		$(this.optionNameInput).focus();
		
	} else {
		alert('Выбери тип поля');
	}

	$(this.nameGrid).find('input:radio:checked').removeAttr('checked');

	if (!$(this.nameGrid).find('input:radio:checked').length) {
		$(this.nameGrid).find('.newSeleOption').remove();
	}
};

Grid.prototype.generateValOption = function () {
	if (this.tdValOption.attr("type") === 'text') {
		this.tdValOption.append($('<input>').attr({"type":"text", "placeholder":"Введите значение"}));
	} else if (this.tdValOption.attr("type") === 'select') {
			this.generateSelect(this.tdValOption, this.tdValOption.attr('optionval'));
	}
	
};

Grid.prototype.generateSelect = function (obj, dataOption) {
	try {
		var options = JSON.parse(dataOption);
		if (Object.keys(options).length > 0) {
			obj.attr({"type":"select", "optionVal":dataOption}).append($('<select>'));	

			$.each(options, function(key, val) {
				if (key === '' || val === '') {
					alert('Значения не могут быть пустыми');
					return false;
				}
				if (key !== '' && val !== '') {
					obj.children('select').append($('<option value="' + key + '">' + val + '</option>'));
				}
			});

			$(obj).find('select').focus();
		} else {
			alert('Введите данные');
			return false;
		}
		
	} catch (e){
		alert('Неверный формат данных');
		return false;
	}
	
};

Grid.prototype.updatingOption = function(element) {
	this.element = element;
	if ($(this.nameGrid).find('input:radio:checked').length) {
		$(this.nameGrid).find('input:radio:checked').removeAttr('checked');
		$(this.nameGrid).find('.newSeleOption').remove();
	}
	
	if ($(this.nameGrid).find('.updating').length) {
		return	false;
	} else {
		$(this.element).removeClass('active').addClass('edit');
		$(this.nameGrid).find('input#selectField').addClass('updating').click();
		$(this.nameGrid).find('.newSeleOption').attr('value', $(this.element).attr('optionval'));
	}
};

Grid.prototype.newSelectField = function() {
	this.parentNewOption = $(this).parent().parent().parent();
	if ($(this).val() === 'S') {
		var fieldWidth = this.parentNewOption.width() - $(this).parent().parent().width();
		this.parentNewOption.append($('<input type="text" class="newSeleOption" value="" placeholder="Введите значения option" />').css({"width":fieldWidth}));
		this.parentNewOption.find('.newSeleOption').focus();
	} else {
		if (this.parentNewOption.find('.newSeleOption').length) {
			this.parentNewOption.find('.updating').removeClass('updating');
			this.parentNewOption.find('.newSeleOption').remove();
		} else {
			return false;
		}
	}
};



//{"0" : "для всех" , "1":"не для всех", "2" : "2" , "3":"3"}