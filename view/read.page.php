{% extends "app.view.php" %}
{% block title %} {{read.name}} {% endblock %}
{% block link %}
    <link rel="stylesheet" href="../../Style/style.css">
    <link rel="stylesheet" href="../../Style/read.css">

{% endblock %}
{% block content %}
<div id="reader">
    <h1 id = 'chapname'>{{read.name}}</h1>
    <div id="fullscreen">
        <div class="slider">
            <div class="slider__wrapper">
                <div class="slider__items"> 
                    {% for page in read.pages %}
                        <div class="slider__item">
                            <div class="over">
                                <img class="img-fluid" loading="lazy" src="{{ page }}" >
                            </div>
                        </div>    
                    {% endfor %}
                </div>
                <a class="slider__control slider__control_prev" href="#" role="button"></a>
                <a class="slider__control slider__control_next" href="#" role="button"></a>
            </div>
        </div>
    </div>
</div>
{{ include('/components/chapter.component.php') }}
<button id="chapter_but" onclick="chapter_close()">Главы</button>
<button id="fullscreen_but" onclick="fullscreen()"><i class='bx bx-fullscreen'></i></button>
{% endblock %}
{% block script %}
<script type="text/javascript" src = '../../Script/menu.js'></script>
<script type="text/javascript" src = '../../Script/SendRequest.js'></script>
<script type="text/javascript" src = '../../Script/genre.js'></script>
<script type="text/javascript" src = '../../Script/newchapter.js.js'></script>
<script type="text/javascript" src = '../../Script/slider.js'></script>
<script type="text/javascript" src = '../../Script/readpagechapter.js'></script>
<script type="text/javascript" src = '../../Script/history.js'></script>
<script type="text/javascript" src = '../../Script/fullscreen.js'></script>


<script>
    slideShow('.slider', {
          isAutoplay: false
    });
</script>
{% endblock %}