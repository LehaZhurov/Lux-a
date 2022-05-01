<?

namespace Controllers;
use MBScrabber;

class IndexController extends Controller{


	public function Index()//Метод для вывода шаблона главной страницы
	{
		$manga = New MBScrabber();
		$manga = $manga->GetLastUpdateManga();//Получение спискаа обновленной манги
		// dump($manga);
		$this->Render('index.page.php',['manga' => $manga]);//Отправка данных в шаблон
	}

	public function NewChapter()
	{
		$chap = New MBScrabber();
		$chap = $chap->GetLastAppendChapter();
		echo json_encode($chap);
	}

}
?>