<!doctype html>
<html lang="en">
<head>
    {{ get_title() }}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ this.assets.outputCss('style') }}
    {{ this.assets.outputJs('js') }}
    {% block head %}
    {% endblock %}
</head>
<body>

    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">OutdoorSlovenia</a>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="signin"><a href="{{ url('index') }}">Signin</a></li>
                    <li class="signin"><a href="{{ url('index/register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            {{ flash.output() }}

            {% block content %}
            {% endblock %}
        </div>

    </div>
</body>
</html>