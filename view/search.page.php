{% extends "app.view.php" %}
{% block title %} Поиск {% endblock %}
{% block link %}
    <link rel="stylesheet" href="Style/style.css">
{% endblock %}
{% block content %}
    <div class="h_and_result">
        {% if manga == false%}
        <h1 id = 'not_result'>Нечего не найдено</h1>
        {% else %}
        <h1>Результат поиска</h1>
            <div id="manga_grid">
            {% for item in manga %}
                <div class="manga_card">
                    <div class="manga_card_img">
                        <img loading="lazy" src="{{item.img}}" alt="">
                    </div>
                    <div class="manga_card_name">
                        <a href="manga/{{item.href}}" title = '{% autoescape %}{{item.name|raw}}{% endautoescape %}'>
                        {% autoescape %}{{item.name|raw|slice(0, 30)|raw }}{% endautoescape %}
                        </a>
                    </div>
                </div>
            {% endfor %}
            </div>
            {% if manga != false%}
                <div id="button_block">
                    <button>ЕЩЕ</button>
                </div>
            {% endif %}
        {% endif %}
    </div>
{% endblock %}
{% block script %}
<script type="text/javascript" src = 'Script/menu.js'></script>
<script type="text/javascript" src = 'Script/SendRequest.js'></script>
<script type="text/javascript" src = 'Script/genre.js'></script>
<script type="text/javascript" src = 'Script/load_search.js'></script>
<script type="text/javascript" src = 'Script/newchapter.js'></script>

{% endblock %}