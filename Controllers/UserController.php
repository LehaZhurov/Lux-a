<?
namespace Controllers;
use MBScrabber;
use R;
class UserController extends Controller{


	public function SetBookmark($name)//Метод создания закладки
	{
		$check = $this->CheckDublacatBookmark($name);
		if($check){
			http_response_code(404);
			echo 'Уже в закладках';
			exit();
		}
		$manga = New MBScrabber();
		$manga = $manga->GetInfoManga($name);//Получение инфо о манге
		$bookmark = R::dispense('bookmarks');//Запрос к табличке закладок
		$bookmark->name 	= $manga['name'];
		$bookmark->img 		= $manga['img'];
		$bookmark->href 	= $name;
		$bookmark->user 	= $_COOKIE['id'];
		R::store($bookmark);//Сохранение заклдаки
	}

	public function CheckDublacatBookmark($name)//Проверка на на дубликат в закладках
	{
		$id = $_COOKIE['id'];
		$bookmark = R::find( 'bookmarks', 'href = ? AND user = ?', [ $name,$id ] );//Выбор закладок по пользователю и самой манге
		if($bookmark){
			return true;
		}else{
			return false;
		}
	}

	public function GetBookmarks()
	{
		$id = $_COOKIE['id'];
		$bookmark = R::getAll('SELECT `name`,`href`,`img` FROM `bookmarks` WHERE `user` = ? ORDER BY `id` DESC LIMIT 0,40', [$id]);
		// dump($bookmark);
		$this->Render('bookmark.page.php',['manga' => $bookmark]);//Отправка данных в
	}

	public function CheckAppendBookmark($name)
	{
		$bookmark = $this->CheckDublacatBookmark($name);
		if($bookmark){
			http_response_code(200);
		}else{
			http_response_code(404);
		}
	}

	public function DeleteBookmark($name){
		$id = $_COOKIE['id'];
		$bookmark = R::findOne( 'bookmarks', 'href = ? AND user = ?', [ $name,$id ] );//Выбор закладок
		R::trash($bookmark);
	}
	public function BookmarkPage($page)
	{
		$limit = 40;
		$start = $limit * $page;
		$end_b = $start + $limit;
		$id = $_COOKIE['id'];
		$bookmark = 
		R::getAll(
			'SELECT `name`,`href`,`img` FROM `bookmarks` WHERE `user` = ? ORDER BY `id` DESC LIMIT '.$start.','.$end_b.'',[$id]);
		if(!$bookmark){
			http_response_code(404);
		}
		else{
			echo json_encode($bookmark);
		}
	}

	public function AppendInHistory($chapter)
	{
		$check = $this->CheckDublacatHistory($chapter);
		if($check){
			http_response_code(404);
			echo 'В истории';
			exit();
		}
		$manga = New MBScrabber();
		$manga = $manga->GetMangaPage($chapter);//Получени страниц манги и названия
		$img = $manga['pages'][1];
		$history = R::dispense('history');//Запрос к табличке закладок
		$history->name 	= $manga['name'];
		$history->img 	= $img;
		$history->href 	= $chapter;
		$history->user 	= $_COOKIE['id'];
		$history->date  = date('d/m/Y');
		R::store($history);//Сохранение заклдаки
	}

	public function CheckDublacatHistory($chapter)
	{
		$id 		= $_COOKIE['id'];
		$date 		= date('d/m/Y');
		$history 	= R::find( 'history', 'href = ? AND user = ? AND date = ?', [ $chapter,$id,$date ] );//Выбор закладок по пользователю и самой манге
		if($history){
			return true;
		}else{
			return false;
		}
	}

	public function History()
	{
		$id = $_COOKIE['id'];
		$history = R::getAll('SELECT `name`,`href`,`img` FROM `history` WHERE `user` = ? ORDER BY `id` DESC LIMIT 0,60', [$id]);
		// dump($bookmark);
		$this->Render('history.page.php',['manga' => $history]);//Отправка данных в
	}

}