{% extends "app.view.php" %}
{% block  descroption %}
<meta name="description" content="{% autoescape %} {{ manga_data.annotation |raw }}{% endautoescape %} "/>
{% endblock %}
{% block link %}
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="stylesheet" href="../Style/manga_page.css">
{% endblock %}
{% block title %} {% autoescape %}{{manga_data.name|raw }}{% endautoescape %} {% endblock %}
{% block content %}
    <div id="manga_page">
        <div id="manga_info">
            <div id="manga_cover">
                <img src="{{manga_data.img}}" alt="">
            </div>
            <div id="manga_param_list">
                <h1>{% autoescape %}{{manga_data.name|raw }}{% endautoescape %}</h1>
                <p>
                    <span class = 'param_name'>Жанр(ы):</span>
                    {% for item in manga_data.genre %}
                    <span class = 'param_item'><a href="/genre/{{item.href}}">{{item.name}}</a></span>
                    {% endfor %}
                </p>
                <p>
                    <span class = 'param_name'>Статус:</span>
                    <span class = 'param_item'>{{manga_data.status}}</span>
                </p>
                <p>
                    <span class = 'param_name'>Тип:</span>
                    <span class = 'param_item'>{{manga_data.type}}</span>
                </p>
                <p>
                    <span class = 'param_name'>Другое название:</span>
                    <span class = 'param_item'>{% autoescape %}{{manga_data.a_name|raw}}{% endautoescape %}</span>
                </p>
                <p>
                    <span class = 'param_name'>Автор(ы):</span>
                    {% for item in manga_data.author %}
                    <span class = 'param_item'>{{item.name}}</span>
                    {% endfor %}
                </p>
                 <p>
                    <span class = 'param_name'>Художник(ы):</span>
                    {% for item in manga_data.arter %}
                    <span class = 'param_item'>{{item.name}}</span>
                    {% endfor %}
                </p>
                <p>
                    <span class = 'param_name'>Изданно:</span>
                    <span class = 'param_item'>{{manga_data.date}}</span>
                </p>
                <p>
                    <span class = 'param_name'>Перевод:</span>
                    <span class = 'param_item'>{{manga_data.transltions}}</span>
                </p>
                <p>
                    <span class = 'param_name'>Аннотация:</span>
                    <span class = 'param_item'>{{manga_data.annotation}}</span>
                </p>
                <div id="button_panel">
                    <button id="read">
                        Читать
                    </button>
                    <button id="bookmark">
                        В закладки
                    </button>
                </div>
            </div>
        </div>
        <div id="manga_chapter">
            {% for item in chapters %}
                <div class="chapter_item">
                    <span class="chap_name"><a href="/read/{{item.href}}">
                        {% autoescape %}{{item.name|raw}}{% endautoescape %}
                    </a></span>
                </div>
            {% endfor %}
        </div>
    </div>
    <style>
        :root{
        /* ===== Colors ===== */
            --body-color: {{ bc  }};
        }
    </style>
{% endblock %}
{% block script %}
    <script type="text/javascript" src = '../Script/menu.js'></script>
    <script type="text/javascript" src = '../Script/SendRequest.js'></script>
    <script type="text/javascript" src = '../Script/genre.js'></script>
    <script type="text/javascript" src = '../Script/appendmangabookmarks.js'></script>
    <script type="text/javascript" src = '../Script/newchapter.js'></script>

{% endblock %}