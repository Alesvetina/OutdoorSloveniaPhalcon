<!doctype html>
<html lang="en">
<head>
    <?= $this->tag->getTitle() ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->assets->outputCss('style') ?>
    <?= $this->assets->outputJs('js') ?>
    
    
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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="<?= $this->url->get('account') ?>">Account</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>

                    
                    
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <?= $this->flash->output() ?>

            
    <form class="form-horizontal" method="post" action="<?= $this->url->get('dashboard/createEvent') ?>">
        <div class="form-group form-group-lg">
            <div class="col-sm-3 text-right label_small_align">
                <label for="date" class="control-label">Date:</label>
            </div>
            <div class="col-sm-5 col-xs-9">
                <input type="date" name ="date" class="form-control" />
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
        <input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>">
    </form>

        </div>

    </div>

</body>
</html>