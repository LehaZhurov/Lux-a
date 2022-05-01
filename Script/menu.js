let text_block = document.querySelectorAll('.inviz_text_menu');//Все блоки которые нужно скрыть в меню


function display_none_menu(){//Функция скрывающия нужные поля в меню.Методом перебора их
	for (var i = text_block.length - 1; i >= 0; i--) {
		// text = text_block[i].style.display;
		if(text_block[i].style.display === 'none'){
			text_block[i].style.display = 'block';
		}else{
			text_block[i].style.display = 'none';
		}
	}
}

document.querySelector('#menu_but').onclick = () => {display_none_menu()};//Кнопка для отображения и скрытия меню