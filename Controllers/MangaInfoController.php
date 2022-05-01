<?
namespace Controllers;
use MBScrabber;

class MangaInfoController extends Controller{

	public function Index($name)
	{
		$manga = new MBScrabber();//Экземпляр скраббера
		$chaters = $manga->GetListMangaChapters($name);//Главы манги
		$manga = $manga->GetInfoManga($name);//Инфо о манге;
		$this->Render('manga.page.php',[
		'manga_data' => $manga,
		'chapters' => $chaters,
		'bc' => $this->GetBackColor($manga['img'])
		]);//Рендер шаблона
	}

	protected function GetBackColor($img)
	{
		// $content = file_get_contents($img);
		$info = getimagesize($img);
		switch ($info[2]) { 
		case 1: 
			$img = imageCreateFromGif($img);
			break;					
		case 2: 
			$img = imageCreateFromJpeg($img); 
			break;	
		case 3: 
			$img = imageCreateFromPng($img); 
			break;
		}	
		$width = ImageSX($img);
		$height = ImageSY($img);
		$thumb = imagecreatetruecolor(1, 1); 
		imagecopyresampled($thumb, $img, 0, 0, 0, 0, 1, 1, $width, $height);
		$color = '#' . dechex(imagecolorat($thumb, 0, 0));
		imageDestroy($img);
		imageDestroy($thumb);
		return $color;
	}

	public function Read($chapter)
	{
		$manga = new MBScrabber();//Экземпляр скраббера
		$pages = $manga->GetMangaPage($chapter);//Главы манги
		$name = explode(' ',$pages['name']);
		$name = $name[0]."-".$name[1];
		$pages['name'] = $name;
		if(!$pages['pages']){
			$this->Redirect('/');
		}
		$this->Render('read.page.php',['read' => $pages]);
	}

	public function Chapter($name)
	{
		$manga = new MBScrabber();//Экземпляр скраббера
		$chaters = $manga->GetListMangaChapters($name);//Главы манги
		echo json_encode($chaters);
	}
}
?>