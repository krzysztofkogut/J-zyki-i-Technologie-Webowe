
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
   <head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<script type="text/javascript" src="walidacja.js"></script>
		<script type="text/javascript" src="uzycieDOM.js"></script>
		<script type="text/javascript" src="communicator.js"></script>
		<link rel="stylesheet" title="casual stylesheet" href="style.css" media="screen" type="text/css" />
		<link rel="alternate stylesheet" title="alternate stylesheet" href="alternatestyle.css" type="text/css" />
		<link rel="alternate stylesheet" title="print stylesheet" href="druk.css" media="print" type="text/css" />
		<title>Komunikator</title>
		<script type="text/javascript">
  			window.onload=inicjalizacjaStyl();
		</script>
	</head>
	<body onload="wyswietListeStyli(); zablokujKomunikator();">
		<div id="container">
			<div id="logo">
					<p>Komunikator internetowy</p>
			</div>
			<div class="menu">
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/all_blogs.php">Wszystkie blogi</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/create_blog.php">Załóż blog</a></div>
				<div class="option1"><a href="http://borg.kis.agh.edu.pl/~kogukrzy/blogJS/add_post.php">Dodaj post</a></div>
				<div style="clear:both;"></div>
			</div>
			<div id="content">	   			
    			<form>
  				<div id="checkbox">Aktywuj komunikator
  					<input type="checkbox" name="checkbox" value="active" onclick="zmienStan()"/>
					</div>
					<div id="komunikator">
   					<textarea name="komunikator" rows="20" cols="100" class="komunikator" readonly="readonly"></textarea>
       		</div> 
       		<div id="trescKomunikatu">Treść komunikatu:<br/>
				   	<input type="text" name="trescKomunikatu" size="74" class="komunikator"/>
	    		</div>
					<div id="podpis">Podpis:<br/>
				   <input type="text" name="podpis" class="komunikator"/>
  				</div> 					
					<div>
				    <input type="button" value="Wyślij" class="komunikator" onclick="mojAJAX()"/>
 	     		</div>
					<div id="menul" class="spis_menu">
						<h2>Spis</h2>
						<?php include 'menu.php';?>
					</div>
 	     		<div id="pozostale_cwiczenia">
						<h2>Style</h2>
					</div>
				</form>
				<p>
			   	<a href="http://validator.w3.org/check?uri=referer"><img
			      	src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
		  	      <a href="http://jigsaw.w3.org/css-validator/check/referer"><img 
				    	style="border:0;width:88px;height:31px"
				      src="http://jigsaw.w3.org/css-validator/images/vcss"
				      alt="Poprawny CSS!" /></a>
				</p>
			</div>
		</div>
	</body>
</html>