<?php echo '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Strona główna</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Krzysztof Kogut" />
		<link rel="stylesheet" title="casual" href="style.css" type="text/css" />

	</head>
	<body>
		<div id="container">
			<div id="logo">
				<p><?php 
					$error = $_GET['err'];
					$title = 'Błąd';
					$message = 'Nie znaleziono strony';
					if ($error == '404') {
						$title = '404';
						$message = 'Nie znaleziono strony o podanej nazwie!';
					}
					else if ($error == '0'){
						$title = 'Nazwa zajęta';
						$message = 'Blog o podanej nazwie już istnieje!';
					}
					else if ($error == '1'){
						$title = 'Błąd autoryzacji';
						$message = 'Podany użytkownik lub hasło jest błędne!';
					}
					else if ($error == '2'){
						$title = 'Błąd';
						$message = 'Uzupełnij wszystkie pola oznaczone gwiazdką!';
					}
					echo $title;
				?></p>
			</div>
			<div class="menu">
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/all_blogs.php">Wszystkie blogi</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/create_blog.php">Załóż blog</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/add_post.php">Dodaj post</a></div>
				<div style="clear:both;"></div>
			</div>
			<div id="content">
				<div id="blog">
					<?php
						echo '<center><h2>' . $message . '</h2></center>';
						echo '<center><p class="reset-format">' . 'Za chwilę nastąpi przekierowanie do wszystkich blogów...' . '</p></center>';
						header('refresh:3; url=all_blogs.php');
					?>
				</div>
				
			</div>
			<div id="menul" class="spis_menu">
				<h1>Spis treści</h1>
				<?php include 'menu.php';?>
			</div>
			<div id="pozostale_cwiczenia">
				<h2>Style</h2>
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
	</body>
</html>
