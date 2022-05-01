<?
$router = lib\lib_router\Router::fromGlobals();


$router->add ('/'                      , 'Controllers\IndexController@index');//Главная страница
$router->add ('/manga/:any'            , 'Controllers\MangaInfoController@index');//СТраница с инфо про мангу
$router->add ('/read/:any'             , 'Controllers\MangaInfoController@read');//страница прочтения
$router->add ('/chapter/:any'          , 'Controllers\MangaInfoController@chapter');//страница прочтения
$router->add ('/search'                , 'Controllers\SearchController@index');//Страница поиска 
$router->add ('/load_search/:any/:any' , 'Controllers\SearchController@SearchPage');//Маршрут для подгрузки найденной манги 
$router->add ('/genre'                 , 'Controllers\GenreController@genrelist');//Маршрут для получения жанров
$router->add ('/genre/:any'            , 'Controllers\GenreController@index');//Страница с мангой в жанре ..
$router->add ('/load_genre/:any/:any'  , 'Controllers\GenreController@genrepage');//Маршрут для подгрузки манги в жанре
$router->add('/set_bookmark/:any'      , 'Controllers\UserController@setbookmark');//Cоздание закладки
$router->add('/bookmarks'              , 'Controllers\UserController@getbookmarks');//Получение закладок
$router->add('/check_bookmarks/:any'   , 'Controllers\UserController@checkappendbookmark');//Проверка наналичие манги в заклдаках
$router->add('/delete_bookmark/:any'   , 'Controllers\UserController@deletebookmark');//Удаление закладки
$router->add('/load_bookmark/:any'     , 'Controllers\UserController@bookmarkpage');//Подгрузка закладок
$router->add('/set_history/:any'       , 'Controllers\UserController@appendinhistory');//Добавление в историю
$router->add('/history'                , 'Controllers\UserController@history');//Страница с историей
$router->add('/get_new_chapter'        , 'Controllers\IndexController@newchapter');//Получение новых глав

if ($router -> isFound ()) { 
    $router -> executeHandler ( 
        $router -> getRequestHandler (), 
        $router -> getParams () 
    ); 
}  
else { 
     // Простой обработчик сообщения «Не найдено» 
           http_response_code ( 404 ); 
           echo  '<style>body{display:flex;justify-content:center;background-color: #232e44;}</style><a href = "/"><img src="https://i.pinimg.com/originals/bd/df/d6/bddfd6e4434f42662b009295c9bab86e.gif" alt=""></a>' ; 
} 
?>

