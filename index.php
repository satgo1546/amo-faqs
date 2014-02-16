<!DOCTYPE html>
<?php
require_once("src/loaded_list.php");
require_once("lib/markdown/Markdown.inc.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AMO FAQs</title>
        <!-- AMO Custom CSS -->
        <link href="static/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
        <link rel="stylesheet" href="static/page.css" />
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">显示导航栏</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
                    <img src="static/icon.png" alt="橙光FAQ" width="16" height="16" /> 橙光FAQ
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="http://bbs.66rpg.com/thread-324640-1-1.html"><i class="fa fa-arrow-circle-o-left"></i> 返回帖子</a></li>
                    <li class="active"><a href="./"><i class="fa fa-home"></i> 首页</a></li>
                </ul>
            </div>
        </nav>
        <div class="jumbotron">
            <div class="container">
                <h1></h1>
                <p></p>
            </div>
        </div>
        <div class="container">
            <div class="faqlist">
                <?php
                foreach ($faqxml -> category as $c) {
                    echo "<h2>$c->name</h2>";
                    foreach ($c -> faq as $f) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="label label-default"><?php echo $f -> id; ?></span>
                        <a data-toggle="collapse" data-parent="#faqlist" href="#<?php echo strtolower($f -> id) ?>">
                            Q：<?php echo "$f->q"; ?>
                        </a>
                    </div>
                    <div class="panel-collapse collapse" id="<?php echo strtolower($f -> id) ?>">
                        <div class="panel-body">
                            <?php echo Michelf\Markdown::defaultTransform("A：" . $f -> a); ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    </body>
</html>
