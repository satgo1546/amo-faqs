<!DOCTYPE html>
<?php
require_once("src/loaded_list.php");
require_once("src/manpwd.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $sitexml->title; ?></title>
		<link href="static/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css" />
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
					<img src="static/icon.png" alt="<?php echo $sitexml->title; ?>" width="16" height="16" /> <?php echo $sitexml->title; ?>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="http://bbs.66rpg.com/thread-324640-1-1.html"><i class="fa fa-arrow-circle-o-left"></i> 返回帖子</a></li>
					<li><a href="./"><i class="fa fa-home"></i> 首页</a></li>
				</ul>
			</div>
		</nav>
		<div class="wrapper">
			<div class="container">
				<h1>添加新项目</h1>
				<?php
				if (isset($_POST["manpwd"])) {
					if (crypt($_POST["manpwd"], $salt) !== $manpwdhash) {
						?>
						<div class="alert alert-danger">
							<p>你输入的管理者密码不正确。</p>
						</div>
						<?php
					} else {
						if ($_POST["category"] == "nothing") {
							?>
							<div class="alert alert-warning">
								<p>请选择一个分类。</p>
								<p>点击浏览器的后退按钮返回。</p>
							</div>
							<?php
						} else {
							foreach ($faqxml->xpath("category[name='{$_POST["category"]}']") as $cate) {
								$newitem = $cate->addChild("faq");
								$newitem->addChild("id", $_POST["id"]);
								$newitem->addChild("q", $_POST["question"]);
								$newitem->addChild("a", $_POST["answer"]);
							}
							$faqxml->saveXML("data/faq_list.xml");
							?>
							<div class="alert alert-success">
								<p>添加完毕。</p>
								<p><a href="additem.php" class="alert-link">继续添加</a>或<a href="./" class="alert-link">返回首页</a>。</p>
							</div>
							<?php
						}
					}
				} else {
					?>
					<p>填写下面的表单后点击“添加”按钮。</p>
					<form id="newitem" name="newitem" method="post" action="additem.php" role="form" autocomplete="off">
						<div class="form-group">
							<label for="manpwd">管理者密码</label>
							<input type="password" name="manpwd" id="manpwd" class="form-control" />
							<span class="help-block">
								请输入管理者密码。此密码已使用论坛消息功能发送给许可编辑 FAQ 的用户。
								如果你没有收到，请向 <a href="http://bbs.66rpg.com/home.php?mod=space&uid=199230" target="_blank">@satgo1546</a> 索要。
								注意：此密码可能会不定期修改。
							</span>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label for="id">ID</label>
									<input type="text" name="id" id="id" class="form-control" />
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="category">分类</label>
									<select name="category" id="category" class="form-control">
										<option value="nothing" selected="selected">— 分类 —</option>
										<?php
										foreach ($faqxml->category as $co) {
											echo "<option value=\"$co->name\">$co->name</option>";
										}
										?>
									</select>
								</div>
							</div>	
						</div>
						<div class="form-group">
							<label for="question">问题</label>
							<input type="text" name="question" id="question" class="form-control" />
						</div>
						<label>解答</label>
						<input type="hidden" name="answer" id="answer" />
						<div id="answer_editor"></div>
						<span class="help-block">为了实现 Q&amp;A 的效果，在执行 Markdown 解释前会自动在第一行之前加入“A：”。</span>
						<button type="submit" class="btn btn-primary" style="margin-top: 8px;" onclick="additemfunc();">添加</button>
					</form>
					<?php
				}
				?>
			</div>
		</div>
		<footer>
			<div class="container">
				<p><?php echo $sitexml->footer; ?></p>
			</div>
		</footer>
		<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/ace-min/ace.js"></script>
		<script type="text/javascript">
							var anseditor = ace.edit("answer_editor");
							anseditor.setTheme("ace/theme/tomorrow");
							anseditor.getSession().setMode("ace/mode/markdown");
		</script>
		<script type="text/javascript" src="src/functions.js"></script>
	</body>
</html>
