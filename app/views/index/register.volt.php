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
                    <li class="signin"><a href="<?= $this->url->get('index') ?>">Signin</a></li>
                    <li class="signin"><a href="<?= $this->url->get('index/register') ?>">Register</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <?= $this->flash->output() ?>

            
    
        
            
                
            
            
                
            
        
        
            
                
            
            
                
            
        
        
            
                
            
            
                
            
        
        
            
                
            
            
                
            
        
        
            
                
            
            
                
            
        
        
            
                
            
            
                
            
        
        
            
                
            
        
        
    

    <div class="panel">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
            <div class="flash-output"><?= $this->flash->output() ?></div>
            <?= $this->view->outputForm('registerForm') ?>

            <?= $this->view->outputJs() ?>
            Existing user? <?= $this->tag->linkTo(['user/login', 'Login']) ?>
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

        </div>

    </div>
</body>
</html>