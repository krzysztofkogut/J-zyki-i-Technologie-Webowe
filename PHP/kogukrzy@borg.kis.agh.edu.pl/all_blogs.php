<?php echo'<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Strona główna</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Konrad Polarczyk" />
		<link rel="stylesheet" title="casual" href="../style1.css" type="text/css" />
		<link rel="stylesheet" media="print" href="../print_style.css" type="text/css" />
		<link rel="alternate stylesheet" title="alternate" href="../alt_style.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="title" class="main">
				<p>Strona główna</p>
			</div>
			<div id="menu">
				<h1 id="table_of_contents">Spis treści</h1>
				<?php include 'menu.php';?>
			</div>
			<div id="main" class="main">
				<h1>Wszystkie blogi</h1>
				<div id="blog" class="padd-left">
					<?php
						include 'utils.php';
						$blogs = get_blogs();
						
						if (count($blogs)>0) {
							echo '<ul class="blog-list">';
							for ($i = 0; $i < count($blogs); $i++) {
								echo '<li>';
								echo '<hr class="no-vert-margin list-hr">';
								echo '<div class="li-container" onclick="window.location = \'http://student.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '\';">';
								echo '<div class="blog-name">';
								echo '<a href="http://student.agh.edu.pl/~kogukrzy/blog/blog.php?nazwa=' . $blogs[$i] . '">' . $blogs[$i] . '</a>';
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
				<p>
					<a href="http://validator.w3.org/check?uri=referer">
						<img
								src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
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
		</div>
	</body>
</html>
