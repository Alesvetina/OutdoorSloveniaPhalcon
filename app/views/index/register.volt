{% extends "templates/base.volt" %}

{% block content %}
    {#<form class="form-horizontal" method="post" action="{{ url("index/doRegister") }}">#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="email" class="control-label">Email:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="email" name ="email" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="password" class="control-label">Password:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="password" name ="password" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="confirm_password" class="control-label">Confirm password:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="password" name ="confirm_password" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="first_name" class="control-label">First name:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="text" name ="first_name" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="last_name" class="control-label">Last name:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="text" name ="last_name" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group form-group-lg">#}
            {#<div class="col-sm-3 text-right label_small_align">#}
                {#<label for="pickup_place" class="control-label">Pickup place:</label>#}
            {#</div>#}
            {#<div class="col-sm-5 col-xs-9">#}
                {#<input type="text" name ="pickup_place" class="form-control" />#}
            {#</div>#}
        {#</div>#}
        {#<div class="form-group">#}
            {#<div class="col-sm-4 col-sm-offset-3">#}
                {#<input type="submit" class="btn btn-lg btn-primary btn-block" value="Register" />#}
            {#</div>#}
        {#</div>#}
        {#<input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">#}
    {#</form>#}

    <div class="panel">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
            <div class="flash-output">{{ flash.output() }}</div>
            {{ view.outputForm('registerForm') }}

            {{ view.outputJs() }}
            Existing user? {{ link_to('user/login', 'Login') }}
        </div>
    </div>

    <div id="form"></div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form").alpaca({
                "schema": {
                    "title":"User Feedback",
                    "description":"What do you think about Alpaca?",
                    "type":"object",
                    "properties": {
                        "name": {
                            "type":"string",
                            "title":"Name"
                        },
                        "feedback": {
                            "type":"string",
                            "title":"Feedback"
                        },
                        "ranking": {
                            "type":"string",
                            "title":"Ranking",
                            "enum":['excellent','ok','so so']
                        }
                    }
                }
            });
        });
    </script>
{% endblock %}