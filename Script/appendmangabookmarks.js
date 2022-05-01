name = document.location.href;
name = name.split('/')[4]
//Функция добавления манги в закладки
document.querySelector('#bookmark').onclick = () =>{
	SendRequest('GET','/set_bookmark/'+name)
    .then(data => console.log(data))
    .catch(err => console.log(err));
    RemoveButBookmarks();
}
//Проверка естли данная манга в закладках
SendRequest('GET','/check_bookmarks/'+name)
    .then(data => RemoveButBookmarks())
    .catch(err => console.log("Не в закладках"));

//Функция для замены кнопки дабавления на кнопку удалени
function RemoveButBookmarks() {
	let but = document.querySelector('#bookmark');
	but.innerText = 'Удалить'
	but.style.backgroundColor = '#202020';
	but.style.color = '#E8E8E8';
	//Функция удаления манги из закладок
	but.onclick = () =>{
		SendRequest('GET','/delete_bookmark/'+name)
    	.then(data => RemoveButDelete())
    	.catch(err => console.log(err));
	}
}

function RemoveButDelete() {
	let but = document.querySelector('#bookmark');
	but.innerText = 'В закладки'
	but.style.backgroundColor = 'var(--body-color)';
	but.style.color = 'var(--sidebar-color)';
	but.onclick = () =>{
		SendRequest('GET','/set_bookmark/'+name)
    	.then(data => console.log(data))
    	.catch(err => console.log(err));
    	RemoveButBookmarks();
	}
}

document.querySelector('#read').onclick = () =>{
	document.location.href = document.querySelectorAll('.chapter_item')[document.querySelectorAll('.chapter_item').length-1].childNodes[1].childNodes[0].href;
	console.log('Редирект');
}

