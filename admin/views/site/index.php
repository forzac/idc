<form class="formWrapp"  novalidate>
	<input type="email" class="textField" required pattern="email" title="Email" placeholder="Ваш Email">
	<input type="password" class="textField" required pattern="password" title="Password" placeholder="Ваш пароль">
	<input type="password" class="textField confirm" disabled required title="Confirm password" placeholder="Подтвердите пароль">
	<input type="checkbox" class="checkField" required title="Checkbox">
	<input type="radio" name="name" value="1" class="radioField" required title="Radio"/>
	<input type="radio" name="name" value="2" class="radioField" required title="Radio"/>
	<input type="radio" name="name" value="3" class="radioField" required title="Radio"/>
	<input type="radio" name="name" value="4" class="radioField" required title="Radio"/>
	<input type="radio" name="name" value="5" class="radioField" required title="Radio"/>
	<input type="radio" name="name2" class="radioField" id="radio" title="Radio2"/>
	<input type="radio" name="name2" class="radioField" id="radio" title="Radio2"/>
	<input type="radio" name="name2" class="radioField" id="radio" title="Radio2"/>
	<input type="file" name="f" class="fileField" multiple accept="image/*" required>
	<textarea name="" rows="5" class="textAreaField" required pattern="textarea" placeholder="Ваше сообщение"></textarea>
	
	<select class="selectField" required title="Selected">
		<option value="0" selected="selected">выберите текст</option>
		<option value="key1">Какой-то текст №1</option>
		<option value="key2">Какой-то текст №2</option>
		<option value="key3">Какой-то текст №3</option>
		<option value="key4">Какой-то текст №4</option>
		<option value="key5">Какой-то текст №5</option>
		<option value="key6">Какой-то текст №6</option>
	</select>

	<select class="selectField">
		<option value="cant_select" selected="selected">выберите какой именно</option>
		<option value="k1">Option-1</option>
		<option value="k2">Option-2</option>
	</select>

	<input type="reset" class="customBtn" value="Очистить" />
	<input type="submit" class="submitBtn" value="Отправить" />
</form>

<link rel="stylesheet" type="text/css" href="/css/stylesGrid.css" />
<script src="/scripts/grid.js"></script>
<div>
<table name='grid' class="grid">
	<h1>Settings</h1>
	<thead>
		<tr class="addNewField">
			<td class="optionName">Создание новой опции</td>
			<td>
				<div class="boxOptionFields">
					<div class="optionField">
						<label for="textField">Text</label>
						<input name="field" type="radio" id="textField" value="T">
					</div>
					<div class="optionField">
						<label for="selectField">Select</label>
						<input name="field" type="radio" id="selectField" value="S">
					</div>
				</div>
			</td>
			<td><span type="" class="newRow iconFontWs">&#192;</span></td>
		</tr>
		<tr>
			<th class="optionName">Опция</th>
			<th class="valOption">Значение</th>
			<th class="removeBlock"></th>
		</tr>
	</thead>
	 <tbody>
    <tr class="editableFields">
        <td class="optionName" type="text" fieldvalue="textkey1">
            <div class="cellVal">textkey1</div>
        </td>
        <td class="valOption" fieldvalue="textvalue1" optionval="" type="text">
            <div class="cellVal">textvalue1</div>
        </td>
        <td class="removeBlock"><span class="removeRow iconFontWs">Ì</span></td>
    </tr>
    <tr class="editableFields">
        <td class="optionName" type="text" fieldvalue="keyselect">
            <div class="cellVal">keyselect</div>
        </td>
        <td class="valOption" fieldvalue="v" optionval="{&quot;k&quot;:&quot;v&quot;}" type="select">
            <div class="cellVal">v</div>
        </td>
        <td class="removeBlock"><span class="removeRow iconFontWs">Ì</span></td>
    </tr>
    </tbody>
</table>
</div>
<hr/>
<div>
<table name='grid2' class="grid2">
	<h1>Settings</h1>
	<thead>
		<tr class="addNewField">
			<td class="optionName">Создание новой опции</td>
			<td>
				<div class="boxOptionFields">
					<div class="optionField">
						<label for="textField">Text</label>
						<input name="field" type="radio" id="textField" value="T">
					</div>
					<div class="optionField">
						<label for="selectField">Select</label>
						<input name="field" type="radio" id="selectField" value="S">
					</div>
				</div>
			</td>
			<td><span type="" class="newRow iconFontWs">&#192;</span></td>
		</tr>
		<tr>
			<th class="optionName">Опция</th>
			<th class="valOption">Значение</th>
			<th class="removeBlock"></th>
		</tr>
	</thead>
	 <tbody>
    <tr class="editableFields">
        <td class="optionName" type="text" fieldvalue="textkey1">
            <div class="cellVal">textkey1</div>
        </td>
        <td class="valOption" fieldvalue="textvalue1" optionval="" type="text">
            <div class="cellVal">textvalue1</div>
        </td>
        <td class="removeBlock"><span class="removeRow iconFontWs">Ì</span></td>
    </tr>
    <tr class="editableFields">
        <td class="optionName" type="text" fieldvalue="keyselect">
            <div class="cellVal">keyselect</div>
        </td>
        <td class="valOption" fieldvalue="v" optionval="{&quot;k&quot;:&quot;v&quot;}" type="select">
            <div class="cellVal">v</div>
        </td>
        <td class="removeBlock"><span class="removeRow iconFontWs">Ì</span></td>
    </tr>
    </tbody>
</table>
</div>




<link rel="stylesheet" type="text/css" href="/css/informBox.css" />
<script src="/scripts/informBox.js"></script>

<div class="boxInfo">
	<div class="boxVisiblePart">
		<span class="icon iconFontAs"></span>
		<span class="messageText"></span>
	</div>
	<div class="boxRemove iconFontWs">&#204;</div>
</div>

<div class="showBoxInfo">Блок Инфо</div>









<link rel="stylesheet" type="text/css" href="/css/modal.css">
<script src="/scripts/modal.js"></script>

<div class="showModal">Модальное окно</div>
<div id="chel">
    <button class="getDomID">Узнать</button>
    <br />
    <p>a chel prishel</p>
    <p>b nachal pizdet</p>
</div>

<div id="textBlock">
    <span>adfasddasdasdasdasdasdsa</span>
    <br />
    <span>adfasddasdasdasdasdasdsa</span>
    <br />
    <ul>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
        <li>aasdsadasda asdsad asdas dasd as das dsa das da</li>
    </ul>
    <b>asdsadsa asdas asd sa a</b>
    <div>sadadas asd asd asdasdasd as dsad asdasdsadasdas dsa d</div>
</div>
<style>
::-moz-selection { /* Code for Firefox */
    background: #70FF00;
    color: firebrick;
}

::selection {
    background: #70FF00;
    color: firebrick;
}
</style>

<script type="text/javascript">
    $(document).mouseup(function(){
        
        
        //console.log(getSelection())
    });
    $(document).ready(function(){
        $(".getDomID").click(function(){
            /*console.log($("*"));
            console.log($("*").index($(this).parent()));  */
            
            parents1 = $(this).parents();
            parents2 = $("#textBlock").parents();
            
            console.log(parents1.eq(1)); 
            console.log(parents2.eq(1)); 
            
            if(parents1[0] == parents2[0])
                alert('asdsa');        
        });    
    })
    
    
    // функция для получение выделенного текста
    function getSelectedText(){
        return window.getSelection();
        var text = "";
        if (window.getSelection) {
            text = window.getSelection();
        }else if (document.getSelection) {
            text = document.getSelection();
        }else if (document.selection) {
            text = document.selection.createRange().text;
        }
        return text;
    }
    //И пример использования функции, при нажатии Ctrl + Enter:
    
    // пример использования
    $(document).ready(function() {
        // при нажатии на Ctrl + Enter
        var isCtrl = false;
        $(document).keyup(function (e) {            
            if(e.which == 17) isCtrl = false;
        }).keydown(function (e) {
            if(e.which == 17) isCtrl=true;
            if(e.which == 13 && isCtrl == true) {
                // получаем и показываем выделенный текст
                console.log(getSelectedText());
            }
        });
    });
    
    function getParentDom(parent, parents){
        if(parent.parent()[0].tagName){
            parents = getParentDom(parent.parent(),parents);               
        }
        parents.push(parent);
        return parents
    }

</script>