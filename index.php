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
                <?php echo $faqxml->searchtip; ?>
                <div class="row">
                    <form id="searchfaq" name="searchfaq" method="get" action="search.php" role="form" autocomplete="off">
                        <div class="col-md-9">
                            <label for="q" class="sr-only">输入你要查找的问题的关键字</label>
                            <div class="input-group input-group-lg">
                                <input type="text" name="q" id="q" class="form-control input-lg" placeholder="输入你要查找的问题的关键字" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg searchbtn">搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-default btn-lg btn-block" onclick="toggleallfaqs();">展开/收起全部问题</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <blockquote>
                <p><?php echo $faqxml->satgo ?></p>
                <small><cite title="satgo">satgo</cite></small>
            </blockquote>
            <div class="faqlist" id="faqlist">
                <?php
                foreach ($faqxml->category as $c) {
                    echo "<hr />";
                    echo "<h2><span class=\"label label-primary\">C-$c->id</span> $c->name</h2>";
                    foreach ($c -> faq as $f) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="label label-default"><?php echo $f->id; ?></span>
                        <a data-toggle="collapse" href="#<?php echo strtolower($f->id) ?>">
                            Q：<?php echo "$f->q"; ?>
                        </a>
                    </div>
                    <div class="panel-collapse collapse" id="<?php echo strtolower($f->id) ?>">
                        <div class="panel-body">
                            <?php echo Michelf\Markdown::defaultTransform("A：" . $f->a); ?>
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
        <script type="text/javascript" src="src/functions.js"></script>
    </body>
</html>
