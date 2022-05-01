<?
/**
 * 
 */
class MBScrabber
{
	
	function __construct()
	{
		require("simple_html_dom.php");
	}
	//Послдение обновления манги с главной страницы MangaBook
	public function GetLastUpdateManga()
	{	
		$url_page = 'https://mangabook.org/';//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach($scrabber->find('div.floats article.short') as $manga){//Берем все блоки в классом short
			foreach($manga->find('div.sh-title') as $name){
				$data[$i]['name'] = $name->plaintext;//Пербераем все имена и сохроняем в массив
			}
			foreach($manga->find('a.short-poster') as $a){//Ссылки на мангу
				$data[$i]['href'] = array_pop(explode('/',$a->href));//делем URL и берем последний элемент URL
			}
			foreach($manga->find('a.short-poster img') as $img){
				$data[$i]['img'] = $img->src;//Сохроняем ссылки на обложки
			}
			if($i == 89){// Ограничение на количество элементов 
				return $data;//Взрощаем всю собраную мангу
			}
			$i++;
		}
	}
	// Последние лобавленные главы
	public function GetLastAppendChapter()
	{
		$url_page = 'https://mangabook.org/';//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach($scrabber->find('div.manga-item') as $div){//Ds,ираем все элементы из спика новых глава
			foreach($div->find('h3 a') as $name){
				$data[$i]['name'] = trim($name->plaintext);//Название манги
				$data[$i]['href'] = array_pop(explode('/',$name->href));//Ссылка на мангу
			}
			$g = 0;//INdex chapter array
			foreach($div->find('div.manga-chapter a') as $a){//Пербераем список глав
				$data[$i]['chapter'][$g]['c_name'] = $a->plaintext;//Название главы
				$data[$i]['chapter'][$g]['c_href'] = $data[$i]['href'].'/'.array_pop(explode('/',$a->href));//Ссылка на главу
				$g++;
			}
			$i++;
		} 
		return $data;
	}

	public function GetGenre()
	{
		$url_page = 'https://mangabook.org/';//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach ($scrabber->find('div.side-bc ul.nav-menu li a') as $li) {//Перебираем список жанров
			$data[$i]['name'] = trim(array_pop(explode('»',$li->plaintext)));//название жанра 
			$data[$i]['href'] = array_pop(explode('/',$li->href));//Ссылка на жанр
			$i++;
		}
		$data = array_slice($data,-71);
		return $data;
	}

	public function GetNewManga()
	{
		$url_page = 'https://mangabook.org/';//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach($scrabber->find('div.nomb  a') as $a){//Перебор всех манг из нав меню
			$data[$i]['name'] = explode('  ',$a->plaintext)[0];//Название манги
			$data[$i]['href'] = array_pop(explode('/',$a->href));
			$data[$i]['img']  = 'https://mangabook.org'.$a->children(0)->src;//Ссылка на мангу
			$i++;
		}
		$data = array_reverse($data);//Перворачиваем массив 
		$data = array_slice($data,0,10);//Берем 10 элментов в которых лежат новая манга
		return $data;
	}

	public function GetInfoManga($url)
	{
		$url_page = 'https://mangabook.org/manga/'.$url;//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach($scrabber->find('div#fmain h1') as $div){
			$data['name'] = trim($div->plaintext);//Название манги
		}
		foreach($scrabber->find('img.img-responsive') as $img){
			$data['img'] = $img->src;//Обложка манги
		}
		foreach($scrabber->find('ul#flist li') as $li){
			$sp = 0;
			foreach($li->find('span') as $span){
				$my_span[$sp] = trim($span->plaintext);//Название параметра манги
				$sp++;
			}
			if($my_span[0] == 'Категории:'){//Получаем список жанров
				$g = 0;
				foreach($li->find('a') as $a){
					$data['genre'][$g]['name'] = $a->plaintext;//Навание жанра
					$data['genre'][$g]['href'] = array_pop(explode('/',$a->href));//Ссылка на жанр
					$g++;
				}
			}
			if($my_span[0] == 'Статус:'){
				$data['status'] = trim(explode(':',$li->plaintext)[1]);//Статус манги
			}
			if($my_span[0] == 'Жанр (вид):'){
				$data['type'] = trim(explode(':',$li->plaintext)[1]);//Вид манги
			}
			if($my_span[0] == 'Другие названия:'){
				$data['a_name'] = trim(explode(':',$li->plaintext)[1]);//Другие названия
			}
			if($my_span[0] == 'Дата релиза:'){
				$data['date'] = trim(explode(':',$li->plaintext)[1]);//Дата публикации
			}
			if($my_span[0] == 'Автор(ы):'){//Массив авторов манги
				$g = 0;
				foreach($li->find('a') as $a){
					$data['author'][$g]['name'] = $a->plaintext;//Имя автора манги
					$g++;
				}
			}
			if($my_span[0] == 'Художник(и):'){//Массив художников манги
				$g = 0;
				foreach($li->find('a') as $a){
					$data['arter'][$g]['name'] = $a->plaintext;//Имя художника
					$g++;
				}
			}
			if($my_span[0] == 'Переводчик::'){
				$data['transltions'] = trim(explode(':',$li->plaintext)[2]);//Список переводчиков
			}
			$i++;
		}
		foreach($scrabber->find('div#fdesc') as $span){//Описание манги
			$data['annotation'] = trim($span->plaintext);
		}
		return $data;
	}

	public function GetListMangaChapters($url)
	{
		$url_page = 'https://mangabook.org/manga/'.$url;//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;
		foreach($scrabber->find('ul.chapters li') as $li){
			foreach($li->find(' h5 a') as $a){
				$data[$i]['name'] = $a->plaintext;
				$data[$i]['href'] = strval(array_pop(explode('/',$a->href)));
				$data[$i]['href'] = $url.'/'.$data[$i]['href'];
				$i++;
			}
		}
		return $data;
	}
	public function GetMangaPage($chap_url)
	{
		$url_page 	= 'https://mangabook.org/manga/'.$chap_url.'/2';//Url parse page
		$agent		= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
		$ch 		= curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_URL,$url_page);
		$result		= curl_exec($ch);
		$data 		= [];//Массив с данными манги
		$scrabber 	= str_get_html($result);
		$i = 0;
		foreach($scrabber->find('img.img-responsive') as $img){//Перебор страниц манги
			$data['pages'][$i] = $img->{"data-src"};//Получение url страницы манги из атрибута data-src
			$i++;
		}
		foreach($scrabber->find('title') as $title){
			$data['name'] = trim($title->plaintext);//Получение имени манги
		}
		array_pop($data['pages']);//Последний элемент пустой его нужно удалить
		return $data;
	}

	public function Search($query,$page)
	{
		$url_page = 'https://mangabook.org/dosearch?do=search&subaction=search&query='.$query.'&page='.$page;//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;
		foreach($scrabber->find('ol.manga-list li div.flist a.alpha-link') as $div){//Перебор блоков с название и ссылками манги
			$data[$i]['name'] = trim($div->plaintext);//Название манги
			$data[$i]['href'] = array_pop(explode('/',$div->href));//Ссылка на мангу
			$i++;
		}
		$i=0;
		foreach($scrabber->find('ol.manga-list li div.fcols div.sposter img') as $img){
			$data[$i]['img'] = $img->src;//Ссылка на обложку
			$i++;
		}
		foreach($scrabber->find('div.alert ') as $div){
			$data['none'] = $div->plaintext;//Ссылка на обложку
			$i++;
		}
		return $data;
	}

	public function GetMangaFromGenre($genre,$page)
	{
		$url_page = 'https://mangabook.org/filterList?page='.($page+1).'&ftype[]=0&cat='.$genre.'&status[]=0&alpha=&year_min=&year_max=&sortBy=name&asc=true&author=&artist=&tag=';//Url parse page
		$scrabber = file_get_html($url_page);//Call lib SHDom
		$data = [];//Массив с данными манги
		$i = 0;//Index array 
		foreach($scrabber->find('article.short') as $manga){//Берем все блоки в классом short
			foreach($manga->find('div.sh-title') as $name){
				$data[$i]['name'] = $name->plaintext;//Пербераем все имена и сохроняем в массив
			}
			foreach($manga->find('a.short-poster') as $a){//Ссылки на мангу
				$data[$i]['href'] = array_pop(explode('/',$a->href));//делем URL и берем последний элемент URL
			}
			foreach($manga->find('a.short-poster img') as $img){
				$data[$i]['img'] = $img->src;//Сохроняем ссылки на обложки
			}
			$i++;
		}
		foreach($scrabber->find('div.center-block ') as $div){
			$data['none'] = $div->plaintext;//Ссылка на обложку
			$i++;
		}
		return $data;
	}
}

?>