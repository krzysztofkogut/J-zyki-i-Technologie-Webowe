<?php echo'<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Strona główna</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml;
			charset=UTF-8" />
		<meta name="Author" lang="pl" content="Krzysztof Kogut" />
		<link rel="stylesheet" title="casual" href="../style1.css" type="text/css" />
		<link rel="stylesheet" media="print" href="../print_style.css" type="text/css" />
		<link rel="alternate stylesheet" title="alternate" href="../alt_style.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="title" class="main">
				<p><?php echo $_GET['blog']; ?></p>
			</div>
			<div id="menu">
				<h1 id="table_of_contents">Spis treści</h1>
				<?php include 'menu.php';?>
			</div>
			<div id="main" class="main">
				<h1>Dodaj komentarz</h1>
				<div id="blog" class="padd-left">
					<form action="./koment.php" method="post" enctype="multipart/form-data">
						<p class="reset-format">Rodzaj:
						<select name="type">
							<option value="positive">Pozytywny</option>
							<option value="negative">Negatywny</option>
							<option value="neutral">Neutralny</option>
						</select></p>
						<p class="reset-format">Nazwa użytkownika: *<br /><input type="text" name="username"/></p>
						<p class="reset-format">Komentarz: *<br /><textarea rows="4" cols="50" name="comment" ><?php if(isset($_GET['user'])) echo "@" . $_GET['user'] . " "?></textarea></p>
						<input type="hidden" name="blog" value="<?php echo $_GET['blog']; ?>" />
						<input type="hidden" name="post" value="<?php echo $_GET['post']; ?>" />
						<div>
							<input type="reset" value="Wyczyść"/>
							<input type="submit" value="Zapisz"/>
						</div>
					</form>
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
