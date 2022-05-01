{% extends "app.view.php" %}
{% block title %} Главная {% endblock %}
{% block link %}
    <link rel="stylesheet" href="Style/style.css">
{% endblock %}
{% block content %}
    <div id="manga_grid" style = "margin-left: 52px ">
        {% for item in manga %}
            <div class="manga_card">
                <div class="manga_card_img">
                    <img loading="lazy" src="{{item.img}}" alt="">
                </div>
                <div class="manga_card_name">
                    <a href="manga/{{item.href}}" title = '{{item.name}}'>
                        {% autoescape %}{{item.name|raw|slice(0, 30)|raw }}{% endautoescape %}
                    </a>
                </div>
            </div>
        {% endfor %}
    </div>  
{% endblock %}
{% block script %}
<script type="text/javascript" src = 'Script/menu.js'></script>
<script type="text/javascript" src = 'Script/SendRequest.js'></script>
<script type="text/javascript" src = 'Script/genre.js'></script>
<script type="text/javascript" src = 'Script/newchapter.js'></script>

{% endblock %}
