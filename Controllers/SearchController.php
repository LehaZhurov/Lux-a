<?
namespace Controllers;
use MBScrabber;

class SearchController extends Controller{


	public function Index()//Страница с резульаттами поиска
	{
		$query = str_replace(' ', '+', $_GET['query']);
		$manga = New MBScrabber();
		$search_result = $manga->Search($query,0);//Вызываем метод поиска манги
		if($search_result['none']){//Проверка наличия результата
			$search_result = false;
		}
		$this->Render('search.page.php',['manga' => $search_result]);//Отправка данных в шаблонОтправка данных в шаблон
		// dump($search_result,$_GET);
	}
	public function SearchPage($query,$page)//Метод для подгрузки результатов поиска
	{
		$query = str_replace(' ', '+', $query);
		$manga = New MBScrabber();
		$search_result = $manga->Search($query,$page);//Вызываем метод поиска манги
		if(!empty($search_result['none'])){
			http_response_code(404);
			$search_result = 'Результаты поиска закончились';
		}
		echo json_encode($search_result);
	}



}
?>