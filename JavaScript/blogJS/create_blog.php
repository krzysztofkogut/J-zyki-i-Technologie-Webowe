<?php echo '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Załóż blog</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Krzysztof Kogut" />
		<script type="text/javascript" src="dom.js"></script>
		<link rel="stylesheet" title="casual stylesheet" href="style.css" media="screen" type="text/css" />
		<link rel="alternate stylesheet" title="alternate stylesheet" href="alternatestyle.css" type="text/css" />
		<link rel="alternate stylesheet" title="print stylesheet" href="druk.css" media="print" type="text/css" />
		<script type="text/javascript">
  			window.onload=inicjalizacjaStyl();
		</script> 
	</head>
	<body onload="wyswietListeStyli();">
		<div id="container">
			<div id="logo">
				<p>Załóż blog</p>
			</div>
			<div class="menu">
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/all_blogs.php">Wszystkie blogi</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/create_blog.php">Załóż blog</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/add_post.php">Dodaj post</a></div>
				<div style="clear:both;"></div>
			</div>

			<div id="content">
				<div id="blog" class="padd-left">
					<form action="./nowy.php" method="post">
						<p class="reset-format">Nazwa blogu: *<br /><input type="text" name="name"/></p>
						<p class="reset-format">Nazwa użytkownika: *<br /><input type="text" name="username"/></p>
						<p class="reset-format">Hasło: *<br /><input type="password" name="password"/></p>
						<p class="reset-format">Opis blogu:<br /><textarea rows="4" cols="50" name="description"></textarea></p>
						<div>
							<input type="reset" value="Wyczyść"/>
							<input type="submit" value="Zapisz"/>
						</div>
					</form>
				</div>
				<div id="menul" class="spis_menu">
					<h2>Spis</h2>
					<?php include 'menu.php';?>
				</div>
				<div id="pozostale_cwiczenia">
					<h2>Style</h2>
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
