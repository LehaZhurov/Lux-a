<?
namespace Controllers;
use MBScrabber;

class GenreController extends Controller{


	public function Index($genre)//Метод для для вывода шаблона с  результатами  
	{
		$manga = New MBScrabber();//Вызов скраббера 
		$genre_search_result = $manga->GetMangaFromGenre($genre,0);//Вызываем метод поиска манги
			if(!empty($genre_search_result['none'])){//Проверка наличия результата
				$this->Redirect('/');
			}
		$this->Render('genre.page.php',['manga' => $genre_search_result]);//Отправка данных в шаблонОтправка данных в шаблон
		// dump($genre_search_result,$_GET);
	}
	public function GenreList(){//Метод получения списка жанров
		$genre = New MBScrabber();
		$genre = $genre->GetGenre();//Получение списка жанров
		echo json_encode($genre);
	} 

	public function GenrePage($genre,$page)//Метод который вызывается для подгрузки результата найденной манги
	{
		$manga = New MBScrabber();//Создание экземпляра скраббера
		$genre_search_result = $manga->GetMangaFromGenre($genre,$page);//Вызываем метод поиска манги
		if(!empty($genre_search_result['none'])){//Проверка наличия результата
			http_response_code(404);
			$genre_search_result = 'Результаты поиска закончились';
		}
		echo json_encode($genre_search_result);
	}



}
?>