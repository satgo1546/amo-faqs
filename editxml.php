<!DOCTYPE html>
<?php
require_once("src/constants.php");
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
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
					<span class="sr-only">显示导航栏</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./">
					<img src="static/icon.png" alt="<?php echo $sitexml->title; ?>" width="16" height="16" /> <?php echo $sitexml->title; ?>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="nav-collapse">
				<ul class="nav navbar-nav">
					<li><a href="http://bbs.66rpg.com/thread-324640-1-1.html"><i class="fa fa-arrow-circle-o-left"></i> 返回帖子</a></li>
					<li><a href="./"><i class="fa fa-home"></i> 首页</a></li>
				</ul>
			</div>
		</nav>
		<div class="wrapper">
			<div class="container">
				<h1>编辑 XML</h1>
				<?php
				if (isset($_POST["manpwd"])) {
					if (crypt($_POST["manpwd"], $salt) !== $manpwdhash) {
						?>
						<div class="alert alert-danger">
							<p>你输入的管理者密码不正确。</p>
						</div>
						<?php
					} else {
						if (file_put_contents("data/faq_list.xml", $_POST["xml"]) !== FALSE) {
							?>
							<div class="alert alert-success">
								<p>修改完毕。</p>
								<a href="./" class="btn btn-success">返回首页</a>
							</div>
							<?php
						} else {
							?>
							<div class="alert alert-warning">
								<p>内容写入失败。</p>
								<a href="./" class="btn btn-warning">返回首页</a>
							</div>
							<?php
						}
					}
				} else {
					?>
					<p>填写下面的表单后点击“提交”按钮。</p>
					<form id="newitem" name="newitem" method="post" action="editxml.php" role="form" autocomplete="off">
						<div class="form-group">
							<label for="manpwd">管理者密码</label>
							<input type="password" name="manpwd" id="manpwd" class="form-control" />
							<span class="help-block">
								请输入管理者密码。此密码已使用论坛消息功能发送给许可编辑 FAQ 的用户。
								如果你没有收到，请向 <a href="http://bbs.66rpg.com/home.php?mod=space&uid=199230" target="_blank">@satgo1546</a> 索要。
								注意：此密码可能会不定期修改。
							</span>
						</div>
						<label>修改后的内容</label>
						<input type="hidden" name="xml" id="xml" />
						<div id="xml_editor"><?php echo htmlentities(file_get_contents("data/faq_list.xml")); ?></div>
						<span class="help-block">不按照格式修改此文件有可能导致不可预料的后果。</span>
						<button type="submit" class="btn btn-primary" style="margin-top: 8px;" onclick="editxmlfunc();">提交</button>
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
							var xmleditor = ace.edit("xml_editor");
							xmleditor.setTheme("ace/theme/tomorrow");
							xmleditor.getSession().setMode("ace/mode/xml");
		</script>
		<script type="text/javascript" src="src/functions.js"></script>
	</body>
</html>
