window.onload = () =>{
	load();
    SendRequest('GET','/genre')
    .then(data => AppendGenre(data))
    .catch(err => console.log(err));
}
page = 1
//Вызов метода погрузки манги и вызов загрузки списка жанров
function  load() {//Функция запроса манги с сервера
	SendRequest('GET','/load_bookmark/' + page)
	.then(data => AppendManga(data))
	.catch(err => console.log('Нет больше закладок'));
}

function AppendManga(data) {//Функция добавления подгруженной манги
	let block = document.querySelector('#manga_grid');
 	for (var i = 0; i <= data.length - 1; i++) {
 		block.innerHTML += 
 		`
 			<div class="manga_card">
                    <div class="manga_card_img">
                        <img loading="lazy" src="`+data[i].img+`" alt="">
                    </div>
                    <div class="manga_card_name">
                        <a href="manga/`+data[i].href+`" title = '`+data[i].name+`'>
                        	`+data[i].name.substr(0, 24)+`
                       </a>
                </div>
            </div> 
 		`
 	}

}

document.querySelector('#button_block').onclick = () =>{//Кнопка еще на страницы
    page = page+1;
    load();
}