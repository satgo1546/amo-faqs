<!DOCTYPE html>
<?php
require_once("src/constants.php");
require_once("lib/markdown/Markdown.inc.php");
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
				<h1>搜索结果</h1>
				<div class="row">
					<form id="searchfaq" name="searchfaq" method="get" action="search.php" role="form" autocomplete="off">
						<div class="col-md-10">
							<label for="q" class="sr-only">输入你要查找的问题的关键字</label>
							<div class="input-group">
								<input type="text" name="q" id="q" class="form-control" placeholder="输入你要查找的问题的关键字" value="<?php echo $_GET["q"]; ?>" />
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">搜索</button>
								</span>
							</div>
						</div>
					</form>
					<div class="col-md-2">
						<button type="button"
										class="btn btn-default btn-block"
										onclick="toggleallfaqs();"
										<?php
										if ($_GET["q"] == "") {
											echo "disabled=\"disabled\"";
										}
										?>>
							展开/收起全部问题
						</button>
					</div>
				</div>
				<?php
				if ($_GET["q"] != "") {
					?>
					<div class="faqlist" id="faqlist">
						<?php
						foreach ($faqxml->xpath("category/faq[id='{$_GET["q"]}']") as $em) {
							?>
							<hr />
							<h2>精确匹配</h2>
							<div class="panel panel-default">
								<div class="panel-heading">
									<span class="label label-default"><?php echo $em->id; ?></span>
									<a data-toggle="collapse" href="#exactmatch">
										Q：<?php echo $em->q; ?>
									</a>
								</div>
								<div class="panel-collapse collapse in" id="exactmatch">
									<div class="panel-body">
										<?php echo Michelf\Markdown::defaultTransform("A：" . $em->a); ?>
									</div>
								</div>
							</div>
							<?php
						}
						foreach ($faqxml->category as $c) {
							echo "<hr />";
							echo "<h2><span class=\"label label-primary\">C-$c->id</span> $c->name</h2>";
							$found = FALSE;
							switch ($c->display) {
								case "bugs":
									?>
									<div class="table-responsive">
										<table class="table faqbugs">
											<thead>
												<tr>
													<th>描述</th>
													<th>截图</th>
													<th>解决方案</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($c->faq as $f) {
													if ((stripos((string) $f->q, $_GET["q"]) !== FALSE) || (stripos((string) $f->q, $_GET["q"]) !== FALSE)) {
														$found = TRUE;
														?>
														<tr>
															<td>
																<span class="label label-default"><?php echo $f->id; ?></span>
																<?php echo $f->q; ?>
																<div class="faqdate">
																	此条更新日期：<?php
																	if (isset($f->date)) {
																		echo "{$f->date->year}-{$f->date->month}-{$f->date->day}";
																	} else {
																		echo "未知";
																	}
																	?>
																</div>
															</td>
															<td>
																<?php
																if (isset($f->snapshot)) {
																	echo "<a href=\"$f->snapshot\" target=\"_blank\">";
																}
																?>
																<img
																	src="<?php echo isset($f->snapshot) ? $f->snapshot : "static/null.png"; ?>"
																	<?php
																	if (isset($f->snapshot)) {
																		echo "alt=\"点击放大\"";
																	}
																	?>
																	class="img-thumbnail img-responsive"/>
																	<?php
																	if (isset($f->snapshot)) {
																		echo "</a>";
																	}
																	?>
															</td>
															<td>
																<?php echo Michelf\Markdown::defaultTransform($f->a); ?>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
									</div>
									<?php
									break;
								case "nouns":
									foreach ($c->faq as $f) {
										if ((stripos((string) $f->q, $_GET["q"]) !== FALSE) || (stripos((string) $f->q, $_GET["q"]) !== FALSE)) {
											$found = TRUE;
											?>
											<div class="panel panel-default">
												<div class="panel-heading">
													<span class="label label-default"><?php echo $f->id; ?></span>
													<a data-toggle="collapse" href="#<?php echo strtolower($f->id); ?>">
														<?php echo $f->q; ?>
													</a>
													<div class="faqdate">
														此条更新日期：<?php
														if (isset($f->date)) {
															echo "{$f->date->year}-{$f->date->month}-{$f->date->day}";
														} else {
															echo "未知";
														}
														?>
													</div>
												</div>
												<div class="panel-collapse collapse" id="<?php echo strtolower($f->id); ?>">
													<div class="panel-body">
														<?php echo Michelf\Markdown::defaultTransform($f->a); ?>
													</div>
												</div>
											</div>
											<?php
										}
									}
									break;
								default:
									foreach ($c->faq as $f) {
										if ((stripos((string) $f->q, $_GET["q"]) !== FALSE) || (stripos((string) $f->q, $_GET["q"]) !== FALSE)) {
											$found = TRUE;
											?>
											<div class="panel panel-default">
												<div class="panel-heading">
													<span class="label label-default"><?php echo $f->id; ?></span>
													<a data-toggle="collapse" href="#<?php echo strtolower($f->id); ?>">
														Q：<?php echo $f->q; ?>
													</a>
													<div class="faqdate">
														此条更新日期：<?php
														if (isset($f->date)) {
															echo "{$f->date->year}-{$f->date->month}-{$f->date->day}";
														} else {
															echo "未知";
														}
														?>
													</div>
												</div>
												<div class="panel-collapse collapse" id="<?php echo strtolower($f->id); ?>">
													<div class="panel-body">
														<?php echo Michelf\Markdown::defaultTransform("A：$f->a"); ?>
													</div>
												</div>
											</div>
											<?php
										}
									}
									break;
							}

							foreach ($c->faq as $f) {
								if ((stripos((string) $f->q, $_GET["q"]) !== FALSE) || (stripos((string) $f->q, $_GET["q"]) !== FALSE)) {
									$found = TRUE;
									?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<span class="label label-default"><?php echo $f->id; ?></span>
											<a data-toggle="collapse" href="#<?php echo strtolower($f->id) ?>">
												Q：<?php echo "$f->q"; ?>
											</a>
										</div>
										<div class="panel-collapse collapse in" id="<?php echo strtolower($f->id) ?>">
											<div class="panel-body">
												<?php echo Michelf\Markdown::defaultTransform("A：" . $f->a); ?>
											</div>
										</div>
									</div>
									<?php
								}
							}
							if ($found == FALSE) {
								echo "在此分类下没有找到匹配项。";
							}
						}
						?>
					</div>
				<?php } else { ?>
					<hr />
					请输入问题的关键字。
				<?php } ?>
			</div>

		</div>
		<footer>
			<div class="container">
				<p><?php echo $sitexml->footer; ?></p>
			</div>
		</footer>
		<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="src/functions.js"></script>
	</body>
</html>
