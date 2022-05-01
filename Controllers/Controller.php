<?

namespace Controllers;




class Controller {
	

	
    protected function Redirect($url)//Функция для редиректа 
	{	
        	//Если заголовки отправлены... 
        	//делаем редирект на javascript ...
        	echo '<script type="text/javascript">';
        	echo 'window.location.href="' . $url . '";'; 
        	echo '</script>';
        	//если javascript отключен, делаем редирект на html. 
        	echo '<noscript>'; 
        	echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />'; 
        	echo '</noscript>'; exit; 
	}

	function Render($nameview,$param = array())//Функция для создания шаблона
	{	
		$user = ['user' => $_SESSION['user']];
		$param = array_merge($param,$user);
		$loader 	= new \Twig\Loader\FilesystemLoader('view');
		$twig 		= new \Twig\Environment($loader);
		echo $twig->render($nameview,$param);
	}
}
?>