
//Вывод жанров в скрытый список на сайте
function AppendGenre(data) {
	let genre_list = document.querySelector('#genre');
	for (var i = 0; i <= data.length - 1; i++) {
		genre_list.innerHTML += '<p><a href="/genre/'+data[i].href+'"">'+data[i].name+'</a></p>'//Шаблон элемента списка 
	}
}
function close_genre(){//Функция скрывающия список жанров с жкрана
	let list = document.querySelector('#genre');
	if(list.style.display == 'none'){
		list.style.display = 'block'
	}else{
		list.style.display = 'none'
	}
}
document.querySelector('#menulist').onclick = () =>{//Кнопка отображения списка жанров в меню
	close_genre();
}
document.querySelector('#close_genre').onclick = () =>{//Крестик в самом списке жанров
	close_genre();
}
 SendRequest('GET','/genre')//Получени самого списка жанров
    .then(data => AppendGenre(data))
    .catch(err => console.log(err));