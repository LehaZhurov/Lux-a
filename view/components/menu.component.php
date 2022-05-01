<div id="menu">
        <nav id="header_menu">
            <a href="/">
                <i class='bx bx-dizzy icon' ></i>
            </a>
            <h1 class = 'inviz_text_menu'>Luxa</h1>
        </nav>
        <div>
            <form id="search_block" action="/search" method='GET'>
                <input type="text" placeholder="Search" class = 'inviz_text_menu' name = 'query'>
                <button><i class='bx bx-search-alt-2 icon' ></i></button>
            </form>
        </div>
        <nav class="body_menu">
            <div class="body_menu_item" id = 'menulist'>
                <a href="#" >
                    <i class='bx bx-list-ul icon' ></i>
                </a>
                <span class = 'inviz_text_menu'>
                    <a href="#">Жанры</a>
                </span>
            </div>
            <div class="body_menu_item">
                <a href="/bookmarks">
                    <i class='bx bxs-bookmarks icon' ></i>
                </a>
                <span class = 'inviz_text_menu'>
                    <a href="/bookmarks">Закладки</a>
                </span>
            </div>
            <div class="body_menu_item">
                <a href="/history">
                    <i class='bx bx-history icon' ></i>
                </a>
                <span class = 'inviz_text_menu'>
                    <a href="/history">История</a>
                </span>
            </div>
             <div class="body_menu_item" id = 'menunewchap'>
                <a href="#">
                    <i class='bx bx-paperclip icon' ></i>
                </a>
                <span class = 'inviz_text_menu'>
                    <a href="#">New Главы</a>
                </span>
            </div>
            <div class="body_menu_item">
                <a href="#">
                    <i class='bx bx-question-mark icon' ></i>
                </a>
                <span class = 'inviz_text_menu'>
                    <a href="#">О нас</a>
                </span>
            </div>
        </nav>
        <button id = 'menu_but'>
            <i class='bx bx-menu icon' ></i>
        </button>
        <nav class="footer_menu">
            <div class="inviz_text_menu">   
                <h4>Манга на русском</h4>
                <p class = 'low_size_text'>*Все информация взята из открытых источников</p>
                <p class = 'low_size_text'>*Вся информация предоствлена в ознакомительных целях</p>
                <p><span>14.02.2022-</span>
                <span>
                    <script type="text/javascript">
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();
                        today = dd + '.' + mm + '.' + yyyy;
                        document.write(today);
                    </script>
                </span>
                <i class = 'bx bxs-cat'></i></p>
            </div>  
        </nav>
    </div>