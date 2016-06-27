{% extends "templates/base.volt" %}

{% block content %}
    <form class="form-horizontal" method="post" action="{{ url("index/doSignin") }}">
        <div class="form-group form-group-lg">
            <div class="col-sm-3 text-right label_small_align">
                <label for="email" class="control-label">Email:</label>
            </div>
            <div class="col-sm-5 col-xs-9">
                <input type="text" name ="email" class="form-control" />
            </div>
        </div>
        <div class="form-group form-group-lg">
            <div class="col-sm-3 text-right label_small_align">
                <label for="username" class="control-label">Password:</label>
            </div>
            <div class="col-sm-5 col-xs-9">
                <input type="password" name ="password" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3">
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in" />
            </div>
        </div>
        <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
    </form>
{% endblock %}