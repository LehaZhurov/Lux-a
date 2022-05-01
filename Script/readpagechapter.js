query = document.location.href//Текущий URL
//Вывод жанров в скрытый список на сайте
function AppendChapter(data) {
	let genre_list = document.querySelector('#chapter');
	for (var i = 0; i <= data.length - 1; i++) {
		//Проверка какая глава что бы выделдить активную
		if(data[i].href == query.split('/')[4] +"/"+query.split('/')[5]){
			// g = i + 1
			// if(data[g].name){//Проверка есть следующий элемент
			// 	data[g].name = data[g].name + ' Следующия'//Если он есть до добавить к нему приписку
			// }
			//Выввод блока с выделением , говорящем о том что это активная глава
			genre_list.innerHTML += '<p><a style = "color:var(--body-color)" href="/read/'+data[i].href+'"">'+data[i].name+'</a></p>'//Шаблон элемента списка 
		}else{
			genre_list.innerHTML += '<p><a href="/read/'+data[i].href+'"">'+data[i].name+'</a></p>'//Шаблон элемента списка 
		}
	}
}
function chapter_close(){//Функция скрывающия список глав с Экрана
	let list = document.querySelector('#chapter');
	if(list.style.display == 'none'){
		list.style.display = 'block'
	}else{
		list.style.display = 'none'
	}
}
document.querySelector('#close_chapter').onclick = () =>{//Крестик в самом списке глав
	chapter_close();
}
 SendRequest('GET','/chapter/'+name)//Получени самого списка глав
    .then(data => AppendChapter(data))
    .catch(err => console.log(err));


//Вызов метода для добавления в историю
window.onload = () =>{
	AppendInHistory();
	console.log('Добавление в историю')
}