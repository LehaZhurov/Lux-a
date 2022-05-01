<?
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
require 'vendor/autoload.php';
//pass:iXwqH2iU name:ca48112_luxa
R::setup('mysql:host=localhost;dbname=luxa','root',	'');//Подключение к базе данных

use Controllers\Controller;//Основной контроллер
use Controllers\IndexController;//Контроллер главной страницы сайта
use Controllers\MangaInfoController;//Контроллер старницы с инфо о манге
use Controllers\SearchController;//Контроллер поиска манги
use Controllers\GenreController;//Контроллер поиска манги по жанрам
use Controllers\UserController;//Контроллер пользователя
require 'router.php';//файл с маршрутами сайта

?>