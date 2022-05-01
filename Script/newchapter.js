//Вывод жанров в скрытый список на сайте
function AppendNewChapter(data) {
	let genre_list = document.querySelector('#new_chapter');
	for (var i = 0; i <= data.length - 1; i++) {
			genre_list.innerHTML += '<p class = "h_chapter"><a title = '+data[i].name+' href="/manga/'+data[i].href+'"">'+data[i].name.substr(0,20)+'</a></p>'
			//Шаблон шапки списка 
			chapter = data[i].chapter
			for (var g = chapter.length - 1; g >= 0; g--) {
				//Элемент списка глав
				genre_list.innerHTML += '<p class = "i_chapter"><a title = '+chapter[g].c_name+' href="/read/'+chapter[g].c_href+'"">'+chapter[g].c_name.substr(0,20)+'</a></p>'//Шаблон элемента списка 
			}
	}
}
function close_new_chapter(){//Функция скрывающия список жанров с жкрана
	let list = document.querySelector('#new_chapter');
	if(list.style.display == 'none'){
		list.style.display = 'block'
	}else{
		list.style.display = 'none'
	}
}
document.querySelector('#menunewchap').onclick = () =>{//Кнопка отображения списка жанров в меню
	close_new_chapter();
}
document.querySelector('#close_genre').onclick = () =>{//Крестик в самом списке жанров
	close_new_chapter();
}
 SendRequest('GET','/get_new_chapter')//Получени самого списка жанров
    .then(data => AppendNewChapter(data))
    .catch(err => console.log(err));