<?php echo'<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Wszystkie blogi</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Krzysztof Kogut" />
		<link rel="stylesheet" title="casual" href="style.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="logo" class="main">
				<p>Wszystkie blogi</p>
			</div>
			<div class="menu">
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/all_blogs.php">Wszystkie blogi</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/create_blog.php">Załóż blog</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/add_post.php">Dodaj post</a></div>
				<div style="clear:both;"></div>
			</div>

			<div id="content">
				<div id="blog" class="padd-left">
					<?php
						include 'utils.php';
						$blogs = get_blogs();
						
						if (count($blogs)>0) {
							echo '<ul class="blog-list">';
							for ($i = 0; $i < count($blogs); $i++) {
								echo '<li>';
								echo '<hr class="no-vert-margin list-hr">';
								echo '<div class="li-container" onclick="window.location = \'http://borg.kis.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '\';">';
								echo '<div class="blog-name">';
								echo '<a href="http://borg.kis.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '">' . $blogs[$i] . '</a>';
								echo '</div>';
								echo '<div class="post-number">';
								echo '<p class="reset-format">';
								echo 'Wpisów: ' . get_post_number($blogs[$i]);
								echo '</p>';
								echo '</div>';
								echo '</div>';
								echo '</li>';
							}
							echo '</ul>';
						}
					?>
				</div>
				<div id="menul" class="spis_menu">
					<h2>Spis</h2>
					<?php include 'menu.php';?>
				</div>
				
			</div>
			<p>
				<a href="http://validator.w3.org/check?uri=referer">
					<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
				</a>
			</p>
			<p>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img style="border:0;width:88px;height:31px"
							src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
							alt="Poprawny CSS!" />
				</a>
			</p>
		</div>
	</body>
</html>
