window.onload = () =>{
	load();
    SendRequest('GET','/genre')
    .then(data => AppendGenre(data))
    .catch(err => console.log(err));
}
//Вызов подгрузки результатов поиска и запрос жанров для списка

let page,query;
page = 2;//Страница 
query = document.location.search//Текущий URL
query = new URLSearchParams(query)
query = query.get('query')//Получение поискового запроса для подгрузки
function  load() {//Функция подгрузки результатов поиска
	SendRequest('GET','/load_search/'+query+'/'+page)
	.then(data => AppendManga(data))
	.catch(err => console.log(err));
}

function AppendManga(data) {//Функция добавления результатов подгрузки найденной манги
	let block = document.querySelector('#manga_grid');//Блок куда будут добавлены блоки
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

document.querySelector('#button_block').onclick = () =>{//Кнопка ёще на странице результата поиска
    page = page+1;
    load();
}